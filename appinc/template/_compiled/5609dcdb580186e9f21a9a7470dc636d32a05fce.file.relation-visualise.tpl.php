<?php /* Smarty version Smarty-3.0.6, created on 2011-04-09 01:23:28
         compiled from "/Users/pirhoo/Lab/Web/Influence-Networks/appinc/template/ecran/relation-visualise.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16054604154d9f98f0abaaf7-13465690%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5609dcdb580186e9f21a9a7470dc636d32a05fce' => 
    array (
      0 => '/Users/pirhoo/Lab/Web/Influence-Networks/appinc/template/ecran/relation-visualise.tpl',
      1 => 1302279416,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16054604154d9f98f0abaaf7-13465690',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<ul class="up_menu">
      <?php $_template = new Smarty_Internal_Template("menu.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
</ul>


<h2><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Visualize relations<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h2>

<section class="classic-form">
      <h3><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
See the relationship between...<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
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
                        <h5><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Informations<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h5>
                        <div class="freebase default loading">
                              <ul></ul>
                              <span class="freebase-label"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Information provided by Freebase<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span>
                        </div>
                  </div>
                  <div class="dynamique-content" style="width:395px">
                        <h5><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Relations<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h5>
                        <div class="relations default loading">
                              <table>
                                    <thead>
                                          <tr>
                                                <td><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Entity<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
                                                <td style="min-width:80px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Type of relation<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
                                                <td style=" text-align:center"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Trust rank<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
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
                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Rumor<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                  </div>
                  <div style="float:right" class="rate-legend">
                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Established fact<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                  </div>
                  <div id="rate-slider"></div>
            </div>

            
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
            
                  
            <div class="tooltips" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
No relations yet between these entities.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 <?php if ($_smarty_tpl->getVariable('isConnected')->value){?><a href='./?ecran=relation-add'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Contribute to the database.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a><?php }else{ ?><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Log in to contribute.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php }?>">
                  <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Double click an entity to view its description.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            </div>
            <div id="visualize-layout">
                  
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
                  
            </div>
      </form>
</section>