@extends('v2/template')

@section('title')
    Coincidencias para {{$cadena}}
@endsection

@section('css')

@endsection

@section('content')
    @if(count($grupos) > 0 || count($actividades) > 0)
@foreach($grupos as $grupo)

        <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="/autor/{{$grupo->email}}"><h4><i class="fa fa-user"> </i> {{$grupo->nombre}}</h4></a>
                    </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                           <center> <img src="/files/{{$grupo->foto}}" class="thumbnail photo-profile" width="40%"></center>
                        </div>
                        <div class="col-sm-6">
                            <p class="descrip"><i class="fa fa-envelope-o"></i> {{$grupo->email}}</p>
                            <p><i class="fa fa-globe">  </i> {{$grupo->ciudad}} </p>
                            <p>    <i class="fa fa-group"> </i> {{$grupo->num_int}}</p>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <p class="descrip"><strong>Descripcion: </strong>{{$grupo->descripcion}}</p>
                    </div>

                </div>


            </div>

@endforeach
@foreach($actividades as $actividad)
    <div class="panel panel-primary">
        <div class="panel-heading">
            <a href="/publications/{{$actividad->id}}" target="_blank"> <h4><i class="fa fa-flag"></i> {{$actividad->titulo}}</h4></a>
            </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <p class="descrip"><i class="fa fa-calendar"> <strong>{{$actividad->fecha}}</strong></i> |
                        <i class="fa fa-user"> <a href="/autor/{{$actividad->email}}">
                                {{$actividad->nombre}}
                            </a></i>
                    </p>
                    <p class="descrip"><strong>Descripcion: </strong>{{$actividad->descripcion}}</p>

                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-12">

                    @foreach($fotos as $foto)
                        @if($foto->actividad == $actividad->id)
                            <img src="/files/actividades/{{$foto->url}}" width="150px" class="pull-left thumbnail">
                        @endif
                    @endforeach

                </div>
            </div>
        </div>

    </div>
@endforeach
@else
        <div class="alert alert-info" role="alert"><h4><strong>Whoops!</strong> al parecer no hay coincidencias para esta busqueda</h4></div>

    @endif

@endsection

@section('scripts')
@endsection