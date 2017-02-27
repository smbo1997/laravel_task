@extends('strorelayouts.storeapp')
@section('storecontent')
    <div class="container">
        <div class="row" en="{{$language}}">
            <button class="btn btn-success buyall" style="margin-top: 25px">Buy All</button>
            <table class="table table-hover" style="margin-top: 90px">
                <thead>
                <tr>
                    <th>How Many</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Image</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="clearetable">
                @if(!empty($gotproducts))
                    @foreach($gotproducts as $key=>$value)
                                <tr id="myProduct_{{$value->basket_id}}">
                                    <td class="count_{{$value->basket_id}}" id="{{$value->count}}">{{$value->count}}</td>
                                    <td>{{$value->product_name}}</td>
                                    <td class="price_{{$value->basket_id}}" id="{{$value->product_price}}">{{$value->product_price}}</td>
                                    <td><img src="{{URL::asset('products_images/'.$value->product_image)}}" width="150px" height="150px" style="border-radius: 8px"></td>
                                            <td class="myactions">
                                                <button type="button" class="btn btn-success buymyproduct"  value="{{$value->basket_id}}">Buy</button> |
                                                <a class="btn btn-primary" href="{{url('/'.$language.'/deletebasket/'.$value->basket_id)}}">Delete</a>
                                            </td>
                                </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection