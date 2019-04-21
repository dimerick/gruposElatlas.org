$('document').ready(function(){
    var id = '#cat-sec-'+$("#cat-prin").val();
    var lastCheck = $(id);
    $("[class='check-category'][value="+$("#cat-prin").val()+"]" ).prop('checked', false);//desactivo la categoria secundaria que coincide con la principal
    $(id).css('display', 'none');



    $("#cat-prin").change(function () {
        var id = '#cat-sec-'+$(this).val();
        $("[class='check-category'][value="+$("#cat-prin").val()+"]" ).prop('checked', false);//desactivo la categoria secundaria que coincide con la principal
        $(id).css('display', 'none');
        if(lastCheck != null){
            lastCheck.css('display', 'inline-block');
        }
        lastCheck = $(id);

    });
});