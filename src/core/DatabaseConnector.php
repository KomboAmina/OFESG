<?php
namespace OFESG\Core;

use PDO;

/**
 * @author Amina Kombo <aminakombo>
 */

class DatabaseConnector{
    
    private $dbhost="localhost";
    
    private $dbname="";
    
    private $dbuser="root";
    
    private $dbpass;
    
    private $dbport=3306;
    
    private $CONNECTION;
    
    public $PDO;
    
    public $hasConnectionError=false;
    
    public $connectionMade=false;
    
    /*
    @param mixed[] setupArray-> array of database values
    */
    public function __construct($setupArray){
        
        $this->defineDatabaseAttributes($setupArray);
        
    }
    
    /*
    @param mixed[] setupArray -> array of datanase attributes
    */
    private function defineDatabaseAttributes($setupArray){
        
        foreach($setupArray as $key=>$val){
            
            $this->$key=$val;
            
        }
        
    }
    
    public function __destruct(){
        //destructor
    }
    
    /*
    established database connection, 
    returns error if something went wrong
    */
    public function openConnection(){
        
		$host_port=$this->getDBHost();
        
		$dbname=$this->getDBName();
        
		$db_port=$this->getDBPort();
        
        if(strlen($dbname)<1){

            $this->hasConnectionError=true;
            
            return "Database name required.";
        
        }
        else{
            
            try{
               
                $connPort=new PDO("mysql:host=$host_port;dbname=$dbname;charset=utf8",
                                  $this->getDBUser(),
                                  $this->getDBPass(),
                                  array(PDO::ATTR_PERSISTENT => true)
                );

                $this->setPDO($connPort);

                $this->CONNECTION=$connPort;
                
                $this->hasConnectionError=false;
                
                $this->connectionMade=true;
                
                return "Connection established to ".$dbname;
                
            }
            catch(PDOException $e){
                
                $this->hasConnectionError=true;
                
                $this->connectionMade=false;
                
                return $e->getMessage();

            }
            
        }
        
	}
    
    /*
    @param PDO pdo -> PHP Data Object for current instance
    */
	protected function setPDO($pdo){
        
        $this->PDO=$pdo;

        $this->PDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);
        
        //$this->PDO->exec("SET time_zone='+3:00';");

        $this->PDO->exec("SET time_zone='".TIMEZONE."';");
        
	}
    
    protected function unsetPDO(){
        
        $this->PDO=null;
        
    }
    
    /*
    @param string query -> SQL query string with PDO '?' escapes
    @param mixed[] vals -> array with values to be used in query
    @return statement -> PDO prepared statement
    */
    public function executeQuery($query,$vals){//vals=array
        
        $this->openConnection();
        
		$statement=$this->PDO->prepare($query);
        
		$statement->execute($vals);
        
        $this->unsetPDO();
        
		return $statement;
        
	}
    
    /*
    @param string dbhost -> name of database host
    */
    private function setDBHost($dbhost){
        
        $this->dbhost=$dbhost;
        
    }
    
    public function getDBHost(){
        
        return $this->dbhost;
        
    }
    
    /*
    @param string dbname -> name of database
    */
    private function setDBName($dbname){
        
        $this->dbname=$dbname;
        
    }
    
    public function getDBName(){
        
       return $this->dbname;
    
    }
    
    /*
    @param string dbuser -> database username
    */
    private function setDBUser($dbuser){
        
        $this->dbuser=$dbuser;
        
    }
    
    /**
     * @return object -> dbuser
     */
    public function getDBUser(){
        
        return $this->dbuser;
        
    }
    
    /*
    @param string dbpass -> database user's password
    */
    private function setDBPass($dbpass){
        
       $this->dbpass=$dbpass;
        
    }
    
    public function getDBPass(){
        
       return $this->dbpass;
        
    }
    
    /*
    @param string dbport -> database port
    */
    private function setDBPort($dbport=3306){
        
        $this->dbport=intval($dbport);
        
    }
    
    public function getDBPort(){
        
        return $this->dbport;
        
    }
    
}
