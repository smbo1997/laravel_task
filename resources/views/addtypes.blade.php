@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @if (count($errors) > 0)
                <div class="col-md-8 col-md-offset-2">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <form method="POST" action="{{url('/addnewtype')}}">
                {{ csrf_field() }}
            <div class="form-group">
                <label for="email" class="col-md-4 control-label">Add Type</label>
                <div class="col-md-6">
                    <input id="email" type="text" class="form-control" name="typename" >
                </div>
            </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4" style="margin-top: 25px;">
                        <button type="submit" class="btn btn-primary" style="float: right;">
                            Add
                        </button>
                    </div>
                </div>
            </form>


            @if(!$selectTypes->isEmpty())
            <table class="table table-striped" style="width:600px;">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                        @foreach($selectTypes as $key=>$value)
                            <tr>
                            <td>{{$value->typename}}</td>
                            <td><a href="{{url('/'.$language.'/deletetype/'.$value->type_id)}}">Delete</a></td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
@endsection