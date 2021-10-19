$(document).ready(function()
{
		$('.M_menu').click(function()
		{
			$('.M_menu').removeClass('active');
			$(this).addClass('active');
		});
		$('#M_deconnecter').click(function(e)
		{
			if(!confirm("Vouler vraiment vous deonnecter?"))
			{
				e.preventDefault();
			}
		});

		$('.M_wrapper-menu').mouseleave(function()
		{
			$('.M_menu').removeClass('active');

		})
	});
