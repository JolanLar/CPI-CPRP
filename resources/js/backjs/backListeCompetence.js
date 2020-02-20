
$(document).ready(function () {

	/*
	* @author Jolan Largeteau
	* Quand on change la filière sélectionnée
	* Récupère la liste de compétences de cette filière puis les ajoutes au select
	* Appèle ensuite la fonction change du select de compétence pour vider les champs lors du changement de filière
	*/
	$("#lyceefilierecompetence").change(function () {
		$("#selectcompetence").html("<option value='-1' selected='selected'>Nouvelle compétence</option>");

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
				$('#selectcompetence').change();
			}
		});
	});

	/*
	* @Author Jolan Largeteau
	* Quand on change la compétence sélectionnée
	* Attribut les données de la compétence au input
	*/
	$("#selectcompetence").change(function () {
		var competence = $("#selectcompetence option:selected").val();
		var competenceData = $("#selectcompetence option:selected").text().split(' - ');
		if (competence == '-1') {
			$("#idlacompetence").val("");
			$("#libellelacompetence").val("");
		}
		else {
			$("#idlacompetence").val(competenceData[0]);
			$("#libellelacompetence").val(competenceData[1]);
		}

	}).change();

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
						$('#selectcompetence').val(retour[i].idCompetence);
						$('#libellelacompetence').val(retour[i].libelleCompetence);
					}
				}
				if(!find){
					$('#selectcompetence').val('-1');
					$('#libellelacompetence').val('');
				}
			}
		});
	});
});
