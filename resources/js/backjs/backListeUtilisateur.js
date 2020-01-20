
$(document).ready(function() {

	$("#selectutilisateur").change(function() 
	{
		if ($("#selectutilisateur").val()==="Nouvel utilisateur")
		{
			$("#nomutilisateur").val("");
			$("#prenomutilisateur").val("");
			$("#etudiantrole").val("Etudiant").change();
		}
		else	
		{
			var utilisateur = $("#selectutilisateur").val().split(" : ");
			var nomprenom = utilisateur[1].split(" - ");
			$("#nomutilisateur").val(nomprenom[0]);
			$("#prenomutilisateur").val(nomprenom[1]);
		
			var data = { idUtilisateur : utilisateur[0] };
			$.ajax({
				type: "POST",
				url: 'gestionutilisateur/liste',
				data: data,
				headers: 
				{
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success: function(retour) 
				{
					if(retour=="10")
					{
						$( "#etudiantrole" ).val("Etudiant").change();
					}
					else if(retour=="5")
					{
						$( "#etudiantrole" ).val("Professeur").change();
					} 
					else if(retour=="1")
					{
						$( "#etudiantrole" ).val("Administrateur").change();
					}
				}
			});
		}
	});
});