<?php
/**
 * Class to process system action
 *
 * @package Action
 * @author pirhoo
 */
class Action {
    
    // GET and POST backup
    protected $GET;
    protected $POST;
    // action requested
    protected $action;
    // managers
    protected $managers;
    
    
    /**
     * Constructor
     * 
     * @param reference $managers
     * @access public
     */
    public function __construct(& $managers = null) {
        
        // if no manager specified
        if($managers == null) throw new Exception("No Managers specified.");
        
        // record manager
        $this->managers = & $managers;
        
        // if an action is requested
        if( isset($_REQUEST["action"]) ){
            
            // action
            $this->action = $_REQUEST["action"];
            
            // init GET and POST local attributs
            $this->GET = $_GET;
            $this->POST = $_POST;
            
            try{
                
                // switch between deferents action handler
                $this->switchHandler();
                
            // if an exception is thrown
            } catch(Exception $e) {
                // if exception throws a string message 
                if( is_string($e->getMessage()) ) {
                    // false status
                    echo json_encode(Array("status" => false, "message" => $e->getMessage()));
                    exit;
                }
            }
            
        } else throw new Exception("Any action received.");
        
    }
    
    /**
     * Switch between deferents action handler
     * 
     * @TODO Put each case in a dedicated method 
     * @access public
     */
    public function switchHandler() {
        
        switch($this->action) {

              case "signin":
                    echo json_encode(Array("status" => $this->managers['user']->isConnected()));
                    exit;
                    break;

              case "signup":
                    echo $this->managers['user']->addUser();
                    exit;
                    break;

              case "getnodelist":
                    echo $this->managers['node']->getNodeList();
                    exit;
                    break;

              case "getRelationBetweenNodes":
                    echo $this->managers['relation']->getRelationBetweenNodes();
                    exit;
                    break;

              case "getNodeRelation":
                    echo $this->managers["relation"]->getNodeRelationJSON();
                    exit;
                    break;

              case "getRelationValues":
                    echo $this->managers["relation_value"]->getRelationValuesJSON($_REQUEST["relation_id"]);
                    exit;
                    break;

              case "removeUselessNodes":
                    echo $this->managers["node"]->removeUselessNode();
                    exit;
                    break;

              case "updateNodeInfo":
                    echo $this->managers["node"]->updateNodeInfo();
                    exit;
                    break;

              case "sendUserConfirmationEmail":
                    $this->managers["user"]->sendUserConfirmationEmail();
                    exit;
                    break;

              case "confirmAccount":
                    $this->managers["user"]->confirmAccount();
                    break;

              case "createTopic":
                    $this->createTopic();
                    break;
              
              case "getMergeNodesRelation":
                    $this->getMergeNodesRelation();
                    break;
                
              case "getMoreNodesRelations":
                    $this->getMoreNodesRelations();
                    break;
                
              default:break;
        }
        
    }
    
    /**
     * Create a topic
     * 
     * @access public
     */
    public function createTopic() {
         
        
        // check the data
        if(isset($this->GET['name']) && isset($this->GET['type']) && $this->managers["user"]->isConnected()) {
            
            // check first if the the node exist
            $node = $this->managers["node"]->getFreebaseNodeByName($this->GET['name']);

            // node exists, we shouldn't to add it
            if($node) {            
                // json encode the result
                echo json_encode(array("status" => true, "node" => $node->getArray() ));
                exit;
                
            // or doesn't exist and add it
            } else { 

                // create the topic in Freebase
                $node = $this->managers["node"]->createFreebaseNode($this->GET['name'], $this->GET['type']);
                // if the node was created
                if($node) {

                    // json encode the result
                    echo json_encode(array("status" => true, "node" => $node->getArray() ));
                    exit;

                // throw exception    
                } else throw( new Exception("Topic creation in Freebase failed.") );
            }
            
        // throw exception    
        } else throw( new Exception("Topic creation in Freebase failed.") );
        
    }
    
    /**
     * Get every nodes relations
     * 
     * @access public 
     */
    public function getMergeNodesRelation() {
        
        if(isset($_REQUEST["entity-left-mid"]) || isset($_REQUEST["entity-right-mid"])) {
            
            // get every relation
            $relations = $this->managers["relation"]->getMergeNodesRelation($_REQUEST["entity-left-mid"], $_REQUEST["entity-right-mid"]);
            
            // get nodes
            $nodes = array();
            
            if( isset($_REQUEST["entity-left-mid"]) ) {                
                $node_instance = $this->managers["node"]->getNode($_REQUEST["entity-left-mid"]);
                if(!!$node_instance) $nodes[] = $node_instance->getArray();
            }
            
            if( isset($_REQUEST["entity-right-mid"]) ) {
                $node_instance = $this->managers["node"]->getNode($_REQUEST["entity-right-mid"]);
                if(!!$node_instance) $nodes[] = $node_instance->getArray();
            }
            
            echo json_encode(array("status" => true, "nodes" => $nodes, "relations" => $relations ));
            exit;
            
        // throw exception    
        } else throw( new Exception("Missing paramters.") );
        
    }
    
    
    /**
     * Get every nodes relations and its children's relations
     * 
     * @access public 
     */
    public function getMoreNodesRelations() {
        
        if(isset($_REQUEST["entity-left-mid"]) || isset($_REQUEST["entity-right-mid"])) {
            
            // get every relation
            $relations = $this->managers["relation"]->getMoreNodesRelations($_REQUEST["entity-left-mid"], $_REQUEST["entity-right-mid"]);
            
            // get nodes
            $nodes = array();
            
            if( isset($_REQUEST["entity-left-mid"]) ) {                
                $node_instance = $this->managers["node"]->getNode($_REQUEST["entity-left-mid"]);
                if(!!$node_instance) $nodes[] = $node_instance->getArray();
            }
            
            if( isset($_REQUEST["entity-right-mid"]) ) {
                $node_instance = $this->managers["node"]->getNode($_REQUEST["entity-right-mid"]);
                if(!!$node_instance) $nodes[] = $node_instance->getArray();
            }
            
            echo json_encode(array("status" => true, "nodes" => $nodes, "relations" => $relations ));
            exit;
            
        // throw exception    
        } else throw( new Exception("Missing paramters.") );
            
        
    }
    
}

?>
