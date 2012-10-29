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