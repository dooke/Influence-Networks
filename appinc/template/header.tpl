<!DOCTYPE html>
<html>
    <head lang="fr">

        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <!-- IPAD viewport -->
        <meta name="viewport" content="width=990">

        <title>{t}Influence Networks{/t} &bullet; {$pageTitle}</title>

        <meta name="description" content="Influence Networks is an open-source, collaborative directory of relationships between people, institutions and companies. Each relation has its own level of trustworthiness, so that facts can be distinguished from noise." /> 
        <meta name="og:image" content="{$smarty.const.APP_URL}appinc/images/infnets.png" property="og:image"  />            
        <meta name="keywords" content="OWNI, influence networks, influence, network, networks, relationship, relation" />            

        <link rel="canonical" href="{$smarty.const.APP_URL}" /> 
        <link rel="image_src" href="{$smarty.const.APP_URL}appinc/images/infnets.png" /> 


        <!-- ###################################### -->
        <!-- #  Stylesheets                         -->
        <!-- ###################################### -->

        <!-- Google Fonts -->
        <link href='http://fonts.googleapis.com/css?family=PT+Sans:regular,italic,bold,bolditalic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Vollkorn:regular,italic,bold,bolditalic' rel='stylesheet' type='text/css' />
        <!-- Default theme -->
        <link rel="stylesheet" type="text/css" href="{$smarty.const.APP_URL}appinc/stylesheet/generic.css" />
        <!-- JQuery UI Theme -->
        <link rel="stylesheet" type="text/css" href="{$smarty.const.APP_URL}appinc/stylesheet/ui-eggplant/jquery-ui-1.8.8.custom.css" />
        <!-- Website tour -->            
        <link type="text/css" rel="stylesheet" href="{$smarty.const.APP_URL}appinc/stylesheet/jquery.website-tour.css" /></link>
        <!-- Freebase API suggest -->
        <link type="text/css" rel="stylesheet" href="{$smarty.const.APP_URL}appinc/stylesheet/jquery.freebase-suggest.css" />            
        <!-- APP theme -->
        <link rel="stylesheet" type="text/css" href="{$smarty.const.APP_URL}appinc/stylesheet/global.css" />
        <!-- Freebase API suggest -->
        <link rel="stylesheet" type="text/css" href="{$smarty.const.APP_URL}appinc/stylesheet/tipsy.css" /> 



        <!-- ###################################### -->
        <!-- #  javascript                          -->
        <!-- ###################################### -->

        <!-- Javascript hack to a better HML5 support on IE6  -->
        <!--[if lt IE 9]>
            <script type="text/javascript" src="{$smarty.const.APP_URL}appinc/javascript/html5.js"></script>
        <![endif]--> 
        <!-- Usefull functions -->
        <script type="text/javascript" src="{$smarty.const.APP_URL}appinc/javascript/functions.utils.js"></script>
        <!-- JQuery library -->
        <script type="text/javascript" src="{$smarty.const.APP_URL}appinc/javascript/jquery/jquery-last.min.js"></script>
        <!-- JQuery extend to center any object -->
        <script type="text/javascript" src="{$smarty.const.APP_URL}appinc/javascript/jquery/jquery-extend-center.js"></script>
        <!-- JQuery UI library -->
        <script type="text/javascript" src="{$smarty.const.APP_URL}appinc/javascript/jquery/jquery-ui-1.8.5.custom.min.js"></script>   
        <!-- Templates with jQuery -->
        <script type="text/javascript" src="{$smarty.const.APP_URL}appinc/javascript/jquery/jquery.tmpl.min.js"></script>    
        <!-- Cookie plugin-->
        <script type="text/javascript" src="{$smarty.const.APP_URL}appinc/javascript/jquery/jquery.cookies.2.2.0.min.js"></script>  
        <!-- Md5 plugin -->
        <script type="text/javascript" src="{$smarty.const.APP_URL}appinc/javascript/jquery/jquery.md5.js"></script>     
        <!-- Tooltips kit -->        
        <script type="text/javascript" src="{$smarty.const.APP_URL}appinc/javascript/jquery/jquery.tipsy.js"></script>  
        <!-- Website tour -->
        <script type="text/javascript" src="{$smarty.const.APP_URL}appinc/javascript/jquery/jquery.website-tour.js"></script>         
        <!-- Modernizr -->
        <script type="text/javascript" src="{$smarty.const.APP_URL}appinc/javascript/modernizr-1.6.min.js"></script>
        <!-- Freebase suggest plugin --> 
        <script type="text/javascript" src="http://freebaselibs.com/static/suggest/1.3/suggest.min.js"></script>
        <!-- Explore Freebase Topic -->
        <script type="text/javascript" src="{$smarty.const.APP_URL}appinc/javascript/jquery/jquery.freebase-topic.js"></script>
        <!-- Google +1 button -->
        <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
        
        <script type="text/javascript" src="{$smarty.const.APP_URL}appinc/javascript/app.js"></script>


        <!-- ###################################### -->
        <!-- #  Display script according to screen  -->
        <!-- ###################################### -->

        {if $screen=="relation-add"}

            <script type="text/javascript" src="{$smarty.const.APP_URL}appinc/javascript/CreateFreebaseEntity.class.js"></script>                  
            <script type="text/javascript" src="{$smarty.const.APP_URL}appinc/javascript/relation-add.js"></script>                  

        {elseif $screen=="relation-review"}

            <script type="text/javascript" src="{$smarty.const.APP_URL}appinc/javascript/relation-review.js"></script>                  

        {elseif $screen=="relation-visualize"}

            <script type="text/javascript" src="{$smarty.const.APP_URL}appinc/javascript/relation-visualize.js"></script>                  

            <!-- to make SGV better -->
            <!--[if IE]>
                <script type="text/javascript" src="{$smarty.const.APP_URL}appinc/javascript/SVGWEB/svg.js" data-path="{$smarty.const.APP_URL}appinc/javascript/SVGWEB/"></script>           
            <![endif]-->

            <!-- library to do tree layouts -->
            <script type="text/javascript" src="{$smarty.const.APP_URL}appinc/javascript/jlove-protovis-r3.3.js"></script>


        {elseif $isConnected}            
            {literal}
                <script type="text/javascript">
                      $(function() {
                              
                            if(! $.cookies.get("no-website-tour") ) {
                                  new makeWebsiteTour([
                                        {
                                              "url": "./?screen=relation-add&website-tour"
                                        }
                                  ]);
                             }
                      });
                </script>
            {/literal}                  
        {/if}



        <script type="text/javascript">
              // to know if the user is connected
              window.isConnected = {if $isConnected} true {else} false {/if};
              // to display errors
              window.err = {$err_json};                  
        </script>


    </head>

    <!-- IPAD loves this attribut to a better displaying -->
    <body onload="window.scrollTo(0, 1)" class="{$screen}">

        <h1 class="fhidden">{t}Influence Networks{/t} &bullet; {$pageTitle}</h1>   

        <!-- Facebook -->
        <div id="fb-root"></div>


        <header>
            <div class="user-menu">
                {if $isConnected}
                    <div class="user_corner">

                        <div class="user_status">
                            <span class="label">{t}See your{/t}<br />{t}activity{/t}</span>
                            <span class="trust_level" title="{t}This is a measure of your trustworthiness. The more your contributions are deemed trustworthy by the community, the higher it goes.{/t}">{$user.trust_level}</span>
                        </div>
                        <div class="user_activity">
                            <div class="headband">
                                {t}Your activity:{/t} 

                                {if $user.count_relation <= 1}  
                                    {$user.count_relation} {t}relationship added and{/t}
                                {else}
                                    {$user.count_relation} {t}relationships added and{/t}
                                {/if}

                                {if $user.count_relation_trust_level <= 1} 
                                    {$user.count_relation_trust_level} {t}relationship verified{/t}
                                {else}
                                    {$user.count_relation_trust_level} {t}relationships verified{/t}                                                      
                                {/if}
                            </div>
                        </div>
                        <div class="signOut">
                            <span style="font-weight:bold">{t}Logged as {/t}{$user.email}</span>&nbsp;|&nbsp;<a href="?action=signout">{t}Sign out{/t}</a>
                        </div>

                    </div>
                {else}
                    <form action="index.php" method="post" class="connexion radiusLight simpleShadow" >
                        <input type="hidden" name="action" value="signin" />
                        <label>{t}Email{/t}: <input type="text" name="email" class="text" /></label>
                        <label>{t}Password{/t}: <input type="password" name="password" class="text" /></label>
                        <input type="submit" class="submit button violet" value="{t}Submit{/t}" /> {t}or{/t} <a href="#" class="signUp">{t}Sign up{/t}</a>

                        <!-- ERROR MESSAGES -->
                        <div class="form_error">
                            <!-- for free message -->
                        </div>
                        <div class="form_error">
                            {t}The username or password is incorrect.{/t}
                        </div>
                    </form>

                    <form action="index.php" method="post" class="inscription radiusLight simpleShadow hidden" >
                        <input type="hidden" name="action" value="signup" />
                        <label>{t}Email{/t}: <input type="text" name="email" class="text" /></label>
                        <label>{t}Password{/t}: <input type="password" name="password_1" class="text" /></label>
                        <label>{t}Confirm password{/t}: <input type="password" name="password_2" class="text" /></label>
                        <input type="submit" class="submit button violet" value="{t}Submit{/t}" /> {t}or{/t} <a href="#" class="signUp">{t}Come back{/t}</a>

                        <!-- ERROR MESSAGES -->
                        <div class="form_error">
                            <!-- for free message -->
                        </div>
                        <div class="form_error">
                            {t}Form is incomplete.{/t}
                        </div>
                        <div class="form_error">
                            {t}Passwords are not matching.{/t}
                        </div>
                        <div class="form_error">
                            {t}Email address is not valid.{/t}
                        </div>
                    </form>
                {/if}
            </div>

            <ul class="up_menu">
                {include file="menu.tpl"}
            </ul>

            <div class="header-share">

                <section class="share twitter" title="">
                    <a href="http://twitter.com/share"
                       class="twitter-share-button"
                       data-url="{$smarty.const.DOC_URL}"
                       data-text="{$smarty.const.DOC_TITLE}"
                       data-count="horizontal"
                       data-via="{$smarty.const.DOC_TWUSER}">Tweet</a>
                    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
                </section>


                <section style="position:relative; top:-4px;">
                    <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
                    <fb:like href="{$smarty.const.DOC_URL}" send="true" layout="button_count" width="100" show_faces="false" font="trebuchet ms"></fb:like>
                </section>
                
                <section>
                    <g:plusone href="{$smarty.const.DOC_URL}" size="medium"></g:plusone>
                </section>

            </div>
        </header>

        <!-- The APP himlself, 990 by 667 pixels -->
        <div id="app" class="simple">

            <div id="errors"></div>
