<?php /* Smarty version Smarty-3.0.6, created on 2011-04-09 01:24:33
         compiled from "/Users/pirhoo/Lab/Web/Influence-Networks/appinc/template/ecran/relation-review.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13181776584d9f993157ec94-34711032%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5aab1d4c7abdac19166c601a248706600a71d313' => 
    array (
      0 => '/Users/pirhoo/Lab/Web/Influence-Networks/appinc/template/ecran/relation-review.tpl',
      1 => 1302279416,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13181776584d9f993157ec94-34711032',
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
Review a relation<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h2>

<section class="classic-form relation-review">
      <?php if ($_smarty_tpl->getVariable('relation')->value){?>
      
            <h3><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Review the relation between...<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
            <form method="POST" action="index.php?ecran=relation-review">

                 <input type="hidden" name="relation-id" value="<?php echo $_smarty_tpl->getVariable('relation')->value->getId();?>
" />

                 <div style="text-align:center; margin-bottom:-25px;">
                        <img src="./appinc/images/and.png" alt="&" class="and" />                  
                  </div>

                  <section>
                        <div class="entity-desc loading default" id="entity-left">
                              <input type="hidden" name="entity-left-mid" id="to-entity-left" value="<?php echo $_smarty_tpl->getVariable('entity_left')->value->getFreebaseId();?>
" />
                              <input type="hidden" name="entity-left-type" value="<?php echo $_smarty_tpl->getVariable('entity_left')->value->getType();?>
" />
                              <h4>&nbsp;</h4>
                              <div class="hiddable">
                                    <ul></ul>
                                    <span class="freebase-label"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Information provided by Freebase<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span>
                              </div>
                              <div class="wait"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Loading information.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>
                        </div>
                  </section>

                  <section>
                        <div class="entity-desc loading default" id="entity-right">
                              <input type="hidden" name="entity-right-mid" id="to-entity-right" value="<?php echo $_smarty_tpl->getVariable('entity_right')->value->getFreebaseId();?>
" />
                              <input type="hidden" name="entity-right-type" value="<?php echo $_smarty_tpl->getVariable('entity_right')->value->getType();?>
" />
                              <h4>&nbsp;</h4>
                              <div class="hiddable">
                                    <ul></ul>
                                    <span class="freebase-label"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Information provided by Freebase<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span>
                              </div>
                              <div class="wait"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Loading information.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>
                        </div>
                  </section>
                 
                  <div class="deroule open" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Hide/Show entities details<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"></div>

                  <h3><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Relation type:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 <span style="color:#f4f3e2; font-weight: normal; text-transform: none; margin-top:10px;"><?php echo $_smarty_tpl->getVariable('relation_type')->value->getLabel();?>
</span></h3>
                  <section class="relation-type">                   
                        <?php if ($_smarty_tpl->getVariable('relation_type')->value->getId()==1){?>
                              <!-- Friends -->
                                                            
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[1]){?> 
                                    <p class="half">
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
From:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <?php echo $_smarty_tpl->getVariable('relation_value')->value[1]->getValue();?>

                                    </p>
                              <?php }?>

                                                            
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[2]){?> 
                                    <p>
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <?php echo $_smarty_tpl->getVariable('relation_value')->value[2]->getValue();?>

                                    </p>
                              <?php }?>

                                         
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[3]){?>
                                    <p class="full">
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Source:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <a target="_blank" href="<?php echo $_smarty_tpl->getVariable('relation_value')->value[3]->getValue();?>
"><?php echo $_smarty_tpl->getVariable('relation_value')->value[3]->getValue();?>
</a>
                                    </p>
                              <?php }?>

                        <?php }elseif($_smarty_tpl->getVariable('relation_type')->value->getId()==2){?>
                              <!-- Rivals  -->
                              
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[4]){?> 
                                    <p class="half">
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
From:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <?php echo $_smarty_tpl->getVariable('relation_value')->value[4]->getValue();?>

                                    </p>
                              <?php }?>
                                         
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[6]){?>
                                    <p class="full">
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Source:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <a target="_blank" href="<?php echo $_smarty_tpl->getVariable('relation_value')->value[6]->getValue();?>
"><?php echo $_smarty_tpl->getVariable('relation_value')->value[6]->getValue();?>
</a>
                                    </p>
                              <?php }?>

                        <?php }elseif($_smarty_tpl->getVariable('relation_type')->value->getId()==3){?>
                              <!-- Colleagues  -->
                                                            
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[7]){?> 
                                    <p class="half">
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
From:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <?php echo $_smarty_tpl->getVariable('relation_value')->value[7]->getValue();?>

                                    </p>
                              <?php }?>
                                                            
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[8]){?> 
                                    <p>
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <?php echo $_smarty_tpl->getVariable('relation_value')->value[8]->getValue();?>

                                    </p>
                              <?php }?>

                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[9]){?> 
                                    <p class="full">
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Organization:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <?php echo $_smarty_tpl->getVariable('relation_value')->value[9]->getValue();?>

                                    </p>
                              <?php }?>
                                         
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[10]){?>
                                    <p class="full">
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
City:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <?php echo $_smarty_tpl->getVariable('relation_value')->value[10]->getValue();?>

                                    </p>
                              <?php }?>
                                         
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[12]){?>
                                    <p class="full">
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Source:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <a target="_blank" href="<?php echo $_smarty_tpl->getVariable('relation_value')->value[12]->getValue();?>
"><?php echo $_smarty_tpl->getVariable('relation_value')->value[12]->getValue();?>
</a>
                                    </p>
                              <?php }?>

                        <?php }elseif($_smarty_tpl->getVariable('relation_type')->value->getId()==4){?>
                              <!-- Commercial relation -->
                                                            
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[13]){?> 
                                    <p class="half">
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
From:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <?php echo $_smarty_tpl->getVariable('relation_value')->value[13]->getValue();?>

                                    </p>
                              <?php }?>
                                                            
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[14]){?> 
                                    <p>
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <?php echo $_smarty_tpl->getVariable('relation_value')->value[14]->getValue();?>

                                    </p>
                              <?php }?>

                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[15]){?> 
                                    <p class="full">
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Work description:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <?php echo $_smarty_tpl->getVariable('relation_value')->value[15]->getValue();?>

                                    </p>
                              <?php }?>
                              
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[17]){?>
                                    <p class="full">
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Source:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <a target="_blank" href="<?php echo $_smarty_tpl->getVariable('relation_value')->value[17]->getValue();?>
"><?php echo $_smarty_tpl->getVariable('relation_value')->value[17]->getValue();?>
</a>
                                    </p>
                              <?php }?>

                        <?php }elseif($_smarty_tpl->getVariable('relation_type')->value->getId()==5){?>
                              <!-- Ownership -->
                                                            
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[18]){?> 
                                    <p class="half">
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
From:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <?php echo $_smarty_tpl->getVariable('relation_value')->value[18]->getValue();?>

                                    </p>
                              <?php }?>
                                                            
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[19]){?> 
                                    <p>
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <?php echo $_smarty_tpl->getVariable('relation_value')->value[19]->getValue();?>

                                    </p>
                              <?php }?>

                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[20]){?> 
                                    <p>
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Transaction amount in EUR:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <?php echo $_smarty_tpl->getVariable('relation_value')->value[20]->getValue();?>

                                    </p>
                              <?php }?>
                              
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[22]){?>
                                    <p class="full">
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Source:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <a target="_blank" href="<?php echo $_smarty_tpl->getVariable('relation_value')->value[22]->getValue();?>
"><?php echo $_smarty_tpl->getVariable('relation_value')->value[22]->getValue();?>
</a>
                                    </p>
                              <?php }?>

                        <?php }elseif($_smarty_tpl->getVariable('relation_type')->value->getId()==6){?>
                              <!-- Classmate -->
                                                            
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[23]){?> 
                                    <p class="half">
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
From:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <?php echo $_smarty_tpl->getVariable('relation_value')->value[23]->getValue();?>

                                    </p>
                              <?php }?>
                                                            
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[24]){?> 
                                    <p>
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <?php echo $_smarty_tpl->getVariable('relation_value')->value[24]->getValue();?>

                                    </p>
                              <?php }?>

                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[25]){?> 
                                    <p class="full">
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Educational Institution:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <?php echo $_smarty_tpl->getVariable('relation_value')->value[25]->getValue();?>

                                    </p>
                              <?php }?>
                                         
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[26]){?>
                                    <p class="full">
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
City:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <?php echo $_smarty_tpl->getVariable('relation_value')->value[26]->getValue();?>

                                    </p>
                              <?php }?>
                                         
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[28]){?>
                                    <p class="full">
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Source:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <a target="_blank" href="<?php echo $_smarty_tpl->getVariable('relation_value')->value[28]->getValue();?>
"><?php echo $_smarty_tpl->getVariable('relation_value')->value[28]->getValue();?>
</a>
                                    </p>
                              <?php }?>

                        <?php }elseif($_smarty_tpl->getVariable('relation_type')->value->getId()==7){?>
                              <!-- Marriage -->

                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[29]){?> 
                                    <p class="half">
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
From:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <?php echo $_smarty_tpl->getVariable('relation_value')->value[29]->getValue();?>

                                    </p>
                              <?php }?>

                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[30]){?>             
                                    <p>
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <?php echo $_smarty_tpl->getVariable('relation_value')->value[30]->getValue();?>

                                    </p>
                              <?php }?>

                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[31]){?>
                                    <p class="full">
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Wedding venue:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <?php echo $_smarty_tpl->getVariable('relation_value')->value[31]->getValue();?>

                                    </p>
                              <?php }?>

                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[33]){?>
                                    <p class="full">
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Source:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <a target="_blank" href="<?php echo $_smarty_tpl->getVariable('relation_value')->value[32]->getValue();?>
"><?php echo $_smarty_tpl->getVariable('relation_value')->value[33]->getValue();?>
</a>
                                    </p>
                              <?php }?>


                        <?php }elseif($_smarty_tpl->getVariable('relation_type')->value->getId()==8){?>
                              <!-- Love Affair -->
                                                            
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[34]){?> 
                                    <p class="half">
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
From:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <?php echo $_smarty_tpl->getVariable('relation_value')->value[34]->getValue();?>

                                    </p>
                              <?php }?>

                                                            
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[35]){?> 
                                    <p>
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <?php echo $_smarty_tpl->getVariable('relation_value')->value[35]->getValue();?>

                                    </p>
                              <?php }?>

                                         
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[37]){?>
                                    <p class="full">
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Source:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <a target="_blank" href="<?php echo $_smarty_tpl->getVariable('relation_value')->value[37]->getValue();?>
"><?php echo $_smarty_tpl->getVariable('relation_value')->value[37]->getValue();?>
</a>
                                    </p>
                              <?php }?>

                        <?php }elseif($_smarty_tpl->getVariable('relation_type')->value->getId()==9){?>
                              <!-- Family relationship -->
                                                            
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[38]){?> 
                                    <p>
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Relation degree:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <?php echo $_smarty_tpl->getVariable('relation_value')->value[38]->getValue();?>

                                    </p>
                              <?php }?>
                                         
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[40]){?>
                                    <p>
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Source:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <a target="_blank" href="<?php echo $_smarty_tpl->getVariable('relation_value')->value[40]->getValue();?>
"><?php echo $_smarty_tpl->getVariable('relation_value')->value[40]->getValue();?>
</a>
                                    </p>
                              <?php }?>
                              
                        <?php }elseif($_smarty_tpl->getVariable('relation_type')->value->getId()==10){?>
                              <!-- Membership -->
                                                            
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[44]){?> 
                                    <p class="full">
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
From:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <?php echo $_smarty_tpl->getVariable('relation_value')->value[44]->getValue();?>

                                    </p>
                              <?php }?>        
                              
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[45]){?> 
                                    <p class="full">
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <?php echo $_smarty_tpl->getVariable('relation_value')->value[45]->getValue();?>

                                    </p>
                              <?php }?>
                                                            
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[46]){?> 
                                    <p class="full">
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Organization:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <?php echo $_smarty_tpl->getVariable('relation_value')->value[46]->getValue();?>

                                    </p>
                              <?php }?>
                                         
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[41]){?>
                                    <p>
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Comment:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <a target="_blank" href="<?php echo $_smarty_tpl->getVariable('relation_value')->value[41]->getValue();?>
"><?php echo $_smarty_tpl->getVariable('relation_value')->value[42]->getValue();?>
</a>
                                    </p>
                              <?php }?>
                                         
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[42]){?>
                                    <p>
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Source:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <a target="_blank" href="<?php echo $_smarty_tpl->getVariable('relation_value')->value[42]->getValue();?>
"><?php echo $_smarty_tpl->getVariable('relation_value')->value[42]->getValue();?>
</a>
                                    </p>
                              <?php }?>
                        
                              
                        <?php }elseif($_smarty_tpl->getVariable('relation_type')->value->getId()==11){?>
                              <!-- Other -->
                                                   
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[47]){?>
                                    <p>
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Comment:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <a target="_blank" href="<?php echo $_smarty_tpl->getVariable('relation_value')->value[47]->getValue();?>
"><?php echo $_smarty_tpl->getVariable('relation_value')->value[42]->getValue();?>
</a>
                                    </p>
                              <?php }?>
                                         
                              <?php if ($_smarty_tpl->getVariable('relation_value')->value[48]){?>
                                    <p>
                                          <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Source:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span> <a target="_blank" href="<?php echo $_smarty_tpl->getVariable('relation_value')->value[48]->getValue();?>
"><?php echo $_smarty_tpl->getVariable('relation_value')->value[42]->getValue();?>
</a>
                                    </p>
                              <?php }?>
                        <?php }?>
                  </section>

                  <h3><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Rate the confidence level of this relationship<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>          

                  <input type="hidden" name="rate" value="3" />
                  <div style="float:left; text-align: right;" class="rate-legend">
                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Rumor<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                  </div>
                  <div style="float:right" class="rate-legend">
                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Established fact<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                  </div>
                  <div id="rate-slider"></div>

                  <div style="clear:both; text-align:right; padding-top:10px; padding-right: 20px;">
                        <input type="submit" class="submit light" value="Submit" />
                        <a class="button submit light" href="?ecran=relation-review">I don't know</a>
                  </div>
            </form>
            
      <?php }?>
</section>