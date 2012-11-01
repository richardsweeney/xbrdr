(function() {
    tinymce.create('tinymce.plugins.ingress', {
        init : function(ed, url) {
            ed.addButton('ingress', {
                title : 'Lägg till ingress',
                image : jsGlobals.templateDirectory +'/images/ingress.png',
                onclick : function() {
                     ed.selection.setContent('[ingress]' + ed.selection.getContent() + '[/ingress]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('ingress', tinymce.plugins.ingress);
})();
