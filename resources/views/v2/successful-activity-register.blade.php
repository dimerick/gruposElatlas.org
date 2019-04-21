@extends('v2/template')

@section('title')
    Agrear fotos a {{$activity->titulo}}
@endsection

@section('css')
@endsection

@section('content')

   <div class="alert alert-info">
       <p>Desea cargar las fotos de la actividad <b>{{$activity->titulo}}</b>?</p>
       <br>
       <p>
       <a href="/user/upload-photos/{{$activity->id}}" class="btn btn-primary btn-sm" role="button">Si ahora mismo</a>
       <a href="/user/my-publications" class="btn btn-success btn-sm" id="btn-without-photos"role="button">Lo hare mas tarde</a></p>
   </div>




@endsection

@section('scripts')
    <script>
$("#btn-without-photos").click(function () {
   alert("Se ha registrado la actividad exitosamente");
});
    </script>
@endsection