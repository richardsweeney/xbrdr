(function($) {
    cb.event = (function() {
        return new function() {
            var self        = this,
                callbacks   = {};

            this.bind = function(event, callback) {
                if (callbacks[event]) {
                    callbacks[event].push(callback);
                } else {
                    callbacks[event] = [ callback ];
                }
            };

            this.trigger = function(event, args) {
                args = args || [];
                if (callbacks[event]) {
                    for (var i = 0, l = callbacks[event].length; i < l; i += 1) {
                        callbacks[event][i].apply(self, args);
                    }
                }
            };
        }
    })();
})(jQuery);