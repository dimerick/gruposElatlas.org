@extends('v2/template')

@section('title')
    Agregar coordenadas a {{$datos[0]->titulo}}
@endsection

@section('css')
    <style>

    </style>
@endsection

@section('content')

    <section id="panel-coordinates">
        <input type="hidden" id="id-recorrido" value="{{$datos[0]->id}}">
        <p id="state"></p>
        <table id="table-coordinates" class="table table-bordered">
            <tr>
                <th>Num</th>
                <th>Latitud</th>
                <th>Longitud</th>
            </tr>
        </table>
        <button type="button" id="start-detection" class="btn btn-primary">Iniciar detección de coordenadas</button>
        <button type="button" id="stop-detection" class="btn btn-success">Detener detección de coordenadas</button>
    </section>


@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        var intervalo;
        var num = 0;
        function getPosition(position){
            var lat = position.coords.latitude;
            var long = position.coords.longitude;


            var id = $("#id-recorrido").val();
            var value = id+';'+lat+';'+long;
            console.log(value);
            var url = "/user/report/upload-coordinates-post/" + value;
            $.ajax({
                url: url,
                type: 'get',
                beforeSend: function () {
                },
                success: function (data) {
                    console.log("Respuesta servidor");
                    console.log(data);
                    if(data.success){
                        num++;
                        var content = '<tr>' +
                                '<td>'+num+'</td>' +
                                '<td>'+lat+'</td>' +
                                '<td>'+long+'</td>' +
                                '</tr>';
                        $("#table-coordinates").append(content);
                    }else{
                        var content = '<tr>' +
                                '<td colspan="3">Error al almacenar en servidor</td>' +
                                '</tr>';
                        $("#table-coordinates").append(content);
                    }
                },
                error: function (jqXHR, text) {
                    console.log(jqXHR);
                    console.log(text);
                    var content = '<tr>' +
                            '<td colspan="3">'+text+'</td>' +
                            '</tr>';
                    $("#table-coordinates").append(content);

                }
            });
        }
        function error(msg){
            var content = '<tr>' +
                    '<td colspan="3">Error al detectar la ubicación</td>' +
                    '</tr>';
            $("#table-coordinates").append(content);
        }

        $("#start-detection").click(function () {
            state = '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>Detectando Coordenadas cada 15 segundos';
            $("#state").html(state);
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(getPosition, error);
            }else{
                error('not supported');
            }
            intervalo = setInterval(function () {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(getPosition, error);
                }else{
                    error('not supported');
                }
            }, 15000);


        });

        $("#stop-detection").click(function () {
            $("#state").html("");
            clearInterval(intervalo);

        });



    });
</script>
@endsection