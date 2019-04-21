@extends('v2/template')

@section('title')
    Editar foto perfil
@endsection

@section('css')
    <link href="{{ asset('assets/v2/css/dropzone.css') }}" rel="stylesheet">
@endsection

@section('content')
<div id="message">

</div>
    <div class="panel panel-default">

        <div class="panel-heading"> <h4>Editar foto de perfil</h4></div>
        <div class="panel-body">
            {!! Form::open(['url'=> '/user/update-photo-profile', 'method' => 'POST', 'files'=>'true', 'id' => 'my-dropzone' , 'class' => 'dropzone']) !!}

            <div class="form-group">
            <div class="dz-message" id="dz-message">
                <p>Haga clic o arrastre la foto a esta área</p>
                <p><i>Máximo 2MB por archivo</i></p>

            </div>
            </div>
            <div class="form-group"><div class="dropzone-previews"></div></div>


            <div class="form-group"><button type="submit" class="btn btn-primary btn-block" id="submit">Actualizar</button></div>

            {!! Form::close() !!}



        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/v2/js/dropzone.js') }}"></script>
    <script>
        Dropzone.options.myDropzone = {
            autoProcessQueue: false,
            uploadMultiple: false,
            parallelUploads: 1,
            maxFilesize: 2,
            maxFiles: 1,
            acceptedFiles: 'image/*',

            init: function() {
                var submitBtn = document.querySelector("#submit");
                myDropzone = this;

                submitBtn.addEventListener("click", function(e){
                            e.preventDefault();
                            e.stopPropagation();
                            myDropzone.processQueue();

                });
                this.on("addedfile", function(file){

                });

                this.on("complete", function(file) {
                    myDropzone.removeFile(file);
                });
                this.on("success", function(files, response){
                    var content = '<div class="alert alert-success">Se ha actualizado la foto de perfil exitosamente</div>';
                    $("#message").html(content);
                    $.ajax({
                        url:   '/user/get-photo-profile',
                        type:  'get',
                        beforeSend: function () {
                            console.log("Procesando, espere por favor...");
                        },
                        success: function (data){
                            var content = '<img src="/files/fotos_perfil/'+data+'" alt="">';
                            $("#cont-img-profile-top").html(content);
                            console.log(data);

                        },
                        error: function(jqXHR, text){
                            console.log(jqXHR);
                            console.log(text);
                        }
                    });
                    console.log(files);


                });

                this.on("error", function(files, response){
                    var content = '<div class="alert alert-danger">'+response+'</div>';
                    $("#message").html(content);
                });
                this.on("errormultiple", function(files, response){
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