<?php
/**
 * Record Class
 * 
 * This abstract class implements ArrayAccess class to create object
 * following the database schema.
 * 
 * @author Pirhoo <pierre@owni.fr>
 * @version 1.0
 * @package Record
 */
abstract class Record implements ArrayAccess {
    
    /**
    * @var array
    * @access protected
    */
    protected $erreurs = array(); 
    
    /**
    * @var integer
    * @access protected 
    */
    protected $id;
    
    
    /**
     * Default constructor which receives an associative array of every field. 
     * 
     * @access public
     * @param array $donnees 
     */
    public function __construct(array $donnees = array()) {
        // if array is not empty
        if (!empty($donnees)) {
            // convert associative array to new private attribute (and there respective getters/setters)
            $this->hydrate($donnees);
        }
    }

    /**
     * Checks if the object has an id 
     * @return boolean
     * @access public
     */
    public function isNew() {
        return empty($this->id);
    }

    /**
     * $erreur attrbiute getter
     * @return array
     * @access public
     */
    public function getErreurs() {
        return $this->erreurs;
    }

    /**
     * $id attrbiute getter
     * @return array
     * @access public
     */
    public function getId() {
        return $this->id;
    }
    

    /**
     * $id attrbiute setter
     * @param  integer $id
     * @access public
     */
    public function setId($id) {
        // cast value
        $this->id = (int) $id;
    }

    
    /**
     * Converts an associative array to new private attribute (and there respective getters/setters)
     * @param array $data
     * @access public
     */
    public function hydrate(array $data) {
        
        // for each value in parameter
        foreach ($data as $attribut => $value) {
            
            // Attribut isn't an index
            if( ! is_int($attribut) ) {
                  
                  // Converts associative name to normalized nomenclature and calls the right setter method:
                  
                  /* Apply the following steps to determinate the method name:
                   *    1- convert all underscores to spaces (ex: "relation_id" begins "relation id")
                   *    2- transform all word first letter to uppercase (ex: "relation id" begins "Relation Id"
                   *    3- remove all spaces (ex "Relation Id" begins "RelationId")
                   *    4- add a "set" prefix (ex "RelationId" begins "setRelationId")
                   */                  
                  $method = 'set'.str_replace(' ', '', ucwords(str_replace('_', ' ', $attribut)));

                  // If the method is callable...
                  if (is_callable(array($this, $method)))
                      // ...we call it (to set value) !
                      $this->$method($value);
            }
        }
    }
 
 
    /**
     * Checks if we can call the named method and call it
     * @param  string $var
     * @access public
     */   
    public function offsetGet($var) {
        
        if (isset($this->$var) && is_callable(array($this, $var)))
            return $this->$var();
        
    }

    /**
     * Checks if we can set the named value and sets it
     * @param string $var
     * @param mixed $value
     * @access public
     */  
    public function offsetSet($var, $value) {
        
        $method = 'set' . ucfirst($var);

        if( isset($this->$var) &&  is_callable(array($this, $method)) )
                $this->$method($value);
        
    }


    /**
     * Checks if we can call the named method
     * @param string $var
     * @access public
     */  
    public function offsetExists($var) {
        
        return isset($this->$var) && is_callable(array($this, $var));
        
    }
    
    /**
     * Implements an abstract method from ArrayAccess 
     * (and trow an exception, we can't unset a value)
     * @param string $var 
     */
    public function offsetUnset($var) {
        
        throw new Exception( _('Remove value failled.') );
        
    }
    
    
    
    /**
     * Dirty method to show the class content
     * @access public
     */  
    public function quickDisplay() {
        
        print_r($this);
        
    }

}

?>
