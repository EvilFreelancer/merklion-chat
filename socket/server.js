var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var redis = require('redis');

server.listen(8080);
io.on('connection', function (socket) {
    console.log('Starting');
    var options = {
        host: process.env.REDIS_HOST,
        port: process.env.REDIS_PORT,
    };
    var redisClient = redis.createClient(options);
    redisClient.subscribe('message');

    redisClient.on("message", function (channel, message) {
        socket.emit(channel, message);
    });

    socket.on('disconnect', function () {
        redisClient.quit();
    });
});
