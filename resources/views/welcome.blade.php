@extends('layouts.master')

@section('header')
    @parent
@stop


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ФП</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            margin: 0;
        }
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }
        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>





@section('content')
    <div style="margin-top: 20%" class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                Филосовские понятия
            </div>
            <div>
                <span>Выполнинли: Любчук, Дайнович, Швайко</span>
            </div>
            <div>
                <span>Проект выполнен в кратчайшие сроки и с высочайшим качестваом</span>
            </div>
        </div>
    </div>
@stop
