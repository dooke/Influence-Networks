
$(document).ready(function () {  
      
    /*************************
      * Pre-load template files
      ***/
    $.get("./appinc/template/tmpl/node-property.tmpl", {}, function(tmpl) {
        $.template( "node-property", tmpl);
    } );
    $.get("./appinc/template/tmpl/form-type-property.tmpl", {}, function(tmpl) {
        $.template( "form-type-property", tmpl);
    } );
     
      
    /*************
       * Put event *
       *************/
      
      
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
        required: true
        
        
    }).bind("fb-select", function(e, data) { // select event
        
        // hide tooltips when we select an entity
       $(this).tipsy("hide"); 
        
        // load data from freebase
        loadFreebaseData(data, $(this) );
        
    }).bind("fb-required", function () { // fail event
        
       // Hack to hide every tipsy tooltips
       $(".node_search").each(function(i, n) { $(n).tipsy("hide"); });
       
       // show the right tooltips
       if( $(this).val() != "" && $(this).val() != $(this).attr("placeholder") )
            $(this).tipsy("show"); 
       
    });
      
      
    $(".node_search").change(function () {           
        freeSetview( $(this) );                      
    });
      
      
    /********************
      * Form for each type
      ***/    
    $(":input[name=relation_type]").change(function () {
           
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
            if( $(this).val() == "" || $(this).val() == $(this).attr("placeholder") ) {
                        
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

    // cross domain query
    document.createElement("script");

    var header = document.getElementsByTagName("head")[0];         
    var script = document.createElement('script');
    script.type = 'text/javascript';

    // if we know the mid (freebase id) of the target node
    // we can do a request to freebase.

    // complete an hidden input who keep the mid (freebase_id) and retrieve the setview
    $(":input[name="+ input.attr("id").replace("to-", "") + "-mid]").val(data.id);

    // Like you can see, we have a CALLBACK FONCTION in the url,
    // this one does a JSONP request from freebase api.
    // The callback function was "completeInfoFromFreebase".

    script.src  = "http://www.freebase.com/api/service/mqlread?callback=completeInfoFromFreebase&query=";


    // for a /people/person we have a particular kind of data set
    if(type == "/people/person")
        script.src  += '{ "query"%3A [{ "id"%3A "' + data.id + '"%2C "type"%3A "/people/person"%2C "name"%3A null%2C "profession"%3A []%2C "date_of_birth"%3A null%2C "gender"%3A null%2C "nationality"%3A []%2C "place_of_birth"%3A []%2C "places_lived"%3A [] }] }';
    // for organization we have an other kind of data set...
    else if(type == "/organization/organization")
        script.src  += '{ "query"%3A [{ "id"%3A "' + data.id + '"%2C "name"%3A null%2C "type"%3A "%2Forganization%2Forganization"%2C "headquarters"%3A [{ "*"%3A {} }] }] }';


    header.appendChild(script);

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
