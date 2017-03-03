@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @if(!$selectupdatedproducts->isEmpty())
                @foreach($selectupdatedproducts as $key=>$value)
            <div class="item  col-xs-4 col-lg-4" id="product_{{$value->update_id}}">
                <div class="thumbnail">
                    <img class="group list-group-image" src="{{URL::asset('/products_images/'.$value->product_image)}}" alt="" />
                    <div class="caption">
                        <h4 class="group inner list-group-item-heading">{{$value->product_name}}</h4>
                        <p class="group inner list-group-item-text">{{$value->product_content}}</p>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <p class="lead">{{$value->product_price}}$</p>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success seenupdate" id="{{$value->update_id}}">Seen</button>
                    </div>
                </div>
            </div>
             @endforeach
                @else
                    <p style="color: red;font-size: 20px">You havn't updated products By Admin</p>
            @endif
        </div>
    </div>

@endsection