$(document).ready(function () {

    $('#lyceefilieresavoirdetaille').change(function () {
        //cache toute les compétences
        $('.comp').each(function () {
            $(this).hide();
        });

        //Affiche les compétences de la bonnes filières
        var filiere = $(this).val();
        $('#' + filiere).show();

        //Change la liste des savoirs détailles
        $.ajax({
            type: "POST",
            url: "gestionsavoirdetaille/liste",
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (retour) {
                $("#selectsavoirdetaille").html('<option value="-1">Nouveau savoir</option>');
                for (var i = 0; i < retour.length; i++) {
                    if (retour[i].idFiliere == filiere) {
                        $("#selectsavoirdetaille").append("<option value='" + retour[i].idSavoirDetaille + "'>" + retour[i].idSavoirDetaille + ' - ' + retour[i].titreSavoirDetaille + "</option>");
                    }
                }
                $('#selectsavoirdetaille').change();
            }
        })

    }).change();

    $('#selectsavoirdetaille').change(function () {

        //Réinitialise les compétences coché
        $('.competence').each(function() {
            $(this).prop('checked', false);
        });
        //récupère l'id du savoir detaille sélectionné grace à la value de l'option
        var savoirdetaille = $('#selectsavoirdetaille').val();
        var filiere = $('#lyceefilieresavoirdetaille').val();
        //Si ce n'est pas nouveaux savoir qui est sélectionné, remplis les champs avec les données du savoir
        if (savoirdetaille != -1) {
            var data = { savoirdetaille: savoirdetaille, filiere: filiere };
            //Appelle GestionSavoirdetailleController@savoirs
            $.ajax({
                type: "POST",
                url: 'gestionsavoirdetaille/savoirsdetaille',
                data: data,
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (retour)
                //retour = les données du savoir sélectionné
                {
                    //Attribut les données du savoir au champs
                    $id = retour[0].idSavoirDetaille.split('.');
                    $('#idlesavoirdetaille1').val($id[0]);
                    $('#idlesavoirdetaille2').val($id[1]);
                    $('#titrelesavoirdetaille').val(retour[0].titreSavoirDetaille);
                    $('#libellelesavoirdetaille').val(retour[0].libelleSavoirDetaille);
                    //Coche les cases de compétences
                    for (var i = 0; i < retour.length; i++) {
                        $('#'+retour[i].idFiliere+'-'+retour[i].idCompetence).prop("checked", true);
                    }
                }
            });
        } else {
            $('#titrelesavoirdetaille').val('');
            $('#libellelesavoirdetaille').val('');
        }
    });

    $('#boutonajoutersavoirdetaille').click(function () {
        //Récupère les compétences coché dans un tableau JSON
        var tabComp = [];
        $('.competence').each(function () {
            if ($(this).is(':checked')) {
                tabComp.push($(this).attr('id'));
            }
        });
        tabComp = JSON.stringify(tabComp);

        //Récupère les autres données du formualaire
        var savoir = $('#idlesavoirdetaille1').val();
        var savoirdetaille = $('#idlesavoirdetaille1').val() + '.' + $('#idlesavoirdetaille2').val();
        var titre = $('#titrelesavoirdetaille').val();
        var libelle = $('#libellelesavoirdetaille').val();
        var filiere = $('#lyceefilieresavoirdetaille').val();
        var data = { savoir: savoir, savoirdetaille: savoirdetaille, titre: titre, filiere: filiere, libelle: libelle, tabComp: tabComp }
        $.ajax({
            type: "POST",
            url: "gestionsavoirdetaille/creation",
            data: data,
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (retour) {
                alert(retour);
                window.location.replace("/public/gestionsavoirdetaille");
            }
        });
    });

    $('#boutonsupprimersavoirdetaille').click(function () {
        var savoirdetaille = $('#idlesavoirdetaille1').val() + '.' + $('#idlesavoirdetaille2').val();
        var filiere = $('#lyceefilieresavoirdetaille').val();
        var data = { savoirdetaille: savoirdetaille, filiere: filiere };
        $.ajax({
            type: "POST",
            url: "gestionsavoirdetaille/delete",
            data: data,
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (retour) {
                alert(retour);
                window.location.replace("/public/gestionsavoirdetaille");
            }
        });
    });

    $('#idlesavoirdetaille2').change(function () {
        var value = $('#idlesavoirdetaille1').val() + '.' + $(this).val();
        var filiere = $('#lyceefilieresavoirdetaille').val();
        var find = false;
        $.ajax({
            type: "POST",
            url: "gestionsavoirdetaille/liste",
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (retour) {
                for (var i = 0; i < retour.length; i++) {
                    if (retour[i].idFiliere == filiere) {
                        if (value == retour[i].idSavoirDetaille) {
                            $('#selectsavoirdetaille').val(value);
                            find = true;
                        }
                    }
                }
                if (find == false) {
                    $('#selectsavoirdetaille').val('-1');
                }
            }
        });
    });

    $('#idlesavoirdetaille1').change(function () {
        var value = $(this).val() + '.' + $('#idlesavoirdetaille2').val();
        var filiere = $('#lyceefilieresavoirdetaille').val();
        var find = false;
        $.ajax({
            type: "POST",
            url: "gestionsavoirdetaille/liste",
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (retour) {
                for (var i = 0; i < retour.length; i++) {
                    if (retour[i].idFiliere == filiere) {
                        if (value == retour[i].idSavoirDetaille) {
                            $('#selectsavoirdetaille').val(value);
                            find = true;
                        }
                    }
                }
                if (find == false) {
                    $('#selectsavoirdetaille').val('-1');
                }
            }
        });
    });

});