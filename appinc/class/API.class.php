<?php
/**
 * Receive API calls to process it. 
 * 
 * 
 * 
 * OUTPUT FORMAT:
 *      # JSON
 *      # JSONP (use the "callback" parameter)
 * 
 * QUERY:
 *      # GET Entities list:
 *          /api/entity/
 *              @param <optional> page  [1-*]  default: 1
 *              @param <optional> limit [1-15] default: 5
 * 
 *      # GET Entity with id (or MID):
 *          /api/entity/ID/
 * 
 * 
 *      # GET Relation list:
 *          /api/relation/
 *              @param <optional> page  [1-*]  default: 1
 *              @param <optional> limit [1-15] default: 5
 * 
 *      # GET Relation with id:
 *          /api/relation/ID/
 * 
 * STATUS MESSAGE: 
 *      # 200: OK
 *      # 204: Empty content
 *      # 405: Wrong parameter(s)
 *      # 412: Method not allowed
 *      # 501: Method not emplemented
 *      # 600: Quota exceeted
 * 
 * QUOTA LIMITS:
 *      # GET   : 120 query by hour
 *      # PUT   : 120 query by hour
 *      # POST  : 120 query by hour
 *      # DELETE: 120 query by hour
 *      # HEAD  : 120 query by hour
 * 
 * @author Pirhoo <pierre@owni.fr>
 * @version 1.0
 * @package API
 * 
 */
class API {
        
    const PUT    = 'PUT';
    const GET    = 'GET';
    const POST   = 'POST';
    const HEAD   = 'HEAD';
    const DELETE = 'DELETE';
    
    /**
     * @var DbMySQL
     * @access protected
     */
    protected $db;
    
    /**
     * @var array
     * @access protected
     */
    protected $managers;
    
    /**
     * @var array
     * @access protected
     */
    protected $err;
    
    
    /**
     * GET action (to consult)
     * @access protected
     * @param array $param
     */
    protected function get($param) {
        
        // get the target resource
        $resource = $param["resource"];
        
        // check the resource
        if(!$this->isGoodResource($resource) ) {
            // unknown resource    
            $this->result(601);
        }
        
        // control the quota
        if(! $this->isUnderQuota(self::GET) ) {
            
            // user over the quota limit
            $this->result(600);
            
            
        }else {
            
            // if the user ask an id, it must be a number or mid
            if(isset($param["id"]) && !(is_numeric($param["id"]) || preg_match("#^/[a-z0-9_-]+/[a-z0-9_-]+$#i", $param["id"])) ) {
                
                // wrong parameter
                $this->result(405);
                
            // or id is all right    
            } elseif( isset($param["id"]) ) {
                
                // get the resource
                $result = $this->getResource($resource, $param["id"]); 
                
                // if the resource doesn't exist
                if(!$result)
                    // no content header
                    $this->result (204);
                
                // insert the query in the database to limit quota
                $this->saveQuery(self::GET);

                // send the result
                $this->result(200, $result);
                
            // or user just want a list of resources    
            } else {            
                
                // take the page number from parameter
                $page = isset($param["page"]) && is_numeric($param["page"]) ? $param["page"] : 1;
                
                // take number of resources by page from parameter
                $limit = isset($param["limit"]) && is_numeric($param["limit"])  ? $param["limit"] : 5;
                
                // get the resources
                $result = $this->getResources($resource, $page, $limit);
                
                // if the resource doesn't exist
                if(!$result)
                    // no content header
                    $this->result (204);
                
                // insert the query in the database to limit quota
                $this->saveQuery(self::GET);

                // send the result
                $this->result(200, $result);
            }
            
        }
    }
    
    /**
     * Send the result
     * 
     * @access protected
     * @param integer $code
     */
    protected function result($code, $content = null) {
        
        // list of HTTP code
        $error = array();
        
        // 1XX INFORMATION
        $error[100] = "Continue";
        $error[101] = "Switching Protocols";
        $error[102] = "Processing";

        // 2XX SUCCESS
        $error[200] = "OK";
        $error[201] = "Created";
        $error[202] = "Accepted";
        $error[203] = "Non-Authoritative Information";
        $error[204] = "No Content";
        $error[205] = "Reset Content";
        $error[206] = "Partial Content";
        $error[207] = "Multi-Status";
        $error[210] = "Content Different";

        // 3XX REDIRECTION
        $error[300] = "Multiple Choices";
        $error[301] = "Moved Permanently";
        $error[302] = "Found";
        $error[303] = "See Other";
        $error[304] = "Not Modified";
        $error[305] = "Use Proxy";
        $error[307] = "Temporary Redirect";
        $error[310] = "Too many Redirect";

        // 4XX CLIENT ERROR
        $error[400] = "Bad Request";
        $error[401] = "Unauthorized";
        $error[402] = "Payment Required";
        $error[403] = "Forbidden";
        $error[404] = "Not Found";
        $error[405] = "Method Not Allowed";
        $error[406] = "Not Acceptable";
        $error[407] = "Proxy Authentication Required";
        $error[408] = "Request Time-out";
        $error[409] = "Conflict";
        $error[410] = "Gone";
        $error[411] = "Length Required";
        $error[412] = "Precondition Failed";
        $error[413] = "Request Entity Too Large";
        $error[414] = "Request-URI Too Long";
        $error[415] = "Unsupported Media Type";
        $error[416] = "Requested range unsatisfiable";
        $error[417] = "Expectation failed";
        $error[418] = "I'm a teapot";
        $error[422] = "Unprocessable entity";
        $error[423] = "Locked";
        $error[424] = "Method failure";
        $error[425] = "Unordered Collection";
        $error[426] = "Upgrade Required";
        $error[449] = "Retry With";
        $error[450] = "Blocked by Windows Parental Controls";

        // 5XX SERVER ERROR
        $error[500] = "Internal Server Error";
        $error[501] = "Not Implemented";
        $error[502] = "Bad Gateway ou Proxy Error";
        $error[503] = "Service Unavailable";
        $error[504] = "Gateway Time-out";
        $error[505] = "HTTP Version not supported";
        $error[507] = "Insufficient storage";
        $error[509] = "Bandwidth Limit Exceeded";    
        
        // 6XX CUSTOM ERROR
        $error[600] = "API Quota Exceeded";
        $error[601] = "Unknown resource";

        
        // if no callback function specified
        if(! isset($_REQUEST["callback"]) ) {
            
            // here following the error code
            header('HTTP/1.0 '.$code.' '.$error[$code]);
            header('Content-Type: application/json', true, $code);

            // result with status and status code
            $result = array("status" => $code.' '.$error[$code], "status_code" => $code);

            // add the content, if  there is a content
            if($content !== null) $result["content"] = $content;

            // JSON encode and show the result
            echo json_encode($result);

        // if callback function is specified
        } else {
            
            // here following the error code
            header('HTTP/1.0 200 '.$error[200]);
            header('Content-Type: text/javascript', true, 200);

            // result with status and status code
            $result = array("status" => $code.' '.$error[$code], "status_code" => $code);

            // add the content, if  there is a content
            if($content !== null) $result["content"] = $content;

            // JSON encode and show the result
            echo $_REQUEST["callback"]."(".json_encode($result).");";
        }
        
        // it's done !
        exit;
    }
  
    
    /**
     * True if the resource type is allowed. Else false.
     * 
     * @access protected
     * @param string $resource
     * @return boolean
     */
    protected function isGoodResource($resource) {
           $resource = strtolower($resource);
           return $resource == "entity" || $resource == "relation";
    }
    
    
    /**
     * Save the user API query
     * 
     * @access protected
     * @param  string $method
     * @return boolean
     */
    protected function saveQuery($method) {
               
        $param = $_REQUEST;
        // useless variable
        unset($param["api"]);
        
        // escape quotes
        foreach($param as $key => $val)        
            $param[$key] = htmlentities($val, ENT_QUOTES);        
        
        // query to insert
        $api_query = str_replace("\\\\", "\\", json_encode($param) );
        // ip to insert
        $IP        = $_SERVER["REMOTE_ADDR"];
        
        $query  = "INSERT INTO ".TABLE_PREFIX."api_query ";
        $query .= "(IP, method, query)";
        $query .= "VALUES(";
            $query .= "'{$IP}',";
            $query .= "'{$method}',";
            $query .= "'{$api_query}'";
        $query .= ")";
        
        // insert
        return $this->db->query($query);        
    }
    
    /**
     * Say if the user can ask the api for this method
     * 
     * @param string $method
     * @return boolean
     */
    protected function isUnderQuota($method) {
        
        // ip to track
        $IP = $_SERVER["REMOTE_ADDR"];
        
        // query to count query for this method
        $query  = "SELECT COUNT(id) FROM ".TABLE_PREFIX."api_query ";
        $query .= "WHERE ";
            $query .= "IP = '{$IP}' ";
            $query .= "AND method = '{$method}' "; 
            // every line older than 1 hour
            $query .= "AND date > (NOW() - INTERVAL 60 MINUTE)";
          
        // ask the database    
        $this->db->query($query);
        list($count) = $this->db->fetch();                    
                
        
        return $count < $this->getMethodQuota($method);
        
    }
    
    
    /**
     * Get a resource
     *
     * @param string $resource
     * @param number $id
     *
     * @access protected
     * @return array
     */
    protected function getResource($resource = null, $id = null) {
        
        // if parameters are fine
        if( $resource !== null && $id !== null ) {
            // select the resource
            switch ($resource) {
                // it's an entity
                case "entity": 
                    // we use "entity" to select "node", it seems more user-friendly
                    $node = $this->managers['node']->getNode($id);
                    
                    // array conversion
                    $node = $node instanceof Node ? $node->getArray() : false;
                    
                    // if the result is OK
                    if(is_array($node))
                        
                        // get the relations of the node
                        $node["relations"] = $this->managers['relation']->getNodeRelationArray( $node["id"] );
                    
                    // return the result
                    return $node; break;
                
                // it's a relation
                case "relation": 
                    
                    // relation
                    $relation = $this->managers["relation"]->getRelation($id);                                        
                    
                    // array conversion
                    $relation = $relation instanceof Relation ? $relation->getArray(true) : false;
                                        
                    
                    // if the result is OK
                    if(is_array($relation)) {
                        
                        // Get the true node                        
                        /* $relation["node_right"] = $this->managers['node']->getNode($relation["node_right"]);                        
                        // if result it's ok
                        if($relation["node_right"] instanceof Node)
                            // convert Object to array
                            $relation["node_right"] = $relation["node_right"]->getArray(true);
                        
                        $relation["node_left"]  = $this->managers['node']->getNode($relation["node_left"]);                 
                        // if result it's ok
                        if($relation["node_left"] instanceof Node)
                            // convert Object to array
                            $relation["node_left"] = $relation["node_left"]->getArray(true); */
                        
                        // Get the complete type
                        $relation["type"] = $this->managers['relation_type']->getType($relation["type"]);
                        
                        // if the result is OK
                        if($relation["type"] instanceof Relation_type) {
                            
                            // convert Object to array
                            $relation["type"] = $relation["type"]->getArray();
                        }
                        
                        
                        // Get relation properties
                        $relation["properties"] = $this->managers["relation_value"]->getRelationValues($id);
                        
                        // convert properties to array
                        if( is_array($relation["properties"]) ) {
                            
                            // for each property
                            foreach($relation["properties"] as & $prop)
                                
                                // convert Object to Array
                                $prop = $prop->getArray();
                        }
                        
                    }
                        
                    // return the result
                    return $relation; break;
                
            }
        }
        
    }
    
    
    /**
     * 
     * Get a list of resources
     *
     * @param string $resource
     * @param int $page
     * @param int $limit
     * 
     * @access protected
     * @return array
     */
    protected function getResources($resource = null, $page = 1, $limit = 5) {
                
        // minimum and maximun value for limit
        $limit = $limit > 15 || $limit < 1 ? 5 : $limit;
        $offset = ($page - 1) * $limit;
        
        // if parameters are fine
        if( $resource !== null ) {
            // select the resource
            switch ($resource) {
                
                // it's an entity
                case "entity":
                    
                    // get the node list
                    $nodes = $this->managers["node"]->getNodesList($offset, $limit);
                    
                    // if the result is an array
                    if( is_array($nodes) )
                        // for each node
                        foreach($nodes as $key => & $node)
                            // get relations
                            $node["relations"] = $this->managers["relation"]->getNodeRelationArray($node["id"]);
                    
                    // return the result
                    return $nodes; break;
                
                // it's a relation
                case "relation": 
                    
                    // get the relation list
                    $relations = $this->managers["relation"]->getRelationsList($offset, $limit);
                    
                    // return the result
                    return $relations; break;
                
                
            }
        }
        
    }
    
    
    /**
     * Switch an action following the GET paramater
     * @access public
     */
    public function switchAction() {
        
        switch($_SERVER['REQUEST_METHOD']) {
            
            // consult with GET
            case self::GET:                
                $this->get($_GET);
                break;
                    
            // delete with DELETE
            case self::DELETE:
                // not implemented yet
                $this->result(501);
                break;
            
            // update with POST
            case self::POST:
                // not implemented yet
                $this->result(501);
                break;
            
            // insert with PUT
            case self::PUT:     
                // not implemented yet
                $this->result(501);
                break;
            
            // query not allowed
            default : $this->result(412);
                
        }
        
    }
    
    /**
     * Get the query quota of a method, by our
     * 
     * @param string $method
     * @return int 
     */
    public function getMethodQuota($method) {
    
        // quota for each method by hour
        $quota  = array(self::PUT    => 120,
                        self::GET    => 120,
                        self::POST   => 120,
                        self::HEAD   => 120,
                        self::DELETE => 120);
        
        return $quota[$method];
    }
    
    
    /**
     * Constructor
     * @access public 
     */
    public function __construct(& $db, & $managers, & $err) {
        
        // reference to the base
        $this->db = & $db;
        
        // reference to the managers
        $this->managers = & $managers;
        
        // reference to the error manager
        $this->err = & $err;
        
        // switch an action following the GET paramater
        $this->switchAction();
        
    }
    
}

?>
