<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('icons/cuidado.png') }}" type="image/x-icon">
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
            /* background-color:#00d1b2;  */
            /* Poner en color azul */
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
            width: 100%; 
            height: 100%;
        }
        .input_search{
            position: relative; 
            width: 100%; 
            height: 35px; 
            border-radius: 5px; 
            border: 1px solid #ccc;
        }
        .clear_search_button{
            background-color: transparent; 
            border: none; 
            position:absolute; 
            top:8px; 
            right: 0px;
        }
        .button_search{
            width: 20%; 
            background-color: #00d1b2; 
            color: #fff; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer;
            height: 40px;
        }
        .close_session{
            background: none;
            border: none;
            margin: 0;
            padding: 0;
            font-size: 16px;
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
                        <a href="{{ route('my_collaborators') }}" class="text_link">Mis colaboradores</a>
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
                    <button onclick="open_modal()">Agregar un nuevo cliente</button>
                </div>
            </div>

            <div style="margin: 10px 0px;">
                <form method="GET" action="{{route('my_clients')}}">
                    @csrf
                    <div class="search_container">
                        <select name="order" id="order" class="select_search">
                            <option value="0">Ordenar por</option>
                            <option value="asc">Mas reciente</option>
                            <option value="desc">Mas antiguo</option>
                        </select>
                        <div class="container_search_section">
                            <input 
                                autocomplete="off" 
                                type="text" 
                                class="input_search" 
                                name="search" 
                                id="search" 
                                placeholder="Buscar un cliente"
                                value="{{request()->search}}"
                                onchange="validate_name_search('search')"
                                onfocus="validate_name_search('search')">
                                <button type="button" onclick="clear_search()" class="clear_search_button">
                                    <img src="{{asset('icons/close.png')}}" alt="Borrar resultados de busqueda" width="20px" height="20px">
                                </button>
                        </div>
                        <button type="submit" class="button_search">Buscar</button>
                    </div>
                </form>
                
                @if(isset($search_result) && count($search_result) == 0)
                    <div style="text-align: center; margin: 20px 0px;">
                        <h3>No se encontraron resultados de busqueda</h3>
                    </div>
                @endif
                @if(isset($search_result) && count($search_result) > 0)
                    <table style="width: 100%; border-collapse: collapse; margin: 36px 0px;">
                        <thead style="background-color: #012e46; color: #fff; text-align: center;">
                            <tr>
                                <th style="padding: 10px; border-bottom: 1px solid #ccc;">
                                    Nombre
                                </th>
                                <th style="padding: 10px; border-bottom: 1px solid #ccc;">
                                    Apellido
                                </th>
                                <th style="padding: 10px; border-bottom: 1px solid #ccc;">
                                    Creacion
                                </th>
                                <th style="padding: 10px; border-bottom: 1px solid #ccc;">
                                    Actualizacion
                                </th>
                                <th style="padding: 10px; border-bottom: 1px solid #ccc;">
                                    Nombre sucursal
                                </th>
                                <th style="padding: 10px; border-bottom: 1px solid #ccc;">
                                    Celular
                                </th>
                                <th style="padding: 10px; border-bottom: 1px solid #ccc;">
                                    Email
                                </th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                        @foreach ($search_result as $client)
                            <tr>
                                <td style="border-bottom: 1px solid #ccc;">{{$client['name']}}</td>
                                <td style="border-bottom: 1px solid #ccc;">{{$client['surname']}}</td>
                                <td style="border-bottom: 1px solid #ccc;">{{$client['created_at']}}</td>
                                <td style="border-bottom: 1px solid #ccc;">{{$client['update_at'] ?? 'No actualizado'}}</td>
                                <td style="border-bottom: 1px solid #ccc;">{{$client['name_branch']}}</td>
                                <td style="border-bottom: 1px solid #ccc;">{{$client['phone']}}</td>
                                <td style="border-bottom: 1px solid #ccc;">{{$client['email']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
                @if(!isset($search_result))
                    <table style="width: 100%; border-collapse: collapse; margin: 36px 0px;">
                        <thead style="background-color: #012e46; color: #fff; text-align: center;">
                            <tr>
                                <th style="padding: 10px; border-bottom: 1px solid #ccc;">
                                    Nombre
                                </th>
                                <th style="padding: 10px; border-bottom: 1px solid #ccc;">
                                    Apellido
                                </th>
                                <th style="padding: 10px; border-bottom: 1px solid #ccc;">
                                    Creacion
                                </th>
                                <th style="padding: 10px; border-bottom: 1px solid #ccc;">
                                    Actualizacion
                                </th>
                                <th style="padding: 10px; border-bottom: 1px solid #ccc;">
                                    Nombre sucursal
                                </th>
                                <th style="padding: 10px; border-bottom: 1px solid #ccc;">
                                    Celular
                                </th>
                                <th style="padding: 10px; border-bottom: 1px solid #ccc;">
                                    Email
                                </th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                        @foreach ($clients as $client)
                            <tr>
                                <td style="border-bottom: 1px solid #ccc;">{{$client['name']}}</td>
                                <td style="border-bottom: 1px solid #ccc;">{{$client['surname']}}</td>
                                <td style="border-bottom: 1px solid #ccc;">{{$client['created_at']}}</td>
                                <td style="border-bottom: 1px solid #ccc;">{{$client['update_at'] ?? 'No actualizado'}}</td>
                                <td style="border-bottom: 1px solid #ccc;">{{$client['name_branch']}}</td>
                                <td style="border-bottom: 1px solid #ccc;">{{$client['phone']}}</td>
                                <td style="border-bottom: 1px solid #ccc;">{{$client['email']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
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
            let boton_limpiar_busqueda = document.getElementById('clear_search');
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
    </script>
</body>
</html>