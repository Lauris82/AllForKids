$(document).ready(function(){
    $("#nom").hide();

    $("#roles").onchange(function(){
        $("#nom").show();
    });


});