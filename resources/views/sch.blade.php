<div class="delete">
    @if(!empty($result))
        @if($oper == 1 || $oper == 3)
            @foreach($result as $k=>$v)
                <div class="find-ph">
                    <div style="width: 100%;text-align: center" class="d-flex justify-content-center">
                        <span style="font-size: 25px;">Школа: {{$k}}</span>
                    </div>
                    <div class="info">
                        <span style="font-weight: bold;color: #1d68a7;font-size: 18px">Информация</span>
                        @if(isset($v['info']))
                            <p>{{$v['info']}}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        @elseif($oper == 2)
            @foreach($result as $k=>$v)
                <div class="find-ph">
                    <div style="width: 100%;text-align: center" class="d-flex justify-content-center">
                        <span style="font-size: 25px;">Школа: {{$k}}</span>
                    </div>
                    <div class="info">
                        <span style="font-weight: bold;color: #1d68a7;font-size: 18px">Информация</span>
                        @if(isset($v['info']))
                            <p>{{$v['info']}}</p>
                        @else
                            <div>
                                <span>Нет информации</span>
                            </div>
                        @endif
                    </div>
                    <div class="countic">
                        @if(isset($v['count']))
                            <span>Кол-во последователей: {{$v['count']}}</span>
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    @else
        <div>
            <span>Ничего не найдено</span>
        </div>
    @endif
</div>
