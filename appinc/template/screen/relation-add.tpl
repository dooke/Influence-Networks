<ul class="up_menu">      
      {include file="menu.tpl"}      
</ul>


<h2>{t}Add a relation{/t}</h2>

<section class="classic-form">
      <h3>{t}Add a new relation between...{/t}</h3>
      <form method="POST" action="index.php?screen=relation-add">
            
            <div style="text-align:center;">
                  <input type="text" name="node-left"  title="{t}You must choose an entity from Freebase. Please select one in the list below.{/t}" id="to-entity-left" class="node_search required node_left" placeholder="Personality or institution" />
                  <img src="./appinc/images/and.png" alt="&" class="and" />
                  <input type="text" name="node-right" title="{t}You must choose an entity from Freebase. Please select one in the list below.{/t}" id="to-entity-right" class="node_search required node_right" placeholder="Personality or institution" />
            </div>
            
            <section>
                  <div class="entity-desc loading default" id="entity-left">
                        <input type="hidden" name="entity-left-mid" class="required" value="" />
                        <h4></h4>
                        <div class="hiddable">
                              <ul></ul>
                              <span class="freebase-label">{t}Information provided by Freebase{/t}</span>
                              <div class="wait">{t}Loading information.{/t}</div>
                        </div>
                  </div>
            </section>
                  
            <section>
                  <div class="entity-desc loading default" id="entity-right">
                        <input type="hidden" name="entity-right-mid" class="required" value="" />
                        <h4></h4>
                        <div class="hiddable">
                              <ul></ul>
                              <span class="freebase-label">{t}Information provided by Freebase{/t}</span>
                              <div class="wait">{t}Loading information.{/t}</div>
                        </div>
                  </div>
            </section>
            
            <div class="deroule open" title="{t}Hide/Show entities details{/t}"></div>

            <div class="select-type">
                  <label>
                        {t}Relation type:{/t}
                        {html_options name=relation_type options=$relation_type_option}
                  </label>       
            </div>

            <div class="relation-property"> 
                  <div class="relation-property-input">
                        <!-- some inputs for each property -->
                  </div>   
            </div>               

            <div style="clear:both; text-align:right; padding-top:10px; padding-right: 20px;">
                  <input type="submit" class="submit light" value="Submit" />
            </div>
            
      </form>
</section>