
$(document).ready(function () {  
      
    var createFreebaseEntity = new window.CreateFreebaseEntity();
    
    
    /*************************
      * Pre-load template files
      ***/
    $.get("./appinc/template/tmpl/node-property.tmpl", {}, function(tmpl) {
        $.template( "node-property", tmpl);
    } );
    
    
    $.get("./appinc/template/tmpl/form-type-property.tmpl", {}, function(tmpl) {
        $.template( "form-type-property", tmpl);
    } );
     
      
    /*********************
      * Autocomplete module
      ***/   
     
     // a tooltips to indicate which input is empty
     $(".node_search").tipsy({
            trigger: "manual", 
            gravity: "s",
            opacity: 1,
            html   : true
     }).blur(function() {
         // hide tooltips when the input take the focus
         $(this).tipsy("hide");
     
     // prevent a bug with google font 
     }).tipsy("show").tipsy("hide");
    
    
    $(".node_search").suggest({
        
        // looking for person or organization
        type: ["/people/person", "/organization/organization"],
        // result must be strict
        type_strict: "any",
        all_types: true,
        // selection is required
        required: true,
        soft:false
        
        
    }).bind("fb-select", function(e, data) { // select event
        
        // load data from freebase
        loadFreebaseData(data, $(this) );
        
    }).bind("fb-required", function () { // fail event
        
       // Hack to hide every tipsy tooltips
       $(".node_search").each(function(i, n) {$(n).tipsy("hide");});              
       
       if( $(this).val() != $(this).attr("placeholder") )
           // Show the form to 
           createFreebaseEntity.open(this);
       
    });
      
      
    $(".node_search").change(function () {           
        freeSetview( $(this) );                      
    });
      
      
    /********************
      * Form for each type
      ***/    
    $(":input[name=relation_type]").change(function () {
          
        updateRelationHint();
        
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
            
    });
     
      
      
    /********************
      * FORM SUBMIT
      ***/    
    $(".classic-form form").submit(function () {
            
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
           
        if(   !dontForget
            && $(":input[name=relation_type]").val() != -1 ) {
               
            $(":input").each(function () {

                if( $(this).val() == $(this).attr("placeholder") )
                    $(this).val("");

            });

            return true;

        }
        return false;
           
    });
      
    /********************
      * WEBSITE TOUR
      ***/          
    if(! $.cookies.get("no-website-tour") && isConnected )
        new makeWebsiteTour([
        {
            "selector"        : ".up_menu li.current",
            "position"        : "T",
            "text"            : "Add a relation between 2 nodes."
        },
        {
            "selector" 		: ".node_search.node_left",
            "position"        : "BR",
            "text"		: "Example: Barack Obama"
        }, {
            "selector" 		: ".node_search.node_right",
            "position"        : "BL",
            "text"		: "Example: Michelle Obama"
        }, {
            "selector" 		: ".select-type",
            "position"        : "T",
            "text"		: "How are the two related?"
        }, {
            "url"             : "./?screen=relation-review"
        }
        ], 0)
     

});

function updateRelationHint() {

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

function freeSetview(input) {
      
    if( input.val() == "" || input.val() == input.attr("placeholder") ) {
            
        var setview = $("#"+ input.attr("id").replace("to-", "") );

        $("h4", setview).html("");
        $("ul", setview).html("");
        $(":input[type=hidden]", setview).val("");            

        setview.addClass("loading");
        setview.addClass("default");
    }

}

function loadFreebaseData(data, input) {      
      
    var type = null;
    for(var i in data.type)
        if( data.type[i].id == "/people/person" || data.type[i].id == "/organization/organization")
            type = data.type[i].id;
      
    var setview = $("#"+ input.attr("id").replace("to-", "") );
      
    // *************************
    // * Load Data from Freebase
    // ***

    // if we know the mid (freebase id) of the target node
    // we can do a request to freebase.

    // complete an hidden input who keep the mid (freebase_id) and retrieve the setview
    $(":input[name="+ input.attr("id").replace("to-", "") + "-mid]").val(data.id);

    // Like you can see, we have a CALLBACK FONCTION in the url,
    // this one does a JSONP request from freebase api.
    // The callback function was "completeInfoFromFreebase".

    var src  = "http://www.freebase.com/api/service/mqlread?query=";


    // for a /people/person we have a particular kind of data set
    if(type == "/people/person")
        src  += '{ "query"%3A [{ "id"%3A "' + data.id + '"%2C "type"%3A "/people/person"%2C "name"%3A null%2C "profession"%3A []%2C "date_of_birth"%3A null%2C "gender"%3A null%2C "nationality"%3A []%2C "place_of_birth"%3A []%2C "places_lived"%3A [] }] }';
    // for organization we have an other kind of data set...
    else if(type == "/organization/organization")
        src  += '{ "query"%3A [{ "id"%3A "' + data.id + '"%2C "name"%3A null%2C "type"%3A "%2Forganization%2Forganization"%2C "headquarters"%3A [{ "*"%3A {} }] }] }';

    $.getJSON(src+"&callback=?", completeInfoFromFreebase);
    
    setview.addClass("loading");
    setview.removeClass("default");
         
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
                    setview =  $(".entity-desc:eq("+i+")");
            });
                  
            if(setview != null) {

                // change title
                $("h4", setview).html(node.name);
                $("ul", setview).html("");            
                
                // update the relation hint
                updateRelationHint();

                if(node.type == "/people/person") {

                    var data = [
                    {
                        type: "Type", 
                        values: ["Person"]
                    },

                    {
                        type: "Occupation", 
                        values: node.profession
                    },

                    {
                        type: "Date of Birth", 
                        values: [node.date_of_birth]
                    },

                    {
                        type: "Gender", 
                        values: [node.gender]
                    },

                    {
                        type: "Nationality", 
                        values: node.nationality
                    },

                    {
                        type: "Place of Birth ", 
                        values: [node.place_of_birth ]
                    }
                    ];

                } else {

                    var place = new Array();

                    if(typeof node.headquarters != "undefined")
                        for(var i in node.headquarters)
                            if( typeof node.headquarters[i].state_province_region == "object" )
                                if(node.headquarters[i].state_province_region != null)
                                    place.push(node.headquarters[i].state_province_region.name);                              

                    var data = [
                    {
                        type: "Type",  
                        values: ["Organization"]
                    }, {
                        type: "Place", 
                        values: place
                    }
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
