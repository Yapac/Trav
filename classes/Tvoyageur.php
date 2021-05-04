<?php
class Tvoyageur
{
    //declaration
    private $_email,$_password,$_nom,$_prenom,$_dataNaissance,$_Telephone;
    public function __construct($_email,$password,$nom,$prenom,$dataNaissance,$Telephone) {
        $this->_email = $_email;
        $this->_password = $password;
        $this->_nom = $nom;
        $this->_prenom = $prenom;
        $this->_dataNaissance = $dataNaissance;
        $this->_Telephone = $Telephone;
    }

    //getters and setters
    function getPrenom()
    {
        return $this->_prenom;
    }
    function getNom()
    {
        return $this->_nom;
    }
    function getEmail()
    {
        return $this->_email;
    }
    static function getEmailInfo($email)
    {
        $db= new PDO("mysql:host=localhost;dbname=oncf;charset=utf8;","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        
        $req=$db->prepare("SELECT * FROM voyageur WHERE email=?");
        $req->execute(array($email));
        return $req->fetch();
    }
    //functions
    public function sendToDatabase()
    {
        $db= new PDO("mysql:host=localhost;dbname=oncf;charset=utf8;","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

        $req=$db->prepare("INSERT INTO voyageur VALUES(?,?,?,?,?,?)");
        $req->execute(array($this->_email,$this->_password,$this->_nom,$this->_prenom,$this->_dataNaissance,$this->_Telephone));
    }
}