
$(document).ready(function() {

    $("#selectgestionclasse2").change(function() 
    {
        if($("#selectgestionclasse2").val() === "Nouvelle classe")
        {
            $("#idnomclasse").val("");
        }
        else
        {
			$("#idnomclasse").val($("#selectgestionclasse2").val());
            var classe = $("#selectgestionclasse2").val();

            var data = { classe : classe };
            $.ajax({
                type: "POST",
                url: 'gestioncreationclasse/liste',
                data: data,
                headers: 
				{
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(retour)
				{
                      $("#selectfiliereassociee").val(retour.libelleFiliere);
                }
            });
        }
    }).change();  
});       