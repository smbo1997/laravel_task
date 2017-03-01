@extends('layouts.app')
@section('content')

    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">

    <div class="container">
        <br class="row">
            <div data-role="page">
                <div data-role="main" class="ui-content">

                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">Select Product Type</label>
                        <div class="col-md-6" style="margin-top: 50px;">
                            <select class="form-control typeselect">
                                @if(!empty($getproductsTypes))
                                    @foreach($getproductsTypes as $key=>$value)
                                        <option value="{{$value->type_id}}">{{$value->typename}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div><br><br><br><br>

                        <div data-role="rangeslider" style="margin-top: 55px;">

                            <input type="range" class="minprice" name="price-min" id="price-min" value="200" min="0" max="10000">

                            <input type="range" class="maxprice" name="price-max" id="price-max" value="800" min="0" max="10000">
                        </div>
                    <button type="button" data-inline="true" class="searchproducts">Search</button>


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


        </div>
    </div>

    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
@endsection

