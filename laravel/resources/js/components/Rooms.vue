<template>
    <div class="card card-default">
        <div class="card-header">List of rooms</div>
        <div class="list-group">
            <div class="list-group-item" v-for="room in rooms" :room="room">
                <router-link :to="{path: '/rooms/' + room.id}">
                    {{room.title}}
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                rooms: [],
            };
        },
        methods: {
            getRooms: async function () {
                const {data} = await axios.get(`/api/rooms`);
                this.rooms = data;
            },
        },
        mounted() {
            this.getRooms();
        }
    }
</script>
