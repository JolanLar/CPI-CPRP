$(document).ready(function ()
{
    var i = 0;
    $('.table').each(function(){
        if(i!=0){
            $(this).hide();
        }
        i++;
    });
    
    $(".choixref").change(function() 
    {
        $('.table').each(function(){
            $(this).hide();
        });
        $('#tab'+$(this).val().toLowerCase()).show();
    });
});


