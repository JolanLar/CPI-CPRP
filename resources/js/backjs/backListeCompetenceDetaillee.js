
$(document).ready(function() {

	$("#lyceefilierecompetencedetaillee").change(function()
	{
        $("#idlacompetence1").val("");
        $("#idlacompetence2").val("");
        $("#libellelacompetencedetaillee").val("");
        $("#selectcompetencedetaillee").html("<option value='-1'>Nouvelle compétence détaillée</option>");
		$("#idlacompetence1").html("<option value='-1'>Choix de la compétence</option>");
        var filiere = $("#lyceefilierecompetencedetaillee").val();
		var data = { filiere : filiere };
		//Mise à jour de la liste des compétences détaillés
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
		//Mise a jour de la liste des compétences
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
					$("#idlacompetence1").append("<option>"+retour[i].idCompetence+"</option>");
				}
            }
		});
	});

	$("#selectcompetencedetaillee").change(function()
	{

		var competence = $("#selectcompetencedetaillee").val();
		var idcompetence = competence.split(' - ');
		var idcompetencedetaille = idcompetence[0].split('.');

		if(competence === "-1")
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

        if(supprimer)
        {
			var lafiliere = $('#lyceefilierecompetencedetaillee').val();
            var competencedetaillee = $("#idlacompetence1").val() + "." + $("#idlacompetence2").val();
			var data = { idCompetencedetaillee : competencedetaillee, idFiliere : lafiliere };
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
					$('#lyceefilierecompetencedetaillee').trigger('change');
                }

            });
        }
	});

	$('#idlacompetence1').change(function () {
		var filiere = $("#lyceefilierecompetencedetaillee").val();
		var comp = $('#idlacompetence1').val() + '.' + $('#idlacompetence2').val();
		var data = { filiere: filiere };
		$.ajax({
			type: "POST",
			url: 'gestioncompetencedetaillee/liste',
			data: data,
			headers:
			{
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function (retour) {
				var find = false;
				for(var i = 0; i<retour.length; i++){
					if(retour[i].idCompetenceDetaillee==comp){
						find = true;
						$('#selectcompetencedetaillee').val(comp);
						$('#libellelacompetencedetaillee').val(retour[i].libelleCompetenceDetaillee);
					}
				}
				if(!find){
					$('#selectcompetencedetaillee').val('-1');
				}
			}
		});
	});

	$('#idlacompetence2').change(function () {
		var filiere = $("#lyceefilierecompetencedetaillee").val();
		var comp = $('#idlacompetence1').val() + '.' + $('#idlacompetence2').val();
		var data = { filiere: filiere };
		$.ajax({
			type: "POST",
			url: 'gestioncompetencedetaillee/liste',
			data: data,
			headers:
			{
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function (retour) {
				var find = false;
				for(var i = 0; i<retour.length; i++){
					if(retour[i].idCompetenceDetaillee==comp){
						find = true;
						$('#selectcompetencedetaillee').val(comp);
						$('#libellelacompetencedetaillee').val(retour[i].libelleCompetenceDetaillee);
					}
				}
				if(!find){
					$('#selectcompetencedetaillee').val('-1');
				}
			}
		});
	});
});
