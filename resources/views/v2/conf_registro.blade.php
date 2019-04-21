@extends('v2/template-auth')

@section('title')
    Confirmación Registro
@endsection


@section('content')
                    @include('v2/partials/messages')

                    <div class="alert">
                        <p id="register-success">Registro Exitoso</p>
                        <p>Ya eres parte de ElAtlas</p>
                        <p><a href="/">Ir al Mapa</a></p>

                    </div>
                    {{--<div class="alert">--}}
                        {{--<p>Para terminar el proceso de registro hemos enviado un link de confirmación al correo:</p>--}}
                        {{--<p><b>{{$email}}</b></p>--}}
                        {{--<p>Recuerda revisar el correo no deseado.</p>--}}

                        {{--<br>--}}
                        {{--<p>¿No has recibido el email?--}}
                            {{--</br>--}}
                        {{--<a href="/v2/resend-code-activation/{{$email}}">Reenviar link de confirmación</a>--}}
                        {{--</p>--}}

                    {{--</div>--}}

@endsection