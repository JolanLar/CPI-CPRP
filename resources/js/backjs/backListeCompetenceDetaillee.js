
$(document).ready(function() {

	$("#lyceefilierecompetencedetaillee").change(function()
	{
        $("#idlacompetence1").val("");
        $("#idlacompetence2").val("");
        $("#libellelacompetencedetaillee").val("");
        $("#selectcompetencedetaillee").html("<option>Nouvelle compétence détaillée</option>");
        var filiere = $("#lyceefilierecompetencedetaillee").val();
        var data = { filiere : filiere };
		$.ajax({
            type: "POST",
            url: 'gestioncompetencedetaillee/liste',
            data: data,
            headers:
			{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(retour)
			{
				for(var i=0;i<retour.length;i++)
				{
					$("#selectcompetencedetaillee").append("<option>"+retour[i].idCompetenceDetaillee+" - "+retour[i].libelleCompetenceDetaillee+"</option>");
				}
            }
        });
	});

	$("#selectcompetencedetaillee").change(function()
	{

		var competence = $("#selectcompetencedetaillee").val();
		var idcompetence = competence.split(' - ');
		var idcompetencedetaille = idcompetence[0].split('.');

		if(competence === "Nouvelle compétence détaillée")
		{
			$("#idlacompetence1").val("");
			$("#idlacompetence2").val("");
			$("#libellelacompetencedetaillee").val("");
		}
		else
		{
			$("#idlacompetence1").val(idcompetencedetaille[0]);
			$("#idlacompetence2").val(idcompetencedetaille[1]);
			$("#libellelacompetencedetaillee").val(idcompetence[1]);
		}

	});

	$("#boutonsupprimercompetencedetaillee").click(function()
    {
        var supprimer = confirm("Voulez-vous supprimer cette compétence détaillée ?");
        var lafiliere = $('#lyceefilierecompetencedetaillee').val();

        if(supprimer)
        {
            var competencedetaillee = "C" + $("#idlacompetence1").val() + "." + $("#idlacompetence2").val();
			var data = { idCompetencedetaillee : competencedetaillee, filiere : lafiliere };
            $.ajax({
				type: "POST",
				url: 'gestioncompetencedetaillee/supprimer',
				data: data,
				headers:
				{
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success: function(retour)
				{
					alert("Compétence détaillée supprimée");
					location.reload();
                }

            });
        }
    });
});
