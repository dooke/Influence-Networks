<?php


/**
 * Description of NodeManager
 *
 * @author pirhoo
 */
class NodeManager extends Manager {

      private $nodes = Array();

      function __construct(& $smarty, & $db, & $managers, & $err) {

            // call the parent construtor
            parent::__construct($smarty, $db, $managers, $err);
      }

      public function getNodeList() {

            // get key
            $key = addslashes($_GET["term"]);

            // sql query
            $query = "SELECT * 
                      FROM " . TABLE_PREFIX . "node 
                     WHERE label LIKE '%{$key}%'";

            // process query
            $this->db->query($query) or die(json_encode(Array("statut" => false, "message" => _("Database error. Sorry, try again."))));

            $nodeList = Array();
            while ($row = $this->db->fetch()) {

                  $nodeList[] = Array(
                      "id" => $row["id"],
                      "label" => preg_replace("#($key)#i", "$1", $row["label"]),
                      "freebase_id" => $row["freebase_id"],
                      "type" => $row["type"]
                  );
            }

            // if the research return no result
            /** if (count($nodeList) == 0) {

                  // so, we are requesting the freebase API
                  $url = "http://www.freebase.com/api/service/mqlread?query=";
                  $url .= '{ "query"%3A [{ "name~%3D"%3A "' . urlencode($key) . '*"%2C "name"%3A null%2C "mid"%3A null%2C "type"%3A []%2C "type|%3D"%3A [ "%2Fpeople%2Fperson"%2C "%2Forganization%2Forganization" ]%2C "limit"%3A 50 }] }';

                  $data = file_get_contents($url);
                  $data = json_decode($data, true);

                  foreach ($data['result'] as $node)
                        $nodeList[] = Array(
                            "id" => null,
                            "label" => $node["name"],
                            "freebase_id" => $node["mid"],
                            "type" => $node["type"][0]
                        );
            } **/

            // return the json
            return json_encode(Array("statut" => true, "key" => $key, "node" => $nodeList));
      }

      public function getNode($key) {
            
            
            if (is_numeric($key))
                  $query = "SELECT * 
                              FROM " . TABLE_PREFIX . "node 
                             WHERE id = {$key}";
            else {
                  $key = addslashes($key);
                  $query = "SELECT * 
                              FROM " . TABLE_PREFIX . "node 
                             WHERE freebase_id = '{$key}'";
            }
            
            if (!isset($this->nodes[$key])) {

                  $this->db->query($query) or die(_("Database error. Sorry, try again."));
                  $row = $this->db->fetch();                  

                  if($row && isset($row["id"]) ) {                        
                        
                        $this->nodes[ $row["id"] ]          = new Node($row);                        
                        $this->nodes[ $row["freebase_id"] ] = new Node($row);    
                  }
                  
            }

            return ( isset($this->nodes[$key]) ) ? $this->nodes[$key] : false;
      }
      
      public function addFreebaseNode($freebase_id) {
            
            // if node doesn't exist
            $n = $this->managers["node"]->getNode($freebase_id);
            if($n == false && $freebase_id != "") {

                  // we found data
                  $node_label = "";
                  $node_type  = "";

                  // we insert it on the database
                  $query = "INSERT INTO " . TABLE_PREFIX . "node (freebase_id, label, type) VALUES('{$freebase_id}', '{$node_label}', '{$node_type}')";
                  
                  $this->db->query($query) or die("Database error. Sorry, try again.");
                  
                  $this->updateNodeInfo();
                  
                  return $this->managers["node"]->getNode($freebase_id);

                  
            } return $n;
            
      }
      
      /**
       * Remove every useless nodes
       * @access public
       * @return string
       */
      public function removeUselessNode() {
            
            // select every useless nodes
            $query = "SELECT id FROM " . TABLE_PREFIX . "node WHERE id NOT IN (SELECT N.id FROM " . TABLE_PREFIX . "node N,  " . TABLE_PREFIX . "relation R WHERE R.node_left = N.id OR R.node_right = N.id)";
            $this->db->query($query) or die("Database error. Sorry, try again.");
            
            $ids = "null";
            
            // put every node in a string
            while($row = $this->db->fetch() )
                  $ids .= ",".$row["id"];
            
            // remove query
            $query = "DELETE FROM " . TABLE_PREFIX . "node WHERE id IN ({$ids})";
            $this->db->query($query) or die("Database error. Sorry, try again.");
            
            return json_encode(array("status" => true));
      }
      
      /**
       * Complete node without label
       * @access public
       * @return string
       */
      public function updateNodeInfo() {
            
            // select every nodes without name (no more than 50 nodes updated each time)
            $query = "SELECT * FROM " . TABLE_PREFIX . "node WHERE label = '' AND freebase_id != '' LIMIT 50";
            $this->db->query($query) or die("Database error. Sorry, try again.");
            
            $result = $this->db->getResult();
            
            // for each node
            while($row = mysql_fetch_array($result)) {
                  
                  // load name from freebase
                  $url = FREEBASE_API_MQLREAD."?query=";
                  $url .= '{ "query"%3A [{ "id"%3A "' . $row["freebase_id"] . '"%2C "name"%3A null%2C "type|%3D"%3A [ "%2Fpeople%2Fperson"%2C "%2Forganization%2Forganization" ]%2C "type"%3A null }] }';

                  $node = json_decode(file_get_contents($url));
                  $node_label = addslashes($node->result[0]->name);
                  $node_type  = $node->result[0]->type;
                  
                  // update node
                  $query = "UPDATE " . TABLE_PREFIX . "node SET label = '{$node_label}', type = '{$node_type}' WHERE id = {$row["id"]}";
                  $this->db->query($query) or die("Database error. Sorry, try again.");
                  
            }
            
            return json_encode(array("status" => true));            
      }
      
      
    /**
     * Authentificate the app and return the Freebase's server response
     * @access public
     * @return array
     */
    public function freebaseAuthenfication() {
        
    
        $curl = curl_init();  
        // block the certificate checking with curl
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        // hide curl...
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)"); 
        // header in the return value
        curl_setopt($curl, CURLOPT_HEADER, false);
        // return the target content
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // follow the handler
        curl_setopt($curl, CURLINFO_HEADER_OUT, true);
        // keep data when target changes the location
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        // initiates cookie file 
        curl_setopt($curl, CURLOPT_COOKIEFILE, "/tmp/cookieInfNetsFreebase");
        curl_setopt($curl, CURLOPT_COOKIEJAR, "/tmp/cookieInfNetsFreebase");
        // set target URL
        curl_setopt($curl, CURLOPT_URL, FREEBASE_API_LOGIN); 
        // active POST data
        curl_setopt($curl, CURLOPT_POST, true);
        // login info
        $login = array("username" => FREEBASE_USERNAME, "password" => FREEBASE_PASSWORD, "rememberme" => true);
        // set POST data    
        curl_setopt($curl, CURLOPT_POSTFIELDS, $login);     

        // execute the query
        $data = curl_exec($curl);
        
        $headers = curl_getinfo($curl, CURLINFO_HEADER_OUT);
        
        // close curl
        curl_close($curl);
    
        return Array("content" => $data, "header" => $headers);
    }


    /**
     * Create an entity on freebase
     * @param string $name
     * @param string $type
     * @access public
     * @return boolean
     */
    public function createFreebaseNode($name, $type) {
        
        $auth = $this->freebaseAuthenfication();        
        
        // if query and authentification succeed, and the cookie exists
        if(!!$auth && json_decode($auth["content"])->code == "/api/status/ok" && file_exists("/tmp/cookieInfNetsFreebase") ) {

            $curl = curl_init();  
            // block the certificate checking with curl
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            // hide curl...
            curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)"); 
            // no header in the return value
            curl_setopt($curl, CURLOPT_HEADER, 0);
            // active POST data
            curl_setopt($curl, CURLOPT_POST, 1);
            // don't return the target content
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            // keep data when target changes the location
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

            // extract cookies from headers
            preg_match_all('#Cookie: (.*)\b#', $auth["header"], $cookies);                
            
            // use authentification cookie
            curl_setopt($curl, CURLOPT_COOKIE, implode(";", $cookies[1]) );

            $requestHeaders   = array();
            $requestHeaders[] = 'X-Requested-With:curl';
            $requestHeaders[] = 'X-Metaweb-Request:true';
            curl_setopt($curl, CURLOPT_HTTPHEADER, $requestHeaders);

            // topic to create
            $queryCreate = array("create" => "unless_exists",
                                 "type"   => $type,
                                 "name"   => $name);
            
            // mql query
            $mqlquery = json_encode(array("query" => $queryCreate));

            // set POST data    
            curl_setopt($curl, CURLOPT_POSTFIELDS, 'query='.$mqlquery.'');    

            // url to write on the API
            curl_setopt($curl, CURLOPT_URL, FREEBASE_API_MQLWRITE);
            // execute the query
            $data = curl_exec($curl); 
            // close curl
            curl_close($curl);
            
            return !!$data ? $this->getFreebaseNodeByName($name) : false;
            
        }else return false;
        
        
    }
     
    /**
     * @param string $name
     * @access public
     * @return Node
     */
    public function getFreebaseNodeByName($name) {
        
        // query to select the entity
        $query = array(
            "name" => $name,
            "id"   => null,
            "type" => array(),
            "type|=" => array("/organization/organization", "/people/person")
        );
        
        // get the freebase node
        $content = file_get_contents(FREEBASE_API_MQLREAD."?query=".urlencode(json_encode(array("query" => $query) ) )."");
        
        // if query failled
        if(!$content) return false;
            
        // convert the content from json to php
        $content = json_decode($content, true);
        
        // if query failled or there are no result
        if($content["code"] != "/api/status/ok" || count($content["result"]) == 0) return false;
        
        // create node
        $node = array();
        // just take the first type
        $node["type"]  = $content["result"]["type"][0];
        $node["freebase_id"]    = $content["result"]["id"];
        $node["label"] = $content["result"]["name"];
        
        return new Node( $node );
        
        
    }
        
}

?>
