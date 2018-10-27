(function ($){

	$('#header_icon').click(function(e){
		e.preventDefault();
		$('body').addClass('with--sidebar');
	});

	$('.site-cache').click(function(e){
		e.preventDefault();
		$('body').removeClass('with--sidebar');
	});

})(jQuery);