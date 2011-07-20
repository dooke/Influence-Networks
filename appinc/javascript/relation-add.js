(function(window, $, undefined) {
    
    // CURRENT APP INSTANCE
    window.page = {};
    // small object to count step, by step.
    window.step = {
            val:0,
            get value() {
                return this.val;
            },
            set value(step) {
                if(step >= 0) {
                    this.val = step;
                    page.updateSteps();
                }
            }
        };
    // form to create freebase entity
    window.createFreebaseEntity = new window.CreateFreebaseEntity();
        
        
    /**
     * Init the page
     * 
     * @function
     * @public
     */
    page.init = function() {      
        
    
        // initialize tipsy
        page.tipsy();
        
        // auto complete
        $(".node_search").suggest({
            // looking for person or organization
            type: ["/people/person", "/organization/organization"],
            // result must be strict
            type_strict: "any",
            // all type allowed
            all_types: true,
            // selection is required
            required: "always",
            // selection behavior
            soft:false
            
        // select success
        }).bind("fb-select", page.selectEntity)
        // select failled
        .bind("fb-required", page.selectRequired)
        // keyup hide tipsy
        .keyup(function() {
            
            $(this).tipsy("hide");

            // if the entity changes
            if( $(this).data("description") != undefined && $(this).val() != $(this).data("description").name ) {
                
                // remove data
                $(this).data("description", "")
                       .data("mid", "")
                       .data("type", "");
            }
            
        });
        
        // type changes        
        $(":input[name=relation_type]").change(page.changeRelationType);
     
        // submit the form
        $(".classic-form form").submit(page.submitForm);
        
        // load template
        page.loadTemplate();
        
        // initialize steps
        page.updateSteps();
        
        // source step
        $(":input[type=text].source").keyup(page.checkSource);
        
        // look up an entity
        $(".lookup:input").click(page.lookUpEntity);
    };
    
    
    /**
     *
     * @function
     * @public
     */
    page.selectRequired = function() {
        
        // find the input
        var $input = $(this),
            $mid   = $(":input").filter("[name="+$input.data("input")+"]");
            
        // to update the step
        if( $input.val() == "" || $input.val() == $input.attr("placeholder") || $input.val() != $input.data("label") ) {            
            
            // empty the field
            $mid.val("");
            
            // hidde the information trigger
            page.$thisTopicInformation($input).freebaseTopic("reset").addClass("hidden");
        
            // change the step
            if( $input.is("#to-entity-left") )
                step.value = 0;
            else
                step.value = 1;

        }
    };
    
    
    /**
     *
     * @function
     * @public
     */
    page.lookUpEntity = function() {               
        
        // find the input
        var $input = $(this).parents(".step").find(".node_search"),
            $mid   = $(":input").filter("[name="+$input.data("input")+"]"),
            $informationTrigger = $(".fb-topic-information[rel="+$input.attr("id")+"]");

        // change the step
        if( $input.is("#to-entity-left") )
            step.value = 0;
        else
            step.value = 1;

       // Hide information trigger
       page.$thisTopicInformation($input).freebaseTopic("reset").addClass("hidden");

       // Hide every tipsy tooltips
       $(".node_search").each(function(i, n) {$(n).tipsy("hide");});              

       if( $input.val() != $input.attr("placeholder") && $input.val() != "" )
           // Show the form to create topic             
           $input.tipsy("show");
        
    };
    
    
    /**
     * User select an entity
     * 
     * @public
     * @function
     */
    page.selectEntity = function(event, data) {
        
        // hide tipsy if visible
        $(this).tipsy("hide");
        
        // change the step
        if( $(this).is("#to-entity-left") )
            step.value = 1;
        else
            step.value = 2;
        
        // complete the input hidden
        $(":input").filter("[name="+$(this).data("input")+"]").val(data.id);
        
        // determine the type
        var type = null;        
        // look for the type of the relation
        $.each(data.type, function(i, val) {
            // type must be an organization or a person
            if(val.id == "/organization/organization" || val.id == "/people/person")
                type = val.id;
        });
        
        if(type != null) {
            page.$thisTopicInformation(this).removeClass("hidden")
                                            .addClass("fb-topic")
                                            .data("mid",  data.id)
                                            .data("type", type)
                                            .data("description", null);
        }
        
    };
    
    /**
     *
     * @function
     * @public
     */
    page.updateSteps = function() {
        
        // change the step aspect
        $(".step").removeClass("disabled").filter(":gt("+step.value+")").addClass("disabled");        
                    
        // change the input status
        $(".step :input").prop("disabled", false);
        $(".step.disabled :input").prop("disabled", true);
        
        if( page.checkStep(step.value) ) step.value++;
        
    };
    
    
    
    /**
     * Check if the step is OK
     * 
     * @function
     * @public
     * @param number i step number
     * @return boolean
     */
    page.checkStep = function(i) {
        switch(i) {
            
                // first step
                case 0:
                    return $(":input[name=entity-left-mid]").val() != "";
                    break;
            
                // second step
                case 1:
                    return $(":input[name=entity-right-mid]").val() != "";
                    break;
                    
                // third step    
                case 2:
                    return  $(":input[name=relation_type]").val() != -1;
                    break;
                    
                // fourth step    
                case 3:
                    return  page.checkSource.call($(":input[type=text].source"));
                    break;
                    
                // fifth step    
                case 4:
                    return true; // not required
                    break;
        }
    };
    
    
    /**
     * 
     * @function
     * @public
     * @return boolean
     */
    page.checkSource = function() {

        var mailPattern = /(((https?:\/\/[a-zA-Z0-9_-]*\.?)|(w{3}\.))[a-zA-Z0-9_-]+\.[a-z0-9]{2,5}[a-zA-Z0-9/_\.\?\#-]*)/;

        if( mailPattern.test( $(this).val() ) ) {

            if(step.value == 3) step.value = 4;
            return true;

        } else {
            
            if(step.value >= 4) step.value = 3;
            return false;
        }
        

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
    
    
    /**
     * Get the input "Information trigger"
     * 
     * @function
     * @public
     * @return jQuery
     */
    page.$thisTopicInformation = function(that) {
        
        // freebase information
        var id = $(that).attr("id");
        return $(".fb-topic-information[rel="+id+"]");
    }
    
    
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
           
        if(rel_type != -1) {
            
            $.tmpl("form-type-property", {
                relation_type : rel_type
            }).appendTo( $(".relation-property-input") );
            
        }
        
        // get the source id from the template
        var sourceId = $(".source-id").val();
        
        // change the source input name
        $(":input[type=text].source").attr("name", "property_"+sourceId);
        
        // bind new Freebase suggest on the new inputs
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
        
        // next step
        if(rel_type == -1) 
            // don't go on
            step.value = 2;
        else
            step.value = 3;
        
        // init placehold for new inputs
        app.initPlaceholder();
        
            
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
    
        $(".node_search").tipsy({
            html: true,
            title: function() { return createFreebaseEntity.getHTML(this); },
            opacity:1,
            addClass:"tipsy-sky createTopic",
            gravity:'s',
            trigger:"manual"
        });
        
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
