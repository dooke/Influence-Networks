<ul class="up_menu">
      {include file="menu.tpl"}
</ul>


<h2>{t}Review a relation{/t}</h2>

<section class="classic-form relation-review">
      {if $relation}
      
            <h3>{t}Review the relation between...{/t}</h3>
            <form method="POST" action="index.php?ecran=relation-review">

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
                        {if $relation_type->getId() == 1}
                              <!-- Friends -->
                                                            
                              {if $relation_value[1]} 
                                    <p class="half">
                                          <span>{t}From:{/t}</span> {$relation_value[1]->getValue()}
                                    </p>
                              {/if}

                                                            
                              {if $relation_value[2]} 
                                    <p>
                                          <span>{t}To:{/t}</span> {$relation_value[2]->getValue()}
                                    </p>
                              {/if}

                                         
                              {if $relation_value[3]}
                                    <p class="full">
                                          <span>{t}Source:{/t}</span> <a target="_blank" href="{$relation_value[3]->getValue()}">{$relation_value[3]->getValue()}</a>
                                    </p>
                              {/if}

                        {elseif $relation_type->getId() == 2}
                              <!-- Rivals  -->
                              
                              {if $relation_value[4]} 
                                    <p class="half">
                                          <span>{t}From:{/t}</span> {$relation_value[4]->getValue()}
                                    </p>
                              {/if}
                                         
                              {if $relation_value[6]}
                                    <p class="full">
                                          <span>{t}Source:{/t}</span> <a target="_blank" href="{$relation_value[6]->getValue()}">{$relation_value[6]->getValue()}</a>
                                    </p>
                              {/if}

                        {elseif $relation_type->getId() == 3}
                              <!-- Colleagues  -->
                                                            
                              {if $relation_value[7]} 
                                    <p class="half">
                                          <span>{t}From:{/t}</span> {$relation_value[7]->getValue()}
                                    </p>
                              {/if}
                                                            
                              {if $relation_value[8]} 
                                    <p>
                                          <span>{t}To:{/t}</span> {$relation_value[8]->getValue()}
                                    </p>
                              {/if}

                              {if $relation_value[9]} 
                                    <p class="full">
                                          <span>{t}Organization:{/t}</span> {$relation_value[9]->getValue()}
                                    </p>
                              {/if}
                                         
                              {if $relation_value[10]}
                                    <p class="full">
                                          <span>{t}City:{/t}</span> {$relation_value[10]->getValue()}
                                    </p>
                              {/if}
                                         
                              {if $relation_value[12]}
                                    <p class="full">
                                          <span>{t}Source:{/t}</span> <a target="_blank" href="{$relation_value[12]->getValue()}">{$relation_value[12]->getValue()}</a>
                                    </p>
                              {/if}

                        {elseif $relation_type->getId() == 4}
                              <!-- Commercial relation -->
                                                            
                              {if $relation_value[13]} 
                                    <p class="half">
                                          <span>{t}From:{/t}</span> {$relation_value[13]->getValue()}
                                    </p>
                              {/if}
                                                            
                              {if $relation_value[14]} 
                                    <p>
                                          <span>{t}To:{/t}</span> {$relation_value[14]->getValue()}
                                    </p>
                              {/if}

                              {if $relation_value[15]} 
                                    <p class="full">
                                          <span>{t}Work description:{/t}</span> {$relation_value[15]->getValue()}
                                    </p>
                              {/if}
                              
                              {if $relation_value[17]}
                                    <p class="full">
                                          <span>{t}Source:{/t}</span> <a target="_blank" href="{$relation_value[17]->getValue()}">{$relation_value[17]->getValue()}</a>
                                    </p>
                              {/if}

                        {elseif $relation_type->getId() == 5}
                              <!-- Ownership -->
                                                            
                              {if $relation_value[18]} 
                                    <p class="half">
                                          <span>{t}From:{/t}</span> {$relation_value[18]->getValue()}
                                    </p>
                              {/if}
                                                            
                              {if $relation_value[19]} 
                                    <p>
                                          <span>{t}To:{/t}</span> {$relation_value[19]->getValue()}
                                    </p>
                              {/if}

                              {if $relation_value[20]} 
                                    <p>
                                          <span>{t}Transaction amount in EUR:{/t}</span> {$relation_value[20]->getValue()}
                                    </p>
                              {/if}
                              
                              {if $relation_value[22]}
                                    <p class="full">
                                          <span>{t}Source:{/t}</span> <a target="_blank" href="{$relation_value[22]->getValue()}">{$relation_value[22]->getValue()}</a>
                                    </p>
                              {/if}

                        {elseif $relation_type->getId() == 6}
                              <!-- Classmate -->
                                                            
                              {if $relation_value[23]} 
                                    <p class="half">
                                          <span>{t}From:{/t}</span> {$relation_value[23]->getValue()}
                                    </p>
                              {/if}
                                                            
                              {if $relation_value[24]} 
                                    <p>
                                          <span>{t}To:{/t}</span> {$relation_value[24]->getValue()}
                                    </p>
                              {/if}

                              {if $relation_value[25]} 
                                    <p class="full">
                                          <span>{t}Educational Institution:{/t}</span> {$relation_value[25]->getValue()}
                                    </p>
                              {/if}
                                         
                              {if $relation_value[26]}
                                    <p class="full">
                                          <span>{t}City:{/t}</span> {$relation_value[26]->getValue()}
                                    </p>
                              {/if}
                                         
                              {if $relation_value[28]}
                                    <p class="full">
                                          <span>{t}Source:{/t}</span> <a target="_blank" href="{$relation_value[28]->getValue()}">{$relation_value[28]->getValue()}</a>
                                    </p>
                              {/if}

                        {elseif $relation_type->getId() == 7}
                              <!-- Marriage -->

                              {if $relation_value[29]} 
                                    <p class="half">
                                          <span>{t}From:{/t}</span> {$relation_value[29]->getValue()}
                                    </p>
                              {/if}

                              {if $relation_value[30]}             
                                    <p>
                                          <span>{t}To:{/t}</span> {$relation_value[30]->getValue()}
                                    </p>
                              {/if}

                              {if $relation_value[31]}
                                    <p class="full">
                                          <span>{t}Wedding venue:{/t}</span> {$relation_value[31]->getValue()}
                                    </p>
                              {/if}

                              {if $relation_value[33]}
                                    <p class="full">
                                          <span>{t}Source:{/t}</span> <a target="_blank" href="{$relation_value[32]->getValue()}">{$relation_value[33]->getValue()}</a>
                                    </p>
                              {/if}


                        {elseif $relation_type->getId() == 8}
                              <!-- Love Affair -->
                                                            
                              {if $relation_value[34]} 
                                    <p class="half">
                                          <span>{t}From:{/t}</span> {$relation_value[34]->getValue()}
                                    </p>
                              {/if}

                                                            
                              {if $relation_value[35]} 
                                    <p>
                                          <span>{t}To:{/t}</span> {$relation_value[35]->getValue()}
                                    </p>
                              {/if}

                                         
                              {if $relation_value[37]}
                                    <p class="full">
                                          <span>{t}Source:{/t}</span> <a target="_blank" href="{$relation_value[37]->getValue()}">{$relation_value[37]->getValue()}</a>
                                    </p>
                              {/if}

                        {elseif $relation_type->getId() == 9}
                              <!-- Family relationship -->
                                                            
                              {if $relation_value[38]} 
                                    <p>
                                          <span>{t}Relation degree:{/t}</span> {$relation_value[38]->getValue()}
                                    </p>
                              {/if}
                                         
                              {if $relation_value[40]}
                                    <p>
                                          <span>{t}Source:{/t}</span> <a target="_blank" href="{$relation_value[40]->getValue()}">{$relation_value[40]->getValue()}</a>
                                    </p>
                              {/if}
                              
                        {elseif $relation_type->getId() == 10}
                              <!-- Membership -->
                                                            
                              {if $relation_value[44]} 
                                    <p class="full">
                                          <span>{t}From:{/t}</span> {$relation_value[44]->getValue()}
                                    </p>
                              {/if}        
                              
                              {if $relation_value[45]} 
                                    <p class="full">
                                          <span>{t}To:{/t}</span> {$relation_value[45]->getValue()}
                                    </p>
                              {/if}
                                                            
                              {if $relation_value[46]} 
                                    <p class="full">
                                          <span>{t}Organization:{/t}</span> {$relation_value[46]->getValue()}
                                    </p>
                              {/if}
                                         
                              {if $relation_value[41]}
                                    <p>
                                          <span>{t}Comment:{/t}</span> <a target="_blank" href="{$relation_value[41]->getValue()}">{$relation_value[42]->getValue()}</a>
                                    </p>
                              {/if}
                                         
                              {if $relation_value[42]}
                                    <p>
                                          <span>{t}Source:{/t}</span> <a target="_blank" href="{$relation_value[42]->getValue()}">{$relation_value[42]->getValue()}</a>
                                    </p>
                              {/if}
                        
                              
                        {elseif $relation_type->getId() == 11}
                              <!-- Other -->
                                                   
                              {if $relation_value[47]}
                                    <p>
                                          <span>{t}Comment:{/t}</span> <a target="_blank" href="{$relation_value[47]->getValue()}">{$relation_value[42]->getValue()}</a>
                                    </p>
                              {/if}
                                         
                              {if $relation_value[48]}
                                    <p>
                                          <span>{t}Source:{/t}</span> <a target="_blank" href="{$relation_value[48]->getValue()}">{$relation_value[42]->getValue()}</a>
                                    </p>
                              {/if}
                        {/if}
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
                        <input type="submit" class="submit light" value="Submit" />
                        <a class="button submit light" href="?ecran=relation-review">I don't know</a>
                  </div>
            </form>
            
      {/if}
</section>