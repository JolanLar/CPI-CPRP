$(document).on('click', '.tacheEdit', function () {
    var id = $(this).attr('id');
    var element = $('#tache-' + id);
    edit(element);
});

$(document).on('dblclick', '.tacheText', function () {
    edit($(this));
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
            $('#divsuccess').html(retour);
            $('#divspace').hide();
            $('#divsuccess').show().delay(1000).fadeOut(600, function () {
                $('#divspace').show();
            });

        }
    })
}

$('#gestiontacheidfiliere').change(function () {
    //Récupère l'idFiliere et appelle la fonction updateActivite
    var idFiliere = $(this).val();
    updateActivite(idFiliere);
});

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
                $('#laTable').html('');
                $('#divdanger').html('Aucune activité trouvée !');
                $('#divspace').hide();
                $('#divdanger').show().delay(2000).fadeOut(500, function () {
                    $('#divspace').show();
                });
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
            $('#laTable').html('');
            for (var i = 0; i < retour.length; i++) {
                if(retour[i].libelleTache == null) {
                    retour[i].libelleTache = '';
                }
                $('#laTable').append('<tr><td>' + retour[i].idTache + '</td><td width="85%" class="tacheText" id="tache-' + retour[i].idTache + '">' + retour[i].libelleTache + '</td><td><a class="tacheEdit" id="' + retour[i].idTache + '" href="javascript: void(0)"><i class="fas fa-pencil-alt"></i></a></td><td><a class="tacheDelete text-danger" id="' + retour[i].idTache + '" href="javascript: void(0)"><i class="fas fa-trash-alt"></i></a></td></tr>');
            }
        }
    });
}
