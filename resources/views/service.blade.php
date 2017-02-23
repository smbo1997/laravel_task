@extends('strorelayouts.storeapp')

@section('storecontent')
    <div class="container">
        <div class="row">
           @if(!empty($select))
            @foreach($select as $key=>$value)
                <span style="float: left; margin-right: 10px">
                    <p style="color:#01A4E0;">{{$value->name}}</p>
                    <a class="fancybox imglink" data-fancybox-group="gallery" href="{{URL::asset('post_images/'.$value->image)}}">
                         <img src="{{URL::asset('post_images/'.$value->image)}}" width="150px" height="150px" style="border-radius: 10px">
                    </a>
                 </span>
                @endforeach
            @endif
        </div>
    </div>
@endsection
