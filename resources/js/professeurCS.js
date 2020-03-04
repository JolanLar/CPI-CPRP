$(document).ready(function () {

    /**
     * Array contenant la liste des indicateur performances
     */
    indicateurs = [];

    /**
    * @author Jolan Largeteau
    * Parcour tous les select et sélectionne la première ou la deuxième option si la valeur de la première est -2
    */
    $('select').each(function () {
        if($(this).find(">:first-child").val()==-2){
            $(this).find(">:nth-child(2)").attr('selected', 'selected');
        }else{
            $(this).find(">:first-child").attr('selected', 'selected');
        }
    });

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
    });
    $('#csenvoyer').click(function() {
        saveNotation();
        setNotationIndicateur();
    });
    $('#cssupprimer').click(function() {
        supprimerNotation();
    })

    /**
     * @author Jolan Largeteau
     * Modifie la liste des devoirs selon l'année et la classe
     */
    function updateDevoir(idSelect = -1) {
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
                $('#notationidcs').val(idSelect);
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
                    $('#moduleidcs').val(retour.idModule);
                }
            })
        } else {
            $('#notationnamecs').val('');
        }
        getNotationIndicateur();
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
                displayTable();
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
    }

    /**
     * @author Jolan Largeteau
     * Permet de cocher les cases compétences
     */
    $(document).on('click', '.note', function(){
        idTR = $(this).parent().attr('id');
        idTRSplit = idTR.split('-');
        idIndicateurPerformance = idTRSplit[1];
        if($.inArray(idIndicateurPerformance, indicateurs) !== -1) {
            $(this).css('background-color', 'white');
            indicateurs = $.grep(indicateurs, function(value) {
               return value != idIndicateurPerformance;
            });
        } else {
            $(this).css('background-color', 'green');
            indicateurs.push(idIndicateurPerformance);
        }
    });

    /**
     * @author Jolan Largeteau
     * Permet de sauvegarder la fiche de notation
     */
    function saveNotation() {
        const idNotation = $('#notationidcs').val();
        const libelleNotation = $('#notationnamecs').val();
        const typeNotation = $('#notationtypeid').val();
        const idModule = $('#moduleidcs').val();
        const annee = $('#anneeidcs').val();
        const anneeEtude = $('#classeidcs').val();
        if(libelleNotation!=null&&libelleNotation!="") {
            const data = {
                idNotation: idNotation,
                libelleNotation: libelleNotation,
                idTypeNotation: typeNotation,
                idModule: idModule,
                annee: annee,
                idAnneeEtude: anneeEtude
            };
            $.ajax({
                type: "POST",
                url: 'cs/creation/addNotation',
                data: data,
                headers:
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                success: function (retour) {
                    alert('Succès !');
                    updateDevoir(retour);
                }
            })
        } else {
            alert('Veuillez entrer un nom de devoir !');
        }
    }

    /**
     * @author Jolan Largeteau
     * Permet de supprimer la fiche de notation
     */
    function supprimerNotation() {
        const idNotation = $('#notationidcs').val();
        if( idNotation !== -1) {
            const data = { idNotation: idNotation};
            $.ajax({
                type: "POST",
                url: "cs/creation/supprimer",
                data: data,
                headers:
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                success: function (retour) {
                    alert(retour);
                    updateDevoir();
                }
            })
        } else {
            alert('Veuillez sélectionner une fiche de notation !');
        }
    }

    /**
     * @author Jolan Largeteau
     * Permet de cocher les indicateurs déjà lié à une compétence
     */
    function getNotationIndicateur() {
        const idNotation = $('#notationidcs').val();
        const data = { idNotation: idNotation};
        $.ajax({
            type: "POST",
            url: "cs/creation/getNotationIndicateur",
            data: data,
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success: function(retour) {
                if(!retour.message) {
                    indicateurs = [];
                    $('tbody > tr > td').each(function () {
                        $(this).css('background-color', 'white');
                    });
                    if(retour) {
                        for(let i = 0; i < retour.length; i++) {
                            $('#indicateur-'+retour[i].idIndicateurPerformance).trigger('click');
                        }
                    }
                } else {
                    console.log(retour.message);
                    alert('Erreur : Impossible de récupérer la liste des indicateurs !');
                }
            }
        })
    }

    /**
     * @author Jolan Largeteau
     * Permet de sauvegarder la liaison entre fiche et indicateurs
     */
    function setNotationIndicateur() {
        const idNotation = $('#notationidcs').val();
        const data = { indicateurs: indicateurs, idNotation: idNotation };
        $.ajax({
            type: "POST",
            url: "cs/creation/setNotationIndicateur",
            data: data,
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success: function(retour) {
                if(retour) {
                    console.log(retour.message);
                }
            }
        })
    }


    /**
     * Les triggers
     */
    $("#notation").trigger("change");
    updateFiliereRadio();

});
