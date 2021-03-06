$(document).ready(function () {

    var i = $("#numcomp").val();
    $("#plus").click(function () {
        i++;
        $("#numcomp").val(i);
    });


    $("#moins").click(function () {
        if (i > 1) {
            i--;
            $("#numcomp").val(i);
        }
    });

    /**
     * Sert à l'impression de l'histogramme et radar
     * */
    $('#print').click(function () {
        var canvas=document.getElementsByTagName("canvas");
        var win=window.open();
        $.each(canvas, function (key) {
            win.document.write("<br><img src='"+canvas[key].toDataURL()+"'/>");
        });
        win.print();
        win.close();
    });

    /**
     * Set à l'impression des pages rtc / rcs / cs
     */
    $('#print_prof').click(function () {

        var restorepage = $('body').html();
        var printcontent = $('table:visible').clone();
        var enteredtext = $('#text').val();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
        $('#text').html(enteredtext);
        window.close();
    });

    if ( document.location.href.includes("livret") ) {
        var nom = $("#idUtilisateur").text();
        var data = {nom: nom};
        $.ajax({
            type: "POST",
            url: "livret/recupNote",
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
    } else if ( document.location.href.includes("vr") ) {
        $("#lyceeclasse").change(function () {
            classeChangeVr();
        }).change();
        // function ajax qui rempli les étudiants en fonction de la classe séléctionné
        function classeChangeVr() {
            $(".note").css('backgroundColor', 'rgb(255, 255, 255)');
            var classe = $("#lyceeclasse").val();
            var data = { classe: classe };
            $.ajax({
                type: "POST",
                url: "vr/liste",
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
                    }
                }
            });
        }
        $('#lyceeclasse').trigger('change');
    }
});



