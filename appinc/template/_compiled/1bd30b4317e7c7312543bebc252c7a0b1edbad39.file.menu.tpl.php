<?php /* Smarty version Smarty-3.0.6, created on 2011-04-09 01:10:21
         compiled from "/Users/pirhoo/Lab/Web/Influence-Networks/appinc/template/menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17936395534d9f95dd900d37-63115642%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1bd30b4317e7c7312543bebc252c7a0b1edbad39' => 
    array (
      0 => '/Users/pirhoo/Lab/Web/Influence-Networks/appinc/template/menu.tpl',
      1 => 1302279416,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17936395534d9f95dd900d37-63115642',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('isConnected')->value){?>
      <li  class="add <?php if ($_smarty_tpl->getVariable('ecran')->value=='relation-add'){?>current<?php }?>" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Add a relation between 2 nodes.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
">
            <a href="<?php echo @APP_URL;?>
?ecran=relation-add" class="label">
                  <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Add a relation<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            </a>
      </li>
      <li class="review <?php if ($_smarty_tpl->getVariable('ecran')->value=='relation-review'){?>current<?php }?>" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
See a random relation between 2 nodes to estimate its trust level.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
">
            <a href="<?php echo @APP_URL;?>
?ecran=relation-review" class="label">
                  <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Review a relation<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            </a>
      </li>
<?php }else{ ?>
      <li  class="add disabled <?php if ($_smarty_tpl->getVariable('ecran')->value=='relation-add'){?>current<?php }?>" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
(log in to use this feature) Add a relation between 2 nodes.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
">
            <span class="label">
                  <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Add a relation<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            </span>
      </li>
      <li class="review disabled <?php if ($_smarty_tpl->getVariable('ecran')->value=='relation-review'){?>current<?php }?>" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
(log in to use this feature) See a randomize relation between 2 nodes to estimate its trust level.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
">
            <span class="label">
                  <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Review a relation<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            </span>
      </li>
<?php }?>
<li class="visualise <?php if ($_smarty_tpl->getVariable('ecran')->value=='relation-visualise'){?>current<?php }?>"  title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
See entities relations.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
">
      <a href="<?php echo @APP_URL;?>
?ecran=relation-visualise" class="label">
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Visualize a relation<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

      </a>
</li>