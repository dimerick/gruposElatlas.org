@extends('v2/template')

@section('title')
    Recorridos
@endsection

@section('css')
    <link href="{{ asset('assets/v2/css/Control.FullScreen.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/v2/css/L.Control.Window.css') }}" rel="stylesheet">
@endsection

@section('content')
<input type="hidden" id="page-active" for="#li-groups">
    <div id="v2-map">

    </div>

@endsection

@section('scripts')
    <script src="{{ asset('assets/v2/js/L.Control.Window.js') }}"></script>
    <script>
        $(document).ready(function(){
            var windowAnt = null;
            var height = $(window).height();
            $("#v2-map").css('height', height/1.2);
            var numColor = 0;
            var colors = ['#DF0101', '#09AC3F', '#0E2091', '#DD16D7', '#FF3C92', '#06A6A6', '#B0AA00'];
            function eachTour(feature, layer){
                if(numColor >= colors.length){
                    numColor = 0;
                }
                var style = {
                    fill: false,
                    fillOpacity: 1,
                    color : colors[numColor],
                    weight: 5
                }
                layer.setStyle(style);
                numColor++;
                var urlIcon = feature.geometry.properties.icon;
                console.log(urlIcon);


                var fotos = feature.geometry.properties.fotos;
                var url = "";
                console.log(fotos);
                if(fotos != null) {
                    if (fotos.length > 0) {
                        var url = '/files/actividades/'+fotos[0].url;
                    }else{
                        var url = '/assets/v2/images//categories/'+urlIcon;
                    }
                }



                var fechaReg = feature.geometry.properties.fecha;
                var date = fechaReg.split("-");
                var fechaText = date[2]+' de ';
                var mes;
                switch(date[1]){
                    case '01': mes='Enero'
                        break;
                    case '02': mes = 'Febrero'
                        break;
                    case '03': mes = 'Marzo'
                        break;
                    case '04': mes = 'Abril'
                        break;
                    case '05': mes = 'Mayo'
                        break;
                    case '06': mes = 'Junio'
                        break;
                    case '07': mes = 'Julio'
                        break;
                    case '08': mes = 'Agosto'
                        break;
                    case '09': mes = 'Septiembre'
                        break;
                    case '10': mes = 'Octubre'
                        break;
                    case '11': mes = 'Noviembre'
                        break;
                    case '12': mes = 'Diciembre'
                        break;
                    default: mes = 'no entro';
                }
                fechaText += mes + ' de '+ date[0];

                console.log(fechaText);

                var title = '<h2><a href="/publications/'+feature.geometry.properties.id+'" target="_top" id="name-profile">'+feature.geometry.properties.titulo.toUpperCase()+'</a></h2>';

                var content = '<div class="content-info-marker">'+title +
                        '<p id="autor-activity"><em>Publicado por: </em><a target="_top" href="/autor/'+feature.geometry.properties.email+'"><b>'+feature.geometry.properties.autor+'</b></a> <br>El '+fechaText+'</p><br>' +
                        '<img src="'+url+'"  height="200px" class="main-image-activity img-rounded">' +
                        '<br><div id="description-activity">' +
                        '<p id="description-activity">'+feature.geometry.properties.descripcion+'</p>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-sm-12">' +
                        '<div id="cont-images-activity">';
                var fotos = feature.geometry.properties.fotos;
                var max = 2;
                for(var i=1; i < fotos.length; i++){
                    if(i <= max){
                        content += '<img src="/files/actividades/'+fotos[i].url+'" width="50%" class="img-responsive image-activity img-thumbnail">';
                    }

                }

                content += '</div>' +
                        '</div>' +
                        '</div></div>';

                layer.on('click', function () {
                    if(windowAnt != null){
                        windowAnt.close();
                    }

                    var winOpts = L.control.window(map,{title:'',content:content, visible: true, position:'topRight', maxWidth:500, modal:false})
                    windowAnt = winOpts;
                })

            };


            $.ajax({
                url:   '/v2/tours-register',
                type:  'get',
                beforeSend: function () {
                    console.log("Procesando, espere por favor...");
                },
                success: function (data){

                    var recorridos = JSON.parse(data);
                    console.log("imprimiendo recorridos");
                    console.log(recorridos);
                    var recorridosMap = L.geoJson(recorridos,{
                        onEachFeature: eachTour
                    }).addTo(map);

                },
                error: function(jqXHR, text){
                    console.log(jqXHR);
                    console.log(text);
                }
            });
            var map = L.map('v2-map', {
                center: [6.251098920489721, -75.56791305541992],
                zoom: 12,
                maxZoom: 16,
                minZoom: 3,
                fullscreenControl: true,
                fullscreenControlOptions: {
                    position: 'topleft'
                }
            });
            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'}).addTo(map);

        });
    </script>
    <script src="{{ asset('assets/v2/js/Control.FullScreen.js') }}"></script>
@endsection