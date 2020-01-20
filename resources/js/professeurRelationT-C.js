$(document).ready(function ()
{
    $("#tabcprp").hide();
    $("#tableaurcsCPRP").hide();
    
    $(".choixref").change(function() 
    {
        if($(this).val()=='cpi')
        {
            $("#tabcpi").show();
            $("#tableaurcsCPI").show();
            
            $("#tableaurcsCPRP").hide();
            $("#tabcprp").hide();
            
        }
        else if($(this).val()=='cprp')
        {
            $("#tabcprp").show();
            $("#tableaurcsCPRP").show();
            
            $("#tableaurcsCPI").hide();
            $("#tabcpi").hide();
            
        }
    });
});


