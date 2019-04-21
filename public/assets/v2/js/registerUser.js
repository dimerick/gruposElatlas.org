$('document').ready(function(){
var height = $(window).height();
    $("#register-map").css('height', height/2);

    var lastCheck = null;
    function inicializarMap(latitud, longitud){
        if(latitud != null && longitud != null){
            $('#latitud').val(latitud);
            $('#longitud').val(longitud);
        }else{
            latitud = 6.25304;
            longitud = -75.56457;
        }
        var myIcon = L.icon({
            iconUrl: '/assets/v4/images/icon.png',
            iconSize: [35, 35],
            iconAnchor: [22, 10]
        });

        var map = L.map('register-map', {
            center: [latitud, longitud],
            zoom: 12,
            fullscreenControl: true,
            fullscreenControlOptions: {
                position: 'topleft'
            }
        });
        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'}).addTo(map);

        var punto = L.marker([latitud, longitud], {
            icon: myIcon
        }).addTo(map);

        map.on('contextmenu', function(e) {
            console.log(e.latlng);
            punto.setLatLng(e.latlng);
            var latLng = punto.getLatLng();
            var lat = latLng.lat;
            var long = latLng.lng;
            console.log(lat);
            console.log(long);
            $('#latitud').val(lat);
            $('#longitud').val(long);
        });

        map.on('click', function(e) {
            console.log(e.latlng);
            punto.setLatLng(e.latlng);
            var latLng = punto.getLatLng();
            var lat = latLng.lat;
            var long = latLng.lng;
            console.log(lat);
            console.log(long);
            $('#latitud').val(lat);
            $('#longitud').val(long);
        });
    }

    function getPosition(position){
        var lat = position.coords.latitude;
        var long = position.coords.longitude;
        inicializarMap(lat, long);
    }
    function error(msg){
        var lat = null;
        var long = null;
        $.ajax({
            url:   'https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyAsXhk_RpcpReEa1opVGaj0k_PZS19C7Y4',
            type:  'POST',
            beforeSend: function () {
                console.log("Procesando, espere por favor...");
            },
            success: function (data){
                console.log(data);
                lat = data.location.lat;
                long = data.location.lng;
                inicializarMap(lat, long);

            },
            error: function(jqXHR, text){
                alert("Se podrujo un error al obtener la ubicacion, deberas establecerla manualmente en el mapa.");
                console.log(jqXHR);
                console.log(text);
            }
        });

    }

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(getPosition, error);
    }else{
        error('not supported');
    }

    function comprobarCampos(){
        valido = true;
        if($('#latitud').val() == "" && $('#longitud').val() == ""){
            valido = false;
        }
        return valido;
    }

    // function comprobarCategories() {
    //     var num = 0;
    //     valido = true;
    //
    //     $(".check-category").each(function (index)
    //     {
    //        if($(this).prop('checked')){
    //            num++;
    //        }
    //     });
    //     if(num == 0){
    //         valido = false;
    //     }
    //     return valido;
    // }

    $("#submit").click(function (event) {
        var state = comprobarCampos();
        if(!state){
            alert('Arrastra el icono en el mapa para establecer tu ubicacion');
            event.preventDefault();
        }
        // var stateCategory = comprobarCategories();
        // if(!stateCategory){
        //     alert('Debes seleccionar al menos una categoria');
        //     event.preventDefault();
        // }
    });
    $("#cat-prin").change(function () {
        var id = '#cat-sec-'+$(this).val();
        $(id).css('display', 'none');
        if(lastCheck != null){
            lastCheck.css('display', 'inline-block');
        }
        lastCheck = $(id);

    });
});