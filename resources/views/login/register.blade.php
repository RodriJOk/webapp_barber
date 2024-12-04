<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('icons/cuidado.png') }}" type="image/x-icon">
        <title>Inicio de Session</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
            body{
                font-family: Verdana, Geneva, Tahoma, sans-serif;
                margin: 0px;
                padding: 0px;
                box-sizing: border-box;
            }
            .container{
                display: flex; 
                flex-direction:row;
                width: 100wv; 
                height: 100vh;
            }
            .form{
                background-color: #000a23; 
                color:white; 
                padding:20px; 
                width:40%;
            }
            .form_header .container_title{
                /* margin: 40px 0px 30px; */
                display:none;
            }
            .form_header .container_title .title{
                text-align: center;
                text-wrap: balance;
            }
            .form_body{
                text-align:center; 
                width:90%; 
                margin: 0 auto;
            }
            .form_item{
                display: flex; 
                flex-direction: column; 
                gap: 10px; 
                margin: 20px 0px;
            }
            .list{
                text-align: center;
                list-style: none;
            }
            .input_nombre,
            .input_email,
            .input_password{
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
            .select_rol{
                margin: 10px auto;
                border: 1px solid #fff; 
                width: 100%;
                font-size: 16px; 
                height: 40px;
                outline: none; 
                text-decoration: none; 
                background: transparent;
                border-radius: 15px;
                padding: 0px 16px;
                color: #fff;
            }
            .select_rol option{
                background-color: #fff;
                color: #000;
            }
            .container_button{
                display: flex; 
                flex-direction:column; 
                gap: 20px;
            }
            .container_button .crear{
                background-color: #012e46;
                color: #fff;
                height: 40px;
                outline: none; 
                text-decoration: none; 
                border: none;
                border-radius: 15px;   
                width: 100%;
                cursor: pointer;
                margin: 15px 0px;
            }
            .container_image{
                width: 60%; 
                height: 100vh;
            }
            .container_image .image{
                width: 100%; 
                height: 100%; 
                background-size: cover;
            }
            .container_password{
                position: relative;
            }
            .container_password .view_password_button{
                position: absolute; 
                right:10px; 
                top: 55%; 
                text-decoration:none; 
                border:none; 
                background-color:transparent;
            }
            @media screen and (max-width: 768px){
                .container_image{
                    display: none;
                }
                .form{
                    width: 100%;
                }
                .form_header .container_title{
                    display: block;
                    margin: 15px 0px 40px;
                }
                .input_nombre, 
                .input_email,
                .input_password{
                    width: 90%;
                    margin: 0 auto;
                }
                .select_rol{
                    width: 100%;
                }
            }
        </style>
    </head>
    <body>
        <main class="container">
            <form 
                class="form"
                action="{{ route('create_user') }}" 
                method="POST">
                @csrf
                <header class="form_header">
                </header>
                <div class="form_body">
                    <div class="form_item">
                        <label for="nombre">Nombre y apellido</label>
                        <input 
                            type="nombre" 
                            name="nombre" 
                            id="nombre"
                            class="input_nombre"
                            placeholder="Ingresa tu nombre y apellido"
                            required
                            autocomplete="off">
                    </div>
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
                    <div class="form_item container_password">
                        <label for="password">Contraseña</label>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            class="input_password"
                            placeholder="Contraseña"
                            required
                            autocomplete="off">
                        <button
                            class="view_password_button" 
                            onclick="toggle_visibility('password', 'password_icon')"
                            type="button">
                            <img 
                                id="repeat_password_icon" 
                                src="{{asset('icons/visibility.png')}}" 
                                alt="Mirar la repeticion de la contraseña" 
                                width="15" 
                                height="15">
                        </button>
                    </div>
                    <div class="form_item">
                        <label for="rol">Seleccione el usuario</label>
                        <select name="rol" id="rol" class="select_rol" required>
                            <option value="0">Seleccione el usuario</option>
                            <option value="1">Administrador</option>
                            <option value="2">Colaborador</option>
                            <option value="3">Cliente</option>
                        </select>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="container_button">
                        <button 
                            class="crear"
                            type="submit">
                            Crear usuario
                        </button>
                    </div>
                </div>
            </form>
            <section class="container_image">
                <img src="{{asset('images/login.jpg')}}" alt="login" class="image">
            </section>
        </main>
    </body>
    <script>
        function toggle_visibility(id, id_icon){
            let form = document.getElementsByClassName('form')[0];
            form.addEventListener('submit', function(event){
                event.preventDefault();
            });

            let input = document.getElementById(id);
            let icon = document.getElementById(id_icon);
            
            if(input.value != ""){
                if(input.type == "password"){
                    input.type = "text";
                    icon.src = "{{asset('icons/visibility_off.png')}}";
                }else{
                    input.type = "password";
                    icon.src = "{{asset('icons/visibility.png')}}";
                }
            }
        }
    </script>
</html>