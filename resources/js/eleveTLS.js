$(document).ready(function () {

    /**
     * Sert pour afficher les tables en fonction des radios
     */
    $('select, .lechoix').each(function (e) {

        if( $(this).is( "select" ) ) {
            $(this).find(">:first-child").attr('selected', 'selected');
        } else {
            $(this).find(">:first-child").prop('checked', true);
        }

    });

    var i = 0;
    $('.table').each(function(){
        if(i!=0&&i!=1){
            $(this).hide();
        }
        i++;
    });

    $(".choixref").change(function()
    {
        $('.table').each(function(){
            $(this).hide();
        });
        $('#tab'+$(this).val().toLowerCase()).show();
        $('#table-'+$(this).val()).show();
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


    $(".note").css('backgroundColor', 'rgb(255, 255, 255)');
    var nom = $("#idUtilisateur").text();
    var data = { nom: nom };

    $.ajax({
        type: "POST",
        url: "recuperernote",
        data: data,
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (retour) {
            // Chaque table
            $('.table').each(function () {
                // Chaque tr
                $("#" + $(this).attr('id') + ' > tbody > tr').each(function () {
                    // le <tr> actuel
                    let idparent = $(this).attr('id');
                    let noteid = idparent.split('-');

                    console.log(retour)

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

    //Récupération des notes langues
    $.ajax({
        type: "POST",
        url: "recuperernotelangue",
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

                        if (noteid[1] == idindicateur[0] && noteid[2]==l[1]) {
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


});

