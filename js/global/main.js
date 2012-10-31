var cb = {
   	data: {},
	device: '',
	loading: false
};

(function($) {
	$(document).bind('ready', function() {
    cb.event.trigger('loading.start');
		// GET DEVICE
		if($(window).width() < 481) {
			cb.device = 'smartphone';
		} else if($(window).width() < 769) {
			cb.device = 'tablet';
		} else {
			cb.device = 'desktop';
		}
		cb.event.trigger('loading.stop');
	});
	$(window).bind('load', function() {
		cb.event.trigger('load');
	});
	$(window).bind('resize', function() {
		cb.event.trigger('resize');
		if($(window).width() < 481) {
			cb.device = 'smartphone';
		} else if($(window).width() < 769) {
			cb.device = 'tablet';
		} else {
			cb.device = 'desktop';
		}

		//$('#pagewrap').empty();
		//$('#pagewrap').append(this.clone);
		//var page = new cb.page();
		//page.init();
	});
})(jQuery);

jQuery(function ($) {

	$('#floating-arrow-sroll-to-top a').click(function (e) {
		$('html, body').animate({ scrollTop: 0 }, 300);
		e.preventDefault();
	});

	$('#spec').hide();

	$('.product-tab .js a').click(function (e) {
		var target = $(this).attr('data-id'),
				$container = $('.show-hide-container');
		$container.find('section').hide();
		$('section#' + target).fadeIn(200);
		e.preventDefault();
	});

});
