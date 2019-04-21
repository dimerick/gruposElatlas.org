$('document').ready(function(){
    $("#remove").click(function(e){

      var val = confirm("Realmente desea eliminar este reporte");
        if(!val){
            e.preventDefault();
        }
    })


});
