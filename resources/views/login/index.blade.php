<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('icons/cuidado.png') }}" type="image/x-icon">
        <title>Inicio de Session</title>
        <link rel="stylesheet" href="{{ asset('layout/sidebar.css') }}">
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
            .main{
                width: 100wv; 
                height: 100vh;
            }
            .container_section{
                display: flex; 
                flex-direction:row;
            }
            .form{
                background-color: #000a23; 
                color:white; 
                padding:20px; 
                width:40%;"
            }
            .header{
                padding-bottom: 20px;
            }
            .container_title{
                margin: 40px 0px 30px;
            }
            .title{
                text-align: center;
                text-wrap: balance;
            }
            .list{
                text-align: center;
                list-style: none;
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
            .buttons{
                display: flex; 
                flex-direction:column; 
                gap: 20px;
            }
            .buttons .container_forget_password .forget_password{
                color: #fff; 
                text-decoration: none;
            }
            .buttons .container_forget_password .forget_password:hover{
                color: #fff;
                text-decoration: underline;
            }
            .buttons .container_login{
                display: flex; 
                flex-direction: row; 
                gap:15px;
            }
            .container_login .login{
                background-color: #012e46;
                color: #fff;
                height: 40px;
                outline: none; 
                text-decoration: none; 
                border: none;
                border-radius: 15px;   
                width: 50%;
                cursor: pointer;
            }
            .container_login .login:hover{
                background-color: #023a58;
                color: #fff;
            }
            .container_login .register{
                background-color: #012e46;
                color: #fff;
                height: 40px;
                outline: none; 
                text-decoration: none; 
                border: none;
                border-radius: 15px;   
                width: 50%;
                cursor: pointer;
            }
            .container_login .register:hover{
                background-color: #023a58;
                color: #fff;
            }
            .container_image{
                width: 60%; height: 100vh;
            }
            .container_image img{
                width: 100%; 
                height: 100%; 
                background-size: cover;
            }
        </style>
    </head>
    <body>
        <div>
            <main class="main">
                <div class="container_section">
                    <form 
                        class="form"
                        action="{{ route('singin') }}" 
                        method="POST">
                        @csrf
                        <header class="header">
                            <div class="container_title">
                                <h1 class="title">Por favor, ingrese sus credenciales</h1>
                            </div>
                        </header>
                        <div style="text-align:center; width:90%; margin: 0 auto;">
                            <div style="display: flex; flex-direction: column; gap: 20px; margin: 20px 0px;">
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
                            <div style="display: flex; flex-direction: column; margin-bottom: 10px;">
                                <label for="password">Contraseña</label>
                                <input 
                                    type="password" 
                                    name="password" 
                                    id="password" 
                                    class="input_email"
                                    placeholder="Contraseña"
                                    required
                                    autocomplete="off">
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="buttons">
                                <div class="container_forget_password">
                                    <a
                                        class="forget_password" 
                                        href="{{ route('forget_password') }}">
                                        Olvide mi contraseña
                                    </a>
                                </div>
                                <div class="container_login">
                                    <button 
                                        class="register"
                                        type="button"
                                        onclick="window.location.href='{{ route('register') }}'">
                                        Registrarme
                                    </button>
                                    <button 
                                        class="login"
                                        type="submit">
                                        Ingresar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <section class="container_image">
                        <img src="{{asset('images/login.jpg')}}" alt="login">
                    </section>
                </div>
            </main>
        </div>
    </body>
</html>