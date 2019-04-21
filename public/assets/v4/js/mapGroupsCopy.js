$(document).ready(function(){
  var windowAnt = null;
  var height = $(window).height();
  $("#map").css('height', height);


  //funcion encargada de obtener los grupos registrados
  function getData() {

  }
  $.ajax({
    url:   'http://www.elatlas.org/v2/groups-register',
    type:  'get',
    beforeSend: function () {
      console.log("Procesando, espere por favor...");
    },
    success: function (data){
      // console.log("imprimiendo grupos");
      var grupos = JSON.parse(data);

      function category(name, icon) {
        this.name = name;
        this.icon = icon;
      }

      var categories = [];
      var nameCategories = [];
      $("#categories").append('<input type="checkbox" class="check-cat" id="check-all"><label for="check-all">Ver todas</label>');
      grupos.features.forEach(function (item, index) {
        item.geometry.properties.categorias.forEach(function (item2, index2) {
         name = item2.nombre;
         icon = item2.icon;
         if(nameCategories.indexOf(name) == -1){
            nameCategories.push(name);
            $("#categories").append('<input type="checkbox" class="check-cat" title="'+name+'"id="'+name.replace(" ", "_")+'"><label for="'+name.replace(" ", "_")+'">'+name +'</label>');
           categories.push(new category(name, icon));
         }

        });
      });

      $(".check-cat").prop('checked', true);
      var gruposMap = L.geoJson(grupos,{
        onEachFeature: eachGroups
      });


      var markers = L.markerClusterGroup();
      markers.addLayer(gruposMap);
      map.addLayer(markers);


      $(".check-cat").click(function (e) {
        map.removeLayer(gruposMap);
        map.removeLayer(markers);

        if($(this).attr("id") == "check-all"){
          if($(this).prop('checked')){
            $(".check-cat").prop('checked', true);
            map.addLayer(markers);
          }else{
            $(".check-cat").prop('checked', false);
          }
        }else{
          $("#check-all").prop('checked', false);
          var catChecked = [];
          var inputs = $(".check-cat").filter(":checked");
          $.each(inputs, function (index, value) {
            catChecked.push(value.title);
          });
          console.log(catChecked.toString());
        }
      });

      console.log("categories", categories);

      // codigo para implementar la barra de busqueda

      var searchControl = new L.Control.Search({
        layer: markers,
        propertyName: 'nombre',
        marker: false,
        moveToLocation: function(latlng, title, map) {
          var zoom = map.getBoundsZoom(L.latLngBounds([latlng,latlng]));
          console.log(zoom);
          map.setView(latlng, zoom); // access the zoom
        }
      });

      searchControl.on('search:locationfound', function(e){
        map.addLayer(e.layer);
        if(e.layer._popup)
          e.layer.openPopup();
        e.layer.on('popupclose', function (a) {
          markers.refreshClusters();
        });

      }).on('search:collapsed', function(e) {

      });
      map.addControl( searchControl );  //inizialize search control



    },
    error: function(jqXHR, text){
      console.log(jqXHR);
      console.log(text);
    }
  });




    function eachGroups(feature, layer){
        // console.log("imprimiendo layer");
        // console.log(layer);
        var urlIcon = 'images/categories/icon-otra.svg';
        // console.log("Datos feature");
        var lat = feature.geometry.coordinates[0];
        var long = feature.geometry.coordinates[1];
        // console.log(lat);
        // console.log(long);
        // console.log(feature.geometry.properties.nombre);
        var title = '<h4>'+feature.geometry.properties.nombre.toUpperCase()+'</h4>';
        var content = '<div class="content-info-marker">' + title +
            '<ul id="data-group">' +
            '<li title="Numero de integrantes"> <i class="fa fa-group"> </i> <span id="num-int-group">'+' '+feature.geometry.properties.num_int+'</span></li>' +
            '<li title="Ubicacion"> <i class="fa fa-globe"> </i><span id="city-group">'+' '+feature.geometry.properties.ciudad+'</span> </li>' +
            '<li title="Correo electronico"> <i class="fa fa-envelope-o"> </i><span id="email-group">'+' '+feature.geometry.properties.email+'</span> </li>' +
            '</ul>'+
        '<ul id="categories-group">';

        var categories = feature.geometry.properties.categorias;
        for(var i=0; i < categories.length; i++){
            if(categories[i].tipo == 1){
                urlIcon = 'images/categories/'+categories[i].icon;
            }
            content += '<li title="'+categories[i].nombre+'"><img src="images/categories/'+categories[i].icon+'"></li>';
            // console.log(categories[i].nombre);
        }
        var myIcon = L.icon({
            iconUrl: urlIcon,
            iconSize: [40, 40],
            iconAnchor: [22, 10]
        });
        layer.setIcon(myIcon);
        // layer.defaultOptions.riseOnHover = true;
        content += '</ul>' +
        '<hr><div id="description-group">' +
        '<p title="Descripcion grupo">'+feature.geometry.properties.descripcion+'</p>' +
        '</div></div>';

        layer.bindPopup(content, {maxWidth:300, minWidth: 200, maxHeight:300})

    };



    var map = L.map('map', {
        center: [4.96871620165794, -73.93611395955086],
        zoom: 5,
        maxZoom: 16,
        minZoom: 3,
        zoomControl: false,
        fullscreenControlOptions: {
            position: 'topleft'
        }
    });

// añado un logo al mapa
    var logo = L.Control.extend({
        options: {
            position: 'topleft'
        },

        onAdd: function (map) {
            // create the control container with a particular class name
            var container = L.DomUtil.create('div', 'logo');

            container.innerHTML = '<img src="images/logo.png">';

            return container;
        }
    });

    map.addControl(new logo());



    // controles para reducir y aumentar el zoom del mapa


    $("#lessZoom").click(function () {
        console.log("Has dado click");
        map.zoomOut();

    });
    $("#moreZoom").click(function () {
        console.log("Has dado click");
        map.zoomIn();
    });


    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'}).addTo(map);

});
