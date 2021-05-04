<?php 
    session_start();

if (isset($_SESSION["email"])) {
    include_once("classes/Tbillet.php");
    Tbillet::setBillet($_GET["codeVoyage"],date("Y/m/d h:i:s", time()),$_SESSION["email"]);
    header("Location:acc.php");
}
else {
    echo date("Y/m/d h:i:s", time());
}
?>