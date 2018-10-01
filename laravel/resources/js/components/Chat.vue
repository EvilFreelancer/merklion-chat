<template>
    <div class="card card-default">
        <div class="card-header">List of messages in "{{room.title}}" room</div>
        <div class="list-group">
            <div class="list-group-item" v-for="message in messages" :message="message">
                <strong>{{ message.username }}:</strong> {{ message.body }}
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

    .list-group {
        overflow: auto;
        height: 500px;
    }
</style>

<script>
    import ChatInput from './Input';

    export default {
        data() {
            return {
                room: [],
                messages: [],
                message: null,
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
                const {data} = await axios.get(`/api/messages/` + this.room_id);
                this.messages = data.reverse();
            },
            sendMessage: async function () {
                let message = {'body': this.message, 'room_id': this.room_id};
                const {data} = await axios.post(`/messages`, message);
                this.messages.push(data);
                this.message = null;
            }
        },
        comments: {
            ChatInput
        },
        mounted() {
            this.getRoom();
            this.getMessages();
        },
        // updated() {
        //     let elem = this.$el;
        //     elem.scrollTop = elem.clientHeight;
        // },
    }
</script>