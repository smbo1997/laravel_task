<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Store</title>

    <!-- Styles -->
    <link href="{{URL::asset('/css/app.css')}}" rel="stylesheet">
    <link href="{{URL::asset('/css/mycss.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="{{URL::asset('fancybox/jquery.fancybox.css')}}" rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/{{$language}}">{{trans('translate.shop')}}</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="/{{$language}}">{{trans('translate.home')}}</a></li>
                <li><a href="/{{$language}}/service">{{trans('translate.service')}}</a></li>
                @can('is_user',new \App\User())
                    <li><a href="{{url($language.'/charts')}}"><span class="glyphicon glyphicon-shopping-cart" style="margin-right: 4px;"></span>{{trans('translate.my_basket')}}</a><i class="mybasket" count="0" style="float: right;  margin-top: -34px;"></i></li>
                @endcan
            </ul>
            <ul class="nav navbar-nav" style="float: right;">
                <li><a href="/en/{{$current_action}}"><img src="{{URL::asset('images/en.gif')}}"/></a></li>
                <li><a href="/ru/{{$current_action}}"><img src="{{URL::asset('images/ru.gif')}}"/></a></li>
                <li><a href="/am/{{$current_action}}"><img src="{{URL::asset('images/am.gif')}}"/></a></li>
                @if(Auth::guest())
                <li><a href="{{url($language.'/login')}}"><span class="glyphicon glyphicon-log-in" style="margin-right: 4px;"></span>{{trans('translate.login')}}</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url($language.'/logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ url($language.'/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                            @can('is_user',new \App\User())
                                <li><a href="{{url($language.'/mycard')}}">{{trans('translate.my_card')}}</a></li>
                            @endcan
                        </ul>
                    </li>
                @endif

            </ul>
        </div>
    </nav>
    @yield('storecontent')
</div>
<script src="{{URL::asset('fancybox/jquery.fancybox.js')}}"></script>
<script src="{{URL::asset('fancybox/jquery.mousewheel-3.0.6.pack.js')}}"></script>
<script src="{{URL::asset('js/fancybox.js')}}"></script>
<script src="{{URL::asset('js/myjs.js')}}"></script>
@can('is_user',new \App\User())
    <script src="{{URL::asset('js/user.js')}}"></script>
@endcan
</body>
</html>
