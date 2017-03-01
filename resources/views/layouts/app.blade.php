<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{URL::asset('/css/app.css')}}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{URL::asset('/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script src="{{URL::asset('/js/app.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script src="{{URL::asset('/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('/js/myjs.js')}}"></script>
    <script src="{{URL::asset('/js/changeprice.js')}}"></script>
    @can('is_store',new \App\User())
        @if(Auth::user()->store_id == null)
            <script src="{{URL::asset('/js/storeowner.js')}}"></script>
        @endif
     @endcan
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @if (Auth::guest())
                        &nbsp;<li><a href="{{ url('/'.$language) }}">Store</a></li>
                        @endif
                        @can('is_store',new \App\User())
                            @if(Auth::user()->store_id == null)
                                <li><a href="{{ url('/'.$language.'/updatedproductbyadmin') }}">Updated Product By Admin</a><i class="notification" style="float: right; margin-top: -34px;"></i></li>
                                <li><a href="{{ url('/'.$language.'/store_owner') }}">Home</a></li>
                                <li><a href="{{ url('/'.$language.'/addtypes') }}">Add</a></li>
                                    @if(Session::has('Admin') !== true)
                                        <li><a href="{{ url('/'.$language.'/products') }}">Add Products</a></li>
                                    @endif
                                <li><a href="{{ url($language.'/seeproducts') }}">See Products</a></li>
                                <li><a href="{{ url($language.'/makestoreworkers') }}">Make Store Workers</a></li>
                                <li><a href="{{ url($language.'/bouthproducts') }}">Bought products</a></li>
                                <li><a href="{{ url($language.'/store_chat') }}">Chat</a></li>
                             @else
                                    <li><a href="{{ url($language.'/store_worker') }}">Home</a></li>
                                    <li><a href="{{ url($language.'/seeproductwithworkers') }}">Seeproducts</a></li>
                             @endif
                         @endcan
                            @can('is_admin',new \App\User())
                                <li><a href="{{ url('/'.$language.'/admin') }}">Admin</a></li>
                                <li><a href="{{ url('/'.$language.'/seeproductswithAdmin') }}">See Products</a></li>
                                <li><a href="{{ url('/'.$language.'/shops') }}">Shops</a></li>
                                <li><a href="{{ url('/'.$language.'/messages') }}">Messages</a></li>
                            @endcan
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url($language.'/login') }}">Login</a></li>
                            <li><a href="{{ url($language.'/register') }}">Register</a></li>

                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a class="logoutform" href="{{ url($language.'/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        @if(session()->has('Admin'))
                                            <a href="{{ url($language.'/backadmin') }}">Go back to Admin panel</a>
                                        @endif

                                        <form id="logout-form" action="{{ url($language.'/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')

    </div>

    <!-- Scripts -->

</body>
</html>
