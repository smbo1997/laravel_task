<html>
<head>
    <style>
        body{
            background-color: whitesmoke;
        }
        .button {
            display: inline-block;
            border-radius: 4px;
            background-color: #f4511e;
            border: none;
            color: #FFFFFF;
            text-align: center;
            font-size: 28px;
            padding: 20px;
            width: 200px;
            transition: all 0.5s;
            cursor: pointer;
            margin: 5px;
        }

        .button span {
            cursor: pointer;
            display: inline-block;
            position: relative;
            transition: 0.5s;
        }

        .button span:after {
            content: '\00bb';
            position: absolute;
            opacity: 0;
            top: 0;
            right: -20px;
            transition: 0.5s;
        }

        .button:hover span {
            padding-right: 25px;
        }

        .button:hover span:after {
            opacity: 1;
            right: 0;
        }
    </style>
</head>
<body>
<div>
    <div style="width: 500px;margin-left: 420px;margin-top: 80px">
        <h1 style="color:greenyellow;margin: 0px auto;">Please Acctivate Your Account</h1>
        <a class="button" style="vertical-align:middle; margin-left:79px;margin-top:10px" href="{{url('/'.$lang.'/activated/'.$id)}}"><span>Activate </span></a>
    </div>
</div>
</body>
</html>


