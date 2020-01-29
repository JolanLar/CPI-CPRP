$(document).ready(function () {
    var nbFiliere = $('.table-filiere').length;

    var i = 1;
    var j = 1;
    var k = 1;
    var idind = 0;
    var idind2 = 0;
    var idind3 = 0;
    for (x = 1; x <= nbFiliere; x++) {
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
    }
    if (navigator.userAgent.indexOf("Chrome") !== -1) {
        $('.sticky-table').stickyTableHeader();
    }
});


