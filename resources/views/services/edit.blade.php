<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="https://webappbarber-56b0944e3615.herokuapp.com/icons/cuidado.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mis servicios</title>
    <style>
        body{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }
        .main{
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
        .close_session{
            background: none;
            border: none;
            margin: 0;
            padding: 0;
            font-size: 16px;
        }
        /* Estilos de la seccion de informacion y ABM*/
        .section_main{
            min-width: 70%; 
            padding: 10px; 
            margin: 0 auto; 
            position: relative; 
            margin-left: 350px;
        }
        .container_button button{
            padding: 10px; 
            width: 100%; 
            background-color: #007bff; 
            color:#fff; 
            border:none; 
            border-radius: 5px;
        }
        .container_title{
            display: flex; 
            flex-direction:row; 
            justify-content: space-between; 
            align-items: center;
        }
        .container_title .title{
            font-size: 26px;
        }
        .table{
            width: 100%; 
            border-collapse: collapse;
        }
        .table .table_header{
            background-color: #012e46; 
            color: #fff; 
            text-align: center;
            width: 100%;
        }
        .table .table_header tr th{
            padding: 10px; 
            border-bottom: 1px solid #ccc;
        }
        .table .table_body{
            text-align: center;
            width: 100%;
        }
        .table .table_body th {
            background-color: whithe;
            font-weight: bold;
        }          
        .table .table_body tr:nth-child(odd) td {
            background-color: #fff;
        }
        .table .table_body tr:nth-child(even) td {
            background-color: #ebeced;        
        }
        .table .table_body tr td{
            border-bottom: 1px solid #ccc;
        }
        .table .table_body tr:nth-child(odd) td {
            background-color: #fff;        }
        .table .table_body tr td .container_button_actions{
            display: flex; 
            flex-direction: row; 
            justify-content: center; 
            gap: 15px; 
            align-items: end;
        }
        .table .table_body tr td .container_button_actions .button_edit{
            display: flex; 
            flex-direction: row; 
            justify-content: space-between; 
            align-items: center; 
            gap: 15px; 
            background-color: #007bff; 
            color: #fff; 
            padding: 5px 10px; 
            border:none; 
            border-radius: 5px;
        }
        .table .table_body tr td .container_button_actions .button_delete{
            display: flex; 
            flex-direction: row; 
            justify-content: space-between; 
            align-items: center; 
            gap: 15px;
            background-color: #c50f34; 
            color: #fff; 
            padding: 5px 10px; 
            border:none;
            border-radius: 5px;
        }
        .table .table_body tr .container_button_schedule{
            display: flex; 
            flex-direction: row; 
            justify-content: center; 
            gap: 15px; 
            align-items: end;
        }
        .table .table_body tr .container_button_schedule button{
            display: flex; 
            flex-direction: row; 
            justify-content: space-between; 
            align-items: center; 
            gap: 15px; 
            background-color: #007bff; 
            color: #fff; 
            padding: 5px 10px; 
            border:none; 
            border-radius: 5px;
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
            cursor: pointer;
        }
        .modal_body .container_buttom .save_service{
            padding: 10px 0px;
            width: 50%; 
            background-color:#00d1b2; 
            color:#fff; 
            border:none; 
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }
        .items .input_services,
        .items .input_description,
        .items .input_price,
        .items .input_duration,
        .items .input_branch{
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
        .items .input_branch{
            cursor: not-allowed;
            pointer-events: none;
            user-select: none;
        }
        .items .select_estado,
        .items .select_branch{
            margin: 10px auto;
            border: 1px solid #ccc; 
            width: 100%;
            font-size: 16px; 
            height: 40px;
            outline: none; 
            text-decoration: none; 
            background: transparent;
            border-radius: 15px;
            color: #000;
        }
        .items .select_estado option,
        .items .select_branch option{
            background-color: #fff;
            color: #000;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            padding: 0px 10px;
        }
        @media (max-width: 768px){
            .section_main{
                margin-left: 70px;
            }
            .navbar{
                z-index: 1000;
            }
        }
    </style>
</head>
<body>
    <main class="main">
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
                @if(Auth::user()->rol_id == 1)
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
                @endif
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
                            src="{{asset('icons/add_home.png')}}"
                            alt="Sucursales"
                            width="20px"
                            height="20px">
                        <a href="{{ route('my_branch') }}" class="text_link">Mis sucursales</a>
                    </div>
                </li>
                @if(Auth::user()->rol_id == 1)
                    <li>
                        <div style="display: flex; flex-direction: row; gap: 10px;">
                            <img 
                                class="navbar_image"
                                src="{{asset('icons/scissors.png')}}"
                                alt="Sucursales"
                                width="20px"
                                height="20px">
                            <a href="{{ route('my_services') }}" class="text_link">Mis servicios</a>
                        </div>
                    </li>
                @endif
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
        <div class="section_main">
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="container_title">
                <h2 class="title">Editar mi servicios</h2>
                <div class="container_button">
                    <a href="{{ route('my_services') }}">
                        <button>Volver a servicios</button>
                    </a>
                </div>
            </div>
            <section class="modal_body">
                <form action="{{ route('save_service') }}" method="POST">
                    @csrf
                    <div class="items">
                        <label for="services">Servicios</label>
                        <input
                            value="{{ $service['name'] }}"
                            id="services"
                            class="input_services"
                            type="text"
                            max-lenght="255"
                            name="services" 
                            autocomplete="off" 
                            placeholder="Nombre del servicio">
                    </div>
                    <div class="items">
                        <label for="description">Descripcion</label>
                        <input
                            value="{{ $service['description'] }}"
                            max-lenght="255"
                            id="description"
                            class="input_description"
                            type="text" 
                            name="description"
                            autocomplete="off"
                            placeholder="Descripcion">
                    </div>
                    <div class="items">
                        <label for="price">Precio (en ARS)</label>
                        <input
                            value="{{ $service['price'] }}"
                            id="price"
                            class="input_price"
                            type="numeric"
                            name="price" 
                            autocomplete="off" 
                            placeholder="Precio en ARS">
                    </div>
                    <div class="items">
                        <label for="duration">Duracion</label>
                        <input
                            value="{{ $service['duration'] }}"
                            id="duration"
                            class="input_duration"
                            type="text" 
                            name="duration"
                            autocomplete="off" 
                            placeholder="Duracion">
                    </div>
                    <div class="items">
                        <label for="state">Estado</label>
                        <select name="state" id="state" class="select_estado">
                            <option value="">Seleccione un estado</option>
                            <option 
                                @if($service['state'] == 'activo')
                                    selected
                                @endif
                                value="activo">
                                Activo
                            </option>
                            <option
                                @if($service['state'] == 'inactivo')
                                    selected
                                @endif 
                                value="inactivo">
                                Inactivo
                            </option>
                        </select>
                    </div>
                    <div class="items">
                        <label for="branch">Sucursales</label>
                        <input 
                            class="input_branch"
                            type="text" 
                            disabled 
                            name="service_id" 
                            value="{{ $branch['name'] }}">
                    </div>
                    <div class="container_buttom">
                        <button 
                            type="button" 
                            class="close_modal" 
                            onclick="close_modal('modal')">
                            Cerrar modal
                        </button>
                        <button 
                            type="submit" 
                            class="save_service">
                            Guardar cambios
                        </button>
                    </div>
                </form>
            </section>
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
    </script>
</body>
</html>