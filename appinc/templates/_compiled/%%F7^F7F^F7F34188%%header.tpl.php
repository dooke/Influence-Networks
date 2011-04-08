<?php /* Smarty version 2.6.26, created on 2011-04-08 11:48:31
         compiled from header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'header.tpl', 10, false),)), $this); ?>
<!DOCTYPE html>
<html>
      <!-- Facebook needs theses language attributs -->
      <head lang="fr">

            <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
            <!-- IPAD viewport -->
            <meta name="viewport" content="width=990">
            
            <title><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Influence Networks<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> &lsaquo; <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>OWNI<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></title>

            <meta name="description" content="Influence Networks is an open-source, collaborative directory of relationships between people, institutions and companies. Each relation has its own level of trustworthiness, so that facts can be distinguished from noise." /> 
            <link rel="image_src" href="http://app.owni.fr/influence-networks/appinc/images/infnets.png" /> 
            <meta name="og:image" property="og:image" content="http://app.owni.fr/influence-networks/appinc/images/infnets.png" />            
            <meta name="keywords" content="OWNI" />            
            <link rel="canonical" href="http://app.owni.fr/influence-networks/" /> 
 

            <!-- ###################################### -->
            <!-- #  The following includes are generic, -->
            <!-- #  common for every apps...            -->
            <!-- ###################################### -->

            <!-- Default theme -->
            <link rel="stylesheet" type="text/css" href="stylesheet/generic.css" />
            <!-- JQuery UI Theme -->
            <link rel="stylesheet" type="text/css" href="stylesheet/ui-eggplant/jquery-ui-1.8.8.custom.css" />

            <!--[if lt IE 9]>
                <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
            <![endif]-->

            <!-- Javascript hack to a better HML5 support on IE6  -->
            <script type="text/javascript" src="javascript/html5.js"></script>
            <!-- Usefull functions -->
            <script type="text/javascript" src="javascript/functions.utils.js"></script>
            <!-- JQuery library -->
            <script type="text/javascript" src="javascript/jquery-1.5.min.js"></script>
            <!-- JQuery extend to center any object -->
            <script type="text/javascript" src="javascript/jquery-extend-center.js"></script>
            <!-- JQuery extend to add customized tooltips -->
            <script type="text/javascript" src="javascript/jquery-extend-hidden-title.js"></script>
            <!-- JQuery UI library -->
            <script type="text/javascript" src="javascript/jquery-ui-1.8.5.custom.min.js"></script>
            
            <!-- library to do tree layouts -->
            <script type="text/javascript" src="javascript/protovis-r3.2.js"></script>
            <script src="appinc/javascript/modernizr-1.6.min.js" type="text/javascript"></script>
            
            <!-- Freebase API suggest -->
            <link type="text/css" rel="stylesheet" href="./appinc/stylesheet/jquery.freebase-suggest.css" />
            <script type="text/javascript" src="http://freebaselibs.com/static/suggest/1.3/suggest.min.js"></script>

            <link href='http://fonts.googleapis.com/css?family=PT+Sans:regular,italic,bold,bolditalic' rel='stylesheet' type='text/css'>
            <link href='http://fonts.googleapis.com/css?family=Vollkorn:regular,italic,bold,bolditalic' rel='stylesheet' type='text/css' />

            <!-- APP theme -->
            <link rel="stylesheet" type="text/css" href="appinc/stylesheet/global.css" />

            <!-- ... -->
            <script type="text/javascript" src="appinc/javascript/app.js"></script>
            <script type="text/javascript" src="appinc/javascript/jquery.rotate.js"></script>
            <script type="text/javascript" src="appinc/javascript/jquery.tmpl.min.js"></script>    
            
            <!-- Tooltips ki -->        
            <script type="text/javascript" src="appinc/tipsy/javascripts/jquery.tipsy.js"></script>  
            <link rel="stylesheet" type="text/css" href="appinc/tipsy/stylesheets/tipsy.css" />  
            
            <script type="text/javascript" src="appinc/javascript/jquery.cookies.2.2.0.min.js"></script>                              
            <script type="text/javascript" src="appinc/javascript/jquery.md5.js"></script>                  
            
            
            <script type="text/javascript" src="appinc/javascript/jquery.website-tour.js"></script>
            <link type="text/css" rel="stylesheet" href="./appinc/stylesheet/jquerytour.css" />
            

            <?php if ($this->_tpl_vars['ecran'] == "relation-add"): ?>
            
                  <script type="text/javascript" src="appinc/javascript/relation-add.js"></script>                  
            
            <?php elseif ($this->_tpl_vars['ecran'] == "relation-review"): ?>
                  
                  <script type="text/javascript" src="appinc/javascript/relation-review.js"></script>                  
            
            <?php elseif ($this->_tpl_vars['ecran'] == "relation-visualise"): ?>
                  
                  <script type="text/javascript" src="appinc/javascript/relation-visualise.js"></script>                  
            
            <?php elseif ($this->_tpl_vars['isConnected']): ?>            
                  <?php echo '
                        <script type="text/javascript">
                              $(function() {
                                    
                                    //$.cookies.del("no-website-tour");
                                    
                                    if(! $.cookies.get("no-website-tour") )
                                          new makeWebsiteTour([
                                                {
                                                      "url"             : "./?ecran=relation-add&website-tour"
                                                }
                                          ]);
                              });
                        </script>
                  '; ?>
                  
            <?php endif; ?>
            
            
            
            <script type="text/javascript">
                  var isConnected = <?php if ($this->_tpl_vars['isConnected']): ?> true <?php else: ?> false <?php endif; ?>;
                  var err = <?php echo $this->_tpl_vars['err_json']; ?>
;                  
            </script>


      </head>

      <!-- IPAD loves this attribut to a better displaying -->
      <body onload="window.scrollTo(0, 1)">
            
            <h1>Influence Networks</h1>

            <!-- The APP himlself, 990 by 667 pixels -->
            <div id="app" class="simple center simpleShadow radiusLight">

                  <!-- Une surcouche sur la div APP avec un overflow hidden de 990x667 -->
                  <div id="overflow">

                        <!-- Là où l'application se déroule -->
                        <div id="workspace">

                              <div id="errors"></div>
                              
                              <div id="user-menu">
                                    <?php if ($this->_tpl_vars['isConnected']): ?>
                                          <div class="user_corner">

                                                <div class="user_status">
                                                      <span class="label"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>See your<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><br /><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>activity<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
                                                      <span class="trust_level" title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>This is a measure of your trustworthiness. The more your contributions are deemed trustworthy by the community, the higher it goes.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php echo $this->_tpl_vars['user']['trust_level']; ?>
</span>
                                                </div>
                                                <div class="user_activity">
                                                      <div class="headband">
                                                            <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Your activity:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 

                                                            <?php if ($this->_tpl_vars['user']['count_relation'] <= 1): ?>  
                                                                  <?php echo $this->_tpl_vars['user']['count_relation']; ?>
 <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>relationship added and<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                                                            <?php else: ?>
                                                                  <?php echo $this->_tpl_vars['user']['count_relation']; ?>
 <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>relationships added and<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                                                            <?php endif; ?>

                                                            <?php if ($this->_tpl_vars['user']['count_relation_trust_level'] <= 1): ?> 
                                                                  <?php echo $this->_tpl_vars['user']['count_relation_trust_level']; ?>
 <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>relationship verified<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                                                            <?php else: ?>
                                                                  <?php echo $this->_tpl_vars['user']['count_relation_trust_level']; ?>
 <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>relationships verified<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>                                                      
                                                            <?php endif; ?>
                                                      </div>
                                                </div>
                                                <div class="signOut">
                                                      <span style="font-weight:bold"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Logged as <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo $this->_tpl_vars['user']['email']; ?>
</span>&nbsp;|&nbsp;<a href="?action=signout"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Sign out<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                                                </div>

                                          </div>
                                    <?php else: ?>
                                          <form action="index.php" method="post" class="connexion radiusLight simpleShadow" >
                                                <input type="hidden" name="action" value="signin" />
                                                <label><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <input type="text" name="email" class="text" /></label>
                                                <label><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Password<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <input type="password" name="password" class="text" /></label>
                                                <input type="submit" class="submit violet" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Submit<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /> <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>or<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <a href="#" onclick="signUp()"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Sign up<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>

                                                <!-- ERROR MESSAGES -->
                                                <div class="form_error">
                                                      <!-- for free message -->
                                                </div>
                                                <div class="form_error">
                                                      <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>The username or password is incorrect.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                                                </div>
                                          </form>

                                          <form action="index.php" method="post" class="inscription radiusLight simpleShadow hidden" >
                                                <input type="hidden" name="action" value="signup" />
                                                <label><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <input type="text" name="email" class="text" /></label>
                                                <label><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Password<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <input type="password" name="password_1" class="text" /></label>
                                                <label><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Confirm password<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <input type="password" name="password_2" class="text" /></label>
                                                <input type="submit" class="submit violet" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Submit<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /> <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>or<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <a href="#" onclick="signUp()"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Come back<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>

                                                <!-- ERROR MESSAGES -->
                                                <div class="form_error">
                                                      <!-- for free message -->
                                                </div>
                                                <div class="form_error">
                                                      <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Form is incomplete.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                                                </div>
                                                <div class="form_error">
                                                      <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Passwords are not matching.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                                                </div>
                                                <div class="form_error">
                                                      <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email address is not valid.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                                                </div>
                                          </form>
                                    <?php endif; ?>
                              </div>