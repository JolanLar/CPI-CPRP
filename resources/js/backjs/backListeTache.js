//Quand clique sur le boutton edit d'une tache
$(document).on('click', '.tacheEdit', function () {
    var id = $(this).attr('id');
    var element = $('#tache-' + id);
    edit(element);
});

//Quand double cliques sur le libelle d'une tache
$(document).on('dblclick', '.tacheText', function () {
    edit($(this));
});

//Quand modification de la filière
$('#gestiontacheidfiliere').change(function () {
    //Récupère l'idFiliere et appelle la fonction updateActivite
    var idFiliere = $(this).val();
    updateActivite(idFiliere);
});

//Quand modification de l'activité
$('#gestiontacheidactivite').change(function () {
    var idFiliere = $('#gestiontacheidfiliere').val();
    var idActivite = $(this).val();
    updateTache(idFiliere, idActivite);
});

//Quand clique sur le bouton ajout
$('#gestiontachebtnajouter').click(function () {
    //Parcour chaque ligne du tableau afin de récupérer le plus petit id disponible
    var idAjout = 1;
    $('#laTable>tbody>tr').each(function () {
        var idTache = $(this).children('.id').text();
        if (idAjout == idTache) {
            idAjout++;
        }
    });
    ajoutTache(idAjout);
});

//Quand clique sur le bouton supprimer
$(document).on('click', '.tacheDelete', function () {
    var idTache = $(this).attr('id');
    var confirm = window.confirm('Voulez-vous vraiment supprimer la tache n°' + idTache + ' ?');
    if (confirm) {
        var idFiliere = $('#gestiontacheidfiliere').val();
        var idActivite = $('#gestiontacheidactivite').val();
        deleteTache(idFiliere, idActivite, idTache);
    }
});

function edit(element) {
    //Créer le champs d'édition des valeur et appelle la fonction sauvegarde
    var tacheId = element.attr('id').split('-');
    tacheId = tacheId[1];
    var initialValue = element.text();
    //Ajoute l'input d'édition dans l'element passé en paramètre
    element.html('<input class="form-control" type="text" id="tacheText-' + tacheId + '" value="' + initialValue + '">')
    $('#tacheText-' + tacheId).select();
    //Quand on déselctionne l'input appelle la fonction save()
    $('#tacheText-' + tacheId).focusout(function () {
        save($(this));
    });
    $('#tacheText-' + tacheId).keyup(function (e) {
        if (e.keyCode === 27) $('#tache-' + tacheId).html(initialValue);
        if (e.keyCode === 13) $(this).blur();
    });
}

function save(element) {
    //Sauvegarde l'édition d'un champ
    //Récupère les valeur nécessaire à la sauvegarde des données
    var idFiliere = $('#gestiontacheidfiliere').val();
    var idActivite = $('#gestiontacheidactivite').val();
    var idTache = element.attr('id').split('-');
    idTache = idTache[1];
    var libelleTache = element.val();
    //Remplace l'input d'édition par sa valeur en texte
    $('#tache-' + idTache).html(libelleTache);
    //Appelle la fonction PHP edit dans le controller GestionTacheController
    data = { idFiliere: idFiliere, idActivite: idActivite, idTache: idTache, libelleTache: libelleTache };
    $.ajax({
        type: "POST",
        url: "gestiontache/edit",
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
    //Appelle la fonction PHP listeActivite
    var data = { idFiliere: idFiliere };
    $.ajax({
        type: "POST",
        url: "gestiontache/listeActivite",
        data: data,
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (retour) {
            $('#gestiontacheidactivite').html('<option value="-1" disabled>Activité</option>')
            for (var i = 0; i < retour.length; i++) {
                $('#gestiontacheidactivite').append('<option value="' + retour[i].idActivite + '">' + retour[i].idActivite + ' - ' + retour[i].libelleActivite + '</option>');
            }
            //Appelle la fonction updateTache afin de mettre a jour la liste des tâches
            if (typeof (retour[0]) !== 'undefined') {
                updateTache(idFiliere, retour[0].idActivite);
            } else {
                $('#laTable>tbody').html('');
                message('danger', 'Aucune activité trouvée !');
            }
        }
    });
}


function updateTache(idFiliere, idActivite) {
    var data = { idFiliere: idFiliere, idActivite: idActivite };
    $.ajax({
        type: "POST",
        url: "gestiontache/listeTache",
        data: data,
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (retour) {
            $('#laTable>tbody').html('');
            for (var i = 0; i < retour.length; i++) {
                if (retour[i].libelleTache == null) {
                    retour[i].libelleTache = '';
                }
                $('#laTable>tbody').append('<tr><td class="id">' + retour[i].idTache + '</td><td width="85%" class="tacheText" id="tache-' + retour[i].idTache + '">' + retour[i].libelleTache + '</td><td><a class="tacheEdit" id="' + retour[i].idTache + '" href="javascript: void(0)"><i class="fas fa-pencil-alt"></i></a></td><td><a class="tacheDelete text-danger" id="' + retour[i].idTache + '" href="javascript: void(0)"><i class="fas fa-trash-alt"></i></a></td></tr>');
            }
        }
    });
}

function deleteTache(idFiliere, idActivite, idTache) {
    data = { idFiliere: idFiliere, idActivite: idActivite, idTache: idTache };
    $.ajax({
        type: 'POST',
        url: 'gestiontache/delete',
        data: data,
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function () {
            message('success', 'Tache supprimée avec succès !');
        }
    });
    //SetTimeout car sinon parfois il s'actualisa avant la bdd
    setTimeout(() => {
        updateTache(idFiliere, idActivite);
    }, 50);
}

function ajoutTache(idTache) {
    $('#laTable>tbody').append('<tr><td class="id">' + idTache + '</td><td width="85%" class="tacheText" id="tache-' + idTache + '"></td><td><a class="tacheEdit" id="' + idTache + '" href="javascript: void(0)"><i class="fas fa-pencil-alt"></i></a></td><td><a class="tacheDelete text-danger" id="' + idTache + '" href="javascript: void(0)"><i class="fas fa-trash-alt"></i></a></td></tr>');
    edit($('#tache-' + idTache));
}

function message(status, text) {
    if (status == 'success') {
        $('#divsuccess').html(text);
        $('#divspace').hide();
        $('#divsuccess').show().delay(1000).fadeOut(600, function () {
            $('#divspace').show();
        });
    } else if (status == 'danger') {
        $('#divdanger').html(text);
        $('#divspace').hide();
        $('#divdanger').show().delay(2000).fadeOut(500, function () {
            $('#divspace').show();
        });
    }
}