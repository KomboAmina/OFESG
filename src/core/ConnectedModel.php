<?php
namespace OFESG\Core;
/**
 * @author Amina Kombo <aminakombo.work>
 */

 class ConnectedModel extends BaseModel{

    public $dbcon;

    public function __construct(){

        parent::__construct();

        $this->defineDatabaseConnectionObject();

    }

    /*
    @return boolean hasConnectionError-> outcome of action
    */
    public function defineDatabaseConnectionObject(){
       
        $constantsArray=array('DBHOST','DBNAME','DBUSER','DBPASS','DBPORT');
        
        $notSet=0;
        
        foreach($constantsArray as $item){
            
            if(!defined(($item))){
                
                $notSet++;
                
            }
            
        }
        
        if($notSet==0){
            
            $setupArray=array("dbhost"=>DBHOST,
                              "dbname"=>DBNAME,
                              "dbuser"=>DBUSER,
                              "dbpass"=>DBPASS,
                              "dbport"=>DBPORT);
            
            $this->dbcon=new \OFESG\Core\DatabaseConnector($setupArray);
            
        }
        
        $this->dbcon->openConnection();
        
        return $this->dbcon->hasConnectionError;
        
    }
    
    /**
     * @return mixed $ans -> outcome of query
     */
    public function getInfo($table,$column,$value,$return){
        
        $st=$this->dbcon->executeQuery("SELECT `$return` FROM `$table` WHERE `$column`=?",array($value));
        
        return $st->fetchColumn();
        
    }

}
