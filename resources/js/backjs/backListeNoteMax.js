$(document).ready(function() {

    var i = 1;
    var j = 1;
    var k = 1;
    var idind = 0;
    var idind2 = 0;
    var idind3 = 0;
    $('.table').each(function () {
        var lib = $(this).attr('id');
        $( '#' + lib + ' > tbody > tr').each(function () {
            idparent = $(this).attr('id');
            var noteid = idparent.split('-');

            //COMPETENCE
            if ($("#" + idparent + ">.competence").text() == $("#" + noteid[0] + "-" + idind + ">.competence").text()) {
                $("#" + idparent + ">.competence").remove();
                i++;
                $("#" + noteid[0] + "-" + idind + ">.competence").attr('rowspan', i);
            } else {
                i = 1;
                idind = noteid[1];
            }
            //DONNEE
            if ($("#" + idparent + ">.donnee").text() == $("#" + noteid[0] + "-" + idind2 + ">.donnee").text()) {
                $("#" + idparent + ">.donnee").remove();
                j++;
                $("#" + noteid[0] + "-" + idind2 + ">.donnee").attr('rowspan', j);
            } else {
                j = 1;
                idind2 = noteid[1];
            }

            //COMP DETA
            if ($("#" + idparent + ">.competencedet").text() == $("#" + noteid[0] + "-" + idind3 + ">.competencedet").text()) {
                $("#" + idparent + ">.competencedet").remove();
                k++;
                $("#" + noteid[0] + "-" + idind3 + ">.competencedet").attr('rowspan', k);
            } else {
                k = 1;
                idind3 = noteid[1];
            }

        });
    });
    if (navigator.userAgent.indexOf("Chrome") !== -1) {
        $('.sticky-table').stickyTableHeader();
    }


// Sur changement des filières
    $('#lesfilieres').change(function () {


        $(".note").css('backgroundColor', 'rgb(255, 255, 255)');
        var annee = $("#lesAnnees").val();
        var filiere = $('#lesfilieres').val();

        var data = { annee: annee, filiere: filiere };

        $.ajax({
            type: 'POST',
            url: "gestionnotemax/recup",
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


    });

// Sur changement des années
    $('#lesAnnees').change(function () {


        $(".note").css('backgroundColor', 'rgb(255, 255, 255)');
        var annee = $("#lesAnnees").val();
        var filiere = $('#lesfilieres').val();

        var data = { annee: annee, filiere: filiere };

        $.ajax({
            type: 'POST',
            url: "gestionnotemax/recup",
            data: data,
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success: function (retour) {
                alert(retour);
            }
        });

    });


});
