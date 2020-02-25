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
                $.ajax({
                    type: "POST",
                    url: "gestiondonnee/listeFilieres",
                    headers:
                        {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    success: function (filieres) {
                        var text = "Voulez-vous vraiment supprimer la donnée n°" + idDonnee + " ?\rLes compétences suivantes n'aurons plus de donnée :\r";
                        for (let i = 0; i < filieres.length; i++) {
                            text += filieres[i].libelleFiliere + ' : ';
                            for(let x = 0; x < retour.length; x++){
                                if(retour[x].idFiliere == filieres[i].idFiliere){
                                    text += retour[x].idCompetenceDetaillee + " ";
                                }
                            }
                            text += "\r";
                        }
                        agree = confirm(text);
                        if(agree) {
                            $.ajax({
                               type: 'POST',
                               url: 'gestiondonnee/supprimer',
                                data: data,
                                headers:
                                    {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                success: function(retour) {
                                   message('success', 'Donnée n°'+idDonnee+' supprimée !');
                                   $.ajax({
                                       type: 'POST',
                                       url: 'gestiondonnee/listeDonnee',
                                       data: data,
                                       headers:
                                           {
                                               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                           },
                                       success: function(retour) {
                                           $('#selectcddonneeassociee').html('<option value="-1" selected="selected">Nouvelle donnéee</option>');
                                           for(let i = 0; i < retour.length; i++){
                                                $('#selectcddonneeassociee').append('<option value="'+retour[i].idDonnee+'">'+retour[i].idDonnee+' - '+retour[i].libelleDonnee+'</option>');
                                           }
                                       }
                                   });
                                   $("#selectcddonnee").change();
                                }
                            });
                        }
                    }
                });
            }
        });
    });

    /*
    * @Author Jolan Largeteau
    * Quand on modifie l'id depuis l'input vérifie si il existe, si c'est le cas le selectionne dans le select et replie l'input tibelle
    * Sinon selectionne nouvelle donnee et vide l'input libelle
    * @param idDonnee
    */
    $('#numdonnee').change(function() {
        var idDonnee = $(this).val();

        $.ajax({
            type: "POST",
            url: 'gestiondonnee/listeDonnee',
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success: function (retour) {
                var find = false;
                for(let i = 0; i < retour.length; i++){
                    if (retour[i].idDonnee == idDonnee && find == false) {
                        $('#selectcddonneeassociee').val(retour[i].idDonnee);
                        $('#selectcddonneeassociee').change();
                        find = true;
                    }
                }
                if(!find){
                    $('#selectcddonneeassociee').val('-1');
                    $('#libelledonnee').val('');
                }
            }
        });
    });
});
