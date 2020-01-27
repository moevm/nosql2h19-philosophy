@extends('layouts.master')

@section('header')
    @parent
@stop
<script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('/css/def.css') }}">
<script type="text/javascript" src="{{ asset('/js/def.js') }}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
    <div class="philop">
        <div class="add-def-btn">
            <button class="btn btn-dark">Добавить понятие</button>
        </div>
        <div class="def-info">
            <div class="d-flex justify-content-center">
                <span style="font-size: 25px;font-weight: bold">Определния</span>
            </div>
            <div class="d-flex justify-content-center mt-5">

            </div>
            <div style="margin-top: 40px" class="d-flex justify-content-start def-zone">
                @if(!empty($result))
                    <ul>
                        @foreach($result as $k=>$v)
                            <li><span style="font-size: 20px;color: #1f6fb2">{{$k}}</span> - {{$v['info']}}
                                @if(isset($v['child']))
                                    <ul class="mt-4">
                                        @foreach($v['child'] as $key=>$val)
                                            <li><span style="font-size: 17px;color: #2a9055">{{$key}}</span> - {{$val['info']}}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
        <div class="add-ph d-none">
            <div class="mt-5 d-flex justify-content-center">
                <h2>Ввод данных из файла</h2>
            </div>
            <div class="mt-1 d-flex justify-content-center">
                <form method="POST" class=" w-50" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="custom-file ">
                        <input name="import-file" type="file" class="custom-file-input" id="customFile"
                               accept=".json">
                        <label class="custom-file-label" for="customFile">Выбрать файл</label>
                    </div>
                    <button type="submit" class="float-right mt-3 btn btn-primary download_file">Загрузить</button>
                </form>
                <script>
                    // Add the following code if you want the name of the file appear on select
                    $(".custom-file-input").on("change", function () {
                        let fileName = $(this).val().split("\\").pop();
                        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                    });
                </script>
            </div>
        </div>
    </div>
@stop
