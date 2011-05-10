var data_rel;
                                   
var treeData = {
      nodes: new Array(), 
      links: new Array()
};
var force = null, vis;

$(function () {    
      


      $(".tooltips").tipsy({          
            gravity: 's',
            html: true,
            opacity:1,
            trigger: "manual"
      });



      /*************************
        * Pre-load template files
        ***/
      $.get("./appinc/template/tmpl/node-property.tmpl", {}, function(tmpl) {
            $.template( "node-property", tmpl);
      } );

      $.get("./appinc/template/tmpl/li-relation.tmpl", {}, function(tmpl) {
            $.template( "li-relation", tmpl);
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

            $(":input[name="+ $(this).attr("id").replace("to-", "") + "-mid]").val(data.id);
            relationBetweenNodes();

      }).bind("fb-required", function () { // fail event
            

            // Hack to hide every tipsy tooltips
            $(".node_search").each(function(i, n) {
                  $(n).tipsy("hide");
            });

            // show the right tooltips
            if( $(this).val() != "" && $(this).val() != $(this).attr("placeholder") )
                  $(this).tipsy("show"); 


      }).change(function () {
            
            if( $(this).val() == "" || $(this).val() == $(this).attr("placeholder") ) {
                  
                  $(":input[name="+ $(this).attr("id").replace("to-", "") + "-mid]").val("");
                  relationBetweenNodes();
            } 
      });
      

      $("#node-informations .close").click(function () {
                        
            $("#node-informations").animate({
                  
                  right: -990,
                  display: 'none'
                  
            }, 1200, 'easeOutBounce', function() {
                  
                  $("#node-informations .dynamique-content ul").html("");
                  
            });
            
            
      });
      
      $("#node-informations .relations tbody tr:not(.details)").live("click", function () {
            showRelationDetails(this);
      } );
   
      $(".relations .arrow,.relations .review").tipsy({
            gravity:"e", 
            live:true, 
            opacity:1
      });
      
      // if a default graph is called
      relationBetweenNodes();
      
      /********************
      * WEBSITE TOUR
      ***/          
      if(! $.cookies.get("no-website-tour") && isConnected)
            new makeWebsiteTour([
            {
                  "selector"        : ".up_menu li.current",
                  "position"        : "T",
                  "text"            : "See entities relations."
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
                  "selector" 		: ".rate-legend:eq(0)",
                  "position"        : "BR",
                  "text"		: "Slide the cursor left to see more relations"
            }, {
                  "selector" 		: ".rate-legend:eq(1)",
                  "position"        : "BL",
                  "text"		: "Slide the cursor right to see only the most valid relations"
            }, {
                  "end"             : true,
                  "url"             : "./"
            }
            ], 0);   
});


function loadFreebaseData(data) {
           
      var setview = $("#node-informations .freebase");
      $("#node-informations h4").html(data.label);
      $("#node-informations .relations table tbody").html("");
                  
      // *************************
      // * Load Data from database
      // ***
                  
      $.ajax({
            data: {
                  action : 'getNodeRelation',
                  id     : data.id
            }, 
            dataType: 'json',
            type: 'GET',
            url: "./",
            success: function (json) {
                  
                  for(var i in json) {
                        
                        var relation = {
                              label       : (data.id == json[i].node_left) ? json[i].node_right_label : json[i].node_left_label,
                              type        : json[i].type_label,
                              trust_level : json[i].trust_level,
                              odd         : i % 2 == 0 ? 'odd' : null,
                              relation_id          : json[i].id
                        };

                        $.tmpl("li-relation",  [relation]).appendTo( $("#node-informations .relations table tbody") );
                        
                  }
                  
                  
            }
      });
                  
      // *************************
      // * Load Data from Freebase
      // ***

      // cross domain query
      document.createElement("script");

      var header = document.getElementsByTagName("head")[0];         
      var script = document.createElement('script');
      script.type = 'text/javascript';


      // Like you can see, we have a CALLBACK FONCTION in the url,
      // this one does a JSONP request from freebase api.
      // The callback function was "completeInfoFromFreebase".

      script.src  = "http://www.freebase.com/api/service/mqlread?callback=completeInfoFromFreebase&query=";
      
      // for a /people/person we have a particular kind of data set
      if(data.type == "/people/person")
            script.src  += '{ "query"%3A [{ "id"%3A "' + data.freebase_id + '"%2C "type"%3A "/people/person"%2C "name"%3A null%2C "profession"%3A []%2C "date_of_birth"%3A null%2C "gender"%3A null%2C "nationality"%3A []%2C "place_of_birth"%3A []%2C "places_lived"%3A [] }] }';
      // for organization we have an other kind of data set...
      else if(data.type == "/organization/organization")
            script.src  += '{ "query"%3A [{ "id"%3A "' + data.freebase_id + '"%2C "name"%3A null%2C "type"%3A "%2Forganization%2Forganization"%2C "headquarters"%3A [{ "optional"%3A true%2C "*"%3A {}%2C "limit"%3A 1 }] }] }';

      header.appendChild(script);

      setview.addClass("loading");
      setview.removeClass("default");
         
}

    

// ***********************************
// * Complete information about a node
// * in the right block
// ***
function completeInfoFromFreebase(data) {
                  
      var setview = $("#node-informations .freebase");
      
      if( $("#node-informations").css("display") == 'none' ) {
            
            $("#node-informations").show().css({
                  right: -990
            });
            
      }
            
      $("#node-informations").stop().animate({
            right: 0
      }, 700, 'easeOutBounce');
      
      
      if(data.status == "200 OK") {

            if(data.result.length > 0) {

                  var node = data.result[0];


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
                  

            }

      }
}


function relationBetweenNodes() {


      if( $(".entity-left-mid").val()  != "" 
      ||  $(".entity-right-mid").val() != "" ) {
            
            $.ajax({      
                  url:"./?action=getMergeRelationNodes",
                  data: $(".classic-form form").serialize(),
                  dataType: "json",
                  type: "post",
                  success: function (data) {                                             
                        resetDataVis(data); 
                  }
            });       
            
      } else resetDataVis({relations:[],nodes:[]});
      
}

function updatePermalink() {
      
      if( $(".entity-left-mid").val()  != "" 
      ||  $(".entity-right-mid").val() != "" ) {
            
            var permalink = "?screen=relation-visualize&rel=";
            permalink    += $(".entity-left-mid").val()  != "" ? $(".entity-left-mid").val() + "|"  : "";
            permalink    += $(".entity-right-mid").val() != "" ? $(".entity-right-mid").val()       : "";
            permalink    += "&trust_rank=" + $( ":input[name=rate]" ).val();
            
            $("h3 a.permalink").attr("href", permalink).show();
            
      } else $("h3 a.permalink").attr("href", "").hide();
}


function resetDataVis(data) {
      
      // update the permalink
      updatePermalink();
      
      if(data != undefined) data_rel = data;
      
      var nodes = new Array(); 
      var links = new Array();
      

      $.each(data_rel.relations, function(i, rel) {                           

            if(rel.trust_level >= $(":input[name=rate]").val() ) {
                  if( !idExist(nodes, rel.node_left) )
                        nodes.push( { 
                              nodeName    : rel.node_left,
                              name        : rel.node_left,
                              id          : rel.node_left,
                              label       : rel.node_left_label,
                              freebase_id : rel.node_left_freebase_id,
                              type        : rel.node_left_type,
                              group       : isTarget(rel.node_left_freebase_id) ? 1 : 2
                        } );

                  if( !idExist(nodes, rel.node_right) )
                        nodes.push( { 
                              nodeName    : rel.node_right,
                              name        : rel.node_right,
                              id          : rel.node_right,
                              label       : rel.node_right_label,
                              freebase_id : rel.node_right_freebase_id,
                              type        : rel.node_right_type,
                              group       : isTarget(rel.node_right_freebase_id) ? 1 : 2
                        } );

                  if( idExist(nodes, rel.node_right) && idExist(nodes, rel.node_left) ) {

                        if( !idExist(links, rel.id) )

                              links.push({ 
                                    source     : getIndex(nodes, rel.node_left), 
                                    target     : getIndex(nodes, rel.node_right), 
                                    id         : rel.id,
                                    value      : 1000 * (rel.trust_level-1),
                                    trust_level : rel.trust_level
                              });
                  }
            }

      });       

      $.each(data_rel.nodes, function(i, node) {               
            
            if( !idExist(nodes, node.id) )
                  nodes.push( { 
                        nodeName    : node.id,
                        name        : node.id,
                        id          : node.id,
                        label       : node.label,
                        freebase_id : node.freebase_id,
                        type        : node.type,
                        group       : 1
                  } );             

      });       
      
      $(".tooltips").tipsy("show");                  
      // regarde si une relation existe entre les deux nodes      
      if( $(".entity-left-mid").val() != "" && $(".entity-right-mid").val() != "") {
          
          
            var midLeft  = $(".entity-left-mid").val();
            var midRight = $(".entity-right-mid").val();
          
            var i = 0;
            for(i in data_rel.relations) {
              
                  var r = data_rel.relations[i];
              
                  var a = (r.node_left_freebase_id  == midLeft && r.node_right_freebase_id == midRight);
                  var b = (r.node_right_freebase_id == midLeft && r.node_left_freebase_id  == midRight);

                  if(a || b) {
                        $(".tooltips").tipsy("hide");
                        break;
                  }
              
            }
          
          
      } else $(".tooltips").tipsy("hide");  
 
      
      // if the force layout are defined and SVG supported
      if(Modernizr.svg) {      
                  
            treeData.nodes = nodes;
            treeData.links = links;
            
            if(force != null) {
                  
                  force.nodes(treeData.nodes)
                  force.links(treeData.links);
                  force.reset();
                  
            } 
            
            if(typeof vis != "undefined") vis.render();  
            
      }
      
      
}

function showRelationDetails(element) {
      
      if(! $(element).hasClass("open") ) {
            
            $("tr.open").removeClass("open");
            $(element).addClass("open");            
            $("tr.details div.content").slideUp(300, function () {
                  $(this).parents("tr.details").remove();
            });
            
            var tr = "<tr class='details " + ( $(element).hasClass("odd") ? "odd" : "" ) + "'>\n\
                              <td colspan='5'>\n\
                                    <div class='content' style='display:none'>\n\
                                          <div style='text-align:center; color:#A86372;' class='load'>Loading...</div>\n\
                                    </div>\n\
                              </td>\n\
                      </tr>";

            $(tr).insertAfter(element);
            $("tr.details .content").slideDown(300);
            
            $.getJSON("./?action=getRelationValues&relation_id=" + $(element).data("relation-id"), function(data) {                  
                                    
                  var html = "";                  
                  $.each(data, function(key, d) {
                        if(d.value != "") {
                              if(d.label == "Source")
                                    html += "<li>"+ d.label + ": <span style='color:#A86372'><a href='"+ d.value + "' target='_blank'>"+ d.value + "</a></span></li>";
                              else
                                    html += "<li>"+ d.label + ": <span style='color:#A86372'>"+ d.value + "</span></li>";
                        } 
                  });        
                  
                  $("tr.details .content > .load").slideUp(300, function () { 
                        if(html != "") {
                              $("tr.details .content").html("<ul style='display:none'>" + html + "</ul>");
                              $("tr.details .content > ul").slideDown(300);
                        } else {
                              $("tr.details .content").html("<div style='text-align:center; color:#A86372;' class='load'>No data available</div>");                              
                        }
                  });
            });
            
            
      } else {            
            
            $("tr.open").removeClass("open");     
            $("tr.details div.content").slideUp(300, function () {
                  $(this).parents("tr.details").remove();
            });
      }
      
}

function idExist(arr, id) {
      
      var i;
      for(i = 0; i < arr.length && arr[i].id != id ; i++) ;
      
      return i  < arr.length;
      
}


function getIndex(arr, id) {
      
      var i;
      for(i = 0; i < arr.length && arr[i].id != id ; i++) ;
      
      return ( i  < arr.length ) ? i : -1;
      
}

function isTarget(freebase_id) {
      
      return $(":input[name=entity-left-mid]").val() == freebase_id ^ $(":input[name=entity-right-mid]").val()  == freebase_id;
}



function relationsRender() {
      

            if (Modernizr.svg){ 
                  
                  vis = new pv.Panel()
                        .width( $("#visualize-layout").outerWidth() )
                        .height( $("#visualize-layout").outerHeight() )
                        .fillStyle("rgba(255,255,255,0.01)")    
                        .event("mousedown", pv.Behavior.pan())
                        .event("mousewheel", pv.Behavior.zoom());  
                  
                  // store panel to zoom (later)
                  panel = vis;
                  
                  force = vis.add(pv.Layout.Force)
                        .nodes(treeData.nodes)
                        .links(treeData.links)
                        .chargeConstant(-100)
                        .springLength(120)
                        .bound(true);
                        
                  force.link.add(pv.Line)
                      .lineWidth(2)
                      .strokeStyle("rgba(255,250,255,0.7)");

                  force.node.add(pv.Dot)
                        .event("dblclick", function (d) {loadFreebaseData(d);})
                        .radius(function(d) {return 5 + d.linkDegree/10000} )
                        .fillStyle(function(d)    {return d.type == "/organization/organization" ? "#DAE9EA" : "#432946"})
                        .lineWidth(function(d)    {return d.group == 1 ? 2 : 2} )
                        .strokeStyle( function(d) {return d.type == "/organization/organization" ? "#432946" : "#DAE9EA"})
                        .title(function(d) {return d.freebase_id} )
                        .event("mousedown", pv.Behavior.drag())
                        .event("drag", force)
                        .anchor("top")
                              .add(pv.Label)
                                    .text( function (d) {return d.label})
                                    .font(function(d) {return d.group == 1 ? "bold 16px Verdana" : "bold 12px Verdana";})
                                    .textStyle("#432946")
                                    .textAlign("center")
                                    .textDecoration("none");
                  vis.render();
                  
                  

            } else {

                  $(function () {
                        $("#visualize-layout").append('<div class="nograph">Your web browser cannot display the graph. Please, use <a href="http://www.mozilla-europe.org/fr/firefox/">Mozilla Firefox</a> or <a href="http://www.google.com/chrome">Google Chrome</a>.</div>');
                  });
            }
}