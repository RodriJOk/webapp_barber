<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="https://webappbarber-56b0944e3615.herokuapp.com/icons/cuidado.png" type="image/x-icon">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


        <title>Mis sucursales</title>
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
            .navbar .header .button_toggle_navbar{
                background: none; 
                border:none;
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
                background: none; 
                border:none;
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
                cursor: pointer;
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
                    <button class="button_toggle_navbar" onclick="toggle_navbar()">
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
                                src="{{asset('icons/groups.png')}}" 
                                alt="Sucursales"
                                width="20px"
                                height="20px">
                            <a href="{{ route('my_branch') }}" class="text_link">Mis sucursales</a>
                        </div>
                    </li>
                    <li>
                        <div class="item" style="cursor: pointer;">
                            <img
                                class="navbar_image"
                                src="{{asset('icons/logout.png')}}" 
                                alt="Abrir"
                                width="20px"
                                height="20px">
                            <form action="{{ route('close_session') }}" method="POST" class="form_close_session">
                                @csrf
                                <button class="text_link close_session" onclick="cerrar_session()">Cerrar Session</button>
                            </form>
                        </div>
                    </li>
                </ul>
            </navbar>
            <section class="calendar_container">
                <header class="header">
                    <h2 class="title">Mis sucursales</h2>
                    <div class="container_button">
                        <a href="{{ route('new_branch') }}" class="create_event">
                            Crear una nueva sucursal
                        </a>
                    </div>
                </header>
                <div class="calendar">
                    <?php if($branches){ ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Direccion</th>
                                <th>Telefono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($branches as $branch)
                                <tr>
                                    <td>{{ $branch['name'] }}</td>
                                    <td>{{ $branch['address'] }}</td>
                                    <td>{{ $branch['phone'] }}</td>
                                    <td>
                                        <a href="{{ route('edit_branch', ['id' => $branch['id']]) }}">Editar</a>
                                        <a href="{{ route('delete_branch', ['id' => $branch['id']]) }}">Eliminar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <?php }else{ ?>
                        <h2>No tienes sucursales registradas</h2>
                    <?php } ?>
            </section>
        </main>
    </body>
    <script>

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
   
        // let formulario = document.querySelector('form');
        // formulario.addEventListener('submit', function(event){
        //     event.preventDefault();
        //     //Tomar los valores que se quisieron enviar por el formulario, con el name
        //     let fecha_inicio = document.getElementById('fecha_reserva').value;
        //     let hora_inicio = document.getElementById('hora_reserva').value;
        //     let reserva_inicio = new Date(fecha_inicio + 'T' + hora_inicio);
        //     let reserva_fin = new Date(fecha_inicio + 'T' + hora_inicio);
        //     reserva_fin.setMinutes(reserva_fin.getMinutes() + 30);
            
        //     if(crear_evento(observaciones_reserva, fecha_inicio, reserva_fin) == false){
        //         toastr.error('No se puede reservar en ese dia y  horario', 'Error');
        //         formulario.reset();
        //         return false;
        //     }
        //     formulario.submit();
        //     let modal = document.getElementById('modal');
        //     modal.style.display = 'none';

        // });

        // function crear_evento(titulo, fecha_inicio, fecha_fin){
        //     let evento = {
        //         title: titulo,
        //         start: fecha_inicio,
        //         end: fecha_fin,
        //         allDay: false
        //     };

        //     //Recorrer el array de reservas, y ver si el nuevo evento se cruza con alguna reserva
        //     let reservas_array = JSON.parse(reservas);
        //     let colision = false;
        //     reservas_array.forEach(reserva => {
        //         let fecha_reserva = new Date(reserva.date + 'T' + reserva.time);
        //         let fecha_fin_reserva = new Date(reserva.date + 'T' + reserva.time);
        //         fecha_fin_reserva.setMinutes(fecha_fin_reserva.getMinutes() + 30);
        //         if(fecha_inicio >= fecha_reserva && fecha_inicio <= fecha_fin_reserva){
        //             colision = true;
        //         }
        //         if(fecha_fin >= fecha_reserva && fecha_fin <= fecha_fin_reserva){
        //             colision = true;
        //         }
        //         if(colision == true){
        //             return false;
        //         }

        //         return true;
        //     });

        //     if(colision == true){
        //         return false;
        //     }

        //     let calendarEl = document.getElementById('calendar');
        //     let calendar = new FullCalendar.Calendar(calendarEl, {
                
        //         locale: 'es',
        //         headerToolbar: {
        //             right: 'timeGridWeek,timeGridDay,listWeek',
        //             center: 'title',
        //             left: 'prev,next'
        //         },
        //         schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
        //         events: [evento]
        //     });
        //     //Si es la vista en mobile, que la vista inicial sea la de dia
        //     if(window.innerWidth < 768){
        //         calendar.setOption('initialView', 'dayGridWeek');
        //     }else{
        //         calendar.setOption('initialView', 'timeGridWeek');
        //     }

        //     calendar.render();
        // }

        // function open_modal(){
        //     let modal = document.getElementById('modal');
        //     modal.style.display = 'flex';
        // }

        // function setear_valores_input(nombre, apellido, title, date, time){
        //     date = date.split('/');
        //     let nueva_fecha = date[2] + '-' + date[1] + '-' + date[0]; 
        //     let nombre_element = document.getElementById('details_name');
        //     let apellido_element = document.getElementById('details_lastname');
        //     let fecha_reserva = document.getElementById('fecha_reserva_information');
        //     let hora_reserva = document.getElementById('hora_reserva_information');
        //     let observaciones_reserva = document.getElementById('observaciones_reserva_information');
        //     let modal_information = document.getElementById('modal_information');
        //     fecha_reserva.value = nueva_fecha;
        //     hora_reserva.value = time;
        //     observaciones_reserva.value = title;
        //     nombre_element.value = nombre;
        //     apellido_element.value = apellido;

        //     modal_information.style.display = 'flex';
        // }

        // function close_modal(element){
        //     let modal = document.getElementById(element);
        //     modal.style.display = 'none';
        // }

        // function cerrar_session(){
        //     let form_close_session = document.getElementsByClassName('form_close_session')[0];
        //     form_close_session.submit();
        //     toastr.success('Sesion cerrada correctamente', 'Exito');
        // }
    </script>
</html>