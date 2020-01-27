<div class="delete">
    @if(!empty($result))
        @foreach($result as $k=>$v)
            <div class="find-ph">
                <div style="width: 100%;text-align: center" class="d-flex justify-content-center">
                    <span style="font-size: 25px;">Филосов: {{$k}}</span>
                </div>
                <div class="info">
                    <span style="font-weight: bold;color: #1d68a7;font-size: 18px">Биография</span>
                    <p>{{$v['info']}}</p>
                </div>
                <div class="school">
                    @if(isset($v['school']))
                        <span style="font-weight: bold;color: #1d68a7;font-size: 18px">Школа(ы)</span>
                        <ul>
                            @foreach($v['school'] as $sc)
                                <li>{{$sc}}</li>
                            @endforeach
                        </ul>
                        @elseif($school == 1)
                        <div>
                            <div>
                                <span style="font-weight: bold;color: #1d68a7;font-size: 18px">Школа(ы)</span>
                            </div>
                            <span>нет информации</span>
                        </div>
                    @endif
                </div>
                <div class="definitions">
                    @if(isset($v['def']))
                        <span style="font-weight: bold;color: #1d68a7;font-size: 18px">Определение(я)</span>
                        <ul>
                            @foreach($v['def'] as $i => $d)
                                <li>{{$i}} - {{$d}}</li>
                            @endforeach
                        </ul>
                    @elseif($def == 1)
                        <span style="font-weight: bold;color: #1d68a7;font-size: 18px">Определение(я)</span>
                        <div>
                            <span>нет информации</span>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <div>
            <span>Ничего не найдено</span>
        </div>
    @endif
</div>
