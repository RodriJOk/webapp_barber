<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="shortcut icon" href="https://webappbarber-56b0944e3615.herokuapp.com/icons/cuidado.png" type="image/x-icon">
        <title>Inicio de Session</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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
            .section{
                text-align: center; 
                width: 90%; 
                margin: 0 auto;
            }
            .form_item{
                display: flex; 
                flex-direction: column; 
                gap: 20px; 
                margin: 20px 0px;
            }
            .form_item .container_password{
                position: relative;
            }
            .container_password .view_password_button{
                position: absolute; 
                right:10px; 
                top:calc(50% - 8px); 
                text-decoration:none; 
                border:none; 
                background-color:transparent;
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
                        <div class="section">
                            <div class="form_item">
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
                            <div class="form_item">
                                <label for="password">Contraseña</label>
                                <div class="container_password">
                                    <input 
                                        type="password" 
                                        name="password" 
                                        id="password" 
                                        class="input_email"
                                        placeholder="Contraseña"
                                        required
                                        autocomplete="off">
                                    <button 
                                        class="view_password_button" 
                                        onclick="toggle_visibility('password', 'repeat_password_icon')"
                                        type="button">
                                        <img 
                                            id="repeat_password_icon" 
                                            src="{{asset('icons/visibility.png')}}" 
                                            alt="Mirar la repeticion de la contraseña" 
                                            width="15" 
                                            height="15">
                                    </button>
                                    
                                </div>
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
                                        onclick="send_form()"
                                        class="login"
                                        type="button">
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
    <script>
        function toggle_visibility(element, icon){
            let form = document.getElementsByClassName('form')[0];
            form.addEventListener('submit', function(event){
                event.preventDefault();
            });

            let input = document.getElementById(element);
            let iconElement = document.getElementById(icon); // Cambiado aquí

            if(input.value != ""){
                if(input.type == 'password'){
                    iconElement.src = '{{asset('icons/visibility_off.png')}}';
                    input.type = 'text';
                } else {
                    iconElement.src = '{{asset('icons/visibility.png')}}';
                    input.type = 'password';
                }
            }
        }
        function send_form(){
            let form = document.getElementsByClassName('form')[0];
            let email = document.getElementById('email');
            let password = document.getElementById('password');
            if(email.value == "" || password.value == ""){
                console.log('Por favor, complete los campos');
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr.error('Por favor, complete los campos');
                return;
            }
            form.submit();
        }
    </script>
</html>