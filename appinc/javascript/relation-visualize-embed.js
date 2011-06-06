var data_rel;
var treeData = {
    nodes : [],
    links : []
};
var force = null, vis;

$(function() {

    $(".tooltips").tipsy({
        gravity : 's',
        html : true,
        opacity : 1,
        trigger : "manual"
    });

    /***************************************************************************
     * Pre-load template files
     **************************************************************************/
    $.get("./appinc/template/tmpl/node-property.tmpl", {}, function(tmpl) {
        $.template("node-property", tmpl);
    });

    $.get("./appinc/template/tmpl/li-relation.tmpl", {}, function(tmpl) {
        $.template("li-relation", tmpl);
    });

    /***************************************************************************
     * Put event *
     **************************************************************************/
    $("#node-informations .close").click(function() {
		
        $("#node-informations").animate({

            left : "110%"

        }, 1200, 'easeOutBounce', function() {
			
            $("#node-informations .dynamique-content ul").empty();

        });

    });

    
    $("#node-informations .relations tbody tr:not(.details)").live("click", function() {
        showRelationDetails(this);
    });
    

    $(".relations .arrow,.relations .review").tipsy({
        gravity : "e",
        live : true,
        opacity : 1
    });

    // if a default graph is called
    relationBetweenNodes();

});

function loadFreebaseData(data) {
        
    
    $("#node-informations h4").html(data.label);        
    $("#node-informations .relations table tbody").empty();        
        
        
    // * Load Data from database
    $.ajax({
        data : {
            action : 'getNodeRelation',
            id : data.id
        },
        dataType : 'json',
        type : 'GET',
        url : "./",
        success : function(json) {
                        
            for ( var i in json) {

                var relation = {
                    label : (data.id == json[i].node_left) ? json[i].node_right_label : json[i].node_left_label,
                    type : json[i].type_label,
                    trust_level : json[i].trust_level,
                    odd : i % 2 == 0 ? 'odd' : null,
                    relation_id : json[i].id
                };

                $.tmpl("li-relation", [ relation ]).appendTo( $("#node-informations .relations table tbody") );                
            }

        }
    });

    // * Load Data from Freebase
    // Like you can see, we have a CALLBACK FUNCTION in the url,
    // this one does a JSONP request from freebase api.

    var script = "http://www.freebase.com/api/service/mqlread?query=";

    // for a /people/person we have a particular kind of data set
    if (data.type == "/people/person")
        script += '{ "query"%3A [{ "id"%3A "' + data.freebase_id + '"%2C "type"%3A "/people/person"%2C "name"%3A null%2C "profession"%3A []%2C "date_of_birth"%3A null%2C "gender"%3A null%2C "nationality"%3A []%2C "place_of_birth"%3A []%2C "places_lived"%3A [] }] }';
    // for organization we have an other kind of data set...
    else if (data.type == "/organization/organization")
        script += '{ "query"%3A [{ "id"%3A "' + data.freebase_id + '"%2C "name"%3A null%2C "type"%3A "%2Forganization%2Forganization"%2C "headquarters"%3A [{ "optional"%3A true%2C "*"%3A {}%2C "limit"%3A 1 }] }] }';

    $.getJSON(script + "&callback=?", function(data) { completeInfoFromFreebase(data) });


    $("#node-informations .freebase").addClass("loading").removeClass("default");

}

// ***********************************
// * Complete information about a node
// * in the right block
// ***
function completeInfoFromFreebase(data) {

    var setview = $("#node-informations .freebase");

    if ($("#node-informations").css("display") == 'none') {

        $("#node-informations").show().css({
            left : "110%"
        });

    }

    $("#node-informations").animate({
        left : "1%"
    }, 700, 'easeOutBounce');
	
    if (data.status == "200 OK") {

        if (data.result.length > 0) {

            var node = data.result[0];

            // change title
            $("h4", setview).html(node.name);
            $("ul", setview).html("");

            if (node.type == "/people/person") {

                var data = [ {
                    type : "Type",
                    values : [ "Person" ]
                },

                {
                    type : "Occupation",
                    values : node.profession
                },

                {
                    type : "Date of Birth",
                    values : [ node.date_of_birth ]
                },

                {
                    type : "Gender",
                    values : [ node.gender ]
                },

                {
                    type : "Nationality",
                    values : node.nationality
                },

                {
                    type : "Place of Birth ",
                    values : [ node.place_of_birth ]
                } ];

            } else {

                var place = new Array();

                if (typeof node.headquarters != "undefined")
                    for ( var i in node.headquarters)
                        if (typeof node.headquarters[i].state_province_region == "object")
                            if (node.headquarters[i].state_province_region != null)
                                place
                                .push(node.headquarters[i].state_province_region.name);

                var data = [ {
                    type : "Type",
                    values : [ "Organization" ]
                }, {
                    type : "Place",
                    values : place
                } ];

            }

            $.tmpl("node-property", data).appendTo( $("ul", setview) );
            $(setview).removeClass("loading");

        }

    }
}

function relationBetweenNodes() {

    if ($(".entity-left-mid").val() != "" || $(".entity-right-mid").val() != "") {

        $.ajax({
            url : "./?action=getMergeRelationNodes",
            data : $(".classic-form form").serialize(),
            dataType : "json",
            type : "post",
            success : function(data) {

                resetDataVis(data);
            }
        });

    } else resetDataVis({
        relations : [],
        nodes : []
    });

}

function resetDataVis(data) {

    if (data != undefined) data_rel = data;

    var nodes = new Array();
    var links = new Array();

    $.each(data_rel.relations,
        function(i, rel) {

            if (rel.trust_level >= $(":input[name=rate]").val()) {
                if (!idExist(nodes, rel.node_left))
                    nodes.push({
                        nodeName : rel.node_left,
                        name : rel.node_left,
                        id : rel.node_left,
                        label : rel.node_left_label,
                        freebase_id : rel.node_left_freebase_id,
                        type : rel.node_left_type,
                        group : isTarget(rel.node_left_freebase_id) ? 1 : 2
                    });

                if (!idExist(nodes, rel.node_right))
                    nodes.push({
                        nodeName : rel.node_right,
                        name : rel.node_right,
                        id : rel.node_right,
                        label : rel.node_right_label,
                        freebase_id : rel.node_right_freebase_id,
                        type : rel.node_right_type,
                        group : isTarget(rel.node_right_freebase_id) ? 1 : 2
                    });

                if (idExist(nodes, rel.node_right)
                    && idExist(nodes, rel.node_left)) {

                    if (!idExist(links, rel.id))

                        links.push({
                            source : getIndex(nodes, rel.node_left),
                            target : getIndex(nodes, rel.node_right),
                            id : rel.id,
                            value : 1000 * (rel.trust_level - 1),
                            trust_level : rel.trust_level
                        });
                }
            }

        });

    $.each(data_rel.nodes, function(i, node) {

        if (!idExist(nodes, node.id))
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

    $(".tooltips").tipsy("show");
    // regarde si une relation existe entre les deux nodes
    if ($(".entity-left-mid").val() != "" && $(".entity-right-mid").val() != "") {

        var midLeft = $(".entity-left-mid").val();
        var midRight = $(".entity-right-mid").val();

        var i = 0;
        for (i in data_rel.relations) {

            var r = data_rel.relations[i];

            var a = (r.node_left_freebase_id == midLeft && r.node_right_freebase_id == midRight);
            var b = (r.node_right_freebase_id == midLeft && r.node_left_freebase_id == midRight);

            if (a || b) {
                $(".tooltips").tipsy("hide");
                break;
            }

        }

    } else
        $(".tooltips").tipsy("hide");

    treeData.nodes = nodes;
    treeData.links = links;

    if (force != null) {

        force.nodes(treeData.nodes)
        force.links(treeData.links);
        force.reset();

        if (typeof vis != "undefined" && treeData.nodes.length > 0)
            vis.render();

    }

}

function showRelationDetails(element) {

    if (!$(element).hasClass("open")) {

        $("tr.open").removeClass("open");
        $(element).addClass("open");
        $("tr.details div.content").slideUp(300, function() {
            $(this).parents("tr.details").remove();
        });

        var tr = "<tr class='details "
        + ($(element).hasClass("odd") ? "odd" : "")
        + "'>\n\
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
                
                $.each(
                    data,
                    function(key, d) {
                        if (d.value != "") {
                            if (d.label == "Source")
                                html += "<li>"
                                + d.label
                                + ": <span style='color:#A86372'><a href='"
                                + d.value
                                + "' target='_blank'>"
                                + d.value
                                + "</a></span></li>";
                            else
                                html += "<li>"
                                + d.label
                                + ": <span style='color:#A86372'>"
                                + d.value
                                + "</span></li>";
                        }
                    });

                $("tr.details .content > .load")
                .slideUp(
                    300,
                    function() {
                        if (html != "") {
                            $("tr.details .content")
                            .html(
                                "<ul style='display:none'>"
                                + html
                                + "</ul>");
                            $(
                                "tr.details .content > ul")
                            .slideDown(300);
                        } else {
                            $("tr.details .content")
                            .html(
                                "<div style='text-align:center; color:#A86372;' class='load'>No data available</div>");
                        }
                    });
            });

    } else {

        $("tr.open").removeClass("open");
        $("tr.details div.content").slideUp(300, function() {
            $(this).parents("tr.details").remove();
        });
    }

}

function idExist(arr, id) {

    var i;
    for (i = 0; i < arr.length && arr[i].id != id; i++);

    return i < arr.length;

}

function getIndex(arr, id) {

    var i;
    for (i = 0; i < arr.length && arr[i].id != id; i++);

    return (i < arr.length) ? i : -1;

}

function isTarget(freebase_id) {

    return $(":input[name=entity-left-mid]").val() == freebase_id ^ $(":input[name=entity-right-mid]").val() == freebase_id;
}

function relationsRender() {
    
    var lastMouseDown = 0;

    vis = new pv.Panel()
                // the same width if the contener
                .width($("#visualize-layout").outerWidth())
                // the same height if the contener
                .height($("#visualize-layout").outerHeight())
                // transparent color
                .fillStyle("rgba(255,255,255,0.01)");

    // enable zoom and deplacement for flash
    if (Modernizr.svg) {
        // deplacement event
        vis.event("mousedown", pv.Behavior.pan())
           // zoom event
           .event("mousewheel", pv.Behavior.zoom());
    }

    // registers the mousedown time to distingate the click to the drag event
    pv.listen($("#visualize-layout")[0], "mousedown", function() {
        lastMouseDown = new Date().getTime();        
    });

    // store panel to zoom (later)
    var panel = vis;

    force = vis.add(pv.Layout.Force)
                // sets nodes data
                .nodes(treeData.nodes)
                // sets links data
                .links(treeData.links)
                // minimum lenght bewteen nodes
                .springLength(120).chargeConstant(-100);

    // desables animation for flash
    if (!Modernizr.svg) force.iterations(399);

    // creates line for each link
    force.link.add(pv.Line)
                // line width
                .lineWidth(2)
                // line color
                .strokeStyle("#DAE9EA");

    // creates dots for each nodes
    force.node.add(pv.Dot)
        // dot radius according to the link degree (number of links)
        .shapeRadius(function(d) {
            return 5 + d.linkDegree / 10000
        })
        // change the border color according to the node type
        .fillStyle(function(d) {
            return d.type == "/organization/organization" ? "#DAE9EA" : "#432946"
        })
        // border size according to the node type
        .lineWidth(function(d) {
            return d.group == 1 ? 2 : 2
        })
        // border color according to the node type
        .strokeStyle(function(d) {
            return d.type == "/organization/organization" ? "#432946" : "#DAE9EA"
        })
        // title of the node (on mouse hover) according to the node type
        .title(function(d) {
            return d.freebase_id
        })
        // event to enable the force behavior
        .event("drag", force)
        // event to enable the drag event on each node
        .event("mousedown", pv.Behavior.drag())
        // event to show the list of relations for each nodes
        .event("mouseup", function() {     
            
            var d = treeData.nodes[this.index];
            
            // we add a temporisation to distingate click and drag
            if (new Date().getTime() - lastMouseDown < 400) {

                lastMouseDown = 0;

                // show the list
                loadFreebaseData(d);
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
                    .textStyle("#432946")
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
        vis.render();
    } catch(e) {  /* empty exception to clear an idiot IE alert  */ }

    // zoom button
    $("menu.ctrl a").live("click", function() {

        switch (true) {

            case $(this).hasClass("zoomIn"):
                new visZoom(panel).In();
                break;

            case $(this).hasClass("zoomOut"):
                new visZoom(panel).Out();
                break;
        }

    });

}

function visZoom(panel) {

    var z = function(s) {
        
        var m = panel.transform().scale(s);                
        try{
            panel.transform(m).render();
        } catch(e) { }
        
        
    }

    this.In = function() {
        z(1.3);
    }

    this.Out = function() {
        z(0.7);
    }

}