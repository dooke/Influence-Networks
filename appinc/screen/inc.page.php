<?php

    /**
     * This include construts the classic page screen.
     * 
     * Include must be declared into /config/config.init.php
     * in the $arrScreen associative Array.
     * 
     * @author pirhoo <pierre@owni.fr>
     * @tutorial Influence Networks don't want to provide a service to edit and 
     * broadcast page. To offer a quality service to our editors, we choise to use
     * Wordpress 3 and a JSON API plugin...
     * 
     * @link http://wordpress.org/
     * @link http://wordpress.org/extend/plugins/json-api/
     * 
     */        
    
    if( isset($_GET["id"]) ) {
        

        // decode the page
        $page = getPage($_GET["id"]);

        // if status is OK
        if(!!$page) {
            // page title
            $s->assign('pageTitle', $page->title );
            // page data
            $s->assign('page', $page);
            
        }
        
    }
    
    
    // assing the screen
    $s->assign('screen', 'page');
    
    
    // counts for the footer
    $s->assign("countRelation", $managers["relation"]->getRelationCount());
    $s->assign("countRelationReview", $managers["relation_trust_level"]->getRelationTrustLevelCount());
    $s->assign("countUser", $managers["user"]->getUserCount());
    
    
    // every errors to a JSON
    $s->assign("err_json", json_encode($err));
    $s->display('index.tpl');
    
?>
