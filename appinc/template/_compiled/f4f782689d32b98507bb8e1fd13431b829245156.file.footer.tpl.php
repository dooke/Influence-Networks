<?php /* Smarty version Smarty-3.0.6, created on 2011-04-09 01:10:21
         compiled from "/Users/pirhoo/Lab/Web/Influence-Networks/appinc/template/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17738067924d9f95dd998e66-46149176%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f4f782689d32b98507bb8e1fd13431b829245156' => 
    array (
      0 => '/Users/pirhoo/Lab/Web/Influence-Networks/appinc/template/footer.tpl',
      1 => 1302279416,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17738067924d9f95dd998e66-46149176',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

            </div>

            <!-- Un masque sombre qui recouvre l'application (pour des popups) -->
            <div id="mask"></div>

            <div id="partenaires" class="radiusLight">
                <h3><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; smarty_translate(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Partners<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_translate(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
                <ul>
                    <li>
                        <a href="http://www.zeit.de/" target="_blank" title="Zeit Online">
                            <img src="./appinc/images/zeit.png" alt="Zeit Online" />
                        </a>
                    </li>
                    <li>
                        <a href="http://www.transparency.org/" target="_blank" title="Transparency International">
                            <img src="./appinc/images/transparency.png" alt="Transparency International" />
                        </a>
                    </li>
                    <li>
                        <a href="http://http://obsweb.net/" target="_blank" title="Observatoire du WebJournalisme">
                            <img src="./appinc/images/obs.png" alt="Observatoire du WebJournalisme" />
                        </a>
                    </li>
                    <li>
                        <a href="http://owni.fr/" target="_blank" class="owni" title="OWNI">
                            <img src="./appinc/images/owni.png" alt="OWNI.fr" />
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Ligne qui contient un déclencheur pour afficher la barre de partage -->
            <div class="showFooter"><img src="./appinc/images/share.png" alt="" class="trigger" /></div>

            <!-- Les outils pour partager l'APP (Facebook, Twitter, etc) -->
            <?php $_template = new Smarty_Internal_Template("footer.share.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
            
            
                  <script type="text/javascript">

                    var _gaq = _gaq || [];
                    _gaq.push(['_setAccount', '<?php echo @GA_PROFILE;?>
']);
                    _gaq.push(['_trackPageview']);

                    (function() {
                      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
                    })();

                  </script>
            

        </div>
    </div>

</body>
</html>