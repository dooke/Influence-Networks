
<footer>

    <!--ection class="like incrusted">
        <h3>{t}share_fan_tooltips{/t}</h3>
        <span class="share"  title="">
            <iframe src="http://www.facebook.com/plugins/like.php?href={$smarty.const.FB_FAN}&amp;layout=button_count&amp;show_faces=true&amp;width=100&amp;action=recommend&amp;font=verdana&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:21px;" allowTransparency="true"></iframe>
        </span>
    </section-->


    <div class="sharing incrusted">
        <h3>{t}Share the application{/t}</h3>

        <section style="margin-left:5px; position:relative; top:-3px;">
            <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
            <fb:like href="http://www.facebook.com/pages/Influence-Networks/173785906004702" show_faces="false" width="300" font="trebuchet ms"></fb:like>        
        </section>

        <section>
            <a class="share mini-share-mail bg-white"
               target="_blank"
               title=""
               href='http://www.addtoany.com/email?linkurl={$smarty.const.DOC_URL}&amp;linkname={$smarty.const.DOC_TITLE}&amp;t={$smarty.const.DOC_TITLE}'>
               <img alt="share mail" src="./appinc/images/mini-email.png" /> email
            </a>
        </section>

        <!--section>
            <h3>{t}share_embed_tooltips{/t}</h3>
            <a class="share mini-embed bg-white"
               href="#"
               title=""
               onclick="doEmbed()">
                &lt;{t}embed{/t}&gt;
            </a>
        </section>

       <section class="share twitter" title="">
            <a href="http://twitter.com/share"
               class="twitter-share-button"
               data-url="{$smarty.const.DOC_URL}"
               data-text="{$smarty.const.DOC_TITLE}"
               data-count="horizontal"
               data-via="{$smarty.const.DOC_TWUSER}">Tweet</a>
            <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
       </section-->

        <section>
            <a class="share facebook"
               title=""
               name="fb_share"
               type="button-count"
               share_url="{$smarty.const.DOC_URL}"
               href="http://www.facebook.com/sharer.php">Partager</a>
            <script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
        </section>

    </div>
    

</footer>


