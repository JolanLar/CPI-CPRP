$(document).ready(function() {
    /*
    * Annule le submit lors de la pression de la touche entrée sur toutes les pages admin
     */
    $(window).keydown(function (event) {
        if (event.keyCode == 13) {
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
        if ($(this).find(">:first-child").val() == -2) {
            $(this).find(">:nth-child(2)").attr('selected', 'selected');
        } else {
            $(this).find(">:first-child").attr('selected', 'selected');
        }
    });
});
