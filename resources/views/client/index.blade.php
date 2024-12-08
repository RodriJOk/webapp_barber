<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="https://webappbarber-56b0944e3615.herokuapp.com/icons/cuidado.png" type="image/x-icon">
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <title>Mis clientes</title>
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
        .text_link{
            text-decoration: none;
            color: #fff;
        }

        .navbar.close .button_toggle_navbar{
            text-align: center;
            margin: 0px auto;
        }
        .navbar.close .navbar_image{
            margin: 0px auto;
        }
        /* Estilos de la seccion del header de los clientes */
        .client_container{
            min-width: 70%; 
            padding: 10px; 
            margin: 0 auto; 
            position: relative; 
            margin-left: 350px;
        }
        .container_client_header{
            display: flex; 
            flex-direction:row; 
            justify-content: space-between; 
            align-items: center;
        }
        .container_client_header .title{
            font-size: 26px;
        }
        .container_client_header .container_button button{
            padding: 10px; 
            width: 100%;
            background-color: #007bff; 
            color:#fff; 
            border:none; 
            border-radius: 5px;
        }
        /* Estilos de la seccion de contenedor de la info de clientes */
        .search_container{
            margin: 30px 0px; 
            display:flex; 
            flex-direction: row; 
            justify-content: space-between; 
            align-items: center;
            gap: 25px;
        }
        .select_search{
            padding: 10px; 
            border-radius: 5px; 
            border: 1px solid #ccc;
        }
        .container_search_section{
            position: relative; 
            width: 75%; 
            height: 100%;
        }
        .filter_search{
            display: flex; 
            flex-direction: row; 
            gap: 10px;
            width: 25%;
        }
        .filter_search .select_search{
            width: 75%;
        }
        .filter_search .button_search{
            width: 50%;
            padding: 10px; 
            background-color:#00d1b2; 
            color:#fff; 
            border:none; 
            border-radius: 5px;
        }
        .input_search{
            position: relative; 
            width: 100%; 
            height: 35px; 
            border-radius: 5px; 
            border: 1px solid #ccc;
            padding: 0px 0px 0px 10px;
        }
        .clear_search_button{
            background-color: transparent; 
            border: none; 
            position:absolute; 
            top:8px; 
            right: 0px;
        }
        .close_session{
            background: none;
            border: none;
            margin: 0;
            padding: 0;
            font-size: 16px;
        }
        /* Estilos de la tabla */
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
        .row_header .column_surname
        .row_header .column_created_at,
        .row_header .column_updated_at,
        .row_header .column_name_branch,
        .row_header .column_phone,
        .row_header .column_email{
            padding: 10px; 
            border-bottom: 1px solid #ccc;
        }
        .tbody{
            text-align: center;
        }

        .row_content .content_name,
        .row_content .content_surname,
        .row_content .content_created_at,
        .row_content .content_updated_at,
        .row_content .content_name_branch,
        .row_content .content_phone,
        .row_content .content_email{
            border-bottom: 1px solid #ccc;
        }

        /* Estilos del modal */
        .modal{
            background-color: #fff;
            z-index: 9999;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            padding: 20px;
            position: absolute;
            top: 20px;
            min-width: 500px;
            display: none;
        }
        .modal_header{
            display: flex; 
            flex-direction: row; 
            justify-content: space-between;
        }
        .modal_header .close_modal{
            background: none; 
            color:#000; 
            font-size: 18px;
            border:none;
            border-radius: 50%; 
            cursor: pointer;
            padding:10px;
        }
        .modal_body{
            display: flex; 
            flex-direction:column;
        }
        .modal_body .items{
            display: flex; 
            flex-direction: column; 
            margin: 10px 0px;
        }
        .modal_body .container_buttom{
            display: flex; 
            flex-direction: row; 
            margin: 10px 0px; 
            width:100%;
        }

        .modal_body .container_buttom .close_modal{
            padding: 10px 0px;
            width: 50%; 
            background-color:#c50f34; 
            color:#fff; 
            border:none; 
            border-radius: 5px; 
            margin-right: 10px;
            font-size: 18px;
        }

        .modal_body .container_buttom .delete_reservation{
            padding: 10px 0px;
            width: 50%; 
            background-color:#00d1b2; 
            color:#fff; 
            border:none; 
            border-radius: 5px;
        }
        .items .input_name,
        .items .input_surname,
        .items .input_phone,
        .items .input_email{
            margin: 10px auto;
            border: 1px solid #ccc; 
            color: #000; 
            width: 100%; 
            font-size: 16px; 
            height: 40px;
            outline: none; 
            text-decoration: none; 
            background: transparent;
            border-radius: 15px;
            padding: 0px 5px;
        }

        .close_session{
            background: none;
            border: none;
            margin: 0;
            padding: 0;
            font-size: 16px;
        }
        @media (max-width: 768px){
            .navbar{
                z-index: 1000;
            }
            .client_container{
                margin-left: 80px;
            }
            .search_container{
                flex-direction: column;
                gap: 10px;
            }
            .container_search_section{
                width: 96%;
            }
            .filter_search{
                display: flex;
                flex-direction: row;
                gap: 10px;
                width: 100%;
            }
            .filter_search .select_search{
                width: 50%;
            }
            .filter_search .button_search{
                width: 50%;
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
                <button class="button_toggle_navbar" onclick="toggle_navbar()" style="background: none; border:none;">
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
                    <div style="display: flex; flex-direction: row; gap: 10px;">
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
                    <div style="display: flex; flex-direction: row; gap: 10px;">
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
                    <div style="display: flex; flex-direction: row; gap: 10px;">
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
                    <div style="display: flex; flex-direction: row; gap: 10px;">
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
                    <div style="display: flex; flex-direction: row; gap: 10px;">
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
                    <div style="display: flex; flex-direction: row; gap: 10px;">
                        <img
                            class="navbar_image"
                            src="{{asset('icons/logout.png')}}" 
                            alt="Abrir"
                            width="20px"
                            height="20px">
                        <form action="{{ route('close_session') }}" method="POST">
                            @csrf
                            <button type="submit" class="text_link close_session">Cerrar Session</button>
                        </form>
                    </div>
                </li>
            </ul>
        </navbar>
        <div class="client_container">
            <div class="container_client_header">
                <h2 class="title">Mis clientes</h2>
                <div class="container_button">
                    <button onclick="open_modal('modal')">Agregar un nuevo cliente</button>
                </div>
            </div>

            <div style="margin: 10px 0px;">
                <form method="GET" action="{{route('search_client')}}">
                    @csrf
                    <div class="search_container">
                        <div class="container_search_section">
                            <input 
                                autocomplete="off" 
                                type="text" 
                                class="input_search" 
                                name="name_search" 
                                id="search" 
                                placeholder="Buscar un cliente"
                                value="<?php echo isset($search_name) ? $search_name : '' ?>"
                                onchange="validate_name_search('search')"
                                onfocus="validate_name_search('search')">
                                <button type="button" onclick="clear_search()" class="clear_search_button">
                                    <img src="{{asset('icons/close.png')}}" alt="Borrar resultados de busqueda" width="20px" height="20px">
                                </button>
                        </div>
                        <div class="filter_search">
                            <select name="order" id="order" class="select_search">
                                <option value="0">Ordenar por</option>
                                <option value="asc" <?php echo isset($search_order) && $search_order == 'asc' ? 'selected' : '' ?>>Mas reciente</option>
                                <option value="desc" <?php echo isset($search_order) && $search_order == 'desc' ? 'selected' : '' ?>>Mas antiguo</option>
                            </select>
                            <button type="submit" class="button_search">Buscar</button>
                        </div>
                    </div>
                </form>
                
                @if(isset($search_result) && count($search_result) == 0)
                    <div style="text-align: center; margin: 20px 0px;">
                        <h3>No se encontraron resultados de busqueda</h3>
                    </div>
                @endif
                @if(isset($search_result) && count($search_result) > 0)
                    <table class="table">
                        <thead class="thead">
                            <tr class="row_header">
                                <th class="column_name">
                                    Nombre
                                </th>
                                <th class="column_surname">
                                    Apellido
                                </th>
                                <th class="column_created_at">
                                    Creacion
                                </th>
                                <th class="column_updated_at">
                                    Actualizacion
                                </th>
                                <th class="column_phone">
                                    Celular
                                </th>
                                <th class="column_email">
                                    Email
                                </th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            @foreach ($search_result as $client)
                                <tr class="row_content">
                                    <td class="content_name">{{$client['name']}}</td>
                                    <td class="content_surname">{{$client['surname']}}</td>
                                    <td class="content_created_at">{{$client['created_at']}}</td>
                                    <td class="content_updated_at">{{$client['update_at'] ?? 'No actualizado'}}</td>
                                    <td class="content_phone">{{$client['phone']}}</td>
                                    <td class="content_email">{{$client['email']}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                @if(!isset($search_result) && count($clients) > 0)
                    <table class="table">
                        <thead class="thead">
                            <tr class="row_header">
                                <th class="column_name">
                                    Nombre
                                </th>
                                <th class="column_surname">
                                    Apellido
                                </th>
                                <th class="column_created_at">
                                    Creacion
                                </th>
                                <th class="column_updated_at">
                                    Actualizacion
                                </th>
                                <th class="column_phone">
                                    Celular
                                </th>
                                <th class="column_email">
                                    Email
                                </th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            @foreach ($clients as $client)
                                <tr class="row_content">
                                    <td class="content_name">{{$client['name']}}</td>
                                    <td class="content_surname">{{$client['surname']}}</td>
                                    <td class="content_created_at">{{$client['created_at']}}</td>
                                    <td class="content_updated_at">{{$client['update_at'] ?? 'No actualizado'}}</td>
                                    <td class="content_phone">{{$client['phone']}}</td>
                                    <td class="content_email">{{$client['email']}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @elseif(!isset($search_result) && count($clients) == 0)
                    <div style="text-align: center; margin: 20px 0px;">
                        <h3>No tienes clientes registrados</h3>
                    </div>
                @endif
            </div>
        </div>

        {{-- Modal para crear clientes --}}
        <dialog id="modal" class="modal">
            <div class="modal_header">
                <h2>Nuevo cliente</h2>
                <button class="close_modal" onclick="close_modal('modal')">
                    <img class="navbar_image" src="{{asset('icons/close.png')}}" alt="Close Modal" width="35px" height="35px">
                </button>
            </div>
            <section class="modal_body">
                <form action="{{ route('create_client') }}" method="POST" >
                    @csrf
                    <div class="items">
                        <label for="nombre">Nombre</label>
                        <input 
                            class="input_name"
                            type="text" 
                            name="nombre" 
                            autocomplete="off" 
                            placeholder="Nombre">
                    </div>
                    <div class="items">
                        <label for="surname">Apellido</label>
                        <input 
                            class="input_surname"
                            type="text" 
                            name="surname" 
                            autocomplete="off" 
                            placeholder="Apellido">
                    </div>
                    <div class="items">
                        <label for="celular_telefono">Celular/Telefono</label>
                        <input 
                            class="input_phone"
                            type="text" 
                            name="celular_telefono" 
                            value="" 
                            autocomplete="off" 
                            placeholder="Celular/Telefono">
                    </div>
                    <div class="items">
                        <label for="email">Email</label>
                        <input 
                            class="input_email"
                            type="text" 
                            name="email" 
                            value="" 
                            autocomplete="off" 
                            placeholder="Email">
                    </div>
                    <div class="container_buttom">
                        <button type="button" class="close_modal" onclick="close_modal('modal')" style="font-size: 18px;">
                            Cerrar modal
                        </button>
                        <button type="submit" class="delete_reservation" style="font-size: 18px;">
                            Guardar cambios
                        </button>
                    </div>
                </form>
            </section>
        </dialog>  
    </main>

    <script>
        function toggle_navbar(){
            let navbar = document.querySelector('.navbar');
            if(navbar.classList.contains('close')){
                navbar.classList.remove('close');
                let text_link = document.querySelectorAll('.text_link');
                text_link.forEach(element => {
                    element.style.display = 'block';
                });
                let header_title = document.getElementsByClassName('header_title')[0];
                header_title.style.display = 'block';
                let toggle_navbar = document.getElementsByClassName('toggle_navbar')[0];
                toggle_navbar.style.transform = 'rotate(180deg)';
            }else{
                navbar.classList.add('close');
                let text_link = document.querySelectorAll('.text_link');
                text_link.forEach(element => {
                    element.style.display = 'none';
                });
                let header_title = document.getElementsByClassName('header_title')[0];
                header_title.style.display = 'none';
                let toggle_navbar = document.getElementsByClassName('toggle_navbar')[0];
                toggle_navbar.style.transform = 'rotate(0deg)';
            }
        }
        function validate_name_search(id){
            let input = document.getElementById(id);
            let boton_limpiar_busqueda = document.getElementsByClassName('clear_search_button')[0];
            if(input.value.length > 0){
                boton_limpiar_busqueda.style.display = 'block';
            }else{
                boton_limpiar_busqueda.style.display = 'none';
            }
        }
        function clear_search(){
            let search = document.getElementById('search');
            search.value = '';
        }
        function open_modal(element){
            let modal = document.getElementById(element);
            modal.style.display = 'block';
        }
        function close_modal(element){
            let modal = document.getElementById(element);
            modal.style.display = 'none';
        }
    </script>
</body>
</html>