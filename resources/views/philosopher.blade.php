@extends('layouts.master')

@section('header')
    @parent
@stop
<script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('/css/ph.css') }}">
<script type="text/javascript" src="{{ asset('/js/ph.js') }}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
    <div class="philop">
        <div class="add-ph-btn">
            <button class="btn btn-dark">Добавить филосова</button>
        </div>
        <div class="ph-info">
            <div class="d-flex justify-content-center">
                <label style="font-size: 20px" class="mr-4" for=".find-ph">Посик философа</label>
                <input style="width: 400px;" class="find-ph" title="введите имя" type="text">
            </div>
            <div class="d-flex justify-content-center mt-5">
                <input style="margin-top: 5px" class="with-school mr-2" type="checkbox">
                <label for=".with-school">Показать школы</label>
                <input style="margin-top: 5px" class="with-defin ml-4 mr-2" type="checkbox">
                <label for=".with-defin">Показать понятия</label>
            </div>
            <div style="margin-top: 40px" class="d-flex justify-content-start ph-zone">

            </div>
        </div>
        <div class="add-ph d-none">
            <div class="mt-5 d-flex justify-content-center">
                <h2>Ввод данных самостоятельно</h2>
            </div>
            <div class="mt-1 d-flex flex-column justify-content-center">
                <label for="exampleInputEmail1">Имя</label>
                <input style="" type="email" class="form-control mb-2" id="name-ph"
                       aria-describedby="emailHelp" placeholder="Введите имя">
                <label for="exampleInputPassword1">Информация</label>
                <input type="text" class="form-control mb-2" id="info-ph" placeholder="Введите информацию">
                <div class="form-group">
                    <label for="inputState">Школа</label>
                    <select id="school-ph" class="form-control">
                        <option selected>Choose...</option>
                        @foreach($school as $s)
                            <option>{{$s}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button class="btn btn-dark sub-ph">Сохранить</button>
                </div>

            </div>
        </div>
    </div>
@stop
