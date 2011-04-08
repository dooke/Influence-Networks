<?php /* Smarty version 2.6.26, created on 2011-03-31 18:18:04
         compiled from footer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'footer.tpl', 8, false),)), $this); ?>

            </div>

            <!-- Un masque sombre qui recouvre l'application (pour des popups) -->
            <div id="mask"></div>

            <div id="partenaires" class="radiusLight">
                <h3><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Partners<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h3>
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
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.share.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            
            <?php echo '
                  <script type="text/javascript">

                    var _gaq = _gaq || [];
                    _gaq.push([\'_setAccount\', \'UA-18463169-5\']);
                    _gaq.push([\'_trackPageview\']);

                    (function() {
                      var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
                      ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
                      var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
                    })();

                  </script>
            '; ?>


        </div>
    </div>

</body>
</html>