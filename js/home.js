(function($) {
	
	cb.page = (function(){
        	var self = this;
			element					= {};
			element.nav				= {};
			element.nav.sidebar		= $('.nav-sidebar');
			

		return new function() {
        		this.init = function() {
   					element.nav.sidebar.onePageNav();
        		};
		};
	});
	$(document).bind('ready', function() {
		var page = new cb.page();
		page.init();
	});
	
})(jQuery);