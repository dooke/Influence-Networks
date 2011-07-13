
    </div>

    <!-- Un masque sombre qui recouvre l'application (pour des popups) -->
    <div id="mask"></div>
    
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


</body>
</html>