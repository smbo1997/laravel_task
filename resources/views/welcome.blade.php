@extends('strorelayouts.storeapp')

@section('storecontent')
    <div class="container">
        <br>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                @if(!empty($selectshop))
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    @for($i=1;$i<=9;$i++)
                        <li data-target="#myCarousel" data-slide-to="{{$i}}"></li>
                       @endfor
                @endif
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">



                @if(!empty($selectshop))
                    <div class="item active">
                        <img src="{{URL::asset('images/img_chania.jpg')}}" alt="Chania" width="400" height="300">
                    </div>
                    @foreach($selectshop as $key=>$value)
                            <div class="item">
                                <img src="{{URL::asset('post_images/'.$value->image)}}" alt="Chania" width="400" height="300">
                            </div>
                    @endforeach
                @endif
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div><br>

        <div class="content">
            <div style="margin: 0 auto; color: #01A4E0; font-size: 20px">Stores</div>
            <div class="mypaginate" lang="{{$language}}">
            <ul class="addpaginate">
               @if(!empty($stores))
                   @foreach($stores as $key=>$value)
                        <a href="{{url($language.'/store/'.$value->post_id)}}">
                            <li class="licontents">
                                    <div>
                                        <img src="{{URL::asset('post_images/'.$value->image)}}" width="100px" height="100px" style="border-radius: 10px; float:left;">
                                        <p style="color:#01A4E0 ; float: right">{{$value->name}}</p>
                                    </div>
                            </li>
                        </a>
                    @endforeach
                @endif
            </ul>
            <div style="margin-left: 145px">
                    {{ $stores->links() }}
            </div>
        </div>
        </div>
    </div>
@endsection
