@extends('layouts.app')
@section('content')
    
<div class="container">
<div class="row " style="padding-top:40px;">
    <div class="col-md-8">
        <div class="panel panel-info">
            <div class="panel-heading">
                LARACHAT
            </div>
            <div class="panel-body">
                <ul class="media-list">
                    <li class="media">
                        <div class="media-body">
                            <div id="messages" class="media">
                                
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="panel-footer">
                <form action="sendmessage" method="POST">
                <div class="input-group">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="user" value="{{ Auth::user()->name }}">
                        <input type="text" class="form-control msg" placeholder="Enter Message" />
                    <span class="input-group-btn">
                        <input class="btn btn-info send-msg" type="button" value="SEND" />
                    </span>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
          <div class="panel panel-primary">
            <div class="panel-heading">
               ONLINE USERS
            </div>
            <div class="panel-footer">
                <div class="input-group">
                    <input type="text" class="form-control msg" placeholder="Search" />
                    <span class="input-group-btn">
                        <button class="btn btn-danger" type="button">
                            <span class=" glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </div>
            <div class="panel-body" style="height:350px">
                <ul class="media-list">
                    <li class="media">
                        <div class="media-body">
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object img-circle" style="max-height:40px;" src="assets/img/user.png" />
                                </a>
                                <div class="media-body" >
                                    <h5>Alex Deo | User </h5>
                                   <small class="text-muted">Active From 3 hours</small>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                </div>
            </div>
        
    </div>
</div>
</div>

    <!-- <div class="container spark-screen">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">LaraChat</div>
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
    </div> -->

    <script>
        var socket = io.connect('http://127.0.0.1:8890');
        socket.on('message', function (data) {
            data = jQuery.parseJSON(data);
            console.log(data.user);
            $("#messages").append("<a class='pull-left' href='#'><img class='media-object img-circle' src='http://www.patrasevents.gr/imgsrv/f/100x67/1846394.jpg' /></a>"+
                "<div class='media-body'><strong>" + data.user + ":</strong><p>" + data.message + "</p><br/><small id='info' class='text-muted'>Alex Deo | 23rd June at 5:00pm</small><hr /></div>");
        });

        $(".send-msg").on('click', function (e) {
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
