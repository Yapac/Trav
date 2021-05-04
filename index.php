<?php 
ob_start();


    session_start();
    if (isset($_SESSION["email"]) AND isset($_SESSION["pswd"])) {
        header("Location:acc.php");
    }
    elseif ( isset($_COOKIE["email"]) AND isset($_COOKIE["pswd"] )) {
        echo"dfsfgrgsrdhththst". $_COOKIE["email"];
        $_SESSION["prenom"]=$_COOKIE['prenom'];
        $_SESSION["nom"]=$_COOKIE['nom'];
        $_SESSION["email"]=$_COOKIE['email'];
        $_SESSION["pswd"]=$_COOKIE['pswd'];
        header("Location:acc.php");
    }
    else {

        include_once("classes/Tvoyageur.php");
    }

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
    <TITLE> Trav </TITLE>
    <meta charset="utf-8"> 
    <link rel="stylesheet" href="./css/styles.css" />    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
            integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        #register{
            color: #575A89;
            transition: all 0.3s ease;
            font-weight: bold;
        }
        #register:hover{
            text-decoration: none;
            color: #17a2b8;
        }
    </style>
</HEAD>
<BODY>
  <!--  HEADER   !-->
    <div class="container-fluid sticky-top p-0">
        <header>
            <nav class="navbar navbar-dark navbar-expand-sm bg-dark pl-5">
                <a class="text-white" style="text-decoration:none;width:175px" href="index.php">
                    <img src="images/LogoHor.png" style="width:100%" alt="">
                </a>
                <button class="navbar-toggler" data-toggle="collapse" data-target="#menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="menu">
                    <ul class="navbar-nav ml-5">
                    <li class="nav-item ">
                        <a class="nav-link showAlert" href="#">Accueil</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="trajets.php">Trajets</a>
                    </li>
                    </ul>
                </div>

            </nav>
        </header>
    </div> 
    <div class="alert alert-warning alert-dismissible fade d-none">
        <button type="button" class="close" >&times;</button>
        <strong>Avertissement!</strong> Vous devez vous connecter pour voir cette page
    </div>
    <!--    Form        !-->
    <section class="container">
            <row class="row mt-5">
                <div class="col-md-10 text-center mx-auto m-5 p-4 border shadow  rounded d-lg-flex flex-lg-row  justify-content-between" style="position: relative;">
                    <a href="inscription.php" class="btn btn-info text-white rounded-circle" data-toggle="tooltip" data-placement="top" title="Inscrivez-vous ici!" style="position: absolute;top:15px;right:15px">+</a>
                    <img src="images/logoMain.png" class="text-left p-2" style="width: 40%;" alt="SignIn">
                    <div style="width: 100%;">
                        <form action="index.php" method="POST">
                            <h2 class="p-2 text-left">S'identifier:</h2>
                            <div class="form-group">
                                <label for="email" class="float-left">Addresse email::</label>
                                <input type="email" class="form-control" placeholder="Enter email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="pwd" class="float-left">Mot de passe:</label>
                                <input type="password" class="form-control" placeholder="Enter password" name="pswd">
                            </div>

                            <div class="custom-control custom-checkbox text-left">
                                <input class="custom-control-input" type="checkbox" name="remember" id="remember">
                                <label class="custom-control-label" for="remember">Souvenir de moi</label>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-outline-info" style="width: 100%; ">connexion</button>
                        </form>                     
<?php
if (isset($_POST["email"]) AND isset($_POST["pswd"]))
{
    $voyageur = Tvoyageur::getEmailInfo($_POST["email"]);
    if (password_verify($_POST['pswd'], $voyageur['password'])) {
        if (isset($_POST["remember"])AND $_POST['remember']==true) {
            setcookie("prenom",$voyageur['prenom'], time() + 365*24*3600, null, null, false, true);
            setcookie("nom",$voyageur['nom'], time() + 365*24*3600, null, null, false, true);
            setcookie("email",$voyageur['email'], time() + 365*24*3600, null, null, false, true);
            setcookie("pswd",$voyageur['password'], time() + 365*24*3600, null, null, false, true);
        }
        $_SESSION["prenom"]=$voyageur['prenom'];
        $_SESSION["nom"]=$voyageur['nom'];
        $_SESSION["email"]=$voyageur['email'];
        $_SESSION["pswd"]=$voyageur['password'];
        header("Location:index.php");
        
    }
    else {
        echo "<p class='text-left text-danger'>Mauvais mot de passe. Veuillez réessayer</p>" ; 
    }
}
ob_end_flush();
?>
                        <br>
                        <p class="float-left" style="font-weight: 600;">tu n'as pas un compte? <a href="inscription.php" id="register">Inscrivez-vous ici</a></p>         
                    </div>

                </div>
            </row>
        </section>

    <!--    Footer      !-->
    <footer>
        <div class="container-fluid mt-5 mx-auto text-center" style="background-color: #444">
        <img src="images/LogoHor.png" class="mt-2" style="width:150px" alt="">
        <div class="text-white p-2">Copyright © Tous droits reservés.</div>
        </div>
    </footer>


    <script>
        $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
        });
        $(function () {

        $('.showAlert').on('click', function () {
            $('.alert').removeClass('d-none').addClass('show');
        });
        $('.close').on('click', function () {
            $('.alert').removeClass('show').addClass('d-none');
        });
        // 
        });
    </script>
</BODY>
</HTML>
