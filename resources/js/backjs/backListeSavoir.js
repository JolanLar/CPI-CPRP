$(document).ready(function(){

    //Change la valeur des champs id et libelle savoir en fonction du savoir sélectionner
    $('#selectsavoir').change(function() {
        //récupère l'id du savoir sélectionné grace à la value de l'option
        var savoir = $('#selectsavoir').val();
        var data = { data: savoir };
        //Appelle GestionSavoirController@savoirs
        $.ajax({
            type: "POST",
            url: 'gestionsavoir/savoirs',
            data: data,
            headers:
			{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(retour)
            //retour = les données du savoir sélectionné
			{
                //Attribut les données du savoir au champs
                $('#idlesavoir').val(retour.idSavoir);
                $('#libellelesavoir').val(retour.libelleSavoir);
            }
        })
    });

    /*
    *When click on save button
     */
    $('#boutonajoutersavoir').click(function() {
        idSavoir = $('#idlesavoir').val();
        libelleSavoir = $('#libellelesavoir').val();
        data = { idlesavoir: idSavoir, libellelesavoir: libelleSavoir };
        $.ajax({
           type: "POST",
           url: "gestionsavoir/creation",
            data: data,
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success: function(retour) {
               message('success', retour);
               reloadSavoir();
               $('#selectsavoir').trigger('change');
            }
        });
    });

    $('#boutonsupprimersavoir').click(function () {
        var supprimer = confirm("Voulez-vous supprimer ce savoir et tout les savoir détaillés et sous savoirs associés ?");
        if(supprimer){
            //récupère l'id du savoir sélectionné grace à la value de l'option
            var savoir = $('#idlesavoir').val();
            var data = { idSavoir: savoir };
            //Appelle GestionSavoirController@savoirs
            $.ajax({
                type: "POST",
                url: 'gestionsavoir/delete',
                data: data,
                headers:
                {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(retour)
                //retour = les données du savoir sélectionné
                {
                    //Attribut les données du savoir au champs
                    message('success', 'Le savoir '+savoir+' à bien été supprimé !');
                    reloadSavoir();
                    $('#selectsavoir').trigger('change');
                }
            })
        }
    });

    /*
    * When change value of text input
     */
    $('#idlesavoir').change(function (){
        idSavoir = $(this).val();
        if($('#selectsavoir option[value="'+idSavoir+'"]').length > 0) {
            $('#selectsavoir').val(idSavoir);
            $('#selectsavoir').trigger('change');
        } else {
            $('#selectsavoir').val('-1');
            $('#libellelesavoir').val('');
        }
    });

    function reloadSavoir() {
        $.ajax({
           type: "POST",
           url: "gestionsavoir/liste",
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success: function(retour) {
               $('#selectsavoir').html('<option value="-1">Nouveau savoir</option>');
               for(let i = 0; i < retour.length; i++){
                    $('#selectsavoir').append('<option value="'+retour[i].idSavoir+'">'+retour[i].idSavoir+' - '+retour[i].libelleSavoir+'</option>');
               }
            }
        });
    }

});
