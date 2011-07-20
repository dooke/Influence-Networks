

<h2>{t}Review a relation{/t} - <a href="./?screen=relation-review&id={$relation->getId()}" class="permalink">{t}Permalink{/t}</a></h2>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent rhoncus urna ut sem ornare aliquet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent rhoncus urna ut sem ornare aliquet. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

<section class="classic-form main">
      {*if there is a relation *}
      {if $relation}
      
            <form method="POST" action="index.php?screen=relation-review">
                  <h3>A user indicated that</h3>

                  <input type="hidden" name="relation-id" value="{$relation->getId()}" />
         
                  <div class="entities">
                      <div class="entity left">
                          <a class="fb-topic" data-mid="{$entity_left->getFreebaseId()}" data-type="{$entity_left->getType()}">
                              {$entity_left->getLabel()}
                          </a>
                      </div>
                          
                      <div class="entity right">
                          <a class="fb-topic" data-mid="{$entity_right->getFreebaseId()}" data-type="{$entity_right->getType()}">
                              {$entity_right->getLabel()}
                          </a>
                      </div>
                  </div>

                  
                  <section class="relation-type">
                        <h4>{t}Relation type:{/t} <strong>{$relation_type->getLabel()}</strong></h4>
                        {foreach from=$relation_value item=i key=k}
                            
                            {* Don't show empty value *}
                            {if $i->getValue() != ""}
                                
                                {* Special format for URL *}
                                {if $i->getPropertyLabel() == "Source"}                      
                                    <p>                                
                                          <span>{$i->getPropertyLabel()}:</span> <a href='{$i->getValue()}' target="_blank">link</a>
                                    </p>
                                {else}
                                    <p>
                                            
                                          <span>{$i->getPropertyLabel()}:</span> {$i->getValue()}
                                    </p>
                                {/if}
                            {/if}
                        {/foreach}                      
                  </section>

                  <h4>{t}How reliable is this information?{/t}</h4>          

                  <input type="hidden" name="rate" value="3" />
                  <div style="float:left; text-align: right;" class="rate-legend">
                        {t}It's not true{/t}
                  </div>
                  <div style="float:right" class="rate-legend">
                        {t}It's a fact{/t}
                  </div>
                  <div id="rate-slider"></div>

                  <div class="buttons">
                        <input type="submit" class="submit button blue" value="Submit" />
                        <a class="button blue sky skip" href="?screen=relation-review">Skip</a>
                  </div>
            </form>
            
      {/if}
</section>