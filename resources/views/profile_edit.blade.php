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
        * {box-sizing: border-box;}
        body {
            font-family: algerian, serif;
            font-size: 16px;
            background: #326fc9;
        }
        .input {
                font-size: 25px;
                width: 400px;
                height: 25px;
                margin-bottom: 20px;
                border-radius: 15px;
                background-color: #eeeeee;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                border: 1px solid #ccc;
                font-size: 16px;
                text-align:left;
                padding-left: 10px;
                padding-top: 2px;
            }
        .steps{
            width: 95.5%;
            height:200px;
        }
        li {
            list-style-type: none;
        }
        li:before {
            content: "! ";
            color:red;
        }
        .form {
            background: #ffffff;
            margin-top: 30px;
            position: fixed; top: 50%; left: 50%;
            transform: translate(-50%, -50%);
        }
        .reg{
            left:210px;
            top:30px;
            font-size: 20px;
            position: relative;
        }
        .btn {
                background-color: black;
                color: #eeeeee;
                width: 200px;
                height: 25px;
                margin-top: 15px;
                margin-bottom: 100px;
                border-radius: 15px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                border: 0;
                font-size: 15px;
                text-align:center;
                padding-top: 2px;
            }  
        img{
            height: 180px;
            width: 180px;
            border-radius: 15px;
            position: relative;
            top:40px;
            left:210px;
            object-fit: cover;
        }
        .input-file span {
            position: relative;
            top: 80px;
            left: 48px;
            border: 1px solid #BDCDDD;
            font-size: 14px;
            vertical-align: middle;
            text-align: center;
            border-radius: 15px;
            background-color: #BDCDDD;
            height: 25px;
            padding: 10px 20px;
            box-sizing: border-box;
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
            background-color: #A6CAF0;
        }
        .container{
            background-color: #ffffff;
            border-radius: 15px;
            display: flex;
            flex-wrap: wrap;
            margin: 70px 350px;
            padding-bottom: 30px;
            
            height: 620px;
        }
        .text{
            position: relative;
            top: 100px;
            left: 150px;
        }
        .password{
            text-decoration-color:white;
        }
         .img_header{
            width: 30px;
            height: 30px;
            border: none;
            background-color: transparent;
            cursor: pointer;
            border-radius: 0px;
        }
        .img_header:hover {
            background-color: #BDCDDD;
            border-radius: 15px;
        }
    </style>
</head>
<body scroll="no">
<div class="container">
    @foreach($users as $user)
        <form enctype="multipart/form-data" action="/edit/profile{{$user->id}}" method="POST">
            @csrf
            @method('PUT')
            <div class="reg">Отредактируйте ваш профиль:</div>
            <ul>
                @foreach($errors->all() as $message)
                    <li>{{$message}}</li>
                @endforeach
            </ul>
            <div >
                <label class="input-file">
                    <input type="file" name="photo">
                        @isset($user->photo)
                            <img src="{{ asset('storage/' . $user->photo) }}" alt="{{$user->name}}">
                        @endisset
                    <span>Выберите файл</span>
                </label>
            </div>
            <div class="text">
                <textarea name="name" class="input" placeholder="Редактировать название">{{$user->name}}</textarea>
                <textarea name='email' class="input">{{$user->email}}</textarea>
                <textarea name='phone_number' class="input">{{$user->phone_number}}</textarea>
                <select name="gender" class="input" >
                    <option>Изменить пол: Женский</option>
                    <option value="M">Мужской</option>
                    <option value="F">Женский</option>
                </select>
                <textarea name='height' class="input">{{$user->height}}</textarea>
                <textarea name='weight' class="input">{{$user->weight}}</textarea>
                <input name="password" class="input" type="password" placeholder="Пароль">
                <input name="password_confirmation" class="input" type="password" placeholder="Пароль еще раз">
            </div>
            <button class="btn" type="submit">Сохранить</button>
            @endforeach
        </form>
</div>
</body>
</html>







