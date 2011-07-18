
function makeWebsiteTour(config, start_step) {
      
      /*
      the json config obj.
      name: the class given to the element where you want the tooltip to appear
      text: the text inside the tooltip
      position: the position of the tip. Possible values are
            TL	top left
            TR  top right
            BL  bottom left
            BR  bottom right
            LT  left top
            LB  left bottom
            RT  right top
            RB  right bottom
            T   top
            R   right
            B   bottom
            L   left
       */    
      //current step of the tour
      step		 = start_step != undefined ? start_step : 0,
      //total number of steps
      total_steps	 = config.length;
      //show the tour controls
      showControls();
      showOverlay();
      if(start_step != undefined)
            startTour();
				
      /* we can restart or stop the tour,
         and also navigate through the steps */
      $('#activatetour').live('click',startTour);
      $('#canceltour').live('click',endTour);
      $('#endtour,#nothank').live('click',endTour);
      $('#restarttour').live('click',restartTour);
      $('#nextstep').live('click',nextStep);
      $('#prevstep').live('click',prevStep);
				
      function startTour(){
            $('#tourcontrols').animate({
                  'bottom':'8px'
            }, start_step != undefined ? 0 : 500);
            $('#activatetour,#nothank').remove();
            $('#endtour,#restarttour,#stopTheTour').show();
            if(total_steps > 1)
                  $('#nextstep').show();
            
            nextStep();
      }
				
      function nextStep(){
            
            if(step > 0)
                  $('#prevstep').show();
            else
                  $('#prevstep').hide();
            
            if(step == total_steps-1)
                  $('#nextstep').hide();
            else
                  $('#nextstep').show();	
            
            if(step >= total_steps){
                  //if last step then end tour
                  endTour();
                  return false;
            }
            ++step;
            showTooltip();
      }
				
      function prevStep(){
      
            if(step > 2)
                  $('#prevstep').show();
            else
                  $('#prevstep').hide();
            
            if(step == total_steps)
                  $('#nextstep').show();
            
            if(step <= 1)
                  return false;
            
            --step;
            showTooltip();
      }
				
      function endTour(){
            step = 0;
            removeTooltip();
            hideControls();
            hideOverlay();
            $.cookies.set("no-website-tour", 1, {hoursToLive:24*14});
      }
				
      function restartTour(){
            step = 0;
            nextStep();
      }
				
      function showTooltip(){
            //remove current tooltip
            removeTooltip();
            			
            var step_config = config[step-1];
            
            if(step_config.end != undefined && step_config.end)
                  endTour();
                  
            // change the location
            if(step_config.url != undefined)
                  window.location = step_config.url;
            
            var $elem			= $(step_config.selector);															
            var $tooltip		= $('<div>',{
                                                      id		: 'tour_tooltip',
                                                      "class"          	: 'tooltip radiusLight simpleShadow',
                                                      html		: '<p>'+step_config.text+'</p><span class="tooltip_arrow"></span>'
                                                }).hide();
					
            //position the tooltip correctly:
					
            //the css properties the tooltip should have
            var properties = {};
					
            var tip_position = step_config.position;
					
            //append the tooltip but hide it
            $('BODY').prepend($tooltip);
					
            //get some info of the element
            var e_w = $elem.outerWidth();
            var e_h = $elem.outerHeight();
            var e_l = $elem.offset().left;
            var e_t = $elem.offset().top;
					
					
            switch(tip_position){
                  case 'TL'	:
                        properties = {
                              'left'	: e_l,
                              'top'	: e_t + e_h + 'px'
                        };
                        $tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_TL');
                        break;
                  case 'TR'	:
                        properties = {
                              'left'	: e_l + e_w - $tooltip.width() + 'px',
                              'top'	: e_t + e_h + 'px'
                        };
                        $tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_TR');
                        break;
                  case 'BL'	:
                        properties = {
                              'left'	: e_l + 'px',
                              'top'	: e_t - $tooltip.height() + 'px'
                        };
                        $tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_BL');
                        break;
                  case 'BR'	:
                        properties = {
                              'left'	: e_l + e_w - $tooltip.width() + 'px',
                              'top'	: e_t - $tooltip.height() + 'px'
                        };
                        $tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_BR');
                        break;
                  case 'LT'	:
                        properties = {
                              'left'	: e_l + e_w + 'px',
                              'top'	: e_t + 'px'
                        };
                        $tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_LT');
                        break;
                  case 'LB'	:
                        properties = {
                              'left'	: e_l + e_w + 'px',
                              'top'	: e_t + e_h - $tooltip.height() + 'px'
                        };
                        $tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_LB');
                        break;
                  case 'RT'	:
                        properties = {
                              'left'	: e_l - $tooltip.width() + 'px',
                              'top'	: e_t + 'px'
                        };
                        $tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_RT');
                        break;
                  case 'RB'	:
                        properties = {
                              'left'	: e_l - $tooltip.width() + 'px',
                              'top'	: e_t + e_h - $tooltip.height() + 'px'
                        };
                        $tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_RB');
                        break;
                  case 'T'	:
                        properties = {
                              'left'	: e_l + e_w/2 - $tooltip.width()/2 + 'px',
                              'top'	: e_t + e_h + 'px'
                        };
                        $tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_T');
                        break;
                  case 'R'	:
                        properties = {
                              'left'	: e_l - $tooltip.width() + 'px',
                              'top'	: e_t + e_h/2 - $tooltip.height()/2 + 'px'
                        };
                        $tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_R');
                        break;
                  case 'B'	:
                        properties = {
                              'left'	: e_l + e_w/2 - $tooltip.width()/2 + 'px',
                              'top'	: e_t - $tooltip.height() + 'px'
                        };
                        $tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_B');
                        break;
                  case 'L'	:
                        properties = {
                              'left'	: e_l + e_w  + 'px',
                              'top'	: e_t + e_h/2 - $tooltip.height()/2 + 'px'
                        };
                        $tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_L');
                        break;
            }
					
					
            /*
            if the element is not in the viewport
            we scroll to it before displaying the tooltip
             */
            var w_t	= $(window).scrollTop();
            var w_b = $(window).scrollTop() + $(window).height();
            //get the boundaries of the element + tooltip
            var b_t = parseFloat(properties.top,10);
					
            if(e_t < b_t)
                  b_t = e_t;
					
            var b_b = parseFloat(properties.top,10) + $tooltip.height();
            if((e_t + e_h) > b_b)
                  b_b = e_t + e_h;
						
					
            if((b_t < w_t || b_t > w_b) || (b_b < w_t || b_b > w_b)){
                  $('html, body').stop()
                  .animate({
                        scrollTop: b_t
                  }, 500, 'easeInOutExpo', function(){                        
                        //show the new tooltip
                        $tooltip.css(properties).show();
                  });
            }
            else
                  //show the new tooltip
                  $tooltip.css(properties).show();
      }
				
      function removeTooltip(){
            $('#tour_tooltip').remove();
      }
				
      function showControls(){
            
            /* we can restart or stop the tour,
            and also navigate through the steps */
            
            var $tourcontrols  = '<div id="tourcontrols" class="tourcontrols radiusLight simpleShadow">';        
                  
                  $tourcontrols += '<h2>First time here?</h2>';
                  
                  $tourcontrols += '<div class="nav">\n\
                                          <span class="button submit violet" id="activatetour">Start the tour</span>\n\
                                          <span class="button submit violet" id="nothank">No, thanks</span>\n\
                                          <span class="button submit violet left" id="prevstep" style="display:none;">&larr; Previous</span>\n\
                                          <span class="button submit violet right" id="nextstep" style="display:none;">Next &rarr;</span>\n\
                                    </div>\n\
                                    <br />';

                  $tourcontrols += '<span id="stopTheTour"><a href="./?screen=relation-add">Restart the tour</a> | <a id="endtour">End the tour</a></span>';            
                  $tourcontrols += '<span class="close" id="canceltour"></span>';
                  
            $tourcontrols += '</div>';
					
            $('#workspace').prepend($tourcontrols);
            $('#tourcontrols').animate({
                  'bottom': ( start_step != undefined ? 8 : 308)
            },500);
      }
				
      function hideControls(){
            $('#tourcontrols').remove();
      }
				
      function showOverlay(){
            var $overlay	= '<div id="tour_overlay" class="overlay"></div>';
            $('#workspace').prepend($overlay);
      }
				
      function hideOverlay(){
            $('#tour_overlay').remove();
      }

}
