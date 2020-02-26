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
                url: 'gestioncreationclasse/liste',
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
                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                }
            });
        }
    });

        if ($('#divsucces').is(':visible')) {
            $('#divsucces').fadeOut(2000);
        }

});
