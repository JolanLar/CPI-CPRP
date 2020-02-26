$(document).ready(function() {
    /*
    * Annule le submit lors de la pression de la touche entrée sur toutes les pages admin
     */
    $(window).keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            $('input').blur();
            $('select').blur();
            $('textarea').blur();
            return false;
        }
    });

    /*
    * @author Jolan Largeteau
    * Parcour tous les select et sélectionne la première ou la deuxième option si la valeur de la première est -2
    */
    $('select').each(function () {
        if($(this).find(">:first-child").val()==-2){
            $(this).find(">:nth-child(2)").attr('selected', 'selected');
        }else{
            $(this).find(">:first-child").attr('selected', 'selected');
        }
    });

    function message(status, text) {
        if (status == 'success') {
            $('#divsuccess').html(text);
            $('#divspace').hide();
            $('#divsuccess').show().delay(1000).fadeOut(600, function () {
                $('#divspace').show();
            });
        } else if (status == 'danger') {
            $('#divdanger').html(text);
            $('#divspace').hide();
            $('#divdanger').show().delay(2000).fadeOut(500, function () {
                $('#divspace').show();
            });
        }
    }

    if(window.location.pathname!="/public/gestionutilisateur"){
        if( $('#divsucces').is(':visible') ) {
            $('#divsucces').fadeOut(2000);
            $('#divspace').hide();
            setTimeout(function() {
                $('#divspace').show();
            }, 2000);
        }
    }
})
