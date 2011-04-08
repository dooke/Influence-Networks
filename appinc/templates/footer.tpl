
            </div>

            <!-- Un masque sombre qui recouvre l'application (pour des popups) -->
            <div id="mask"></div>

            <div id="partenaires" class="radiusLight">
                <h3>{t}Partners{/t}</h3>
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
            {include  file="footer.share.tpl"}
            
            {literal}
                  <script type="text/javascript">

                    var _gaq = _gaq || [];
                    _gaq.push(['_setAccount', '{/literal}{$smarty.const.GA_PROFILE}{literal}']);
                    _gaq.push(['_trackPageview']);

                    (function() {
                      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
                    })();

                  </script>
            {/literal}

        </div>
    </div>

</body>
</html>