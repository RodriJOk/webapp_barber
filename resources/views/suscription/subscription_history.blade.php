<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="https://webappbarber-56b0944e3615.herokuapp.com/icons/cuidado.png" type="image/x-icon">
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <title>Historial de suscripciones</title>
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
        .close_session{
            background: none;
            border: none;
            margin: 0;
            padding: 0;
            font-size: 16px;
        }
        .main_section{
            min-width: 70%; 
            padding: 10px; 
            margin: 0 auto; 
            position: relative; 
            margin-left: 350px;
        }
        .container_title{
            display: flex; 
            flex-direction:row; 
            justify-content: space-between; 
            align-items: center;
        }
        .container_title .title{
            font-size: 26px
        }
        .container_title .button_toggle_navbar{
            padding: 10px; 
            width: 100%; 
            background-color:#00d1b2; 
            color:#fff; 
            border:none; 
            border-radius: 5px;
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
            font-weight: bold;
        }
        .table .table_body{
            text-align: center;
        }
        .table .table_body tr td{
            padding: 10px; 
            border-bottom: 1px solid #ccc;
        }
        .table .table_body tr:nth-child(odd) td{
            background-color: #fff;
        }
        .table .table_body tr:nth-child(even) td{
            background-color: #ebeced;
        }
        .container_information_empty{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 10px;
            border: 1px solid #ccccccd0;
            padding: 20px 10px;
            width: 50%;
            margin: 30px auto 15px;
        }
        .container_information_empty .image_empty_information{
            width: 60px;
            height: 60px;
        }
        .container_information_empty .title_empty_information{
            font-size: 24px;
            text-align: center;
            font-weight: 500;
        }
        @media (max-width: 768px){
            .navbar{
                padding: 20px 5px;
                z-index: 1000;
            }
            .navbar.close .button_toggle_navbar{
                text-align: center;
                margin: 0px auto;
            }
            .navbar.close .navbar_image{
                margin: 0px auto;
            }
            .main_section{
                margin-left: 80px;
            }
            .main_section .container_title .title{
                font-size: 20px;
                text-wrap: balance;
            }
            .table_header tr .id,
            .table_body tr .id_text{
                display: none;
            }
            .container_information_empty{
                width: 92%;
            }
            .container_information_empty .image_empty_information{
                width: 30px;
                height: 30px;
            }
            .container_information_empty .title_empty_information{
                font-size: 16px;
                text-align: center;
                font-weight: 500;
            }
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
                        <a href="{{ route('my_professionals') }}" class="text_link">Mis profesionales</a>
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
        <div class="main_section">
            <div class="container_title">
                <h2 class="title">Mi historial de suscripciones</h2>
            </div><?php 
            if($suscriptions){ ?>
                <table class="table">
                    <thead class="table_header">
                        <tr>
                            <th class="id">Id</th>
                            <th>Tipo de suscripcion</th>
                            <th>Fecha de inicio</th>
                            <th>Fecha de fin</th>
                        </tr>
                    </thead>
                    <tbody class="table_body"><?php
                        foreach($suscriptions as $suscription){ ?>
                            <tr>
                                <td class="id_text"><?php echo $suscription->id; ?></td>
                                <td><?php echo $suscription->type; ?></td>
                                <td><?php echo $suscription->start_date; ?></td>
                                <td><?php echo $suscription->end_date; ?></td>
                            </tr><?php
                        } ?>
                    </tbody>
                </table><?php 
            }else{ ?>
                <div class="container_information_empty">
                    <img 
                        class="image_empty_information"
                        src="{{asset('icons/quick_reference_black.png')}}"
                        alt="No hay un historia de suscripciones">
                    <h3 class="title_empty_information">No hay suscripciones que mostrar hasta el momento</h3>
                </div><?php
            } ?>
        </div>
    </main>

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
</body>
</html>