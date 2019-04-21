@extends('v2/template-auth')

@section('title')
    Solicitud de Activacion
@endsection


@section('content')
                    <div class="alert alert-danger">
                        <p><strong>Aun no has activado la cuenta</strong></p>
                    </div>

                    <div class="alert">
                        <p>Hemos enviado al email <b>{{$email}}</b> el código de activación.</p>
                        <p>Recuerda revisar el correo no deseado.</p>

                        <br>
                        <p>¿No has recibido el email?
                            </br>
                            <a href="/v2/resend-code-activation/{{$email}}">Reenviar link de confirmación</a>
                        </p>
                    </div>



@endsection