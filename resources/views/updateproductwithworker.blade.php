
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
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update Product!</div><br>
                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/updatedproductwithworkers') }}">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{$product->product_id}}" name="productid">
                        <input type="hidden" value="{{$product->user_id}}" name="userid">
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Product Name</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="productname" value="{{$product->product_name}}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Product Content</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="productcontent" value="{{$product->product_content}}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Product Price</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="productprice" value="{{$product->product_price}}" required>
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
