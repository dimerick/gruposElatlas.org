$(document).ready(function () {
    $("a[rel*=leanModal]").leanModal({ top : 50, overlay : 0.4, closeButton: ".modal_close" });
    // $("#icon-search").click(function (event) {
    //     // event.preventDefault();
    //     // $("#div-search").css('visibility', 'visible');
    //     $("#div-search").leanModal({ top : 200, overlay : 0.4, closeButton: ".modal_close" });
    //     // $("#div-search").dialog();
    // });

    // $("#exit-search").click(function (event) {
    //     event.preventDefault();
    //     $("#div-search").css('visibility', 'hidden');
    //
    // });
    $("#inputSearch").keyup(function () {
        var value = $(this).val();
        if (value != "") {
            var url = "/searchAjax/" + value;
            $.ajax({
                url: url,
                type: 'get',
                beforeSend: function () {
                    console.log("Procesando, espere por favor...");
                    $("#icon-state").html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
                },
                success: function (data) {
                    $("#icon-state").html('<i class="fa fa-search" aria-hidden="true"></i>');
                    console.log(data);
                    var num = 0;
                    var content = "<table class='table'>";
                    if (data.length > 0) {
                        for (var i = 0; i < data.length; i++) {
                            content += '<tr class="tr-search" id="' + data[i].email + '"><td class="foto-search"><img width="6%" src="/files/fotos_perfil/' + data[i].foto + '"></td><td><b>' + data[i].nombre + '</b></td></tr>'
                            num++;
                        }
                        content += '</table>';
                        console.log(content);
                        $("#result-search").html(content);
                    } else {
                        $("#result-search").html("<b>La busqueda no arrojo resultados</b>");
                    }

                },
                error: function (jqXHR, text) {
                    console.log(jqXHR);
                    console.log(text);
                }
            });
        } else {
            $("#result-search").html("");
        }

    });

    $('body').on("click", 'tr.tr-search', function (event) {
        var email = $(this).attr('id');
        url = '/autor/' + email;
        $(location).attr("href", url);
    });

    $("#search-category").click(function (event) {
        var categories = "";
        var state;
        $(".group-cat").each(function (index) {
            state = $(this).prop('checked');
            if (state) {
                categories += $(this).attr('value') + ';';
            }
        })
        if(categories != ""){
            $("#error-search-category").html("");
            var url = "/searchCategories/" + categories;
            $.ajax({
                url: url,
                type: 'get',
                beforeSend: function () {
                    console.log("Procesando, espere por favor...");
                    $("#search-category").html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
                },
                success: function (data) {
                    $("#search-category").html('Buscar por categoria');
                    $("#icon-state").html('<i class="fa fa-search" aria-hidden="true"></i>');
                    var numResult = 0;
                    var groupsxcat;
                    var content = '<section id="show-groups">';
                    var descripcion, url, nombre, email;
                    for (var i = 0; i < data.length; i++) {
                        groupsxcat = data[i].length
                        numResult += groupsxcat;
                        if(groupsxcat != 0){
                            var catActual = data[i][0].nomcat;
                            content += '<div class="panel panel-default"><div class="panel-body"><div class="well well-sm well-cat"><div id=title-category><img src="/assets/v2/images/categories/'+data[i][0].icon+'"><h3>' + catActual + '</h3><p>'+groupsxcat+' grupos registrados</p></div></div>';
                            for (var j = 0; j < data[i].length; j++) {
                                descripcion = data[i][j].descripcion;
                                descripcion = descripcion.substring(0, 41);
                                url = data[i][j].foto;
                                nombre = data[i][j].nombre;
                                email = data[i][j].email;
                                content += '<div class="col-sm-4"><div class="thumbnail"><img src="/files/fotos_perfil/'+url+'">' +
                                    '<div class="caption"><h3>'+nombre+'</h3><p>'+descripcion+'...</p><p><a href="/autor/'+email+'" class="btn btn-primary" role="button">Ver mas</a></p></div></div></div>';


                            }
                            content += '</div></div>';
                        }
                    }
                    content += '</section>';
                    if(numResult == 0){
                        content = '<div class="alert alert-info">La consulta no arrojo resultados</div>';
                    }

                        $("#main-content").html(content);

                },
                error: function (jqXHR, text) {
                    console.log(jqXHR);
                    console.log(text);
                }
            });
        }else{
            $("#error-search-category").html(" Selecciona una o varias categorias");
        }
        // $("#div-search").css('visibility', 'hidden');
        $(".modal_close").click();
    });

    $("#show-all-groups").click(function (event) {
        event.preventDefault();
        $.ajax({
            url: '/allGroupsAjax',
            type: 'get',
            beforeSend: function () {
                console.log("Procesando, espere por favor...");
            },
            success: function (data) {
                console.log(data);
                var content = '<section id="show-groups">';
                var num = data.length;
                if(num > 0){
content += '<div class="row"><div class="col-sm-12"><b>'+num + ' grupos registrados</b><hr></div> </div>';
                    var descripcion;
                    for(var i= 0; i < data.length; i++){
                        descripcion = data[i].descripcion.substring(0, 41);
                        content += '<div class="row"><div class="col-sm-12"> <div class="panel panel-default"><div class="panel-body">' +
                            '<div class="col-sm-4"><img width="100%" src="/files/fotos_perfil/'+data[i].foto+'" alt="">' +
                            '</div><div class="col-sm-8"><h3>'+data[i].nombre+'</h3>' +
                            '<p>'+descripcion+'...</p>' +
                            '<p><a href="/autor/'+data[i].email+'" target="_blank" class="btn btn-primary" role="button">Ver mas</a></p></div></div></div></div></div></section>';
                    }

                }else{
                    content = '<div class="alert alert-info">La consulta no arrojo resultados</div></section>';
                }
                $("#main-content").html(content);
                // $("#div-search").css('visibility', 'hidden');
                $(".modal_close").click();
            },
            error: function (jqXHR, text) {
                console.log(jqXHR);
                console.log(text);
            }
        });

    });
    $.ajax({
        url: '/categories',
        type: 'get',
        beforeSend: function () {
            console.log("Procesando, espere por favor...");
        },
        success: function (data) {
            console.log(data);
            var categories = "";
            var num = 0;
            if (data.length > 0) {
                for (var i = 0; i < data.length; i++) {
                    if (num == 5) {
                        categories += '</br>';
                        num = 0;
                    }
                    categories += '<span class="cont-checkbox-categorie"><input type="checkbox" class="group-cat" value="' + data[i].id + '">' + ' ' + data[i].nombre + '</span>';
                    num++;
                }
                categories += '</br>';
                $("#groups-categories").html(categories);
            }
        },
        error: function (jqXHR, text) {
            console.log(jqXHR);
            console.log(text);
        }
    });
    $("#check-all-cat").click(function () {
        if ($(this).prop('checked')) {
            $(".group-cat").prop('checked', true)
        } else {
            $(".group-cat").prop('checked', false)
        }
    });
});