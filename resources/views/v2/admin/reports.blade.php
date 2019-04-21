@extends('v2/template')

@section('title')
    Reportes
    @endsection

@section('content')
<section id="reports">
    <p><strong>{{$numApr}} reportes aprobados de {{$num}} registrados </strong></p>


    <table class="table table-striped">
        <tr>

            <th>Titulo</th>
            <th>Autor</th>
            <th>Fecha</th>
            <th>Fecha Registro</th>
            <th>Descripción</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>

        @foreach($actividades as $actividad)
            <tr data-id="{{$actividad->id}}">

                <td>{{$actividad->titulo}}</td>
                <td>{{$actividad->nombre}}</td>
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
                <td><a href="/admin/show-report/{{$actividad->id}}">Ver Reporte</a></td>
            </tr>

        @endforeach
    </table>
</section>


@endsection
