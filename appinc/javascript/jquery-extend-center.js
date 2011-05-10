// Place un élément au centre de l'écran (positionement absolu)
// l'élément à center ne dois pas être contenu dans un block positioné en RELATIVE !
(function($){
    $.fn.extend({
        center: function() {
              
            if( typeof $(this).data("center_last_update") == "undefined" ) {
                        $(this).data("center_last_update", 0); // timestamp who indicates the last center update

                  // Pour fonctionner pleinnement, cette fonction doit être appellée au chargement et au redimmensionement de la page
                  $(window).resize(function () { $(".center").center(); });
            }

            var obj = $(this);            
            var d = new Date();
            
            // On redimensione l'élément seulement si la dernière redimension date de plus d'une 1/10 seconde 
            if(d.getTime() - $(this).data("center_last_update") >= 100 ) {
            	
	            // -----------
	            // Centre l'élement (ou les éléments)
	            // au milieu de la page
	            // ----------------------------------
	            $(obj).each(function () {
	
	                var x = ( $(window).width()  > $(this).outerWidth()  )  ? $(window).width()  / 2 - $(this).outerWidth()  / 2 : 0;
	                var y = ( $(window).height() > $(this).outerHeight() )  ? $(window).height() / 2 - $(this).outerHeight() / 2 : 0;
	
	
	                // recherche dans les éléments parents positionnés en absolute
	                var par = $(this).parent();

	                while( par.get(0) != null && par.get(0).nodeName != "BODY") {
                          
	                    // l'élément est modifié
	                    if( par.css("position") == "absolute" ) {
	                        x -= par.css("left" ).replace("px", "").replace(",", ".") * 1;
	                        y -= par.css("top").replace("px", "").replace(",", ".") * 1;
	                    }
	
	                    par = par.parent();
	                }
	
	                $(this).css({
	                    position:"absolute",
	                    left:x+"px",
	                    top: y+"px",
	                    margin:0
	                });
	
	            });
	            
	            $(this).data("center_last_update", d.getTime() );
            }
	            
            return obj;
        }
    });
})(jQuery);