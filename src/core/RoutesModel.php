<?php
namespace OFESG\Core;

class RoutesModel extends BaseModel{

    public string $area;

    private array $validRoutes;

    public function __construct(string $area){

        parent::__construct();

        $this->area=$area;

        $this->validRoutes=$this->getValidRoutes();

    }

    private function getValidRoutes():array{

        $valids=array();

        switch($this->area){

            case "back":

                $sessionsManager=new \OFESG\Core\SessionsManager();

                $valids=array("login");

            break;

            default:

                //front

                $valids=array("home","guides","downloads");

            break;

        }

        return $valids;

    }

    public function getDefaultRoute():string{

        if(!empty($this->validRoutes)){

            return strval($this->validRoutes[0]);

        }

        else{

            return "home";

        }

    }

    public function isValidRoute(string $check):bool{

        return in_array($check,$this->validRoutes);

    }


}
