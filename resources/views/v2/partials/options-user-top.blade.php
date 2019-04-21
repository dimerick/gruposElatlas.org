@if(isset($user))
    <li id="options-profile">
    <a href="#" id="a-options-profile">
        <img src="/files/fotos_perfil/{{$user['foto_peq']}}" alt="" height="28px">
        <b> {{$user['nombre']}} </b>
    </a>
    <ul id="ul-options-profile">
        <li><a href="/autor/{{$user['email']}}">Ver mi perfil</a></li>
        <li><a href="/user/edit-photo-profile">Cambiar foto perfil</a></li>
        <li><a href="{{route('grupos.edit')}}">Actualizar Datos</a></li>
        <li><a href="/auth/logout">Cerrar Sesión</a></li>
    </ul>
    </li>
@endif



