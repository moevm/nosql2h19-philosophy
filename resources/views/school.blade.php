@extends('layouts.master')

@section('header')
    @parent
@stop
<script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('/css/school.css') }}">
<script type="text/javascript" src="{{ asset('/js/school.js') }}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
    <div class="philop">
        <div class="add-ph-btn">
            <button class="btn btn-dark">Добавить школу</button>
        </div>
        <div class="ph-info">
            <div class="d-flex justify-content-center">
                <span style="font-size: 25px;font-weight: bold">Поиск школы</span>
            </div>
            <div class="d-flex justify-content-center mt-5">
                <input class="mr-2 countic" type="radio" name="1">
                <label for="">Кол-во последователей больше. чем </label>
                <input  class="ml-2 count-ph" type="number" min="0" >
                <input style="margin-top: 5px" class="max-ph ml-4 mr-2" type="radio" name="1" checked>
                <select style="width: 200px" id="sh-select" class="form-control ml-2">
                    <option selected>кол-во последователей</option>
                    @foreach($school as $s)
                        <option>{{$s}}</option>
                    @endforeach
                </select>
                <input style="margin-top: 5px" class="byph ml-4 mr-2" type="radio" name="1">
                <select style="width: 200px" id="ph-select" class="form-control ml-2">
                    <option selected>Поиск по последователю</option>
                    @foreach($philosopher as $p)
                        <option>{{$p}}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex justify-content-center find-sch mt-4">
                <button style="width: 200px" class="btn btn-dark">Найти</button>
            </div>
            <div style="margin-top: 40px" class="d-flex justify-content-start sch-zone">
            </div>
        </div>
        <div class="add-ph d-none">
            <div class="mt-5 d-flex justify-content-center">
                <h2>Ввод данных самостоятельно</h2>
            </div>
            <div class="mt-1 d-flex flex-column justify-content-center">
                <label for="exampleInputEmail1">Название</label>
                <input style="" type="email" class="form-control mb-2" id="name-sch"
                       aria-describedby="emailHelp" placeholder="Введите название">
                <label for="exampleInputPassword1">Информация</label>
                <input type="text" class="form-control mb-2" id="info-sch" placeholder="Введите информацию">
                <div class="">
                    <label for="inputState">Укажите представителей</label>
                    <ul  class="list-group philops">
                        @foreach($philosopher as $p)
                            <li class="list-group-item"> <input class="mr-1" type="checkbox"><span>{{$p}}</span></li>
                        @endforeach
                    </ul>
                </div>
                <div class="mt-2">
                    <button class="btn btn-dark sub-sch">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
@stop
