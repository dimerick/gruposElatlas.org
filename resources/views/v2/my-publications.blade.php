@extends('v2/template')

@section('title')
    Mis publicaciones
    @endsection

    @section('content')
<section id="my-publications">
    @if(count($actividades) > 0)
        <p><strong> Has registrado {{$num}} actividades</strong></p>
        <table class="table table-striped">
            <tr>

                <th>Titulo</th>
                <th>Fecha</th>
                <th>Fecha Registro</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            @foreach($actividades as $actividad)
                <tr data-id="{{$actividad->id}}">

                    <td>{{$actividad->titulo}}</td>
                    <td>{{$actividad->fecha}}</td>
                    <td>{{$actividad->created_at}}</td>
                    <td>{{$actividad->descripcion}}</td>
                    <td>
                        @if($actividad->confirmada == 1)
                            Aprobado
                        @elseif($actividad->confirmada == 0)
                            Sin Aprobar
                        @endif

                    </td>
                    <td class="options">
                        <a href="/publications/{{$actividad->id}}"><i class="fa fa-eye" title="Ver reporte"></i></a>
                        <a href="/user/upload-photos/{{$actividad->id}}"><i class="fa fa-file-image-o" title="Cargar Fotos"></i></a>
                        <a href="/user/reports/delete/{{$actividad->id}}" id="remove"> <i class="fa fa-close fa-lg" title="Eliminar"></i> </a>
                        <a href="/user/reports/edit/{{$actividad->id}}"> <i class="fa fa-refresh fa-lg" title="Actualizar"></i> </a>
                        @if($actividad->tipo == 2)
                            <a href="/user/report/upload-coordinates/{{$actividad->id}}"> <i class="fa fa-map-marker fa-lg" title="Cargar Coordenadas"></i> </a>
                        @endif
                    </td>
                </tr>

            @endforeach
        </table>
    @else
        <div class="alert alert-info" role="alert"><h4>Whoops! no has registrado actividades</h4></div>
    @endif

</section>


@endsection

@section('scripts')
    <script src="{{ asset('assets/v2/js/admin.js') }}"></script>
@endsection