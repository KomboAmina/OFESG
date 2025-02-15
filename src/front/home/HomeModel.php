<?php
namespace OFESG\Front\Home;

class HomeModel extends \OFESG\Front\FrontModel{

    public function getLatestNews():array{

        $items=array();

        $st=$this->dbcon->executeQuery("SELECT * FROM `items`
         WHERE itemtype=? AND status=?
          ORDER BY createdon DESC LIMIT 3",
        array("news","published"));

        while($ro=$st->fetchObject()){

            $items[]=$ro;

        }

        return $items;

    }

}
