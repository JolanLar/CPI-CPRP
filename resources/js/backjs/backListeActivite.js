$(document).ready(function() {
    $('#gestionactiviteidfiliere option:nth-child(2)').attr('selected', 'selected');
});

//Quand clique sur le boutton edit d'une activite
$(document).on('click', '.activiteEdit', function () {
    var id = $(this).attr('id');
    var element = $('#activite-' + id);
    edit(element);
});

//Quand double cliques sur le libelle d'une activite
$(document).on('dblclick', '.text', function () {
    edit($(this));
});

//Quand modification de la filière
$('#gestionactiviteidfiliere').change(function () {
    //Récupère l'idFiliere et appelle la fonction updateActivite
    var idFiliere = $(this).val();
    updateActivite(idFiliere);
});

//Quand clique sur le bouton ajout
$('#gestionactivitebtnajouter').click(function () {
    //Parcour chaque ligne du tableau afin de récupérer le plus petit id disponible
    var idAjout = 1;
    $('#laTable>tbody>tr').each(function () {
        var idActivite = $(this).children('.id').text();
        if (idAjout == idActivite) {
            idAjout++;
        }
    });
    ajoutActivite(idAjout);
});

//Quand clique sur le bouton supprimer
$(document).on('click', '.activiteDelete', function () {
    var idActivite = $(this).attr('id');
    var confirm = window.confirm('Voulez-vous vraiment supprimer la ctivite n°' + idActivite + ' ?');
    if (confirm) {
        var idFiliere = $('#gestionactiviteidfiliere').val();
        deleteActivite(idFiliere, idActivite);
    }
});

function edit(element) {
    //Créer le champs d'édition des valeur et appelle la fonction sauvegarde
    var elementId = element.attr('id').split('-');
    elementId = elementId[1];
    var initialValue = element.text();
    //Ajoute l'input d'édition dans l'element passé en paramètre
    element.html('<input class="form-control" type="text" id="text-' + elementId + '" value="' + initialValue + '">')
    $('#text-' + elementId).select();
    //Quand on déselctionne l'input appelle la fonction save()
    $('#text-' + elementId).focusout(function () {
        save($(this));
    });
    $('#text-' + elementId).keyup(function (e) {
        if (e.keyCode === 27) $('#activite-' + elementId).html(initialValue);
        if (e.keyCode === 13) $(this).blur();
    });
}

function save(element) {
    //Sauvegarde l'édition d'un champ
    //Récupère les valeur nécessaire à la sauvegarde des données
    var idFiliere = $('#gestionactiviteidfiliere').val();
    var idActivite = element.attr('id').split('-');
    idActivite = idActivite[1];
    var libelleActivite = element.val();
    //Remplace l'input d'édition par sa valeur en texte
    $('#activite-' + idActivite).html(libelleActivite);
    //Appelle la fonction PHP edit dans le controller GestionActiviteController
    data = { idFiliere: idFiliere, idActivite: idActivite, libelleActivite: libelleActivite };
    $.ajax({
        type: "POST",
        url: "gestionactivite/edit",
        data: data,
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (retour) {
            message('success', retour);
        }
    })
}

function updateActivite(idFiliere) {
    var data = { idFiliere: idFiliere};
    $.ajax({
        type: "POST",
        url: "gestionactivite/listeActivite",
        data: data,
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (retour) {
            $('#laTable>tbody').html('');
            for (var i = 0; i < retour.length; i++) {
                if (retour[i].libelleActivite == null) {
                    retour[i].libelleActivite = '';
                }
                $('#laTable>tbody').append('<tr><td class="id">' + retour[i].idActivite + '</td><td width="85%" class="text" id="activite-' + retour[i].idActivite + '">' + retour[i].libelleActivite + '</td><td><a class="activiteEdit" id="' + retour[i].idActivite + '" href="javascript: void(0)"><i class="fas fa-pencil-alt"></i></a></td><td><a class="activiteDelete text-danger" id="' + retour[i].idActivite + '" href="javascript: void(0)"><i class="fas fa-trash-alt"></i></a></td></tr>');
            }
        }
    });
}

function deleteActivite(idFiliere, idActivite) {
    data = { idFiliere: idFiliere, idActivite: idActivite };
    $.ajax({
        type: 'POST',
        url: 'gestionactivite/delete',
        data: data,
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function () {
            message('success', 'Activite supprimée avec succès !');
        }
    });
    //SetTimeout car sinon parfois il s'actualisa avant la bdd
    setTimeout(() => {
        updateActivite(idFiliere);
    }, 50);
}

function ajoutActivite(idActivite) {
    $('#laTable>tbody').append('<tr><td class="id">' + idActivite + '</td><td width="85%" class="text" id="activite-' + idActivite + '"></td><td><a class="activiteEdit" id="' + idActivite + '" href="javascript: void(0)"><i class="fas fa-pencil-alt"></i></a></td><td><a class="activiteDelete text-danger" id="' + idActivite + '" href="javascript: void(0)"><i class="fas fa-trash-alt"></i></a></td></tr>');
    edit($('#activite-' + idActivite));
}
