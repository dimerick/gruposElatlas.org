$(document).ready(function(){
  var windowAnt = null;
  var height = $(window).height();
  $("#main-content").css('height', height);
  var numRequestData = 0;
  var controlSearchIniatilized;
  var globalGruposMap;
  var globalMarkersMap;
  var globalSearchControl;


  function loadCategories() {
    $.ajax({
      url:   '/v2/categories',
      type:  'get',
      beforeSend: function () {
        console.log("Cargando categorias, espere por favor...");
      },
      success: function (data){
        dataJson = JSON.parse(data);
        $("#categories").append('<span><input type="checkbox" class="check-cat" id="check-all"><label for="check-all">Ver todas</label></span>');
        $.each(dataJson, function (i, v) {
          id = v.id;
          name = v.nombre;
          icon = v.icon;
          $("#categories").append('<span><input type="checkbox" class="check-cat" id="'+id+'"><label for="'+name.replace(" ", "_")+'">'+name +'</label></span>');

          $(".check-cat").prop('checked', true);

          var categories = activeCategories();
          getData(categories);
        })

      },
      error: function(jqXHR, text){
        console.log(jqXHR);
        console.log(text);
      }
    });
  }

  function activeCategories() {
    var catChecked = [];
    var inputs = $(".check-cat").filter(":checked");
    $.each(inputs, function (index, value) {
      if(value.id != "check-all"){
        catChecked.push(value.id);
      }
    });
    return catChecked;
  }




  //funcion encargada de obtener los grupos registrados
  function getData(categories) {
    if(categories.length > 0){
      var param;
      param = categories.toString();
      $.ajax({
        url:   '/v2/groups-register-categories/'+param,
        type:  'get',
        beforeSend: function () {
          console.log("Procesando, espere por favor...");
        },
        success: function (data, textStatus, jqXHR){
          dataJson = JSON.parse(data);
          numRequestData++;
          console.log("numRequestData", numRequestData);

          for(var i=0;i<=50;i++){
            $("#progress-bar").attr("style", "width:"+ i+"%");
          }
          if(numRequestData > 0){
            if(map.hasLayer(globalGruposMap)){
              map.removeLayer(globalGruposMap);
            }
            if(map.hasLayer(globalMarkersMap)){
              map.removeLayer(globalMarkersMap);
            }
            if(map.hasLayer(globalSearchControl)){
              map.removeLayer(globalSearchControl);

            }
          }

          var gruposMap = L.geoJson(dataJson,{
            onEachFeature: eachGroups
          });

          globalGruposMap = gruposMap;

          var markers = L.markerClusterGroup();
          markers.addLayer(gruposMap);
          map.addLayer(markers);

          globalMarkersMap = markers;

          setTimeout(function(){
            if(!controlSearchIniatilized){
              // codigo para implementar la barra de busqueda
              globalSearchControl = new L.Control.Search({
                layer: globalMarkersMap,
                propertyName: 'nombre',
                marker: false,
                moveToLocation: function(latlng, title, map) {
                  var zoom = map.getBoundsZoom(L.latLngBounds([latlng,latlng]));
                  console.log(zoom);
                  map.setView(latlng, zoom); // access the zoom
                }
              });

              globalSearchControl.on('search:locationfound', function(e){
                map.addLayer(e.layer);
                if(e.layer._popup)
                  e.layer.openPopup();
                e.layer.on('popupclose', function (a) {
                  // map.removeLayer(e.layer);
                  globalMarkersMap.refreshClusters();

                });

              }).on('search:collapsed', function(e) {
                globalMarkersMap.refreshClusters();
              });
              map.addControl(globalSearchControl);  //inizialize search control
              controlSearchIniatilized = true;
              for(var i=51;i<=100;i++){
                $("#progress-bar").attr("style", "width:"+ i+"%");
              }
            }


          }, 3300);

        },
        error: function(jqXHR, text){
          console.log(jqXHR);
          console.log(text);
        },
        complete: function () {


        }
      });
    }else{
      if(map.hasLayer(globalGruposMap)){
        map.removeLayer(globalGruposMap);
      }
      if(map.hasLayer(globalMarkersMap)){
        map.removeLayer(globalMarkersMap);
      }
    }

  }


    function eachGroups(feature, layer){
    if(layer != null){

        var urlIcon = 'assets/v4/images/categories/icon-otra.svg';
        var lat = feature.geometry.coordinates[0];
        var long = feature.geometry.coordinates[1];
        var title = '<h3>'+feature.geometry.properties.nombre.toUpperCase()+'</h3>';
        var content = '<div class="content-info-marker">' + title +
            '<ul class="data-group">' +
            '<li title="Numero de integrantes"> <i class="fa fa-group"> </i> <span id="num-int-group">'+' '+feature.geometry.properties.num_int+'</span></li>' +
            '<li title="Ubicacion"> <i class="fa fa-globe"> </i><span id="city-group">'+' '+feature.geometry.properties.ciudad+'</span> </li>' +
            '<li title="Correo electronico"> <i class="fa fa-envelope-o"> </i><span id="email-group">'+' '+feature.geometry.properties.email+'</span> </li>' +
            '</ul>'+
        '<ul class="categories-group">';

        var categories = feature.geometry.properties.categorias;
        for(var i=0; i < categories.length; i++){
            if(categories[i].tipo == 1){
                urlIcon = 'images/categories/'+categories[i].icon;
            }
            content += '<li title="'+categories[i].nombre+'"><img src="assets/v4/images/categories/'+categories[i].icon+'"></li>';
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
        '<hr><div class="description-group">' +
        '<p title="Descripcion grupo">'+feature.geometry.properties.descripcion+'</p>' +
        '</div></div>';

        layer.bindPopup(content, {maxWidth:300, minWidth: 200, maxHeight:300})
    }
    };

//providers
//   var providers = {};
layers = [];


  openStreet = {
    title: 'Osm',
    icon: 'assets/v4/images/icons/openstreetmap_mapnik.png',
    layer: L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'})
  };
  layers.push(openStreet);
  esriWorldImagery = {
    title: 'World Imagery',
    icon: 'assets/v4/images/icons/esri_worldterrain.png',
    layer: L.tileLayer('http://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
      attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
    })
  };
  layers.push(esriWorldImagery);
  // var openStreet = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
  //   attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'});

  // var openStreetMapHOT = L.tileLayer('http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
  //   maxZoom: 19,
  //   attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>, Tiles courtesy of <a href="http://hot.openstreetmap.org/" target="_blank">Humanitarian OpenStreetMap Team</a>'
  // });

  // var esriWorldImagery = L.tileLayer('http://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
  //   attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
  // });

  // var esriWorldStreetMap = L.tileLayer('http://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', {
  //   attribution: 'Tiles &copy; Esri &mdash; Source: Esri, DeLorme, NAVTEQ, USGS, Intermap, iPC, NRCAN, Esri Japan, METI, Esri China (Hong Kong), Esri (Thailand), TomTom, 2012'
  // });
  //
  //
  // var thunderforestTransportDark = L.tileLayer('http://{s}.tile.thunderforest.com/transport-dark/{z}/{x}/{y}.png?apikey=016cef82fca146f2a068c31ae2b17d12', {
  //   attribution: '&copy; <a href="http://www.thunderforest.com/">Thunderforest</a>, &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
  //   maxZoom: 22,
  //   apikey: '<your apikey>'
  // });
  //
  // var cartoDBDarkMatter = L.tileLayer('http://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}.png', {
  //   attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> &copy; <a href="http://cartodb.com/attributions">CartoDB</a>',
  //   subdomains: 'abcd',
  //   maxZoom: 19
  // });
  //
  //
  // var openStreetMapBlackAndWhite = L.tileLayer('http://{s}.tiles.wmflabs.org/bw-mapnik/{z}/{x}/{y}.png', {
  //   maxZoom: 18,
  //   attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
  // });
  //
  // var NASAGIBS_ViirsEarthAtNight2012 = L.tileLayer('http://map1.vis.earthdata.nasa.gov/wmts-webmerc/VIIRS_CityLights_2012/default/{time}/{tilematrixset}{maxZoom}/{z}/{y}/{x}.{format}', {
  //   attribution: 'Imagery provided by services from the Global Imagery Browse Services (GIBS), operated by the NASA/GSFC/Earth Science Data and Information System (<a href="https://earthdata.nasa.gov">ESDIS</a>) with funding provided by NASA/HQ.',
  //   bounds: [[-85.0511287776, -179.999999975], [85.0511287776, 179.999999975]],
  //   minZoom: 1,
  //   maxZoom: 8,
  //   format: 'jpg',
  //   time: '',
  //   tilematrixset: 'GoogleMapsCompatible_Level'
  // });
L.control.iconL
    var map = L.map('map', {
        center: [4.96871620165794, -73.93611395955086],
        zoom: 3,
        maxZoom: 18,
        minZoom: 3,
        // layers: [openStreet, esriWorldImagery],
        zoomControl: false,
    });



// añado un logo al mapa

  var logo = L.Control.extend({
    options: {
      position: 'topright'
    },

    onAdd: function (map) {
      // create the control container with a particular class name
      var container = L.DomUtil.create('div', 'logo');

      container.innerHTML =
        '<img id=logo src="assets/v4/images/logo.png">';
      return container;
    }
  });

  map.addControl(new logo());

    var controlMap = L.Control.extend({
        options: {
            position: 'topleft'
        },

        onAdd: function (map) {
            // create the control container with a particular class name
            var container = L.DomUtil.create('div', 'control-map-categories');

            container.innerHTML = '<div id="control-map"> ' +
              '<div id="categories"></div> ' +
              '</div>';
            return container;
        }
    });

  map.addControl(new controlMap());




//funcion encargada de cargar las categorias seleccionadas
   loadCategories();



  $("body").on("click", ".check-cat", function (e) {
    if($(this).attr("id") == "check-all"){
      if($(this).prop('checked')){
        $(".check-cat").prop('checked', true);
      }else{
        $(".check-cat").prop('checked', false);
      }
    }else{
      $("#check-all").prop('checked', false);
    }
    var categories = activeCategories();
      getData(categories);
  });


    // controles para reducir y aumentar el zoom del mapa


    $("#lessZoom").click(function () {
        console.log("Has dado click");
        map.zoomOut();

    });
    $("#moreZoom").click(function () {
        console.log("Has dado click");
        map.zoomIn();
    });




  // var baseMaps = {
  //   "OpenStreetMap": openStreet,
  //   // "OpenStreetMap.HOT": openStreetMapHOT,
  //   "Esri.WorldImagery": esriWorldImagery
  //   // "Esri.WorldStreetMap": esriWorldStreetMap,
  //   // "Thunderforest.TransportDark": thunderforestTransportDark,
  //   // "CartoDB.DarkMatter": cartoDBDarkMatter,
  //   // "OpenStreetMap.BlackAndWhite": openStreetMapBlackAndWhite,
  //   // "NASAGIBS.ViirsEarthAtNight2012": NASAGIBS_ViirsEarthAtNight2012
  // };

  // L.control.layers(baseMaps).addTo(map);

  L.control.iconLayers(layers).addTo(map);

  //Codigo Modals
  //Modal para mostrar informacion sobre el programa
    var info = $("#info-el-atlas").html();
    console.log(info);
    L.DomEvent
        .on(document.querySelector('.open-modal-custom'), 'click', function() {
            map.fire('modal', {
                title: '',
                content: info,
                template: ['<div class="modal-header"><h2>{title}</h2></div>',
                    '<hr>',
                    '<div class="modal-body">{content}</div>'
                    // '<div class="modal-footer">',
                    // '<button class="topcoat-button--large {OK_CLS}">{okText}</button>',
                    // '<button class="topcoat-button--large {CANCEL_CLS}">{cancelText}</button>',
                    // '</div>'
                ].join(''),

                okText: 'Ok',
                cancelText: 'Cancel',
                OK_CLS: 'modal-ok',
                CANCEL_CLS: 'modal-cancel',

                //width: 600,

                // onShow: function(evt) {
                //     var modal = evt.modal;
                //     L.DomEvent
                //         .on(modal._container.querySelector('.modal-ok'), 'click', function() {
                //             // alert('you pressed ok');
                //             modal.hide();
                //         })
                //         .on(modal._container.querySelector('.modal-cancel'), 'click', function() {
                //             // alert('You pressed cancel');
                //             modal.hide();
                //         });
                // }
            });
        });

$("#label-show-categories").click(function () {
    // console.log("has dado clic en el label");
    value = !$("#input-show-categories").prop("checked");
    $("#input-show-categories").prop("checked", value);
    if(value){
        $("#categories").css("display", "block");
        $("#label-show-categories").css("color", "#ffc840");
    }else{
        $("#categories").css("display", "none");
        $("#label-show-categories").css("color", "#fff");
    }

});

});
