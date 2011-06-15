<ul class="up_menu">
      {include file="menu.tpl"}
</ul>


<h2>{t}Review a relation{/t}</h2>

<section class="classic-form relation-review">
      {if $relation}
      
            <h3>{t}Review the relation between...{/t}&nbsp;<a href="./?screen=relation-review&id={$relation->getId()}" class="permalink">{t}Permalink{/t}</a></h3>
            <form method="POST" action="index.php?screen=relation-review">

                 <input type="hidden" name="relation-id" value="{$relation->getId()}" />

                 <div style="text-align:center; margin-bottom:-25px;">
                        <img src="./appinc/images/and.png" alt="&" class="and" />                  
                  </div>

                  <section>
                        <div class="entity-desc loading default" id="entity-left">
                              <input type="hidden" name="entity-left-mid" id="to-entity-left" value="{$entity_left->getFreebaseId()}" />
                              <input type="hidden" name="entity-left-type" value="{$entity_left->getType()}" />
                              <h4>&nbsp;</h4>
                              <div class="hiddable">
                                    <ul></ul>
                                    <span class="freebase-label">{t}Information provided by Freebase{/t}</span>
                              </div>
                              <div class="wait">{t}Loading information.{/t}</div>
                        </div>
                  </section>

                  <section>
                        <div class="entity-desc loading default" id="entity-right">
                              <input type="hidden" name="entity-right-mid" id="to-entity-right" value="{$entity_right->getFreebaseId()}" />
                              <input type="hidden" name="entity-right-type" value="{$entity_right->getType()}" />
                              <h4>&nbsp;</h4>
                              <div class="hiddable">
                                    <ul></ul>
                                    <span class="freebase-label">{t}Information provided by Freebase{/t}</span>
                              </div>
                              <div class="wait">{t}Loading information.{/t}</div>
                        </div>
                  </section>
                 
                  <div class="deroule open" title="{t}Hide/Show entities details{/t}"></div>

                  <h3>{t}Relation type:{/t} <span style="color:#f4f3e2; font-weight: normal; text-transform: none; margin-top:10px;">{$relation_type->getLabel()}</span></h3>
                  <section class="relation-type">
                        {foreach from=$relation_value item=i key=k}
                            
                            {* Don't show empty value *}
                            {if $i->getValue() != ""}
                                
                                {* Special format for URL *}
                                {if $i->getPropertyLabel() == "Source"}                      
                                    <p>                                
                                          <span>{$i->getPropertyLabel()}:</span> <a href='{$i->getValue()}' target="_blank">{$i->getValue()}</a>
                                    </p>
                                {else}
                                    <p>
                                            
                                          <span>{$i->getPropertyLabel()}:</span> {$i->getValue()}
                                    </p>
                                {/if}
                            {/if}
                        {/foreach}                      
                  </section>

                  <h3>{t}Rate the confidence level of this relationship{/t}</h3>          

                  <input type="hidden" name="rate" value="3" />
                  <div style="float:left; text-align: right;" class="rate-legend">
                        {t}Rumor{/t}
                  </div>
                  <div style="float:right" class="rate-legend">
                        {t}Established fact{/t}
                  </div>
                  <div id="rate-slider"></div>

                  <div style="clear:both; text-align:right; padding-top:10px; padding-right: 20px;">
                        <input type="submit" class="submit  button light" value="Submit" />
                        <a class="button submit light" href="?screen=relation-review">I don't know</a>
                  </div>
            </form>
            
      {/if}
</section>