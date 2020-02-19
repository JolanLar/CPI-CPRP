/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {

	$("#lyceefilieredonnee").change(function()
	{
		$("#libelledonnee").val("");
		$("#numdonnee").val("");
		$("#selectcddonnee").html("<option disabled>Compétence détaillée</option>");

        var filiere = $("#lyceefilieredonnee").val();
        var data = { filiere : filiere };
        $.ajax({
            type: "POST",
            url: 'gestiondonnee/liste',
            data: data,
            headers:
			{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(retour)
			{
				for(var i=0;i<retour.length;i++)
				{
					$("#selectcddonnee").append("<option>"+retour[i].idCompetenceDetaillee+" - "+retour[i].libelleCompetenceDetaillee+"</option>");
				}
                $("#selectcddonnee").change();
			}
        });
	});

    /*
    * @Author Jolan Largeteau
    * Sélectionne automatiquement la donnée lié a la compétence choisis
    */
	$("#selectcddonnee").change(function()
	{

        var filiere = $("#lyceefilieredonnee").val();
        var idcd = $("#selectcddonnee option:selected").text().split(' - ');

        var data = { filiere : filiere, idcd : idcd[0] };
		$.ajax({
            type: "POST",
            url: 'gestiondonnee/donnee',
            data: data,
            headers:
			{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(retour)
			{
                if(retour.idDonnee!=null) {
                    $('#selectcddonneeassociee').val(retour.idDonnee);
                    $('#selectcddonneeassociee').change();
                } else {
                    $('#selectcddonneeassociee').val(-1);
                    $('#selectcddonneeassociee').change();
                }
            }
        });
    }).change();
    
    /*
    * @Author Jolan Largeteau
    * Remplie les input avec les données de la donnée
    */
	$("#selectcddonneeassociee").change(function()
	{
		if($("#selectcddonneeassociee").val() == "-1")
		{
			$("#numdonnee").val("");
            $("#libelledonnee").val("");
		}
		else
		{
            var idDonnee = $("#selectcddonneeassociee option:selected").text().split(" - ");
            $("#numdonnee").val(idDonnee[0]);
            $("#libelledonnee").val(idDonnee[1]);
        }
    }).change();

    /*
    * @Author Jolan Largeteau
    * Quand clique sur supprimmer :
    * - Affiche un message de confirmation de suppression
    * - Supprime la donnée de la dbb puis recharge la page
    * @param idDonnée récupéré à partir du select et non de l'input
    */
    $('#gestiondonneeboutonsupprimer').click(function() {
        var idDonnee = $('#selectcddonneeassociee').val();
        data = {idDonnee: idDonnee};
        $.ajax({
            type: "POST",
            url: "gestiondonnee/listeCompetenceDetaillee",
            data: data,
            headers:
			{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(retour)
			{

            }
        })
    });
});
