
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
            @if (count($errors) > 0)
                <div class="alert alert-danger" style="width: 744px; margin-left: 212px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Hi Admin!</div><br>
                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/addimage') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Store Owner Name</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="storeownername" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="email" type="password" class="form-control" name="password" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">About Store</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="about" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Store Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" >
                            </div>
                            <div class="col-md-6"><br>
                                <span class="btn btn-default btn-file" style="margin-left: 259px;">
                                    Add Image <input type="file" name="fileinput" id="fileinput" class="fileinput">
                            </span>
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
@endsection
