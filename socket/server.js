const app = require('express')();
const server = require('http').Server(app);
const io = require('socket.io')(server);
const redisAdapter = require('socket.io-redis');

server.listen(8080);
io.adapter(redisAdapter({host: process.env.REDIS_HOST, port: process.env.REDIS_PORT}));
io.on('connection', function (socket) {
    console.log('connect');

    // once a client has connected, we expect to get a ping from them saying what room they want to join
    socket.on('room', function(room_id) {
        console.log('join to ' + room_id);
        socket.join(room_id);
    });

    socket.on('message', (data) => {
        console.log(data);
        socket.to(data.room_id).emit('message', data);
    });

    socket.on('disconnect', function () {
        console.log('disconnect');
    });
});
