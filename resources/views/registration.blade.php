<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <style>
        li {
                list-style-type: none;
            }
            li:before {
                content: "! ";
                color:red;
        }
        body {
                font-family: algerian, serif;
                background: #E8EFF8;
            }    
        .form-slider {
            position: relative;
            width: 100%;
            height: auto;
        }
        .form {
            margin: 0 auto;
            width: 500px;
            margin-top: 150px;
         }

        .form-slide {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            transition: opacity 0.5s;
        }
        .form-slide.active {
            display: block;
            opacity: 1;
        }

        .form-nav {
            text-align: center;
            margin-top: 20px;
        }
        .input {
                display: block;
                text-align:center;
                font-size: 25px;
                width: 400px;
                height: 20px;
                margin-bottom: 20px;
                border-radius: 15px;
                background-color: #BDCDDD;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                border: 1px solid #ccc;
                font-family: inherit;
                font-size: 16px;
            }
            .reg{
                padding-left: 135px;
                padding-bottom:25px;
                width: 500px;
                font-size: 27px;
            }
            .btn {
                width: 20%;
                height: 25px;
                padding-left: 8px;
                margin-left:155px;
                margin-bottom:10px;
                border-radius: 15px;
                background-color: #F7F0C6;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                border: 0;
                font-family: algerian, serif;
                font-size: 18px;
            }
            .btn_reg{
                width: 35%;
                height: 25px;
                padding-left: 8px;
                margin-left:120px;
                margin-bottom:10px;
                border-radius: 15px;
                background-color: #F7F0C6;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                border: 0;
                font-family: algerian, serif;
                font-size: 18px;
            }
    </style>
    </head>
    <body>
    <form class="form" action="/registration" method="POST">
            @csrf
            <ul>
                @foreach($errors->all() as $message)
                    <li>{{$message}}</li>
                @endforeach
            </ul>    
        <div class="container mt-5">
            <div class="reg">
                Регистрация
            </div>
            <div class="form-slider">
                <div class="form-slide active">
                    <input name="name" class="input" type="text" placeholder="Ваше имя">
                    <input name="email" class="input" type="email" placeholder="Ваш e-mail">
                    <input name="phone_number" class="input" type="tel" placeholder="Ваш телефон">
                    <input name="password" class="input" type="password" placeholder="Пароль">
                    <input name="password_confirmation" class="input" type="password" placeholder="Пароль еще раз">
                    <button type="button" class="btn btn-primary next-slide">Далее</button>
                </div>
                <div class="form-slide">
                    <input name="date_of_birth" class="input" type="date" placeholder="Дата рождения">
                    <select name="gender" class="input" required>
                        <option value="">Выберите пол</option>
                        <option value="M">Мужской</option>
                        <option value="F">Женский</option>
                    </select>
                    <input name="height" class="input" type="number" placeholder="Рост (см)">
                    <input name="weight" class="input" type="number" placeholder="Вес (кг)">
                    <button type="submit" class="btn_reg btn-primary">Зарегистрироваться</button>
                    <button type="button" class="btn btn-secondary prev-slide">Назад</button>
                </div>
            </div>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            var currentSlide = 1;
            var totalSlides = $(".form-slide").length;

            $(".next-slide").click(function() {
                currentSlide++;
                showSlide(currentSlide);
            });

            $(".prev-slide").click(function() {
                currentSlide--;
                showSlide(currentSlide);
            });

            function showSlide(n) {
                $(".form-slide").removeClass("active");
                $(".form-slide:nth-child(" + n + ")").addClass("active");

                if (n == 1) {
                    $(".prev-slide").prop("disabled", true);
                } else {
                    $(".prev-slide").prop("disabled", false);
                }

                if (n == totalSlides) {
                    $(".next-slide").hide();
                } else {
                    $(".next-slide").show();
                }

                if (n > totalSlides) {
                    currentSlide = totalSlides;
                    showSlide(currentSlide);
                }
            }
            showSlide(currentSlide);
        });
    </script>
</body>
</html>