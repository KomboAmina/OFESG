<?php

$configErrors=(isset($configErrors) && is_array($configErrors)) ? $configErrors: array();

$configFiles=array("base.php","database.php","actions.php");

foreach($configFiles as $configFile){

    $configFile="src".DS."config".DS.$configFile;

    if(file_exists($configFile)){

        include_once $configFile;

    }
    else{

        $configErrors[]="config file not found: ".$configFile;

    }

}
