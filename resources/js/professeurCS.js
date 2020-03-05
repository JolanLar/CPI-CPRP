$(document).ready(function () {

    /**
     * Set à l'impression des pages rtc / rcs / cs
     */
    $('#print_prof').click(function () {
        $('body').scrollTop(0);
        let tab = $('.table:visible'),
            cache_width = tab.width(),
            a4 = [595.28, 841.89]; // for a4 size paper width and height

        createPDF();
        //create pdf
        function createPDF() {
            getCanvas().then(function(canvas) {
                let
                    img = canvas.toDataURL("image/png"),
                    doc = new jsPDF({
                        orientation: 'landscape',
                        unit: 'px',
                        format: 'a4'
                    });
                doc.addImage(img, 'JPEG', 20, 20);
                doc.save('livret_cs.pdf');
                tab.width(cache_width);
            });
        }

        // create canvas object
        function getCanvas() {
            tab.width((a4[0] * 1.33333) - 80).css('max-width', 'none');
            return html2canvas(tab[0], {
                imageTimeout: 2000,
                removeContainer: true
            });
        }

    });

    /**
     * Array contenant la liste des indicateur performances
     */
    indicateurs = [];

    /**
     * @author Jolan Largeteau
     * Parcour tous les select et sélectionne la première ou la deuxième option si la valeur de la première est -2
     */
    $('select').each(function () {
        if ($(this).find(">:first-child").val() == -2) {
            $(this).find(">:nth-child(2)").attr('selected', 'selected');
        } else {
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
     * Retourne l'annee
     * @type {number}
     */
    function getAnnee() {
        let annee = $('#notation option:selected').val().split("-");
        return annee[1];
    }

    /**
     * @author Ruben Veloso Paulos
     * Retourne l'AnneeEtude
     * @type {number}
     */
    function getAnneeEtude() {
        let anneeEtude = $('#notation option:selected').val().split("-");
        return anneeEtude[2];
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
        let data = {notation: getNotation()};
        $.ajax({
            type: "POST",
            url: "gestion/getIndicateurNotation",
            data: data,
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success: function (retour) {
                $('.table').each(function () {
                    let tab = $(this);
                    $(tab).show();
                    let trv = false;
                    $("#" + $(tab).attr('id') + ' > tbody > tr').each(function () {
                        let tr = $(this);
                        let idtr = $(tr).attr('id');
                        let idInd = idtr.split('-');
                        $(tr).hide();
                        $(retour).each(function (index) {
                            if (idInd[1] == retour[index].idIndicateurPerformance) {
                                $(tr).show();
                                trv = true;
                            }
                        });
                    });
                    if ( !trv ) {
                        $(tab).hide();
                    }
                });
            }
        });
    }

    /**
     * Récupère les observations si l'élève en a
     */
    function getObservation($idUtilisateur) {
        let data = {user: $idUtilisateur};
        $.ajax({
            type: "POST",
            url: "gestion/getObservation",
            data: data,
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success: function (retour) {
                if (retour.length !== 0) {
                    $('#observationcs').text(retour[0].observationProfesseur);
                } else {
                    $('#observationcs').text("");
                }
            }
        });
    }

    function getNote($idUtilisateur, $annee) {

        let data = {nom: $idUtilisateur, annee: $annee};

        //Récupération des notes
        $.ajax({
            type: "POST",
            url: "gestion/recuperernote",
            data: data,
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success: function (retour) {

                $('.table').each(function () {
                    $("#" + $(this).attr('id') + ' > tbody > tr').each(function () {
                        idparent = $(this).attr('id');
                        var noteid = idparent.split('-');

                        if (noteid[2] == "") {

                            for (i = 0; i < retour.length; i++) {
                                var idindicateur = retour[i].split(' = ');
                                var aa = retour[i].split(' aa : ');
                                var ca1 = retour[i].split(' ca1 : ');
                                var ca2 = retour[i].split(' ca2 : ');
                                var ar1 = retour[i].split(' ar1 : ');
                                var ar2 = retour[i].split(' ar2 : ');
                                var ar3 = retour[i].split(' ar3 : ');
                                var c1 = retour[i].split(' c1 : ');
                                var c2 = retour[i].split(' c2 : ');
                                var c3 = retour[i].split(' c3 : ');
                                var c4 = retour[i].split(' c4 : ');

                                if (noteid[1] == idindicateur[0]) {
                                    if (aa[1].substring(0, 1) == '1') {
                                        $("#" + idparent + ">td.note.aa").css('backgroundColor', 'rgb(0, 255, 0)');
                                    }
                                    if (ca1[1].substring(0, 1) == '1') {
                                        $("#" + idparent + ">td.note.ca1").css('backgroundColor', 'rgb(0, 255, 0)');
                                    }
                                    if (ca2[1].substring(0, 1) == '1') {
                                        $("#" + idparent + ">td.note.ca2").css('backgroundColor', 'rgb(0, 255, 0)');
                                    }
                                    if (ar1[1].substring(0, 1) == '1') {
                                        $("#" + idparent + ">td.note.ar1").css('backgroundColor', 'rgb(0, 255, 0)');
                                    }
                                    if (ar2[1].substring(0, 1) == '1') {
                                        $("#" + idparent + ">td.note.ar2").css('backgroundColor', 'rgb(0, 255, 0)');
                                    }
                                    if (ar3[1].substring(0, 1) == '1') {
                                        $("#" + idparent + ">td.note.ar3").css('backgroundColor', 'rgb(0, 255, 0)');
                                    }
                                    if (c1[1].substring(0, 1) == '1') {
                                        $("#" + idparent + ">td.note.c1").css('backgroundColor', 'rgb(0, 255, 0)');
                                    }
                                    if (c2[1].substring(0, 1) == '1') {
                                        $("#" + idparent + ">td.note.c2").css('backgroundColor', 'rgb(0, 255, 0)');
                                    }
                                    if (c3[1].substring(0, 1) == '1') {
                                        $("#" + idparent + ">td.note.c3").css('backgroundColor', 'rgb(0, 255, 0)');
                                    }
                                    if (c4[1].substring(0, 1) == '1') {
                                        $("#" + idparent + ">td.note.c4").css('backgroundColor', 'rgb(0, 255, 0)');
                                    }
                                }
                            }
                        }
                    });
                });
            }
        });
        //Récupération des notes langues
        $.ajax({
            type: "POST",
            url: "gestion/recuperernotelangue",
            data: data,
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success: function (retour) {
                $('.table').each(function () {
                    $("#" + $(this).attr('id') + ' > tbody > tr').each(function () {
                        idparent = $(this).attr('id');
                        var noteid = idparent.split('-');

                        for (i = 0; i < retour.length; i++) {
                            var idindicateur = retour[i].split(' = ');
                            var aa = retour[i].split(' aa : ');
                            var ca1 = retour[i].split(' ca1 : ');
                            var ca2 = retour[i].split(' ca2 : ');
                            var ar1 = retour[i].split(' ar1 : ');
                            var ar2 = retour[i].split(' ar2 : ');
                            var ar3 = retour[i].split(' ar3 : ');
                            var c1 = retour[i].split(' c1 : ');
                            var c2 = retour[i].split(' c2 : ');
                            var c3 = retour[i].split(' c3 : ');
                            var c4 = retour[i].split(' c4 : ');
                            var l = retour[i].split(' langue : ');

                            if (noteid[1] == idindicateur[0] && noteid[2] == l[1]) {
                                if (aa[1].substring(0, 1) == '1') {
                                    $("#" + idparent + ">td.note.aa").css('backgroundColor', 'rgb(0, 255, 0)');
                                }
                                if (ca1[1].substring(0, 1) == '1') {
                                    $("#" + idparent + ">td.note.ca1").css('backgroundColor', 'rgb(0, 255, 0)');
                                }
                                if (ca2[1].substring(0, 1) == '1') {
                                    $("#" + idparent + ">td.note.ca2").css('backgroundColor', 'rgb(0, 255, 0)');
                                }
                                if (ar1[1].substring(0, 1) == '1') {
                                    $("#" + idparent + ">td.note.ar1").css('backgroundColor', 'rgb(0, 255, 0)');
                                }
                                if (ar2[1].substring(0, 1) == '1') {
                                    $("#" + idparent + ">td.note.ar2").css('backgroundColor', 'rgb(0, 255, 0)');
                                }
                                if (ar3[1].substring(0, 1) == '1') {
                                    $("#" + idparent + ">td.note.ar3").css('backgroundColor', 'rgb(0, 255, 0)');
                                }
                                if (c1[1].substring(0, 1) == '1') {
                                    $("#" + idparent + ">td.note.c1").css('backgroundColor', 'rgb(0, 255, 0)');
                                }
                                if (c2[1].substring(0, 1) == '1') {
                                    $("#" + idparent + ">td.note.c2").css('backgroundColor', 'rgb(0, 255, 0)');
                                }
                                if (c3[1].substring(0, 1) == '1') {
                                    $("#" + idparent + ">td.note.c3").css('backgroundColor', 'rgb(0, 255, 0)');
                                }
                                if (c4[1].substring(0, 1) == '1') {
                                    $("#" + idparent + ">td.note.c4").css('backgroundColor', 'rgb(0, 255, 0)');
                                }
                            }
                        }
                    });
                });
            }
        });
    }

    if(document.location.href.includes("gestion")) {
        $('.note').on('click', function () {
            //Get idIndicateurPerformance
            idTr = $(this).parent().attr('id');
            idTrSplit = idTr.split('-');
            idIndicateurPerformance = idTrSplit[1];
            idLangue = idTrSplit[2];
            //Récupère les valeurs de la ligne modifiée
            aa = 0;
            ca1 = 0;
            ca2 = 0;
            ar1 = 0;
            ar2 = 0;
            ar3 = 0;
            c1 = 0;
            c2 = 0;
            c3 = 0;
            c4 = 0;
            if ($('#' + idTr + '>.aa').css('background-color') == 'rgb(0, 255, 0)') {
                aa = 1;
            }
            if ($('#' + idTr + '>.ca1').css('background-color') == 'rgb(0, 255, 0)') {
                ca1 = 1;
            }
            if ($('#' + idTr + '>.ca2').css('background-color') == 'rgb(0, 255, 0)') {
                ca2 = 1;
            }
            if ($('#' + idTr + '>.ar1').css('background-color') == 'rgb(0, 255, 0)') {
                ar1 = 1;
            }
            if ($('#' + idTr + '>.ar2').css('background-color') == 'rgb(0, 255, 0)') {
                ar2 = 1;
            }
            if ($('#' + idTr + '>.ar3').css('background-color') == 'rgb(0, 255, 0)') {
                ar3 = 1;
            }
            if ($('#' + idTr + '>.c1').css('background-color') == 'rgb(0, 255, 0)') {
                c1 = 1;
            }
            if ($('#' + idTr + '>.c2').css('background-color') == 'rgb(0, 255, 0)') {
                c2 = 1;
            }
            if ($('#' + idTr + '>.c3').css('background-color') == 'rgb(0, 255, 0)') {
                c3 = 1;
            }
            if ($('#' + idTr + '>.c4').css('background-color') == 'rgb(0, 255, 0)') {
                c4 = 1;
            }

            note = [];
            note.push(idIndicateurPerformance + " = aa : " + aa + ", ca1 : " + ca1 + ", ca2 : " + ca2 + ", ar1 : " + ar1 + ", ar2 : " + ar2 + ", ar3 : " + ar3 + ", c1 : " + c1 + ", c2 : " + c2 + ", c3 : " + c3 + ", c4 : " + c4);

            var nom = getUser();
            var annee = getAnnee();
            if (idLangue == "") {
                var data = {
                    note: note,
                    nom: nom,
                    annee: annee
                };

                $.ajax({
                    type: "POST",
                    url: "gestion/saveTableau",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            } else {
                var data = {
                    note: note,
                    nom: nom,
                    annee: annee,
                    idLangue: idLangue
                };

                $.ajax({
                    type: "POST",
                    url: "gestion/saveTableau",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            }

        });
    }

    /**
     *  @author Ruben Veloso Paulos
     * Changement de notation affiche les étudiants de la filière pour la notation
     */
    $('#notation').change(function () {
        let data = {annee: getAnneeEtude()};
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
                getNote(retour[0].idUtilisateur, getAnnee());
                getTableau();
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

    $('#classeidcs').change(function () {
        updateDevoir();
        updateFiliereRadio();
    });
    $('#anneeidcs').change(function () {
        updateDevoir();
    });
    $('#notationidcs').change(function () {
        getOneNotation();
    });
    $('#csenvoyer').click(function () {
        saveNotation();
    });
    $('#cssupprimer').click(function () {
        supprimerNotation();
    })

    /**
     * @author Jolan Largeteau
     * Modifie la liste des devoirs selon l'année et la classe
     */
    function updateDevoir(idSelect = -1) {
        idAnneeEtude = $('#classeidcs').val();
        annee = $('#anneeidcs').val();
        data = {idAnneeEtude: idAnneeEtude, annee, annee};

        $.ajax({
            type: "POST",
            url: "cs/creation/getNotation",
            data: data,
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success: function (retour) {
                $('#notationidcs').html('<option value="-1">Nouvelle fiche de notation</option>');
                for (let i = 0; i < retour.length; i++) {
                    $('#notationidcs').append('<option value="' + retour[i].idNotation + '">' + retour[i].libelleNotation + '</option>');
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
    function getOneNotation() {
        idNotation = $('#notationidcs').val();
        if (idNotation != "-1") {
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
        data = {idAnneeEtude: classe};
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
                for (let i = 0; i < retour.length; i++) {
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
        $('.table').each(function () {
            $(this).hide();
        });
        $('#tab' + $('.choixref').val().toLowerCase()).show();
        $('#table-' + $('.choixref').val()).show();
    }

    /**
     * @author Jolan Largeteau
     * Permet de cocher les cases compétences
     */
    if ( !document.location.href.includes("gestion") ) {
        $(document).on('click', '.note', function () {
            idTR = $(this).parent().attr('id');
            idTRSplit = idTR.split('-');
            idIndicateurPerformance = idTRSplit[1];
            if ($.inArray(idIndicateurPerformance, indicateurs) !== -1) {
                $(this).css('background-color', 'white');
                indicateurs = $.grep(indicateurs, function (value) {
                    return value != idIndicateurPerformance;
                });
            } else {
                $(this).css('background-color', 'green');
                indicateurs.push(idIndicateurPerformance);
            }
        });
    }

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
                    setNotationIndicateur();
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
    if(!document.location.href.includes("gestion"))
        updateFiliereRadio();

});
