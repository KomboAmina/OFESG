<?php
namespace OFESG\Core;

class BaseController{

    /**
     * @var \OFESG\Core\BaseModel $model
     */
    public $model;

    /**
     * @param \OFESG\Core\BaseModel   Model for this controller
     */
    public function __construct($model){

        $this->model=$model;

    }

    public function reloadPage():void{

        $this->relocate($this->getCurrentURL());

    }

    /**
     * @param string $url   URL string to replace into address bar.
     */
    public function relocate($url):void{

        if(filter_var($url,FILTER_VALIDATE_URL)){

            header("Location: ".$url);

        }

    }

    /**
     * @return string
     */
    public function getCurrentURL():string{

        return (empty($_SERVER['HTTPS']) ? 'http' : 'https')."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    }

    public function checkBlanks($vals=array()):void{

        foreach($vals as $val){

            if(isset($_POST[$val])){

                if($this->model->isBlank($_POST[$val]) || $this->model->isNull($_POST[$val])){

                    $_SESSION[ERRORS][$val]="required.";

                }

            }

        }

    }

    public function recover($vals=array()){

        foreach($vals as $val){

            if(isset($_POST[$val])){

                $_SESSION[SAVED][$val]=$_POST[$val];

            }

        }

    }

}
