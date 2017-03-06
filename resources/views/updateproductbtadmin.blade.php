
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
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update Product!</div><br>
                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/updatedproductbyadmin') }}">
                        {{ csrf_field() }}
                                <input type="hidden" value="{{$product->product_id}}" name="productid">
                                <input type="hidden" value="{{$product->user_id}}" name="userid">
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label ">Product Name</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control trname" name="productname" value="{{$product->product_name}}" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Product Content</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="productcontent" value="{{$product->product_content}}" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Product Price IN USD</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control productprice" name="productprice" value="{{$product->product_price}}" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Change Product Price In</label>

                            <div class="col-md-6">
                                <select class="form-control" id="changeprice">
                                    <option value="0"></option>
                                    <option value="EUR">EUR</option>
                                    <option value="RUB">RUB</option>
                                    <option value="AMD">AMD</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
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
