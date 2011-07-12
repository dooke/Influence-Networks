<?php
/**
 * Receive API calls to process it. 
 * 
 * 
 * @author Pirhoo <pierre@owni.fr>
 * @version 1.0
 * @package API
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
            case self::DELETE:break;
            
            // update with POST
            case self::POST:break;
            
            // insert with PUT
            case self::PUT:break;
            
            // query not allowed
            default :  $this->result(412);
                
        }
        
    }
    
    /**
     * GET action (to consult)
     * @access protected
     * @param array $param
     */
    protected function get($param) {
        
        // get the target resource
        $resource = $param["resource"];
        
        // check the resource
        if(!$this->isGoodResource($resource) ) $this->result(405);
        
        // control the quota
        if(! $this->isUnderQuota(self::GET) ) {
            
            // user over the quota limit
            $this->result(600);
            
            
        }else {
            
            // insert the query in the database to limit quota
            $this->saveQuery(self::GET);

            // send the result
            $this->result(200, array());
            
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

        
        // here following the error code
        header('HTTP/1.0 '.$code.' '.$error[$code]);
        header('Content-Type: application/json', true, $code);
        
        // result with status and status code
        $result = array("status" => $code.' '.$error[$code], "status_code" => $code);
        
        // add the content, if content there is
        if($content !== null) $result["content"] = $content;
        
        // JSON encode and show the result
        echo json_encode($result);
        
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
               
        $GET = $_GET;
        // useless variable
        unset($GET["api"]);
        
        // escape quotes
        foreach($GET as $key => $val)        
            $GET[$key] = htmlentities($val, ENT_QUOTES);        
        
            
        // query to insert
        $api_query = str_replace("\\\\", "\\", json_encode($GET) );
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
            $query .= "AND DATE_SUB(CURDATE(), INTERVAL 1 HOUR) <= date";
          
        // ask the database    
        $this->db->query($query);
        list($count) = $this->db->fetch();                    
        
        return $count < $this->getMethodQuota($method);
        
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
}

?>
