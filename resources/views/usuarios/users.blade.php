<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="https://webappbarber-56b0944e3615.herokuapp.com/icons/cuidado.png" type="image/x-icon">
        <title>Listado de usuarios</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <style>
            body{
                font-family: Verdana, Geneva, Tahoma, sans-serif;
                padding: 0px;
                margin: 0px;
                box-sizing: border-box;
            }
            .title{
                text-align: center;
            }
            .list{
                text-align: center;
                list-style: none;
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
                    <?php if(Auth::user()->rol_id == 1){ ?>
                        <li>
                            <div style="display: flex; flex-direction: row; gap: 10px;">
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
            <section style="min-width: 60%; padding: 10px; margin: 0 auto; position: relative; margin-left: 350px; ">
                <header>
                    <div>
                        <h1 class="title">Listado de los usuarios</h1>
                    </div>
                </header>

                <main>
                    <ul class="list">
                        @foreach ($users as $user)
                            <li>- 
                                <span style="padding: 0px 10px">{{ $user['id'] }}</span>
                                <span style="padding: 0px 10px">{{ $user['name'] }}</span>
                                <span style="padding: 0px 10px">{{ $user['email'] }}</span>
                        @endforeach
                    </ul>
                </main>

                <footer style="text-align: center">
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                </footer>
            </section>
        </main>
    </body>

    {{-- Script del navbar --}}
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
</html>