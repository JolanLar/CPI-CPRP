$(document).ready(function () {
    // Sur changement <select> de classe
    $("#lyceeclasse").change(function () {
        classeChange();
    });

    // function ajax qui rempli les étudiants en fonction de la classe séléctionné
    function classeChange() {
        $(".note").css('backgroundColor', 'rgb(255, 255, 255)');
        var classe = $("#lyceeclasse").val();
        var data = { classe: classe };
        $.ajax({
            type: "POST",
            url: "tls/liste",
            data: data,
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (retour) {

                $("#etudiantidtls").empty();
                if (retour == '') {
                    $('.table-filiere').each(function() {
                        $(this).css('display', 'none');
                    });
                    $("#etudiantidtls").append("<option>Aucun étudiant</option>");
                }
                else {
                    $("#etudiantidtls").empty();
                    for (var i = 0; i < retour.length; i++) {
                        $("#etudiantidtls").append("<option value='" + retour[i].idUtilisateur + "'>"  + retour[i].idUtilisateur + " : " + retour[i].Nom + " - " + retour[i].Prenom + "</option>");
                    }
                    $("#etudiantidtls").trigger("change");
                }
            }
        });
    }


    // Changement du <select> étudiant
    $("#etudiantidtls").change(function () {
        $(".note").css('backgroundColor', 'rgb(255, 255, 255)');
        // variables
        var nom = $("#etudiantidtls").val().split(" : ");
        var annee = $("#anneidtls").val();
        var data = { nom: nom[0], annee: annee };
        var data2 = {idUtilisateur: nom[0]};


        //Récupération des filières
        $.ajax({
            type: "POST",
            url: "tls/recupererfil",
            data: data2,
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success: function (retour) {
                $('.lechoix').html('');
                for (var i = 0; i < retour.length; i++) {
                    if (i == 0) {
                        $('.lechoix').append('<input type="radio" class="choixref" name="choixref" value="' + retour[i].idFiliere + '" checked="checked">&nbsp');
                    } else {
                        $('.lechoix').append('<input type="radio" class="choixref" name="choixref" value="' + retour[i].idFiliere + '">&nbsp');
                    }
                    $('.lechoix').append('<label for="' + retour[i].libelleFiliere + '">' + retour[i].libelleFiliere + '</label>&nbsp');
                }
                $('.table').each(function(){
                    $(this).hide();
                });
                $('#tab'+$('.choixref').val().toLowerCase()).show();
                $('#table-'+$('.choixref').val()).show();
            }
        });

        //Récupération des notes
        $.ajax({
            type: "POST",
            url: "tls/recuperernote",
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

                        for (i = 1; i < retour.length; i++) {
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
                    });
                });
            }
        });
    }).change();

    $('.aa').click(function() {

        isChecked = $(this).val();
        alert(isChecked);

        idTr = $(this).parent().attr('id');
        idTrSplit = idTr.split('-');
        idIndicateurPerformance = idTrSplit[1];
        alert(idIndicateurPerformance);


    });

});


