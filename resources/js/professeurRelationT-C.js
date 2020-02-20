$(document).ready(function ()
{
        $('select, .lechoix').each(function (e) {

            if( $(this).is( "select" ) ) {
                $(this).find(">:first-child").attr('selected', 'selected');
            } else {
                $(this).find(">:first-child").prop('checked', true);
            }

        });

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
});


