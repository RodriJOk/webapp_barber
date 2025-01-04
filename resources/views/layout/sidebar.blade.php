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
                <a href="{{ route('close_session')}}" class="text_link">Cerrar Session</a>
            </div>
        </li>
    </ul>
</navbar>
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