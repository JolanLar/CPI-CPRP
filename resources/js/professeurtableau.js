$(document).ready(function (){

    var i =1;
    var j =1;
    var k =1;

    $('#cprp > tbody > tr').each(function(){

        idparent = $(this).attr('id');
        var noteid = idparent.split('-');
        var idint = parseInt(noteid[1]-i);
        var idint2 = parseInt(noteid[1]-j);
        var idint3 = parseInt(noteid[1]-k);

        //COMPETENCE
        if($("#"+ idparent + ">.competence").text()== $("#"+ noteid[0]+"-"+idint + ">.competence").text())
        {
            $("#"+ idparent + ">.competence").remove();
            i++;
            $("#"+ noteid[0]+"-"+idint + ">.competence").attr('rowspan',i);
            console.log("#"+ noteid[0]+"-"+idint);
        }
        else
        {
            i=1;
        }
        //DONNEE
        if($("#"+ idparent + ">.donnee").text()== $("#"+ noteid[0]+"-"+idint2 + ">.donnee").text())
        {
            $("#"+ idparent + ">.donnee").remove();
            j++;
            $("#"+ noteid[0]+"-"+idint2 + ">.donnee").attr('rowspan',j);
        }
        else
        {
            j=1;
        }

        //COMP DETA
        if($("#"+ idparent + ">.competencedet").text()== $("#"+ noteid[0]+"-"+idint3 + ">.competencedet").text())
        {
            $("#"+ idparent + ">.competencedet").remove();
            k++;
            $("#"+ noteid[0]+"-"+idint3 + ">.competencedet").attr('rowspan',k);
        }
        else
        {
            k=1;
        }

    });

    $('#cpi > tbody > tr').each(function(){

        idparent = $(this).attr('id');
        var noteid = idparent.split('-');
        var idint = parseInt(noteid[1]-i);
        var idint2 = parseInt(noteid[1]-j);
        var idint3 = parseInt(noteid[1]-k);

        //COMPETENCE
        if($("#"+ idparent + ">.competence").text()== $("#"+ noteid[0]+"-"+idint + ">.competence").text())
        {
            $("#"+ idparent + ">.competence").remove();
            i++;
            $("#"+ noteid[0]+"-"+idint + ">.competence").attr('rowspan',i);
        }
        else
        {
            i=1;
        }
        //DONNEE
        if($("#"+ idparent + ">.donnee").text()== $("#"+ noteid[0]+"-"+idint2 + ">.donnee").text())
        {
            $("#"+ idparent + ">.donnee").remove();
            j++;
            $("#"+ noteid[0]+"-"+idint2 + ">.donnee").attr('rowspan',j);
        }
        else
        {
            j=1;
        }

        //COMP DETA
        if($("#"+ idparent + ">.competencedet").text()== $("#"+ noteid[0]+"-"+idint3 + ">.competencedet").text())
        {
            $("#"+ idparent + ">.competencedet").remove();
            k++;
            $("#"+ noteid[0]+"-"+idint3 + ">.competencedet").attr('rowspan',k);
        }
        else
        {
            k=1;
        }

    });
    if(navigator.userAgent.indexOf("Chrome")!== -1)
    {
        $('.sticky-table').stickyTableHeader();
    }
});


