<?php
namespace OFESG\Core;

class OFESGModel extends ConnectedModel{

    public function getAllGuides():array{

        $guides=array();

        $st=$this->dbcon->executeQuery("SELECT * FROM `items`
         WHERE itemtype=? ORDER BY createdon DESC",
         array("guide"));

        while($ro=$st->fetchObject()){

            $guides[]=$ro;

        }

        return $guides;

    }

    public function getPublishedGuides():array{

        $guides=array();

        $st=$this->dbcon->executeQuery("SELECT * FROM `items`
         WHERE itemtype=? AND status=? ORDER BY createdon DESC",
         array("guide","published"));

        while($ro=$st->fetchObject()){

            $guides[]=$ro;

        }

        return $guides;

    }

    public function guideCodeExists(string $check):bool{

        $st=$this->dbcon->executeQuery("SELECT COUNT(id) FROM `items` WHERE itemtype=?
         AND slug=?",array("guide",$check));

        $cn=$st->fetchColumn();

        return intval($cn)>0;

    }

    public function generateGuideCode(int $seed=0):string{

        $seedsuffix=($seed==0) ? "":".".$seed;

        $code=date("ymd").$seedsuffix;

        if($this->guideCodeExists($code)){

            $code=$this->generateGuideCode(intval($seed+1));

        }

        return $code;

    }

}
