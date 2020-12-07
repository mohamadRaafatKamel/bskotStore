$(document).ready(function(){
    $("#plusBtn").click(function(){
        var number = parseInt($("#numbrt").val());
        $("#numbrt").val(number + 1);
    });

    $("#minusBtn").click(function(){
        var number = parseInt($("#numbrt").val());
        if(number != 1){
            $("#numbrt").val(number - 1);
        }
    });

});
