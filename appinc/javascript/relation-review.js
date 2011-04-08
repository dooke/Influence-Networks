
/*************************
* Pre-load template files
***/
$.get("./templates/tmpl/node-property.tmpl", {}, function(tmpl) {$.template( "node-property", tmpl);} );
                        
$(document).ready(function () {
    
    
      
      $( "#rate-slider" ).slider({
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

      $("#rate-slider .ui-slider-handle").blur(function() {
            $("#rate-slider .ui-slider-handle").tipsy("hide");                                
      })

      $("#rate-slider .ui-slider-handle").attr("title", "<span style='font-size:30px'>"+$( ":input[name=rate]" ).val()+"</span>/5")
      .tipsy({
            gravity: 's',
            html: true,
            opacity:1
      });
                  
      /********************
      * LOAD FREEBASE DATA
      ***/    
      var data = {
            freebase_id: $(":input[name=entity-left-mid]").val(), 
            type:        $(":input[name=entity-left-type]").val()
      };
      loadFreebaseInformations("#entity-left", data );
     
      data = {
            freebase_id: $(":input[name=entity-right-mid]").val(), 
            type:        $(":input[name=entity-right-type]").val()
      };
      loadFreebaseInformations("#entity-right", data );
     
      
      /********************
      * FORM SUBMIT
      ***/    
      $(".classic-form form").submit(function () {
           
            return $("#to-entity-left").val() != $("#to-entity-left").attr("placeholder")
            && $("#to-entity-right").val() != $("#to-entity-left").attr("placeholder")
            && $(":input[name=relation_type]").val() != 0;
           
      });
      
      
      /********************
      * WEBSITE TOUR
      ***/          
      if(! $.cookies.get("no-website-tour") && isConnected )
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
                        "url"             : "./?ecran=relation-visualise"
                  }
            ], 0);

});

    
function loadFreebaseInformations(setview, node) {
      
      
      // *************************
      // * Load Data from Freebase
      // ***

      // cross domain query
      document.createElement("script");
      
      var header = document.getElementsByTagName("head")[0];         
      var script = document.createElement('script');
      script.type = 'text/javascript';

      // if we know the mid (freebase id) of the target node
      // we can do a request to freebase.

      // complete an hidden input who keep the mid (freebase_id) and retrieve the setview
      $(setview).val(node.freebase_id);

      // Like you can see, we have a CALLBACK FONCTION in the url,
      // this one does a JSONP request from freebase api.
      // The callback function was "completeInfoFromFreebase".

      script.src  = "http://www.freebase.com/api/service/mqlread?callback=completeInfoFromFreebase&query=";


      // for a /people/person we have a particular kind of data set
      if(node.type == "/people/person")
            script.src  += '{ "query"%3A [{ "id"%3A "' + node.freebase_id + '"%2C "type"%3A "/people/person"%2C "name"%3A null%2C "profession"%3A []%2C "date_of_birth"%3A null%2C "gender"%3A null%2C "nationality"%3A []%2C "place_of_birth"%3A []%2C "places_lived"%3A [] }] }';
      // for organization we have an other kind of data set...
      else if(node.type == "/organization/organization")
            script.src  += '{ "query"%3A [{ "id"%3A "' + node.freebase_id + '"%2C "name"%3A null%2C "type"%3A "%2Forganization%2Forganization"%2C "ns0%3Atype"%3A []%2C "headquarters"%3A [{ "optional"%3A true%2C "*"%3A {}%2C "limit"%3A 1 }] }] }';

      header.appendChild(script);

      $(setview).addClass("loading");
      $(setview).removeClass("default");    
}

// ***********************************
// * Complete information about a node
// * in the right block
// ***
function completeInfoFromFreebase(data) {
         
      var setview = null;      
      
      if(data.status == "200 OK") {

            if(data.result.length > 0) {

                  var node = data.result[0];

                  // found the setview
                  $(".entity-desc :input[type=hidden]").each(function (i, f) {
                        if($(f).val() == node.id)
                             setview =  $("#" + $(this).attr("id").replace("to-", "") );                       
                  });      

                  if(setview != null) {

                        // change title
                        $("h4", setview).html(node.name);
                        $("ul", setview).html("");            
                        

                        if(node.type == "/people/person") {

                              var data = [
                                    {type: "Type", values: ["Person"]},
                                    {type: "Occupation", values: node.profession},
                                    {type: "Date of Birth", values: [node.date_of_birth]},
                                    {type: "Gender", values: [node.gender]},
                                    {type: "Nationality", values: node.nationality},
                                    {type: "Place of Birth ", values: [node.place_of_birth ]}
                              ];

                        } else {

                              var place = new Array();
                              
                              if(typeof node.headquarters != "undefined")                                    
                                    for(var i in node.headquarters)                                          
                                          if( typeof node.headquarters[i].state_province_region == "object" )
                                                if(node.headquarters[i].state_province_region != null)
                                                      place.push(node.headquarters[i].state_province_region.name);                              

                              var data = [
                                    {type: "Type",  values: ["Organization"]},
                                    {type: "Place", values: place}
                              ];

                        }

                        $.tmpl("node-property",  data).appendTo( $("ul", setview) );
                        $(setview).removeClass("loading");
                                                
                        if( $(".classic-form").outerHeight() >= 425) $(".deroule").addClass("open").click();     

                  } else {            
                        $("h4", setview).html("");
                        $("ul", setview).html(""); 
                  }
            }

      }
}
