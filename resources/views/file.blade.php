<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <style>
        html {
            overflow: scroll;
        }
        body {
            font-family: algerian, serif;
            font-size: 16px;
            background-image: url('{{ asset('img/Gradient.jpg') }}');
            background-size: 1700px 1500px;
            background-repeat: no-repeat; /* Не повторяем картинку */
            background-position: center; /* Центрируем картинку */
        }
        .icon-bar {
            width: 80px;
            height: 300px;
            background-color: #335eb5d8;
            box-shadow: inset 0 5px 10px rgba(0, 0, 0, 0.2), /* Верхняя тень */
                        inset 5px 0 10px rgba(0, 0, 0, 0.2); /* Левая тень */
            border-radius: 0px 0 10px 0; /* Верхние углы 10px, нижние 0 */
          
        }
        .icon-bar a {
            display: block;
            text-align: center;
            padding-top:16px;
            padding-bottom: 10px;
            transition: all 0.3s ease;
            color: white;
            font-size: 36px;
        }
        .icon-bar a:hover {
            background-color: #000;
        }
        .active {
            background-color: #eeeeee !important;
        }
        .container {
            display: flex;
        }
        .item {
            flex: 1;
            margin: 0px;
            text-align: center;
            padding: 20px;
        }
        .img{
                width: 40px; 
                height: 40px;
        }
        .input-file {
            position: relative;
            display: inline-block;
        }
        .input-file span {
            position: relative;
            display: inline-block;
            cursor: pointer;
            outline: none;
            text-decoration: none;
            font-size: 14px;
            vertical-align: middle;
            color: #eeeeee;
            text-align: center;
            border-radius: 7px;
            background-color: black;
            line-height: 22px;
            height: 40px;
            padding: 10px 20px;
            box-sizing: border-box;
            border: none;
            margin: 0;
            transition: background-color 0.2s;
        }
        .input-file input[type=file] {
            position: absolute;
            z-index: -1;
            opacity: 0;
            display: block;
            width: 0;
            height: 0;
        }
        .input-file:hover span {
            background-color: #335eb5d8;
        }
        .calendar-container{
            margin:50px 50px 50px 145px;
            width: 80%;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: auto;
            color:#eeeeee;
        }

        th, td {
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .current-month {
            font-weight: bold;
        }
        .calendar-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            color: #eeeeee;
        }

        .calendar-controls a {
            text-decoration: none; /* Убираем подчеркивание у ссылок */
            margin-left:110px;
            margin-right:110px;
        }
        a:visited {
            color: inherit; /* Цвет ссылки такой же, как у обычного текста */
            text-decoration: none; /* Убираем подчеркивание */
        }
        .has-training {
        background-color: #eeeeee;
        color: black;
    }
        .training-info {
            display: block;
            text-align: center;
            font-size: 12px;
        }
        thead{
            color:black;
        }
        .input-file button{
                display: block;
                width: 60%;
                padding: 6px;
                margin: 15px 40px 10px;
                border-radius: 15px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                border: 0;
                font-family: algerian, serif;
                font-size: 16px;
                background-color: black;
                color: #eeeeee;
                text-align:center;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="icon-bar" class="item"> 
        <a href="/"><img class="img" src="{{ asset('img/home.jpg')}}"></a> 
        <a href="/show/profile"><img class="img" src="{{ asset('img/profile.png')}}"></a> 
        <a class="active" href="/loading/file"><img class="img" src="{{ asset('img/trainings.png')}}" ></a> 
        <a href="/my/training"><img class="img" src="{{ asset('img/statistic.png')}}"></a>
    </div>
    <div class="item">
        <div class="calendar-container">
            <div class="calendar-controls">
                <a  href="{{ route('calendar', ['year' => $prevMonth->year, 'month' => $prevMonth->month]) }}">
                    &lt;&lt; {{ $prevMonth->format('F Y') }}
                </a>
                <h2>{{ $date->format('F Y') }}</h2>
                <a href="{{ route('calendar', ['year' => $nextMonth->year, 'month' => $nextMonth->month]) }}">
                    {{ $nextMonth->format('F Y') }} &gt;&gt;
                </a>
            </div>
            <table>
                <thead>
                    <tr>
                        @foreach ($daysOfWeek as $day)
                            <th>{{ $day }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($calendar as $week)
                        <tr>
                            @foreach ($week as $day)
                                @if ($day)
                                    @php
                                        $trainingDate = $date->copy()->day($day)->format('Y-m-d');
                                        $training = $trainings->where('date', $trainingDate)->first();
                                    @endphp
                                    <td class="{{ $day ? 'current-month' : '' }} {{ $training ? 'has-training' : '' }}">
                                        {{ $day }}
                                        @if ($training)
                                            <div class="training-info">
                                            </div>
                                        @endif
                                    </td>
                                @else
                                    <td></td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <form action="{{ route('trainings.import') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label class="input-file">
                <input type="file" name="file" accept=".json">
                <span type="submit">Добавить новую тренировку</span>
                <button type="submit">Загрузить</button>
            </label> 
        </form>
        </div>
</div>    
</body>
</html>

