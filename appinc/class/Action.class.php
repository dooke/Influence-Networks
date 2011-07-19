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
        if($_REQUEST["action"]) {
            
            // action
            $this->action = $_REQUEST["action"];
            
            // init GET and POST local attributs
            $this->GET = $_GET;
            $this->POST = $_POST;
            
            // switch between deferents action handler
            $this->switchHandler();
            
        } else throw new Exception("Any action received.");
        
    }
    
    /**
     * Switch between deferents action handler
     * 
     * @access public
     */
    public function switchHandler() {
        
        switch($this->action) {

              case "signin":
                    echo json_encode(Array("statut" => $this->$managers['user']->isConnected()));
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

              case "getMergeRelationNodes":
                    echo $this->managers['relation']->getMergeRelationNodes();
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
                    //$this->managers["entity"]->createTopic();
                    break;


              default:break;
        }
        
    }
    
    
    
    
    
    
}

?>
