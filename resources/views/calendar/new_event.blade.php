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
                cursor: pointer;
            }
            /* Estilos de select de profesionales */
            .select_professional{
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
            .select_professional option{
                background-color: #fff;
                color: #000;
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                padding: 0px 10px;
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
                    <h2 class="title">Realizar una nueva reserva</h2>
                </header>
                <main style="display:flex; flex-direction: column; width: 60%; margin: 0 auto; border: 2px solid #ccc;padding:10px; border-radius: 5px;">
                    <form action="{{ route('create_event')}}" method="POST" class="form_create_event">
                        @csrf
                        <div style="display:flex; flex-direction: column; justify-content: center; width:100%; gap:10px; margin:20px 0px;">
                            <label style="font-size:18px; font-weight: 700;">Profesionales</label>
                            <select name="professional" id="professional" class="select_professional">
                                <option value="">Selecciona un profesional</option>
                                @foreach($professionals as $professional)
                                    <option value="{{$professional->id}}">{{$professional->name}} {{$professional->surname}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="container_select_service" style="display:flex; flex-direction: column; justify-content: center; width:100%; gap:10px; margin:20px 0px; display:none;">
                            <label style="font-size:18px; font-weight: 700;">Servicio</label>
                            <select name="service" id="service" class="select_services">
                            </select>
                        </div>
                        <div class="container_days_available" style="display:none; margin:15px 0px;">
                            <label style="font-size:18px; font-weight: 700;">Dias disponibles</label>
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
                    let select_services = document.getElementById('service');
                    let services = response;
                    select_services.innerHTML = '';
                    if(services.length == 0){
                        select_services.innerHTML = '<option value="">No hay servicios disponibles</option>';
                        return;
                    }
                    if(services.length > 0){
                        select_services.innerHTML = '<option value="">Selecciona un servicio</option>';
                        services.forEach(service => {
                            select_services.innerHTML += `<option value="${service.id}">${service.name}</option>`;
                        });
                    }
                    else{
                        select_services.innerHTML = '<option value="">No hay servicios disponibles</option>';
                    }
                },
                error: function(error){
                    toastr.error('Ha ocurrido un error al obtener los servicios. Por favor, intenta de nuevo.');
                }
            });
        }

        $('.select_services').on('change', function(){
            let services = $(this).val();
            let professional = document.getElementById('professional');
            let id_professional = professional.options[professional.selectedIndex].value;
            get_available(services, id_professional);
        });
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
                    console.log(response);
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
                                <button onclick="show_slots(this)" class="button_day">
                                    <div class="day_information">
                                        <span>${day.date}</span>
                                        <span>
                                            <img src="{{asset('icons/expand_circle_down.png')}}" alt="Abrir" width="20px" height="20px">
                                        </span>
                                    </div>
                                </button>
                            </div>
                            <div class="slot_container">
                                ${day.availableSlots.map(slot => `
                                    <button class="slot_button" onclick="select_slot(this)">
                                        ${slot}
                                    </button>
                                `).join('')}
                            </div>
                        </div>`;
                    });

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
            // let professional = document.getElementById('professional');
            // let service = document.getElementById('service');
            // let slots = document.querySelectorAll('.day button');
            // let slots_selected = [];
            // slots.forEach(slot => {
            //     if(slot.style.backgroundColor == 'rgb(0, 209, 178)'){
            //         slots_selected.push(slot.innerText);
            //     }
            // });
            // if(professional.value == ''){
            //     toastr.error('Debes seleccionar un profesional');
            //     return;
            // }
            // if(service.value == ''){
            //     toastr.error('Debes seleccionar un servicio');
            //     return;
            // }
            // if(slots_selected.length == 0){
            //     toastr.error('Debes seleccionar al menos un horario');
            //     return;
            // }
            // $.ajax({
            //     url: '{{route('create_event')}}',
            //     type: 'POST',
            //     data: {
            //         _token: '{{csrf_token()}}',
            //         professional: professional.value,
            //         service: service.value,
            //         slots: slots_selected
            //     },
            //     success: function(response){
            //         toastr.success('Reserva realizada con exito');
            //         setTimeout(() => {
            //             window.location.href = '{{route('my_calendar')}}';
            //         }, 2000);
            //     },
            //     error: function(error){
            //         toastr.error('Ha ocurrido un error al realizar la reserva. Por favor, intenta de nuevo.');
            //     }
            // });
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
            //Si se selecciono todo le formulario, se limpia. Si no se redirige a la pagina principal
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
    </script>
</html>