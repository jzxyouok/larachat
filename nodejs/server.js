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

    socket.on('disconnect',function(e){
        console.log("Disconnected");
    });
    socket.on('request',function(data){

        var controller = data.controller;
        controller = require('Controller/'+controller+'Controller.js');
        var fnc = data.action || 'index';
        var msg = data.data || {};
        console.log(data.session+":"+msg);
        var req = {
            controller : data.controller,
            action : fnc,
            data:msg,
            session: data.session
        };
        var res = {
            sent:function(resp){
                io.emit('response',{
                    session:data.session,
                    message:resp
                });
            }
        };
        controller = new controller(req,res);
        var fn = controller[fnc];

        if (typeof fn === "function"){
            try{
                fn(msg);
            }catch(e){
                console.log(e);
            }
        }
        else {
            console.log('Invalid request');
        }
    });
});
// ChatController = function(socks) {
//     var socket = socks;
//     var self = this;
//     var formatAMPM= function () {
//         var date = new Date();
//         var hours = date.getHours();
//         var minutes = date.getMinutes();
//         var sec = date.getSeconds();
//         var ampm = hours >= 12 ? 'pm' : 'am';
//         hours = hours % 12;
//         hours = hours ? hours : 12; // the hour '0' should be '12'
//         minutes = minutes < 10 ? '0' + minutes : minutes;
//         var strTime = hours + ':' + minutes + ':' + sec + ' ' + ampm;
//         return strTime;
//     };
//     self.init= function () {
//         socket.on('disconnect',function(e){
//            self.close();
//         });
//         socket.on('getUser',function(){
//             self.getUser();
//         });
//         socket.on('getChat',function(){
//             self.getChat();
//         });
//         // redis.set('online', 'hi');
//     };
//
//     self.getUser= function () {
//         // connection.connect();
//         connection.query('SELECT * FROM users', function(err, rows, fields) {
//             if (err) {throw err};
//             console.log('The solution is: ', rows[0].id);
//         });
//         // connection.end();
//     };
//     self.getChat= function () {
//
//         setInterval(function () {
//             ///none
//         }, 1000)
//     };
//     self.sendChat= function (tweet) {
//         socket.volatile.emit('friendsChat', tweet);
//     };
//     self.close = function(){
//
//     };
//     self.init();
//     return self;
// }
// io.on('connection', function (socket) {
//     var controller = new ChatController(socket);
//
//
// });