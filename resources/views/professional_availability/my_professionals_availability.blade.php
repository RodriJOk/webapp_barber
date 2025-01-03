<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="https://webappbarber-56b0944e3615.herokuapp.com/icons/cuidado.png" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <title>Horarios del profesional</title>
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
            margin-bottom: 30px;
        }
        /* Estilos de la tabla */
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
        .table .table_body tr{
            margin: 10px 0px;
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
            margin: 8px auto;
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
        .day_available .day_information{
            display: flex; 
            flex-direction:row;
        }
        .day_available .day{
            width: 100px;
        }
        .checkbox_lunes, 
        .checkbox_martes, 
        .checkbox_miercoles,
        .checkbox_jueves,
        .checkbox_viernes,
        .checkbox_sabado,
        .checkbox_domingo{
            display: flex; 
            flex-direction: row; 
            gap: 10px;
        }
        .disponibilidad_lunes, 
        .disponibilidad_martes,
        .disponibilidad_miercoles,
        .disponibilidad_jueves,
        .disponibilidad_viernes,
        .disponibilidad_sabado,
        .disponibilidad_domingo{
            display: flex; 
            flex-direction: row; 
            gap: 10px; 
            margin: 0px; 
            padding:0px;
        }
        .disponibilidad_lunes_inicio, 
        .disponibilidad_martes_inicio,
        .disponibilidad_miercoles_inicio,
        .disponibilidad_jueves_inicio,
        .disponibilidad_viernes_inicio,
        .disponibilidad_sabado_inicio,
        .disponibilidad_domingo_inicio{
            display: flex; 
            flex-direction:column; 
            gap: 10px; 
            margin: 0px; 
            padding:0px;
        }
        .disponibilidad_lunes_fin,
        .disponibilidad_martes_fin,
        .disponibilidad_miercoles_fin,
        .disponibilidad_jueves_fin,
        .disponibilidad_viernes_fin,
        .disponibilidad_sabado_fin,
        .disponibilidad_domingo_fin{
            display: flex; 
            flex-direction:column; 
            gap: 10px; 
            margin: 0px; 
            padding:0px;
        }
        .boton_descanso_lunes,
        .boton_descanso_martes,
        .boton_descanso_miercoles,
        .boton_descanso_jueves,
        .boton_descanso_viernes,
        .boton_descanso_sabado,
        .boton_descanso_domingo{
            text-decoration: none; 
            border:none; 
            background-color:transparent; 
            display:flex; 
            flex-direction: row; 
            align-items: center; 
            gap: 10px;
            cursor: pointer;
        }
        .descanso_lunes, 
        .descanso_martes,
        .descanso_miercoles,
        .descanso_jueves,
        .descanso_viernes,
        .descanso_sabado,
        .descanso_domingo{
            display: flex; 
            flex-direction: row; 
            gap: 10px; 
            margin: 0px; 
            padding:0px;
            display: none;
        }
        .descanso_lunes_inicio,
        .descanso_martes_inicio,
        .descanso_miercoles_inicio,
        .descanso_jueves_inicio,
        .descanso_viernes_inicio,
        .descanso_sabado_inicio,
        .descanso_domingo_inicio{
            display: flex; 
            flex-direction:column; 
            gap: 10px; 
            margin: 0px; 
            padding:0px;
        }
        .descanso_lunes_fin,
        .descanso_martes_fin,
        .descanso_miercoles_fin,
        .descanso_jueves_fin,
        .descanso_viernes_fin,
        .descanso_sabado_fin,
        .descanso_domingo_fin{
            display: flex; 
            flex-direction:column; 
            gap: 10px; 
            margin: 0px; 
            padding:0px;
        }
        .close_session{
            background: none;
            border: none;
            margin: 0;
            padding: 0;
            font-size: 16px;
        }
        .container_checkbox{
            display:flex; 
            flex-direction: row; 
            justify-content:center;
            margin-top: 20px;
        }
        .container_buttom{
            display: flex; 
            flex-direction: row; 
            margin: 30px 0px; 
            width: 100%;
            text-align: center;
            justify-content: center;
        }
        .container_buttom .go_back{
            padding: 10px 0px;
            width: 25%; 
            background-color:#c50f34; 
            color:#fff; 
            border:none; 
            border-radius: 5px; 
            margin-right: 10px;
            font-size: 18px;
        }
        .container_buttom .save_changes{
            padding: 10px 0px;
            width: 25%; 
            background-color:#00d1b2; 
            color:#fff; 
            border:none; 
            border-radius: 5px;
            font-size: 18px;
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
                <?php if(Auth::user()->rol_id == 1){ ?>
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
                    <div class="item">
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
                <h2 class="title">Horarios de {{$professional_information->surname}}, {{ $professional_information->name }}</h2>
            </div>
            <form 
                action="{{ route('store_professional_availability') }}" 
                method="POST"
                onsubmit="return validate_form();"
            >
                @csrf
                <input type="text" name="professional_id" value="{{ $professional_information->id }}" hidden>

                @if($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <table class="table">
                    <thead class="table_header">
                        <tr>
                            <th>Dia</th>
                            <th>Activo</th>
                            <th>Inicio</th>
                            <th>Fin</th>
                            <th>Inicio descanso</th>
                            <th>Fin descanso</th>
                        </tr>
                    </thead>
                    <tbody class="table_body">
                        @php
                            $data = collect($data)->keyBy('day_of_the_week');
                        @endphp

                        @foreach (['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'] as $day)
                            @php
                                $dayAvailability = $data->get($day);
                                $isChecked = $dayAvailability['active'] ?? false;
                                $startTime = $dayAvailability['start_time'] ?? '08:00';
                                $endTime = $dayAvailability['end_time'] ?? '23:00';
                                $startRestTime = $dayAvailability['start_rest_time'] ?? '00:00';
                                $endRestTime = $dayAvailability['end_rest_time'] ?? '00:00';
                            @endphp
                            <tr>
                                <td>{{ $day }}</td>
                                <td>
                                    <div style="display:flex; flex-direction:row;">
                                        <input 
                                            type="checkbox" 
                                            id="input_{{ strtolower($day) }}" 
                                            name="availability[{{ strtolower($day) }}][checked]" 
                                            {{ $isChecked ? 'checked' : '' }}
                                        />
                                        <label 
                                            id="label_{{ strtolower($day) }}" 
                                            for="input_{{ strtolower($day) }}">{{ $day }}</label>
                                    </div>
                                </td>
                                <td>
                                    <input 
                                        type="time" 
                                        step="1800" 
                                        id="disponibilidad_{{ strtolower($day) }}_inicio" 
                                        name="availability[{{ strtolower($day) }}][disponibilidad_inicio]"
                                        value="{{ $startTime }}"
                                        min="08:00"
                                        max="23:00"
                                    />
                                </td>
                                <td>
                                    <input 
                                        type="time" 
                                        step="1800" 
                                        id="disponibilidad_{{ strtolower($day) }}_fin" 
                                        name="availability[{{ strtolower($day) }}][disponibilidad_fin]"
                                        value="{{ $endTime }}"
                                        min="08:00"
                                        max="23:00"
                                    />
                                </td>
                                <td>
                                    <input 
                                        type="time" 
                                        step="1800" 
                                        id="descanso_{{ strtolower($day) }}_inicio" 
                                        name="availability[{{ strtolower($day) }}][descanso_inicio]"
                                        value="{{ $startRestTime }}"
                                        min="08:00"
                                        max="23:00"
                                    />
                                </td>
                                <td>
                                    <input 
                                        type="time" 
                                        step="1800" 
                                        id="descanso_{{ strtolower($day) }}_fin" 
                                        name="availability[{{ strtolower($day) }}][descanso_fin]"
                                        value="{{ $endRestTime }}"
                                        min="08:00"
                                        max="23:00"
                                    />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <?php if($mostrar_boton_notificaciones){ ?>
                    <section class="container_checkbox">
                        <input 
                            type="checkbox" 
                            id="checked" 
                            name="notification"/>
                        <label for="checked">
                            Notificar al profesional del cambio en el esquema de los horarios
                        </label>
                    </section>
                <?php } ?>

                <div class="container_buttom">
                    <button 
                        type="button" 
                        class="go_back" 
                        onclick="window.history.back()">
                        Volver atras
                    </button>
                    <button 
                        type="submit" 
                        class="save_changes">
                        Guardar cambios
                    </button>
                </div>
            </form>

        </div>
    </main>
    <script>
        let data = <?php echo json_encode($data); ?>;
        if(data == ""){
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "0",
                "extendedTimeOut": "0",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr["warning"]("El profesional no tiene horarios asignados. Por favor, seleccione los horarios de disponibilidad.");
        }

        function validate_form(){
            let form = document.querySelector('form');
            let checked = form.querySelectorAll('input[type="checkbox"]');
            
            const allCheckboxes = document.querySelectorAll('input[type="checkbox"]');
            let checkedCheckboxes = [];
            allCheckboxes.forEach(checkbox => {
                if(checkbox.checked){
                    checkedCheckboxes.push(checkbox);
                }
            });

            if(checkedCheckboxes.length == 0){
                toastr.error("Debe seleccionar al menos un día de la semana para guardar los cambios.");
                return false;
            }

            //Obtener todas las horas de inicio y las horas de fin. Evaluar si alguna de ellas es mayor a la otra
            let allStartTimes = document.querySelectorAll('input[name^="availability["][name$="][disponibilidad_inicio]"]');
            let allEndTimes = document.querySelectorAll('input[name^="availability["][name$="][disponibilidad_fin]"]');
            let allStartRestTimes = document.querySelectorAll('input[name^="availability["][name$="][descanso_inicio]"]');
            let allEndRestTimes = document.querySelectorAll('input[name^="availability["][name$="][descanso_fin]');
            let errors = [];

            for(let i = 0; i < allStartTimes.length; i++){
                let startTime = allStartTimes[i].value;
                let endTime = allEndTimes[i].value;
                let startRestTime = allStartRestTimes[i].value;
                let endRestTime = allEndRestTimes[i].value;

                if(startTime >= endTime){
                    errors.push(`La hora de inicio de disponibilidad del día ${allStartTimes[i].name.split('[')[1].split(']')[0]} no puede ser mayor o igual a la hora de fin.`);
                }

                if(startRestTime >= endRestTime){
                    errors.push(`La hora de inicio de descanso del día ${allStartTimes[i].name.split('[')[1].split(']')[0]} no puede ser mayor o igual a la hora de fin.`);
                }
            }

            if(errors.length > 0){
                errors.forEach(error => {
                    toastr.error(error);
                });
                return false;
            }
            return true;
        }
    </script>
</body>
</html>