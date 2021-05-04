<?php 
session_start();
session_destroy();

setcookie("prenom","", time() + 365*24*3600, null, null, false, true);
setcookie("nom","", time() + 365*24*3600, null, null, false, true);
setcookie("email","", time() + 365*24*3600, null, null, false, true);
setcookie("pswd","", time() + 365*24*3600, null, null, false, true);

header("Location:index.php");
