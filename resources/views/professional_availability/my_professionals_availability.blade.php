<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        .modal_body{
            max-width: 850px;
            display: flex; 
            flex-direction:column;
            margin: 0 auto;
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
        .container_buttom{
            display: flex; 
            flex-direction: row; 
            margin: 30px 0px; 
            width: 100%;
            text-align: center;
            justify-content: center;
        }
        .container_buttom .close_modal{
            padding: 10px 0px;
            width: 25%; 
            background-color:#c50f34; 
            color:#fff; 
            border:none; 
            border-radius: 5px; 
            margin-right: 10px;
            font-size: 18px;
        }
        .container_buttom .delete_reservation{
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
            <form action="{{ route('save_professional_availability') }}" method="POST">
                <input type="text" name="professional_id" value="{{ $professional_information->id }}" hidden>
                @csrf
                @if($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @php
                    $data = collect($data)->keyBy('day_of_the_week');
                @endphp

                @foreach (['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'] as $day)
                    @php
                        // Comprobamos si hay disponibilidad para el día actual
                        $dayAvailability = $data->get($day);
                        $isChecked = $dayAvailability['active'] ?? false;
                        $startTime = $dayAvailability['start_time'] ?? '08:00';
                        $endTime = $dayAvailability['end_time'] ?? '23:00';
                        $startRestTime = $dayAvailability['start_rest_time'] ?? '13:00';
                        $endRestTime = $dayAvailability['end_rest_time'] ?? '14:00';
                    @endphp

                    <div class="day_available">
                        <section class="day_information">
                            <div class="day">
                                <span>{{ $day }}</span>
                                <input 
                                    type="text" 
                                    name="availability[{{ strtolower($day) }}][dia]" 
                                    value="{{ strtolower($day) }}" 
                                    hidden>
                            </div>
                            <div class="checkbox_{{ strtolower($day) }}">
                                <input 
                                    type="checkbox" 
                                    id="input_{{ strtolower($day) }}" 
                                    name="availability[{{ strtolower($day) }}][checked]" 
                                    {{ $isChecked ? 'checked' : '' }}
                                />
                                <label 
                                    id="label_{{ strtolower($day) }}" 
                                    for="input_{{ strtolower($day) }}">
                                    {{ $day }}
                                </label>
                            </div>
                        </section>

                        <div class="disponibilidad_{{ strtolower($day) }}">
                            <div class="disponibilidad_{{ strtolower($day) }}_inicio">
                                <label for="disponibilidad_{{ strtolower($day) }}_inicio">Inicio</label>
                                <input 
                                    type="time" 
                                    step="1800" 
                                    id="disponibilidad_{{ strtolower($day) }}_inicio" 
                                    name="availability[{{ strtolower($day) }}][disponibilidad_inicio]"
                                    value="{{ $startTime }}"
                                    min="08:00"
                                    max="23:00"
                                    {{ $isChecked ? '' : '' }} />
                            </div>
                            <div class="disponibilidad_{{ strtolower($day) }}_fin">
                                <label for="disponibilidad_{{ strtolower($day) }}_fin">Fin</label>
                                <input 
                                    type="time" 
                                    step="1800" 
                                    id="disponibilidad_{{ strtolower($day) }}_fin" 
                                    name="availability[{{ strtolower($day) }}][disponibilidad_fin]"
                                    value="{{ $endTime }}"
                                    min="08:00"
                                    max="23:00"
                                    {{ $isChecked ? '' : '' }} />
                            </div>
                        </div>

                        <div class="descanso_{{ strtolower($day) }}">
                            <div class="descanso_{{ strtolower($day) }}_inicio">
                                <label for="descanso_{{ strtolower($day) }}_inicio">Inicio</label>
                                <input 
                                    type="time" 
                                    step="1800" 
                                    id="descanso_{{ strtolower($day) }}_inicio" 
                                    name="availability[{{ strtolower($day) }}][descanso_inicio]"
                                    value="{{ $startRestTime }}"
                                    min="08:00"
                                    max="23:00"
                                />
                            </div>
                            <div class="descanso_{{ strtolower($day) }}_fin">
                                <label for="descanso_{{ strtolower($day) }}_fin">Fin</label>
                                <input 
                                    type="time" 
                                    step="1800" 
                                    id="descanso_{{ strtolower($day) }}_fin" 
                                    name="availability[{{ strtolower($day) }}][descanso_fin]"
                                    value="{{ $endRestTime }}"
                                    min="08:00"
                                    max="23:00"
                                />
                            </div>
                        </div>

                        <div>
                            <button 
                                class="boton_descanso_{{ strtolower($day) }}"
                                onclick="add_break({{ 'descanso_' . strtolower($day) }})">
                                <img
                                    src="{{ asset('icons/add_circle.png') }}" 
                                    alt="Agregar sección de descanso" 
                                    width="20px" 
                                    height="20px"/>
                                <span>Agregar descanso</span>
                            </button>
                        </div>
                    </div>
                @endforeach

                <div class="container_buttom">
                    <button type="button" class="close_modal" onclick="window.history.back()">
                        Volver atras
                    </button>
                    <button type="submit" class="delete_reservation">
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
    </script>
</body>
</html>