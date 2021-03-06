<template>
    <div class="card card-default">
        <div class="card-header">List of messages in "{{room.title}}" room</div>

        <div class="card-body">

            <div v-for="message in messages" :message="message">
                <div class="media border p-3" v-if="undefined !== message.username">
                    <div v-if="message.avatar !== undefined && message.avatar.length > 1">
                        <img v-bind:src="message.avatar" v-bind:alt="message.username"
                             class="mr-3 mt-3 rounded-circle" style="width:60px;"/>
                    </div>
                    <div v-else>
                        <gravatar :email="message.email" class="mr-3 mt-3 rounded-circle" style="width:60px;"/>
                    </div>
                    <div class="media-body">
                        <h5>{{ message.username }}</h5>
                        <p>{{ message.body }}</p>
                    </div>
                </div>
                <div v-else>
                    <small>{{ message.body }}</small>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <form class="input-group" @submit.prevent="sendMessage">
                <textarea class="form-control" id="body" v-model="message"></textarea>
                <div class="input-group-append">
                    <button class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</template>

<style>
    textarea {
        resize: none;
    }

    .card-body {
        overflow: auto;
        height: 500px;
    }
</style>

<script>
    import ChatInput from './Input';
    import io from 'socket.io-client';

    export default {

        data() {
            return {
                user: [],
                room: [],
                messages: [],
                message: null,
                socket: null,
            };
        },
        props: {
            room_id: String,
        },
        methods: {
            getRoom: async function () {
                const {data} = await axios.get(`/api/rooms/` + this.room_id);
                this.room = data;
            },
            getMessages: async function () {
                const {data} = await axios.get(`/messages/` + this.room_id);
                this.messages = data.reverse();
            },
            sendMessage: async function () {
                let message = {'body': this.message, 'room_id': this.room_id};
                const {data} = await axios.post(`/messages`, message);
                this.messages.push(data);
                this.socket.emit('message', data);
                this.message = null;
            },
            getUser: async () => {
                const {data} = await axios.get(`/users/info`);
                this.user = data;
                return data;
            },
        },
        comments: {
            ChatInput
        },
        mounted() {
            this.getRoom();
            this.getMessages();

            // Get information about current user the connect to socket
            this.getUser().then((user) => {

                // Connect to socket server and send information about current user
                this.socket = io('localhost:8080');

                // Change the room after connect and send message about connecting
                this.socket.on('connect', () => {
                    // Connected, let's sign-up for to receive messages for this room
                    this.socket.emit('room', this.room_id);

                    // Send message about connecting
                    this.socket.emit('message', {'connected': user.name, 'room_id': this.room_id});

                });

                this.socket.on('disconnect', () => {
                    this.socket.emit('message', {'disconnected': user.name, 'room_id': this.room_id});
                });

                // Add message from redis to array of messages
                this.socket.on('message', (data) => {
                    this.messages.push(data);
                });

            });

        }
    }
</script>
