(function(window, $, undefined) {
    
    // CURRENT APP INSTANCE
    window.app = {};
    
    /**
     * Init the page
     * @function
     * @public
     */
    app.init = function() {
      
        // CONNEXION SUBMIT EVENT 
        $(".connexion").live("submit", app.submitConnexion);

        // CONNEXION SUBMIT EVENT 
        $(".inscription").live("submit", app.submitInscription);


        // SHOW USER ACTIVITY BAND
        $(".user_status .label").mouseenter(app.showUserActivity);

        // HIDE USER ACTIVITY BAND
        $(".user_corner").mouseleave(app.hideUserActivity);

        // INIT PLACEHOLER 
        app.initPlaceholder();

        // INIT TIPSY
        app.tipsy();

        // LOAD TEMPLATES
        app.loadTemplate();
        
        // CLOSE ERROR MESSAGE
        $("#errors .tooltip .close").live("click", function () {
            $(this).parent().hide();
        });      
        
        // EXPLORE FREEBASE TOPIC
        $(".fb-topic").freebaseTopic();
        
        // SIGN UP FORM
        $(".signUp").live("click", app.signUp);
        
        // WINDOW SCROLL
        $(window).scroll(app.windowScroll);
        
        // WINDOW RESIZE ALIGN THE FOOTER
        $(window).resize(app.alignFooter);
        // load align
        app.alignFooter();
        
        // BIND AUTO-COMPLETE ON EXPLORE FIELD
        app.bindExploreField();
        
    };

    
    
    /**
     * 
     * @function
     * @public
     */
    app.alignFooter = function() {
        if( $("body").outerHeight() - $(window).height() < -1 )
            $("body").addClass("absoluteFooter");
        else
            $("body").removeClass("absoluteFooter");
    };
    
    
    /**
     * Show user activity
     * @function
     * @public
     */
    app.showUserActivity = function() {
        
        $(".user_activity").stop().css({
              zIndex: 888
        });

        $(".user_activity .headband").stop().css({
              display:"block",
              marginRight: -1 * $(".user_activity .headband").outerWidth()
        });          

        $(".user_activity .headband").stop().animate({
              marginRight: 0
        }, 700, 'easeOutBounce');
    }
    
    
    /**
     *
     * @function
     * @public
     */
     app.bindExploreField = function() {
         
         // disabled the submit button
         $(".search-field .submit").prop("disabled", true).addClass("disabled");
         
         // block the submit event on the form
         $(".search-field").submit(function(e) { 
             e.preventDefault();
             
             var id = $(".search-field :input[name=search]").data("entity");
             // if an id is found
             if( id != undefined)
                 // we go to the visualize screen
                 window.location = "?screen=relation-visualize&rel="+id;
             
         });
         
         // suggest with Freebase suggest
         $(".search-field :input[name=search]").suggest({
            // looking for person or organization
            type: ["/people/person", "/organization/organization"],
            // result must be strict
            type_strict: "any",
            // all type allowed
            all_types: true,
            // selection behavior
            soft:false,
            // selection  required
            required: true
         // user select someone    
         }).bind("fb-select", function(event, entity) {
             
             // enabled the submit button
             $(".search-field .submit").prop("disabled", false).removeClass("disabled");
         
             // record the data
             $(this).data("entity", entity.id);
             
             $(this).submit();
             
             
         // select required    
         }).bind("fb-required", function(event) {
             
             // enabled the submit button
             $(".search-field .submit").prop("disabled", true).addClass("disabled");
         
             // record the data
             $.removeData(this, "entity");
             
         });
         
         
     };
     
    
    /**
     *
     * @function
     * @public
     */
    app.windowScroll = function() {
        
        if($(window).scrollTop() > $("header").outerHeight())
            $(".header-share:not(.fixed)").addClass("fixed");
        else
            $(".header-share.fixed").removeClass("fixed");        
        
    }
      
    /**
     * Hide user activity
     * @function
     * @public
     */
    app.hideUserActivity = function() {

        $(".user_activity .headband").stop().animate({
              display:"block",
              marginRight: -1 * $(".user_activity .headband").outerWidth()
        }, 700, 'easeOutBounce', function() {               

              $(".user_activity").stop().css({
                    zIndex: 666
              });

        });     
            
    }
      
    /**
     * Submit Inscription form
     * @function
     * @public
     */
    app.submitInscription = function() {

        var form = $(this);
        $(".form_error", form).hide();

        if( $(":input[name=email]", form).val() != "" 
            &&  $(":input[name=password_1]", form).val() != "" 
            &&  $(":input[name=password_2]", form).val() != "" ) {


            if( $(":input[name=password_1]", form).val() == $(":input[name=password_2]", form).val() ) {

                var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
                if(pattern.test( $(":input[name=email]", form).val() )){  

                    var data = form.serializeArray();
                    $.each(data, function (key, o) {
                        if(o.name == "password_1" || o.name == "password_2")
                            data[key].value = $.md5(data[key].value);                  
                    });

                    $.ajax({
                        data: data,
                        type: "POST",
                        dataType: "json",
                        url: "./",
                        success: function (data) {

                            var $form  = $(".inscription");

                            // unlock input
                            $(":input", $form).attr("disabled", false);

                            if(data.status == false) {                                  
                                app.showFormError($form, data.message);
                            } else {

                                // empty the fields
                                $(":input", $form).empty();

                                // remove the formulaire
                                $form.removeClass("hidden");
                                app.signUp();

                                app.showErrorTooltip(data.message);

                            }

                        }
                    });

                    // lock input
                    $(":input", form).attr("disabled", true);                        

                } else
                    // Form is incomplete.
                    app.showFormError(form, 3);

            }else
                // Passwords are not matching.
                app.showFormError(form, 2);


        } else
            // Form is incomplete
            app.showFormError(form, 1);

        return false;
    };
    
    
    /**
     * Submit Connexion form
     * @function
     * @public
     */
    app.submitConnexion = function() {
        
        var form = $(this);
        $(".form_error", form).hide();

        var data = form.serializeArray();
        $.each(data, function (key, o) {
              if(o.name == "password")
                    data[key].value = $.md5(data[key].value);                  
        });            

        $.ajax({
              data: data,
              type: "POST",
              dataType: "json",
              url: "./",
              success: function (data) {

                    var $form  = $(".connexion");

                    // unlock input
                    $(":input", $form).attr("disabled", false);

                    if(data.status == false) {                         
                          $(":input[type=password]", $form).val("");             
                          app.showFormError($form, 1);
                    } else
                        window.location = "index.php";

              }
        });

        // lock input
        $(":input", form).attr("disabled", true);        

        return false;
    };
    
    
    
    /**
     * Init placeholer attributes in inputs
     * @function
     * @public
     */
    app.initPlaceholder = function() {
        
          // for each input...
          $(":input").each(function (i) {
                
                // with a placeholder attribut
                if( $(this).attr("placeholder") != "" && $(this).val() == "") {
                      $(this).val( $(this).attr("placeholder") )
                      .addClass("placeholder")
                      .focus(function () {
                            if( $(this).attr("placeholder") == $(this).val() )
                                  $(this).val("").removeClass("placeholder");
                      })
                      .blur(function () {
                            if( $(this).val() == "" )
                                  $(this).val( $(this).attr("placeholder")  ).addClass("placeholder");
                      });
                }
          });
    };
    
    
    /**
     * Show the inscription form
     * @function
     * @public
     */
    app.signUp = function() {

          $(".inscription").toggleClass("hidden");

    };
    

    /**
     * Load template files
     * @function
     * @public
     */
    app.loadTemplate = function() {
        
        // error
        $.get("./appinc/template/tmpl/error-tooltip.tmpl", {}, function(tmpl) {
            
            $.template( "error-tooltip", tmpl);
            $("#errors").html();

            if(window.err.length) {

                for(var i in window.err) {
                      var tooltip  = {
                            msg : window.err[i].msg
                            };
                      $.tmpl("error-tooltip", tooltip).appendTo( $("#errors") ); 
                }

                app.showErrorTooltip(0);
            }

        });
        
    };
    

    /**
     * Initialize tipsy tooltips
     * @function
     * @public
     */
    app.tipsy = function() {
    
        $(".trust_level").tipsy({
            gravity:'ne', 
            opacity:1
        });

        $("#partenaires ul li a").tipsy({
            gravity:'sw', 
            opacity:1,
            offset: 20
        });


        $(".item-button, .visualise a", ".up_menu").tipsy({
            gravity:'s', 
            opacity:1
        });    
      
    };
    

    /**
     * Show errors in the form
     * @function
     * @public
     * 
     * @param jQuery $form
     * @param string err
     */
    app.showFormError = function($form, err) {

          $form.effect("shake", {}, 70);

          $(".form_error", $form).hide();

          if(typeof err == "string")
                $(".form_error:first", $form).html(err).show();
          else
                $(".form_error:eq("+err+")", $form).show();

    };


    /**
     * Show global error number i
     * @function
     * @public
     * 
     * @param integer i
     */
    app.showErrorTooltip = function(i) {

          // i is a number
          if( !isNaN(i) ) {

              if(i < err.length) {
                  $("#errors .tooltip:eq("+i+")").css({
                        display:"block",
                        position: "relative",
                        top: -20 - $("#errors .tooltip:eq("+i+")").outerHeight()
                  }).animate({
                        top:0
                  }, 
                  1200, 
                  'easeOutElastic', 
                  function () {                  
                        if($("#errors .tooltip:eq("+(i+1)+")").length > 0)
                              app.showErrorTooltip(i+1); 
                  });

              }

          // i is a message
          } else if(typeof i == "string") {

              $.tmpl("error-tooltip", {msg : i} ).appendTo( $("#errors") );

              $("#errors .tooltip:last").css({display:"block",
                                               position: "relative",
                                               top: -200                                           
                                             }).animate({top:0}, 1200, 'easeOutElastic');

         }
    };

    // WHEN THE DOCUMENT IS READY, INIT THE APP
    $(document).ready(app.init);
    
})(window, jQuery);

