$(document).ready(function(){
    var height = $(window).height();
    $("#v2-map").css('height', height/2);
var id = $("#id-group").val();

    function eachActivity(feature, layer){
        console.log("imprimiendo feature");
        var urlIcon = feature.geometry.properties.icon;
        var myIcon = L.icon({
            iconUrl: '/assets/v2/images/categories/'+urlIcon,
            iconSize: [40, 40],
            iconAnchor: [22, 10]
        });
        feature.geometry.properties.fecha;
        layer.setIcon(myIcon);
    
        var fotos = feature.geometry.properties.fotos;
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
    
    
    
        var content = '<div id="info-map" class="plegable animated bounceInDown"><a href="#" id="ocult-info-map" class="pull-right"> <i class="fa fa-close fa-2x"></i></a>' +
            '<hr>' +
            '<a href="'+url+'" data-lightbox="'+feature.geometry.properties.titulo+'" data-title="'+feature.geometry.properties.titulo.toUpperCase()+'"><img src="'+url+'"  width="80%" class="img-responsive main-image-activity img-rounded"></a>' +
        '<a href="/publications/'+feature.geometry.properties.id+'"><h3>'+feature.geometry.properties.titulo.toUpperCase()+'</h3></a>' +
        '<p id="autor-activity"><em>Publicado por: </em><a target="_blank" href="/autor/'+feature.geometry.properties.email+'"><b>'+feature.geometry.properties.autor+'</b></a> el '+fechaText+'</p>' +
        '<div id="description-activity">' +
        '<p id="description-activity">'+feature.geometry.properties.descripcion+'</p>' +
        '</div>' +
        '<div class="row">' +
        '<div class="col-sm-12"><hr>' +
        '<div id="cont-images-activity">';
    
        var fotos = feature.geometry.properties.fotos;
        var max = 2;
        for(var i=1; i < fotos.length; i++){
            if(i <= max){
                content += '<a href="/files/actividades/'+fotos[i].url+'" data-lightbox="'+feature.geometry.properties.titulo+'" data-title="'+feature.geometry.properties.titulo+'"><img src="/files/actividades/'+fotos[i].url+'" width="50%" class="img-responsive image-activity img-thumbnail"></a>';
            }
    
        }
    
        content += '</div>' +
        '</div>' +
        '</div></div>';
    
        layer.on('click', function () {
    
            $("#info-map").remove();
            $("#v2-map").append(content);
            $("#info-map").css('padding', '20px');
            $("#info-map").addClass('desplegado');
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
            }).addTo(map);
    
        },
        error: function(jqXHR, text){
            console.log(jqXHR);
            console.log(text);
        }
    });
    var map = L.map('v2-map', {
        center: [4.96871620165794, -73.93611395955086],
        zoom: 5,
        fullscreenControl: true,
        fullscreenControlOptions: {
            position: 'topleft'
        }
    });
    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'}).addTo(map);

});