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
            <div class="col-md-8 col-md-offset-2" style="float: left; margin-left: -52px;">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Product</div><br>
                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/addnewproductwithworkers') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Product Type</label>
                            <div class="col-md-6">
                                <select class="form-control" name="producttype">
                                    @if(!empty($getproductsTypes))
                                        @foreach($getproductsTypes as $key=>$value)
                                            <option value="{{$value->type_id}}">{{$value->typename}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Product Name</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="productname" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Product Content</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="productcontent" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Product Price</label>
                            <div class="col-md-6">
                                <input id="text" type="text" class="form-control" name="productprice" required>
                            </div>
                        </div>

                        <div class="col-md-6"><br>
                            <span class="btn btn-default btn-file" style="margin-left: 297px;">
                                    Add Product Image <input type="file" name="fileinput" id="fileinput" class="fileinput">
                                </span>
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