@extends('v2/template')

@section('title')
    EL Atlas
@endsection

@section('css')
    <link href="{{ asset('assets/css/lightbox.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/v2/css/map.css') }}" rel="stylesheet">
@endsection

@section('content')

    <section id="about">
        <h3>¿Quiénes somos?</h3>
        <p>Somos una plataforma que conecta los procesos sociales alrededor del mundo, a través de la geografía, promoviendo la participación y la generación de conocimiento en diversos temas.</p>
        <br>
        <h3>¿Como?</h3>
        <ul>
            <li>Vivencial:  Posibilitamos el intercambio de saberes para potencializar el quehacer y sentir de los procesos sociales desde su propia experiencia.</li>
            <li>Investigativo: Promovemos la generación de conocimiento conectando los procesos sociales, académicos y expertos para la transformación social.</li>
            <li>Educativo: Fomentamos el desarrollo de procesos formativos para crear conciencia alrededor de las relaciones entre el ser humano y su entorno.</li>
        </ul>

    </section>

@endsection

@section('scripts')
    <script src="{{ asset('assets/v2/js/map.js') }}"></script>
@endsection