<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserManager
 *
 * @author pirhoo
 */
class UserManager extends Manager {
    
    private  $connexion;
    private  $users = array();


    function __construct(& $smarty, & $db, & $managers, & $err) {
        
        // call the parent construtor
        parent::__construct($smarty, $db, $managers, $err);
        
        // define if the user is connected
        if(isset($_GET["action"]) && $_GET["action"] == "signout") { 
              
                unset($_SESSION["user_id"]);
                unset($_SESSION["user_email"]);
                unset($_SESSION["user_password"]);
        }
        
        $this->evalConnexion();
        $this->smarty->assign("isConnected", $this->isConnected() );
    }
    
    
    private function evalConnexion() {
       
        // Evaluation with SESSION
        if( isset($_SESSION["user_email"])
        &&  isset($_SESSION["user_password"]) ) {

            $query = "SELECT *
                        FROM ".TABLE_PREFIX."user
                       WHERE email='".$_SESSION["user_email"]."' 
                         AND password='".$_SESSION["user_password"]."'";
            
            $this->db->query($query) or die(  _("Database error. Sorry, try again.") );

            $row = $this->db->fetch();
            $this->smarty->assign("user", new User($row) );            

            $this->connexion = ($this->db->numrows() == 1);
                
            if($this->connexion) {
                
                $_SESSION["user_id"] = $row["id"];
                  
                $user = new User($row);
                $this->smarty->assign("user", Array("id" => $user->getId(),
                                                    "email" => $user->getEmail(), 
                                                    "trust_level" => $user->getTrustLevel(),
                                                    "count_relation" => $this->countUserRelation( $user->getId() ),
                                                    "count_relation_trust_level" => $this->countUserRelationTrustLevel( $user->getId() )  ) );
                
            }
            

        // Evaluation width POST REQUEST
        } elseif( isset($_POST["email"])
              &&  isset($_POST["password"]) ) {

            $query = "SELECT *
                        FROM ".TABLE_PREFIX."user
                       WHERE  email='".$_POST["email"]."' 
                         AND  password='".$_POST["password"]."'";
            
            $this->db->query($query) or die(  _("Database error. Sorry, try again.") );

            $row = $this->db->fetch();
             
            $this->connexion = ($this->db->numrows() == 1);
            
            if($this->connexion) {
                
                $_SESSION["user_id"]       = $row["id"];
                $_SESSION["user_email"]    = $row["email"];
                $_SESSION["user_password"] = $row["password"];
                  
                  
                $user = new User($row);
                $this->smarty->assign("user", Array("id" => $user->getId(),
                                                    "email" => $user->getEmail(), 
                                                    "trust_level" => $user->getTrustLevel() ) );               
                
            }
            
        }else $this->connexion = false;
        
    }

    public function isConnected() {
          return !!$this->connexion;
    }
    
    
    public function addUser() {
          
       if( $_POST["email"] != "" 
       &&  $_POST["password_1"] != "" 
       &&  $_POST["password_2"] != "" ) {
       
          
          if( $_POST["password_1"] == $_POST["password_2"] ) {
              
                 $pattern = "#^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+#";
                 
                 if( preg_match($pattern, $_POST["email"]) && preg_match("#[a-zA-Z0-9]#i", $_POST["password_1"]) ){  
                     
                       if( ! $this->getUser( $_POST["email"] ) ) {                                              

                             // the trust level is determinate with the email adresse ;)
                             $trustLevel = preg_match("#@owni\.fr$#i", $_POST["email"])  ? 5 : 1;
                             
                             // all right, 
                             // it's time to sign up, dude
                             $query = "INSERT INTO ".TABLE_PREFIX."user (email, password, trust_level) VALUES ('{$_POST["email"]}', '{$_POST["password_1"]}', {$trustLevel})";

                             // process MySql query (or die if error)
                             $this->db->query($query) or die( json_encode( Array("statut" => false, "message" => _("Database error. Sorry, try again.") ) ) );

                             // save SESSION data
                             $_SESSION["user_email"] = $_POST["email"];
                             $_SESSION["user_password"] = $_POST["password_1"];

                             // every things is all right
                             return json_encode( Array("statut" => true ) ); 
                             
                       } else
                             // Form is incomplete.              
                             return jjson_encode( Array("statut" => false, "message" => _("Email address already exist.") ) );
                     
                 } else
                       // Form is incomplete.              
                       return jjson_encode( Array("statut" => false, "message" => _("Email address is not valid.") ) );
                                 
          }else
               // Passwords are not matching.
              return jjson_encode( Array("statut" => false, "message" => _("Passwords are not matching.") ) );
          

       } else
           // Form is incomplete
            return json_encode( Array("statut" => false, "message" => _("Form is incomplete.") ) );
          
    }
    
    public function getUser($key) {
    
          // email pattern
          $pattern = "/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/";
                 
          // key is an user id
          if( is_numeric($key) ) {
                
                if( ! isset($this->nodes[$key]) ) {
                      
                      $query = "SELECT * FROM ".TABLE_PREFIX."user WHERE id={$key}";
                      $this->db->query($query);
                      
                      $this->nodes[$key] = ( $user = $this->db->fetch() ) ? new User($user) : false;                      
                }
                
                        
                return $this->nodes[$key];
                
          // key is an user email
          } elseif( preg_match($pattern, $key) ) {
                
                
                $query = "SELECT * FROM ".TABLE_PREFIX."user WHERE email='{$key}'";
                $this->db->query($query);
                
                $this->nodes[$key] = ( $user = $this->db->fetch() ) ? new User($user) : false;
                
                return $this->nodes[$key];
                
          // nothing else...      
          } else return false;
    
    }
    
    public function updateTrustLevel($user_id, $add_level) {
          
          $user = $this->managers["user"]->getUser($user_id);
          if(!!$user) {
            
                $tl = $user->getTrustLevel();                
                if($tl < 5) {
                 
                      $tl += $add_level * 1/9 - 1/9;
                      $tl = round($tl*10) / 10;
                      $tl = str_replace(",", ".", $tl);
                      
                      // query to update the trust level
                      $query = "UPDATE ".TABLE_PREFIX."user SET trust_level = '{$tl}' WHERE id = {$user_id}";
                      $this->db->query($query) or die(  _("Database error. Sorry, try again.") );
                }
          }
          
          
    }
    
    /**
     * Return the number of users
     * @return integer
     */
    public function getUserCount() {
                          
          $query = "SELECT COUNT(id) AS nb FROM ".TABLE_PREFIX."user";
          $this->db->query($query);
          $count = $this->db->fetch();

          return $count["nb"];
    }
    
    
    public function countUserRelation($user_id) {
                    
          // key is an user id
          if( is_numeric($user_id) ) {
                
                $query = "SELECT COUNT(id) as NB FROM ".TABLE_PREFIX."relation WHERE creator={$user_id}";
                $this->db->query($query);
                
                $count = $this->db->fetch();
                
                return $count["NB"];
          } 
    }
    
    public function countUserRelationTrustLevel($user_id) {
                    
          // key is an user id
          if( is_numeric($user_id) ) {
                
                $query = "SELECT COUNT(*) as NB FROM ".TABLE_PREFIX."relation_trust_level WHERE user_id={$user_id}";
                $this->db->query($query);
                
                $count = $this->db->fetch();
                
                return $count["NB"];
          } 
    }
    
    
    /**
     * Send an email to the user to confirm its account. 
     * Return false if the user doesn't exist or has already confirm its account.
     * Return true if the mail has been send.
     * @param <integer or User> $p_user Polymorph parameter
     * @return boolean
     */    
    public function sendUserConfirmationEmail($p_user = null) {
                
        // if the paramater is an integer
        if( $p_user == null && is_numeric($_GET["user_id"]) ) {
            
            /* @var $user User */
            $user = $this->getUser($_GET["user_id"]);
            
            // user doesn't exist
            if(! $user instanceof User) 
                return false;
            
        // or stop if it's not an User instance
        } elseif(! $user instanceof User)
            return false;
            
        // user already confirmed
        if(! $user->getPending() ) 
                return false;                
        
        
        // we have an user
        // we know he didn't confirmed
        // we can create and send the mail   
        $email = new Rmail();             
        
        // assign User variable
        $this->smarty->assign("user", Array("id" => $user->getId(), "code" => $user->getConfirmationCode() ) ) ;        
        // fetch the template
        $emailContent = $this->smarty->fetch("email-user-confirmation.tpl");
        
        // set sender
        $email->setFrom("Influence Networks <contact@influencenetworks.org>");
        
        // set subject
        $email->setSubject( _("Influence Networks: please, confirm your account") );
        
        // set priority
        $email->setPriority("high");
        
        // add logo
        $mail->addEmbeddedImage(new fileEmbeddedImage(BASE_DIR."/appinc/images/logo.png"));
        
        // set the text content
        $email->setText( strip_tags($emailContent) );
        
        // set the html content
        $email->setHTML( $emailContent );         
        
        // send the email
        return $email->send( array( $user->getEmail() ) );
        
    }
            
}

?>
