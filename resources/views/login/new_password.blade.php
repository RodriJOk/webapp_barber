<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link 
            rel="shortcut icon" 
            href="{{ asset('icons/cuidado.png') }}"
            type="image/x-icon">
        <title>Nueva contraseña</title>

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
            .form_new_password{
                background-color: #000a23; 
                color:white; 
                padding:20px; 
                width:40%;
            }
            .container_title{
                margin: 40px 0px 30px;
            }
            .title{
                text-align: center;
                font-size: 26px;
                text-wrap: balance;
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
            .list{
                text-align: center;
                list-style: none;
            }
        </style>
    </head>
    <body>
        <div>
            <main class="main">
                <div style="display: flex; flex-direction:row;">
                    <form 
                        id="form_new_password"
                        class="form_new_password"
                        action="{{ route('save_new_password') }}" 
                        method="POST"
                        onsbumit="sendForm(event)">
                        @csrf
                        <header style="padding-bottom: 20px;">
                            <div class="container_title">
                                <h1 class="title">
                                    Ingresa tu nueva contraseña
                                </h1>
                            </div>
                        </header>
                        <div style="text-align:center; width:90%; margin: 0 auto;">
                            <ul style="text-decoration:none; text-align:start; list-style:none;">
                                <li>
                                    <span id="pass_length" style="color:red;">
                                        Debe tener entre 10 y 50 caracteres
                                    </span>
                                </li>
                                <li>
                                    <span id="pass_min_lower" style="color:red;">
                                        (Obligatorio) Minimo 4 minusculas
                                    </span>
                                </li>
                                <li>
                                    <span id="pass_min_upper" style="color:red;">
                                        (Obligatorio) Minimo 2 mayusculas
                                    </span>
                                </li>
                                <li>
                                    <span id="pass_min_number" style="color:red;">
                                        (Obligatorio) Minimo 2 numeros
                                    </span>
                                </li>
                                <li>
                                    <span id="pass_match" style="color:red;">
                                        (Obligatorio) Las claves deben coincidir
                                    </span>
                                </li>
                                <li>
                                    <span id="pass_other_chars" style="color:yellow;">
                                        (Opcional) Caracteres especiales: <b>.!$%&*_-#</b>
                                    </span>
                                </li>
                            </ul>
                            <div style="display:flex; flex-direction:column; gap: 10px; margin: 20px 0px;">
                                <label for="password">Email</label>
                                <input 
                                    type="email"
                                    name="email"
                                    class="input_email"
                                    required
                                    placeholder="Ingresa tu email con el que te registraste"
                                    value=""
                                    autocomplete="off">
                            </div>
                            <div style="display: flex; flex-direction: column; gap: 10px; margin: 20px 0px;">
                                <label for="password">Contraseña</label>
                                <div style="position: relative;">
                                    <input 
                                        type="password" 
                                        name="password" 
                                        id="password"
                                        class="input_email"
                                        placeholder="Ingresa tu nueva clave"
                                        required
                                        autocomplete="off"
                                        onkeyup="validatePassword('password')"
                                        maxlength="50"
                                        minlength="10">
                                    <button 
                                        style="position: absolute; right:10px; top:calc(50% - 8px); text-decoration:none; border:none; background-color:transparent;" 
                                        onclick="toggle_visibility('password', 'password_icon')"
                                        type="button">
                                        <img id="password_icon" src="{{asset('icons/visibility.png')}}" alt="eye" style="width: 15px; height: 15px;">
                                    </button>
                                </div>
                                <label for="repeat_password">Repita su contraseña</label>
                                <div style="position: relative;">
                                    <input 
                                        type="password" 
                                        name="repeat_password" 
                                        id="repeat_password"
                                        class="input_email"
                                        placeholder="Repeti tu nueva clave"
                                        required
                                        autocomplete="off"
                                        onkeyup="validatePassword('repeat_password')"
                                        maxlength="50"
                                        minlength="10">
                                    <button 
                                        style="position: absolute; right:10px; top:calc(50% - 8px); text-decoration:none; border:none; background-color:transparent;" 
                                        onclick="toggle_visibility('repeat_password', 'repeat_password_icon')"
                                        type="button">
                                        <img id="repeat_password_icon" src="{{asset('icons/visibility.png')}}" alt="eye" style="width: 15px; height: 15px;">
                                    </button>
                                </div>
                            </div>
                            <div style="display: flex; flex-direction:column; gap: 10px; margin: 20px 0px;">
                                <button 
                                    onclick="sendForm(event)"
                                    type="submit"
                                    style="
                                        width: 100%;
                                        background-color: #012e46;
                                        color: #fff;
                                        height: 40px;
                                        outline: none; 
                                        text-decoration: none; 
                                        border: none;
                                        border-radius: 15px;
                                        font-size: 16px;">    
                                    Guardar contraseña
                                </button>
                            </div>
                        </div>
                    </form>
                    <section style="width: 60%; height: 100vh;">
                        <img src="{{asset('images/login.jpg')}}" alt="login" style="width: 100%; height: 100%; background-size: cover;">
                    </section>
                </div>
            </main>
        </div>
    </body>

    <script>
        function validatePassword(input){
            let password = document.getElementById(input).value;
            let pass_length = document.getElementById('pass_length');
            let pass_min_lower = document.getElementById('pass_min_lower');
            let pass_min_upper = document.getElementById('pass_min_upper');
            let pass_min_number = document.getElementById('pass_min_number');
            let pass_match = document.getElementById('pass_match');
            let pass_other_chars = document.getElementById('pass_other_chars');
            let validate_password = true;

            if(password.length < 10 || password.length > 50){
                pass_length.style.color = 'red';
                validate_password = false;
            }else{
                pass_length.style.color = 'green';
                validate_password = true;
            }

            //Validar que la pass tenga al menos 4 minusculas
            let lower_case = password.match(/[a-z]/g);
            if(lower_case == null || lower_case.length < 4){
                pass_min_lower.style.color = 'red';
                validate_password = false;
            }else{
                pass_min_lower.style.color = 'green';
                validate_password = true;
            }

            //Validar que la pass tenga al menos 2 mayusculas
            let upper_case = password.match(/[A-Z]/g);
            if(upper_case == null || upper_case.length < 2){
                pass_min_upper.style.color = 'red';
                validate_password = false;
            }else{
                pass_min_upper.style.color = 'green';
                validate_password = true;
            }

            //Validar que la pass tenga al menos 2 numeros
            let numbers = password.match(/[0-9]/g);
            if(numbers == null || numbers.length < 2){
                pass_min_number.style.color = 'red';
                validate_password = false;
            }else{
                pass_min_number.style.color = 'green';
                validate_password = true;
            }

            //Validar que la pass tenga al menos 1 caracter especial
            let special_chars = password.match(/[.!\$%&*_\-#]/g);
            if(special_chars == null){
                pass_other_chars.style.color = 'yellow';
            }else{
                pass_other_chars.style.color = 'green';
            }

            //Validar que las contraseñas coincidan
            let repeat_password = document.getElementById('repeat_password').value;
            if(password != repeat_password){
                pass_match.style.color = 'red';
                validate_password = false;
            }else{
                pass_match.style.color = 'green';
                validate_password = true;
            }

        }
        function toggle_visibility(element, icon){
            let form = document.getElementById('form_new_password');
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

        function sendForm(event){
            console.log("Estoy en la funcion sendForm");
            let form = document.getElementById('form_new_password');
            form.addEventListener('submit', function(event){
                event.preventDefault();
            });

            let password = document.getElementById('password').value;
            let repeat_password = document.getElementById('repeat_password').value;
            let pass_match = document.getElementById('pass_match');
            if(password != repeat_password){
                pass_match.style.color = 'red';
            }else{
                pass_match.style.color = 'green';
                form.submit();
            }
        }
    </script>
</html>