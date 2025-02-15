<?php

defined('DS') || define('DS',DIRECTORY_SEPARATOR);

$configErrors=array();

$configFiles=array(
                    "src".DS."config".DS."include.php",
                    "vendor".DS."autoload.php"
                );

foreach($configFiles as $configFile){

    if(file_exists($configFile)){

        include_once $configFile;

    }
    else{

        $configErrors[]="config file not found: ".$configFile;

    }

}

if(!empty($configErrors)){

    echo "<h1>Error(s):</h1>";

    echo "<ol>";

    foreach($configErrors as $configError){

        echo "<li>".$configError."</li>";

    }

    echo "</ol>";

}

else{

    $app=new \OFESG\Core\OFESG();

    $app->view->load();

}
