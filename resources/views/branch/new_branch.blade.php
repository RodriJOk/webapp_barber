<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="https://webappbarber-56b0944e3615.herokuapp.com/icons/cuidado.png" type="image/x-icon">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <title>Dar de alta una nueva sucursal</title>
        <style>
            body{
                font-family: Verdana, Geneva, Tahoma, sans-serif;
                margin: 0px;
                padding: 0px;
                box-sizing: border-box;
            }
            .container{
                display: flex; 
                flex-direction: row;
            }
            /* Estilos del navbar */
            .navbar{
                width: 270px;
                background-color: #012e46; 
                color:#fff;
                height: 100vh;
                padding: 20px;
                overflow-y: auto;
                position: fixed;
                z-index: 1000;
            }
            .navbar .header .button_toggle_navbar{
                background: none; 
                border:none;
            }
            .navbar.close{
                width: 60px;
                padding: 20px 5px;
            }
            .header{
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                min-height: 50px;
            }
            .header_title{
                margin: 0px;
                text-align: center;
                font-size: 18px;
            }
            .list{
                list-style: none;
                padding: 0px;
            }
            .list li{
                margin: 10px 0px;
                padding: 10px;
                border-radius: 10px;
                cursor: pointer;
            }
            .list li .item{
                display: flex; 
                flex-direction: row; 
                gap: 10px;
                cursor: pointer;
            }
            .text_link{
                text-decoration: none;
                color: #fff;
            }
            .navbar.close .button_toggle_navbar{
                text-align: center;
                margin: 0px auto;
                background: none; 
                border:none;
            }
            .navbar.close .navbar_image{
                margin: 0px auto;
            }
            .new_branches_container{
                min-width: 70%; 
                padding: 10px; 
                margin: 0 auto; 
                position: relative; 
                margin-left: 350px;
            }
            .header{
                display: flex;  
                flex-direction:row; 
                justify-content: space-between; 
                align-items: center;
            }
            .header .title{
                font-size: 26px;
            }
            .branch_information{
                margin: 10px auto;
                min-width: 500px;
                max-width: 60%;
                border: 1px solid #ccc;
                border-radius: 20px;
            }
            .close_session{
                background: none;
                border: none;
                margin: 0;
                padding: 0;
                cursor: pointer;
                font-size: 16px;
            }
            .form_create_branch{
                margin: 10px auto;
                width: 100%;
                padding: 10px 20px;
            }
            .form_create_branch .form_group{
                display: flex; 
                flex-direction: column; 
                margin: 10px 0px;
            }
            .form_group .input_name,
            .form_group .input_address,
            .form_group .input_phone,
            .form_group .input_email{
                margin: 10px 0px;
                border: 1px solid #ccc; 
                color: #000; 
                width: 90%; 
                font-size: 16px; 
                height: 40px;
                outline: none; 
                text-decoration: none; 
                background: transparent;
                border-radius: 15px;
                padding: 0px 5px;
            }
            .container_buttom{
                display: flex;
                flex-direction: row;
                justify-content: center;
                gap: 10px;
                margin: 20px 0px;
            }
            .container_buttom .save_buttom,
            .container_buttom .cancel_buttom{
                display: flex; 
                flex-direction: row; 
                justify-content: center; 
                align-items: center; 
                gap: 25px; 
                background: none; 
                border: none; 
                cursor: pointer;
                width: 35%;
                font-size: 16px;
                padding: 10px; 
                color: #fff; 
                border-radius: 5px;
                border:none; 
                font-weight: 600;
            }
            .container_buttom .save_buttom{
                background-color: #007bff; 
            }
            .container_buttom .cancel_buttom{
                background-color: #dc3545; 
            }
            @media (max-width: 768px){
                .header .title{
                    margin-bottom: 10px;
                    font-size: 18px;
                }
                .new_branches_container{
                    margin-left: 70px;
                    min-width: 78%;
                }
                .branch_information{
                    height: 600px;
                    border:none;
                    max-width: 300px;
                    min-width: 295px;
                }
                .form_create_branch{
                    margin: 16px 0px 0px;
                    padding: 0px;
                }
                .container_buttom{
                    flex-direction: column;
                    gap: 10px;
                }
                .container_buttom .save_buttom,
                .container_buttom .cancel_buttom{
                    width: 100%;
                }
            }
        </style>
    </head>
    <body>
        <main class="container">
            <navbar class="navbar">
                <header class="header">
                    <h2 class="header_title">
                        <a 
                            href="{{route('home')}}" 
                            class="text_link">
                            Menu
                        </a>
                    </h2>
                    <button class="button_toggle_navbar" onclick="toggle_navbar()">
                        <img 
                            class="toggle_navbar"
                            src="{{asset('icons/arrow_to_right.png')}}" 
                            alt="Cerrar"
                            width="20px"
                            height="20px"
                            style="transform: rotate(180deg);">
                    </button>
                </header>
                <ul class="list">
                    <li>
                        <div class="item">
                            <img 
                                class="navbar_image"
                                src="{{asset('icons/user.png')}}" 
                                alt="Abrir"
                                width="20px"
                                height="20px">
                            <a 
                                href="{{route('my_profile')}}" 
                                class="text_link">
                                Mi perfil
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <img 
                                class="navbar_image"
                                src="{{asset('icons/calendar.png')}}" 
                                alt="Abrir"
                                width="20px"
                                height="20px">
                            <a href="{{ route('my_calendar') }}" class="text_link">Mi calendario</a>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <img 
                                class="navbar_image"
                                src="{{asset('icons/membresia.png')}}" 
                                alt="Membresia"
                                width="20px"
                                height="20px">
                            <a href="{{ route('suscription') }}" class="text_link">Mi suscripcion</a>
                        </div>
                    </li>
                    <?php if(Auth::user()->rol_id == 1){ ?>
                        <li>
                            <div class="item">
                                <img 
                                    class="navbar_image"
                                    src="{{asset('icons/members_groups.png')}}" 
                                    alt="Membresia"
                                    width="20px"
                                    height="20px">
                                <a 
                                    href="{{ route('my_professionals')}}" 
                                    class="text_link">
                                    Mis profesionales
                                </a>
                            </div>
                        </li>
                    <?php } ?>
                    <li>
                        <div class="item">
                            <img 
                                class="navbar_image"
                                src="{{asset('icons/groups.png')}}" 
                                alt="Membresia"
                                width="20px"
                                height="20px">
                            <a href="{{ route('my_clients') }}" class="text_link">Mis clientes</a>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <img 
                                class="navbar_image"
                                src="{{asset('icons/add_home.png')}}"
                                alt="Sucursales"
                                width="20px"
                                height="20px">
                            <a href="{{ route('my_branch') }}" class="text_link">Mis sucursales</a>
                        </div>
                    </li>
                    <li>
                        <div class="item" style="cursor: pointer;">
                            <img
                                class="navbar_image"
                                src="{{asset('icons/logout.png')}}" 
                                alt="Abrir"
                                width="20px"
                                height="20px">
                            <form action="{{ route('close_session') }}" method="POST" class="form_close_session">
                                @csrf
                                <button class="text_link close_session" onclick="cerrar_session()">Cerrar Session</button>
                            </form>
                        </div>
                    </li>
                </ul>
            </navbar>
            <section class="new_branches_container">
                <header class="header">
                    <h2 class="title">Dar de alta una nueva sucursal</h2>
                </header>
                <div class="branch_information">
                    <form 
                        action="{{route('create_branch')}}" 
                        method="POST"
                        class="form_create_branch">
                        @csrf
                        <div class="form_group">
                            <label for="name">Nombre de la sucursal</label>
                            <input 
                                class="input_name"
                                type="text" 
                                name="name" 
                                id="name" 
                                placeholder="Nombre de la sucursal"
                                autocomplete="off"
                                required>
                        </div>
                        <div class="form_group">
                            <label for="address">Direccion</label>
                            <input 
                                class="input_address"
                                type="text" 
                                name="address" 
                                id="address" 
                                placeholder="Direccion"
                                autocomplete="off"
                                required>
                        </div>
                        <div class="form_group">
                            <label for="phone">Celular</label>
                            <input 
                                class="input_phone"
                                type="text" 
                                name="phone"
                                id="phone"
                                placeholder="Celular"
                                autocomplete="off"
                                required>
                        </div>
                        <div class="container_buttom">
                            <button 
                                class="cancel_buttom" 
                                onclick="cancel_branch()"
                                type="button">
                                <img
                                    src="{{asset('icons/delete.png')}}"
                                    alt="Cancelar la creacion de la sucursal"
                                    width="20px" 
                                    height="20px">
                                <span class="buttom_text">Cancelar</span>
                            </button>
                            <button 
                                class="save_buttom"
                                onclick="validate_form()"
                                type="button">
                                <img 
                                    src="{{asset('icons/save.png')}}"
                                    alt="Guardar los cambios realizados"
                                    width="20px" 
                                    height="20px">
                                <span class="buttom_text">Guardar</span>
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </body>
    <script>
        function toggle_navbar(){
            let navbar = document.querySelector('.navbar');
            if(navbar.classList.contains('close')){
                let header_title = document.getElementsByClassName('header_title')[0];
                let text_link = document.querySelectorAll('.text_link');
                let toggle_navbar = document.getElementsByClassName('toggle_navbar')[0];
                
                navbar.classList.remove('close');
                text_link.forEach(element => {
                    element.style.display = 'block';
                });
                header_title.style.display = 'block';
                toggle_navbar.style.transform = 'rotate(180deg)';
            }else{
                let text_link = document.querySelectorAll('.text_link');
                let header_title = document.getElementsByClassName('header_title')[0];
                let toggle_navbar = document.getElementsByClassName('toggle_navbar')[0];
                
                navbar.classList.add('close');
                text_link.forEach(element => {
                    element.style.display = 'none';
                });
                header_title.style.display = 'none';
                toggle_navbar.style.transform = 'rotate(0deg)';
            }
        }
        function cancel_branch(){
            window.location.href = "{{route('my_branch')}}";
        }
        function validate_form(){
            let form = document.querySelector('.form_create_branch');
            let name = document.getElementById('name').value.trim();
            let address = document.getElementById('address').value.trim();
            let phone = document.getElementById('phone').value.trim();

            if(name === '' || address === '' || phone === ''){
                toastr.error('Todos los campos son obligatorios');
                return 
            }

            if(phone.length < 10){
                toastr.error('El numero de celular debe tener al menos 10 digitos');
                return
            }
            if(name.length < 3){
                toastr.error('El nombre de la sucursal debe tener al menos 3 caracteres');
                return
            }
            if(address.length < 4){
                toastr.error('Por favor, ingrese una direccion valida');
                return
            }

            form.submit();
        }
    </script>
</html>