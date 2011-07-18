<!DOCTYPE html>
<html>
      <head lang="fr">

            <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
            <!-- IPAD viewport -->
            <meta name="viewport" content="width=990">
            
            <title>{t}Influence Networks{/t} &lsaquo; {t}OWNI{/t}</title>

            <meta name="description" content="Influence Networks is an open-source, collaborative directory of relationships between people, institutions and companies. Each relation has its own level of trustworthiness, so that facts can be distinguished from noise." /> 
            <meta name="og:image" content="{$smarty.const.APP_URL}appinc/images/infnets.png" property="og:image"  />            
            <meta name="keywords" content="OWNI, influence networks, influence, network, networks, relationship, relation" />            
            
            <link rel="canonical" href="{$smarty.const.APP_URL}" /> 
            <link rel="image_src" href="{$smarty.const.APP_URL}appinc/images/infnets.png" /> 
 

            <!-- ###################################### -->
            <!-- #  Stylesheets                         -->
            <!-- ###################################### -->

            <link href='http://fonts.googleapis.com/css?family=Vollkorn:regular,italic,bold,bolditalic' rel='stylesheet' type='text/css' />
            <!-- Default theme -->
            <link rel="stylesheet" type="text/css" href="{$smarty.const.APP_URL}appinc/stylesheet/generic.css" />
            <!-- JQuery UI Theme -->
            <link rel="stylesheet" type="text/css" href="{$smarty.const.APP_URL}appinc/stylesheet/ui-eggplant/jquery-ui-1.8.8.custom.css" />                       
            <!-- EMBED theme -->
            <link rel="stylesheet" type="text/css" href="{$smarty.const.APP_URL}appinc/stylesheet/relation-visualize-embed.css" />
            <!-- Tooltips -->
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
            <!-- JQuery UI library -->
            <script type="text/javascript" src="{$smarty.const.APP_URL}appinc/javascript/jquery/jquery-ui-1.8.5.custom.min.js"></script>  
            <!-- Templates with jQuery -->
            <script type="text/javascript" src="{$smarty.const.APP_URL}appinc/javascript/jquery/jquery.tmpl.min.js"></script>    
            <!-- Tooltips kit -->        
            <script type="text/javascript" src="{$smarty.const.APP_URL}appinc/javascript/jquery/jquery.tipsy.js"></script>         
            <!-- Modernizr -->
            <script type="text/javascript" src="{$smarty.const.APP_URL}appinc/javascript/modernizr-1.6.min.js"></script>
                                    
            <script type="text/javascript" src="{$smarty.const.APP_URL}appinc/javascript/app.js"></script>   
            <script type="text/javascript" src="{$smarty.const.APP_URL}appinc/javascript/relation-visualize-embed.js"></script>          
            
            
            <!-- to make SGV better -->
            <!--[if IE]>
                <script type="text/javascript" src="{$smarty.const.APP_URL}appinc/javascript/SVGWEB/svg.js" data-path="{$smarty.const.APP_URL}appinc/javascript/SVGWEB/"></script>           
            <![endif]-->
            
            <!-- library to do tree layouts -->
            <script type="text/javascript" src="{$smarty.const.APP_URL}appinc/javascript/jlove-protovis-r3.3.js"></script>
            <!--meta name="svg.render.forceflash" content="true" /-->
            
            <script type="text/javascript">
                // to know if the user is connected
                window.isConnected = {if $isConnected} true {else} false {/if};
                // to display errors
                window.err = {$err_json};     
            </script>

      </head>

      <!-- IPAD loves this attribut to a better displaying -->
      <body onload="window.scrollTo(0, 1)">
            

            <h1>Influence Networks</h1>     
            
            <div id="workspace" class="classic-form">
                  <form>                        
                        <input type="hidden"  name="rate" value="{$trust_rank}" />
                        <section>
                              <div class="entity-desc loading default" id="entity-left">
                                    <input type="hidden" class="entity-left-mid" name="entity-left-mid" class="required"  value="{if $entity_left}{$entity_left->getFreebaseId()}{/if}" />
                              </div>
                        </section>

                        <section>
                              <div class="entity-desc loading default" id="entity-right">
                                    <input type="hidden" class="entity-right-mid" name="entity-right-mid" class="required" value="{if $entity_right}{$entity_right->getFreebaseId()}{/if}" />
                              </div>
                        </section>
                  </form>
                  
                  <div class="tooltips" title="{t}No relations yet between these entities.{/t} {if $isConnected}<a href='./?screen=relation-add'>{t}Contribute to the database.{/t}</a>{else}{t}Log in to contribute.{/t}{/if}">
                        <p>{t}Click an entity to view its description.{/t}</p>
                        <p class="browser-alert">{t}For a better rendering, please use a modern Web Browser such as{/t} <a href="http://www.mozilla-europe.org/" target="_blank">Mozilla Firefox</a> {t}or{/t} <a href="http://www.google.com/chrome" target="_blank">Google Chrome</a>.</p>
                  </div>
                  
                  <menu class="ctrl">
                        <a class="zoomIn">{t}Zoom In{/t}</a>
                        <a class="zoomOut">{t}Zoom Out{/t}</a>
                        <a class="backApp button violet" target="_parent" href="./?screen=relation-visualize&amp;rel={if $entity_left}{$entity_left->getFreebaseId()}|{/if}{if $entity_right}{$entity_right->getFreebaseId()}{/if}&amp;trust_rank={$trust_rank}">{t}Back to the application{/t}</a>
                  </menu>
                  
                  

                  <div id="node-informations" class="simpleShadow radiusLight">                  
                        <div class="close">close</div>
                        <h4>An entity name</h4>
                        <div class="dynamique-content">
                              <h5>{t}Informations{/t}</h5>
                              <div class="freebase default loading">
                                    <ul></ul>
                                    <span class="freebase-label">{t}Information provided by Freebase{/t}</span>
                              </div>
                        </div>
                        <div class="dynamique-content">
                              <h5>{t}Relations{/t}</h5>
                              <div class="relations default loading">
                                    <table>
                                          <thead>
                                                <tr>
                                                      <td>{t}Entity{/t}</td>
                                                      <td style="min-width:80px">{t}Type of relation{/t}</td>
                                                      <td style=" text-align:center">{t}Trust rank{/t}</td>
                                                      <td style="width:60px;"></td>
                                                      <td style="width:10px;"></td>
                                                </tr>
                                          </thead>
                                          <tbody>
                                          </tbody>
                                    </table>
                              </div>
                        </div>
                  </div>
                
                {literal}

                      <div id="visualize-layout">
                            <script type="text/javascript">                                    
                                    relationsRender();                            	
                            </script>                      
                      </div>


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
            
                  
                  
      </body>

</html>
            