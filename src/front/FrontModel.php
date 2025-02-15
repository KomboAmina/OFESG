<?php
namespace OFESG\Front;

class FrontModel extends \OFESG\Core\OFESGModel{

    public function getLatestGuide():mixed{

        $guide=null;

        $st=$this->dbcon->executeQuery("SELECT * FROM `items`
         WHERE itemtype=? AND status=?
          ORDER BY createdon DESC LIMIT 1",
        array("guide","published"));

        while($ro=$st->fetchObject()){

            $guide=$ro;

        }

        return $guide;

    }

}
