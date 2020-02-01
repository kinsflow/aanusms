<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                {{--  background-image: linear-gradient(red, yellow);  --}}
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
                {{--  border-bottom: 2px solid peachpuff;  --}}
            }
            .span{
                font-size: 18px;
                font-family: 'Courier New', Courier, monospace;
                font-weight: bold;
                position: absolute;
                left: 200px;
            }
            .top-left {
                position: absolute;
                left: 10px;
                top: 18px;
                {{--  border-bottom: 2px solid peachpuff;  --}}
            }

            .top{
                border-bottom: 2px solid peachpuff;
            }
            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 19px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="top">
            <div class="top-left">
                <img src="{{ asset('images/eksu.png') }}" alt="eksu logo" srcset="">
            </div>
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
{{--                        @if (Route::has('adminView'))--}}
{{--                            <a href="{{ route('adminView') }}">admin Register</a>--}}
{{--                        @endif--}}
                    @endauth
                </div>
            @endif
        </div>
            <div class="content">
                <div class="title m-b-md">
                    SMS RESULT DISSEMINATION
                </div>
                <span class="span">By Engr. Aanu</span>

                <div class="links">

                </div>
            </div>
        </div>
    </body>
</html>
