@extends('v2/template')

@section('title')
    Añadir fotos a {{$datos['titulo']}}
@endsection

@section('css')
    <link href="{{ asset('assets/v2/css/dropzone.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="message">

    </div>
    <div class="panel panel-default">

        <div class="panel-heading"> <h4>Añadir fotos a {{$datos['titulo']}}</h4></div>
        <div class="panel-body">
            {!! Form::open(['url'=> '/user/upload-photos', 'method' => 'POST', 'files'=>'true', 'id' => 'my-dropzone' , 'class' => 'dropzone']) !!}

            <input type="hidden" name="id" value="{{$datos['id']}}">
            <div class="form-group">
            <div class="dz-message" id="dz-message">
                <p>Haga clic o arrastre la foto a esta área</p>
                <p><i>Máximo 2MB por archivo</i></p>

            </div>
            </div>
            <div class="form-group"><div class="dropzone-previews"></div></div>


            <div class="form-group"><button type="submit" class="btn btn-primary" id="submit">Enviar</button></div>

            {!! Form::close() !!}



        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/v2/js/dropzone.js') }}"></script>
    <script>
        Dropzone.options.myDropzone = {
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 5,
            maxFilesize: 2,
            maxFiles: 10,
            acceptedFiles: 'image/*',

            init: function() {
                var submitBtn = document.querySelector("#submit");
                myDropzone = this;

                submitBtn.addEventListener("click", function(e){
                            e.preventDefault();
                            e.stopPropagation();
                            myDropzone.processQueue();

                });
                this.on("addedfile", function(file) {

                });

                this.on("complete", function(file) {
                    myDropzone.removeFile(file);
                });
                this.on("successmultiple", function(files, response){
                    var content = '<div class="alert alert-success">Se han cargado las fotos exitosamente</div>';
                    $("#message").html(content);

                });
                this.on("errormultiple", function(files, response){
                alert("hubo un error al enviar los archivos");
                    var content = '<div class="alert alert-danger">'+response+'</div>';
                    $("#message").html(content);
                });
//                this.on("success",
//                        myDropzone.processQueue.bind(myDropzone)
//                );
            }
        };
    </script>
@endsection