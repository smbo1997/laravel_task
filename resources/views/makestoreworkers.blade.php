@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="row">

            @if (count($errors) > 0)
                <div class="alert alert-danger" style="width: 743px;margin-left: 45px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-md-8 col-md-offset-2" style="float: left;margin: 25px;">
                <div class="panel panel-default">
                    <div class="panel-heading">Add store workers</div><br>
                    <form class="form-horizontal" role="form" method="POST"  action="{{ url('/addstoreworkers') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="name" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">email</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">password</label>
                            <div class="col-md-6">
                                <input id="email" type="password" class="form-control" name="password" >
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

            @if(!$storeworkers->isEmpty())
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                            @foreach($storeworkers as $key=>$value)
                                <tr>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->email}}</td>
                                    <td><a href="{{url('/'.$language.'/deleteworker/'.$value->id)}}">Delete worker</a></td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection