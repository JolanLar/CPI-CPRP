$(document).ready(function () {

    var i = 1;
    var j = 1;
    var k = 1;
    var l = 1;
    var idind = 0;
    var idind2 = 0;
    var idind3 = 0;
    var idindl = 0;
    var idind2l = 0;
    var idind3l = 0;
    var idind4 = 0;
    var idind4l = "";
    // pour chaque table
        $('.table').each(function () {
            // nom de la table
            var lib = $(this).attr('id');
            // Chaque tr de la table
            $( '#' + lib + ' > tbody > tr').each(function () {
                // id du tr
                idparent = $(this).attr('id');
                var noteid = idparent.split('-');
                //COMPETENCE
                if ($("#" + idparent + ">.competence").text() == $("#" + noteid[0] + "-" + idind + "-" + idindl + " >.competence").text()) {
                    $("#" + idparent + ">.competence").remove();
                    i++;
                    $("#" + noteid[0] + "-" + idind + "-" + idindl + ">.competence").attr('rowspan', i);
                } else {
                    i = 1;
                    idind = noteid[1];
                    idindl = noteid[2];
                }
                //DONNEE
                if ($("#" + idparent + ">.donnee").text() == $("#" + noteid[0] + "-" + idind2 + "-" + idind2l + " >.donnee").text()) {
                    $("#" + idparent + ">.donnee").remove();
                    j++;
                    $("#" + noteid[0] + "-" + idind2 + "-" + idind2l + ">.donnee").attr('rowspan', j);
                } else {
                    j = 1;
                    idind2 = noteid[1];
                    idind2l = noteid[2];
                }

                //COMP DETA
                if ($("#" + idparent + ">.competencedet").text() == $("#" + noteid[0] + "-" + idind3 + "-" + idind3l + " >.competencedet").text()) {
                    $("#" + idparent + ">.competencedet").remove();
                    k++;
                    $("#" + noteid[0] + "-" + idind3 + "-" + idind3l + ">.competencedet").attr('rowspan', k);
                } else {
                    k = 1;
                    idind3 = noteid[1];
                    idind3l = noteid[2];
                }

                //INDICATEUR PERF
                if ($("#" + idparent + ">.indicateur").text() == $("#" + noteid[0] + "-" + idind4 + "-" + idind4l + ">.indicateur").text()) {
                    $("#" + idparent + ">.indicateur").remove();
                    l++;
                    $("#" + noteid[0] + "-" + idind4 + "-" + idind4l + ">.indicateur").attr('rowspan', l);
                } else {
                    l = 1;
                    idind4 = noteid[1];
                    idind4l = noteid[2];
                }
            });
        });
    if (navigator.userAgent.indexOf("Chrome") !== -1) {
        $('.sticky-table').stickyTableHeader();
    }
});


