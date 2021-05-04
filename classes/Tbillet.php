<?php
class Tbillet
{
    //getters and setters
    static function setBillet($codeVoyage,$dateBilet,$email)
    {
        $db= new PDO("mysql:host=localhost;dbname=oncf;charset=utf8;","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $req= $db->prepare("INSERT INTO billet(codeVoyage,dateBillet,email) VALUES(?,?,?)");
        $req->execute(array($codeVoyage,$dateBilet,$email));

    }
    static function getBillets($email)
    {
        $db= new PDO("mysql:host=localhost;dbname=oncf;charset=utf8;","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $req= $db->prepare("SELECT * FROM billet WHERE email=?");
        $req->execute(array($email));
        $res=[];
        while ($data=$req->fetch()) 
        {
            $res[]=$data;
        }
        return $res;
    }
    static function checkCarte($detenteur,$anneeexp,$moisexp,$num_Carte,$crypto)
    {
        $db= new PDO("mysql:host=localhost;dbname=oncf;charset=utf8;","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $req= $db->prepare("SELECT * FROM cartebancaire WHERE detenteur=? AND anneeexp=? AND moisexp=? AND num_Carte=? AND crypto=?");
        $req->execute(array($detenteur,$anneeexp,$moisexp,$num_Carte,$crypto));
        $res=[];
        while ($data=$req->fetch()) 
        {
            $res[]=$data;
        }
        if ($res==NULL) {
            return false;
        }
        return true;
    }
}