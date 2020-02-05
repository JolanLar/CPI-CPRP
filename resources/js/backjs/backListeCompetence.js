
$(document).ready(function () {

	$("#lyceefilierecompetence").change(function () {
		$("#idlacompetence").val("");
		$("#libellelacompetence").val("");
		$("#selectcompetence").html("<option>Nouvelle compétence</option>");

		var filiere = $("#lyceefilierecompetence").val();

		var data = { filiere: filiere };
		$.ajax({
			type: "POST",
			url: 'gestioncompetence/liste',
			data: data,
			headers:
			{
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function (retour) {
				for (var i = 0; i < retour.length; i++) {
					$("#selectcompetence").append("<option value='"+retour[i].idCompetence+"'>" + retour[i].idCompetence + " - " + retour[i].libelleCompetence + "</option>");
				}

			}
		});
	});

	$("#selectcompetence").change(function () {
		var competence = $("#selectcompetence option:selected").text();
		var idcompetence = competence.split(' - ');
		if (competence == '-1') {
			$("#idlacompetence").val("");
			$("#libellelacompetence").val("");
		}
		else {
			$("#idlacompetence").val(idcompetence[0]);
			$("#libellelacompetence").val(idcompetence[1]);
		}

	});

	$("#boutonsupprimercompetence").click(function () {
		var supprimer = confirm("Voulez-vous supprimer cette compétence et toutes les compétences détaillées associées ?");
		var lafiliere = $('#lyceefilierecompetence').val();

		if (supprimer) {
			competence = $("#idlacompetence").val();
			var data = { idCompetence: competence, filiere: lafiliere };
			$.ajax({
				type: "POST",
				url: 'gestioncompetence/supprimer',
				data: data,
				headers:
				{
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success: function (retour) {
					alert("Compétence et compétences détaillées supprimées");
					location.reload();
				}

			});
		}
	});

	$('#idlacompetence').change(function () {
		var filiere = $("#lyceefilierecompetence").val();
		var comp = $('#idlacompetence').val();
		var data = { filiere: filiere };
		$.ajax({
			type: "POST",
			url: 'gestioncompetence/liste',
			data: data,
			headers:
			{
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function (retour) {
				var find = false;
				for(var i = 0; i<retour.length; i++){
					if(retour[i].idCompetence==comp){
						find = true;
						$('#selectcompetence').val(comp);
					}
				}
				if(!find){
					$('#selectcompetence').val('-1');
				}
			}
		});
	});
});
