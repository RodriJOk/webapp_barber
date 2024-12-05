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
        <title>Mis sucursales</title>
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
            .branches_container{
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
            .container_button .create_event{
                padding: 10px;
                width: 100%;
                background-color:#00d1b2; 
                color:#fff; 
                border:none; 
                border-radius: 5px;
                cursor: pointer;
                text-decoration: none;
                text-align: center;
                font-size: 14px;
            }
            .branches{
                margin: 10px 0px;
            }
            .close_session{
                background: none;
                border: none;
                margin: 0;
                padding: 0;
                cursor: pointer;
                font-size: 16px;
            }
            /* Estilos del modal */
            .modal{
                background-color: #fff;
                z-index: 100000;
                margin: 0 auto;
                display: flex;
                flex-direction: row;
                padding: 20px;
                position: absolute;
                top: 20px;
                min-width: 500px;
                display: none;
            }
            .table{
                width: 100%; 
                border-collapse: collapse; 
                margin: 36px 0px;
            }
            .thead{
                background-color: #012e46; 
                color: #fff; 
                text-align: center;
            }
            .row_header .column_name,
            .row_header .column_address,
            .row_header .column_phone,
            .row_header .column_action{
                padding: 10px; 
                border-bottom: 1px solid #ccc;
            }
            .tbody{
                text-align: center;
            }
            .row_content .content_name,
            .row_content .content_address,
            .row_content .content_phone,
            .row_content .content_action{
                border-bottom: 1px solid #ccc;
            }
            .container_buttom{
                display: flex;
                flex-direction: row;
                justify-content: center;
                gap: 10px;
            }
            .container_buttom .edit_buttom,
            .container_buttom .delete_buttom{
                display: flex; 
                flex-direction: row; 
                justify-content: space-between; 
                align-items: center; 
                gap: 15px; 
                background: none; 
                border: none; 
                cursor: pointer;
            }
            .container_buttom .edit_buttom{
                background-color: #007bff; 
                color: #fff; 
                padding: 5px 10px; 
                border:none; 
                border-radius: 5px;
            }
            .container_buttom .delete_buttom{
                background-color: #dc3545; 
                color: #fff; 
                padding: 5px 10px; 
                border:none; 
                border-radius: 5px;
            }
            .container_information_empty{
                max-width: 60%; 
                text-align: center; 
                border:2px solid #ccc; 
                border-radius: 10px; 
                margin: 20px auto 15px; 
                padding: 20px;
            }
            .container_information_empty .information_empty_title{
                font-size: 20px; 
                font-weight:500;
            }
            .container_information_empty .information_empty_description{
                font-size: 16px;
            }
            @media (max-width: 768px){
                .header .title{
                    font-size: 18px;
                }
                .branches_container{
                    margin-left: 70px;
                    min-width: 78%;
                }
                .branches{
                    height: 600px;
                }
            }
        </style>
    </head>
    <body>
        <main class="container">
            <navbar class="navbar">
                <header class="header">
                    <h2 class="header_title">
                        <a href="{{route('home')}}" class="text_link">Menu</a>
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
                            <a href="{{route('my_profile')}}" class="text_link">Mi perfil</a>
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
                    <li>
                        <div class="item">
                            <img 
                                class="navbar_image"
                                src="{{asset('icons/members_groups.png')}}" 
                                alt="Membresia"
                                width="20px"
                                height="20px">
                            <a href="{{ route('my_professionals') }}" class="text_link">Mis profesionales</a>
                        </div>
                    </li>
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
                                src="{{asset('icons/groups.png')}}" 
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
            <section class="branches_container">
                <header class="header">
                    <h2 class="title">Mis sucursales</h2>
                    <div class="container_button">
                        <a 
                            href="{{ route('new_branch') }}" 
                            class="create_event">
                            Crear una nueva sucursal
                        </a>
                    </div>
                </header>
                <div class="branches"><?php 
                    if($branches){ ?>
                        <table class="table">
                            <thead class="thead">
                                <tr class="row_header">
                                    <th class="column_name">Nombre</th>
                                    <th class="column_address">Direccion</th>
                                    <th class="column_phone">Celular</th>
                                    <th class="column_action">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                @foreach($branches as $branch)
                                    <tr class="row_content">
                                        <td class="content_name">{{ $branch['name'] }}</td>
                                        <td class="content_address">{{ $branch['address'] }}</td>
                                        <td class="content_phone">{{ $branch['phone'] }}</td>
                                        <td class="content_action">
                                            <div class="container_buttom">
                                                <button 
                                                    class="edit_buttom" 
                                                    onclick="edit_branch()"
                                                    type="button">
                                                    <img 
                                                        src="{{asset('icons/edit.png')}}"
                                                        alt="Editar" 
                                                        width="20px" 
                                                        height="20px">
                                                    <span class="buttom_text">Editar</span>
                                                </button>
                                                <button 
                                                    class="delete_buttom" 
                                                    onclick="delete_branch()"
                                                    type="button">
                                                    <img 
                                                        src="{{asset('icons/delete.png')}}"
                                                        alt="Eliminar"
                                                        width="20px" 
                                                        height="20px">
                                                    <span class="buttom_text">Eliminar</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table><?php 
                    }else{ ?>
                        <div class="container_information_empty">
                            <h2 class="information_empty_title">No tienes sucursales registradas</h2>
                            <p class="information_empty_description">Por favor, registra una sucursal para poder gestionar tus reservas</p>
                        </div><?php 
                    } ?>
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
        function edit_branch(){
            window.location.href = "{{ route('edit_branch') }}";
        }
        function delete_branch(){
            window.location.href = "{{ route('delete_branch') }}";
        }
    </script>
</html>