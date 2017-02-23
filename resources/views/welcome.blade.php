@extends('strorelayouts.storeapp')

@section('storecontent')
    <div class="container">
        <br>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="{{URL::asset('images/img_chania.jpg')}}" alt="Chania" width="460" height="345">
                </div>

                <div class="item">
                    <img src="{{URL::asset('images/img_chania2.jpg')}}" alt="Chania" width="460" height="345">
                </div>

                <div class="item">
                    <img src="{{URL::asset('images/img_flower.jpg')}}" alt="Flower" width="460" height="345">
                </div>

                <div class="item">
                    <img src="{{URL::asset('images/img_flower2.jpg')}}" alt="Flower" width="460" height="345">
                </div>
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
            <div class="mypaginate">
            <ul>
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
    <script src="{{URL::asset('js/myjs.js')}}"></script>
@endsection
