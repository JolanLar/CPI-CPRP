$(document).ready(function (){
    var i = $("#numcomp").val();
    $("#plus").click(function() {
       i++;
       $("#numcomp").val(i);
    });
    
    
    $("#moins").click(function() {
        if(i>1)
        {
           i--;
           $("#numcomp").val(i);
        }
    });
});


