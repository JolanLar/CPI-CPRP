$(document).ready(function () {

    /**
     * @author Ruben Veloso Paulos
     * Retourne la notation
     * @type {number}
     */
    function getNotation() {
        let notation = $('#notation option:selected').val().split("-");
        return notation[0];
    }

    /**
     * @author Ruben Veloso Paulos
     * Retourne la filiere
     * @type {number}
     */
    function getFiliere() {
        let filiere = $('#notation option:selected').val().split("-");
        return filiere[1];
    }

    /**
     * @author Ruben Veloso Paulos
     * Retourne le text du textarea
     */
    function getText() {
        let text;
        return text = $('#observationcs').val();
    }

    /**
     * @author Ruben Veloso Paulos
     * Retourne l'étudiant actuel
     */
    function getUser() {
        let user;
        return user = $('#etudiantcs option:selected').val();
    }

    /**
     * @author Ruben Veloso Paulos
     * Affiche le bon tableau suivant la filière de l'étudiant
     */
    function getTableau() {
        $.each('table').hide();
    }

    /**
     * Récupère les observations si l'élève en a
     */
    function getObservation($idUtilisateur) {
        let data = { user: $idUtilisateur };
        $.ajax({
            type: "POST",
            url: "gestion/getObservation",
            data: data,
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success: function (retour) {
                if (  retour.length !== 0) {
                    $('#observationcs').text(retour[0].observationProfesseur);
                } else {
                    $('#observationcs').text("");
                }
            }
        });
    }

    /**
     *  @author Ruben Veloso Paulos
     * Changement de notation affiche les étudiants de la filière pour la notation
     */
    $('#notation').change(function () {
        let data = {filiere: getFiliere()};
        $.ajax({
            type: "POST",
            url: "gestion/getEtudiant",
            data: data,
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success: function (retour) {
                $('#etudiantcs').empty();
                $.each(retour, function (index) {
                    $('#etudiantcs').append("<option value='" + retour[index].idUtilisateur + "'>" + retour[index].idUtilisateur + "</option>");
                });
                getObservation(retour[0].idUtilisateur);
                getTableau(retour[0].idUtilisateur);
            }
        });
    });


    /**
     * Enregistre les informations saisies dans le textarea sur le focusout
     */
    $('#observationcs').focusout(function () {
        let data = {text: getText(), user: getUser(), notation: getNotation()};
        $.ajax({
            type: "POST",
            url: "gestion/saveObservation",
            data: data,
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
    });

    $('#classeidcs').change(function() {
        updateDevoir();
        updateFiliereRadio();
    });
    $('#anneeidcs').change(function() {
       updateDevoir();
    });
    $('#notationidcs').change(function() {
        getOneNotation();
    })

    /**
     * @author Jolan Largeteau
     * Modifie la liste des devoirs selon l'année et la classe
     */
    function updateDevoir() {
        idAnneeEtude = $('#classeidcs').val();
        annee = $('#anneeidcs').val();
        data = { idAnneeEtude: idAnneeEtude, annee, annee };

        $.ajax({
            type: "POST",
            url: "cs/creation/getNotation",
            data: data,
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success: function (retour)
            {
                $('#notationidcs').html('<option value="-1">Nouvelle fiche de notation</option>');
                for(let i = 0; i < retour.length; i++) {
                    $('#notationidcs').append('<option value="'+retour[i].idNotation+'">'+retour[i].libelleNotation+'</option>');
                }
                getOneNotation();
            }
        })
    }

    /**
     * @author Jolan Largeteau
     * Remplie les input avec les données du devoir sélectionné
     */
    function getOneNotation () {
        idNotation = $('#notationidcs').val();
        if(idNotation!="-1") {
            data = {idNotation: idNotation};
            $.ajax({
                type: "POST",
                url: "cs/creation/getOneNotation",
                data: data,
                headers:
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                success: function (retour) {
                    $('#notationtypeid').val(retour.idTypeNotation);
                    $('#notationnamecs').val(retour.libelleNotation);
                }
            })
        } else {
            $('#notationnamecs').val('');
        }
    }


    /**
     * @author Jolan Largeteau
     * Retourne la liste des filières de la classe
     */
    function updateFiliereRadio() {
        classe = $('#classeidcs').val();
        data = { idAnneeEtude: classe };
        $.ajax({
            type: "POST",
            url: "cs/creation/getFilieres",
            data: data,
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success: function (retour) {
                $('.lechoix').html('');
                for(let i = 0; i < retour.length; i++){
                    if (i == 0) {
                        $('.lechoix').append('<input type="radio" class="choixref" name="choixref" value="' + retour[i].idFiliere + '" checked="checked">&nbsp');
                    } else {
                        $('.lechoix').append('<input type="radio" class="choixref" name="choixref" value="' + retour[i].idFiliere + '">&nbsp');
                    }
                    $('.lechoix').append('<label for="' + retour[i].libelleFiliere + '">' + retour[i].libelleFiliere + '</label>&nbsp');
                }
                displayTable()
            }
        })
    }

    /**
     * @author Jolan Largeteau
     * Affiche uniquement le tableau sélectionné
     */
    function displayTable() {
        $('.table').each(function() {
           $(this).hide();
        });
        $('#tab'+$('.choixref').val().toLowerCase()).show();
        $('#table-'+$('.choixref').val()).show();
        alert($('.choixref').val());
    }


    /**
     * Les triggers
     */
    $("#notation").trigger("change");
    updateFiliereRadio();

});
