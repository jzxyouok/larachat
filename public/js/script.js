$(function () {

    var socket = io.connect('http://127.0.0.1:8890');
    socket.on('message', function (data) {
        data = jQuery.parseJSON(data);
        console.log(data.user);
        $("#messages").append("<a class='pull-left' href='#'><img class='media-object img-circle' src='http://www.patrasevents.gr/imgsrv/f/100x67/1846394.jpg' /></a>" +
            "<div class='media-body'><strong>" + data.user + ":</strong><p>" + data.message + "</p><br/>" +
            "<small id='info' class='text-muted'>Alex Deo | 23rd June at 5:00pm</small><hr /></div>");
    });

    $(".send-msg").on('click', function (e) {
        e.preventDefault();
        var token = $("input[name='_token']").val();
        var user = $("input[name='user']").val();
        var msg = $(".msg").val();
        if (msg != '') {
            $.ajax({
                type: "POST",
                url: '/sendmessage',
                dataType: "json",
                data: {'_token': token, 'message': msg, 'user': user},
                success: function (data) {
                    console.log(data);
                    $(".msg").val('');
                }
            });
        } else {
            alert("Please Add Message.");
        }
    })
})