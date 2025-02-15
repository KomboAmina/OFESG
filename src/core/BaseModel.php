<?php
namespace OFESG\Core;

class BaseModel{

    public string $now;

    public function __construct(){

        $this->now=date("Y-m-d H:i:s");

    }

    public function getIP():string{

        return $this->getIPAddress();

    }

    public function getIPAddress():string{

        return (defined('USEREALIP') && USEREALIP) ? $_SERVER['REMOTE_ADDR']:"192.168.100.3";

    }

}
