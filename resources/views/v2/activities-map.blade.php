@extends('v2/template')

@section('title')
    Mapa acciones
@endsection

@section('css')
    <link href="{{ asset('assets/v2/css/map.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/v2/css/Control.FullScreen.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/v2/css/L.Control.Window.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/v2/css/cluster/MarkerCluster.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/v2/css/cluster/MarkerCluster.Default.css') }}" rel="stylesheet">
@endsection

@section('content')
    <input type="hidden" id="page-active" for="#li-activities">
    <div id="v2-map">

    </div>

@endsection

@section('scripts')
    <script src="{{ asset('assets/v2/js/Control.FullScreen.js') }}"></script>
    <script src="{{ asset('assets/v2/js/L.Control.Window.js') }}"></script>
    <script src="{{ asset('assets/v2/js/cluster/leaflet.markercluster-src.js') }}"></script>
    <script src="{{ asset('assets/v2/js/mapAct.js') }}"></script>
@endsection