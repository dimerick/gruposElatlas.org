@extends('new/template')

@section('title')
    Recorrido 1 Derecho A La Ciudad
@endsection

@section('css')
    <link href="{{ asset('assets/css/sl-slide.css') }}" rel="stylesheet">
    <style>
        #map{
            height: 220px;
            width: 100%;
            border-radius: 120px;
        }
    </style>
@endsection

@section('options-user')
    @include('partials/options-user')
@endsection


@section('content')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
               <span> Pagina 7 de 12</span>
                <span class="pull-right"><a href="/recorridos/derecho-a-la-ciudad/page6"> <i class="fa fa-angle-left"></i> Anterior </a> <a href="/recorridos/derecho-a-la-ciudad/page8"> Siguiente<i class="fa fa-angle-right"></i></a></span>
                {{--<span class="pull-right"> <a href="/recorridos/derecho-a-la-ciudad/page2"> Siguiente<i class="fa fa-angle-right"></i></a></span>--}}
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-8">
                        <div id="myCarousel" class="carousel slide">
                            <ol class="carousel-indicators">
                                {{--<li data-target="#myCarousel" data-slide-to="0" class="active"></li>--}}
                                {{--<li data-target="#myCarousel" data-slide-to="1" class=""></li>--}}
                                {{--<li data-target="#myCarousel" data-slide-to="2" class=""></li>--}}
                            </ol>

                            <div class="carousel-inner" id="postRecientes">
                                <div class="item active">
                                    <img src="/files/recorridos/Recorrido1DerechoALaCiudad_14 de noviembre_6.jpg">

                                </div>
                                {{--<div class="item">--}}
                                    {{--<img src="/files/recorridos/Recorrido1DerechoALaCiudad_14 de noviembre_1.jpg">--}}

                                {{--</div>--}}
                                {{--<div class="item">--}}
                                    {{--<img src="/files/recorridos/Recorrido1DerechoALaCiudad_14 de noviembre_1.jpg">--}}
                                {{--</div>--}}
                            </div>
                            <!-- Carousel nav -->
                            <a class="carousel-control left" href="#myCarousel" data-slide="prev">‹</a>
                            <a class="carousel-control right" href="#myCarousel" data-slide="next">›</a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                    <div id="map">

                    </div>
                    </div>
                </div>

                </br>
                <p>Vídeo sobre los convites de el barrio y las personas del barrio,una recopilación de rap y la vida diaria,la cosecha ,el conflicto armado ,nuevas oportunidades el comienzo y el ahora que viven las personas de la comunidad.</p>
            </div>
        </div>

        <div class="col-sm-12 carrusel contCarrusel">



        </div>

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/jquery.ba-cond.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slitslider.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsXhk_RpcpReEa1opVGaj0k_PZS19C7Y4&sensor=false"></script>
    <script>
        $('document').ready(function(){
            function initialize() {
                var mapCanvas = document.getElementById('map');
                var mapOptions = {
                    center: new google.maps.LatLng(6.2785763, -75.5382996),
                    zoom: 15,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    mapTypeControl: false,
                    streetViewControl: false
                }
                var map = new google.maps.Map(mapCanvas, mapOptions);

                var nombre, infoGrupo, posGrupo;
                var iconMarker = '/assets/images/icon-atlasAnt.png';

                titulo = 'Recorrido 1 Derecho A La Ciudad';


                var posGrupo = new google.maps.LatLng(6.2785763, -75.5382996);
                var etiquetaGrupo = new google.maps.Marker({
                    position: posGrupo,
                    icon: iconMarker,
                    map: map,
                    title:titulo
                });
            }
            initialize();
        });


    </script>

@endsection