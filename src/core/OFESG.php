<?php
namespace OFESG\Core;

class OFESG{

    private string $area;

    private object $routesModel;

    private string $route;

    private object $model;

    private object $controller;

    public object $view;

    public function __construct(){

        $this->area=$this->getArea();

        $this->routesModel=new \OFESG\Core\RoutesModel($this->area);

        $this->route=$this->getRoute();

        $this->model=$this->getModel();

        $this->controller=$this->getController();

        $this->view=new \OFESG\Core\BaseView($this->controller, $this->area, $this->route);

    }

    private function getArea():string{

        $area="front";

        if(isset($_GET['levela']) && $_GET['levela']==BACKDIR){

            $area="back";

        }

        return strval($area);

    }

    private function getRoute():string{

        $route="";

        $checkLevel=($this->area=="front") ? 'levela':'levelb';

        if(!isset($_GET[$checkLevel])){

            $relocURL=URL;

            if($this->area=="front"){

                $relocURL.=$this->routesModel->getDefaultRoute()."/";

            }

            if($this->area=="back"){

                $relocURL.=$_GET['levela']."/".$this->routesModel->getDefaultRoute()."/";

            }

            header("Location: ".$relocURL);

        }

        else{

            $route=($this->routesModel->isValidRoute($_GET[$checkLevel])) ?
             $_GET[$checkLevel]:$this->routesModel->getDefaultRoute();

        }

        return strval($route);

    }

    private function getModel():object{

        $desiredClass="\\OFESG\\".ucwords($this->area)."\\".ucwords($this->route)."\\".ucwords($this->route)."Model";

        $defaultClass="\\OFESG\\".ucwords($this->area)."\\".ucwords($this->area)."Model";

        return (class_exists($desiredClass)) ? new $desiredClass: new $defaultClass;

    }

    private function getController():object{

        $desiredClass="\\OFESG\\".ucwords($this->area)."\\".ucwords($this->route)."\\".ucwords($this->route)."Controller";

        $defaultClass="\\OFESG\\Core\\OFESGController";

        return (class_exists($desiredClass)) ?
         new $desiredClass($this->model): new $defaultClass($this->model);

    }

}
