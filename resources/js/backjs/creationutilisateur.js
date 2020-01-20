$(document).ready(function() {
    
    if ($('#etudiantrole').val() === 'Etudiant') 
    {
        $("#sietudiant").show();   
        if($('#redoublant').is(':checked'))
		{
            $("#siredoublant").show();
		}
        else
		{
            $("#siredoublant").hide();
		}
    }
    else if ($('#etudiantrole').val() === 'Professeur' || $('#etudiantrole').val() === 'Administrateur') 
    {
        $("#sietudiant").hide(); 
    }
	
	$('#etudiantrole').change(function() 
	{
		if($('#etudiantrole').val() === 'Etudiant') 
		{
			$("#sietudiant").show();   
			if($('#redoublant').is(':checked'))
			{
				$("#siredoublant").show();
			}
		}
		else if(this.value === 'Professeur' || this.value === 'Administrateur') 
		{
			$("#sietudiant").hide();   
		}
	});
	$('#redoublant').change(function() {  
		if ($('#redoublant').is(':checked')) 
		{    
			if($('#etudiantrole').val() === 'Etudiant')
			{
				$("#siredoublant").show();
			}
		}
		else
		{
			$("#siredoublant").hide();
		}
    });
        
    $("#boutonsupprimerutilisateur").click(function() 
    {
        var supprimer = confirm("Voulez-vous supprimer cet utilisateur ?");
        if(supprimer)
        {
            var utilisateur = $("#selectutilisateur").val().split(" : ");
            var nomprenom = utilisateur[1].split(" - ");
            $("#nomutilisateur").val(nomprenom[0]);
            $("#prenomutilisateur").val(nomprenom[1]);
			var data = { idUtilisateur : utilisateur[0] };
            $.ajax({
				type: "POST",
				url: 'gestionutilisateur/supprimer',
				data: data,
				headers: 
				{
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success: function(retour)  
				{
					alert(retour);
					location.reload();
				}
			}); 
        }
    });
});