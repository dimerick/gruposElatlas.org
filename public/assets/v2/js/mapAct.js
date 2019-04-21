$(document).ready(function(){
    var windowAnt = null;
    var height = $(window).height();
    $("#v2-map").css('height', height/1.2);

    function eachActivity(feature, layer){
        console.log("imprimiendo feature");
        var urlIcon = feature.geometry.properties.icon;
        var myIcon = L.icon({
            iconUrl: '/assets/v2/images/categories/'+urlIcon,
            iconSize: [40, 40],
            iconAnchor: [22, 10]
        });
        feature.geometry.properties.fecha
        layer.setIcon(myIcon);
        layer.defaultOptions.riseOnHover = true;
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
        url:   '/v2/activities-register',
        type:  'get',
        beforeSend: function () {
            console.log("Procesando, espere por favor...");
        },
        success: function (data){
            console.log("imprimiendo actividades");
            var activities = JSON.parse(data);

            console.log(activities);

            var activitiesMap = L.geoJson(activities,{
                onEachFeature: eachActivity
            });
            var markers = L.markerClusterGroup();
            markers.addLayer(activitiesMap);
            map.addLayer(markers);

        },
        error: function(jqXHR, text){
            console.log(jqXHR);
            console.log(text);
        }
    });
    var map = L.map('v2-map', {
        center: [4.96871620165794, -73.93611395955086],
        zoom: 5,
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