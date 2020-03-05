$(document).on('click', '.filiereEdit', function () {
    var value = $('#filiere-' + $(this).attr('id')).text().toString().toUpperCase();
    var idFiliere = $(this).attr('id');
    $('#filiere-' + $(this).attr('id')).html('<input id="filiereText-' + $(this).attr('id') + '" type="text" value="' + value + '" />');
    $('#filiereText-' + $(this).attr('id')).select();
});


$(document).on('keyup', 'input', function (e) {
    if (e.keyCode === 27) {
        window.location.replace("/public/gestionfiliere");
    }
});

$(document).on('focusout', 'input', function () {
    if(document.location.href.includes('gestionfiliere'))
    {
        const idInput = $(this).attr('id');
        if (idInput) {
            const idInputSplit = idInput.split('-');
            const idFiliere = idInputSplit[1];
            var value = $(this).val().toUpperCase();
            $('#filiere-' + idFiliere).html(value);
            data = {idFiliere, idFiliere, libelle: value};
            $.ajax({
                type: "POST",
                url: 'gestionfiliere/creation',
                data: data,
                headers:
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                success: function () {
                    message('success', 'Filière ajoutée / Modifiée !');
                }
            });
            $.ajax({
                type: "POST",
                url: "gestionfiliere/edit",
                data: data,
                headers:
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });
        }
    }
});

$(document).on('click', '.filiereDelete', function () {
    var idFiliere = $(this).attr('id');
    var libelleFiliere = $('#filiere-'+idFiliere).text();
    var supprimer = confirm("Voulez-vous supprimer la filière : "+libelleFiliere+" ?\rAttention cela supprimera toutes les données liées à cette filière !\r\r!!!!!!!!!!!!!!!!!!!!!!!\r Les classes et les élèves ne seront pas supprimé, si vous souhaitez les supprimer rendez-vous à la page: Gestion des classes \r!!!!!!!!!!!!!!!!!!!!!!!");
    $('#filiere-'+idFiliere).parent().remove();
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
                message('success', 'Filière supprimée !');

            }
        });
    }
});

$(document).on('click', '#ajoutFiliere', function () {
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
        $('#laTable').append('<tr><td width="85%" class="libelleFiliere" id="filiere-' + idFiliere + '"><input id="filiereText-' + idFiliere + '" type="text" value="" /></td><td><a class="filiereEdit" id="' + idFiliere + '" href="javascript: void(0"><i class="fas fa-pencil-alt"></i></a></td><td><a class="filiereDelete text-danger" id="' + idFiliere + '" href="javascript: void(0"><i class="fas fa-trash-alt"></i></a></td></tr>');
        $('#filiereText-' + idFiliere).select();
    }
});

$(document).on('dblclick', '.libelleFiliere', function() {
    var id = $(this).attr('id').split('-');
    $('#'+id[1]).trigger('click');
});
