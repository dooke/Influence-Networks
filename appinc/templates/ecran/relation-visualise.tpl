<ul class="up_menu">
      {include file="menu.tpl"}
</ul>


<h2>{t}Visualize relations{/t}</h2>

<section class="classic-form">
      <h3>{t}See the relationship between...{/t}</h3>
      <form method="POST" action="">

            <input type="hidden"  name="rate" value="1" />
            
            <div style="text-align:center;">
                  <input type="text" name="node-left"  id="to-entity-left" class="node_search required node_left" placeholder="Personality or institution" />
                  <img src="./appinc/images/and.png" alt="&" class="and" />
                  <input type="text" name="node-right" id="to-entity-right" class="node_search required node_right" placeholder="Personality or institution" />
            </div>

            <section>
                  <div class="entity-desc loading default" id="entity-left">
                        <input type="hidden" class="entity-left-mid" name="entity-left-mid" class="required" value="" />
                  </div>
            </section>

            <section>
                  <div class="entity-desc loading default" id="entity-right">
                        <input type="hidden" class="entity-right-mid" name="entity-right-mid" class="required" value="" />
                  </div>
            </section>
            
            <div id="node-informations" class="simpleShadow radiusLight">                  
                  <div class="close">close</div>
                  <h4></h4>
                  <div class="dynamique-content">
                        <h5>{t}Informations{/t}</h5>
                        <div class="freebase default loading">
                              <ul></ul>
                              <span class="freebase-label">{t}Information provided by Freebase{/t}</span>
                        </div>
                  </div>
                  <div class="dynamique-content" style="width:395px">
                        <h5>{t}Relations{/t}</h5>
                        <div class="relations default loading">
                              <table>
                                    <thead>
                                          <tr>
                                                <td>{t}Entity{/t}</td>
                                                <td style="min-width:80px">{t}Type of relation{/t}</td>
                                                <td style=" text-align:center">{t}Trust rank{/t}</td>
                                                <td style="width:10px;"></td>
                                          </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                              </table>
                        </div>
                  </div>
            </div>

            <div class="min-rate">
                  <div style="float:left; text-align: right;" class="rate-legend">
                        {t}Rumor{/t}
                  </div>
                  <div style="float:right" class="rate-legend">
                        {t}Established fact{/t}
                  </div>
                  <div id="rate-slider"></div>
            </div>

            {literal}
            <script type="text/javascript">
                  $(function() {
                        
                        $( "#rate-slider" ).slider({
                              value:1,
                              min: 1,
                              max: 5,
                              step: 0.1,
                              slide: function( event, ui ) {
                                    $( ":input[name=rate]" ).val( ui.value );
                                    if(data_rel != undefined) resetDataVis();
                                    
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
                              gravity: 'n',
                              html: true,
                              opacity:1
                        });
                        

                        
                        
                  });
            </script>
            {/literal}
                  
            <div class="tooltips" title="{t}No relations yet between these entities.{/t} {if $isConnected}<a href='./?ecran=relation-add'>{t}Contribute to the database.{/t}</a>{else}{t}Log in to contribute.{/t}{/if}">
                  {t}Double click an entity to view its description.{/t}
            </div>
            <div id="visualize-layout">
                  {literal}
                  <script type="text/javascript+protovis">
                        //+protovis
                        
                        if (Modernizr.svg){ 
                        
                              var colors = pv.Colors.category10();            

                              vis = new pv.Panel()
                                    .width(990)
                                    .height(327)
                                    .fillStyle("transparent");

                              force = vis.add(pv.Layout.Force)
                                    .springLength(110)
                                    .bound(true)
                                    .springConstant(0.6)
                                    .nodes(treeData.nodes)
                                    .links(treeData.links);

                              force.link.add(pv.Line)
                                  .lineWidth(1)
                                  .strokeStyle("#DAE9EA");

                              force.node.add(pv.Dot)
                                    .event("dblclick", function (d) { loadFreebaseData(d); })
                                    .size(function(d) { return d.group == 1 ? 150 : 50; })
                                    .fillStyle(function(d) { return d.type == "/organization/organization" ? "#DAE9EA" : "#432946" })
                                    .strokeStyle( "rgb(55, 33, 55)" )
                                    .lineWidth(0)
                                    .title(function(d) { return d.type } )
                                    .event("mousedown", pv.Behavior.drag())
                                    .event("drag", force)
                                    .add(pv.Label)
                                          .text( function (d) { return d.label })
                                          .font(function(d) { return d.group == 1 ? "bold 16px Helvetica" : "bold 11px Helvetica"; })
                                          .textStyle("#432946")
                                          .textAlign("center")
                                          .textBaseline("top")
                                          .textDecoration("none")
                                          .textMargin(function(d) { return d.group == 1 ? -30 : -20 });


                              vis.render();

                              // data_rel = {"1":{"id":"1","node_left":"1","node_right":"2","creator":"3","type":"7","trust_level":"5","node_left_label":"Nicolas Sarkozy","node_right_label":"Carla Bruni","node_left_freebase_id":"\/en\/nicolas_sarkozy","node_right_freebase_id":"\/en\/carla_bruni","node_left_type":"\/people\/person","node_right_type":"\/people\/person"},"2":{"id":"2","node_left":"3","node_right":"1","creator":"3","type":"9","trust_level":"5","node_left_label":"Jean Sarkozy","node_right_label":"Nicolas Sarkozy","node_left_freebase_id":"\/en\/jean_sarkozy","node_right_freebase_id":"\/en\/nicolas_sarkozy","node_left_type":"\/people\/person","node_right_type":"\/people\/person"},"3":{"id":"3","node_left":"4","node_right":"1","creator":"3","type":"8","trust_level":"5","node_left_label":"Vladimir Putin","node_right_label":"Nicolas Sarkozy","node_left_freebase_id":"\/en\/vladimir_putin","node_right_freebase_id":"\/en\/nicolas_sarkozy","node_left_type":"\/people\/person","node_right_type":"\/people\/person"},"5":{"id":"5","node_left":"1","node_right":"5","creator":"3","type":"1","trust_level":"5","node_left_label":"Nicolas Sarkozy","node_right_label":"Edward Elgar","node_left_freebase_id":"\/en\/nicolas_sarkozy","node_right_freebase_id":"\/en\/edward_elgar","node_left_type":"\/people\/person","node_right_type":"\/people\/person"},"4":{"id":"4","node_left":"4","node_right":"2","creator":"3","type":"9","trust_level":"5","node_left_label":"Vladimir Putin","node_right_label":"Carla Bruni","node_left_freebase_id":"\/en\/vladimir_putin","node_right_freebase_id":"\/en\/carla_bruni","node_left_type":"\/people\/person","node_right_type":"\/people\/person"}};
                              // resetDataVis();
                        
                        } else {
                        
                              $(function () {
                                    $("#layout").append('<div class="nograph">Your web browser cannot display the graph. Please, use <a href="http://www.mozilla-europe.org/fr/firefox/">Mozilla Firefox</a> or <a href="http://www.google.com/chrome">Google Chrome</a>.</div>');
                              });
                        }
                  </script>
                  {/literal}
            </div>
      </form>
</section>