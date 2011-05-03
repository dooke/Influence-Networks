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
                  $url = "http://www.freebase.com/api/service/mqlread?query=";
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
      
}

?>
