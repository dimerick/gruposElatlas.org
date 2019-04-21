@extends('mobirirse/template')

@section('title')
    Busqueda Documentos
@endsection


@section('content')
    <section class="mbr-section mbr-after-navbar" id="form1-0" style="background-color: rgb(255, 255, 255); padding-top: 120px; padding-bottom: 120px;">

        <div class="mbr-section mbr-section__container mbr-section__container--middle">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-xs-center">
                        <h4 class="mbr-section-title display-2">Busqueda Documentos</h4>

                    </div>
                </div>
            </div>
        </div>
        <div class="mbr-section mbr-section-nopadding">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-lg-10 col-lg-offset-1" data-form-type="formoid">

                        <div data-form-alert="true">
                            <div hidden="" data-form-alert-success="true" class="alert alert-form alert-success text-xs-center">Thanks for filling out form!</div>
                        </div>




                            <div class="row row-sm-offset">

                                <div class="col-xs-12 col-md-12">
                                    <div class="form-group">
                                        <label id="messages-form" class="messages-form">

                                        </label>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-12">
                                    <div class="form-group">
                                            <label class="form-control-label" for="key-word">Palabra clave<span class="form-asterisk">*</span></label>
                                        <input type="text" class="form-control" name="key-word" required="" id="key-word">
                                    </div>
                                </div>

                            </div>


                            <div><button type="submit" id="btn-submit" class="btn btn-primary">Buscar</button></div>


                        <hr>

                            <div id="result-status"></div>
                            <div id="result-body"></div>

                        </div>

                    </div>
                </div>
            </div>
    </section>
@endsection

@section('scripts')
    <script>
        $('document').ready(function(){

            $("#btn-submit").click(function () {
                var keyWord = $("#key-word").val();
                keyWord = keyWord.trim();
                if(keyWord != ""){
                    $("#messages-form").text("");
                    var url = "/opensource-legion-del-afecto/search/" + keyWord;
                    window.location = url;
                }else{
$("#messages-form").text("Los campos marcados con asterisco son requeridos");
                }
            })

        });
    </script>
@endsection