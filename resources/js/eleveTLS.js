$(document).ready(function () {


    $(".note").css('backgroundColor', 'rgb(255, 255, 255)');
    var nom = $("#idUtilisateur").text();

    var data = { nom: nom };
    $.ajax({
        type: "POST",
        url: "eleve/recuperernote",
        data: data,
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (retour) {
            $('#table-1 > tbody > tr').each(function () {
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

});

