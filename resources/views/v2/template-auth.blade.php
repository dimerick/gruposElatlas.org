<!DOCTYPE html>
<!--[if lt IE 7 ]>
<html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>
<html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>
<html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8"/>

    <!-- Page Title -->
    <title>@yield('title','Atlas del Afecto')</title>

    <meta name="keywords" content="Elatlas, afecto, comunidades, territorio"/>


    <!-- Mobile Meta Tag -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf-token" content="{{csrf_token()}}">


    <!-- Google Web Font -->
    {{--<link href="http://fonts.googleapis.com/css?family=Raleway:300,500,900%7COpen+Sans:400,700,400italic"--}}
          {{--rel="stylesheet" type="text/css"/>--}}

    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/v2/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template CSS -->
    <link href="{{ asset('assets/v2/css/lazeemenu.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/v2/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/v2/css/leaflet.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/v2/css/lightbox.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/v2/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/v2/css/menu.css') }}" rel="stylesheet">
    @yield('css')

            <!--Font Awesone-->
    <link href="{{ asset('assets/v2/css/font-awesome.min.css') }}" rel="stylesheet">

</head>
<body>


<div class="container-fluid">
    <!--Div search-->
    @include('v2/partials/search')
    <!--Div search-->


    <div class="row">
        <div class="col-sm-12">
            <header>

                <div class="row">
                    <div class="col-sm-12">
                            <img src="{{ asset('assets/v2/images/logo.svg') }}" class="img-responsive" id="logo">

                    </div>

                </div>

                {{--<div class="row">--}}
                    {{--<div class="col-sm-12">--}}
                        {{--<section id="collage">--}}
                            {{--<img src="{{ asset('assets/v2/images/collage.jpg') }}">--}}
                        {{--</section>--}}

                    {{--</div>--}}
                {{--</div>--}}
            </header>
        </div>
    </div>

    {{--<div class="row">--}}
        {{--<div class="col-sm-12">--}}
            {{--<section id="bar-top">--}}

                {{--<div class="row">--}}
                    {{--<div class="col-sm-12">--}}
                        {{--<ul id="icons-social" class="pull-right">--}}
                            {{--<li id="li-search"><a href="#div-search" title="Busqueda" rel="leanModal"><i class="fa fa-search fa-2x"></i></a></li>--}}
                            {{--<li><a href="https://www.facebook.com/Atlas-del-Afecto-681367321998487" target="_blank"><i class="fa fa-facebook-square fa-2x"></i></a></li>--}}
                            {{--<li><a href="#"><i class="fa fa-youtube-square fa-2x"></i></a></li>--}}
                            {{--@include('v2/partials/options-user-top')--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</section>--}}

        {{--</div>--}}
    {{--</div>--}}

    <div class="row">
        <section id="main-section">
            <!--Navigation-->
            <div class="col-sm-3">
                {{--<nav>--}}
                    {{--<ul id="menu-1">--}}
                        {{--<li id="li-1" class="one-item">--}}
                            {{--<h3><span><a href="/v2" id="a-li-1" class="item a-one-item" for="li-1" title="Busqueda"><strong><i--}}
                                                    {{--class="fa fa-flag"></i> Quienes Somos</strong></a></span></h3>--}}
                        {{--</li>--}}
                        {{--<li id="li-1-1" class="one-item">--}}
                            {{--<h3><span><a href="/publications" id="a-li-1-1" class="item a-one-item" for="li-1" title="Busqueda"><strong><i--}}
                                                    {{--class="fa fa-list"></i> Publicaciones Recientes</strong></a></span></h3>--}}
                        {{--</li>--}}
                        {{--<li id="li-2">--}}
                            {{--<h3><span><i class="fa fa-globe"></i> Mapas</span></h3>--}}
                            {{--<ul>--}}
                                {{--<li class="item" id="li-groups"><a href="/v2/mapa-grupos">Grupos</a></li>--}}
                                {{--<li class="item" id="li-activities"><a href="/v2/mapa-acciones">Actividades</a></li>--}}
                                {{--<li class="item" id="li-tours"><a href="/v2/mapa-recorridos">Recorridos</a></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<h3><span><i class="fa fa-tasks"></i> Galeria</span></h3>--}}
                            {{--<ul>--}}
                                {{--<li class="item"><a href="/">Item 1</a></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<h3><span><i class="fa fa-question"></i> Preguntas Frecuentes</span></h3>--}}
                            {{--<ul>--}}
                                {{--<li class="item"><a href="/v2/preguntas-frecuentes">¿Que es elatlas y que tiene que ver con la geografía?</a>--}}
                                {{--</li>--}}
                                {{--<li class="item"><a href="/v2/preguntas-frecuentes">¿Quiénes Pueden Participar?</a></li>--}}
                                {{--<li class="item"><a href="/v2/preguntas-frecuentes">¿Cómo puedes participar en Elatlas?</a></li>--}}
                                {{--<li class="item"><a href="/v2/preguntas-frecuentes">¿Qué es nuestra galería?</a></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}

                        {{--<li class="one-item">--}}
                            {{--<h3><span><a href="/v2/preguntas-frecuentes" id="a-li-3" class="item a-one-item" for="li-1"><strong><i--}}
                                                    {{--class="fa fa-question"></i> Preguntas Frecuentes</strong></a></span></h3>--}}
                        {{--</li>--}}

                        {{--<li>--}}
                            {{--<h3><span><i class="fa fa-child"></i> Oportunidad de intercambio</span></h3>--}}
                            {{--<ul>--}}
                                {{--<li class="item"><a href="/">Proximamente</a></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<h3><span><i class="fa fa-share-alt-square"></i> Oportunidades disponibles</span></h3>--}}
                            {{--<ul>--}}
                                {{--<li class="item"><a href="/">Proximamente</a></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<h3><span><i class="fa fa-globe"></i> Modulos educativos</span></h3>--}}
                            {{--<ul>--}}
                                {{--<li class="item"><a href="/">Proximamente</a></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                        {{--<li class="one-item" id="li-2">--}}
                            {{--<h3><span id="span-search"><a id="icon-search" class="pull-left" for="li-2" title="Busqueda"--}}
                                                          {{--href="#div-search" name="#div-search" rel="leanModal"><strong><i--}}
                                                    {{--class="fa fa-search"></i> Busqueda</strong></a></span></h3>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</nav>--}}
            </div>
            <!--Navigation-->
            <div class="col-sm-6">

                <div class="cinta"></div>
                <section id="main-content">
                    <div class="row">
                        <div class="col-sm-12">
                            @if (Session::has('message'))
                                <div class="alert alert-danger">{{ Session::get('message') }}</div>
                            @elseif(Session::has('succes'))
                                <div class="alert alert-success">{{ Session::get('succes') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">@yield('content')</div>
                    </div>
                </section>


            </div>

            <div class="col-sm-3">
                <section id="nav-right">
{{--@include('v2/partials/options-user-right')--}}
                </section>
            </div>
        </section>

    </div>

    <!--Footer-->
    <div class="row">
        <div class="col-sm-12">
            <footer>


                <!--Collage-->
                <div class="row">
                    <div class="col-sm-12">
                        <section id="collage">
                            {{--<a href="/"> <img src="{{ asset('assets/images/collage.jpg') }}"></a>--}}
                        </section>

                    </div>
                </div>
                <!--Collage-->


                <div class="row">
                    <div class="col-sm-12">
                        <h3 id="slogan">Comunidades en movimiento</h3>

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <section id="contact">
                            <ul>
                                <li><span><i class="fa fa-map-marker fa-2x icon-footer"></i> Philadelphia, USA | Medellín, Colombia</span>
                                </li>
                                <li><span><i class="fa fa-envelope fa-2x icon-footer"></i><a
                                                href="mailto:email@yourbusiness.com"> <b>info@elatlas.org </b></a></span></li>

                            </ul>
                        </section>

                    </div>
                    <div class="col-sm-2"></div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <section id="info-footer">
                            <div class="row">
                                <div class="col-md-3">

                                </div>
                                <div class="col-sm-6">
                                    <section id="description">
                                        <p>La base de datos de Elatlas está basada sobre un trabajo apoyado por National
                                            Science Foundation" (la fundación nacional de ciencia en los EE.UU) bajo la
                                            subvención #1452541.</p>
                                        <p>Las opiniones, resultados, conclusiones y recomendaciones expresadas en este
                                            sitio web son responsabilidad del autor y no necesariamente reflejan las
                                            visiones de "National Science Foundation" (la fundación nacional de ciencia
                                            en los EE.UU)</p>
                                    </section>


                                </div>
                                <div class="col-sm-3">
                                    <a id="gototop" class="pull-right" href="#"><i class="fa fa-angle-up fa-4x"></i></a>
                                </div>
                            </div>


                        </section>
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-12">


                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-12">

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-12">

                            </div>

                        </div>
                        {{--<div class="row">--}}
                            {{--<div class="col-sm-12">--}}
                                {{--<section id="copyright">--}}
                                    {{--<span>&copy; 2016 Elatlas.org | All rights reserved. Developed by <a--}}
                                                {{--href="http://facebook.com/esaenz-2010" target="_blank"><b>Erick--}}
                                            {{--Saenz</b></a></span>--}}
                                {{--</section>--}}

                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                    <div class="col-sm-1">

                    </div>
                </div>
            </footer>
        </div>

    </div>

</div>


</body>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>--}}
<script src="{{ asset('assets/v2/js/jquery-2.1.4.min.js') }}"></script>
<script src="{{ asset('assets/v2/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/v2/js/jquery.leanModal.min.js') }}"></script>
<script src="{{ asset('assets/v2/js/template.js') }}"></script>
<script src="{{ asset('assets/v2/js/lazeemenu-jquery.min.js') }}"></script>
<script src="{{ asset('assets/v2/js/search.js') }}"></script>
<script src="{{ asset('assets/v2/js/leaflet.js') }}"></script>
<script src="{{ asset('assets/v2/js/lightbox.min.js') }}"></script>
@yield('scripts')
</html>