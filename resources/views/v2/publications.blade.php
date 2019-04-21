@extends('v2/template')

@section('title')
    Publicaciones Recientes
@endsection

@section('css')
    <link href="{{ asset('assets/css/lightbox.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">

        </div>
    </div>
    @if(count($actividades) > 0)
        @foreach($actividades as $actividad)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="/publications/{{$actividad->id}}" target="_blank"> <h4><img class="icon-cat" src="/assets/v2/images/categories/{{$actividad->icon}}" title="{{$actividad->nomCat}}"> {{strtoupper($actividad->titulo)}}</h4></a>

                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="descrip"><i class="fa fa-calendar"> <strong>{{$actividad->fecha}}</strong></i> |

                                <i class="fa fa-user"> <a href="/autor/{{$actividad->grupo}}">
                                        @foreach($cuentas as $cuenta)
                                            @if($cuenta->email == $actividad->grupo)
                                                <strong>{{$cuenta->nombre}}</strong>
                                            @endif
                                        @endforeach
                                    </a>    </i>
                            </p>
<hr>
                            <p class="descrip">{{$actividad->descripcion}}</p>

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            @foreach($fotos as $foto)
                                    @if($foto->actividad == $actividad->id)
                                        <a href="/files/actividades/{{$foto->url}}" data-lightbox="{{$actividad->titulo}}" data-title="{{$actividad->titulo}}"><img src="/files/actividades/{{$foto->url}}" width="50%" class="pull-left thumbnail thum-img-activity"></a>
                                    @endif
                            @endforeach
                        </div>
                    </div>

                </div>
                </div>
        @endforeach
    @else
        <div class="alert alert-info" role="alert"><h4>Whoops! al parecer aun no hay publicaciones</h4></div>
    @endif



@endsection

@section('scripts')

@endsection