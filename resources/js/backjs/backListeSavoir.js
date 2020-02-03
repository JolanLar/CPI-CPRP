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
                    alert('Le savoir à bien été supprimé');
                    window.location.replace("/public/gestionsavoir");
                }
            })
        }
    });

});