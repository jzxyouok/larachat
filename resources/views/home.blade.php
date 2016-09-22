@extends('layouts.app')
@section('content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Messages</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div id="messages"></div>
                            </div>
                            <div class="col-lg-8">
                                <form action="sendmessage" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="user" value="{{ Auth::user()->name }}">
                                    <textarea class="form-control msg"></textarea>
                                    <br/>
                                    <input type="button" value="Send" class="btn btn-success send-msg">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    var socket = io.connect('http://127.0.0.1:8890');
    socket.on('message', function (data) {
        data = jQuery.parseJSON(data);
        console.log(data.user);
        $("#messages").append("<strong>" + data.user + ":</strong><p>" + data.message + "</p>");
    });

    $(function () {

        $(".send-msg").click(function (e) {
            e.preventDefault();
            var token = $("input[name='_token']").val();
            var user = $("input[name='user']").val();
            var msg = $(".msg").val();
            if (msg != '') {
                $.ajax({
                    type: "POST",
                    url: '{!! URL::to("sendmessage") !!}',
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
</script>
@endsection