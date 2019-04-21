@extends('v2/template')

@section('title')
    Edicion Reporte
    @endsection

@section('css')

@endsection

    @section('content')
        <div class="row">

            <div class="col-sm-12">
                <div class="panel panel-default">

                    <div class="panel-heading"> <h4>Edicion Reporte</h4></div>
                    <div class="panel-body">
                        {!! Form::open(['url'=> '/admin/reports/update', 'method' => 'POST']) !!}

                        <div class="form-group">
                            <input type="hidden" name="id" value="{{$datos['id']}}">
                        </div>

                        <div class="form-group">
                            <label for="titulo">Titulo Actividad *</label>
                            <input type="text" value="{{$datos['titulo']}}" class="form-control" id="titulo" name="titulo" placeholder="Indique un titulo para la actividad" required>
                        </div>
                        <div class="form-group">
                            <label for="fecha">Fecha *</label>
                            <input type="date" value="{{$datos['fecha']}}" class="form-control" id="fecha" name="fecha" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripcion *</label>
                            <textarea required cols="75" rows="7" id="descripcion" name="descripcion" class="form-control" required>{{$datos['descripcion']}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Ubicacion *</label>
                            <input type="hidden" class="form-control" id="latitud" name="latitud" value="{{$datos['latitud']}}" required>
                            <input type="hidden" class="form-control" id="longitud" name="longitud" value="{{$datos['longitud']}}" required>


                            <div id="activity-map"></div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" id="submit">Actualizar</button>
                        </div>


                        {!! Form::close() !!}



                    </div>
                </div>

            </div>
        </div>

@endsection

@section('scripts')
    <script>
        $('document').ready(function(){
            function inicializarMap(latitud, longitud){
                if(latitud != null && longitud != null){
                    $('#latitud').val(latitud);
                    $('#longitud').val(longitud);
                }else{
                    latitud = 6.25304;
                    longitud = -75.56457;
                }
                var myIcon = L.icon({
                    iconUrl: '/assets/v2/images/icon_retorno.png',
                    iconSize: [40, 40],
                    iconAnchor: [22, 10]
                });

                var map = L.map('activity-map', {
                    center: [latitud, longitud],
                    zoom: 12
                });
                L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'}).addTo(map);

                var punto = L.marker([latitud, longitud], {
                    icon: myIcon,
                    draggable: true
                }).addTo(map);

                punto.on('dragend', function(e) {
                    var latLng = punto.getLatLng();
                    var lat = latLng.lat;
                    var long = latLng.lng;
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
                    alert('Arrastra el icono en el mapa para establecer tu ubicacion');
                }
                var valido=true;
                var campos = $("[required]").each(function(index){
                    if($(this).val() == ""){
                            valido = false;

                    }

                });
                if(!valido){
                    e.preventDefault();
                    e.stopPropagation();
                    alert('Faltan campos por completar');
                }
            });

        });
    </script>
@endsection