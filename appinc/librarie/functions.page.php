<?php
    
    /**
     * Get a page from the Provider
     * 
     * @param string $name
     * @return boolean or object
     */
    function getPage($name) {
       
        // page's id and url
        $arrPageQuery = array(
            "about" => PAGES_PROVIDER."about/?json=1",
            "licence" => PAGES_PROVIDER."licence/?json=1",
            "terms-of-use" => PAGES_PROVIDER."terms-of-use/?json=1",
            "privacy-policy" => PAGES_PROVIDER."privacy-policy/?json=1",
            "introduction" => PAGES_PROVIDER."introduction/?json=1&custom_fields=yt",
            "influence-networks-for-journalists" => PAGES_PROVIDER."influence-networks-for-journalists/?json=1",
            "influence-networks-for-citizens" => PAGES_PROVIDER."influence-networks-for-citizens/?json=1",
            "influence-networks-for-developers" => PAGES_PROVIDER."influence-networks-for-developers/?json=1"
        );
        
        
        // url to extract the page
        $pageProvider = $arrPageQuery[$name];

        // extract the page
        $pageText = file_get_contents($pageProvider);
                
        if($pageText) {
            
            // decode the page
            $page = json_decode($pageText);
            
            // if status is OK
            if($page->status == "ok") {               
            
                return $page->page;
                
            } else return false;
            
        } else return false;
        
    }
    
    
?>
