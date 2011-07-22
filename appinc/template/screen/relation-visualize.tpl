
<h2>{t}Explore the Networks{/t}</h2>
<p class="intro">Type in the name of a person or an organization and browse through his or her connections.</p>
   
<section class="classic-form main">
      <form method="POST" action="">

            <input type="hidden" name="rate" value="{$trust_rank}" />
            <input type="hidden" class="entity-left-mid"  name="entity-left-mid" data-input="#to-entity-left" value="{if $entity_left}{$entity_left->getFreebaseId()}{/if}" />
            <input type="hidden" class="entity-right-mid" name="entity-right-mid" data-input="#to-entity-right" value="{if $entity_right}{$entity_right->getFreebaseId()}{/if}" />
            
            <section class="step {if $entity_left}disabled{/if}">
                <label>
                    {t}Who are you curious about?{/t}
                    <input type="text" name="node-left" data-preview=".first-entity"  data-entity=".entity-left-mid" id="to-entity-left" class="node_search required text" placeholder="Personality or institution" value="{if $entity_left}{$entity_left->getLabel()}{/if}" />
                </label>
            </section>
            
            <section class="first-entity entity {if !$entity_left}hidden{/if}" rel=".entity-left-mid">
                <a class="cancel">{t}Cancel{/t}</a>
                <p>{t}This is the influence Network of{/t} 
                   
                   {if $entity_left}
                        <a data-type="{$entity_left->getType()}" 
                           data-mid="{$entity_left->getFreebaseId()}" 
                           class="topic fb-topic">
                                {$entity_left->getLabel()}
                        </a>
                    {else}
                        <a class="topic fb-topic"></a>
                    {/if}
                </p>
            </section>                
            
            <section class="step {if $entity_right}disabled{/if}">  
                <label>
                    {t}Who else are you curious about?{/t}
                    <input type="text" name="node-right" data-preview=".second-entity"  data-entity=".entity-right-mid" id="to-entity-right" class="node_search node_right text" placeholder="Personality or institution" value="{if $entity_right}{$entity_right->getLabel()}{/if}" />
                </label>
            </section>
            
            <section class="second-entity entity {if !$entity_right}hidden{/if}" rel=".entity-right-mid">
                <a class="cancel">{t}Cancel{/t}</a>
                <p>{t}This is the influence Network of{/t} 
                    
                   {if $entity_right}
                        <a data-type="{$entity_right->getType()}" 
                           data-mid="{$entity_right->getFreebaseId()}" 
                           class="topic fb-topic">
                                {$entity_right ->getLabel()}
                        </a>
                   {else}
                        <a class="topic fb-topic"></a>
                   {/if}
                </p>
            </section>       
            
            <div id="node-informations" class="hidden">                  
                  <a class="close">close</a>
                  <h4><a class="fb-topic">An entity name</a></h4>
                  <h5>{t}Relations{/t}</h5>
                  <div class="dynamique-content">
                        <div class="relations default loading">
                              <table>
                                    <thead>
                                          <tr>
                                                <td style="width:10px;"></td>
                                                <td>{t}Entity{/t}</td>
                                                <td style="min-width:80px">{t}Type of relation{/t}</td>
                                                <td style=" text-align:center">{t}Trust rank{/t}</td>
                                                <td></td>
                                          </tr>
                                    </thead>
                                    <tbody></tbody>
                              </table>
                        </div>
                  </div>
            </div>
                        
            <div id="explore-more" class="button blue">
                <label><input type="checkbox" name="explore-more" />{t}Explore more{/t}</label>
            </div>
            <div id="visualize-layout">
                  <script type="text/javascript+protovis">
                        window.page.relationsRender();
                  </script>
                  <p class="browser-alert">{t}Your Web Browser cannot display the graph. Please, use{/t} <a href="http://www.mozilla-europe.org/" target="_blank">Mozilla Firefox</a> {t}or{/t} <a href="http://www.google.com/chrome" target="_blank">Google Chrome</a>.</p>
            </div>  
            <div class="visu-tool">
                <ul>
                    <li class="permalink"><a href="./">{t}Permalink{/t}</a></li>
                    <li class="embed"><a href="./">{t}Embed{/t}</a></li>
                    <li class="share"><a href="#">Share</a></li>
                </ul>
            </div>

            <section class="step rate">
                <h3>{t}Filter relation by reliability{/t}</h3>
                <div style="float:left; text-align: right;" class="rate-legend">
                   {t}It's not true{/t}
                </div>
                <div style="float:right" class="rate-legend">
                   {t}It's a fact{/t}
                </div>
                <div id="rate-slider"></div>
            </section>
      </form>
</section>