@extends('layouts.app')
@section('content')

    <div id="appkini" class="container" xmlns:v-on="http://www.w3.org/1999/xhtml">
        <div class="row " style="padding-top:40px;">
            <div class="col-md-8">
                <div class="panel panel-info">
                    <div class="panel-heading">LaraChat</div>
                    <div class="panel-body">
                        <ul class="media-list">
                            <li class="media">
                                <div class="media-body">
                                    <div id="messages" class="media">
                                        {{--<div v-if=""></div>--}}
                                        {{--<div v-else=""></div>--}}
                                        {{--if friend true pull right else --}}
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
                                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                <input type="text" class="form-control msg" placeholder="Enter Message"/>
                                <span class="input-group-btn">
                                 <input v-on:click="postMessage" class="btn btn-info send-msg" type="button" value="SEND"/>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Online Users
                    </div>
                    <div class="panel-footer">
                        <div class="input-group">
                            <input type="text" class="form-control msg" placeholder="Search"/>
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
                                            <img class="media-object img-circle" style="max-height:40px;" src="http://www.patrasevents.gr/imgsrv/f/100x67/1846394.jpg"/>
                                        </a>
                                        <div class="media-body">
                                            <h5>Din</h5>
                                            <small v-if="isOnline" class="text-muted">Online</small>
                                            <small v-else class="text-muted">Offline</small>
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
    <script>
        var socket = null;

        (function () {
//            function connect() {
//                if (socket !== null) {
//                    return;
//                }
//
//                socket = new WebSocket('ws://127.0.0.1:8890');
//                if (window.WebSocket) {
//                }
//                socket.onopen = function() {
//                    console.log('open socket');
//                };
//                socket.onmessage = function(e) {
//                    var el = $('#output');
//                    var m = JSON.parse(decodeURIComponent(e.data)).message;
//                    el.val(m + '\n' + el.val());
//                };
//                socket.onclose = function(e) {
//                    // e.reason ==> total.js client.close('reason message');
//                    $('button[name="open"]').attr('disabled', false);
//                };
//            }

            /////////////////////////////
//            var host = "ws://localhost:80/websocket/server.php";
//            try {
//                socket = new WebSocket(host);
//                log('WebSocket - status ' + socket.readyState);
//                socket.onopen = function (msg) {
//                    log("Welcome - status " + this.readyState);
//                };
//                socket.onmessage = function (msg) {
//                    log("Received: " + msg.data);
//                };
//                socket.onclose = function (msg) {
//                    log("Disconnected - status " + this.readyState);
//                };
//            } catch (ex) {
//                log(ex);
//            }
            ///////////////////////////////

        });

    </script>
@endsection
