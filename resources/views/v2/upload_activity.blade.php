@extends('v2/template')

@section('title')
    Registro Actividad
@endsection

@section('css')
    <link href="{{ asset('assets/v2/css/Control.FullScreen.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/v2/css/dropzone.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="panel panel-default">

        <div class="panel-heading"> <h4>Registro Actividad</h4></div>
        <div class="panel-body">
            {!! Form::open(['url'=> '/user/upload-activity', 'method' => 'POST']) !!}

            <div class="form-group">
                <label for="titulo">Titulo Actividad*</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Indique un titulo para la actividad" required>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha*</label>
                <input type="date" class="form-control" id="fecha" name="fecha" placeholder="AAAA-MM-DD" required>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12">
                        <label>Tipo Actividad*</label>
                        <select class="form-control" name="tipo" id="tipo" required>
                            <option value=""></option>
                            @foreach($tipos_act as $tipo)
                                <option value="{{$tipo->id}}">{{ $tipo->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12">
                        <label>Categoría*</label>
                        <select class="form-control" name="categoria" id="categoria" required>
                            <option value=""></option>
                            @foreach($categorias as $categoria)
                                <option value="{{$categoria->id}}">{{ $categoria->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción*</label>
                <textarea required cols="75" rows="7" id="descripcion" name="descripcion" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Doble clic sobre el mapa para establecer la ubicación geográfica*</label>
                </br>
                <i>Si su ubicación esta disponible sera detectada automaticamente</i>
                <input type="hidden" id="latitud" name="latitud" value="" required>
                <input type="hidden" id="longitud" name="longitud" value="" required>
                <div id="register-map"></div>
            </div>


            <div class="form-group"><button type="submit" class="btn btn-primary btn-block" id="submit">Enviar</button></div>

            {!! Form::close() !!}



        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/v2/js/Control.FullScreen.js') }}"></script>
    <script src="{{ asset('assets/v2/js/registrarActividad.js') }}"></script>
@endsection