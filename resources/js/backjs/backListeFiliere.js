$('.filiereEdit').click(function () {
    var value = $('#filiere-' + $(this).attr('id')).text();
    var idFiliere = $(this).attr('id');
    $('#filiere-' + $(this).attr('id')).html('<input id="filiereText-' + $(this).attr('id') + '" type="text" value="' + value + '">');
    $('#filiereText-' + $(this).attr('id')).select();
    $('#filiereText-' + $(this).attr('id')).focusout(function () {
        var value = $(this).val();
        $('#filiere-' + idFiliere).html(value);
        data = { idFiliere, idFiliere, libelle: value };
        $.ajax({
            type: "POST",
            url: "gestionfiliere/edit",
            data: data,
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    $('#filiereText-' + $(this).attr('id')).on('keypress', function (e) {
        if (e.which == 13) {
            $(this).blur();
        }
    });
    $('#filiereText-' + $(this).attr('id')).keyup(function (e) {
        if (e.keyCode === 27) $('#filiere-' + idFiliere).html(value);
    });
});

$('.filiereDelete').click(function () {
    var idFiliere = $(this).attr('id');
    var libelleFiliere = $('#filiere-'+idFiliere).text();
    var supprimer = confirm("Voulez-vous supprimer la filière : "+libelleFiliere+" ?");
    if (supprimer) {
        var data = { idFiliere: idFiliere };
        $.ajax({
            type: "POST",
            url: "gestionfiliere/delete",
            data: data,
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function () {
                window.location.replace("/public/gestionfiliere");
            }
        });
    }
});

$('#ajoutFiliere').click(function () {

    $.ajax({
        type: "POST",
        url: "gestionfiliere/liste",
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (retour) {
            var find = false;
            for (var i = 0; i < retour.length; i++) {
                if (i + 1 != retour[i].idFiliere) {
                    find = true;
                    affiche(i + 1);
                }
            }
            if (!find) {
                affiche(retour.length + 1);
            }
        }
    });
    function affiche(idFiliere) {
        var value = "Filière";
        $('#laTable').append('<tr><td width="85%" id="filiere-' + idFiliere + '"><input id="filiereText-' + idFiliere + '" type="text" value="' + value + '"></td><td><a class="filiereEdit" id="' + idFiliere + '" href="javascript: void(0"><i class="fas fa-pencil-alt"></i></a></td><td><a class="filiereDelete text-danger" id="' + idFiliere + '" href="javascript: void(0"><i class="fas fa-trash-alt"></i></a></td></tr>');
        $('#filiereText-' + idFiliere).select();
        $('#filiereText-' + idFiliere).focusout(function () {
            ajout(idFiliere, $('#filiereText-' + idFiliere).val());
        });
        $('#filiereText-' + idFiliere).keyup(function (e) {
            if (e.keyCode === 13) {
                ajout(idFiliere, $('#filiereText-' + idFiliere).val());
            }
            if (e.keyCode === 27) {
                window.location.replace("/public/gestionfiliere");
            }
        });
    }
    function ajout(idFiliere, libelle) {
        $('#filiere-' + idFiliere).html(libelle);
        data = { id: idFiliere, libelle: libelle };
        $.ajax({
            type: "POST",
            url: 'gestionfiliere/creation',
            data: data,
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function () {
                window.location.replace("/public/gestionfiliere");
            }
        });
    }
});