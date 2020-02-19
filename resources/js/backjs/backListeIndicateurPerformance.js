
$(document).ready(function() {

	$("#lyceefiliereindicateurperformance").change(function()
	{
		$("#libelleindicateurperformance").val("");
		$("#selectindicateurperformance").html("<option>Nouvel indicateur de performance</option>");
		$("#selectcdindicateurperformance").html("<option disabled>Compétence détaillée</option>");

		var filiere = $("#lyceefiliereindicateurperformance").val();
		var data = { filiere : filiere };
		//Mise à jour de la liste des compétences détaillées
        $.ajax({
            type: "POST",
            url: 'gestionindicateurperformance/liste1',
            data: data,
            headers:
			{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(retour)
			{
				for(var i=0;i<retour.length;i++)
				{
					$("#selectcdindicateurperformance").append("<option value='"+retour[i].idCompetenceDetaillee+"'>"+retour[i].idCompetenceDetaillee+" - "+retour[i].libelleCompetenceDetaillee+"</option>");
				}
				//Mise à jour de la liste des indicateurs de performances
				var compd = retour[0].idCompetenceDetaillee;
				var data = {filiere : filiere, competenced: compd}
				$.ajax({
					type: "POST",
					url: 'gestionindicateurperformance/liste2',
					data: data,
					headers:
					{
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					success: function(retour)
					{
						for(var i=0;i<retour.length;i++)
						{
							$("#selectindicateurperformance").append("<option value='"+retour[i].idIndicateurPerformance+"'>"+retour[i].libelleIndicateurPerformance+"</option>");
						}
					}
				})
            }
		});
	});

	$("#selectcdindicateurperformance").change(function()
	{
		$("#libelleindicateurperformance").val("");
		var filiere = $("#lyceefiliereindicateurperformance").val();
		var competenced = $("#selectcdindicateurperformance").val().split(" - ");
		$("#selectindicateurperformance").html("<option>Nouvel indicateur de performance</option>");

        var data = { competenced : competenced[0], filiere : filiere };
		$.ajax({
            type: "POST",
            url: 'gestionindicateurperformance/liste2',
            data: data,
            headers:
			{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(retour)
			{
				for(var i=0;i<retour.length;i++)
				{
					$("#selectindicateurperformance").append("<option>"+retour[i].libelleIndicateurPerformance+"</option>");
				}
            }
        });
	});

	$("#selectindicateurperformance").change(function()
	{
		$("#libelleindicateurperformance").val($("#selectindicateurperformance option:selected").text());
		$("#ancienlibelle").val($("#libelleindicateurperformance").val());

		if($("#selectindicateurperformance").val() == "Nouvel indicateur de performance")
		{
			$("#libelleindicateurperformance").val("");
			$("#ancienlibelle").val("");
		}
	});

	$("#boutonsupprimerindicateur").click(function()
	{
		var supprimer = confirm("Voulez-vous supprimer cet indicateur de performance ?");

		if(supprimer)
		{
			var lafiliere = $('#lyceefiliereindicateurperformance').val();
			var comp =  $("#selectcdindicateurperformance").val();
			var data = { idCompetenceDetaillee : comp, filiere : lafiliere};
			$.ajax({
				type: "POST",
				url: 'gestionindicateurperformance/supprimer',
				data: data,
				headers:
				{
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success: function(retour)
				{
					alert("Indicateur de performance supprimé");
					location.reload();
				}
			});
		}
	});
});
