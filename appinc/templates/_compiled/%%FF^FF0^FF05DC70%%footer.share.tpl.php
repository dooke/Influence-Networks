<?php /* Smarty version 2.6.26, created on 2011-04-04 11:22:36
         compiled from footer.share.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'footer.share.tpl', 5, false),)), $this); ?>

<footer>

    <!--ection class="like incrusted">
        <h3><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>share_fan_tooltips<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h3>
        <span class="share"  title="">
            <iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo @FB_FAN; ?>
&amp;layout=button_count&amp;show_faces=true&amp;width=100&amp;action=recommend&amp;font=verdana&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:21px;" allowTransparency="true"></iframe>
        </span>
    </section-->


    <div class="sharing incrusted">
        <h3><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Share the application<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h3>

        <section style="margin-left:5px; position:relative; top:-3px;">
            <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
            <fb:like href="http://www.facebook.com/pages/Influence-Networks/173785906004702" show_faces="false" width="300" font="trebuchet ms"></fb:like>        
        </section>

        <section>
            <a class="share mini-share-mail bg-white"
               target="_blank"
               title=""
               href='http://www.addtoany.com/email?linkurl=<?php echo @DOC_URL; ?>
&amp;linkname=<?php echo @DOC_TITLE; ?>
&amp;t=<?php echo @DOC_TITLE; ?>
'>
               <img alt="share mail" src="images/mini-email.png" /> email
            </a>
        </section>

        <!--section>
            <h3><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>share_embed_tooltips<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h3>
            <a class="share mini-embed bg-white"
               href="#"
               title=""
               onclick="doEmbed()">
                &lt;<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>embed<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>&gt;
            </a>
        </section-->

       <section class="share twitter" title="">
            <a href="http://twitter.com/share"
               class="twitter-share-button"
               data-url="<?php echo @DOC_URL; ?>
"
               data-text="<?php echo @DOC_TITLE; ?>
"
               data-count="horizontal"
               data-via="<?php echo @DOC_TWUSER; ?>
">Tweet</a>
            <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
       </section>

        <section>
            <a class="share facebook"
               title=""
               name="fb_share"
               type="button-count"
               share_url="<?php echo @DOC_URL; ?>
"
               href="http://www.facebook.com/sharer.php">Partager</a>
            <script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
        </section>

    </div>
    

</footer>

