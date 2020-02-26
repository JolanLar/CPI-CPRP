$(document).ready(function () {

    $("#selectcreationclasse").change(function () {
        if ($("#selectcreationclasse").val() === $('#idAJout').val()) {
            $("#idnomclasse").val('');
        }
        else {
            var classe = $("#selectcreationclasse").val();

            var data = { classe: classe };
            $.ajax({
                type: "POST",
                url: 'gestioncreationclasse/oneClasse',
                data: data,
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (retour) {
                    if ( retour.length ) {
                        var values = new Array();
                        $.each(retour, function (key) {
                            if (key === 0) {
                                $('#idnomclasse').val(retour[key].libelleAnneeEtude);
                                values[key] = retour[key].idFiliere;
                            } else {
                                values[key] = retour[key].idFiliere;
                            }
                        });
                        $("#selectfiliereassociee").val(values);
                    } else {
                        $('#idnomclasse').val(retour.libelleAnneeEtude);
                        $("#selectfiliereassociee").val(retour.idFiliere);
                    }
                }
            });
        }
    }).change();

    $('#bouttonsupprimerclasse').click(function () {
        let data;
        if ($('#selectcreationclasse').val != $('#idAJout').val()) {
            data = {idAnneeEtude: $('#selectcreationclasse').val()};
            $.ajax({
                type: "POST",
                url: "gestioncreationclasse/delete",
                data: data,
                headers:
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                success: function (retour) {
                    message('success', retour);
                    realoadClasseSelect();
                }
            });
        }
    });

    function realoadClasseSelect() {
        $.ajax({
            type: "POST",
            url: "gestioncreationclasse/liste",
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (retour) {
                newClasseId = retour[retour.length-1].idAnneeEtude+1;
                $('#selectcreationclasse').html('<option value="'+newClasseId+'">Nouvelle classe</option>');
                for(let i = 0; i < retour.length; i++){
                    $('#selectcreationclasse').append('<option value="'+retour[i].idAnneeEtude+'">'+retour[i].libelleAnneeEtude+'</option>');
                }
                $('#selectcreationclasse').trigger('change');
            }
        });
    }

});
