@extends('v2/template')

@section('title')
    Post {{$datos[0]->titulo}}
@endsection

@section('css')
    <link href="{{ asset('assets/v2/css/Control.FullScreen.css') }}" rel="stylesheet">
@endsection

@section('content')
        <div class="panel panel-default">
            <input type="hidden" id="icon-activity" value="/assets/v2/images/categories/{{$datos[0]->icon}}">
                <div class="panel-heading"><h4><img class="icon-cat" src="/assets/v2/images/categories/{{$datos[0]->icon}}" title="{{$datos[0]->nomCat}}">{{strtoupper($datos[0]->titulo)}}</h4></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="descrip"><i class="fa fa-calendar"> <strong>{{$datos[0]->fecha}}</strong></i> |
                                <i class="fa fa-user"> <a href="/autor/{{$datos[0]->email}}">
                                        <strong>{{$datos[0]->nombre}}</strong>
                                    </a></i>
                            </p>
                            <hr>

                            <p class="descrip">{!! $descripcion !!}</p>

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">

                            @foreach($fotos as $foto)

                                    <a href="/files/actividades/{{$foto->url}}" data-lightbox="{{$datos[0]->titulo}}" data-title="{{$datos[0]->titulo}}"><img src="/files/actividades/{{$foto->url}}" width="150px" class="pull-left thumbnail"></a>

                            @endforeach

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <input type="hidden" id="latitud" value="{{$datos[0]->latitud}}">
                            <input type="hidden" id="longitud" value="{{$datos[0]->longitud}}">
                            <input type="hidden" id="titulo" value="{{$datos[0]->titulo}}">
                            <b>Ubicación</b>
                            <div id="activity-map"></div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>

            </div>




@endsection

@section('scripts')
    <script src="{{ asset('assets/v2/js/Control.FullScreen.js') }}"></script>
    <script>
        $('document').ready(function(){
            var urlIcon = $("#icon-activity").val();
            var latitud, longitud, titulo;
            latitud = $('#latitud').attr("value");
            longitud = $('#longitud').attr("value");
            titulo = $("#titulo").attr("value");


            var myIcon = L.icon({
                iconUrl: urlIcon,
                iconSize: [40, 40],
                iconAnchor: [22, 10]
            });

            var map = L.map('activity-map', {
                center: [latitud, longitud],
                zoom: 12,
                fullscreenControl: true,
                fullscreenControlOptions: {
                    position: 'topleft'
                }
            });
            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'}).addTo(map);

            var punto1 = L.marker([latitud, longitud], {icon: myIcon}).addTo(map);

        });


    </script>

@endsection