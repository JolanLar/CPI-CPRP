
$(document).ready(function() {

	$("#lyceefilierecompetence").change(function()
	{
		$("#idlacompetence").val("");
		$("#libellelacompetence").val("");
		$("#selectcompetence").html("<option>Nouvelle compétence</option>");

        var filiere = $("#lyceefilierecompetence").val();

        var data = { filiere : filiere };
		$.ajax({
            type: "POST",
            url: 'gestioncompetence/liste',
            data: data,
            headers:
			{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(retour)
			{
				for(var i=0;i<retour.length;i++)
				{
					$("#selectcompetence").append("<option>"+retour[i].idCompetence+" - "+retour[i].libelleCompetence+"</option>");
				}

			}
        });
	});

	$("#selectcompetence").change(function()
	{
		var competence = $("#selectcompetence").val();
		var idcompetence = competence.split(' - ');
		if(competence === "Nouvelle compétence")
		{
			$("#idlacompetence").val("");
			$("#libellelacompetence").val("");
		}
		else
		{
			$("#idlacompetence").val(idcompetence[0].substring(1,4));
			$("#libellelacompetence").val(idcompetence[1]);
		}

	});

    $("#boutonsupprimercompetence").click(function()
	{
        var supprimer = confirm("Voulez-vous supprimer cette compétence et toutes les compétences détaillées associées ?");
        var lafiliere = $('#lyceefilierecompetence').val();

        if(supprimer)
        {
            var competence = "C" ;
            competence += $("#idlacompetence").val();
			var data = { idCompetence : competence, filiere : lafiliere };
			$.ajax({
                type: "POST",
                url: 'gestioncompetence/supprimer',
                data: data,
                headers:
				{
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(retour)
                {
                    alert("Compétence et compétences détaillées supprimées");
                    location.reload();
                }

            });
        }
    });
});
