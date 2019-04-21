@extends('v2/template')

@section('title')
    Reporte
    @endsection

@section('css')
@endsection

    @section('content')
<div class="row">

    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><i class="fa fa-flag"></i> {{$reporte[0]->titulo}}</h4></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12" id="actions">
                        <p class="descrip">
                            @if($reporte[0]->confirmada == 1)
                                <a href="#" class="active" disabled="disabled"><i class="fa fa-thumbs-up fa-lg" title="Aprobar"></i></a>
                                <a href="/admin/reports/desapprove/{{$reporte[0]->id}}"> <i class="fa fa-thumbs-down fa-lg" title="Desaprobar"></i> </a>
                            @else
                                <a href="/admin/reports/approve/{{$reporte[0]->id}}"><i class="fa fa-thumbs-up fa-lg" title="Aprobar"></i></a>
                                <a href="#" class="active"> <i class="fa fa-thumbs-down fa-lg" title="Desaprobar"></i> </a>
                            @endif


                            <a href="/admin/reports/delete/{{$reporte[0]->id}}" id="remove"> <i class="fa fa-close fa-lg" title="Eliminar"></i> </a>
                            <a href="/admin/reports/edit/{{$reporte[0]->id}}"> <i class="fa fa-refresh fa-lg" title="Actualizar"></i> </a>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <p class="descrip"><i class="fa fa-calendar"> <strong>{{$reporte[0]->fecha}}</strong></i> |

                            <i class="fa fa-user"> <a href="/autor/{{$reporte[0]->email}}">
                                    {{$reporte[0]->nombre}}
                                </a></i>
                        </p>
                        <p class="descrip"><strong>Descripcion: </strong>{{$reporte[0]->descripcion}}</p>

                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">

                        @foreach($fotos as $foto)

                            <a href="/files/actividades/{{$foto->url}}" data-lightbox="{{$reporte[0]->titulo}}" data-title="{{$reporte[0]->titulo}}"><img src="/files/actividades/{{$foto->url}}" width="150px" class="pull-left thumbnail"></a>

                        @endforeach

                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" id="latitud" value="{{$reporte[0]->latitud}}">
                        <input type="hidden" id="longitud" value="{{$reporte[0]->longitud}}">
                        <input type="hidden" id="titulo" value="{{$reporte[0]->titulo}}">
                        <div id="activity-map"></div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>

        </div>
    </div>
</div>


@endsection

@section('scripts')
    <script>
        $('document').ready(function(){
            $("#remove").click(function(e){

                var val = confirm("Realmente desea eliminar este reporte");
                if(!val){
                    e.preventDefault();
                }
            })

            var latitud, longitud, titulo;
            latitud = $('#latitud').attr("value");
            longitud = $('#longitud').attr("value");
            titulo = $("#titulo").attr("value");


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

            var punto1 = L.marker([latitud, longitud], {icon: myIcon}).addTo(map);

        });


    </script>
@endsection