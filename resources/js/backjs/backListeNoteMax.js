$(document).ready(function() {

    $(".note").css('backgroundColor', 'rgb(255, 255, 255)');
// Affiche la table correspondante au select
    function afficheTableau() {
        $('table').hide();
        $('#table-'+$('#lesfilieres').val()).show();
    }

    function recupNote() {

// appel des notes
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
    }
// Arrivage sur la page
    afficheTableau();
    recupNote();

// Gestion de l'affichage du tableau CPI / CPRP / ...
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
        afficheTableau();
        recupNote();
    });

// Sur changement des années
    $('#lesAnnees').change(function () {
        afficheTableau();
        recupNote();
    });

// Sur click du bouton envoyer les notes
    $("#gestionNoteMaxEnvoyer").click(function () {

        /*
        *   Partie Loader
        **/
        $('body').append("<div id='loader'><div class='loading'><div class='obj'></div><div class='obj'></div><div class='obj'></div><div class='obj'></div><div class='obj'></div><div class='obj'></div><div class='obj'></div><div class='obj'></div></div></div>");

        $('.table').hide();

        var note = [];

        var idparent;

        var annee = $("#lesAnnees").val();

        var idnote;

        $('.table').each(function (index) {
            index++;
            $('#table-'+ index +' > tbody > tr').each(function () {
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
        });


        var data = {
            note: note,
            annee: annee
        };

        $.ajax({
            type: "POST",
            url: "gestionnotemax",
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function () {
                $('.table').show();
                $('div#loader').remove();
                alert("Notes enregistrées");
                afficheTableau();
                recupNote();
            }
        });
    });

// Click sur un td du tableau
    var idparent;
//********** A acquerir **********
    $('.aa').click(function() {
        idparent = $(this).parent().attr('id');

        if($(this).css('backgroundColor') == 'rgb(0, 255, 0)')
        {
            if($("#"+idparent +" .ca1").css('backgroundColor') != 'rgb(0, 255, 0)'
                && $("#"+idparent +" .ca2").css('backgroundColor') != 'rgb(0, 255, 0)'
                && $("#"+idparent +" .ar1").css('backgroundColor') != 'rgb(0, 255, 0)'
                && $("#"+idparent +" .ar2").css('backgroundColor') != 'rgb(0, 255, 0)'
                && $("#"+idparent +" .ar3").css('backgroundColor') != 'rgb(0, 255, 0)'
                && $("#"+idparent +" .c1").css('backgroundColor') != 'rgb(0, 255, 0)'
                && $("#"+idparent +" .c2").css('backgroundColor') != 'rgb(0, 255, 0)'
                && $("#"+idparent +" .c3").css('backgroundColor') != 'rgb(0, 255, 0)'
                && $("#"+idparent +" .c4").css('backgroundColor') != 'rgb(0, 255, 0)')
            {
                $(this).css('backgroundColor', 'rgb(255, 255, 255)');
            }

            else{
                $("#"+idparent +" .note").css('backgroundColor', 'rgb(255, 255, 255)');
                $("#"+idparent +" .aa").css('backgroundColor', 'rgb(0, 255, 0)');
            }
        }
        else
        {
            $("#"+idparent +" .aa").css('backgroundColor', 'rgb(0, 255, 0)');
        }
    });
//********** Cours d'acquisition 1 **********
    $('.ca1').click(function() {

        idparent = $(this).parent().attr('id');

        if($("#"+idparent +" .ca1").css('backgroundColor') == 'rgb(0, 255, 0)')
        {

            $("#"+idparent +" .ca2").css('backgroundColor', 'rgb(255, 255, 255)');
            $("#"+idparent +" .ar1").css('backgroundColor', 'rgb(255, 255, 255)');
            $("#"+idparent +" .ar2").css('backgroundColor', 'rgb(255, 255, 255)');
            $("#"+idparent +" .ar3").css('backgroundColor', 'rgb(255, 255, 255)');

            $("#"+idparent +" .c1").css('backgroundColor', 'rgb(255, 255, 255)');
            $("#"+idparent +" .c2").css('backgroundColor', 'rgb(255, 255, 255)');
            $("#"+idparent +" .c3").css('backgroundColor', 'rgb(255, 255, 255)');
            $("#"+idparent +" .c4").css('backgroundColor', 'rgb(255, 255, 255)');


            $("#"+idparent +" .ca1").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .aa").css('backgroundColor', 'rgb(0, 255, 0)');

        }
        else
        {
            $("#"+idparent +" .ca1").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .aa").css('backgroundColor', 'rgb(0, 255, 0)');
        }
    });

//********** Cours d'acquisition 2 **********
    $('.ca2').click(function() {

        idparent = $(this).parent().attr('id');

        if($("#"+idparent +" .ca2").css('backgroundColor') == 'rgb(0, 255, 0)')
        {

            $("#"+idparent +" .ca2").css('backgroundColor', 'rgb(255, 255, 255)');
            $("#"+idparent +" .ar1").css('backgroundColor', 'rgb(255, 255, 255)');
            $("#"+idparent +" .ar2").css('backgroundColor', 'rgb(255, 255, 255)');
            $("#"+idparent +" .ar3").css('backgroundColor', 'rgb(255, 255, 255)');

            $("#"+idparent +" .c1").css('backgroundColor', 'rgb(255, 255, 255)');
            $("#"+idparent +" .c2").css('backgroundColor', 'rgb(255, 255, 255)');
            $("#"+idparent +" .c3").css('backgroundColor', 'rgb(255, 255, 255)');
            $("#"+idparent +" .c4").css('backgroundColor', 'rgb(255, 255, 255)');


            $("#"+idparent +" .ca2").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .ca1").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .aa").css('backgroundColor', 'rgb(0, 255, 0)');
        }
        else
        {
            $("#"+idparent +" .ca2").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .ca1").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .aa").css('backgroundColor', 'rgb(0, 255, 0)');
        }
    });

//********** A renforcer 1 **********

    $('.ar1').click(function() {

        idparent = $(this).parent().attr('id');

        if($("#"+idparent +" .ar1").css('backgroundColor') == 'rgb(0, 255, 0)')
        {
            $("#"+idparent +" .ar2").css('backgroundColor', 'rgb(255, 255, 255)');
            $("#"+idparent +" .ar3").css('backgroundColor', 'rgb(255, 255, 255)');

            $("#"+idparent +" .c1").css('backgroundColor', 'rgb(255, 255, 255)');
            $("#"+idparent +" .c2").css('backgroundColor', 'rgb(255, 255, 255)');
            $("#"+idparent +" .c3").css('backgroundColor', 'rgb(255, 255, 255)');
            $("#"+idparent +" .c4").css('backgroundColor', 'rgb(255, 255, 255)');

        }
        else
        {
            if($("#"+idparent +" .ca2").css('backgroundColor') != 'rgb(0, 255, 0)' && $("#"+idparent +" .ca1").css('backgroundColor') == 'rgb(0, 255, 0)' )
            {
                $("#"+idparent +" .ca2").css('backgroundColor', 'rgb(0, 255, 0)');

            }
            $("#"+idparent +" .ar1").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .ca1").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .aa").css('backgroundColor', 'rgb(0, 255, 0)');
        }
    });

//********** A renforcer 2 **********

    $('.ar2').click(function() {
        idparent = $(this).parent().attr('id');

        if($("#"+idparent +" .ar2").css('backgroundColor') == 'rgb(0, 255, 0)')
        {

            $("#"+idparent +" .ar3").css('backgroundColor', 'rgb(255, 255, 255)');

            $("#"+idparent +" .c1").css('backgroundColor', 'rgb(255, 255, 255)');
            $("#"+idparent +" .c2").css('backgroundColor', 'rgb(255, 255, 255)');
            $("#"+idparent +" .c3").css('backgroundColor', 'rgb(255, 255, 255)');
            $("#"+idparent +" .c4").css('backgroundColor', 'rgb(255, 255, 255)');

        }
        else
        {
            $("#"+idparent +" .ar2").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .ca2").css('backgroundColor', 'rgb(0, 255, 0)');

            $("#"+idparent +" .ar1").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .ca1").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .aa").css('backgroundColor', 'rgb(0, 255, 0)');
        }
    });

//********** A renforcer 3 **********

    $('.ar3').click(function() {

        idparent = $(this).parent().attr('id');

        if($("#"+idparent +" .ar3").css('backgroundColor') == 'rgb(0, 255, 0)')
        {
            $("#"+idparent +" .c1").css('backgroundColor', 'rgb(255, 255, 255)');
            $("#"+idparent +" .c2").css('backgroundColor', 'rgb(255, 255, 255)');
            $("#"+idparent +" .c3").css('backgroundColor', 'rgb(255, 255, 255)');
            $("#"+idparent +" .c4").css('backgroundColor', 'rgb(255, 255, 255)');


        }
        else
        {
            $("#"+idparent +" .ar3").css('backgroundColor', 'rgb(0, 255, 0)');

            $("#"+idparent +" .ar2").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .ca2").css('backgroundColor', 'rgb(0, 255, 0)');

            $("#"+idparent +" .ar1").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .ca1").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .aa").css('backgroundColor', 'rgb(0, 255, 0)');
        }
    });

//********** Confirme 1 **********

    $('.c1').click(function() {

        idparent = $(this).parent().attr('id');

        if($("#"+idparent +" .c1").css('backgroundColor') == 'rgb(0, 255, 0)')
        {
            $("#"+idparent +" .c2").css('backgroundColor', 'rgb(255, 255, 255)');
            $("#"+idparent +" .c3").css('backgroundColor', 'rgb(255, 255, 255)');
            $("#"+idparent +" .c4").css('backgroundColor', 'rgb(255, 255, 255)');

        }
        else
        {
            if($("#"+idparent +" .ca2").css('backgroundColor') != 'rgb(0, 255, 0)' && $("#"+idparent +" .ca1").css('backgroundColor') == 'rgb(0, 255, 0)' )
            {
                $("#"+idparent +" .ca2").css('backgroundColor', 'rgb(0, 255, 0)');

            }

            if($("#"+idparent +" .ar3").css('backgroundColor') != 'rgb(0, 255, 0)' && $("#"+idparent +" .ar2").css('backgroundColor') == 'rgb(0, 255, 0)' )
            {
                $("#"+idparent +" .ar3").css('backgroundColor', 'rgb(0, 255, 0)');

            }

            if($("#"+idparent +" .ar2").css('backgroundColor') != 'rgb(0, 255, 0)' && $("#"+idparent +" .ar1").css('backgroundColor') == 'rgb(0, 255, 0)' )
            {
                $("#"+idparent +" .ar2").css('backgroundColor', 'rgb(0, 255, 0)');

            }



            $("#"+idparent +" .c1").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .ar1").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .ca1").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .aa").css('backgroundColor', 'rgb(0, 255, 0)');
        }
    });


//********** Confirme 2 **********

    $('.c2').click(function() {

        idparent = $(this).parent().attr('id');

        if($("#"+idparent +" .c2").css('backgroundColor') == 'rgb(0, 255, 0)')
        {
            $("#"+idparent +" .c3").css('backgroundColor', 'rgb(255, 255, 255)');
            $("#"+idparent +" .c4").css('backgroundColor', 'rgb(255, 255, 255)');

        }
        else
        {

            if($("#"+idparent +" .ar3").css('backgroundColor') != 'rgb(0, 255, 0)' && $("#"+idparent +" .ar2").css('backgroundColor') == 'rgb(0, 255, 0)' )
            {
                $("#"+idparent +" .ar3").css('backgroundColor', 'rgb(0, 255, 0)');

            }


            $("#"+idparent +" .c1").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .c2").css('backgroundColor', 'rgb(0, 255, 0)');

            $("#"+idparent +" .ar1").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .ar2").css('backgroundColor', 'rgb(0, 255, 0)');

            $("#"+idparent +" .ca1").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .ca2").css('backgroundColor', 'rgb(0, 255, 0)');

            $("#"+idparent +" .aa").css('backgroundColor', 'rgb(0, 255, 0)');
        }
    });

//********** Confirme 3 **********

    $('.c3').click(function() {

        idparent = $(this).parent().attr('id');

        if($("#"+idparent +" .c3").css('backgroundColor') == 'rgb(0, 255, 0)')
        {

            $("#"+idparent +" .c4").css('backgroundColor', 'rgb(255, 255, 255)');
        }
        else
        {
            $("#"+idparent +" .c1").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .c2").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .c3").css('backgroundColor', 'rgb(0, 255, 0)');

            $("#"+idparent +" .ar1").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .ar2").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .ar3").css('backgroundColor', 'rgb(0, 255, 0)');

            $("#"+idparent +" .ca1").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .ca2").css('backgroundColor', 'rgb(0, 255, 0)');

            $("#"+idparent +" .aa").css('backgroundColor', 'rgb(0, 255, 0)');
        }
    });

    $('.c4').click(function() {

        idparent = $(this).parent().attr('id');

        if($("#"+idparent +" .c4").css('backgroundColor') == 'rgb(0, 255, 0)')
        {

        }
        else
        {
            $("#"+idparent +" .c1").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .c2").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .c3").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .c4").css('backgroundColor', 'rgb(0, 255, 0)');

            $("#"+idparent +" .ar1").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .ar2").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .ar3").css('backgroundColor', 'rgb(0, 255, 0)');

            $("#"+idparent +" .ca1").css('backgroundColor', 'rgb(0, 255, 0)');
            $("#"+idparent +" .ca2").css('backgroundColor', 'rgb(0, 255, 0)');

            $("#"+idparent +" .aa").css('backgroundColor', 'rgb(0, 255, 0)');
        }
    });


});
