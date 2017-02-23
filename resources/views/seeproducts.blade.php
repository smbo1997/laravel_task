@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="form-group">
                <label for="email" class="col-md-4 control-label">Select Product Type</label>
                <div class="col-md-6">
                    <select class="form-control typeselect">
                        @if(!empty($getproductsTypes))
                            @foreach($getproductsTypes as $key=>$value)
                                <option value="{{$value->type_id}}">{{$value->typename}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <table class="table table-striped" style="margin-top: 125px">
                <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Product Content</th>
                    <th>Product Price</th>
                    <th>Product Image</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="myproducts" lang="{{$language}}">
                @if(!empty($selectproducts))
                    @foreach($selectproducts as $key=>$value)
                        <tr>
                            <td>{{$value->product_name}}</td>
                            <td>{{$value->product_content}}</td>
                            <td>{{$value->product_price}}</td>
                            <td><img src="{{URL::asset('/products_images/'.$value->product_image)}}" width="60px" height="60px" style="border-radius: 8px"/></td>
                            <td><a href="{{url($language.'/deleteproduct/'.$value->product_id)}}">Delete Product</a></td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

