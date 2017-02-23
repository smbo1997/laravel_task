@extends('strorelayouts.storeapp')

@section('storecontent')
    {{ csrf_field() }}
    <div class="container">
        <div class="row">
            <div style="float: left">
                <img src="{{URL::asset('post_images/'.$aboutStore['image'])}}" width="250px" height="250px" style="border-radius: 10px; float:left;">
            </div>
            <div class="col-md-8 col-md-offset-2" style="float: right;margin: 25px; ">
                <div class="panel panel-default">
                    <div class="panel-heading" >About Store</div>
                        <div style="height: 500px; overflow: scroll; overflow-x: hidden">
                            <p style="margin-left: 14px; margin-top: 5px">{{$aboutStore->about}}</p>
                                    @if(!empty($getTypes))
                                        @foreach($getTypes as $key=>$value)
                                                <button type="button" class="btn btn-link getproduct" value="{{$value->type_id}}">{{$value->typename}}</button>
                                         @endforeach
                                    @endif
                            <div  id="products" class="row list-group" style="margin-top: 36px; margin-left: 15px;">

                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
@endsection