
<h2>{t}Visualize relations{/t}</h2>

<section class="classic-form visualize">
      <h3>{t}See the relationship between...{/t}</h3>
      <form method="POST" action="">

            <input type="hidden"  name="rate" value="{$trust_rank}" />
            
            <div class="visu-tool">
                  <a href="./" class="permalink">{t}Permalink{/t}</a>
                  <a href="./" class="embed">{t}Embed{/t}</a>
            </div>
            <div class="relation-form">
                  <input type="text" name="node-left"  title="{t}You must choose an entity from Freebase. Please select one in the list below.{/t}"  id="to-entity-left" class="node_search required node_left" placeholder="Personality or institution" value="{if $entity_left}{$entity_left->getLabel()}{/if}" />
                  <input type="text" name="node-right" title="{t}You must choose an entity from Freebase. Please select one in the list below.{/t}" id="to-entity-right" class="node_search required node_right" placeholder="Personality or institution" value="{if $entity_right}{$entity_right->getLabel()}{/if}" />
            </div>

            <section>
                  <div class="entity-desc loading default" id="entity-left">
                        <input type="hidden" class="entity-left-mid" name="entity-left-mid" class="required"  value="{if $entity_left}{$entity_left->getFreebaseId()}{/if}" />
                  </div>
            </section>

            <section>
                  <div class="entity-desc loading default" id="entity-right">
                        <input type="hidden" class="entity-right-mid" name="entity-right-mid" class="required" value="{if $entity_right}{$entity_right->getFreebaseId()}{/if}" />
                  </div>
            </section>
            
            <div id="node-informations" class="simpleShadow radiusLight">                  
                  <div class="close">close</div>
                  <h4>An entity name</h4>
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
                                                <td></td>
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
                  <div class="rate-legend">
                        {t}Established
                        fact{/t}
                  </div>
                  <div id="rate-slider"></div>
                  <div class="rate-legend">
                        {t}Rumor{/t}
                  </div>
            </div>

            {literal}
            <script type="text/javascript">
                  $(function() {
                        
                        $( "#rate-slider" ).slider({
                              value: $( ":input[name=rate]" ).val(),
                              min: 1,
                              max: 5,
                              step: 0.1,
                              orientation: "vertical",
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
                              gravity: 'e',
                              html: true,
                              opacity:1
                        });
                        
                  });
            </script>
            {/literal}
                  
            <div class="tooltips" title="{t}No relations yet between these entities.{/t} {if $isConnected}<a href='./?screen=relation-add'>{t}Contribute to the database.{/t}</a>{else}{t}Log in to contribute.{/t}{/if}">
                  <p>{t}Click an entity to view its description.{/t}</p>
                  <p class="browser-alert">{t}Your Web Browser cannot display the graph. Please, use{/t} <a href="http://www.mozilla-europe.org/" target="_blank">Mozilla Firefox</a> {t}or{/t} <a href="http://www.google.com/chrome" target="_blank">Google Chrome</a>.</p>
            </div>
            <div id="visualize-layout">
                  <script type="text/javascript+protovis">
                        relationsRender();
                  </script>
            </div>
      </form>
</section>
      
<div class="embed-field">
      
      <p>{t}Use this code to embed the current visualization on your website:{/t}</p>
      <input value='' data-code='<iframe src="@@URL@@" width="100%" height="400px"></iframe>' data-url='{$smarty.const.APP_URL}' readonly type="text" />

</div>