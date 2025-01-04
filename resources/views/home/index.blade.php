<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="https://webappbarber-56b0944e3615.herokuapp.com/icons/cuidado.png" type="image/x-icon">
        <link rel="stylesheet" href="{{ asset('layout/sidebar.css') }}">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <title>Home</title>
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
                margin: 10px 0px 30px;
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
                background: none; border:none;
            }
            .button_toggle_navbar .toggle_navbar{
                transform: rotate(180deg);
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
            .section{
                min-width: 60%; 
                padding: 10px; 
                margin: 0 auto; 
                position: relative; 
                margin-left: 350px; 
            }
            /* Estilos de la seccion de enlaces */
            .link_container{
                display: flex; 
                flex-direction:row; 
                flex-wrap: wrap; 
                width:850px; 
                gap: 15px; 
                margin: 0 auto; 
                text-align:center; 
                justify-content:center;
            }
            .link{
                border: 1px solid #ccc; 
                text-align:center; 
                display:flex; 
                flex-direction:row; 
                text-decoration:none; 
                color: #00000091;
                width:45%; 
                border-radius: 20px; 
                justify-content:left; 
                gap: 20px;
                height:65px;
                padding: 0px 10px;
            }
            .link_icon{
                display: flex; 
                flex-direction:column; 
                justify-content:center;
            }
            .link_icon img{
                width: 30px;
                height: 30px;
            }
            .link_info{
                display: flex; 
                flex-direction:column; 
                text-align:left;
                justify-content: center;
            }
            .link_info .title{
                font-size: 16px; 
                margin: 5px 0px;
            }
            .link_info .description{
                font-size: 14px; 
                text-wrap:balance; 
                margin: 5px 0px;
            }
            @media (max-width: 768px){
                .navbar{
                    z-index: 9999;
                }
                .section{
                    margin-left: 80px;
                }
                .section .header{
                    text-align: center;
                    margin: 30px 0px;
                }
                .section .header .header_title{
                    font-size: 18px;
                }
                .link_container{
                    width: 100%;
                    flex-direction: column;
                }
                .link{
                    width: 90%;
                    height: 70px;
                }
                .link_info .title{
                    font-size: 14px;
                }
                .link_info .description{
                    font-size: 12px;
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
                            height="20px">
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
                                src="{{asset('icons/scissors.png')}}"
                                alt="Sucursales"
                                width="20px"
                                height="20px">
                            <a href="{{ route('my_services') }}" class="text_link">Mis servicios</a>
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
            <section class="section">
                <header class="header">
                    <h1 class="header_title">Bienvenido a la aplicacion</h1>
                </header>
                <main class="link_container">
                    <a href="{{ route('my_profile') }}" class="link">
                        <div class="link_icon">
                            <img src="{{asset('icons/person_grey.png')}}" alt="Perfil. Ajustar y cambiar la configuracion del perfil">
                        </div>
                        <div class="link_info">
                            <h2 class="title">Perfil</h2>
                            <p class="description">Ajusta y cambiar la configuracion del perfil</p>
                        </div>
                    </a>
                    <a href="{{ route('my_calendar') }}" class="link">
                        <div class="link_icon">
                            <img src="{{asset('icons/calendar_grey.png')}}" alt="Reservas. Gestiona tus horarios y los de tus clientes">
                        </div>
                        <div class="link_info">
                            <h2 class="title">Ver tus reservas</h2>
                            <p class="description">Gestiona tus horarios y los de tus clientes</p>
                        </div>
                    </a>
                    <a href="{{ route('my_clients') }}" class="link">
                        <div class="link_icon">
                            <img src="{{asset('icons/client_grey.png')}}" alt="Clientes. Contacta a tus clientes de forma rapida y sencilla">
                        </div>
                        <div class="link_info">
                            <h2 class="title">Mis clientes</h2>
                            <p class="description">Contactalos de forma rapido y sencilla</p>
                        </div>
                    </a>
                    <a href="{{ route('suscription') }}" class="link">
                        <div class="link_icon">
                            <img src="{{asset('icons/credit_card_grey.png')}}" alt="Mi suscripcion. Renueva y gestiona tu membresia">
                        </div>
                        <div class="link_info">
                            <h2 class="title">Mis suscripcion</h2>
                            <p class="description">Renueva y gestiona tu membresia</p>
                        </div>
                    </a>
                    <a href="{{ route('my_services') }}" class="link">
                        <div class="link_icon">
                            <img src="{{asset('icons/scissors.png')}}" alt="Tipo de servicios. Gestiona tus servicios">
                        </div>
                        <div class="link_info">
                            <h2 class="title">Mis servicios</h2>
                            <p class="description">Gestiona tus servicios</p>
                        </div>
                    </a>
                </main>
            </section>
        </main>
    </body>
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
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-0JRDR6DM4F"></script>
    <script>
        //Agrego el acceso a Google Analitycs
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-0JRDR6DM4F');
    </script>
</html>