/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {

	$("#lyceefilieredonnee").change(function()
	{
		$("#libelledonnee").val("");
		$("#numdonnee").val("");

		$("#selectcddonnee").html("<option disabled>Compétence détaillée</option>");

        var filiere = $("#lyceefilieredonnee").val();
        var data = { filiere : filiere };
        $.ajax({
            type: "POST",
            url: 'gestiondonnee/liste',
            data: data,
            headers:
			{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(retour)
			{
				for(var i=0;i<retour.length;i++)
				{
					$("#selectcddonnee").append("<option>"+retour[i].idCompetenceDetaillee+" - "+retour[i].libelleCompetenceDetaillee+"</option>");
				}
                $("#selectcddonnee").change();
			}
        });
	});


	$("#selectcddonnee").change(function()
	{
        $("#libelledonnee").text("");
        $("#numdonnee").text("");

        var filiere = $("#lyceefilieredonnee").val();
        var idcd = $("#selectcddonnee").text().split(' - ');

        var data = { filiere : filiere, idcd : idcd[0] };
		$.ajax({
            type: "POST",
            url: 'gestiondonnee/donnee',
            data: data,
            headers:
			{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(retour)
			{
				$("#selectcddonneeassociee").val(retour.idDonnee);
				$("#libelledonnee").val(retour.libelleDonnee);
				$("#numdonnee").val(retour.idDonnee);
            }
        });
    }).change();
    

	$("#selectcddonneeassociee").change(function()
	{
		if($("#selectcddonneeassociee").val() == "Nouvelle donnée")
		{
			$("#numdonnee").val("");
            $("#libelledonnee").text("");
		}
		else
		{
            var idDonnee = $("#selectcddonneeassociee option:selected").text().split(" - ");
            $("#numdonnee").val(idDonnee[0]);
            $("#libelledonnee").val(idDonnee[1]);
        }
    }).change();
});
