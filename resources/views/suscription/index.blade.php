<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('icons/cuidado.png') }}" type="image/x-icon">
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
                        <a href="{{ route('my_collaborators') }}" class="text_link">Mis colaboradores</a>
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
        <div style="min-width: 70%; padding: 10px; margin: 0 auto; position: relative; margin-left: 350px;">
            <div style="display: flex; flex-direction:row; justify-content: space-between; align-items: center;">
                <h2 style="font-size: 26px">Mi suscripcion</h2>
                <div>
                    <button 
                        onclick="open_modal()"
                        style="padding: 10px; width: 100%; background-color:#00d1b2; color:#fff; border:none; border-radius: 5px;">
                        Pagar suscripcion
                    </button>
                </div>
            </div>
            <p>Listado del historia de suscripcion</p>
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="background-color: #012e46; color: #fff; text-align: center;">
                    <tr>
                        <th style="padding: 10px; border-bottom: 1px solid #ccc;">Id</th>
                        <th style="padding: 10px; border-bottom: 1px solid #ccc;">
                            Tipo de suscripcion
                        </th>
                        <th style="padding: 10px; border-bottom: 1px solid #ccc;">
                            Fecha de inicio
                        </th>
                        <th style="padding: 10px; border-bottom: 1px solid #ccc;">
                            Fecha de fin
                        </th>
                    </tr>
                </thead>
                <tbody style="text-align: center;">
                    @foreach ($suscriptions as $suscription)
                        <tr>
                            <td style="border-bottom: 1px solid #ccc;">{{$suscription->id}}</td>
                            <td style="border-bottom: 1px solid #ccc;">{{$suscription->type}}</td>
                            <td style="border-bottom: 1px solid #ccc;">{{$suscription->start_date}}</td>
                            <td style="border-bottom: 1px solid #ccc;">{{$suscription->end_date}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="wallet_container" id="wallet_container"></div>
            <a 
                href="https://www.mercadopago.com.ar/subscriptions/checkout?preapproval_plan_id=2c93808492715acc01927c5fbf230410" 
                name="MP-payButton" 
                class='blue-ar-l-rn-none'>
                Renovar suscripcion
            </a>
        </div>
    </main>

    <script>
        const mp = new MercadoPago("APP_USR-b5942e2b-aaeb-46d9-ba0f-57c3745eb5ea", { locale: "en-US" });
        const walletBuilder = mp.bricks();
    
        // Renderiza el componente con bricks
        const renderComponent = async (walletBuilder) => {
            const settings = {
                initialization: {
                    preferenceId: '<?php echo $preference->id; ?>',              
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
    
            try {
                await walletBuilder.create("wallet", "wallet_container", settings);
            } catch (error) {
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