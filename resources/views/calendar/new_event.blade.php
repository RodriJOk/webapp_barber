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
        <title>Realizar una reserva</title>
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
            .navbar .button_toggle_navbar{
                background: none;
                border: none;
                cursor: pointer;
                color: #fff;
                font-size: 16px;
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
                cursor: pointer;
            }
            /* Estilos de la seccion main contenedor principal */
            .calendar_container{
                min-width: 70%; 
                padding: 10px; 
                margin: 0 auto; 
                position: relative; 
                margin-left: 350px;
            }
            .calendar_container .header{
                display: flex; 
                flex-direction:row; 
                justify-content: space-between; 
                align-items: center;
            }
            .calendar_container .header .title{
                font-size: 26px;
            }
            .calendar_container .body{
                display:flex; 
                flex-direction: column; 
                width: 60%; 
                margin: 0 auto; 
                border: 2px solid #ccc;
                padding:10px; 
                border-radius: 5px;
            }
            /* Estilos del select de profesionales */
            .container_select_professional{
                display:flex; 
                flex-direction: column; 
                justify-content: center; 
                width:100%; 
                gap:10px; 
                margin:20px 0px;
            }
            .container_select_professional .label_select{
                font-size:18px; 
                font-weight: 700;
            }
            .container_select_professional .select_professional{
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
            .container_select_professional .select_professional option{
                background-color: #fff;
                color: #000;
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                padding: 0px 10px;
            }
            /* Estilos del contenedor de servicios */
            .container_select_service{
                display:flex; 
                flex-direction:column; 
                display:none;
            }
            .container_select_service .label_select{
                font-size:18px; 
                font-weight: 700;
            }
            .container_select_service .container_services{
                margin: 10px auto;
                border: 1px solid #ccc; 
                width: 100%;
                font-size: 16px; 
                outline: none; 
                text-decoration: none; 
                background: transparent;
                border-radius: 15px;
                color: #000;
            }
            .container_services .header_type_service{
                height: 40px;
                min-width: 99%;
                max-width: 100%; 
                display: flex; 
                flex-direction: row; 
                justify-content: space-between; 
                align-items: center; 
                padding: 0 10px;
                background: none;
                border: none;
            }
            .container_services .header_type_service .title_service{
                font-size: 16px; 
                font-weight: 400; 
                margin: 0;
            }
            .container_services .body_type_service{
                display: none; 
                flex-direction: column;
                gap: 10px;
                max-width: 100%;
                list-style: none;
                padding: 0;
                margin: 15px 0px;
            }
            .container_services .body_type_service li .container_item_service{
                min-width: 97%;
                max-width: 100%; 
                background: none; 
                border: none; 
                cursor: pointer; 
                display: flex; 
                justify-content: space-between;
                border:1px solid #ccc;
                font-size:18px;
                text-align: center;
                margin: 0 auto;
                border-radius:15px;
            }
            .container_item_service .title{}
            .container_item_service .price{
                display:flex; 
                flex-direction: row; 
                justify-content:center; 
                gap: 5px;
            }
            .container_item_service .time{
                display:flex; 
                flex-direction: row; 
                justify-content:center; 
                gap: 5px
            }
            /* Estilos del contenedor de dias */
            .container_days_available{
                display:none;
                margin: 15px 0px;
            }
            .container_days_available .title{
                font-size:18px; 
                font-weight: 700;
            }
            /* Estilos de la seccion de servicios */
            .select_services{
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
            .select_services option{
                background-color: #fff;
                color: #000;
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                padding: 0px 10px;
            }
            /* Estilos del desplegable de los dias */
            .days_available{
                margin: 10px auto;
                text-align: center;
                max-width: 90%;
            }
            .day{
                display:flex;
                flex-direction:column;
                justify-content:center;
                border: 1px solid #ccc;
                width: 100%;
                margin: 10px 0px;
            }
            .day_container .button_day{
                background:none; 
                border:none; 
                font-size:14px; 
                font-weight:900; 
                margin:10px 0px; 
                cursor:pointer; 
                width:100%;
            }
            .button_day .day_information{
                display:flex; 
                flex-direction: row; 
                justify-content: space-between;
            }
            .slot_container{
                display:flex; 
                flex-direction: row; 
                flex-wrap: wrap; 
                gap:5px; 
                display:none; 
                padding: 0px 5px;
            }
            .slot_container .slot_button{
                color:#000; 
                padding:10px; 
                border-radius:5px; 
                cursor:pointer; 
                width:auto; 
                border:1px solid #ccc; 
                background:none; 
                margin:5px 0px;
            }
            /* Seccion de la informacion de los usuarios */
            .container_user_information{
                display:flex; 
                flex-direction: column; 
                justify-content: center; 
                width:100%; 
                gap:10px; 
                margin:20px 0px;
            }
            .container_user_information .user_name, 
            .container_user_information .user_contact{
                display: flex; 
                flex-direction: row; 
                gap: 10px;
                margin: 0 auto;
                width: 100%;
                justify-content: center;
            }
            .user_name .item_name, 
            .user_name .item_surname,
            .user_contact .item_email,
            .user_contact .item_phone{
                display:flex; 
                flex-direction:column; 
                gap:5px;
                width: 50%;
            }

            .user_name .item_name .input_user_name,
            .user_name .item_surname .input_user_surname,
            .user_contact .item_email .input_user_email,
            .user_contact .item_phone .input_user_phone{
                margin: 10px auto;
                border: 1px solid #ccc; 
                color: #000; 
                width: 85%; 
                font-size: 16px; 
                height: 40px;
                outline: none; 
                text-decoration: none; 
                background: transparent;
                border-radius: 15px;
                padding: 0px 16px;
            }
            /* Estilos de la seccion de contenedor de botones */
            .container_buttom{
                display: flex; 
                flex-direction: row; 
                margin: 10px 0px; 
                width:100%;
                font-size: 18px;
            }
            .container_buttom .cancel_event{
                padding: 10px 0px;
                width: 50%; 
                background-color:#c50f34; 
                color:#fff; 
                border:none; 
                border-radius: 5px; 
                margin-right: 10px;
            }
            .container_buttom .create_event{
                padding: 10px 0px;
                width: 50%; 
                color:#fff; 
                border:none; 
                border-radius: 5px;
                background-color: #ccc;
            }
            @media (max-width: 768px){
                .header .title{
                    font-size: 18px;
                }
                .calendar_container{
                    margin-left: 70px;
                    min-width: 78%;
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
                    <button 
                        class="button_toggle_navbar" 
                        onclick="toggle_navbar()">
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
                    <h2 class="title">Realizar una nueva reserva</h2>
                </header>
                <main class="body">
                    <form action="{{ route('create_event')}}" method="POST" class="form_create_event">
                        @csrf
                        <div class="container_select_professional">
                            <label class="label_select" for="professional">
                                Profesionales
                            </label>
                            <select name="professional" id="professional" class="select_professional">
                                <option value="">Selecciona un profesional</option>
                                @foreach($professionals as $professional)
                                    <option value="{{$professional->id}}">{{$professional->name}} {{$professional->surname}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="container_select_service">
                            <label class="label_select" for="container_services">
                                Servicios
                            </label>
                            <div id="container_services" class="container_services">
                                <button
                                    class="header_type_service"
                                    onclick="toggle_mostrar_opciones('opciones_servicios')"
                                    type="button">
                                    <h2 class="title_service">Seleccione un servicio</h2>
                                    <img
                                        class="icon_toggle_options" 
                                        src="{{ asset('icons/expand_circle_down.png') }}" 
                                        alt="Abrir" 
                                        width="20" 
                                        height="20"/>
                                </button>
                                <ul class="body_type_service" id="opciones_servicios">
                                    <li>
                                        <button 
                                            class="container_item_service"
                                            onclick="select_services(this)"
                                            type="button">
                                            <span class="title">Corte de pelo</span>
                                            <span class="price">
                                                <img 
                                                    src="{{ asset('icons/money.png') }}" 
                                                    alt="Pricing" 
                                                    width="20" 
                                                    height="20" />
                                                <span>7000 ARS</span>
                                            </span>
                                            <span class="time">
                                                <img 
                                                    src="{{asset('icons/clock.png')}}" 
                                                    alt="Duration" 
                                                    width="20" 
                                                    height="20" />    
                                                <span>30 minutos</span>
                                            </span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="container_days_available">
                            <label class="title">Dias disponibles</label>
                            <div class="days_available"></div>
                        </div>
                        <div class="container_buttom">
                            <button 
                                type="buttom" 
                                class="cancel_event" 
                                onclick="cancel_event()">
                                Cancelar
                            </button>
                            <button 
                                type="submit" 
                                class="create_event"
                                disabled>
                                Reservar
                            </button>
                        </div>
                    </form>
                </main>
            </section>
        </main>
    </body>
    <script>
        $('.select_professional').on('change', function(){
            let professional = $(this).val();
            let container_services= document.getElementsByClassName('container_select_service')[0];
            let container_days_available = document.getElementsByClassName('container_days_available')[0];
            if(container_services.style.display == 'block'){
                container_services.style.display = 'none';
            }
            if(container_days_available.style.display == 'block'){
                container_days_available.style.display = 'none';
            }
            
            get_services(professional);
        });

        function get_services(id_professional){
            let professional = $('#professional').val();
            $.ajax({
                url: '{{route('get_services_by_professional')}}',
                type: 'POST',
                data: {
                    id_professional: id_professional,
                    _token: '{{csrf_token()}}'
                },
                success: function(response){
                    let container_services= document.getElementsByClassName('container_select_service')[0];
                    container_services.style.display = 'block';
                    let select_services = document.getElementById('opciones_servicios');
                    let services = response;
                    if(services.length == 0){
                        select_services.innerHTML = `
                            <li>
                                <button 
                                    type="button" 
                                    style="
                                        min-width: 97%;
                                        max-width: 100%; 
                                        background: none; 
                                        border: none; 
                                        cursor: pointer; 
                                        display: flex; 
                                        justify-content: space-between;
                                        border:1px solid #ccc;
                                        font-size:18px;
                                        text-align: center;
                                        margin: 0 auto;
                                        border-radius:15px;
                                        ">
                                    <span>No hay servicios disponibles</span>
                                </button>
                            </li>`;
                    }

                    select_services.innerHTML = '';
                    services.forEach(service => {
                        select_services.innerHTML += `
                            <li>
                                <button 
                                    onclick="select_services(this, ${service.id})"
                                    type="button" 
                                    style="
                                        min-width: 97%;
                                        max-width: 100%; 
                                        background: none; 
                                        border: none; 
                                        cursor: pointer; 
                                        display: flex; 
                                        justify-content: space-between;
                                        border:1px solid #ccc;
                                        font-size:18px;
                                        text-align: center;
                                        margin: 0 auto;
                                        border-radius:15px;
                                        ">
                                    <span class="service_id" style="display:none;">${service.id}</span>
                                    <span>${service.name}</span>
                                    <span style="display:flex; flex-direction: row; justify-content:center; gap: 5px">
                                        <img src="{{ asset('icons/money.png') }}" alt="Pricing" width="20" height="20" />
                                        <span>${service.price} ARS</span>
                                    </span>
                                    <span style="display:flex; flex-direction: row; justify-content:center; gap: 5px">
                                        <img src="{{ asset('icons/clock.png') }}" alt="Duration" width="20" height="20" />    
                                        <span>${service.duration} minutos</span>
                                    </span>
                                </button>
                            </li>`;
                    });
                },
                error: function(error){
                    toastr.error('Ha ocurrido un error al obtener los servicios. Por favor, intenta de nuevo.');
                }
            });
        }

        function get_available(services, id_professional){
            $.ajax({
                url: '{{route('get_availability_day')}}',
                type: 'POST',
                data: {
                    _token: '{{csrf_token()}}',
                    services: services,
                    id_professional: id_professional,
                    date: new Date().toISOString().split('T')[0]
                },
                success: function(response){
                    if(response.availability_by_day == 0){
                        toastr.error('No hay dias disponibles para el profesional seleccionado');
                        return;
                    }
                    let container_days_available = document.getElementsByClassName('container_days_available')[0];
                    container_days_available.style.display = 'block';
                    
                    let days_available = document.getElementsByClassName('days_available')[0];
                    days_available.innerHTML = '';
                    
                    response.availability_by_day.forEach(day => {
                        days_available.innerHTML += `
                        <div class="day">
                            <div class="day_container">
                                <button onclick="show_slots(this)" class="button_day" type="button">
                                    <div class="day_information">
                                        <span>${day.date}</span>
                                        <span>
                                            <img src="{{asset('icons/expand_circle_down.png')}}" alt="Abrir" width="20px" height="20px">
                                        </span>
                                    </div>
                                </button>
                            </div>
                            <div class="slot_container">
                                ${day.availableSlots.map(slot =>
                                `
                                    <button class="slot_button" onclick="select_slot(this)" type="button">
                                        <span id="time_slot">${slot.hora}</span>
                                        <input id="day_slot" type="hidden" name="day" value="${slot.dia}">
                                    </button>`).join('')}
                            </div>
                        </div>`;
                    });

                    days_available.innerHTML += `<div class="user_information"></div>`;
                    mostrar_informacion_usuario();

                    let button_create_event = document.getElementsByClassName('create_event')[0];
                    button_create_event.disabled = false;
                    button_create_event.style.backgroundColor = '#00d1b2';
                },
                error: function(error){
                    toastr.error('Ha ocurrido un error al obtener los dias disponibles. Por favor, intenta de nuevo.');
                }
            });
        }

        function show_slots(element){
            let slot_container = element.parentElement.nextElementSibling;
            if(slot_container.style.display == 'none'){
                slot_container.style.display = 'flex';
            }
            else{
                slot_container.style.display = 'none';
            }
        }

        let form_create_event = document.getElementsByClassName('form_create_event')[0];
        form_create_event.addEventListener('submit', function(event){
            event.preventDefault();
            let professional = document.getElementById('professional');
            let slots = document.querySelectorAll('.day button');
            let slots_selected = [];
            slots.forEach(slot => {
                if(slot.style.backgroundColor == 'rgb(0, 209, 178)'){
                    let day = slot.querySelector('#day_slot').value;
                    let time = slot.querySelector('#time_slot').innerText;
                    slots_selected.push({
                        time: time,
                        day: day
                    });
                }
            });
            if(professional.value == ''){
                toastr.error('Debes seleccionar un profesional');
                return;
            }
            //Validar que se seleccione un servicio
            let service = document.querySelectorAll('#opciones_servicios li button');
            service = Array.from(service).filter(element => element.style.backgroundColor == 'rgb(0, 209, 178)');
            let service_id = service[0].querySelector('.service_id').innerText;
            if(service.length == 0){
                toastr.error('Debes seleccionar un servicio');
                return;
            }
            if(slots_selected.length == 0){
                toastr.error('Debes seleccionar un dia y un horario');
                return;
            }

            //Si se selecciona un dia y un horario que es menor a la fecha actual, se muestra un mensaje de error
            let date = new Date();
            let day = slots_selected[0].day.split('-');
            let time = slots_selected[0].time.split(':');
            let date_selected = new Date(day[0], day[1] - 1, day[2], time[0], time[1]);
            if(date_selected < date){
                toastr.error('No puedes seleccionar un dia y horario menor a la fecha actual');
                return;
            }

            //Creo un input para enviar el slot seleccionado
            let input_day = document.createElement('input');
            input_day.type = 'hidden';
            input_day.name = 'day';
            input_day.value = slots_selected[0].day;
            form_create_event.appendChild(input_day);

            //Creo un input para enviar la fecha del slot seleccionado
            let input_time = document.createElement('input');
            input_time.type = 'hidden';
            input_time.name = 'time';
            input_time.value = slots_selected[0].time;
            form_create_event.appendChild(input_time);

            //Crear un input para enviar el servicio seleccionado
            let input_service = document.createElement('input');
            input_service.type = 'hidden';
            input_service.name = 'service';
            input_service.value = service_id;
            form_create_event.appendChild(input_service);

            form_create_event.submit();
        });
        function select_slot(element){
            let slots = document.querySelectorAll('.day button');
            slots.forEach(slot => {
                slot.style.backgroundColor = 'transparent';
                slot.style.color = '#000';
            });

            if(element.style.backgroundColor == 'rgb(0, 209, 178)'){
                element.style.backgroundColor = 'transparent';
                element.style.color = '#000';
            }
            else{
                element.style.backgroundColor = '#00d1b2';
                element.style.color = '#fff';
            }
        }
        function cancel_event(){
            let professional = document.getElementById('professional');
            let service = document.getElementById('service');
            let slots = document.querySelectorAll('.day button');
            if(professional.value != '' || service.value != '' || slots.length > 0){
                professional.value = '';
                service.value = '';
                slots.forEach(slot => {
                    slot.style.backgroundColor = 'transparent';
                });
            }
            else{
                window.location.href = '{{route('my_calendar')}}';
            }
        }
        function mostrar_informacion_usuario(){
            let user_information = document.getElementsByClassName('user_information')[0];
            user_information.innerHTML = `
                <div class="container_user_information">
                    <div class="user_name">
                        <div class="item_name">
                            <label for="name">Nombre</label>    
                            <input 
                                class="input_user_name"
                                type="text" 
                                name="name"
                                id="name" 
                                placeholder="Nombre"
                                autocomplete="off" 
                                required>
                        </div>
                        <div class="item_surname">
                            <label for="surname">Apellido</label>    
                            <input 
                                class="input_user_surname"
                                type="text" 
                                name="surname" 
                                id="surname"
                                placeholder="Apellido"
                                autocomplete="off" 
                                required>
                        </div>
                    </div>
                    <div class="user_contact">
                        <div class="item_email">
                            <label for="email">Email</label>    
                            <input 
                                class="input_user_email"
                                type="email" 
                                name="email" 
                                id="email"
                                placeholder="Correo electronico" 
                                autocomplete="off"
                                required>
                        </div>
                        <div class="item_phone">
                            <label for="phone">Celular</label>    
                            <input 
                                class="input_user_phone"
                                type="text" 
                                name="phone"
                                id="phone" 
                                placeholder="Celular" 
                                autocomplete="off"
                                required>
                        </div>
                    </div>
                </div>
            `;
        }
        function toggle_mostrar_opciones(elemento){
            let container_options = document.getElementById(elemento); 
            let image = document.getElementsByClassName('icon_toggle_options')[0];
            if(container_options.style.display == 'none'){
                container_options.style.display = 'flex';
                image.style.transform = 'rotate(180deg)';
            }
            else{
                container_options.style.display = 'none';
                image.style.transform = 'rotate(0deg)';
            }
        }
        function select_services(element, id){
            let buttons = document.querySelectorAll('.container_services button');
            buttons.forEach(button => {
                button.style.backgroundColor = 'transparent';
                button.style.color = '#000';
            });
            element.style.backgroundColor = '#00d1b2';
            element.style.color = '#fff';

            let professional = document.getElementById('professional');
            let services = id;
            get_available(services, professional.value);
        }
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
    </script>
</html>