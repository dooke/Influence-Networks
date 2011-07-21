(function(window, $, undefined) {
    
    // CURRENT APP INSTANCE
    window.page = {};

    // array of relations
    window.page.data_rel = [];

    // tree created
    window.page.treeData = {
          nodes: new Array(), 
          links: new Array()
    };
    
    // Protovis Visualization
    window.page.vis = {};
    
    // force layout
    window.page.force = null;
    
    /**
     * Init the page
     * @function
     * @public
     */
    page.init = function() {      
        
        // RATE SLIDER INITIALIZATION            
        page.initRateSlide();

        // LOAD TEMPLATES
        page.loadTemplate();


        $(".embed-field input").click(function(event) {
            $(this).select();
            event.preventDefault();
        });


        $(".visu-tool .embed").click(function(event) {
            page.showVisuEmbed(event);
        });


        $(".node_search").suggest({

            // looking for person or organization
            type: ["/people/person", "/organization/organization"],
            // result must be strict
            type_strict: "any",
            all_types: true,
            // selection is required
            required: true


        }).bind("fb-select", page.selectEntity)
        .bind("fb-required", function () { });


        $("#node-informations .close").click(function () {

            $("#node-informations").animate({
                  right: -990,
                  display: 'none'
            }, 1200, 'easeOutBounce', function() {
                  $("#node-informations .dynamique-content ul").html("");
            });

        });

        $("#node-informations .relations tbody tr:not(.details)").live("click", function () {
            page.showRelationDetails(this);
        } );

        $(".relations .arrow,.relations .review").tipsy({
            gravity:"e", 
            live:true, 
            opacity:1
        });

        // if a default graph is called
        page.relationBetweenNodes();
        
        // disabled some inputs
        $(".step.disabled :input").prop("disabled", true);
        
        // cancel entity selection
        $(".entity .cancel").live("click", function() { page.cancelEntitySelection.call(this) });
    };
    

    /**
     * 
     * @function
     * @public
     */
    page.cancelEntitySelection = function() {
        
        var $entity = $(this).parents(".entity"),
            $mid  = $( $entity.attr("rel") ),
            $input = $( $mid.data("input") );
        
        // hide entity information
        $entity.addClass("hidden");
        
        // empty search input and hidden input
        $mid.val("");        
        $input.val("");
        
        // enabled the field
        $input.parents(".step").removeClass("disabled").find(":input").prop("disabled", false).focus();
                
        // reset the visualization
        page.relationBetweenNodes();
        
    };
    

    /**
     * 
     * @function
     * @public
     */
    page.selectEntity = function(e, data) { // select event

        var $this = $(this);
        
        // complete hidden input
        $( $this.data("entity") ).val(data.id);

        // find the preview field
        var preview = $( $this.data("preview") );
        
        // determine the type
        var type = null;        
        // look for the type of the relation
        $.each(data.type, function(i, val) {
            // type must be an organization or a person
            if(val.id == "/organization/organization" || val.id == "/people/person")
                type = val.id;
        });
        
        // find the topic
        preview.find(".topic")
               .freebaseTopic("reset")
               .data("mid", data.id)
               .data("type", type)
               .html(data.name);
                           
        // show the preview field
        preview.removeClass("hidden");
        
        // disable the field
        $this.prop("disabled", true).parents(".step").addClass("disabled");
         
        // update the graph
        page.relationBetweenNodes();

    };
    

    /**
     * 
     * @function
     * @public
     */
    page.initRateSlide = function() {
        
        $( "#rate-slider" ).slider({
              value: $( ":input[name=rate]" ).val(),
              min: 1,
              max: 5,
              step: 0.1,
              orientation: "horizontal",
              slide: function( event, ui ) {
                    $( ":input[name=rate]" ).val( ui.value );
                    if(page.data_rel != undefined) page.resetDataVis();

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
        
    }
    
    
    
    /**
     * 
     * @function
     * @public
     */
    page.relationBetweenNodes = function() {
          
          if( $(".entity-left-mid").val()  != "" 
          ||  $(".entity-right-mid").val() != "" ) {

                $.ajax({
                      url:      "./?action=getMergeRelationNodes",
                      data:     $(".classic-form form").serialize(),
                      dataType: "json",
                      type:     "post",
                      success:  function (data) {
                            page.resetDataVis(data); 
                      }
                });       

          } else page.resetDataVis({relations:[],nodes:[]});

    };

    /**
     * 
     * @function
     * @public
     */
    page.updatePermalink = function() {
      
        if( $(".entity-left-mid").val()  != "" 
        ||  $(".entity-right-mid").val() != "" ) {

            // permalink
            var permalink = "?screen=relation-visualize&rel=";
            permalink    += $(".entity-left-mid").val()  != "" ? $(".entity-left-mid").val() + "|"  : "";
            permalink    += $(".entity-right-mid").val() != "" ? $(".entity-right-mid").val()       : "";
            permalink    += "&trust_rank=" + $( ":input[name=rate]" ).val();

            $(".visu-tool li.permalink a").attr("href", permalink).parents("li").show();

            // embed 
            var embed = "?screen=relation-visualize-embed&rel=";
            embed    += $(".entity-left-mid").val()  != "" ? $(".entity-left-mid").val() + "|"  : "";
            embed    += $(".entity-right-mid").val() != "" ? $(".entity-right-mid").val()       : "";
            embed    += "&trust_rank=" + $( ":input[name=rate]" ).val();

            $(".visu-tool li.embed a").attr("href", embed).parents("li").show();

        } else $(".visu-tool li.permalink a, .visu-tool li.embed a").attr("href", "").parents("li").hide();

    };


    /**
     * 
     * @function
     * @public
     */
    page.resetDataVis = function(data) {

        page.updatePermalink();

        if (data != undefined) page.data_rel = data;

        var nodes = new Array();
        var links = new Array();

        $.each(page.data_rel.relations, function(i, rel) {

            if (rel.trust_level >= $(":input[name=rate]").val()) {
                if (!page.idExist(nodes, rel.node_left))
                    nodes.push({
                        nodeName : rel.node_left,
                        name : rel.node_left,
                        id : rel.node_left,
                        label : rel.node_left_label,
                        freebase_id : rel.node_left_freebase_id,
                        type : rel.node_left_type,
                        group : page.isTarget(rel.node_left_freebase_id) ? 1 : 2
                    });

                if (!page.idExist(nodes, rel.node_right))
                    nodes.push({
                        nodeName : rel.node_right,
                        name : rel.node_right,
                        id : rel.node_right,
                        label : rel.node_right_label,
                        freebase_id : rel.node_right_freebase_id,
                        type : rel.node_right_type,
                        group : page.isTarget(rel.node_right_freebase_id) ? 1 : 2
                    });

                if (page.idExist(nodes, rel.node_right)
                && page.idExist(nodes, rel.node_left)) {

                    if (!page.idExist(links, rel.id))

                        links.push({
                            source : page.getIndex(nodes, rel.node_left),
                            target : page.getIndex(nodes, rel.node_right),
                            id : rel.id,
                            value : 1000 * (rel.trust_level - 1),
                            trust_level : rel.trust_level
                        });
                }
            }

        });

        $.each(page.data_rel.nodes, function(i, node) {

            if (!page.idExist(nodes, node.id))
                nodes.push({
                    nodeName : node.id,
                    name : node.id,
                    id : node.id,
                    label : node.label,
                    freebase_id : node.freebase_id,
                    type : node.type,
                    group : 1
                });
        });
        
        // there is a relationship between nodes ?       
        if ($(".entity-left-mid").val() != "" && $(".entity-right-mid").val() != "") {

            var midLeft = $(".entity-left-mid").val();
            var midRight = $(".entity-right-mid").val();

            var i = 0;
            for (i in page.data_rel.relations) {

                var r = page.data_rel.relations[i];

                var a = (r.node_left_freebase_id  == midLeft && r.node_right_freebase_id == midRight);
                var b = (r.node_right_freebase_id == midLeft && r.node_left_freebase_id  == midRight);

            }
        }
                
        page.treeData.nodes = nodes;
        page.treeData.links = links;

        if (page.force != null && Modernizr.svg) {
            
            page.force.nodes(page.treeData.nodes)
            page.force.links(page.treeData.links);
            page.force.reset();                        

            if (typeof page.vis != "undefined" && page.treeData.nodes.length > 0)
                page.vis.render();
        }
    };

    /**
     * 
     * @function
     * @public
     */
    page.showRelationDetails = function(element) {
      
        if(! $(element).hasClass("open") ) {

            $("tr.open").removeClass("open");
            $(element).addClass("open");            
            $("tr.details div.content").slideUp(300, function () {
                  $(this).parents("tr.details").remove();
            });

            var tr = "<tr class='details " + ( $(element).hasClass("odd") ? "odd" : "" ) + "'>\n\
                              <td colspan='5'>\n\
                                    <div class='content' style='display:none'>\n\
                                          <div style='text-align:center;' class='load'>Loading...</div>\n\
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
                                    html += "<li>"+ d.label + ": <span><a href='"+ d.value + "' target='_blank'>"+ d.value + "</a></span></li>";
                              else
                                    html += "<li>"+ d.label + ": <span>"+ d.value + "</span></li>";
                        } 
                  });        

                  $("tr.details .content > .load").slideUp(300, function () { 
                        if(html != "") {
                              $("tr.details .content").html("<ul style='display:none'>" + html + "</ul>");
                              $("tr.details .content > ul").slideDown(300);
                        } else {
                              $("tr.details .content").html("<div style='text-align:center;' class='load'>No data available</div>");                              
                        }
                  });
            });


        } else {            

            $("tr.open").removeClass("open");     
            $("tr.details div.content").slideUp(300, function () {
                  $(this).parents("tr.details").remove();
            });
        }

    };

    /**
     * 
     * @function
     * @public
     */
    page.idExist = function (arr, id) {
      
      var i;
      for(i = 0; i < arr.length && arr[i].id != id ; i++) ;
      
      return i  < arr.length;

    };


    /**
     * 
     * @function
     * @public
     */
    page.getIndex = function(arr, id) {
      
      var i;
      for(i = 0; i < arr.length && arr[i].id != id ; i++) ;
      
      return ( i  < arr.length ) ? i : -1;

    };

    /**
     * 
     * @function
     * @public
     */
    page.isTarget = function(freebase_id) {
        return $(":input[name=entity-left-mid]").val() == freebase_id ^ $(":input[name=entity-right-mid]").val()  == freebase_id;
    };


    /**
     * 
     * @function
     * @public
     */
    page.showVisuEmbed = function(event) {

        event.preventDefault();

        // show field
        $(".embed-field").fadeIn(400);
        // put the right code
        $(".embed-field input").val(   $(".embed-field input").data("code").replace("@@URL@@", $(".embed-field input").data("url") + $("a.embed").attr("href")) );      
        // show mask
        $("#mask").hide().fadeIn(400).unbind("click").bind("click", function() {
            $("#mask").fadeOut(400);
            $(".embed-field").fadeOut(400);
        });

    };


    /**
     * 
     * @function
     * @public
     */
    page.relationsRender = function() {

        var lastMouseDown = 0;

        if (Modernizr.svg) {

            page.vis = new pv.Panel()
                        // the same width if the contener
                        .width($("#visualize-layout").outerWidth())
                        // the same height if the contener
                        .height($("#visualize-layout").outerHeight())
                        // transparent color
                        .fillStyle("rgb(255,255,255)");

            //  zoom with mouswheel (disable)
            if (Modernizr.svg && 0)
                page.vis.event("mousewheel", pv.Behavior.zoom());

            // registers the mousedown time to distingate the click to the drag event
            pv.listen($("#visualize-layout")[0], "mousedown", function() {
                lastMouseDown = new Date().getTime();        
            });
            
            page.force = page.vis.add(pv.Layout.Force)
                        // sets nodes data
                        .nodes(page.treeData.nodes)
                        // sets links data
                        .links(page.treeData.links)
                        // minimum lenght bewteen nodes
                        .springLength(120)
                        .chargeConstant(-100)
                        .bound(true);
                        
            // desables animation for flash
            if (!Modernizr.svg) page.force.iterations(99);
                        

            // creates line for each link
            page.force.link.add(pv.Line)
                        // line width
                        .lineWidth(2)
                        // line color
                        .strokeStyle("#163d59");

            // creates dots for each nodes
            page.force.node.add(pv.Dot)
                // dot radius according to the link degree (number of links)
                .shapeRadius(function(d) {
                    return 5 + (d.linkDegree*2)/10000
                })
                // change the node color according to the node type
                .fillStyle(function(d) {
                    return d.type == "/organization/organization" ? "#4abcff" /* organization*/ : "#6f9fbb" /* person */
                })
                // border size according to the node type
                .lineWidth(function(d) {
                    return 2;
                })
                // border color 
                .strokeStyle(function(d) {
                    return "#163d59"
                })
                // title of the node (on mouse hover) according to the node type
                .title(function(d) {
                    return d.freebase_id
                })
                // event to enable the force behavior
                .event("drag", page.force)
                // event to enable the drag event on each node
                .event("mousedown", pv.Behavior.drag())
                // event to show the list of relations for each nodes
                .event("mouseup", function() {     

                    var d = page.treeData.nodes[this.index];

                    // we add a temporisation to distingate click and drag
                    if (new Date().getTime() - lastMouseDown < 400) {

                        lastMouseDown = 0;

                        // show the list
                        page.entityRelationDetails(d);
                    }

                })
                // add an anchor to the node to align label to the top of the dot
                .anchor("top")
                // create a label
                    .add(pv.Label)
                        // change the font appearence
                        .font(function(d) {
                            return d.group == 1 ? "bold 16px sans-serif" : "bold 13px sans-serif";
                        })
                        // text color
                        .textStyle("#163d59")
                        // centers the label
                        .textAlign("center")
                        // disables text decoration
                        .textDecoration("none")
                        // add the text content
                        .text(function(d) {
                            return d.label
                        });

            // do the visualization render
            try { 
                page.vis.render();
            } catch(e) {  /* empty exception to clear an idiot IE alert  */ }
        }
    };
    
    
    page.entityRelationDetails = function(data) {        

        var setview = $("#node-informations .freebase");
        $("#node-informations h4").html(data.label);
        $("#node-informations .relations table tbody").html("");

        // *************************
        // * Load Data from database
        // ***
        $.getJSON("./", { action : 'getNodeRelation', id : data.id }, function (json) { 

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

        });

        if( $("#node-informations").css("display") == 'none' )
            $("#node-informations").show().css({ right: -990 });

        $("#node-informations").stop().animate({ right: 0 }, 700, 'easeOutBounce');

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

        $.get("./appinc/template/tmpl/li-relation.tmpl", {}, function(tmpl) {
            $.template( "li-relation", tmpl);
        });
    };
    
    
    // WHEN THE DOCUMENT IS READY, INIT THE APP
    $(document).ready(page.init);
    
})(window, jQuery);


$(function () {  
      
      
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


