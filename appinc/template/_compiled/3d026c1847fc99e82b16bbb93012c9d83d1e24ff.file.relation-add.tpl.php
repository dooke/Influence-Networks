<?php /* Smarty version Smarty-3.0.6, created on 2011-04-09 01:24:48
         compiled from "/Users/pirhoo/Lab/Web/Influence-Networks/appinc/template/ecran/relation-add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19036136564d9f99401ff508-33279101%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3d026c1847fc99e82b16bbb93012c9d83d1e24ff' => 
    array (
      0 => '/Users/pirhoo/Lab/Web/Influence-Networks/appinc/template/ecran/relation-add.tpl',
      1 => 1302279416,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19036136564d9f99401ff508-33279101',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_html_options')) include '/Users/pirhoo/Lab/Web/Influence-Networks/appinc/librarie/Smarty-3.0.6/libs/plugins/function.html_options.php';
?><ul class="up_menu">      
      <?php $_template = new Smarty_Internal_Template("menu.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>      
</ul>


<h2><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Add a relation<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h2>

<section class="classic-form">
      <h3><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Add a new relation between...<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
      <form method="POST" action="index.php?ecran=relation-add">
            
            <div style="text-align:center;">
                  <input type="text" name="node-left"  id="to-entity-left" class="node_search required node_left" placeholder="Personality or institution" />
                  <img src="./appinc/images/and.png" alt="&" class="and" />
                  <input type="text" name="node-right" id="to-entity-right" class="node_search required node_right" placeholder="Personality or institution" />
            </div>
            
            <section>
                  <div class="entity-desc loading default" id="entity-left">
                        <input type="hidden" name="entity-left-mid" class="required" value="" />
                        <h4></h4>
                        <div class="hiddable">
                              <ul></ul>
                              <span class="freebase-label"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Information provided by Freebase<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span>
                              <div class="wait"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Loading information.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>
                        </div>
                  </div>
            </section>
                  
            <section>
                  <div class="entity-desc loading default" id="entity-right">
                        <input type="hidden" name="entity-right-mid" class="required" value="" />
                        <h4></h4>
                        <div class="hiddable">
                              <ul></ul>
                              <span class="freebase-label"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Information provided by Freebase<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span>
                              <div class="wait"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Loading information.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>
                        </div>
                  </div>
            </section>
            
            <div class="deroule open" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Hide/Show entities details<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"></div>

            <div class="select-type">
                  <label>
                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Relation type:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                        <?php echo smarty_function_html_options(array('name'=>'relation_type','options'=>$_smarty_tpl->getVariable('relation_type_option')->value),$_smarty_tpl);?>

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