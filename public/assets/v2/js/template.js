$(document).ready(function() {
    var stateMenu = false;
    $('#menu-1').lazeemenu();
    $('#menu-2').lazeemenu();
    //Goto Top
    $('#gototop').click(function(event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: $("body").offset().top
        }, 500);
    });
    //End goto top

    // var es_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
    // if(es_chrome){
    //     alert("Este sitio implementa ciertas funciones que no estan disponibles en tu navegador actual, te sugerimos utilizar Internet explorer o Mozilla firefox.");
    // }

    $("#show-info-map").click(function () {
        if($("#info-map").hasClass('desplegado')){
            $("#info-map").removeClass('desplegado');
        }else{
            $("#info-map").css('padding', '20px');
            $("#info-map").addClass('desplegado');
        }
    });

    $("body").on("click", '#ocult-info-map', function (event) {
        event.preventDefault();
        $("#info-map").css('padding', '0px');
        $("#info-map").removeClass('desplegado');
        $("#info-map").removeClass('bounceInDown');
        $("#info-map").addClass('bounceInLeft');
        
    });

    $("#a-li-1").click(function () {
        $(location).attr('href','/v2');
    });
    $("#a-li-1-1").click(function () {
        $(location).attr('href','/publications');
    });
    $("#a-li-3").click(function () {
        $(location).attr('href','/v2/preguntas-frecuentes');
    });

$("#options-profile").click(function () {
    stateMenu = !stateMenu;
    if(stateMenu){
        $("#options-profile").css('background-color', '#374667');
        $("#ul-options-profile").css('display', 'block');
    }else{
        $("#options-profile").css('background-color', '');
        $("#ul-options-profile").css('display', 'none');
    }

});
    
    $("#logo").click(function () {
        $(location).attr('href','/');
    });


});
