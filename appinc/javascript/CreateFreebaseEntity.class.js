(function(window, $, undefined) {
 
    /**
     * Class to create a form to add an entity on Freebase 
     * @class
     */
    window.CreateFreebaseEntity = function() {
    
        var createFreebaseEntity = this, 
            $container,
            $form, 
            $this;
        
        /**
         * On load, create function to init the form
         * @function
         * @public
         */
        $(createFreebaseEntity.init = function() {
           
           // select the form
           $container = $(".createFreebaseEntity");
           $form = $("form", $container);
           
           // bind event on the form
           createFreebaseEntity.bind();
        });
        
        
        /**
         * On load, create the function to bind live events on the form's buttons
         * @function
         * @public
         */
        createFreebaseEntity.bind = function() {
            
            // form change, we submit it
            $(".tipsy.createTopic form").live("change", createFreebaseEntity.submit);
            
            // close the form
            $(".tipsy.createTopic .cancel").live("click", createFreebaseEntity.close)
            
        }
        
        
        /**
         * Submit the form
         * 
         * @function
         * @public
         */
        createFreebaseEntity.submit = function() {
            
            // get the type
            var type = $(".tipsy.createTopic form").find(":input:checked[type=radio]").val(),            
                // entity name
                name = $form.data("entity-name");
                
            // disabled the buttons to select a type
            $(".tipsy.createTopic form").find(":input[type=radio]").prop("disabled", true);
            
            // type OK, here we go
            if( (type == "/organization/organization" || type == "/people/person") && name != "") {
                                
                // send data
                $.getJSON("./", {action: "createTopic", name:name, type:type}, createFreebaseEntity.topicCreated);                
                
            }
            
        };  
        
        
        /**
         * Callback function when topic is created
         * 
         * @function 
         * @public
         * @param Object data
         */
        createFreebaseEntity.topicCreated = function(data) {
            
            if(data.status) {
                
                // UPDATE the input...

                // with the definitive Name (label)
                $this.val(data.node.label);
                // and the definitive MID
                $(":input[name="+$this.data("input")+"]").val(data.node.freebase_id);                
                
                // UPDATE the information-topic-trigger
                var $informationTrigger = $(".fb-topic-information[rel="+$this.attr("id")+"]");
                
                // with the mid
                $informationTrigger.data("mid", data.node.freebase_id);
                // and the type
                $informationTrigger.data("type", data.node.type);
                
                // save the label
                $this.data("label", data.node.label)
                
                // show it
                $informationTrigger.removeClass("hidden").addClass("fb-topic");
                
                // next step
                window.step.value++;
                
            }
                
            // and hide the tipsy
            createFreebaseEntity.close();
            
        };
        

        
        /**
         * Open the form
         * @function 
         * @public
         * @param Object input
         */
        createFreebaseEntity.getHTML = function(input) {
                        
            var $text = $form.find(".text");
            
            // current input change
            $this = $(input);
            
            // disabled the input
            $this.prop("disabled", true);
            
            // store the label text 
            if(! $text.data("text") )
                $text.data("text", $text.text() );
            // and the entity name
            $form.data("entity-name", $this.val() );
            
            // use the name of the entity
            $text.html( $text.data("text").replace("%1", "<strong>" + $this.val() + "</strong>") ); 
            
            // return the form (or nothing if there is nothing in the field)
            return $this.val() == "" ? "" : $container.html();
            
        };
        

        /**
         * Close the form
         * @function 
         * @public
         */
        createFreebaseEntity.close = function() { 
            
            // enabled the input
            $this.prop("disabled", false);
            
            // show the form
            $this.tipsy("hide");
        };
        
        
    }
    
 
 
})(window, jQuery)