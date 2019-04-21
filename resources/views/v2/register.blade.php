@extends('v2/template-auth')

@section('title')
    Registro
@endsection

@section('css')
    <style>
        #register-map{
            margin: 20px 0px;
        }
    </style>
    <link href="{{ asset('assets/v2/css/Control.FullScreen.css') }}" rel="stylesheet">
@endsection


@section('content')

                    @include('v2/partials.messages')
                    <div class="panel panel-default">
                        <div class="panel-heading"><h3>Formulario de Registro</h3>
                            Requerido*
                        </div>

                        <div class="panel-body">

                    {!! Form::open(array('route' => 'grupos.store', 'files' => true, 'id' => 'form-register')) !!}
                            @include('v2/partials/fields')
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="ch-conditions"> Acepto los <a href="/terms-conditions" target="_blank">Términos y Condiciones del servicio</a>
                                </label>
                            </div>
                            <br>
                    {!! Form::submit(trans('validation.attributes.submit'),['class' => 'btn btn-primary btn-block', 'id' => 'submit']) !!}
                    </div>

                    {!! Form::close() !!}

                        </div>


@endsection
@section('scripts')
       <script src="{{ asset('assets/v2/js/registerUser.js') }}"></script>
       <script src="{{ asset('assets/v2/js/Control.FullScreen.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#nombre").focus();
$("#submit").click(function (e) {
    var state = $("#ch-conditions").prop('checked');
    if(!state){
        e.preventDefault();
        alert('Debes aceptar los terminos y condiciones para poder registrarte');
        $("#ch-conditions").focus();
    }
});

        });
    </script>
@endsection