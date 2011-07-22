<?php

    /**
     * This include construts the screen to visualize a relation.
     * 
     * Include must be declared into /config/config.init.php
     * in the $arrScreen associative Array.
     * 
     * @author pirhoo <pierre@owni.fr>
     * 
     */
    // assing the screen
    $s->assign('screen', 'relation-visualize');

    // page title
    $s->assign('pageTitle', _('Explore'));

    $node_left = null;
    $node_right = null;

    // if a relation is given
    if (isset($_GET["rel"])) {

        $rel = explode("|", $_GET["rel"]);
        // pattern to test if the string is a freebase ID
        $freebase_id_pattern = "!(\/[a-z]{1,3}\/){1}([a-z0-9_]){3,}!i";

        if (preg_match($freebase_id_pattern, $rel[0]))
            $entity_left = $managers["node"]->getNode($rel[0]);

        if (count($rel) == 2 && preg_match($freebase_id_pattern, $rel[1]))
            $entity_right = $managers["node"]->getNode($rel[1]);
    }

    $s->assign("trust_rank", isset($_GET["trust_rank"]) && is_numeric($_GET["trust_rank"]) && $_GET["trust_rank"] <= 5 && $_GET["trust_rank"] >= 1 ? $_GET["trust_rank"] : 3);
    $s->assign("entity_left", $entity_left);
    $s->assign("entity_right", $entity_right);


    $s->assign("countRelation", $managers["relation"]->getRelationCount());
    $s->assign("countRelationReview", $managers["relation_trust_level"]->getRelationTrustLevelCount());
    $s->assign("countUser", $managers["user"]->getUserCount());

    // every errors to a JSON
    $s->assign("err_json", json_encode($err));
    $s->display('index.tpl');
?>
