$(document).ready(function () {
    $("#lyceeclasse").change(function () {
        classeChange();
    });
    classeChange();

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
                    $("#etudiantidtls").append("<option>Aucun étudiant</option>");

                }
                else {
                    $('.table-filiere').each(function() {
                        $(this).css('display', 'none');
                    });
                    $('#'+retour[0]['idFiliere']).css('display', 'block');
                    $("#etudiantidtls").empty();
                    for (var i = 0; i < retour.length; i++) {
                        $("#etudiantidtls").append("<option>" + retour[i].idUtilisateur + " : " + retour[i].Nom + " - " + retour[i].Prenom + "</option>");
                    }
                    $("#etudiantidtls").change();
                }
            }
        });
    }


    $("#anneidtls").change(function () {
        $("#etudiantidtls").change();
    });

    $("#etudiantidtls").change(function () {
        $(".note").css('backgroundColor', 'rgb(255, 255, 255)');
        var nom = $("#etudiantidtls").val().split(" : ");
        var annee = $("#anneidtls").val();

        var data = { nom: nom[0], annee: annee };
        $.ajax({
            type: "POST",
            url: "tls/recuperernote",
            data: data,
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (retour) {
                $('#table-' + retour[0] + ' > tbody > tr').each(function () {
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
            }
        });
    }).change();

    $("#tlsenvoyer").click(function () {
        var note = [];

        var idparent;
        var nom = $("#etudiantidtls").val().split(" : ");
        var annee = $("#anneidtls").val();
        var idnote;

        $('#table-1 > tbody > tr').each(function () {

            idparent = $(this).attr('id');

            if ($("#" + idparent + ">td.note.aa").css('backgroundColor') == 'rgb(0, 255, 0)') {
                aa = 1;
            }
            else {
                aa = 0;
            }

            if ($("#" + idparent + ">td.note.ca1").css('backgroundColor') == 'rgb(0, 255, 0)') {

                ca1 = 1;
            }
            else {
                ca1 = 0;
            }
            if ($("#" + idparent + ">td.note.ca2").css('backgroundColor') == 'rgb(0, 255, 0)') {
                ca2 = 1;
            }
            else {
                ca2 = 0;
            }
            if ($("#" + idparent + ">td.note.ar1").css('backgroundColor') == 'rgb(0, 255, 0)') {
                ar1 = 1;
            }
            else {
                ar1 = 0;
            }
            if ($("#" + idparent + ">td.note.ar2").css('backgroundColor') == 'rgb(0, 255, 0)') {
                ar2 = 1;
            }
            else {
                ar2 = 0;
            }
            if ($("#" + idparent + ">td.note.ar3").css('backgroundColor') == 'rgb(0, 255, 0)') {
                ar3 = 1;
            }
            else {
                ar3 = 0;
            }
            if ($("#" + idparent + ">td.note.c1").css('backgroundColor') == 'rgb(0, 255, 0)') {
                c1 = 1;
            }
            else {
                c1 = 0;
            }
            if ($("#" + idparent + ">td.note.c2").css('backgroundColor') == 'rgb(0, 255, 0)') {
                c2 = 1;
            }
            else {
                c2 = 0;
            }
            if ($("#" + idparent + ">td.note.c3").css('backgroundColor') == 'rgb(0, 255, 0)') {
                c3 = 1;
            }
            else {
                c3 = 0;
            }
            if ($("#" + idparent + ">td.note.c4").css('backgroundColor') == 'rgb(0, 255, 0)') {
                c4 = 1;
            }
            else {
                c4 = 0;
            }

            idnote = idparent.split('-');
            note.push(idnote[1] + " = aa : " + aa + ", ca1 : " + ca1 + ", ca2 : " + ca2 + ", ar1 : " + ar1 + ", ar2 : " + ar2 + ", ar3 : " + ar3 + ", c1 : " + c1 + ", c2 : " + c2 + ", c3 : " + c3 + ", c4 : " + c4);
        });

        $('#table-2 > tbody > tr').each(function () {

            idparent = $(this).attr('id');

            if ($("#" + idparent + ">td.note.aa ").css('backgroundColor') == 'rgb(0, 255, 0)') {
                aa = 1;
            }
            else {
                aa = 0;
            }

            if ($("#" + idparent + ">td.note.ca1 ").css('backgroundColor') == 'rgb(0, 255, 0)') {
                ca1 = 1;
            }
            else {
                ca1 = 0;
            }
            if ($("#" + idparent + ">td.note.ca2 ").css('backgroundColor') == 'rgb(0, 255, 0)') {
                ca2 = 1;
            }
            else {
                ca2 = 0;
            }
            if ($("#" + idparent + ">td.note.ar1 ").css('backgroundColor') == 'rgb(0, 255, 0)') {
                ar1 = 1;
            }
            else {
                ar1 = 0;
            }
            if ($("#" + idparent + ">td.note.ar2 ").css('backgroundColor') == 'rgb(0, 255, 0)') {
                ar2 = 1;
            }
            else {
                ar2 = 0;
            }
            if ($("#" + idparent + ">td.note.ar3 ").css('backgroundColor') == 'rgb(0, 255, 0)') {
                ar3 = 1;
            }
            else {
                ar3 = 0;
            }
            if ($("#" + idparent + ">td.note.c1 ").css('backgroundColor') == 'rgb(0, 255, 0)') {
                c1 = 1;
            }
            else {
                c1 = 0;
            }
            if ($("#" + idparent + ">td.note.c2 ").css('backgroundColor') == 'rgb(0, 255, 0)') {
                c2 = 1;
            }
            else {
                c2 = 0;
            }
            if ($("#" + idparent + ">td.note.c3 ").css('backgroundColor') == 'rgb(0, 255, 0)') {
                c3 = 1;
            }
            else {
                c3 = 0;
            }
            if ($("#" + idparent + ">td.note.c4 ").css('backgroundColor') == 'rgb(0, 255, 0)') {
                c4 = 1;
            }
            else {
                c4 = 0;
            }

            idnote = idparent.split('-');

            note.push(idnote[1] + " = aa : " + aa + ", ca1 : " + ca1 + ", ca2 : " + ca2 + ", ar1 : " + ar1 + ", ar2 : " + ar2 + ", ar3 : " + ar3 + ", c1 : " + c1 + ", c2 : " + c2 + ", c3 : " + c3 + ", c4 : " + c4);
        });

        var data = {
            note: note,
            nom: nom[0],
            annee: annee
        };

        $.ajax({
            type: "POST",
            url: "tls",
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function () {
                alert("Notes enregistrées");
            }
        });
    });
});
