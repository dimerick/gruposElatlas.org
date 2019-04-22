<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElAtlas</title>
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}"/>
<link rel="bookmark" href="{{asset('favicon.ico')}}"/>
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto:300,500" rel="stylesheet">


  <link href="{{asset('assets/v4/css/leaflet.css')}}" rel="stylesheet">
  <link href="{{asset('assets/v4/css/animate.css')}}" rel="stylesheet">
  <link href="{{asset('assets/v4/css/leaflet-search.css')}}" rel="stylesheet">
  <link href="{{asset('assets/v4/css/cluster/MarkerCluster.css')}}" rel="stylesheet">
  <link href="{{asset('assets/v4/css/cluster/MarkerCluster.Default.css')}}" rel="stylesheet">
  <link href="{{asset('assets/v4/css/font-awesome.css')}}" rel="stylesheet">
  <link href="{{asset('assets/v4/css/leaflet.modal.css')}}" rel="stylesheet">
  <link href="{{asset('assets/v4/css/iconLayers.css')}}" rel="stylesheet">
  <link href="{{asset('assets/v4/css/style.css')}}" rel="stylesheet">

  {{--<link href="css/leaflet.css" rel="stylesheet">--}}
  {{--<link href="css/animate.css" rel="stylesheet">--}}
  {{--<link href="css/leaflet-search.css" rel="stylesheet">--}}
  {{--<link href="css/cluster/MarkerCluster.css" rel="stylesheet">--}}
  {{--<link href="css/cluster/MarkerCluster.Default.css" rel="stylesheet">--}}
  {{--<link href="css/font-awesome.css" rel="stylesheet">--}}
  {{--<link href="css/modal.css" rel="stylesheet">--}}
  {{--<link href="css/leaflet.modal.css" rel="stylesheet">--}}
  {{--<link href="css/iconLayers.css" rel="stylesheet">--}}
  {{--<link rel="stylesheet" href="css/style.css" type="text/css">--}}

</head>
<body>
<div id="info-el-atlas" class="hide">
  <div class="content-modal">
    <div class="content-group">
      <h2>Red ElAtlas</h2>
      <p>Red Elatlas es una base de datos espacial para la visibilización y conexión de grupos comunitarios de base alrededor del mundo, a través de tecnologías geoespaciales open-source. A través de esta plataforma promovemos la participación y la coproducción de conocimiento en diversos temas.</p>
    </div>
    
    <div class="content-group">
      <h2>Contactenos</h2>
      <p><i class="fa fa-map-marker icon-footer"></i> Philadelphia, USA | Medellín, Colombia</p>
      <p><i class="fa fa-envelope icon-footer"></i><a href="mailto:info@elatlas.org"> <b>info@elatlas.co </b></a></p>
    </div>
    <div class="content-group info-db">
      <p>La base de datos de Elatlas está basada sobre un trabajo apoyado por National Science Foundation" (la fundación nacional de ciencia en los EE.UU) bajo la subvención #1452541.<br> Las opiniones, resultados, conclusiones y recomendaciones expresadas en este sitio web son responsabilidad del autor y no necesariamente reflejan las visiones de "National Science Foundation" (la fundación nacional de ciencia en los EE.UU).</p>
    </div>
  </div>

</div>
<div id="all-content">


<div id="top-options">
    <span>Red ElAtlas - Geografía viva y afectiva</span>
    <a href="/unirme" class="myButton">Registrarme</a>
</div>
<section id="main-content">



  <nav class="menu">
    <ul>
      <li><a href="#" class="open-modal-custom" title="Sobre ElAtlas"><i class="fa fa-info-circle fa-2x" aria-hidden="true"></i></a></li>
      <li><a href="#" id="moreZoom" title="Aumentar Zoom"><i class="fa fa-plus fa-2x" aria-hidden="true" ></i></a></li>
      <li><a href="#" id="lessZoom" title="Disminuir Zoom"><i class="fa fa-minus fa-2x" aria-hidden="true"></i></a></li>
      <input type="checkbox" id="input-show-categories">
      <li><a href="#" id="label-show-categories" title="Mostrar Categorias"><i class="fa fa-list fa-2x" aria-hidden="true"></i></a></li>

    </ul>

  </nav>


  <div id="map"> </div>

</section>
</div>
<script src="{{ asset('assets/v4/js/jquery-2.1.0.min.js') }}"></script>
<script src="{{ asset('assets/v4/js/leaflet.js') }}"></script>
<script src="{{ asset('assets/v4/js/leaflet-search.js') }}"></script>
<script src="{{ asset('assets/v4/js/cluster/leaflet.markercluster-src.js') }}"></script>
<script src="{{ asset('assets/v4/js/map.js') }}"></script>
<script src="{{ asset('assets/v4/js/Leaflet.Modal.js') }}"></script>
<script src="{{ asset('assets/v4/js/iconLayers.js') }}"></script>


{{--<script src="js/jquery-2.1.0.min.js"></script>--}}
{{--<script src="js/leaflet.js"></script>--}}
{{--<script src="js/leaflet-search.js"></script>--}}
{{--<script src="js/cluster/leaflet.markercluster-src.js"></script>--}}
{{--<script src="js/map.js"></script>--}}
{{--<!--<script src="js/modal.js"></script>-->--}}
{{--<script src="js/Leaflet.Modal.js"></script>--}}
{{--<script src="js/iconLayers.js"></script>--}}
</body>
</html>
