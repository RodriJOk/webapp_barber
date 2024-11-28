<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.15/index.global.min.js'></script>
        <title>Editar los datos de un profesional</title>
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
            }
            .container_form{
                max-width: 500px;
            }
            .form-group{
                margin: 10px 0px;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }
            .form-group .input_name,
            .form-group .input_surname,
            .form-group .input_branch_name,
            .form-group .input_created_at,
            .form-group .input_update_at,
            .form-group .input_phone,
            .form-group .input_email{
                margin: 10px auto;
                border: 1px solid #ccc; 
                color: #000; 
                width: 100%; 
                font-size: 16px; 
                height: 40px;
                outline: none; 
                text-decoration: none; 
                background: transparent;
                border-radius: 15px;
                padding: 0px 5px;
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
                            <a href="{{ route('my_professionals') }}" class="text_link">Mis colaboradores</a>
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
                    <h2 class="title">Editar los datos de un profesional</h2>
                </div>

                <main>
                    <div class="container_form">
                        <form action="{{ route('update_profesional', $professional->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Nombre:</label>
                                <input 
                                    type="text" 
                                    class="input_name" 
                                    id="name" 
                                    name="name" 
                                    value="{{ $professional->name }}">
                            </div>
                            <div class="form-group">
                                <label for="surname">Apellido:</label>
                                <input 
                                    type="text" 
                                    class="input_surname"
                                    id="surname" 
                                    name="surname" 
                                    value="{{ $professional->surname }}">
                            </div>
                            <div class="form-group">
                                <label for="branch_name">Sucursal en la que trabaja:</label>
                                <input 
                                    type="text" 
                                    class="input_branch_name"
                                    id="branch_name" 
                                    name="branch_name" 
                                    value="{{ $professional->branch_name }}">
                            </div>
                            <div class="form-group">
                                <label for="created_at">Fecha de creacion:</label>
                                <input 
                                    type="text" 
                                    class="input_created_at" 
                                    id="created_at" 
                                    name="created_at"
                                    value="{{ $professional->created_at }}">
                            </div>
                            <div class="form-group">
                                <label for="update_at">Ultima actualizacion:</label>
                                <input 
                                    type="text" 
                                    class="input_update_at" 
                                    id="update_at" 
                                    name="update_at" 
                                    value="{{ $professional->update_at }}">
                            </div>
                            <div class="form-group">
                                <label for="phone">Celular:</label>
                                <input 
                                    type="text" 
                                    class="input_phone" 
                                    id="phone" 
                                    name="phone" 
                                    value="{{ $professional->phone }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input 
                                    type="text" 
                                    class="input_email" 
                                    id="email" 
                                    name="email" 
                                    value="{{ $professional->email }}">
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
                    </div>
                </main>
            </div>
        </main>
    </body>
</html>