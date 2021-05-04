<?php
class Tvoyage
{

    //getters and setters
    static function getVillesD()
    {
        $db= new PDO("mysql:host=localhost;dbname=oncf;charset=utf8;","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

        $req=$db->query("SELECT DISTINCT villeD FROM voyage ORDER BY villeD");
        $res=[];
        while ($data=$req->fetch()) {
            $res[]=$data;
        }
        return $res;
    }
    static function getVillesA()
    {
        $db= new PDO("mysql:host=localhost;dbname=oncf;charset=utf8;","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

        $req=$db->query("SELECT DISTINCT villeA FROM voyage ORDER BY villeA");
        $res=[];
        while ($data=$req->fetch()) {
            $res[]=$data;
        }
        return $res;
    }
    static function getVoyages($villeD,$villeA)
    {
        $db= new PDO("mysql:host=localhost;dbname=oncf;charset=utf8;","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

        $req = $db->prepare("SELECT codeVoyage,heureD,heureA,prixVoyage FROM voyage WHERE villeD=? AND villeA=? ORDER BY heureD");
        $req->execute(array($villeD,$villeA));
        $res=[];
        while ($data=$req->fetch()) {
            $res[]=$data;
        }
        return $res;
    }
    static function getAllVoyagesLim($nPage)
    {
        $db= new PDO("mysql:host=localhost;dbname=oncf;charset=utf8;","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $i1=5*($nPage-1);
        $req = $db->query("SELECT * FROM voyage Limit $i1,5");
        $res=[];
        while ($data=$req->fetch()) {
            $res[]=$data;
        }
        return $res;
    }
    static function setVoyage($codeVoyage,$heureD,$villeD,$heureA,$villeA,$prixVoyage)   {
        $db= new PDO("mysql:host=localhost;dbname=oncf;charset=utf8;","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $req = $db->prepare("UPDATE voyage SET codeVoyage = ?, heureD = ?, villeD = ?, heureA = ?, villeA = ?, prixVoyage = ?  WHERE codeVoyage = ?");
        $req->execute(array($codeVoyage,$heureD,$villeD,$heureA,$villeA,$prixVoyage,$codeVoyage));
    }
    static function addVoyage($codeVoyage,$heureD,$villeD,$heureA,$villeA,$prixVoyage){
        $db= new PDO("mysql:host=localhost;dbname=oncf;charset=utf8;","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $req = $db->prepare("INSERT INTO voyage VALUES (?,?,?,?,?,?)");
        $req->execute(array($codeVoyage,$heureD,$villeD,$heureA,$villeA,$prixVoyage));
    }
    static function getVoyage($codeVoyage)
    {
        $db= new PDO("mysql:host=localhost;dbname=oncf;charset=utf8;","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

        $req = $db->prepare("SELECT * FROM voyage WHERE codeVoyage=? ");
        $req->execute(array($codeVoyage));
        $res=[];
        while ($data=$req->fetch()) {
            $res[]=$data;
        }
        return $res;
    }
    static function getNumVoyages()
    {
        $db= new PDO("mysql:host=localhost;dbname=oncf;charset=utf8;","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

        $req = $db->query("SELECT COUNT(*) as num FROM voyage;");
        while ($data=$req->fetch()) {
            $res=$data["num"];
        }
        return $res;

    }
    static function checkCode($codeVoyage)
    {
        $db= new PDO("mysql:host=localhost;dbname=oncf;charset=utf8;","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $req= $db->prepare("SELECT * FROM voyage WHERE codeVoyage=? ");
        $req->execute(array($codeVoyage));
        $res=[];
        while ($data=$req->fetch()) 
        {
            $res[]=$data;
        }
        if ($res==NULL) {
            return true;
        }
        return false;
    }
}