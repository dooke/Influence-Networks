(function(window, $, undefined) {
    
    // CURRENT APP INSTANCE
    var page = {};
        
    /**
     * Init the page
     * @function
     * @public
     */
    page.init = function() {      
        
        // form to create freebase entity
        var createFreebaseEntity = new window.CreateFreebaseEntity()
    
        // initialize tipsy
        page.tipsy();
        
        // auto complete
        $(".node_search").suggest({

            // looking for person or organization
            type: ["/people/person", "/organization/organization"],
            // result must be strict
            type_strict: "any",
            all_types: true,
            // selection is required
            required: true,
            soft:false

        // select success
        }).bind("fb-select", page.selectEntity)
        
        // select failled
        .bind("fb-required", function () { 

           // Hack to hide every tipsy tooltips
           $(".node_search").each(function(i, n) {$(n).tipsy("hide");});              

           if( $(this).val() != $(this).attr("placeholder") )
               // Show the form to 
               createFreebaseEntity.open(this);

        });
        
        // type changes        
        $(":input[name=relation_type]").change(page.changeRelationType);
     
        // submit the form
        $(".classic-form form").submit(page.submitForm);
      
    };
    

    /**
     * Load template files
     * @function
     * @public
     */
    page.loadTemplate = function() {
    
        $.get("./appinc/template/tmpl/node-property.tmpl", {}, function(tmpl) {
            $.template( "node-property", tmpl);
        });


        $.get("./appinc/template/tmpl/form-type-property.tmpl", {}, function(tmpl) {
            $.template( "form-type-property", tmpl);
        });
     
    };
    
    page.selectEntity = function(event, data) {
        
        var type = null;
        
        // look for the type of the relation
        $.each(data.type, function(i, val) {
            // type must be an organization or a person
            if(val.id == "/organization/organization" || val.id == "/people/person")
                type = val.id;
        });
        
        if(type != null) {
        
            // add Freebase tipsy data
            $(this).data("mid",  data.id)
                   .data("type", type)
                   .attr("title", "")
                   .addClass("fb-topic");
                  
        }
            
    };
    
    
    /**
     * Change the relation type
     * @function
     * @public
     */
    page.changeRelationType = function() {
          
        // show a hint for some relations  
        page.updateRelationHint();
        
        // class according to the type direction
        var dir  = $("option:selected", this).data("direction");
        $(".classic-form").removeClass("ltr rtl tw").addClass( dir );
        
              
        var rel_type = $(this).val();
        $(".relation-property-input").html("");
           
        if(rel_type != -1)
            $.tmpl("form-type-property", {
                relation_type : rel_type
            }).appendTo( $(".relation-property-input") );
           
        if( $(".classic-form").outerHeight() >= 467) $(".deroule").addClass("open").click();
        initPlaceholder();
               
        $(".classic-form .chk_city").suggest({
            type: "/location/citytown"
        });
            
        $(".classic-form .chk_organization").suggest({
            type: "/organization/organization"
        });
            
        $(".classic-form .chk_location").suggest({
            type: "/location/location"
        });
            
        $(".classic-form .chk_educational_institution").suggest({
            type: "/education/educational_institution"
        });                      
            
    }
    
    
    /**
     * Submit the form
     * @function
     * @public
     */
    page.submitForm = function () {
            
        var dontForget = false;
        $(".required").each(function () {
            
            var mailPattern = /(((https?:\/\/[a-zA-Z0-9_-]*\.?)|(w{3}\.))[a-zA-Z0-9_-]+\.[a-z0-9]{2,5}[a-zA-Z0-9/_\.\?\#-]*)/;
            
            if( $(this).hasClass("chk_URL") && ! mailPattern.test( $(this).val() ) ) {
                
                dontForget = true;
                $(this).addClass("highlight");
                
            } else if( $(this).val() == "" || $(this).val() == $(this).attr("placeholder") ) {
                        
                dontForget = true;
                $(this).addClass("highlight");
                  
            } else $(this).removeClass("highlight");
                  
        });
           
        if( !dontForget
            && $(":input[name=relation_type]").val() != -1 ) {
               
            $(":input").each(function () {

                if( $(this).val() == $(this).attr("placeholder") )
                    $(this).val("");

            });

            return true;

        }
        return false;
           
    };
    


    /**
     * Initialize tipsy tooltips
     * @function
     * @public
     */
    page.tipsy = function() {
        
    };
    
    
    /**
     * Update the hint of the current relation type
     * 
     * @function
     * @public
     */
    page.updateRelationHint = function() {

            var hint = $(":input[name=relation_type] option:selected").data("hint");
            $(".classic-form").removeClass("hint");

            // there is a hint ?
            if(hint != "") {
                  $(".classic-form").addClass("hint");

                  var entityLeft  = $("#entity-left h4").text();
                      entityLeft  = entityLeft == "" ? "left entity" : entityLeft;

                  var entityRight = $("#entity-right h4").text();
                      entityRight = entityRight == "" ? "right entity" : entityRight;

                  hint = hint.replace("%1", entityLeft).replace("%2", entityRight);
                  $(".relation-hint").html(hint);
            }  

    }

    
    
    /**
     * Make a website tour (or not)
     * @function
     * @public
     */
    page.checkWebsiteTour = function() {
        
        if(! $.cookies.get("no-website-tour") && window.isConnected ) {
            new makeWebsiteTour([{
                                    "selector": ".up_menu li.current",
                                    "position": "T",
                                    "text": "Add a relation between 2 nodes."
                                },
                                {
                                    "selector": ".node_search.node_left",
                                    "position": "BR",
                                    "text": "Example: Barack Obama"
                                }, {
                                    "selector": ".node_search.node_right",
                                    "position": "BL",
                                    "text": "Example: Michelle Obama"
                                }, {
                                    "selector": ".select-type",
                                    "position": "T",
                                    "text": "How are the two related?"
                                }, {
                                    "url": "./?screen=relation-review"
                                }
                                ], 0);
        }
    };
    
    
    // WHEN THE DOCUMENT IS READY, INIT THE APP
    $(document).ready(page.init);
    
})(window, jQuery);
