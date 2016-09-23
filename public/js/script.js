$(function () {

    var socket = io.connect('http://127.0.0.1:8890');
    // socket.on('time', function (datas) {
    //     console.log(datas.toString());
    // });
    // socket.on('friendsChat', function (datas) {
    //     console.log(datas.toString());
    // });
    socket.on('message', function (data) {
        data = jQuery.parseJSON(data);
        // console.log(data);

        $("#messages").append("<a class='pull-left' href='#'><img class='media-object img-circle' src='http://www.patrasevents.gr/imgsrv/f/100x67/1846394.jpg' /></a>" +
            "<div class='media-body'><strong>" + data.user + ":</strong><p>" + data.message + "</p><br/>" +
            "<small id='info' class='text-muted'>"+ data.datetime +"</small><hr /></div>");

    });

    // $("#send-msg").click('click', function (e) {
    //     e.preventDefault();
    //
    // })
})

/*begin vue js*/
Vue.config.delimiters = ['${', '}']
Vue.http.interceptors.push(function (request, next) {
    request.headers['X-CSRF-TOKEN'] = Laravel.csrfToken;
    next();
});
var appkini = new Vue({
    el: '#appkini',
    data: {
        message: 'Hello Vue!',
        counter: 0,
        isOnline: true,
    },
    ready: function () {
        this.token = $("input[name='_token']").val();
    },
    methods: {
        getMessage: function (e, id) {
            e.preventDefault();
            var token = $("input[name='_token']").val();
            var id = $("input[name='id']").val();
            $.post('/api/findmessage/' + id, {'_token': this.token}, function (data) {
                console.log(data);
            });
        },
        postMessage: function (e) {
            e.preventDefault();
            var user = $("input[name='user']").val();
            var msg = $(".msg").val();
            if (msg != '') {
                jQuery.ajax({
                    type: "POST",
                    url: '/sendmessage',
                    dataType: "json",
                    data: {'_token': this.token, 'message': msg, 'user': user},
                    success: function (data) {
                        console.log(data);
                        $(".msg").val('');
                    }
                });
            } else {
                alert("Please Add Message.");
            }
        },
        deleteMessage: function (index, user_id) {
            // `this` inside methods point to the Vue instance
            alert('Hello ' + this.name + '!');
        },
        isRead: function (index, user_id) {
            // `this` inside methods point to the Vue instance
            alert('Hello ' + this.name + '!');
        }
    }
});