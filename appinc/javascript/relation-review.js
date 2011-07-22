(function(window, $, undefined) {
    
    // CURRENT APP INSTANCE
    var page = {};
    
    /**
     * Init the page
     * @function
     * @public
     */
    page.init = function() {      

        // RATE SLIDER WITH JQUERY UI
         $("#rate-slider" ).slider({
            value:3,
            min: 1,
            max: 5,
            step: 0.1,
            slide: function( event, ui ) {
                  $( ":input[name=rate]" ).val( ui.value );

                  $("#rate-slider .ui-slider-handle").attr("title", "<span style='font-size:30px'>"+ui.value+"</span>/5");

                  // to paralelle execution
                  setTimeout(function () { 
                        $("#rate-slider .ui-slider-handle").tipsy("show"); 
                  }, 0);
            },
            change: function() {            
                  $("#rate-slider .ui-slider-handle").tipsy("show");                          
            }
        });

        // LEAVE RATE SLIDER
        $("#rate-slider .ui-slider-handle").blur(function() {
            $("#rate-slider .ui-slider-handle").tipsy("hide");                                
        })

        // RATE SLIDER PROPERTY AND TOOLTIPS
        $("#rate-slider .ui-slider-handle")
            .attr("title", "<span style='font-size:30px'>"+$( ":input[name=rate]" ).val()+"</span>/5")
            .tipsy({
                gravity: 's',
                html: true,
                opacity:1
            });
            

        // FORM SUBMIT
        $(".classic-form form").submit(page.submitForm);
            
        // WEBSITE TOUR
        page.checkWebsiteTour();
        
    };
    

    /**
     * Load template files
     * @function
     * @public
     */
    page.loadTemplate = function() {
        // node property
        $.get("./appinc/template/tmpl/node-property.tmpl", {}, function(tmpl) {$.template( "node-property", tmpl);} );
    };
    

    /**
     * Submit the form (or not)
     * @function
     * @public
     * @return boolean
     */
    page.submitForm = function() {
           
        return true;

    };
    
    
    /**
     * Make a website tour (or not)
     * @function
     * @public
     */
    page.checkWebsiteTour = function() {
        
        if(0 &&  ! $.cookies.get("no-website-tour") && window.isConnected ) {

            new makeWebsiteTour([
                {
                    "selector"        : ".up_menu li.current",
                    "position"        : "T",
                    "text"            : "See a random relation between 2 nodes to estimate its trust level."
                },
                {
                    "selector" 		: "h3:eq(2)",
                    "position"        : "B",
                    "text"		: "How valid does this piece of information sounds to you?"
                }, {
                    "selector" 		: ".rate-legend:eq(0)",
                    "position"        : "BR",
                    "text"		: "Looks fishy"
                }, {
                    "selector" 		: ".rate-legend:eq(1)",
                    "position"        : "BL",
                    "text"		: "Looks solid"
                }, {
                    "url"             : "./?screen=relation-visualise"
                }
                
            ], 0);
        } 
    };
    
    // WHEN THE DOCUMENT IS READY, INIT THE APP
    $(document).ready(page.init);
    
})(window, jQuery);