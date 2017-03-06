@extends('layouts.app')
@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.7.2/css/bootstrap-slider.css" rel="stylesheet">

    <div class="container">
        <br class="row">
            <div data-role="page">
                <div data-role="main" class="ui-content">
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
                        </div><br><br><br><br>
                    @if(!$selectproducts->isEmpty())
                    <b>$ 0</b> <input id="ex2" type="text" class="span2" value="" data-slider-min="10" data-slider-max="5000" data-slider-step="5" data-slider-value="[1900,2500]"/> <b>$ 5000</b></div><br><br>
                    <button type="button" data-inline="true" class="btn btn-primary searchproducts" >Search</button>

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
                            @foreach($selectproducts as $key=>$value)
                                <tr>
                                    <td>{{$value->product_name}}</td>
                                    <td>{{$value->product_content}}</td>
                                    <td>{{$value->product_price}}</td>
                                    <td><img src="{{URL::asset('/products_images/'.$value->product_image)}}" width="60px" height="60px" style="border-radius: 8px"/></td>
                                    <td><a href="{{url($language.'/deleteproduct/'.$value->product_id)}}">Delete Product</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                        @else
                            <p style="color: red; font-size: 20px"> You havn't Products</p>
                        @endif
                 </div>
            </div>
        </div>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.7.2/bootstrap-slider.js"></script>
    <script>
        $(document).ready(function () {
            $("#ex2").slider({});
        });
    </script>

@endsection

