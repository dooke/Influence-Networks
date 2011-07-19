

<h2>{t}Contribute to Influence Networks{/t}</h2>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent rhoncus urna ut sem ornare aliquet. Class aptent taciti </p>

<section class="classic-form main">
      <form method="POST" action="index.php?screen=relation-add">
            
            <input type="hidden" name="entity-left-mid"  class="required" value="" />
            <input type="hidden" name="entity-right-mid" class="required" value="" />
            
            {* First input (entity) *}
            <div class="step node-left">
                <div class="fb-topic-information hidden" rel="to-entity-left">
                    {* Icon to get freebase information *}
                </div>                
                <input type="text" 
                       name="node-left"  
                       title="{t}You must choose an entity from Freebase. Please select one in the list below.{/t}" 
                       id="to-entity-left" 
                       class="node_search required node_left text"
                       data-input="entity-left-mid"
                       placeholder="{t}Who are we talking about ?{/t}" />
                
                <input type="button" class="button blue lookup" value="{t}Lookup{/t}" rel="to-entity-left" />
            </div>
            
            {* Second input (entity) *}
            <div class="step node-right">
                <div class="fb-topic-information hidden" rel="to-entity-right">
                    {* Icon to get freebase information *}
                </div>       
                <input type="text" 
                       name="node-right" 
                       title="{t}You must choose an entity from Freebase. Please select one in the list below.{/t}" 
                       id="to-entity-right" 
                       class="node_search required node_right text" 
                       data-input="entity-right-mid"
                       placeholder="{t}Who are we talking about ?{/t}" />
                
                <input type="button" class="button blue lookup" value="{t}Lookup{/t}" rel="to-entity-right" />
            </div>
            
            {* Third input (type) *}
            <div class="select-type step disabled">
                  <label>
                        {t}What kind of relation they have?{/t}
                        <select name="relation_type">
                              {foreach from=$relation_type_option item=i key=k}
                                    <option value="{$k}" data-direction="{$i.direction}" data-hint="{$i.hint}">{$i.label}</option>
                              {/foreach}
                        </select>
                  </label>     
                  <div class="relation-hint">
                        First entity is or was owner of second entity.
                  </div>
            </div>
                       
            {* Fourth input (source) *}
            <div class="step disabled">
                <label>
                    {t}What your source?{/t}
                    <input type="text"
                           class="source text required chk_URL"  
                           placeholder="Enter an URL"
                           name="source" />
                </label>
            </div>
            
            
            {* Last input (more details) *}
            <div class="relation-property step last disabled">
                 {t}Do you have more information about the relation?{/t}
                  <div class="relation-property-input">
                        <!-- some inputs for each property -->
                  </div>
                  

                {* Submit *}
                <div class="disabled block-submit">
                      <input type="submit" class="submit button blue" value="Add to database and submit for review" />
                </div>
            </div>             
                  
            
      </form>
</section>
       
<div class="createFreebaseEntity fhidden">     
    <form>
        <h3 class="fhidden">{t}Create an entity{/t}</h3>
        <p class="text">{t}Are we talking of:{/t}</p>
        <label class=""><input type="radio" value="/people/person"  name="entity_type" />{t}A person{/t}</label>
        <label class=""><input type="radio" value="/organization/organization" name="entity_type" />{t}An organization{/t}</label>
        <input type="button" value="{t}Back{/t}" class="cancel button light" />
    </form>
</div>