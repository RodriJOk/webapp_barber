<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <title>Membresia</title>
    <style>
        body{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
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
        .wallet_container {
            width: 100%;
            height: 50px; /* Asegura que el contenedor sea visible */
        }
        th {
            background-color: whithe;
            font-weight: bold;
        }          
        tr:nth-child(odd) td {
            background-color: #fff; /* Fondo gris */
        }
        tr:nth-child(even) td {
            background-color: #ebeced; /* Fondo blanco */        
        }

        .container_button button{
            padding: 10px; 
            width: 100%; 
            /* background-color:#00d1b2;  */
            /* Poner en color azul */
            background-color: #007bff; 
            color:#fff; 
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
            font-size: 18px;
        }

        /* Modal para setear los horarios de los colaboradores */
        #input_lunes, 
        #input_martes,
        #input_miercoles,
        #input_jueves,
        #input_viernes,
        #input_sabado,
        #input_domingo{
            height: 0;
            width: 0;
            visibility: hidden;
        }
        #label_lunes, 
        #label_martes,
        #label_miercoles,
        #label_jueves,
        #label_viernes,
        #label_sabado,
        #label_domingo{
            cursor: pointer;
            text-indent: -9999px;
            width: 50px;
            height: 25px;
            background: grey;
            display: block;
            border-radius: 100px;
            position: relative;
        }
        #label_lunes:after,
        #label_martes:after,
        #label_miercoles:after,
        #label_jueves:after,
        #label_viernes:after,
        #label_sabado:after,
        #label_domingo:after{
            content: '';
            position: absolute;
            top: 5px;
            left: 5px;
            width: 15px;
            height: 15px;
            background: #fff;
            border-radius: 90px;
            transition: 0.3s;
        }
        #input_lunes:checked + #label_lunes,
        #input_martes:checked + #label_martes,
        #input_miercoles:checked + #label_miercoles,
        #input_jueves:checked + #label_jueves,
        #input_viernes:checked + #label_viernes,
        #input_sabado:checked + #label_sabado,
        #input_domingo:checked + #label_domingo{
            background: #bada55;
        }
        #input_lunes:checked + #label_lunes:after,
        #input_martes:checked + #label_martes:after,
        #input_miercoles:checked + #label_miercoles:after,
        #input_jueves:checked + #label_jueves:after,
        #input_viernes:checked + #label_viernes:after,
        #input_sabado:checked + #label_sabado:after,
        #input_domingo:checked + #label_domingo:after{
            left: calc(100% - 5px);
            transform: translateX(-100%);
        }

        #label_lunes:active:after,
        #label_martes:active:after,
        #label_miercoles:active:after,
        #label_jueves:active:after,
        #label_viernes:active:after,
        #label_sabado:active:after,
        #label_domingo:active:after{
            width: 50px;
        }

        /* Estilos del modal de disponibilidad de horarios */
        .day_available{
            display: flex; 
            flex-direction:row; 
            justify-content: space-around; 
            align-items:center; 
            border-bottom: 1px solid #eaeaea; 
            gap: 20px;
        }
        .day_available .day{
            width: 100px;
        }
        .checkbox_lunes{
            display: flex; 
            flex-direction:column; 
            gap: 10px;
        }
        .disponibilidad_lunes{
            display: flex; 
            flex-direction: row; 
            gap: 10px; 
            margin: 0px; 
            padding:0px;
        }
        .disponibilidad_lunes_inicio{
            display: flex; 
            flex-direction:column; 
            gap: 10px; 
            margin: 0px; 
            padding:0px;
        }
        .disponibilidad_lunes_fin{
            display: flex; 
            flex-direction:column; 
            gap: 10px; 
            margin: 0px; 
            padding:0px;
        }
        .boton_descanso_lunes{
            text-decoration: none; 
            border:none; 
            background-color:transparent; 
            display:flex; 
            flex-direction: row; 
            align-items: center; 
            gap: 10px;
            cursor: pointer;
        }
        .descanso_lunes{
            display: flex; 
            flex-direction: row; 
            gap: 10px; 
            margin: 0px; 
            padding:0px;
        }
        .descanso_lunes_inicio{
            display: flex; 
            flex-direction:column; 
            gap: 10px; 
            margin: 0px; 
            padding:0px;
        }
        .descanso_lunes_fin{
            display: flex; 
            flex-direction:column; 
            gap: 10px; 
            margin: 0px; 
            padding:0px;
        }
    </style>
</head>
<body>
    <main style="display: flex; flex-direction: row;">
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
                        <a href="" class="text_link">Cerrar Session</a>
                    </div>
                </li>
            </ul>
        </navbar>
        <div style="min-width: 70%; padding: 10px; margin: 0 auto; position: relative; margin-left: 350px;">
            @if ($errors->any())
                <div class="toast_validation_error alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div style="display: flex; flex-direction:row; justify-content: space-between; align-items: center;">
                <h2 style="font-size: 26px">Mis colaboradores</h2>
                <div class="container_button">
                    <button onclick="open_modal('modal')">Agregar un nuevo colaborador</button>
                </div>
            </div>
            <p>Listado de los colaboradores</p>
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="background-color: #012e46; color: #fff; text-align: center;">
                    <tr>
                        <th style="padding: 10px; border-bottom: 1px solid #ccc;">Nombre</th>
                        <th style="padding: 10px; border-bottom: 1px solid #ccc;">Apellido</th>
                        <th style="padding: 10px; border-bottom: 1px solid #ccc;">Email</th>
                        <th style="padding: 10px; border-bottom: 1px solid #ccc;">Celular/Telefono</th>
                        <th style="padding: 10px; border-bottom: 1px solid #ccc;">Acciones</th>
                        <th style="padding: 10px; border-bottom: 1px solid #ccc;">Horarios</th>
                    </tr>
                </thead>
                <tbody style="text-align: center;">
                    @foreach ($all_collaborators as $collaborator)
                        <tr>
                            <td style="border-bottom: 1px solid #ccc;">{{$collaborator->name}}</td>
                            <td style="border-bottom: 1px solid #ccc;">{{$collaborator->surname}}</td>
                            <td style="border-bottom: 1px solid #ccc;">{{$collaborator->email}}</td>
                            <td style="border-bottom: 1px solid #ccc;">{{$collaborator->phone}}</td>
                            <td style="border-bottom: 1px solid #ccc;">
                                <div style="display: flex; flex-direction: row; justify-content: center; gap: 15px; align-items: end;">
                                    <button 
                                        style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; gap: 15px; background-color: #007bff; color: #fff; padding: 5px 10px; border:none; border-radius: 5px;"
                                        onclick="open_modal('modal_editar')">
                                        <span>
                                            <img src="{{asset('icons/edit.png')}}" alt="Editar datos del colaborador" width="20px" height="20px"/>
                                        </span>
                                        <span>Editar</span>
                                    </button>
                                    <button 
                                        style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; gap: 15px;background-color: #c50f34; color: #fff; padding: 5px 10px; border:none; border-radius: 5px;"
                                        onclick="delete_collaborator({{$collaborator->id}})"
                                        >
                                        <span>
                                            <img src="{{asset('icons/delete.png')}}" alt="Eliminar colaborador" width="20px" height="20px"/>
                                        </span>
                                        <span>
                                            Eliminar
                                        </span>
                                    </button>
                                </div>
                            </td>
                            <td colspan="6" style="border-bottom: 1px solid #ccc;">
                                <div style="display: flex; flex-direction: row; justify-content: center; gap: 15px; align-items: end;">
                                    <button 
                                        style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; gap: 15px; background-color: #007bff; color: #fff; padding: 5px 10px; border:none; border-radius: 5px;"
                                        onclick="open_modal('modal_horarios')">
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

        {{-- Seccion de modal para poder setear los horarios de los colaboradores --}}
        <dialog id="modal_horarios" class="modal_horarios">
            <div class="modal_header">
                <h2>Horarios del colaborador</h2>
                <button class="close_modal" onclick="close_modal('modal_horarios')">
                    <img src="{{asset('icons/close.png')}}" alt="Close Modal">
                </button>
            </div>
            <section class="modal_body">
                <form action="{{ route('update_collaborator') }}" method="POST" >
                    @csrf
                    <div class="day_available">
                        <div class="day">
                            <span>Lunes</span>
                        </div>
                        <div class="checkbox_lunes">
                            <input type="checkbox" id="input_lunes"/>
                            <label id="label_lunes" for="input_lunes">Lunes</label>
                        </div>
                        <div class="disponibilidad_lunes">
                            <div class="disponibilidad_lunes_inicio">
                                <label for="disponibilidad_lunes_inicio">
                                    Inicio
                                </label>
                                <input 
                                    type="time" 
                                    step="1800" 
                                    id="disponibilidad_lunes_inicio" 
                                    name="disponibilidad_lunes_inicio" 
                                    value="00:00"
                                    min="08:00"
                                    max="23:00"/>
                            </div>
                            <div class="disponibilidad_lunes_fin">
                                <label for="disponibilidad_lunes_fin">
                                    Fin
                                </label>
                                <input 
                                    type="time" 
                                    step="1800" 
                                    id="disponibilidad_lunes_fin" 
                                    name="disponibilidad_lunes_fin" 
                                    value="00:00"
                                    min="08:00"
                                    max="23:00"/>
                            </div>
                        </div>
                        <div class="descanso_lunes">
                            <div class="descanso_lunes_inicio">
                                <label for="descanso_lunes_inicio">
                                    Inicio
                                </label>
                                <input 
                                    type="time" 
                                    step="1800" 
                                    id="descanso_lunes_inicio" 
                                    name="descanso_lunes_inicio" 
                                    value="00:00"
                                    min="08:00"
                                    max="23:00"/>
                            </div>
                            <div class="descanso_lunes_fin">
                                <label for="descanso_lunes_fin">
                                    Fin
                                </label>
                                <input 
                                    type="time" 
                                    step="1800" 
                                    id="descanso_lunes_fin" 
                                    name="descanso_lunes_fin" 
                                    value="00:00"
                                    min="08:00"
                                    max="23:00"/>
                            </div>
                        </div>
                        <div>
                            <button 
                                class="boton_descanso_lunes"
                                onclick="add_break(descanso_lunes)">
                                <img
                                    src="{{asset('icons/add_circle.png')}}" 
                                    alt="Agregar seccion de descanso" 
                                    width="20px" 
                                    height="20px"/>
                                <span>Agregar descanso</span>
                            </button>
                        </div>
                    </div>
                    <div class="day_available">
                        <div class="day">
                            <span>Martes</span>
                        </div>
                        <div class="checkbox_martes">
                            <input type="checkbox" id="input_martes"/>
                            <label id="label_martes" for="input_martes">Martes</label>
                        </div>
                        <div class="disponibilidad_martes">
                            <div class="hora_inicio_jornada_martes">
                                <label for="hora_inicio_jornada_martes">
                                    Inicio
                                </label>
                                <input 
                                    type="time" 
                                    step="1800" 
                                    id="hora_inicio_jornada_martes" 
                                    name="hora_inicio_jornada_martes" 
                                    value="00:00"
                                    min="08:00"
                                    max="23:00"/>
                            </div>
                            <div class="disponibilidad_martes_fin">
                                <label for="disponibilidad_martes_fin">
                                    Fin
                                </label>
                                <input 
                                    type="time" 
                                    step="1800" 
                                    id="disponibilidad_martes_fin" 
                                    name="disponibilidad_martes_fin" 
                                    value="00:00"
                                    min="08:00"
                                    max="23:00"/>
                            </div>
                        </div>
                        <div class="descanso_martes">
                            <div class="descanso_martes_inicio">
                                <label for="descanso_martes_inicio">
                                    Inicio
                                </label>
                                <input 
                                    type="time" 
                                    step="1800" 
                                    id="descanso_martes_inicio" 
                                    name="descanso_martes_inicio" 
                                    value="00:00"
                                    min="08:00"
                                    max="23:00"/>
                            </div>
                            <div class="descanso_martes_fin">
                                <label for="descanso_martes_fin">
                                    Fin
                                </label>
                                <input 
                                    type="time" 
                                    step="1800" 
                                    id="descanso_martes_fin" 
                                    name="descanso_martes_fin" 
                                    value="00:00"
                                    min="08:00"
                                    max="23:00"/>
                            </div>
                        </div>
                        <div>
                            <button 
                                onclick="add_break()" 
                                style="text-decoration: none; border:none; background-color:transparent; display:flex; flex-direction: row;">
                                <img src="{{asset('icons/add_circle.png')}}" alt="Agregar seccion de descanso" width="20px" height="20px"/>
                                <span>Agregar descanso</span>
                            </button>
                        </div>
                    </div>
                    <div class="day_available">
                        <div class="day">
                            <span>Miercoles</span>
                        </div>
                        <div class="checkbox_lunes">
                            <input type="checkbox" id="input_miercoles"/>
                            <label id="label_miercoles" for="input_miercoles">Miercoles</label>
                        </div>
                        <div class="disponibilidad_miercoles">
                            <div class="disponibilidad_miercoles_inicio">
                                <label for="disponibilidad_miercoles_inicio">
                                    Inicio
                                </label>
                                <input 
                                    type="time" 
                                    step="1800" 
                                    id="disponibilidad_miercoles_inicio" 
                                    name="disponibilidad_miercoles_inicio" 
                                    value="00:00"
                                    min="08:00"
                                    max="23:00"/>
                            </div>
                            <div class="disponibilidad_miercoles_fin">
                                <label for="disponibilidad_miercoles_fin">
                                    Fin
                                </label>
                                <input 
                                    type="time" 
                                    step="1800" 
                                    id="disponibilidad_miercoles_fin" 
                                    name="disponibilidad_miercoles_fin" 
                                    value="00:00"
                                    min="08:00"
                                    max="23:00"/>
                            </div>
                        </div>
                        <div class="descanso_miercoles">
                            <div class="descanso_miercoles_inicio">
                                <label for="descanso_miercoles_inicio">
                                    Inicio
                                </label>
                                <input 
                                    type="time" 
                                    step="1800" 
                                    id="descanso_miercoles_inicio" 
                                    name="descanso_miercoles_inicio" 
                                    value="00:00"
                                    min="08:00"
                                    max="23:00"/>
                            </div>
                            <div class="descanso_miercoles_fin">
                                <label for="descanso_miercoles_fin">
                                    Fin
                                </label>
                                <input 
                                    type="time" 
                                    step="1800" 
                                    id="descanso_miercoles_fin" 
                                    name="descanso_miercoles_fin" 
                                    value="00:00"
                                    min="08:00"
                                    max="23:00"/>
                            </div>
                        </div>
                        <div>
                            <button 
                                onclick="add_break()" 
                                style="text-decoration: none; border:none; background-color:transparent; display:flex; flex-direction: row;">
                                <img src="{{asset('icons/add_circle.png')}}" alt="Agregar seccion de descanso" width="20px" height="20px"/>
                                <span>Agregar descanso</span>
                            </button>
                        </div>
                    </div>
                    <div  class="day_available">
                        <div class="day">
                            <span>Jueves</span>
                        </div>
                        <div class="checkbox_jueves">
                            <input type="checkbox" id="input_jueves"/>
                            <label id="label_jueves" for="input_jueves">Jueves</label>
                        </div>
                        <div class="disponibilidad_jueves">
                            <div class="disponibilidad_jueves_inicio">
                                <label for="disponibilidad_jueves_inicio">
                                    Inicio
                                </label>
                                <input 
                                    type="time" 
                                    step="1800" 
                                    id="disponibilidad_jueves_inicio" 
                                    name="disponibilidad_jueves_inicio" 
                                    value="00:00"
                                    min="08:00"
                                    max="23:00"/>
                            </div>
                            <div class="disponibilidad_jueves_fin">
                                <label for="disponibilidad_jueves_fin">
                                    Fin
                                </label>
                                <input 
                                    type="time" 
                                    step="1800" 
                                    id="disponibilidad_jueves_fin" 
                                    name="disponibilidad_jueves_fin" 
                                    value="00:00"
                                    min="08:00"
                                    max="23:00"/>
                            </div>
                        </div>
                        <div class="descanso_miercoles">
                            <div class="descanso_miercoles_inicio">
                                <label for="descanso_miercoles_inicio">
                                    Inicio
                                </label>
                                <input 
                                    type="time" 
                                    step="1800" 
                                    id="descanso_miercoles_inicio" 
                                    name="descanso_miercoles_inicio" 
                                    value="00:00"
                                    min="08:00"
                                    max="23:00"/>
                            </div>
                            <div class="descanso_miercoles_fin">
                                <label for="descanso_miercoles_fin">
                                    Fin
                                </label>
                                <input 
                                    type="time" 
                                    step="1800" 
                                    id="descanso_miercoles_fin" 
                                    name="descanso_miercoles_fin" 
                                    value="00:00"
                                    min="08:00"
                                    max="23:00"/>
                            </div>
                        </div>
                        <div>
                            <button 
                                onclick="add_break()" 
                                style="text-decoration: none; border:none; background-color:transparent; display:flex; flex-direction: row;">
                                <img src="{{asset('icons/add_circle.png')}}" alt="Agregar seccion de descanso" width="20px" height="20px"/>
                                <span>Agregar descanso</span>
                            </button>
                        </div>
                    </div>
                    <div class="day_available">
                        <div class="day">
                            <span>Viernes</span>
                        </div>
                        <div>
                            <input type="checkbox" id="input_viernes"/>
                            <label id="label_viernes" for="input_viernes">Viernes</label>
                        </div>
                        <div style="display: flex; flex-direction:column; gap: 10px; border: 1px solid red; margin: 0px; padding:0px;">
                            <div style="display: flex; flex-direction: row; gap: 10px; margin: 0px; padding:0px;">
                                <div style="display: flex; flex-direction:column; gap: 10px; margin: 0px; padding:0px;">
                                    <label for="hora_inicio_jornada_viernes" style="text-align: center;">
                                        Inicio
                                    </label>
                                    <input 
                                        type="time" 
                                        step="1800" 
                                        id="hora_inicio_jornada_viernes" 
                                        name="hora_inicio_jornada_viernes" 
                                        value="00:00"
                                        min="08:00"
                                        max="23:00"/>
                                </div>
                                <div style="display: flex; flex-direction:column; gap: 10px; margin: 0px; padding:0px;">
                                    <label for="hora_fin_jornada_viernes" style="text-align: center;">
                                        Fin
                                    </label>
                                    <input 
                                        type="time" 
                                        step="1800" 
                                        id="hora_fin_jornada_viernes" 
                                        name="hora_fin_jornada_viernes" 
                                        value="00:00"
                                        min="08:00"
                                        max="23:00"/>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button 
                                onclick="add_break()" 
                                style="text-decoration: none; border:none; background-color:transparent; display:flex; flex-direction: row;">
                                <img src="{{asset('icons/add_circle.png')}}" alt="Agregar seccion de descanso" width="20px" height="20px"/>
                                <span>Agregar descanso</span>
                            </button>
                        </div>
                    </div>
                    <div class="day_available">
                        <div class="day">
                            <span>Sabado</span>
                        </div>
                        <div>
                            <input type="checkbox" id="input_sabado"/>
                            <label id="label_sabado" for="input_sabado">Sabado</label>
                        </div>
                        <div style="display: flex; flex-direction:column; gap: 10px; border: 1px solid red; margin: 0px; padding:0px;">
                            <div style="display: flex; flex-direction: row; gap: 10px; margin: 0px; padding:0px;">
                                <div style="display: flex; flex-direction:column; gap: 10px; margin: 0px; padding:0px;">
                                    <label for="hora_inicio_jornada_sabado" style="text-align: center;">
                                        Inicio
                                    </label>
                                    <input 
                                        type="time" 
                                        step="1800" 
                                        id="hora_inicio_jornada_sabado" 
                                        name="hora_inicio_jornada_sabado" 
                                        value="00:00"
                                        min="08:00"
                                        max="23:00"/>
                                </div>
                                <div style="display: flex; flex-direction:column; gap: 10px; margin: 0px; padding:0px;">
                                    <label for="hora_fin_jornada_sabado" style="text-align: center;">
                                        Fin
                                    </label>
                                    <input 
                                        type="time" 
                                        step="1800" 
                                        id="hora_fin_jornada_sabado" 
                                        name="hora_fin_jornada_sabado" 
                                        value="00:00"
                                        min="08:00"
                                        max="23:00"/>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button 
                                onclick="add_break()" 
                                style="text-decoration: none; border:none; background-color:transparent; display:flex; flex-direction: row;">
                                <img src="{{asset('icons/add_circle.png')}}" alt="Agregar seccion de descanso" width="20px" height="20px"/>
                                <span>Agregar descanso</span>
                            </button>
                        </div>
                    </div>
                    <div class="day_available">
                        <div class="day">
                            <span>Domingo</span>
                        </div>
                        <div>
                            <input type="checkbox" id="input_domingo"/>
                            <label id="label_domingo" for="input_domingo">Domingo</label>
                        </div>
                        <div style="display: flex; flex-direction:column; gap: 10px; border: 1px solid red; margin: 0px; padding:0px;">
                            <div style="display: flex; flex-direction: row; gap: 10px; margin: 0px; padding:0px;">
                                <div style="display: flex; flex-direction:column; gap: 10px; margin: 0px; padding:0px;">
                                    <label for="hora_inicio_jornada_domingo" style="text-align: center;">
                                        Inicio
                                    </label>
                                    <input 
                                        type="time" 
                                        step="1800" 
                                        id="hora_inicio_jornada_domingo" 
                                        name="hora_inicio_jornada_domingo" 
                                        value="00:00"
                                        min="08:00"
                                        max="23:00"/>
                                </div>
                                <div style="display: flex; flex-direction:column; gap: 10px; margin: 0px; padding:0px;">
                                    <label for="hora_fin_jornada_domingo" style="text-align: center;">
                                        Fin
                                    </label>
                                    <input 
                                        type="time" 
                                        step="1800" 
                                        id="hora_fin_jornada_domingo" 
                                        name="hora_fin_jornada_domingo" 
                                        value="00:00"
                                        min="08:00"
                                        max="23:00"/>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button 
                                onclick="add_break()" 
                                style="text-decoration: none; border:none; background-color:transparent; display:flex; flex-direction: row;">
                                <img src="{{asset('icons/add_circle.png')}}" alt="Agregar seccion de descanso" width="20px" height="20px"/>
                                <span>Agregar descanso</span>
                            </button>
                        </div>
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