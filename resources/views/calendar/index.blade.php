<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="https://webappbarber-56b0944e3615.herokuapp.com/icons/cuidado.png" type="image/x-icon">
        <!-- Fonts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.15/index.global.min.js'></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


        <title>Mi calendario</title>
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
            .calendar_container{
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
            }
            .calendar{
                margin: 10px 0px;
            }
            .close_session{
                background: none;
                border: none;
                margin: 0;
                padding: 0;
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
            @media (max-width: 768px){
                .header .title{
                    font-size: 18px;
                }
                .calendar_container{
                    margin-left: 70px;
                    min-width: 78%;
                }
                .calendar{
                    height: 600px;
                }
                .fc-header-toolbar{
                    display: flex;
                    flex-direction: column-reverse;
                }
                .fc-header-toolbar .fc-toolbar-chunk:nth-child(1){
                    width: 100%;
                }
                .fc-header-toolbar .fc-toolbar-chunk:nth-child(1) .fc-button-group{
                    display: flex;
                    flex-direction: row;
                    justify-content: space-between;
                    gap: 40px;
                }
                .fc-header-toolbar .fc-toolbar-chunk:nth-child(2) .fc-toolbar-title{
                    font-size: 18px;
                    font-family: Verdana, Geneva, Tahoma, sans-serif;
                    margin: 10px 0px;
                }
                .fc-header-toolbar .fc-toolbar-chunk:nth-child(3){
                    width: 100%;
                }
                .fc-header-toolbar .fc-toolbar-chunk:nth-child(3) .fc-button-group{
                    width: 100%;
                    display: flex;
                    flex-direction: row;
                    justify-content: space-between;
                    gap: 10px;
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
                            <a href="{{ route('my_collaborators') }}" class="text_link">Mis colaboradores</a>
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
            <section class="calendar_container">
                <header class="header">
                    <h2 class="title">Mi calendario</h2>
                    <div class="container_button">
                        <a href="{{ route('new_event') }}" class="create_event">
                            Crear evento
                        </a>

                        {{-- <form action="{{ route('new_event')}}" method="POST">
                            @csrf
                            <button class="create_event" type="submit">
                                Crear evento
                            </button>
                        </form> --}}
                        {{-- <button class="create_event" onclick="open_modal()">
                            Crear evento
                        </button> --}}
                    </div>
                </header>
                <div id="calendar" class="calendar"></div>
            </section>

            {{-- <dialog id="modal" class="modal" style="display: none;">
                <form action="{{ route('create_event') }}" method="POST">
                    <div style="display: flex; flex-direction:column; gap: 10px;">

                        @csrf
                        <label for="service">Servicio</label>
                        <select name="service" id="service" required>
                            <option value="1">Corte de cabello (30 minutos)</option>
                            <option value="2">Barba (30 minutos)</option>
                            <option value="3">Corte de cabello y barba (1 hora)</option>
                        </select>
                        <label for="fecha_reserva">Fecha de la reserva</label>
                        <input type="text" id="fecha_reserva" name="fecha_reserva" required>
                        <label for="hora_reserva">Hora de la reserva</label>
                        <input type="text" id="hora_reserva" name="hora_reserva" required>
                        <label for="observaciones_reserva">Observaciones</label>
                        <input type="text" id="observaciones_reserva" name="observaciones_reserva" required>
                        <button type="submit">Reservar</button>
                    </div>
                </form>
            </dialog> --}}
        </main>
    </body>
    <script>
        let reservas = '<?php echo json_encode($reservations); ?>';
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            let calendar;
            //Si la vista es mobile
            if(window.innerWidth < 768){
                calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'timeGridDay',
                    locale: 'es',
                    bussinesHours: {
                        daysOfWeek: [1, 2, 3, 4, 5, 6, 7],
                        startTime: '08:00',
                        endTime: '22:00'
                    },
                    headerToolbar: {
                        right: 'timeGridWeek,timeGridDay,listWeek',
                        center: 'title',
                        left: 'prev,next'
                    },
                    schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
                    events: [],
                    slotMinTime: '08:00:00',
                    slotMaxTime: '23:59:59',
                });
            }else{
                calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'timeGridWeek',
                    locale: 'es',
                    bussinesHours: {
                        daysOfWeek: [1, 2, 3, 4, 5, 6, 7],
                        startTime: '08:00',
                        endTime: '22:00'
                    },
                    headerToolbar: {
                        right: 'timeGridWeek,timeGridDay,listWeek',
                        center: 'title',
                        left: 'prev,next'
                    },
                    schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
                    events: [],
                    slotMinTime: '08:00:00',
                    slotMaxTime: '23:59:59',
                });
            }

            //Recorrer el array de reservas y agregarlas al calendario
            let reservas_array = JSON.parse(reservas);
            reservas_array.forEach(reserva => {
                let fecha_inicio = new Date(reserva.date + 'T' + reserva.time);
                let fecha_fin = new Date(reserva.date + 'T' + reserva.time);
                fecha_fin.setMinutes(fecha_fin.getMinutes() + 30);
                let evento = {
                    nombre: reserva.nombre,
                    apellido: reserva.apellido,
                    title: reserva.observations,
                    start: fecha_inicio,
                    end: fecha_fin,
                    allDay: false,
                };
                calendar.addEvent(evento);
            });

            calendar.on('eventClick', function(info) {
                let nombre = info.event.extendedProps.nombre;
                let apellido = info.event.extendedProps.apellido;
                let title = info.event.title;
                let date = info.event.start.toLocaleDateString();
                let time = info.event.start.toLocaleTimeString();
                setear_valores_input(nombre, apellido, title, date, time);
            });
            calendar.render();
        });
        // Codigo del navbar
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
   
        let formulario = document.querySelector('form');
        formulario.addEventListener('submit', function(event){
            event.preventDefault();
            //Tomar los valores que se quisieron enviar por el formulario, con el name
            let fecha_inicio = document.getElementById('fecha_reserva').value;
            let hora_inicio = document.getElementById('hora_reserva').value;
            let reserva_inicio = new Date(fecha_inicio + 'T' + hora_inicio);
            let reserva_fin = new Date(fecha_inicio + 'T' + hora_inicio);
            reserva_fin.setMinutes(reserva_fin.getMinutes() + 30);
            
            if(crear_evento(observaciones_reserva, fecha_inicio, reserva_fin) == false){
                toastr.error('No se puede reservar en ese dia y  horario', 'Error');
                formulario.reset();
                return false;
            }
            formulario.submit();
            let modal = document.getElementById('modal');
            modal.style.display = 'none';

        });

        function crear_evento(titulo, fecha_inicio, fecha_fin){
            let evento = {
                title: titulo,
                start: fecha_inicio,
                end: fecha_fin,
                allDay: false
            };

            //Recorrer el array de reservas, y ver si el nuevo evento se cruza con alguna reserva
            let reservas_array = JSON.parse(reservas);
            let colision = false;
            reservas_array.forEach(reserva => {
                let fecha_reserva = new Date(reserva.date + 'T' + reserva.time);
                let fecha_fin_reserva = new Date(reserva.date + 'T' + reserva.time);
                fecha_fin_reserva.setMinutes(fecha_fin_reserva.getMinutes() + 30);
                if(fecha_inicio >= fecha_reserva && fecha_inicio <= fecha_fin_reserva){
                    colision = true;
                }
                if(fecha_fin >= fecha_reserva && fecha_fin <= fecha_fin_reserva){
                    colision = true;
                }
                if(colision == true){
                    return false;
                }

                return true;
            });

            if(colision == true){
                return false;
            }

            let calendarEl = document.getElementById('calendar');
            let calendar = new FullCalendar.Calendar(calendarEl, {
                
                locale: 'es',
                headerToolbar: {
                    right: 'timeGridWeek,timeGridDay,listWeek',
                    center: 'title',
                    left: 'prev,next'
                },
                schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
                events: [evento]
            });
            //Si es la vista en mobile, que la vista inicial sea la de dia
            if(window.innerWidth < 768){
                calendar.setOption('initialView', 'dayGridWeek');
            }else{
                calendar.setOption('initialView', 'timeGridWeek');
            }

            calendar.render();
        }

        function open_modal(){
            let modal = document.getElementById('modal');
            modal.style.display = 'flex';
        }

        function setear_valores_input(nombre, apellido, title, date, time){
            date = date.split('/');
            let nueva_fecha = date[2] + '-' + date[1] + '-' + date[0]; 
            let nombre_element = document.getElementById('details_name');
            let apellido_element = document.getElementById('details_lastname');
            let fecha_reserva = document.getElementById('fecha_reserva_information');
            let hora_reserva = document.getElementById('hora_reserva_information');
            let observaciones_reserva = document.getElementById('observaciones_reserva_information');
            let modal_information = document.getElementById('modal_information');
            fecha_reserva.value = nueva_fecha;
            hora_reserva.value = time;
            observaciones_reserva.value = title;
            nombre_element.value = nombre;
            apellido_element.value = apellido;

            modal_information.style.display = 'flex';
        }

        function close_modal(element){
            let modal = document.getElementById(element);
            modal.style.display = 'none';
        }

        //Seteo la instancia de la libreria flatpickr
        let reserva = document.getElementById('fecha_reserva');
        flatpickr(reserva, {
            minDate: new Date().fp_incr(1),
            enableTime: false,
            dateFormat: "Y-m-d",
            locale: {
                firstDayOfWeek: 1,
                weekdays: {
                    shorthand: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
                    longhand: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
                },
                months: {
                    shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    longhand: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
                },
                rangeSeparator: ' a ',
                weekAbbreviation: 'Sm',
                scrollTitle: 'Desplazar para aumentar',
                toggleTitle: 'Click para cambiar',
                time_24hr: true,
            },
        });
        let hora_reserva = document.getElementById('hora_reserva');
        flatpickr(hora_reserva, {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            locale: {
                firstDayOfWeek: 1,
                weekdays: {
                    shorthand: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
                    longhand: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
                },
                months: {
                    shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    longhand: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
                },
                rangeSeparator: ' a ',
                weekAbbreviation: 'Sm',
                scrollTitle: 'Desplazar para aumentar',
                toggleTitle: 'Click para cambiar',
                time_24hr: true
            },
            minTime: "08:00",
            maxTime: "22:00",
            minuteIncrement: 30, 
        });

        let input_fecha_information = document.getElementById('fecha_reserva_information')
        flatpickr(input_fecha_information, {
            minDate: new Date().fp_incr(1),
            enableTime: false,
            dateFormat: "Y-m-d",
            locale: {
                firstDayOfWeek: 1,
                weekdays: {
                    shorthand: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
                    longhand: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
                },
                months: {
                    shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    longhand: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
                },
                rangeSeparator: ' a ',
                weekAbbreviation: 'Sm',
                scrollTitle: 'Desplazar para aumentar',
                toggleTitle: 'Click para cambiar',
                time_24hr: true
            },
        });

        let input_hora_information = document.getElementById('hora_reserva_information')
        flatpickr(input_hora_information, {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            locale: {
                firstDayOfWeek: 1,
                weekdays: {
                    shorthand: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
                    longhand: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
                },
                months: {
                    shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    longhand: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
                },
                rangeSeparator: ' a ',
                weekAbbreviation: 'Sm',
                scrollTitle: 'Desplazar para aumentar',
                toggleTitle: 'Click para cambiar',
                time_24hr: true
            },
            minTime: "08:00",
            maxTime: "22:00",
            minuteIncrement: 30, 
        });
    </script>
</html>