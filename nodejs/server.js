var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var redis = require('redis');
var mysql = require('mysql');

var connection = mysql.createConnection({
    host     : '127.0.0.1',
    user     : 'root',
    password : '',
    database : 'larachat'
});

server.listen(8890);
io.on('connection', function (socket) {

    console.log("client connected");

    // message channel
    var redisClient = redis.createClient();
    redisClient.subscribe('message');

    redisClient.on("message", function (channel, data) {
        console.log("mew message add in queue " + data + " channel");
        console.log(channel);
        socket.emit(channel, data);
    });

    ChatController = {
        init: function () {
            setInterval(function () {
                socket.emit("time", ChatController.formatAMPM());
            }, 1000);
        },
        formatAMPM: function () {
            var date = new Date();
            var hours = date.getHours();
            var minutes = date.getMinutes();
            var sec = date.getSeconds();
            var ampm = hours >= 12 ? 'pm' : 'am';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? '0' + minutes : minutes;
            var strTime = hours + ':' + minutes + ':' + sec + ' ' + ampm;
            return strTime;
        },
        getUser: function () {
            // connection.connect();
            connection.query('SELECT * FROM users', function(err, rows, fields) {
                if (err) {throw err};
                console.log('The solution is: ', rows[0].id);
            });
            // connection.end();
        },
        getChat: function () {
            setInterval(function () {
                ///none
            }, 1000)
        },
        sendChat: function (tweet) {
            socket.volatile.emit('friendsChat', tweet);
        }
    }

    ChatController.init();

    socket.on('disconnect', function () {
        clearInterval(ChatController.init());
        clearInterval(ChatController.getChat());
        console.log('disconnect');
        redisClient.quit();
    });

});