$(document).ready(function () {

    $('#selectsavoirdetaille').change(function () {
        //récupère l'id du savoir detaille sélectionné grace à la value de l'option
        var savoirdetaille = $('#selectsavoirdetaille').val();
        if(savoirdetaille!=-1){
            var data = { savoirdetaille : savoirdetaille };
            //Appelle GestionSavoirdetailleController@savoirs
            $.ajax({
                type: "POST",
                url: 'gestionsavoirdetaille/savoirsdetaille',
                data: data,
                headers:
                {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(retour)
                //retour = les données du savoir sélectionné
                {
                    //Attribut les données du savoir au champs
                    $id = retour.idSavoirDetaille.split('.');
                    $('#idlesavoirdetaille1').val($id[0]);
                    $('#idlesavoirdetaille2').val($id[1]);
                    $('#titrelesavoirdetaille').val(retour.titreSavoirDetaille);
                    $('#libellelesavoirdetaille').val(retour.libelleSavoirDetaille);
                }
            })
        }else{
            $('#idlesavoirdetaille1').val('-1');
            $('#idlesavoirdetaille2').val('');
            $('#titrelesavoirdetaille').val('');
            $('#libellelesavoirdetaille').val('');
        }
    });

});