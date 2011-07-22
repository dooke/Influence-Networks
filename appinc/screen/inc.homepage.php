<?php

    /**
     * This include construts the homepage screen.
     * 
     * Include must be declared into /config/config.init.php
     * in the $arrScreen associative Array.
     * 
     * @author pirhoo <pierre@owni.fr>
     * 
     */
    
    // assing the screen
    $s->assign('screen', 'homepage');
    // page title
    $s->assign('pageTitle', _('Home') );
    
    // introduction
    $s->assign('intro', getPage("introduction"));
    
    // influence networks for...
    $s->assign('forJournalists', getPage("influence-networks-for-journalists"));
    $s->assign('forDevelopers', getPage("influence-networks-for-developers"));
    $s->assign('forCitizens', getPage("influence-networks-for-citizens"));
    
    $s->assign("countRelation", $managers["relation"]->getRelationCount());
    $s->assign("countRelationReview", $managers["relation_trust_level"]->getRelationTrustLevelCount());
    $s->assign("countUser", $managers["user"]->getUserCount());

    // every errors to a JSON
    $s->assign("err_json", json_encode($err));
    $s->display('index.tpl');
    
    
?>
