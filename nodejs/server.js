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
ChatController = function(socks) {
    var socket = socks;
    var self = this;
    var formatAMPM= function () {
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
    };
    var init= function () {
        socket.on('disconnect',function(e){
           self.close();
        });
        socket.on('getUser',function(){
            self.getUser();
        });
        socket.on('getChat',function(){
            self.getChat();
        });
        redis.set('online',);
    };

    self.getUser= function () {
        // connection.connect();
        connection.query('SELECT * FROM users', function(err, rows, fields) {
            if (err) {throw err};
            console.log('The solution is: ', rows[0].id);
        });
        // connection.end();
    };
    self.getChat= function () {
        setInterval(function () {
            ///none
        }, 1000)
    };
    self.sendChat= function (tweet) {
        socket.volatile.emit('friendsChat', tweet);
    };
    self.close = function(){

    };
    self.init();
    return self;
}
io.on('connection', function (socket) {
    var controller = new ChatController(socket);


});