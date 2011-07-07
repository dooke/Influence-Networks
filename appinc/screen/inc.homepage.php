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
    $s->assign("countRelation", $managers["relation"]->getRelationCount());
    $s->assign("countRelationReview", $managers["relation_trust_level"]->getRelationTrustLevelCount());
    $s->assign("countUser", $managers["user"]->getUserCount());

    // every errors to a JSON
    $s->assign("err_json", json_encode($err));
    $s->display('index.tpl');
    
    
?>
