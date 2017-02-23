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
                @if($gotproducts)
                    @foreach($gotproducts as $key=>$value)
                            @foreach($value as $key1=>$item)
                            @foreach($item as $key1=>$item1)
                                <tr id="myProduct_{{$item1->product_id}}">
                                    <td>{{$key}}</td>
                                    <td>{{$item1->product_name}}</td>
                                    <td>{{$item1->product_price}}</td>
                                    <td><img src="{{URL::asset('products_images/'.$item1->product_image)}}" width="150px" height="150px" style="border-radius: 8px"></td>
                                            <td class="myactions">
                                                <button type="button" class="btn btn-success buymyproduct" id="{{$item1->product_id}}" value="{{$key}}">Buy</button> |
                                                <a class="btn btn-primary" href="{{url('/'.$language.'/deletebasket/'.$item1->product_id)}}">Delete</a>
                                            </td>
                                </tr>
                            @endforeach
                            @endforeach
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection