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
                <main>
                    <form action="{{ route('create_event')}}" method="POST">
                        @csrf
                        <div>
                            <label>Servicio</label>
                            <select name="service" id="service">
                                <option value="1">Corte de cabello</option>
                                <option value="2">Corte de barba</option>
                                <option value="3">Corte de cabello y barba</option>
                            </select>
                        </div>
                        <div>
                            <h3>Dias disponibles</h3>
                            <div class="container_dias_disponibles">
                            </div>
                        </div>
                        <div>
                            <h3>Horarios disponibles</h3>
                            <div class="container_horarios_disponibles">
                            </div>
                        </div>
                        <div>
                            <button class="create_event">Reservar</button>
                        </div>
                    </form>
                </main>
            </section>
        </main>
    </body>
    <script>
        //Codigo AJAX para obtener los dias disponibles
        
    </script>
</html>