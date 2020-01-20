
$(document).ready(function() {

	$("#etudiantclasse").text("Liste des élèves de la classe "+$("#selectgestionclasse").val()+":");

    $("#selectgestionclasse").change(function() 
    {
        $("#tableauetudiant").html("");
        var filiere = $("#selectgestionclasse").val();
    
		$("#etudiantclasse").text("Liste des élèves de la classe "+filiere+":");

        var data = { selectgestionclasse : filiere };
        $.ajax({
            type: "POST",
            url: 'gestionclasse/liste',
            data: data,
            headers: 
			{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(retour) 
            {
                for(var i=0;i<retour.length;i++)
                {
					$("#tableauetudiant").append("<tr>\n\
					<th>"+retour[i].idUtilisateur+"</th>\n\
					<td>"+retour[i].nom+"</td>\n\
					<td>"+retour[i].prenom+"</td>\n\
					<td>"+"<a href=\"gestionclasse/supprimer/"+retour[i].idUtilisateur+"\" class=\"btn btn-danger\" role=\"button\"><i class=\"fas fa-user-minus\"></i></a></td>\n\
					</tr>");
                }
            }
       
        }); 
    }).change();
});