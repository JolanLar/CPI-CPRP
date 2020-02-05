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
                    $('#idnomclasse').val(retour.libelleAnneeEtude);
                    $("#selectfiliereassociee").val(retour.idFiliere);
                }
            });
        }
    }).change();

    $('#bouttonsupprimerclasse').click(function () {
        if ($('#selectcreationclasse').val != $('#idAJout').val()) {
            data = { idAnneeEtude: $('#selectcreationclasse').val() }
            $.ajax({
                type: "POST",
                url: "fgestioncreationclasse/delete",
                data: data,
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (retour) {
                    alert(retour);
                }
            })
        }
    });
});       