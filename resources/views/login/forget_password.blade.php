<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="https://webappbarber-56b0944e3615.herokuapp.com/icons/cuidado.png" type="image/x-icon">
        <title>Olvide la contraseña</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <style>
            body{
                font-family: Verdana, Geneva, Tahoma, sans-serif;
                margin: 0px;
                padding: 0px;
                box-sizing: border-box;
            }
            .container{
                width: 100wv; 
                height: 100vh; 
                display: flex; 
                flex-direction:row;
            }
            .form{
                background-color: #000a23; 
                color:white; 
                padding:20px; 
                width:40%;
            }
            .form_header{
                padding-bottom: 20px;
            }
            .container_title{
                margin: 40px 0px 30px;
            }
            .title{
                text-align: center;
                font-size: 26px;
                text-wrap: balance;
            }
            .form_body{
                text-align:center; 
                width:90%; 
                margin: 0 auto;
            }
            .container_email{
                display: flex; 
                flex-direction: column; 
                gap: 20px; 
                margin: 20px 0px;
            }
            .input_email{
                margin: 10px auto;
                border: 1px solid #fff; 
                color: #fff; 
                width: 92%; 
                font-size: 16px; 
                height: 40px;
                outline: none; 
                text-decoration: none; 
                background: transparent;
                border-radius: 15px;
                padding: 0px 16px;
            }
            .container_button{
                display: flex; 
                flex-direction:column; 
                gap: 20px; 
                margin: 20px 0px;
            }
            .container_button .btn_submit{
                width: 100%;
                background-color: #012e46;
                color: #fff;
                height: 40px;
                outline: none; 
                text-decoration: none; 
                border: none;
                border-radius: 15px;
                font-size: 16px;
            }
            .container_button .btn_submit:hover{
                background-color: #023a58;
                color: #fff;
            }
            .container_image{
                width: 60%; 
                height: 100vh;
            }
            .container_image img{
                width: 100%; 
                height: 100%; 
                background-size: cover;
            }
            @media screen and (max-width: 768px){
                .container{
                    flex-direction: column;
                    overflow-x: hidden;
                    overflow-y: hidden;
                }
                .form{
                    width: 100vw;
                    height: 100vh;
                    padding: 0px;
                }
                .form_header{
                    margin: 0 auto;
                }
                .header{
                    margin: 40px 0px;
                }
                .container_image{
                    display: none;
                }
                .input_email{
                    width: 90%;
                }
            }
        </style>
    </head>
    <body>
        <main class="container">
            <form class="form" action="{{ route('reset_password') }}" method="POST">
                @csrf
                <header class="form_header">
                    <div class="container_title">
                        <h1 class="title">
                            Por favor, ingresa el email con el que te registraste.
                        </h1>
                    </div>
                </header>
                <div class="form_body">
                    <div class="container_email">
                        <label for="email">Email</label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email"
                            class="input_email"
                            placeholder="Ingresa tu email"
                            required
                            autocomplete="off">
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="container_button">
                        <button type="submit" class="btn_submit">
                            Enviar
                        </button>
                    </div>
                </div>
            </form>
            <section class="container_image">
                <img src="{{asset('images/login.jpg')}}" alt="login">
            </section>
        </main>
    </body>
</html>