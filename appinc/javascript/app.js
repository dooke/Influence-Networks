

$(document).ready(function () {
      
    
     // put events
    
    /************************
     * CONNEXION SUBMIT EVENT
     ***/    
      $(".connexion").submit(function () {
        
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

                        if(data.statut == false) {                         
                              $(":input[type=password]", $form).val("");             
                              showFormError($form, 1);
                        } else
                              window.location = "index.php";
                  }
            });

            // lock input
            $(":input", form).attr("disabled", true);        

            return false;
        
      });
    
        
      /***********
       * Templates
       ***/
      // error
      $.get("./appinc/template/tmpl/error-tooltip.tmpl", {}, function(tmpl) {
            $.template( "error-tooltip", tmpl);
            $("#errors").html();
            
            if(err.length) {
                
                for(var i in err) {
                      var tooltip  = {
                            msg : err[i].msg
                            };
                      $.tmpl("error-tooltip", tooltip).appendTo( $("#errors") ); 
                }

                showErrorTooltip(0);
            }
            
      } );
     
   

    
      /**************************
       * INSCRIPTION SUBMIT EVENT
       ***/    
      $(".inscription").submit(function () {
        
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

                                          if(data.statut == false) {                                  
                                                showFormError($form, data.message);
                                          } else {
                                              
                                                // empty the fields
                                                $(":input", $form).empty();
                                                
                                                // remove the formulaire
                                                $form.removeClass("hidden");
                                                signUp();  
                                                
                                                showErrorTooltip(data.message);
                                                                                                
                                          }

                                    }
                              });

                              // lock input
                              $(":input", form).attr("disabled", true);                        
                     
                        } else
                              // Form is incomplete.
                              showFormError(form, 3);
                                   
                  }else
                        // Passwords are not matching.
                        showFormError(form, 2);
          

            } else
                  // Form is incomplete
                  showFormError(form, 1);
       
        
        
        
            return false;
        
      });
    
    
    
    
      /********************
     * USER ACTIVITY BAND
     ***/    
      $(".user_status .label").mouseenter(function () {
                   
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
          
      });
    
      $(".user_corner").mouseleave(function () {
                   
            $(".user_activity .headband").stop().animate({
                  display:"block",
                  marginRight: -1 * $(".user_activity .headband").outerWidth()
            }, 700, 'easeOutBounce', function() {               
                
                  $(".user_activity").stop().css({
                        zIndex: 666
                  });
                  
            });          
          
      });
    
    
    
    
      /*********************
     * HIDE FREEBASE DATA
     ***/
    
      $(".deroule").tipsy({
            gravity:'n', 
            opacity:1
      }).click(function () {

            if( $(this).hasClass("open") ) {                  
                  $(this).removeClass("open");                  
                  $(".hiddable").slideUp(400, function () {
                        $(this).css("display", "none");
                  });                  
            } else {                  
                  $(this).addClass("open");
                  $(".hiddable").slideDown(400);                  
            }
            
            
      });
        
    
      initPlaceholder();
    
      if( typeof $().center == "function") $(".center").center();
    
      $(".trust_level").tipsy({
            gravity:'ne', 
            opacity:1
      });
      
      $("#partenaires ul li a").tipsy({
            gravity:'sw', 
            opacity:1,
            offset: 20
      });
    
      $(".review,.add,.visualise", ".main_menu").tipsy({
            gravity:'s', 
            opacity:1
      });
      $(".review,.add,.visualise", ".up_menu").tipsy({
            gravity:'n', 
            opacity:1
      });    
      
      

      $(".showFooter .trigger").mouseenter(function () {
            showFooter();
      });
      
      $("footer").mouseenter(function () {
            showFooter();
      });

      $("#workspace").mouseenter(function () {
            hideFooter();
      });
      
      $("#app").mouseleave(function () {
            hideFooter();
      });
      
      if( RR_UTILS.isApple() )  {
            $(".showFooter .trigger").click(function () {
                  showFooter();
            });
            $("footer").click(function () {
                  showFooter();
            });
            $("#workspace").click(function () {
                  hideFooter();
            });
      }
    
      
      $("#errors .tooltip .close").live("click", function () {
            $(this).parent().hide();
      });
    
});

function initPlaceholder() {

      /**********************
     * Placeholder on input
     ***/    
      $(":input").each(function (i) {
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
}


function signUp() {
    
      if( $(".inscription").hasClass("hidden") ) {
        
            // remove class
            $(".inscription").removeClass("hidden");
        
            // pre-hide the sign up block
            $(".inscription").css({
                  marginTop: -1 * $(".inscription").outerHeight() - 20,
                  display: "block",
                  opacity: 0
            });

            // show form
            $(".inscription").animate({
                  marginTop: 0,
                  opacity: 1
            }, 700, 'easeOutBounce');
        
      } else {

            // add class
            $(".inscription").addClass("hidden");
        
            // hide inscription form
            $(".inscription").animate({
                  marginTop: -1 * $(".inscription").outerHeight() - 20,
                  display: "none",
                  opacity: 0
            }, 700, 'easeOutBounce');
        
       
      }
    
}

function showFormError(form, err) {
                      
      form.effect("shake", {}, 70);
       
      $(".form_error", form).hide();
       
      if(typeof err == "string")
            $(".form_error:first", form).html(err).show();
      else
            $(".form_error:eq("+err+")", form).show();
       
}

function showErrorTooltip(i) {
      
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
                          showErrorTooltip(i+1); 
              });

          }
          
      // i is a message
      } else if(typeof i == "string") {

          $.tmpl("error-tooltip", {msg : i} ).appendTo( $("#errors") );
         
          $("#errors .tooltip:last").css({
                                            
                                            display:"block",
                                            position: "relative",
                                            top: -200                                           
                                            
                                         }).animate({top:0}, 1200, 'easeOutElastic');
          
      }
}


// Affiche le code d'embed pour les apps
function doEmbed() {

      $("#mask").fadeIn(500);
      $(".inputEmbed").fadeIn(500);

      // cache l'embed au click sur le masque
      $("#mask").click(function () {
            $(".inputEmbed").fadeOut(500);
      });
}


function showFooter() {


      if( RR_UTILS.isApple() ) {
            $(".showFooter .trigger").stop().css({
                  opacity:0
            });
            $(".showFooter").stop().css({
                  marginTop:-85
            });
      } else {
            $(".showFooter").stop().animate({
                  marginTop:-85
            }, 500, function () {
                  $(".showFooter .trigger").stop().animate({
                        opacity:0,
                        marginTop:30,
                        marginBottom:-100
                  }, 250);
            });
      }

}

function hideFooter() {

      if( RR_UTILS.isApple() ) {
          
            $(".showFooter .trigger").stop().css({
                  opacity:1
            });
            
            $(".showFooter").stop().css( {
                  marginTop:-30
            } );
            
      } else {
          
            $(".showFooter .trigger").stop().animate({
                  opacity:1,
                  marginTop:-36,
                  marginBottom:0
            }, 250);
                    
            $(".showFooter").stop().animate({
                  marginTop:-30
            }, 500);
      }
}
