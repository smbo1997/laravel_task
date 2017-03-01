@extends('layouts.app')
@section('content')

    <div class="container">
    <div class="raw">

        <table class="table table-hover" style="margin-top: 60px">
            <thead>
            <tr>
                <th>User Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Sended</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            @if(!empty($getmessages))
                @foreach($getmessages as $key=>$value)
                        <tr>
                            <td>{{$value->name}}</td>
                            <td>{{$value->email}}</td>
                            <td>{{$value->content}}</td>
                            <td>{{$value->created_at}}</td>
                            <td>
                                <a class="btn btn-primary" href="{{URL::asset($language.'/adminseenmessage/'.$value->chat_id)}}">Seen</a> |
                                <a href="{{URL::asset($language.'/deletemessagebyadmin/'.$value->chat_id)}}" class="btn btn-warning">Delete Message</a> |
                                <button type="button" class="btn btn-success answer" email="{{$value->email}}" chatid="{{$value->chat_id}}" data-toggle="modal" data-target="#myModal">Answer</button>
                            </td>
                        </tr>
                    @endforeach
               @endif
            </tbody>
        </table>
    </div>
    </div>


    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Answer to user</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="usr">Write a message:</label>
                        <input type="text" class="form-control senduser">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary sendmessage">Send</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
@endsection