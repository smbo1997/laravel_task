



<!DOCTYPE html>
<html>
<head>
    <title>Page Not Found.</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #000000;
            display: table;
            font-weight: 100;
            font-family: 'Lato', sans-serif;
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 72px;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <h1 class="huge">404</h1>
        <hr class="sm">
        <p><strong>Sorry - Page Not Found!</strong></p>
        <p>The page you are looking for was moved, removed, renamed<br>or might never existed. You stumbled upon a broken link :(</p>
        <p>Go to Login page <h2><a href="{{URL::asset('/'.$lang.'/login/')}}">Login</a></h2></p>
    </div>
</div>
</body>
</html>
