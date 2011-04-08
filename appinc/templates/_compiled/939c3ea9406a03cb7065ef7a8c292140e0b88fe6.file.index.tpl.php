<?php /* Smarty version Smarty-3.0.6, created on 2011-04-08 18:01:07
         compiled from "/Users/pirhoo/Lab/Web/IN/appinc/templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12447768314d9f3143dd5032-07897061%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '939c3ea9406a03cb7065ef7a8c292140e0b88fe6' => 
    array (
      0 => '/Users/pirhoo/Lab/Web/IN/appinc/templates/index.tpl',
      1 => 1302276709,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12447768314d9f3143dd5032-07897061',
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