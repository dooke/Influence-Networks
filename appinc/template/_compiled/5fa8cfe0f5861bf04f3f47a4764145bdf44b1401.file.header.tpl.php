<?php /* Smarty version Smarty-3.0.6, created on 2011-04-09 01:10:21
         compiled from "/Users/pirhoo/Lab/Web/Influence-Networks/appinc/template/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8169363394d9f95dd5e78b9-45672093%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5fa8cfe0f5861bf04f3f47a4764145bdf44b1401' => 
    array (
      0 => '/Users/pirhoo/Lab/Web/Influence-Networks/appinc/template/header.tpl',
      1 => 1302279416,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8169363394d9f95dd5e78b9-45672093',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html>
<html>
      <head lang="fr">

            <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
            <!-- IPAD viewport -->
            <meta name="viewport" content="width=990">
            
            <title><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Influence Networks<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 &lsaquo; <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
OWNI<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</title>

            <meta name="description" content="Influence Networks is an open-source, collaborative directory of relationships between people, institutions and companies. Each relation has its own level of trustworthiness, so that facts can be distinguished from noise." /> 
            <meta name="og:image" content="<?php echo @APP_URL;?>
appinc/images/infnets.png" property="og:image"  />            
            <meta name="keywords" content="OWNI, influence networks, influence, network, networks, relationship, relation" />            
            
            <link rel="canonical" href="<?php echo @APP_URL;?>
" /> 
            <link rel="image_src" href="<?php echo @APP_URL;?>
appinc/images/infnets.png" /> 
 

            <!-- ###################################### -->
            <!-- #  Stylesheets                         -->
            <!-- ###################################### -->

            <!-- Google Fonts -->
            <link href='http://fonts.googleapis.com/css?family=PT+Sans:regular,italic,bold,bolditalic' rel='stylesheet' type='text/css'>
            <link href='http://fonts.googleapis.com/css?family=Vollkorn:regular,italic,bold,bolditalic' rel='stylesheet' type='text/css' />
            <!-- Default theme -->
            <link rel="stylesheet" type="text/css" href="<?php echo @APP_URL;?>
appinc/stylesheet/generic.css" />
            <!-- JQuery UI Theme -->
            <link rel="stylesheet" type="text/css" href="<?php echo @APP_URL;?>
appinc/stylesheet/ui-eggplant/jquery-ui-1.8.8.custom.css" />
            <!-- Website tour -->            
            <link type="text/css" rel="stylesheet" href="<?php echo @APP_URL;?>
appinc/stylesheet/jquery.website-tour.css" /></link>
            <!-- Freebase API suggest -->
            <link type="text/css" rel="stylesheet" href="<?php echo @APP_URL;?>
appinc/stylesheet/jquery.freebase-suggest.css" />            
            <!-- APP theme -->
            <link rel="stylesheet" type="text/css" href="<?php echo @APP_URL;?>
appinc/stylesheet/global.css" />
            <!-- Freebase API suggest -->
            <link rel="stylesheet" type="text/css" href="<?php echo @APP_URL;?>
appinc/stylesheet/tipsy.css" /> 


            <!-- ###################################### -->
            <!-- #  javascript                          -->
            <!-- ###################################### -->
            
            <!-- Javascript hack to a better HML5 support on IE6  -->
            <!--[if lt IE 9]>
                <script type="text/javascript" src="<?php echo @APP_URL;?>
appinc/javascript/html5.js"></script>
            <![endif]--> 
            <!-- Usefull functions -->
            <script type="text/javascript" src="<?php echo @APP_URL;?>
appinc/javascript/functions.utils.js"></script>
            <!-- JQuery library -->
            <script type="text/javascript" src="<?php echo @APP_URL;?>
appinc/javascript/jquery-1.5.min.js"></script>
            <!-- JQuery extend to center any object -->
            <script type="text/javascript" src="<?php echo @APP_URL;?>
appinc/javascript/jquery-extend-center.js"></script>
            <!-- JQuery UI library -->
            <script type="text/javascript" src="<?php echo @APP_URL;?>
appinc/javascript/jquery-ui-1.8.5.custom.min.js"></script>   
            <!-- Templates with jQuery -->
            <script type="text/javascript" src="<?php echo @APP_URL;?>
appinc/javascript/jquery.tmpl.min.js"></script>    
            <!-- Cookie plugin-->
            <script type="text/javascript" src="<?php echo @APP_URL;?>
appinc/javascript/jquery.cookies.2.2.0.min.js"></script>  
            <!-- Md5 plugin -->
            <script type="text/javascript" src="<?php echo @APP_URL;?>
appinc/javascript/jquery.md5.js"></script>     
            <!-- Tooltips kit -->        
            <script type="text/javascript" src="<?php echo @APP_URL;?>
appinc/javascript/jquery.tipsy.js"></script>  
            <!-- Website tour -->
            <script type="text/javascript" src="<?php echo @APP_URL;?>
appinc/javascript/jquery.website-tour.js"></script>         
            <!-- library to do tree layouts -->
            <script type="text/javascript" src="<?php echo @APP_URL;?>
appinc/javascript/protovis-r3.2.js"></script>
            <!-- Modernizr -->
            <script type="text/javascript" src="<?php echo @APP_URL;?>
appinc/javascript/modernizr-1.6.min.js"></script>
            <!-- Freebase suggest plugin --> 
            <script type="text/javascript" src="http://freebaselibs.com/static/suggest/1.3/suggest.min.js"></script>
                                    
            <script type="text/javascript" src="<?php echo @APP_URL;?>
appinc/javascript/app.js"></script>          
            

            <!-- ###################################### -->
            <!-- #  Display script according to screen  -->
            <!-- ###################################### -->
            
            <?php if ($_smarty_tpl->getVariable('ecran')->value=="relation-add"){?>
            
                  <script type="text/javascript" src="<?php echo @APP_URL;?>
appinc/javascript/relation-add.js"></script>                  
            
            <?php }elseif($_smarty_tpl->getVariable('ecran')->value=="relation-review"){?>
                  
                  <script type="text/javascript" src="<?php echo @APP_URL;?>
appinc/javascript/relation-review.js"></script>                  
            
            <?php }elseif($_smarty_tpl->getVariable('ecran')->value=="relation-visualise"){?>
                  
                  <script type="text/javascript" src="<?php echo @APP_URL;?>
appinc/javascript/relation-visualise.js"></script>                  
            
            <?php }elseif($_smarty_tpl->getVariable('isConnected')->value){?>            
                  
                        <script type="text/javascript">
                              $(function() {
                              
                                    if(! $.cookies.get("no-website-tour") ) {
                                          new makeWebsiteTour([
                                                {
                                                      "url" s: "./?ecran=relation-add&website-tour"
                                                }
                                          ]);
                                     }
                              });
                        </script>
                                    
            <?php }?>
            
            
            
            <script type="text/javascript">
                  // to know if the user is connected
                  var isConnected = <?php if ($_smarty_tpl->getVariable('isConnected')->value){?> true <?php }else{ ?> false <?php }?>;
                  // to display errors
                  var err = <?php echo $_smarty_tpl->getVariable('err_json')->value;?>
;                  
            </script>


      </head>

      <!-- IPAD loves this attribut to a better displaying -->
      <body onload="window.scrollTo(0, 1)">
            
            <h1>Influence Networks</h1>            
            
            <!-- The APP himlself, 990 by 667 pixels -->
            <div id="app" class="simple center simpleShadow radiusLight">

                  <div id="overflow">

                        <div id="workspace">

                              <div id="errors"></div>
                              
                              <div id="user-menu">
                                    <?php if ($_smarty_tpl->getVariable('isConnected')->value){?>
                                          <div class="user_corner">

                                                <div class="user_status">
                                                      <span class="label"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
See your<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<br /><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
activity<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span>
                                                      <span class="trust_level" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
This is a measure of your trustworthiness. The more your contributions are deemed trustworthy by the community, the higher it goes.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"><?php echo $_smarty_tpl->getVariable('user')->value['trust_level'];?>
</span>
                                                </div>
                                                <div class="user_activity">
                                                      <div class="headband">
                                                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Your activity:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 

                                                            <?php if ($_smarty_tpl->getVariable('user')->value['count_relation']<=1){?>  
                                                                  <?php echo $_smarty_tpl->getVariable('user')->value['count_relation'];?>
 <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
relationship added and<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                                                            <?php }else{ ?>
                                                                  <?php echo $_smarty_tpl->getVariable('user')->value['count_relation'];?>
 <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
relationships added and<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                                                            <?php }?>

                                                            <?php if ($_smarty_tpl->getVariable('user')->value['count_relation_trust_level']<=1){?> 
                                                                  <?php echo $_smarty_tpl->getVariable('user')->value['count_relation_trust_level'];?>
 <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
relationship verified<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                                                            <?php }else{ ?>
                                                                  <?php echo $_smarty_tpl->getVariable('user')->value['count_relation_trust_level'];?>
 <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
relationships verified<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
                                                      
                                                            <?php }?>
                                                      </div>
                                                </div>
                                                <div class="signOut">
                                                      <span style="font-weight:bold"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Logged as <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php echo $_smarty_tpl->getVariable('user')->value['email'];?>
</span>&nbsp;|&nbsp;<a href="?action=signout"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Sign out<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
                                                </div>

                                          </div>
                                    <?php }else{ ?>
                                          <form action="index.php" method="post" class="connexion radiusLight simpleShadow" >
                                                <input type="hidden" name="action" value="signin" />
                                                <label><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Email<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
: <input type="text" name="email" class="text" /></label>
                                                <label><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Password<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
: <input type="password" name="password" class="text" /></label>
                                                <input type="submit" class="submit violet" value="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Submit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" /> <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
or<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 <a href="#" onclick="signUp()"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Sign up<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>

                                                <!-- ERROR MESSAGES -->
                                                <div class="form_error">
                                                      <!-- for free message -->
                                                </div>
                                                <div class="form_error">
                                                      <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The username or password is incorrect.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                                                </div>
                                          </form>

                                          <form action="index.php" method="post" class="inscription radiusLight simpleShadow hidden" >
                                                <input type="hidden" name="action" value="signup" />
                                                <label><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Email<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
: <input type="text" name="email" class="text" /></label>
                                                <label><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Password<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
: <input type="password" name="password_1" class="text" /></label>
                                                <label><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Confirm password<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
: <input type="password" name="password_2" class="text" /></label>
                                                <input type="submit" class="submit violet" value="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Submit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" /> <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
or<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 <a href="#" onclick="signUp()"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Come back<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>

                                                <!-- ERROR MESSAGES -->
                                                <div class="form_error">
                                                      <!-- for free message -->
                                                </div>
                                                <div class="form_error">
                                                      <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Form is incomplete.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                                                </div>
                                                <div class="form_error">
                                                      <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Passwords are not matching.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                                                </div>
                                                <div class="form_error">
                                                      <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Email address is not valid.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                                                </div>
                                          </form>
                                    <?php }?>
                              </div>