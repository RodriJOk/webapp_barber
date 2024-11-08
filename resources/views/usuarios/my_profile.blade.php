<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('icons/cuidado.png') }}" type="image/x-icon">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.15/index.global.min.js'></script>
        <title>Mi perfil</title>
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

            /* Estilos del modal de informacion */
            .section_information{
                max-width: calc(100% - 300px); 
                border:1px solid #ccc; 
                text-align:center;
                border-radius: 15px;
            }
            .header_information{
                display: flex; 
                flex-direction: row; 
                justify-content: space-between; 
                align-items: center;
                padding: 0px 15px;
                border-bottom: 1px solid #ccc;
            }
            .header_information .title{
                font-size: 22px; 
                font-weight:700;
            }
            .header_information .edit_buttom{
                padding: 5px 10px;
                display:flex;
                flex-direction: row;
                justify-content: center;
                align-items: center;
                gap: 10px;
                text-decoration: none; 
                background-color: #0d6efd; 
                color:#fff; 
                border:none; 
                border-radius: 15px;
            }
            .edit_buttom .buttom_text{
                font-size: 16px;
            }
            .item_information{
                display: flex; 
                flex-direction:row;
                justify-content: start; 
                align-items: center; 
                gap: 10px;
                padding: 0px 15px;
            }
            .name_details, .address_details, .phone_details{
                display: flex; 
                flex-direction:row; 
                gap: 10px;
                align-items: center;
            }
            .name_details h3, .address_details h3, .phone_details h3{
                font-size: 18px;
            }
            .name_details p, .address_details p, .phone_details p{
                font-size: 18px;
                overflow: hidden;
                max-width: 260px;
                white-space: nowrap;
                text-overflow: ellipsis;
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
            .modal_information_header{
                display: flex; 
                flex-direction: row; 
                justify-content: space-between;
            }
            .modal_information_header .close_modal{
                background: none; 
                color:#000; 
                font-size: 18px;
                border:none;
                border-radius: 50%; 
                cursor: pointer;
                padding:10px;
            }
            .modal_information_body{
                display: flex; 
                flex-direction:column;
            }
            .modal_information_body .items{
                display: flex; 
                flex-direction: column; 
                margin: 10px 0px;
            }
            .modal_information_body .container_buttom{
                display: flex; 
                flex-direction: row; 
                margin: 10px 0px; 
                width:100%;
            }

            .modal_information_body .container_buttom .close_modal{
                padding: 10px 0px;
                width: 50%; 
                background-color:#c50f34; 
                color:#fff; 
                border:none; 
                border-radius: 5px; 
                margin-right: 10px;
                font-size: 18px;
            }

            .modal_information_body .container_buttom .delete_reservation{
                padding: 10px 0px;
                width: 50%; 
                background-color:#00d1b2; 
                color:#fff; 
                border:none; 
                border-radius: 5px;
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
                            <a href="" class="text_link">Cerrar Session</a>
                        </div>
                    </li>
                </ul>
            </navbar>
            <div style="min-width: 70%; padding: 10px; margin: 0 auto; position: relative; margin-left: 350px;">
                <h1 style="font-size: 26px">Mi perfil</h1>
                <main style="display: flex; flex-direction: row; gap: 20px; justify-content:center; margin: 40px 0px;">
                    <section class="section_information" style="width: 450px;">
                        <div class="header_information">
                            <h2 class="title">Datos de tu sucursal</h2>
                            <button class="edit_buttom" onclick="open_modal('modal_information')">
                                <img src="{{asset('icons/edit.png')}}" alt="Editar" width="20px" height="20px">
                                <span class="buttom_text">Editar</span>
                            </button>
                        </div>
                        <div class="item_information">
                            <img src="{{asset('icons/store.png')}}" alt="Sucursal" width="20px" height="20px">
                            <div class="name_details">
                                <h3>Nombre: </h3>
                                <p>{{ $branch['name'] }}</p>
                            </div>
                        </div>
                        <div class="item_information">
                            <img src="{{asset('icons/location.png')}}" alt="Direccion" width="20px" height="20px">
                            <div class="address_details">
                                <h3>Direccion: </h3>
                                <p>{{ $branch['address'] }}</p>
                            </div>
                        </div>
                        <div class="item_information">
                            <img src="{{asset('icons/phone.png')}}" alt="Contacto" width="20px" height="20px">
                            <div class="phone_details">
                                <h3>Celular/Telefono: </h3>
                                <p>{{ $branch['phone'] }}</p>
                            </div>
                        </div>
                    </section>
    
                    <section class="section_information" style="width: 450px;">
                        <div class="header_information">
                            <h2 class="title">Information del usuario</h2>
                        </div>
                        <div class="item_information">
                            <img src="{{asset('icons/person.png')}}" alt="Nombre usuario" width="20px" height="20px">
                            <div class="name_details">
                                <h3>Nombre: </h3>
                                <p>{{ $user['name'] }}</p>
                            </div>
                        </div>
                        <div class="item_information">
                            <img src="{{asset('icons/mail.png')}}" alt="Direccion" width="20px" height="20px">
                            <div class="address_details">
                                <h3>Email: </h3>
                                <p>{{ $user['email'] }}</p>
                            </div>
                        </div>
                        <div class="item_information">
                            <img src="{{asset('icons/id_card.png')}}" alt="Contacto" width="20px" height="20px">
                            <div class="phone_details">
                                <h3>Miembro desde: </h3>
                                <p>{{ $user['created_at'] }}</p>
                            </div>
                        </div>
                    </section>
                </main>
            </div>
            <dialog id="modal_information" class="modal_information">
                <div class="modal_information_header">
                    <h2>Datos de tu sucursal</h2>
                    <button class="close_modal" onclick="close_modal('modal_information')">
                        <img class="navbar_image" src="{{asset('icons/close.png')}}" alt="Close Modal" width="35px" height="35px">
                    </button>
                </div>
                <section class="modal_information_body">
                    <form action="{{ route('update_profile') }}" method="POST" >
                        @csrf
                        <input type="hidden" name="id" value="{{ $branch['id'] }}">
                        <div class="items">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" value="<?php echo $branch['name']; ?>" autocomplete="off" placeholder="Nombre">
                        </div>
                        <div class="items">
                            <label for="direccion">Direccion</label>
                            <input type="text" name="direccion" value="<?php echo $branch['address']; ?>" autocomplete="off" placeholder="Direccion">
                        </div>
                        <div class="items">
                            <label for="celular_telefono">Celular/Telefono</label>
                            <input type="text" name="celular_telefono" value="<?php echo $branch['phone']; ?>" autocomplete="off" placeholder="Celular/Telefono">
                        </div>
                        <div class="container_buttom">
                            <button type="button" class="close_modal" onclick="close_modal('modal_information')" style="font-size: 18px;">
                                Cerrar modal
                            </button>
                            <button type="submit" class="delete_reservation" style="font-size: 18px;">
                                Guardar cambios
                            </button>
                        </div>
                    </form>
                </section>
            </dialog>   
        </main>
    </body>
    <script>
        const branch = '<?php echo json_encode($branch); ?>';
        const information_sucursal = JSON.parse(branch);
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
        function open_modal(modal){
            let modal_information = document.getElementById(modal);
            modal_information.style.display = 'flex';

            let name = document.getElementsByName('nombre')[0];
            let address = document.getElementsByName('direccion')[0];
            let phone = document.getElementsByName('celular_telefono')[0];
            
            name.value = information_sucursal.name;
            address.value = information_sucursal.address;
            phone.value = information_sucursal.phone;
        }
        function close_modal(modal){
            let modal_information = document.getElementById(modal);
            modal_information.style.display = 'none';
        }
    </script>
</html>