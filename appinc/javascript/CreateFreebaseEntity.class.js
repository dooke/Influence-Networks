(function(window, $, undefined) {
 
    /**
     * Class to create a form to add an entity on Freebase 
     * @class
     */
    window.CreateFreebaseEntity = function() {
    
        var createFreebaseEntity = this,    
            $form;
        
        /**
         * On load, create function to init the form
         * @function
         * @public
         */
        $(createFreebaseEntity.init = function() {
           
           // select the form
           $form = $(".createFreebaseEntity");
           
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
            $form.live("change", createFreebaseEntity.submit);
            
            // close the form
            $form.find(".cancel").live("click", createFreebaseEntity.close)
            
        }
        
        
        /**
         * Submit the form
         * @function
         * @public
         */
        createFreebaseEntity.submit = function() {
            
            var type = $form.find(":input:checked[type=radio]").val();
            
        }        
        
        
        /**
         * Open the form
         * @function 
         * @public
         * @param Object input
         */
        createFreebaseEntity.open = function(input) {
            
            var $text = $form.find(".text"), $this = $(input);
            
            // store the label text
            if(! $text.data("text") )
                $text.data("text", $text.text() )
            
            // use the name of the entity
            $text.html( $text.data("text").replace("%1", "<strong>" + $this.val() + "</strong>") ); 
            
            // show the mask
            $("#mask").fadeIn(300).unbind("click").click(createFreebaseEntity.close);
            
            // show the form
            $form.removeClass("hidden");
            
        } 


        /**
         * Close the form
         * @function 
         * @public
         */
        createFreebaseEntity.close = function() {
        
            // show the mask
            $("#mask").fadeOut(300);
            
            // show the form
            $form.addClass("hidden");
        }
        
        
    }
    
 
 
})(window, jQuery)