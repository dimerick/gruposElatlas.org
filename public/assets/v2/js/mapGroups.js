$(document).ready(function(){
    var windowAnt = null;
    var height = $(window).height();
    $("#v2-map").css('height', height/1.2);
    function eachGroups(feature, layer){

        console.log("imprimiendo layer");
        console.log(layer);
        var urlIcon = '/assets/v2/images/categories/icon-otra.svg';
        console.log("Datos feature");
        var lat = feature.geometry.coordinates[0];
        var long = feature.geometry.coordinates[1];
        console.log(lat);
        console.log(long);
        console.log(feature.geometry.properties.nombre);
        var title = '<h2><a href="/autor/'+feature.geometry.properties.email+'" target="_top" id="name-profile">'+feature.geometry.properties.nombre.toUpperCase()+'</a></h2><br>';
        var content = '<div class="content-info-marker">' + title + '<img src="/files/fotos_perfil/'+feature.geometry.properties.foto+'" height="200px"" class="img-rounded image-profile"><br>' +
        '<div id="categories-group">'+
        '<ul>';

        var categories = feature.geometry.properties.categorias;
        for(var i=0; i < categories.length; i++){
            if(categories[i].tipo == 1){
                urlIcon = '/assets/v2/images/categories/'+categories[i].icon;
            }
            content += '<li title="'+categories[i].nombre+'"><img src="/assets/v2/images/categories/'+categories[i].icon+'"></li>';
            console.log(categories[i].nombre);
        }
        var myIcon = L.icon({
            iconUrl: urlIcon,
            iconSize: [40, 40],
            iconAnchor: [22, 10]
        });
        layer.setIcon(myIcon);
        // layer.defaultOptions.riseOnHover = true;
        content += '</ul>' +
        '</div>' +
            '<ul id="data-group">' +
            '<li title="Numero de integrantes"> <i class="fa fa-group"> </i> <span id="num-int-group">'+' '+feature.geometry.properties.num_int+'</span></li>' +
            '<li title="Ubicacion"> <i class="fa fa-globe"> </i><span id="city-group">'+' '+feature.geometry.properties.ciudad+'</span> </li>' +
            '<li title="Correo electronico"> <i class="fa fa-envelope-o"> </i><span id="email-group">'+' '+feature.geometry.properties.email+'</span> </li>' +
            '</ul>'+
        '<hr><div id="description-group">' +
        '<p title="Descripcion grupo">'+feature.geometry.properties.descripcion+'</p>' +
        '</div></div>';


        layer.on('click', function () {
            if(windowAnt != null){
                windowAnt.close();
            }
            var winOpts = L.control.window(map,{title:'',content:content,visible: true, position:'topRight', maxWidth:500, modal:false})
            windowAnt = winOpts;
        })

    };
    

    $.ajax({
        url:   '/v2/groups-register',
        type:  'get',
        beforeSend: function () {
            console.log("Procesando, espere por favor...");
        },
        success: function (data){
            console.log("imprimiendo grupos");
            var grupos = JSON.parse(data);
            console.log(grupos);
            var gruposMap = L.geoJson(grupos,{
                onEachFeature: eachGroups
            });
            var markers = L.markerClusterGroup();
            markers.addLayer(gruposMap);
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

