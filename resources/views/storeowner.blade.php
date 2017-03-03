@extends('layouts.app')
@section('content')
    <style>
        .btn-file {
            position: relative;
            overflow: hidden;
        }
        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
        }
    </style>
    <div class="container">

        <div class="row">
            <div style="float: left">
                @if(!empty($getpost))
                    @foreach($getpost as $key=>$value)
                        <p>{{$value->name}}</p>
                        <img src="{{URL::asset('post_images/'.$value->image)}}" width="250px" height="250px" style="border-radius: 10px; float:left;"><br><br>
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" style="margin-top: 7px;">Change Store</button>
                    @endforeach
                @endif
            </div>

            @if (count($errors) > 0)
                <div class="alert alert-danger" style="width: 746px; float: right;margin-right: 43px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="col-md-8 col-md-offset-2" style="float: right;margin: 25px;">
                <div class="panel panel-default">
                    <div class="panel-heading">Update my data</div><br><br>
                    <form class="form-horizontal" role="form" method="POST"  action="{{ url('/updatedata') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">email</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">password</label>
                            <div class="col-md-6">
                                <input id="email" type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" style="float: right;">
                                    Add
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/changedata') }}">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Store Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name"   autofocus>
                            </div><br><br>

                            <label for="name" class="col-md-4 control-label">About Store</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="about"   autofocus>
                            </div>
                            <div class="col-md-6"><br>
                                <span class="btn btn-default btn-file" style="margin-left: 297px;">
                                    Add Image <input type="file" name="fileinput" id="fileinput" class="fileinput">
                                </span>
                            </div>
                        </div>
                        <div style="float: right; margin: 25px">
                        <button type="submit" class="btn btn-primary">Change</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                        <input type="hidden">
                        <input type="hidden">
                </div>

            </div>
        </div>
    </div>
@endsection
