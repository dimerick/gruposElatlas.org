@extends('v2/template-auth')

@section('title')
    Link de confirmacion reenviado
@endsection


@section('content')
                    @include('v2/partials/messages')
                    <div class="alert">
                        <p>Se ha reenviado el link de confirmación al correo:</p>
                        <p><b>{{$email}}</b></p>

                        <br>
                        <p>¿No has recibido el email?
                            </br>
                        <a href="/v2/resend-code-activation/{{$email}}">Reenviar link de confirmación</a>
                        </p>

                    </div>

@endsection