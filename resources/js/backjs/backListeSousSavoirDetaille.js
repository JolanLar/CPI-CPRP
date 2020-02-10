$(document).ready(function () {

    $('#lyceefilieresoussavoirdetaille').change(function () {
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
            url: "gestionsoussavoirdetaille/liste",
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (retour) {
                $("#selectsoussavoirdetaille").html('<option value="-1">Nouveau sous savoir détaillé</option>');
                for (var i = 0; i < retour.length; i++) {
                    if (retour[i].idFiliere == filiere) {
                        $("#selectsoussavoirdetaille").append("<option value='" + retour[i].idSousSavoirDetaille + "'>" + retour[i].idSousSavoirDetaille + ' - ' + retour[i].titreSousSavoirDetaille + "</option>");
                    }
                }
                $('#selectsoussavoirdetaille').change();
            }
        })

        
        //Change la liste des savoirs détailles
        $.ajax({
            type: "POST",
            url: "gestionsoussavoirdetaille/savoirsdetaille",
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (retour) {
                $("#idlesoussavoirdetaille1").html('<option value="-1">Choix du savoir detaille</option>');
                for (var i = 0; i < retour.length; i++) {
                    if (retour[i].idFiliere == filiere) {
                        $("#idlesoussavoirdetaille1").append("<option value='" + retour[i].idSavoirDetaille + "'>" + retour[i].idSavoirDetaille + "</option>");
                    }
                }
            }
        })

    }).change();

    $('#selectsoussavoirdetaille').change(function () {
        //Réinitialise les compétences coché
        $('.competence').each(function () {
            $(this).prop('checked', false);
        });
        //récupère l'id du savoir detaille sélectionné grace à la value de l'option
        var soussavoirdetaille = $('#selectsoussavoirdetaille').val();
        //Si ce n'est pas nouveaux savoir qui est sélectionné, remplis les champs avec les données du savoir
        if (soussavoirdetaille != '-1') {
            var data = { soussavoirdetaille: soussavoirdetaille };
            //Appelle GestionSousSavoirdetailleController@savoirs
            $.ajax({
                type: "POST",
                url: 'gestionsoussavoirdetaille/soussavoirsdetaille',
                data: data,
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (retour)
                //retour = les données du savoir sélectionné
                {
                    //Attribut les données du savoir au champs
                    $id = retour[0].idSousSavoirDetaille.split('.');
                    $('#idlesoussavoirdetaille1').val($id[0] + '.' + $id[1]);
                    $('#idlesoussavoirdetaille2').val($id[2]);
                    $('#titrelesoussavoirdetaille').val(retour[0].titreSousSavoirDetaille);
                    $('#libellelesoussavoirdetaille').val(retour[0].libelleSousSavoirDetaille);
                    //Coche les cases de compétences
                    for (var i = 0; i < retour.length; i++) {
                        $('#' + retour[i].idFiliere + '-' + retour[i].idCompetence).prop("checked", true);
                    }
                }
            });
        } else {
            $('#titrelesoussavoirdetaille').val('');
            $('#libellelesoussavoirdetaille').val('');
        }
    });

    $('#boutonajoutersoussavoirdetaille').click(function () {
        //Récupère les compétences coché dans un tableau JSON
        var tabComp = [];
        $('.competence').each(function () {
            if ($(this).is(':checked')) {
                tabComp.push($(this).attr('id'));
            }
        });
        tabComp = JSON.stringify(tabComp);

        //Récupère les autres données du formualaire
        var savoirdetaille = $('#idlesoussavoirdetaille1').val();
        var soussavoirdetaille = $('#idlesoussavoirdetaille1').val() + '.' + $('#idlesoussavoirdetaille2').val();
        var titre = $('#titrelesoussavoirdetaille').val();
        var libelle = $('#libellelesoussavoirdetaille').val();
        var data = { savoirdetaille: savoirdetaille, soussavoirdetaille: soussavoirdetaille, titre: titre, libelle: libelle, tabComp: tabComp }
        $.ajax({
            type: "POST",
            url: "gestionsoussavoirdetaille/creation",
            data: data,
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (retour) {
                alert(retour);
                window.location.replace("/public/gestionsoussavoirdetaille");
            }
        });
    });

    $('#boutonsupprimersoussavoirdetaille').click(function () {
        var soussavoirdetaille = $('#idlesoussavoirdetaille1').val() + '.' + $('#idlesoussavoirdetaille2').val();
        var data = { soussavoirdetaille: soussavoirdetaille };
        $.ajax({
            type: "POST",
            url: "gestionsoussavoirdetaille/delete",
            data: data,
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (retour) {
                alert(retour);
                window.location.replace("/public/gestionsoussavoirdetaille");
            }
        });
    });

    $('#idlesoussavoirdetaille2').change(function () {
        var value = $('#idlesoussavoirdetaille1').val() + '.' + $(this).val();
        var filiere = $('#lyceefilieresoussavoirdetaille').val();
        var find = false;
        $.ajax({
            type: "POST",
            url: "gestionsoussavoirdetaille/liste",
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (retour) {
                for (var i = 0; i < retour.length; i++) {
                    if (retour[i].idFiliere == filiere) {
                        if (value == retour[i].idSousSavoirDetaille) {
                            $('#selectsoussavoirdetaille').val(value);
                            $('#selectsoussavoirdetaille').change();
                            find = true;
                        }
                    }
                }
                if (find == false) {
                    $('#selectsoussavoirdetaille').val('-1');
                    $('#selectsoussavoirdetaille').change();
                }
            }
        });
    });

    $('#idlesoussavoirdetaille1').change(function () {
        var value = $(this).val() + '.' + $('#idlesoussavoirdetaille2').val();
        var filiere = $('#lyceefilieresoussavoirdetaille').val();
        var find = false;
        $.ajax({
            type: "POST",
            url: "gestionsoussavoirdetaille/liste",
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (retour) {
                for (var i = 0; i < retour.length; i++) {
                    if (retour[i].idFiliere == filiere) {
                        if (value == retour[i].idSousSavoirDetaille) {
                            $('#selectsoussavoirdetaille').val(value);
                            $('#selectsoussavoirdetaille').change();
                            find = true;
                        }
                    }
                }
                if (find == false) {
                    $('#selectsoussavoirdetaille').val('-1');
                    $('#selectsoussavoirdetaille').change();
                }
            }
        });
    });



});