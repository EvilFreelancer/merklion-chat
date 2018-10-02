const app = require('express')();
const server = require('http').Server(app);
const io = require('socket.io')(server);
const redisAdapter = require('socket.io-redis');

server.listen(8080);
io.adapter(redisAdapter({host: process.env.REDIS_HOST, port: process.env.REDIS_PORT}));
io.on('connection', function (socket) {

    const _id = socket.id;
    let username, room;

    console.log('connect with id ' + _id);

    // once a client has connected, we expect to get a ping from them saying what room they want to join
    socket.on('room', (room_id) => {
        room = room_id;
        socket.join(room_id);
    });

    socket.on('message', (data) => {
        // Show message about connecting to server
        if (undefined !== data.connected) {
            username = data.connected;
            data.body = 'User ' + data.connected + ' connected to server';
        }
        socket.to(data.room_id).emit('message', data);
    });

    socket.on('disconnect', () => {
        // Show message about disconnecting from server
        socket.to(room).emit('message', {'body': 'User ' + username + ' leave from server', 'room_id': room});
        console.log('disconnect');
    });
});
