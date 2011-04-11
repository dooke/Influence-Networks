<?php /* Smarty version Smarty-3.0.6, created on 2011-04-09 01:10:21
         compiled from "/Users/pirhoo/Lab/Web/Influence-Networks/appinc/template/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13131397734d9f95dd537ef4-96758070%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b699963f1be44791ea693ef19c08278b5c7c97b9' => 
    array (
      0 => '/Users/pirhoo/Lab/Web/Influence-Networks/appinc/template/index.tpl',
      1 => 1302279416,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13131397734d9f95dd537ef4-96758070',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<?php if ($_smarty_tpl->getVariable('ecran')->value=="relation-add"){?>

      <?php $_template = new Smarty_Internal_Template("ecran/relation-add.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
      
<?php }elseif($_smarty_tpl->getVariable('ecran')->value=="relation-review"){?>

      <?php $_template = new Smarty_Internal_Template("ecran/relation-review.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>     
      
<?php }elseif($_smarty_tpl->getVariable('ecran')->value=="relation-visualise"){?>

      <?php $_template = new Smarty_Internal_Template("ecran/relation-visualise.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
      
<?php }else{ ?>

      <?php $_template = new Smarty_Internal_Template("ecran/homepage.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
      
<?php }?>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>