
$(document).ready(function() {

	$("#etudiantclasse").text("Liste des élèves de la classe "+$("#selectgestionclasse").val()+":");

    $("#selectgestionclasse").change(function() {
        reloadListeEtudiant();
    });
    $('#selectgestionclasseannee').change(function () {
       reloadListeEtudiant();
    });
    $(document).on('click', '.removeUtilisateurClasse', function() {
        const idUtilisateur = $(this).attr('id');
       removeUtilisateurClasse(idUtilisateur);
    });

    function reloadListeEtudiant()
    {
        $("#tableauetudiant").html("");
        var libFiliere = $("#selectgestionclasse option:selected").text();
        var idFiliere = $("#selectgestionclasse option:selected").val();
        const annee = $('#selectgestionclasseannee').val();

		$("#etudiantclasse").text("Liste des élèves de la classe "+libFiliere+":");

        var data = { selectgestionclasse : idFiliere, annee: annee };
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
					<td>"+retour[i].idUtilisateur+"</td>\n\
					<td>"+retour[i].nom+"</td>\n\
					<td>"+retour[i].prenom+"</td>\n\
					<td><button id='"+retour[i].idUtilisateur+"' class='btn btn-danger removeUtilisateurClasse' type='button'><i class='fas fa-user-minus'></i></button></td>\n\
					</tr>");
                }
            }

        });
    };

    function removeUtilisateurClasse(idUtilisateur) {
        const annee = $('#selectgestionclasseannee').val();
        const data = { idUtilisateur: idUtilisateur, annee: annee };
        $.ajax({
            type: "POST",
            url: "gestionclasse/supprimer",
            data: data,
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success: function(retour) {
                message('success', retour);
                reloadListeEtudiant();
            }
        })
    }

    reloadListeEtudiant();
});
