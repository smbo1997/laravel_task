@extends('strorelayouts.storeapp')

@section('storecontent')
    <div class="container">
        <div class="row">
            {{ csrf_field() }}
           @if(!empty($select))
            @foreach($select as $key=>$value)
                <span>
                    <button type="button" class="btn btn-link getstoresbyservice" value="{{$value->type_id}}">{{$value->typename}}</button>
                {{--<span style="float: left; margin-right: 10px">--}}
                    {{--<p style="color:#01A4E0;">{{$value->name}}</p>--}}
                    {{--<a class="fancybox imglink" data-fancybox-group="gallery" href="{{URL::asset('post_images/'.$value->image)}}">--}}
                         {{--<img src="{{URL::asset('post_images/'.$value->image)}}" width="150px" height="150px" style="border-radius: 10px">--}}
                    {{--</a>--}}
                 {{--</span>--}}
                </span>
                @endforeach
            @endif



            <div class="col-md-8 col-md-offset-2 showstores" style="margin-left: -5px;margin-top: 45px; display: none">
                <div class="panel panel-default">
                    <div class="panel-heading ">Stores</div><br>
                        <div class="showedstores" style="height: 296px; overflow: scroll; overflow-x: hidden">

                        </div>
                     </div>
                </div>
             </div>

        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Store Products</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="setmydata">
                    <div class="setdata" style="height: 400px; overflow: auto;">

                    </div>
                </div><br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
