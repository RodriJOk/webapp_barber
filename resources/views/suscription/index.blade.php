<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="https://webappbarber-56b0944e3615.herokuapp.com/icons/cuidado.png" type="image/x-icon">
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <title>Membresia</title>
    <style>
        body{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
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
        .container_title .button_payment_history{
            padding: 10px; 
            background-color:#00d1b2; 
            color:#fff; 
            border:none; 
            border-radius: 5px;
            cursor: pointer;
        }
        .container_title .button_toggle_navbar{
            padding: 10px; 
            width: 100%; 
            background-color:#00d1b2; 
            color:#fff; 
            border:none; 
            border-radius: 5px;
        }
        .section-status_suscription{
            display: flex; 
            flex-direction: column; 
            justify-content: space-between; 
            align-items: center; 
            border: 2px solid #012e46; 
            padding: 10px; 
            border-radius: 5px; 
            max-width: 97%; 
            margin: 30px auto 10px;
            background-color: #fff;
            width: 98%;
        }
        .section-status_suscription .status-suscription_item{
            display: flex; 
            flex-direction: row; 
            gap: 10px; 
            align-items: center;
        }
        .section-status_suscription .status-suscription_item .danger_tag{
            background-color: red; 
            color:white; 
            border-radius:5px; 
            padding: 5px;
        }
        .section-status_suscription .status-suscription_item .success_tag{
            background-color: green; 
            color:white; 
            border-radius:5px; 
            padding: 5px;
        }
        .container_status_suscription{
            display: flex; 
            flex-direction: row; 
            gap: 30px; 
            padding: 10px; 
            min-width: 100%;
            align-items: center;
            justify-content: center;
        }
        .container_status_suscription .status-suscription_item{
            display: flex; 
            flex-direction: row; 
            gap: 10px; 
            align-items: center;
        }
        .modal{
            background-color: #fff;
            z-index: 9999;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            padding: 20px;
            position: absolute;
            top: 20px;
            min-width: 500px;
            display: none;
        }
        .modal_information{
            background-color: #fff;
            z-index: 9999;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            padding: 20px;
            position: absolute;
            top: 20px;
            min-width: 500px;
            display: none;
        }
        .wallet_container {
            width: 100%;
            height: 50px; /* Asegura que el contenedor sea visible */
        }
        th {
            background-color: whithe;
            font-weight: bold;
        }          
        tr:nth-child(odd) td {
            background-color: #fff; /* Fondo gris */
        }
        tr:nth-child(even) td {
            background-color: #ebeced; /* Fondo blanco */        
        }
        .close_session{
            background: none;
            border: none;
            margin: 0;
            padding: 0;
            font-size: 16px;
        }
        .wallet_container{
            height: 50px;
            margin-bottom: 60px;
        }
        .button_payment_history_mobile{
            display: none;
        }

        @media screen and (max-width: 768px){
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
            .container_title .button_payment_history{
                display: none;
            }
            .section-status_suscription{
                margin: 0px;
                flex-direction: column;
                min-width: 90%;
                max-width: 92%;
                margin-top: 40px;
            }
            .section-status_suscription .status-suscription_item{
                flex-direction: column;
            }
            .section-status_suscription .status-suscription_item .status_black{
                display: none;
            }
            .section-status_suscription .status-suscription_item .status_text{
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .section-status_suscription .status-suscription_item p .success_tag{
                margin: 10px 0px;
            }
            .container_status_suscription{
                flex-direction: row;
                gap: 5px;
                margin: 20px 0px 5px;
            }
            .container_status_suscription .status-suscription_item{
                flex-direction: column;
                gap: 10px;
                width: 50%;
            }
            .container_status_suscription .status-suscription_item img{
                width: 30px;
                height: 30px;
            }
            .container_status_suscription .status-suscription_item .init_date{
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;    
            }
            .button_payment_history_mobile{
                display: block;
                width: 100%;
                background-color:#00d1b2; 
                color:#fff; 
                border:none; 
                border-radius: 5px;
                cursor: pointer;
                margin: 40px auto 5px; 
                font-size: 18px;
                padding: 16px;
            }
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
                <h2 class="title">Mi suscripcion</h2>
                <button class="button_payment_history" type="button" onclick="subscription_history()">
                    Ver historial de suscripciones
                </button>
            </div>

            <div class="section-status_suscription"><?php 
                if($suscription_message){ ?>
                    <div class="status-suscription_item">
                        <img 
                            class="status_black"
                            src="{{asset('icons/status_black.png')}}" 
                            alt="Estado"
                            width="20px"
                            height="20px">
                        <div class="status_text">
                            <p>Estado de la suscripcion: </p> 
                            <span class="<?php echo $suscription_status == 'active' ? 'success_tag' : 'danger_tag'; ?>">
                                <?php echo $suscription_message; ?>
                            </span>
                        </div>
                    </div><?php 
                }
                if($last_suscription){ ?>
                    <div class="container_status_suscription">
                        <div class="status-suscription_item">
                            <img 
                                src="{{asset('icons/calendar_black.png')}}"
                                alt="Fecha de inicio de la suscripcion"
                                width="20px"
                                height="20px">
                            <div class="init_date">
                                <p>Fecha de inicio: </p>
                                <span><?php echo $last_suscription->start_date; ?></span>
                            </div>
                        </div>
                        <div class="status-suscription_item">
                            <img
                                src="{{asset('icons/renew_suscription.png')}}" 
                                alt="Fecha de fin de la suscripcion"
                                width="20px"
                                height="20px">
                            <div class="init_date">
                                <p>Fecha de fin: </p>
                                <span><?php echo $last_suscription->end_date; ?></span>
                            </div>
                        </div>
                    </div><?php 
                } ?>
            </div>
            <div class="wallet_container" id="wallet_container"></div>
        
            <button class="button_payment_history_mobile" type="button" onclick="subscription_history()">
                Ver historial de suscripciones
            </button>
        </div>
    </main>

    <script>
        const preferenceId = '<?php echo $preferenceId; ?>';
        const mp = new MercadoPago("APP_USR-b5942e2b-aaeb-46d9-ba0f-57c3745eb5ea", { locale: "en-US" });
        const walletBuilder = mp.bricks();
    
        const renderComponent = async (walletBuilder) => {
            const settings = {
                initialization: {
                    preferenceId: preferenceId,     
                },
                style: {
                    base: {
                        color: "#000000",
                        fontSize: "16px",
                        fontFamily: "Arial, sans-serif",
                    },
                    error: {
                        color: "#FF0000",
                    },
                    success: {
                        color: "#00FF00",
                    },
                },
            };
    
            console.log(settings);   
            try {
                await walletBuilder.create("wallet", "wallet_container", settings);
            } catch (error) {
                console.error("Entre en el error");
                console.error("Error al montar el brick:", error);
            }
        };
    
        // Asegúrate de que el DOM esté cargado antes de renderizar
        document.addEventListener('DOMContentLoaded', function () {
            renderComponent(walletBuilder);
        });
        
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
        function subscription_history(){
            window.location.href = "{{ route('subscription_history') }}";
        }
        </script>
        <script type="text/javascript">
            (function() {
            function $MPC_load() {
                window.$MPC_loaded !== true && (function() {
                var s = document.createElement("script");
                s.type = "text/javascript";
                s.async = true;
                s.src = document.location.protocol + "//secure.mlstatic.com/mptools/render.js";
                var x = document.getElementsByTagName('script')[0];
                x.parentNode.insertBefore(s, x);
                window.$MPC_loaded = true;
            })();
            }
            window.$MPC_loaded !== true ? (window.attachEvent ? window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;
            })();
            function $MPC_message(event) {
                
            }
            window.$MPC_loaded !== true ? (window.addEventListener("message", $MPC_message)) : null; 
        </script>
</body>
</html>