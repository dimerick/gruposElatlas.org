@extends('v2/template')

@section('title')
    Atlas del afecto
@endsection

@section('css')
    <link href="{{ asset('assets/css/lightbox.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/v2/css/map.css') }}" rel="stylesheet">
@endsection


@section('content')

    <div id="v2-map"> </div>

@endsection

@section('scripts')
    <script src="{{ asset('assets/v2/js/maps.js') }}"></script>
@endsection