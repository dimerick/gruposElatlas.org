<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Include meta tag to ensure proper rendering and touch zooming -->
<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>El Atlas</title>


    <link href="{{ asset('assets/v3/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/v3/css/leaflet.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/v3/css/map.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/v3/css/animate.css')}}" rel="stylesheet">
    <!--<link href="{{ asset('assets/v3/css/Control.FullScreen.css')}}" rel="stylesheet">-->
    <link href="{{ asset('assets/v3/css/L.Control.Window.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/v3/css/leaflet-search.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/v3/css/cluster/MarkerCluster.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/v3/css/cluster/MarkerCluster.Default.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/v3/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/v3/css/modal.css')}}" rel="stylesheet">


</head>
<body>

<div class="row" style="padding-right: 0px;padding-left: 0px;margin-right: 0px;margin-left: 0px;">
       <div class="col-sm-12" style="padding-right: 0px;padding-left: 0px;">

         <!--<div id="control-map">-->
                   <!--<div id="categories"></div>-->
                   <!--<button type="button" id="lessZoom" class="btn btn-default btn-sm">-->
                     <!--<i class="fa fa-minus" aria-hidden="true"></i>-->
                   <!--</button>-->
                   <!--<button type="button" id="moreZoom" class="btn btn-default btn-sm">-->
                     <!--<i class="fa fa-plus" aria-hidden="true"></i>-->
                   <!--</button>-->
         <!--</div>-->

        <div id="map"> </div>
    </div>
</div>


</body>
<script src="{{ asset('assets/v3/js/jquery-2.1.0.min.js') }}"></script>
<script src="{{ asset('assets/v3/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/v3/js/leaflet.js') }}"></script>
<!--<script src="{{ asset('assets/v3/js/Control.FullScreen.js') }}"></script>-->
<script src="{{ asset('assets/v3/js/L.Control.Window.js') }}"></script>
<script src="{{ asset('assets/v3/js/leaflet-search.js') }}"></script>
<script src="{{ asset('assets/v3/js/cluster/leaflet.markercluster-src.js') }}"></script>
<script src="{{ asset('assets/v3/js/mapGroups.js') }}"></script>
<script src="{{ asset('assets/v3/js/modal.js') }}"></script>
</html>
