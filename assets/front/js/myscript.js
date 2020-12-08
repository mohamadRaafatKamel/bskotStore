$(document).ready(function(){
    $("#plusBtn").click(function(){
        var number = parseInt($("#proamount").val());
        $("#proamount").val(number + 1);
        $("#numbr").html(number + 1);
        $("#orderbtn").val("Add to Order . KWD " +parseInt($("#price").val())*(number + 1));
    });

    $("#minusBtn").click(function(){
        var number = parseInt($("#proamount").val());
        if(number != 1){
            $("#proamount").val(number - 1);
            $("#numbr").html(number - 1);
            $("#orderbtn").val("Add to Order . KWD " +parseInt($("#price").val())*(number - 1));
        }
    });

});
