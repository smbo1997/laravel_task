@extends('layouts.app')
@section('content')
    <div class="container">
    @if(!$getusers->isEmpty())
    <link href="{{URL::asset('css/chatCss.css')}}" rel="stylesheet">
    <script src="{{URL::asset('js/chat.js')}}" ></script>
        <div class="row" en="{{$language}}">

        </div>
        <div class="row">
            <div class="conversation-wrap col-lg-3">

                    @foreach($getusers as $key=>$value)
                        <div class="media conversation getstore" id="{{$value->from_id}}" toname="{{$value->name}}">
                            <a class="pull-left" href="#">
                                <img class="media-object"  style="width: 50px; height: 50px;" src="{{URL::asset('avatar/avatar.png')}}">
                            </a>
                            <div class="media-body">
                                <h5 class="media-heading aaa">{{$value->name}}</h5>
                                <small>{{$value->email}}</small>
                            </div>
                        </div>
                    @endforeach


            </div>

            <div class="message-wrap col-lg-8" >
                <div class="msg-wrap" style="height: 300px;"  username="{{Auth::user()->name}}">
                    {{--<small class="pull-right time"><i class="fa fa-clock-o"></i> 12:10am</small>--}}
                </div>

                <div class="send-wrap ">
                    <textarea class="form-control send-message" rows="3" disabled="disabled" placeholder="Write a reply..." userid="{{Auth::user()->id}}"></textarea>
                </div>
            </div>
        </div>

        @else
            <p style="color: red;font-size: 20px;">You hav'nt Messages</p>
    @endif
    </div>
@endsection