@extends('layouts.master')

@section('header')
    @parent
@stop
<script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/import.js') }}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
    <div class="d-flex justify-content-center">
        <h2>Импорт данных в словарь</h2>
    </div>
    <div class="mt-4 d-flex justify-content-center">
        <form method="POST" class=" w-50" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo csrf_token (); ?>">
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
    {{--<div class="d-flex justify-content-center">
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
                <label class="custom-file-label" for="inputGroupFile04">Выберите файл</label>
            </div>
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">Загрузить</button>
            </div>
        </div>
    </div>--}}
    <div class="d-flex justify-content-center mt-5">
        <h2>Экспорт данных из словарь</h2>
    </div>
    <div class="d-flex justify-content-center">
        <div style="width: 100%" class="text-center download-db">
            <button style="width: 50%;height: 40px" class="btn btn-primary">Скачать</button>
        </div>
    </div>


    <div class="d-flex justify-content-center mt-5">
        <h2>Очистить словарь</h2>
    </div>
    <div class="d-flex justify-content-center">
        <div style="width: 100%" class="text-center drop-bd">
            <button style="width: 50%;height: 40px" class="btn btn-dark">Отчистить</button>
        </div>
    </div>
@stop
