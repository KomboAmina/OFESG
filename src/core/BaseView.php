<?php
namespace OFESG\Core;

class BaseView{

    private object $controller;

    private string $area;

    private string $route;

    private object $sessionsManager;

    private object $routesModel;

    private string $title;

    public function __construct(object $controller, string $area, string $route){

        $this->controller=$controller;

        $this->area=$area;

        $this->route=$route;

        $this->sessionsManager=new \OFESG\Core\SessionsManager();

        $this->routesModel=new \OFESG\Core\RoutesModel(
                                            $this->area,
                                            $this->sessionsManager->isLoggedIn(
                                                $this->controller->model->getIP()
                                                )
                                        );

        $this->title=$this->setTitle();

    }

    private function setTitle():string{

        $title=ucwords($this->route);

        switch($this->route){

            case "projects":

                if(isset($_GET['levelb'])){

                    $ptitle=$this->controller->model->getInfo("posts","slug",
                                                                $_GET['levelb'],"title");

                    if(!empty($ptitle)){

                        $title=$ptitle." &rarr; ".$title;

                    }

                }

                break;

            case "blog":

                if(isset($_GET['levelb']) && $this->controller->model->blogPostExists($_GET['levelb'])){

                    $title=$this->controller->model->getBlogPostFromSlug($_GET['levelb'])->title." &rarr; ".$title;

                }

                else{

                    if(isset($_GET['tag']) && $this->controller->model->tagSlugExists($_GET['tag'])){

                        $title=$this->controller->model->getTagFromSlug($_GET['tag'])->title." &rarr; ".$title;

                    }

                }

                break;

        }

        return $title;

    }

    public function load():void{

        include_once "src".DS."common".DS."partial".DS."header.php";

        $baseFile="src".DS.$this->area.DS.$this->route.DS."base.php";

        if(file_exists($baseFile)){

            include_once $baseFile;

        }
        
        else{

            $this->show404();

        }

        include_once "src".DS."common".DS."partial".DS."footer.php";

    }

    private function show404():void{

        include_once "src".DS."common".DS."errors".DS."404.php";

    }

    private function recover($label,$else=""):void{

        $this->controller->model->recover($label,$else);

    }

    private function error($label):void{

        $this->controller->model->error($label);

    }

}
