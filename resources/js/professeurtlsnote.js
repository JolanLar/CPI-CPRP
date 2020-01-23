$( document ).ready(function() {

	var idparent;
//********** A acquerir **********
	$('.aa').click(function() {
		idparent = $(this).parent().attr('id');

		if($(this).css('backgroundColor') == 'rgb(0, 255, 0)')
		{
                    if($("#"+idparent +" .ca1").css('backgroundColor') != 'rgb(0, 255, 0)'
                            && $("#"+idparent +" .ca2").css('backgroundColor') != 'rgb(0, 255, 0)'
                            && $("#"+idparent +" .ar1").css('backgroundColor') != 'rgb(0, 255, 0)'
                            && $("#"+idparent +" .ar2").css('backgroundColor') != 'rgb(0, 255, 0)'
                            && $("#"+idparent +" .ar3").css('backgroundColor') != 'rgb(0, 255, 0)'
                            && $("#"+idparent +" .c1").css('backgroundColor') != 'rgb(0, 255, 0)'
                            && $("#"+idparent +" .c2").css('backgroundColor') != 'rgb(0, 255, 0)'
                            && $("#"+idparent +" .c3").css('backgroundColor') != 'rgb(0, 255, 0)'
                            && $("#"+idparent +" .c4").css('backgroundColor') != 'rgb(0, 255, 0)')
                    {
                       $(this).css('backgroundColor', 'rgb(255, 255, 255)');
                    }

                    else{
			$("#"+idparent +" .note").css('backgroundColor', 'rgb(255, 255, 255)');
			$("#"+idparent +" .aa").css('backgroundColor', 'rgb(0, 255, 0)');
                    }
		}
		else
		{
			$("#"+idparent +" .aa").css('backgroundColor', 'rgb(0, 255, 0)');
		}
	});
//********** Cours d'acquisition 1 **********
	$('.ca1').click(function() {

		idparent = $(this).parent().attr('id');

		if($("#"+idparent +" .ca1").css('backgroundColor') == 'rgb(0, 255, 0)')
		{

			$("#"+idparent +" .ca2").css('backgroundColor', 'rgb(255, 255, 255)');
			$("#"+idparent +" .ar1").css('backgroundColor', 'rgb(255, 255, 255)');
			$("#"+idparent +" .ar2").css('backgroundColor', 'rgb(255, 255, 255)');
			$("#"+idparent +" .ar3").css('backgroundColor', 'rgb(255, 255, 255)');

			$("#"+idparent +" .c1").css('backgroundColor', 'rgb(255, 255, 255)');
			$("#"+idparent +" .c2").css('backgroundColor', 'rgb(255, 255, 255)');
			$("#"+idparent +" .c3").css('backgroundColor', 'rgb(255, 255, 255)');
			$("#"+idparent +" .c4").css('backgroundColor', 'rgb(255, 255, 255)');


			$("#"+idparent +" .ca1").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .aa").css('backgroundColor', 'rgb(0, 255, 0)');

		}
		else
		{
			$("#"+idparent +" .ca1").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .aa").css('backgroundColor', 'rgb(0, 255, 0)');
		}
	});

//********** Cours d'acquisition 2 **********
	$('.ca2').click(function() {

		idparent = $(this).parent().attr('id');

		if($("#"+idparent +" .ca2").css('backgroundColor') == 'rgb(0, 255, 0)')
		{

			$("#"+idparent +" .ca2").css('backgroundColor', 'rgb(255, 255, 255)');
			$("#"+idparent +" .ar1").css('backgroundColor', 'rgb(255, 255, 255)');
			$("#"+idparent +" .ar2").css('backgroundColor', 'rgb(255, 255, 255)');
			$("#"+idparent +" .ar3").css('backgroundColor', 'rgb(255, 255, 255)');

			$("#"+idparent +" .c1").css('backgroundColor', 'rgb(255, 255, 255)');
			$("#"+idparent +" .c2").css('backgroundColor', 'rgb(255, 255, 255)');
			$("#"+idparent +" .c3").css('backgroundColor', 'rgb(255, 255, 255)');
			$("#"+idparent +" .c4").css('backgroundColor', 'rgb(255, 255, 255)');


			$("#"+idparent +" .ca2").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .ca1").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .aa").css('backgroundColor', 'rgb(0, 255, 0)');
		}
		else
		{
			$("#"+idparent +" .ca2").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .ca1").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .aa").css('backgroundColor', 'rgb(0, 255, 0)');
		}
	});

//********** A renforcer 1 **********

	$('.ar1').click(function() {

		idparent = $(this).parent().attr('id');

		if($("#"+idparent +" .ar1").css('backgroundColor') == 'rgb(0, 255, 0)')
		{
			$("#"+idparent +" .ar2").css('backgroundColor', 'rgb(255, 255, 255)');
			$("#"+idparent +" .ar3").css('backgroundColor', 'rgb(255, 255, 255)');

			$("#"+idparent +" .c1").css('backgroundColor', 'rgb(255, 255, 255)');
			$("#"+idparent +" .c2").css('backgroundColor', 'rgb(255, 255, 255)');
			$("#"+idparent +" .c3").css('backgroundColor', 'rgb(255, 255, 255)');
			$("#"+idparent +" .c4").css('backgroundColor', 'rgb(255, 255, 255)');

		}
		else
		{
			if($("#"+idparent +" .ca2").css('backgroundColor') != 'rgb(0, 255, 0)' && $("#"+idparent +" .ca1").css('backgroundColor') == 'rgb(0, 255, 0)' )
			{
				$("#"+idparent +" .ca2").css('backgroundColor', 'rgb(0, 255, 0)');

			}
			$("#"+idparent +" .ar1").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .ca1").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .aa").css('backgroundColor', 'rgb(0, 255, 0)');
		}
	});

//********** A renforcer 2 **********

	$('.ar2').click(function() {
		idparent = $(this).parent().attr('id');

		if($("#"+idparent +" .ar2").css('backgroundColor') == 'rgb(0, 255, 0)')
		{

			$("#"+idparent +" .ar3").css('backgroundColor', 'rgb(255, 255, 255)');

			$("#"+idparent +" .c1").css('backgroundColor', 'rgb(255, 255, 255)');
			$("#"+idparent +" .c2").css('backgroundColor', 'rgb(255, 255, 255)');
			$("#"+idparent +" .c3").css('backgroundColor', 'rgb(255, 255, 255)');
			$("#"+idparent +" .c4").css('backgroundColor', 'rgb(255, 255, 255)');

		}
		else
		{
			$("#"+idparent +" .ar2").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .ca2").css('backgroundColor', 'rgb(0, 255, 0)');

			$("#"+idparent +" .ar1").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .ca1").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .aa").css('backgroundColor', 'rgb(0, 255, 0)');
		}
	});

//********** A renforcer 3 **********

	$('.ar3').click(function() {

		idparent = $(this).parent().attr('id');

		if($("#"+idparent +" .ar3").css('backgroundColor') == 'rgb(0, 255, 0)')
		{
			$("#"+idparent +" .c1").css('backgroundColor', 'rgb(255, 255, 255)');
			$("#"+idparent +" .c2").css('backgroundColor', 'rgb(255, 255, 255)');
			$("#"+idparent +" .c3").css('backgroundColor', 'rgb(255, 255, 255)');
			$("#"+idparent +" .c4").css('backgroundColor', 'rgb(255, 255, 255)');


		}
		else
		{
			$("#"+idparent +" .ar3").css('backgroundColor', 'rgb(0, 255, 0)');

			$("#"+idparent +" .ar2").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .ca2").css('backgroundColor', 'rgb(0, 255, 0)');

			$("#"+idparent +" .ar1").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .ca1").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .aa").css('backgroundColor', 'rgb(0, 255, 0)');
		}
	});

//********** Confirme 1 **********

	$('.c1').click(function() {

		idparent = $(this).parent().attr('id');

		if($("#"+idparent +" .c1").css('backgroundColor') == 'rgb(0, 255, 0)')
		{
			$("#"+idparent +" .c2").css('backgroundColor', 'rgb(255, 255, 255)');
			$("#"+idparent +" .c3").css('backgroundColor', 'rgb(255, 255, 255)');
			$("#"+idparent +" .c4").css('backgroundColor', 'rgb(255, 255, 255)');

		}
		else
		{
			if($("#"+idparent +" .ca2").css('backgroundColor') != 'rgb(0, 255, 0)' && $("#"+idparent +" .ca1").css('backgroundColor') == 'rgb(0, 255, 0)' )
			{
				$("#"+idparent +" .ca2").css('backgroundColor', 'rgb(0, 255, 0)');

			}

			if($("#"+idparent +" .ar3").css('backgroundColor') != 'rgb(0, 255, 0)' && $("#"+idparent +" .ar2").css('backgroundColor') == 'rgb(0, 255, 0)' )
			{
				$("#"+idparent +" .ar3").css('backgroundColor', 'rgb(0, 255, 0)');

			}

			if($("#"+idparent +" .ar2").css('backgroundColor') != 'rgb(0, 255, 0)' && $("#"+idparent +" .ar1").css('backgroundColor') == 'rgb(0, 255, 0)' )
			{
				$("#"+idparent +" .ar2").css('backgroundColor', 'rgb(0, 255, 0)');

			}



			$("#"+idparent +" .c1").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .ar1").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .ca1").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .aa").css('backgroundColor', 'rgb(0, 255, 0)');
		}
	});


//********** Confirme 2 **********

	$('.c2').click(function() {

		idparent = $(this).parent().attr('id');

		if($("#"+idparent +" .c2").css('backgroundColor') == 'rgb(0, 255, 0)')
		{
			$("#"+idparent +" .c3").css('backgroundColor', 'rgb(255, 255, 255)');
			$("#"+idparent +" .c4").css('backgroundColor', 'rgb(255, 255, 255)');

		}
		else
		{

			if($("#"+idparent +" .ar3").css('backgroundColor') != 'rgb(0, 255, 0)' && $("#"+idparent +" .ar2").css('backgroundColor') == 'rgb(0, 255, 0)' )
			{
				$("#"+idparent +" .ar3").css('backgroundColor', 'rgb(0, 255, 0)');

			}


			$("#"+idparent +" .c1").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .c2").css('backgroundColor', 'rgb(0, 255, 0)');

			$("#"+idparent +" .ar1").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .ar2").css('backgroundColor', 'rgb(0, 255, 0)');

			$("#"+idparent +" .ca1").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .ca2").css('backgroundColor', 'rgb(0, 255, 0)');

			$("#"+idparent +" .aa").css('backgroundColor', 'rgb(0, 255, 0)');
		}
	});

//********** Confirme 3 **********

	$('.c3').click(function() {

		idparent = $(this).parent().attr('id');

		if($("#"+idparent +" .c3").css('backgroundColor') == 'rgb(0, 255, 0)')
		{

			$("#"+idparent +" .c4").css('backgroundColor', 'rgb(255, 255, 255)');
		}
		else
		{
			$("#"+idparent +" .c1").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .c2").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .c3").css('backgroundColor', 'rgb(0, 255, 0)');

			$("#"+idparent +" .ar1").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .ar2").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .ar3").css('backgroundColor', 'rgb(0, 255, 0)');

			$("#"+idparent +" .ca1").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .ca2").css('backgroundColor', 'rgb(0, 255, 0)');

			$("#"+idparent +" .aa").css('backgroundColor', 'rgb(0, 255, 0)');
		}
	});

	$('.c4').click(function() {

		idparent = $(this).parent().attr('id');

		if($("#"+idparent +" .c4").css('backgroundColor') == 'rgb(0, 255, 0)')
		{

		}
		else
		{
			$("#"+idparent +" .c1").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .c2").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .c3").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .c4").css('backgroundColor', 'rgb(0, 255, 0)');

			$("#"+idparent +" .ar1").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .ar2").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .ar3").css('backgroundColor', 'rgb(0, 255, 0)');

			$("#"+idparent +" .ca1").css('backgroundColor', 'rgb(0, 255, 0)');
			$("#"+idparent +" .ca2").css('backgroundColor', 'rgb(0, 255, 0)');

			$("#"+idparent +" .aa").css('backgroundColor', 'rgb(0, 255, 0)');
		}
	});
});
