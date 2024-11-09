<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('icons/cuidado.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <title>Mis colaboradores</title>
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
        }
        .table .table_header tr th{
            padding: 10px; 
            border-bottom: 1px solid #ccc;
        }
        .table .table_body{
            text-align: center;
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
        .modal_header .close_modal img{
            width: 35px;
            height: 35px;
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
                <h2 class="title">Mis colaboradores</h2>
                <div class="container_button">
                    <button onclick="open_modal('modal')">Agregar un nuevo colaborador</button>
                </div>
            </div>
            <p>Listado de los colaboradores</p>
            <table class="table">
                <thead class="table_header">
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Celular/Telefono</th>
                        <th>Acciones</th>
                        <th>Horarios</th>
                    </tr>
                </thead>
                <tbody class="table_body">
                    @foreach ($all_collaborators as $collaborator)
                        <tr>
                            <td>{{$collaborator->name}}</td>
                            <td>{{$collaborator->surname}}</td>
                            <td>{{$collaborator->email}}</td>
                            <td>{{$collaborator->phone}}</td>
                            <td>
                                <div class="container_button_actions">
                                    <button class="button_edit" onclick="open_modal('modal_editar')">
                                        <span>
                                            <img src="{{asset('icons/edit.png')}}" alt="Editar datos del colaborador" width="20px" height="20px"/>
                                        </span>
                                        <span>Editar</span>
                                    </button>
                                    <button class="button_delete" onclick="delete_collaborator({{$collaborator->id}})">
                                        <span>
                                            <img src="{{asset('icons/delete.png')}}" alt="Eliminar colaborador" width="20px" height="20px"/>
                                        </span>
                                        <span>
                                            Eliminar
                                        </span>
                                    </button>
                                </div>
                            </td>
                            <td colspan="6">
                                <div class="container_button_schedule">
                                    {{-- <button onclick="open_modal('modal_horarios')"> --}}
                                    <button onclick="window.location.href='{{ route('my_collaborators_availability', ['id' => $collaborator->id]) }}'">
                                        <span>Ver horarios</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        {{-- Seccion de modal para crear un nuevo colaborador--}}
        <dialog id="modal" class="modal">
            <div class="modal_header">
                <h2>Agregar un colaborador</h2>
                <button class="close_modal" onclick="close_modal('modal')">
                    <img src="{{asset('icons/close.png')}}" alt="Close Modal">
                </button>
            </div>
            <section class="modal_body">
                <form action="{{ route('save_collaborator') }}" method="POST" >
                    @csrf
                    <div class="items">
                        <label for="name">Nombre</label>
                        <input 
                            type="text" 
                            name="name" 
                            value="" 
                            autocomplete="off" 
                            placeholder="Nombre del colaborador">
                    </div>
                    <div class="items">
                        <label for="surname">Apellido</label>
                        <input 
                            type="text" 
                            name="surname" 
                            value="" 
                            autocomplete="off" 
                            placeholder="Apellido del colaborador">
                    </div>
                    <div class="items">
                        <label for="email">Email</label>
                        <input 
                            type="text" 
                            name="email" 
                            value="" 
                            autocomplete="off" 
                            placeholder="Email de contacto">
                    </div>
                    <div class="items">
                        <label for="phone">Celular/Whatsapp</label>
                        <input 
                            type="text" 
                            name="phone" 
                            value="" 
                            autocomplete="off" 
                            placeholder="Celular/Telefono">
                    </div>
                    <div class="items">
                        <label for="phone">Selecciona los dias de disponibilidad</label>
                        <input 
                            type="text" 
                            name="phone" 
                            value="" 
                            autocomplete="off" 
                            placeholder="Celular/Telefono">
                    </div>
                    <div class="items">
                        <label for="phone">Celular/Whatsapp</label>
                        <input 
                            type="text" 
                            name="phone" 
                            value="" 
                            autocomplete="off" 
                            placeholder="Celular/Telefono">
                    </div>
                    <div class="container_buttom">
                        <button type="button" class="close_modal" onclick="close_modal('modal')">
                            Cerrar modal
                        </button>
                        <button type="submit" class="delete_reservation">
                            Guardar cambios
                        </button>
                    </div>
                </form>
            </section>
        </dialog> 
        
        {{-- Seccion de modal para editar la info de un colaborador--}}
        <dialog id="modal_editar" class="modal_editar">
            <div class="modal_header">
                <h2>Editar documentacion de un colaborador</h2>
                <button class="close_modal" onclick="close_modal('modal_editar')">
                    <img src="{{asset('icons/close.png')}}" alt="Close Modal">
                </button>
            </div>
            <section class="modal_body">
                <form action="{{ route('update_collaborator') }}" method="POST" >
                    @csrf
                    <div class="items">
                        <label for="name">Nombre</label>
                        <input 
                            type="text" 
                            name="name" 
                            value="<?php echo $collaborator->name; ?>"
                            autocomplete="off" 
                            placeholder="Nombre del colaborador">
                    </div>
                    <div class="items">
                        <label for="surname">Apellido</label>
                        <input 
                            type="text" 
                            name="surname" 
                            value="<?php echo $collaborator->surname; ?>"
                            autocomplete="off" 
                            placeholder="Apellido del colaborador">
                    </div>
                    <div class="items">
                        <label for="email">Email</label>
                        <input 
                            type="text" 
                            name="email" 
                            value="<?php echo $collaborator->email; ?>"
                            autocomplete="off" 
                            placeholder="Email de contacto">
                    </div>
                    <div class="items">
                        <label for="phone">Celular/Whatsapp</label>
                        <input 
                            type="text" 
                            name="phone" 
                            value="<?php echo $collaborator->phone; ?>"
                            autocomplete="off" 
                            placeholder="Celular/Telefono">
                    </div>
                    <div class="container_buttom">
                        <button type="button" class="close_modal" onclick="close_modal('modal')">
                            Cerrar modal
                        </button>
                        <button type="submit" class="delete_reservation">
                            Guardar cambios
                        </button>
                    </div>
                </form>
            </section>
        </dialog>
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
        function open_modal(element){
            let modal = document.getElementById(element);
            modal.style.display = 'block';
        }
        function close_modal(id){
            let modal = document.getElementById(id);
            modal.style.display = 'none';
        }
        function editar_modal(){
            let modal = document.getElementById('modal');
            modal.style.display = 'flex';
        }
        function delete_collaborator(id){
            let confirm_delete = confirm('¿Estas seguro de eliminar este colaborador?');
            if(confirm_delete){
                window.location.href = '/delete_collaborator/'+id;
            }
        }
        function add_break(elemento){
            console.log(elemento);
            //Crear un elemento que sea variable 
            let descanso_dia = docuement.getElementById(elemento);
            console.log(descanso_dia);
        }
    </script>
</body>
</html>