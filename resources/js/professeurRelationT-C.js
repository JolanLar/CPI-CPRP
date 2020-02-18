$(document).ready(function ()
{
    var pageURL = $(location).attr("href");
    if(pageURL.slice(-3)=='rcs'||pageURL.slice(-3)=='rtc' || pageURL.slice(-3)=='tls'){
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
            $('#table-'+$(this).val()).show();
        });
    }
});


