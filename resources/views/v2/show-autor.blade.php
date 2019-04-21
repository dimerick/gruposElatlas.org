@extends('v2/template')

@section('title')
    Perfil {{$cuenta[0]->nombre}}
@endsection

@section('css')
    <link href="{{ asset('assets/v2/css/Control.FullScreen.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/v2/css/L.Control.Window.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/v2/css/cluster/MarkerCluster.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/v2/css/cluster/MarkerCluster.Default.css') }}" rel="stylesheet">
@endsection

@section('pagina')
    Perfil {{$cuenta[0]->nombre}}
@endsection

@section('content')
        <div class="panel panel-default">
                <div class="panel-heading"> <h4>
                        @if(count($categorias)>0)
                            <img class="icon-cat" src="/assets/v2/images/categories/{{$categorias[0]->icon}}" title="{{$categorias[0]->nombre}}">
                            @else
                            <img class="icon-cat" src="/assets/v2/images/categories/icon-otra.svg" title="Otra">
                            @endif
                         {{strtoupper($cuenta[0]->nombre)}}
                    </h4></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="/files/fotos_perfil/{{$cuenta[0]->foto}}" data-lightbox="{{$cuenta[0]->nombre}}" data-title="{{$cuenta[0]->nombre}}"><img src="/files/fotos_perfil/{{$cuenta[0]->foto}}" width="50%" class="thumbnail photo-profile"></a>
                            <input type="hidden" id="id-group" value="{{$cuenta[0]->email}}">
                        </div>
                        <div class="col-sm-12">
                            <div id="categories-group">
                                <ul>

                                        <input type="hidden" id="urlIcon" value="/assets/v2/images/categories/icon-ubicacion.svg">


                                    @foreach($categorias as $categoria)
                                        <li><img src="/assets/v2/images/categories/{{$categoria->icon}}" title="{{$categoria->nombre}}"></li>
                                    @endforeach
                                </ul>
                            </div>
                            <ul id="data-group">
                                <li><i class="fa fa-group"> </i> <span id="num-int-group">{{$cuenta[0]->num_int}}</span></li>
                                <li><i class="fa fa-globe"> </i><span id="city-group"> {{$cuenta[0]->ciudad}}</span></li>
                                <li><i class="fa fa-envelope-o"> </i><span id="email-group"> {{$cuenta[0]->email}}</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-12">

<hr>
                        <div id="description-group">
                            <p>{!!$descripcion!!}</p>
                        </div>
                        <hr>
                    </div>


                    <div class="row">
                        <div class="col-sm-12">
                            <input type="hidden" id="latitud" value="{{$cuenta[0]->latitud}}">
                            <input type="hidden" id="longitud" value="{{$cuenta[0]->longitud}}">
                            <input type="hidden" id="titulo" value="{{$cuenta[0]->nombre}}">
                            <div id="autor-map"></div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>

            </div>

        @if(count($actividades) > 0)
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-info"><i class="fa fa-archive"></i> Publicaciones</div>
                </div>
            </div>
            @foreach($actividades as $actividad)

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="/publications/{{$actividad->id}}" target="_blank"> <h4><img class="icon-cat" src="/assets/v2/images/categories/{{$actividad->icon}}" title="{{$actividad->nomCat}}"> {{strtoupper($actividad->titulo)}}</h4></a>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <p class="descrip"><i class="fa fa-calendar"> <strong>{{$actividad->fecha}}</strong></i> |
                                    <i class="fa fa-user"> <a href="/user/autor/{{$cuenta[0]->email}}">
                                            <b>{{$cuenta[0]->nombre}}</b>
                                        </a></i>
                                </p>
<hr>
                                <p class="descrip">
                                    {!! nl2br(htmlentities($actividad->descripcion)) !!}</p>

                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">

                                @foreach($fotos as $foto)
                                    @if($foto->actividad == $actividad->id)
                                        <a href="/files/actividades/{{$foto->url}}" data-lightbox="{{$actividad->titulo}}" data-title="{{$actividad->titulo}}"><img src="/files/actividades/{{$foto->url}}" width="20%" class="pull-left thumbnail"></a>
                                    @endif
                                @endforeach

                            </div>
                        </div>

                    </div>


                </div>
            @endforeach
        @else
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-info"><center><i class="fa fa-exclamation-circle"></i> Aun No ha registrado actividades</center></div>
                </div>
            </div>

        @endif



@endsection

@section('scripts')
    <script src="{{ asset('assets/v2/js/Control.FullScreen.js') }}"></script>
    <script src="{{ asset('assets/v2/js/L.Control.Window.js') }}"></script>
    <script src="{{ asset('assets/v2/js/cluster/leaflet.markercluster-src.js') }}"></script>
    <script>
        $('document').ready(function(){
            var windowAnt = null;
            var latitud, longitud, titulo;
            latitud = $('#latitud').attr("value");
            longitud = $('#longitud').attr("value");
            titulo = $("#titulo").attr("value");


            var myIcon = L.icon({
                iconUrl: $("#urlIcon").val(),
                iconSize: [40, 40],
                iconAnchor: [22, 10]
            });

            var map = L.map('autor-map', {
                center: [latitud, longitud],
                zoom: 12,
                maxZoom: 16,
                minZoom: 3,
                fullscreenControl: true,
                     fullscreenControlOptions: {
                         position: 'topleft'
                     }
            });
            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'}).addTo(map);

            var punto1 = L.marker([latitud, longitud], {
                icon: myIcon,
                title: 'Ubicacion'
            }).addTo(map);
            punto1.bindPopup('Ubicación').openPopup();


            //añado los recorridos registrados por le grupo
            var numColor = 0;
            var colors = ['#DF0101', '#09AC3F', '#0E2091', '#DD16D7', '#FF3C92', '#06A6A6', '#B0AA00'];
            function eachTour(feature, layer){
                if(numColor >= colors.length){
                    numColor = 0;
                }
                var style = {
                    fill: false,
                    fillOpacity: 1,
                    color : colors[numColor],
                    weight: 5
                }
                layer.setStyle(style);
                numColor++;
                var urlIcon = feature.geometry.properties.icon;
                console.log(urlIcon);


                var fotos = feature.geometry.properties.fotos;
                var url = "";
                console.log(fotos);
                if(fotos != null) {
                    if (fotos.length > 0) {
                        var url = '/files/actividades/'+fotos[0].url;
                    }else{
                        var url = '/assets/v2/images//categories/'+urlIcon;
                    }
                }



                var fechaReg = feature.geometry.properties.fecha;
                var date = fechaReg.split("-");
                var fechaText = date[2]+' de ';
                var mes;
                switch(date[1]){
                    case '01': mes='Enero'
                        break;
                    case '02': mes = 'Febrero'
                        break;
                    case '03': mes = 'Marzo'
                        break;
                    case '04': mes = 'Abril'
                        break;
                    case '05': mes = 'Mayo'
                        break;
                    case '06': mes = 'Junio'
                        break;
                    case '07': mes = 'Julio'
                        break;
                    case '08': mes = 'Agosto'
                        break;
                    case '09': mes = 'Septiembre'
                        break;
                    case '10': mes = 'Octubre'
                        break;
                    case '11': mes = 'Noviembre'
                        break;
                    case '12': mes = 'Diciembre'
                        break;
                    default: mes = 'no entro';
                }
                fechaText += mes + ' de '+ date[0];

                console.log(fechaText);

                var title = '<h2><a href="/publications/'+feature.geometry.properties.id+'" target="_top" id="name-profile">'+feature.geometry.properties.titulo.toUpperCase()+'</a></h2>';

                var content = '<div class="content-info-marker">'+title +
                        '<p id="autor-activity"><em>Publicado por: </em><a target="_top" href="/autor/'+feature.geometry.properties.email+'"><b>'+feature.geometry.properties.autor+'</b></a> <br>El '+fechaText+'</p><br>' +
                        '<img src="'+url+'"  height="200px" class="main-image-activity img-rounded">' +
                        '<br><div id="description-activity">' +
                        '<p id="description-activity">'+feature.geometry.properties.descripcion+'</p>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-sm-12">' +
                        '<div id="cont-images-activity">';
                var fotos = feature.geometry.properties.fotos;
                var max = 2;
                for(var i=1; i < fotos.length; i++){
                    if(i <= max){
                        content += '<img src="/files/actividades/'+fotos[i].url+'" width="50%" class="img-responsive image-activity img-thumbnail">';
                    }

                }

                content += '</div>' +
                        '</div>' +
                        '</div></div>';

                layer.on('click', function () {
                    if(windowAnt != null){
                        windowAnt.close();
                    }

                    var winOpts = L.control.window(map,{title:'',content:content, visible: true, position:'topRight', maxWidth:500, modal:false})
                    windowAnt = winOpts;
                })

            };



            //añado las actividades registradas por el grupo

            function eachActivity(feature, layer){
                console.log("imprimiendo feature");
                var urlIcon = feature.geometry.properties.icon;
                var myIcon = L.icon({
                    iconUrl: '/assets/v2/images/categories/'+urlIcon,
                    iconSize: [40, 40],
                    iconAnchor: [22, 10]
                });
                feature.geometry.properties.fecha
                layer.setIcon(myIcon);
                layer.defaultOptions.riseOnHover = true;
                var fotos = feature.geometry.properties.fotos;
                var url = "";
                console.log(fotos);
                if(fotos != null) {
                    if (fotos.length > 0) {
                        var url = '/files/actividades/'+fotos[0].url;
                    }else{
                        var url = '/assets/v2/images//categories/'+urlIcon;
                    }
                }


                var fechaReg = feature.geometry.properties.fecha;
                var date = fechaReg.split("-");
                var fechaText = date[2]+' de ';
                var mes;
                switch(date[1]){
                    case '01': mes='Enero'
                        break;
                    case '02': mes = 'Febrero'
                        break;
                    case '03': mes = 'Marzo'
                        break;
                    case '04': mes = 'Abril'
                        break;
                    case '05': mes = 'Mayo'
                        break;
                    case '06': mes = 'Junio'
                        break;
                    case '07': mes = 'Julio'
                        break;
                    case '08': mes = 'Agosto'
                        break;
                    case '09': mes = 'Septiembre'
                        break;
                    case '10': mes = 'Octubre'
                        break;
                    case '11': mes = 'Noviembre'
                        break;
                    case '12': mes = 'Diciembre'
                        break;
                    default: mes = 'no entro';
                }
                fechaText += mes + ' de '+ date[0];

                console.log(fechaText);

                var title = '<h2><a href="/publications/'+feature.geometry.properties.id+'" target="_top" id="name-profile">'+feature.geometry.properties.titulo.toUpperCase()+'</a></h2>';

                var content = '<div class="content-info-marker">'+title +
                        '<p id="autor-activity"><em>Publicado por: </em><a target="_top" href="/autor/'+feature.geometry.properties.email+'"><b>'+feature.geometry.properties.autor+'</b></a> <br>El '+fechaText+'</p><br>' +
                        '<img src="'+url+'"  height="200px" class="main-image-activity img-rounded">' +
                        '<br><div id="description-activity">' +
                        '<p id="description-activity">'+feature.geometry.properties.descripcion+'</p>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-sm-12">' +
                        '<div id="cont-images-activity">';
                var fotos = feature.geometry.properties.fotos;
                var max = 2;
                for(var i=1; i < fotos.length; i++){
                    if(i <= max){
                        content += '<img src="/files/actividades/'+fotos[i].url+'" width="50%" class="img-responsive image-activity img-thumbnail">';
                    }

                }

                content += '</div>' +
                        '</div>' +
                        '</div></div>';

                layer.on('click', function () {
                    if(windowAnt != null){
                        windowAnt.close();
                    }

                    var winOpts = L.control.window(map,{title:'',content:content, visible: true, position:'topRight', maxWidth:500, modal:false})
                    windowAnt = winOpts;
                })
            };

            var id = $("#id-group").val();
            $.ajax({
                url:   '/v2/activities-group-register/'+id,
                type:  'get',
                beforeSend: function () {
                    console.log("Procesando, espere por favor...");
                },
                success: function (data){
                    console.log("imprimiendo actividades");
                    var activities = JSON.parse(data);
                    console.log(activities);
                    var activitiesMap = L.geoJson(activities,{
                        onEachFeature: eachActivity
                    });
                    activitiesMap.addLayer(punto1);
                    var markers = L.markerClusterGroup();
                    markers.addLayer(activitiesMap);
                    map.addLayer(markers);
                },
                error: function(jqXHR, text){
                    console.log(jqXHR);
                    console.log(text);
                }
            });
            $.ajax({
                url:   '/v2/tours-group-register/'+id,
                type:  'get',
                beforeSend: function () {
                    console.log("Procesando, espere por favor...");
                },
                success: function (data){
                    var recorridos = JSON.parse(data);
                    console.log("imprimiendo recorridos");
                    console.log(recorridos);
                    var recorridosMap = L.geoJson(recorridos,{
                        onEachFeature: eachTour
                    }).addTo(map);

                },
                error: function(jqXHR, text){
                    console.log(jqXHR);
                    console.log(text);
                }
            });
        });


    </script>
@endsection