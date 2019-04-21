@extends('v2/template')

@section('title')
    Editar usuario
@endsection

@section('css')
    <link href="{{ asset('assets/v2/css/Control.FullScreen.css') }}" rel="stylesheet">
@endsection

@section('content')

                    @include('v2/partials/messages')
                    <div class="panel panel-default">
                        <div class="panel-heading"><h4>Formulario de Edición</h4>
                            Requerido*
                        </div>

                        <div class="panel-body">

                    {!! Form::open(array('route' => 'grupos.update', 'method' => 'PUT')) !!}
                            <div class="form-group">
                                <label>{{ trans('validation.attributes.name') }}*</label>
                                {!! Form::text('nombre', $user['nombre'], ['class'=> 'form-control', 'required' => 'required']) !!}
                            </div>

                            <div class="form-group">
                                <label>Nombre representante*</label>
                                {!! Form::text('nom_repre', $user['representante'], ['class'=> 'form-control', 'required' => 'required', 'id' => 'nom-repre']) !!}
                            </div>

                            <div class="form-group">
                                <label>Dirección*</label>
                                {!! Form::text('direccion', $user['direccion'], ['class'=> 'form-control', 'required' => 'required', 'id' => 'direccion']) !!}
                            </div>

                            <div class="form-group">
                                <label>Teléfono*</label>
                                {!! Form::text('telefono', $user['telefono'], ['class'=> 'form-control', 'required' => 'required', 'id' => 'telefono']) !!}
                            </div>

                            <div class="form-group">
                                <label>{{ trans('validation.attributes.email') }}*</label>
                                {!! Form::email('email', $user['email'], ['class'=> 'form-control', 'required' => 'required', 'disabled']) !!}
                            </div>

                            <div class="form-group">
                                <label>{{ trans('validation.attributes.city') }}*</label>
                                {!! Form::text('ciudad', $user['ciudad'], ['class'=> 'form-control', 'required' => 'required']) !!}
                            </div>

                            <div class="form-group">
                                <label>Doble clic sobre el mapa para establecer tu ubicación geográfica*</label></br>
                                <i>Si su ubicación está disponible será detectada automáticamente</i>
                                <div id="register-map"></div>
                            </div>
                            <input type="hidden" id="latitud" name="latitud" value="{{$user['latitud']}}">
                            <input type="hidden" id="longitud" name="longitud" value="{{$user['longitud']}}">

                            <hr>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label id="cate">Seleccione la categoría principal del grupo*</label>
                                        <select class="form-control" name="cat_prin" id="cat-prin"required>
                                            @foreach($categorias as $categoria)
                                                @if($categoria->id == $idCatPrin)
                                                    <option value="{{$categoria->id}}" selected>{{ $categoria->nombre}}</option>
                                                @else
                                                    <option value="{{$categoria->id}}">{{ $categoria->nombre}}</option>
                                                @endif

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label id="cate">Marque las categorías secundarias con las que se identifica el grupo</label>
                                        <div id="cont-cat-sec">
                                            <ul>
                                        @foreach($items as $item)
                                                    <li id="cat-sec-{{$item["id"]}}">
                                                        {!! Form::checkbox($item["id"], $item["id"], $item["checked"], ['class' => 'check-category'])!!}
                                                {{ $item["nombre"]}}</li>

                                        @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label>{{ trans('validation.attributes.num_int') }}*</label>
                                {!! Form::number('num_int', $user['num_int'], ['min' => '1', 'class' => 'form-control', 'required' => 'required']) !!}
                            </div>

                            <div class="form-group">
                                <label>{{ trans('validation.attributes.descript') }}*</label>
                                {!! Form::textarea('descripcion', $descripcion, ['cols' => '70', 'rows' => '7', 'class' => 'form-control', 'required' => 'required']) !!}
                            </div>

                           {{--<div class="form-group">--}}
                                {{--<label>{{ trans('validation.attributes.password') }}*</label>--}}
                                {{--{!! Form::password('password', ['class'=> 'form-control', 'required' => 'required']) !!}--}}
                            {{--</div>--}}

                            {{--<div class="form-group">--}}
                                {{--<label>{{ trans('validation.attributes.password_confirmation') }}*</label>--}}
                                {{--{!! Form::password('password_confirmation', ['class'=> 'form-control', 'required' => 'required']) !!}--}}
                            {{--</div>--}}

                            <div>
                                <br>
                    {!! Form::submit(trans('Actualizar'),['class' => 'btn btn-primary btn-block']) !!}
                    </div>

                    {!! Form::close() !!}

                        </div>
                    </div>

@endsection
@section('scripts')
    <script src="{{ asset('assets/v2/js/Control.FullScreen.js') }}"></script>
    <script src="{{ asset('assets/v2/js/editUser.js') }}"></script>
    <script>
        $('document').ready(function(){
            var height = $(window).height();
            $("#register-map").css('height', height/1.2);
            function inicializarMap(latitud, longitud){
                if(latitud != null && longitud != null){
                    $('#latitud').val(latitud);
                    $('#longitud').val(longitud);
                }else{
                    latitud = 6.25304;
                    longitud = -75.56457;
                }
                var myIcon = L.icon({
                    iconUrl: '/assets/v2/images/categories/icon-otra.svg',
                    iconSize: [40, 40],
                    iconAnchor: [22, 10]
                });

                var map = L.map('register-map', {
                    center: [latitud, longitud],
                    zoom: 12,
                    fullscreenControl: true,
                    fullscreenControlOptions: {
                        position: 'topleft'
                    }
                });
                L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'}).addTo(map);

                var punto = L.marker([latitud, longitud], {
                    icon: myIcon,
                    draggable: false
                }).addTo(map);

                map.on('contextmenu', function(e) {
                    console.log(e.latlng);
                    punto.setLatLng(e.latlng);
                    var latLng = punto.getLatLng();
                    var lat = latLng.lat;
                    var long = latLng.lng;
                    console.log(lat);
                    console.log(long);
                    $('#latitud').val(lat);
                    $('#longitud').val(long);
                });

                map.on('dblclick', function(e) {
                    console.log(e.latlng);
                    punto.setLatLng(e.latlng);
                    var latLng = punto.getLatLng();
                    var lat = latLng.lat;
                    var long = latLng.lng;
                    console.log(lat);
                    console.log(long);
                    $('#latitud').val(lat);
                    $('#longitud').val(long);
                });
            }

            var latitud, longitud;
            latitud = $('#latitud').val();
            longitud = $('#longitud').val();

            inicializarMap(latitud, longitud);

            submitBtn.addEventListener("click", function(e){
                if($('#latitud').val() == "" && $('#longitud').val() == ""){
                    valido = false;
                    alert('Arrastra el icono en el mapa para establecer tu ubicacion');
                }

                if(!valido){
                    e.preventDefault();
                    e.stopPropagation();
                    alert('Faltan campos por completar');
                }
            });

        });
    </script>

@endsection