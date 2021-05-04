<?php 
    ob_start();
    session_start();
    include_once("classes/Tvoyageur.php");
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
                    <a class="nav-link showAlert" href="#">Trajets</a>
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
                <div class="col-md-10 text-center mx-auto m-5 p-4 border shadow  rounded d-flex justify-content-between" style="position: relative;">
                    <div style="width: 100%;">
                        <form action="inscription.php" method="post">
                            <h2 class="p-2 text-left">Inscription:</h2>
                            <div class="row p-3">
                                <div class="col">
                                    <label for="prenom" class="float-left">Prenom:</label>
                                    <input type="text" class="form-control" placeholder="Enter prenom" name="prenom" required>
                                </div>
                                <div class="col">
                                    <label for="nom" class="float-left">Nom:</label>
                                    <input type="text" class="form-control" placeholder="Enter nom" name="nom" required>
                                </div>
                            </div>
                            <div class="row p-3" >
                                <div class="col">
                                    <label for="dateNaissance" class="float-left">Date de naisssance:</label>
                                    <input type="date" class="form-control" name="dateNaissance" required>
                                </div>
                                <div class="col">
                                    <label for="telephone" class="float-left">Telephone:</label >
                                    <input type="numbers" class="form-control" placeholder="Enter telephone" name="telephone" required>
                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col">
                                <label for="email" class="float-left">Addresse email::</label>
                                <input type="email" class="form-control" placeholder="Enter email" name="email" required>
                                </div>
                                <div class="col">
                                    <label for="pswd" class="float-left">Mot de passe:</label>
                                    <input type="password" class="form-control" placeholder="Enter password" name="pswd" required>
                                </div>
                                <div class="col">
                                    <label for="pwd" class="float-left">Confirmation du Mot de passe:</label>
                                    <input type="password" class="form-control" placeholder="Renter password" name="repswd" required>
                                </div>
                            </div>
                            <div class="custom-control custom-checkbox text-left pt-3">
                                <input class="custom-control-input" type="checkbox" id="customCheck">
                                <label class="custom-control-label" for="customCheck">Souvenir de moi</label>
                            </div>
                            
<?php 

if (isset($_POST["prenom"]) AND isset($_POST["pswd"])) 
{
    if ( $_POST["pswd"] == $_POST["repswd"] )
    {
        $passwordHash=password_hash($_POST["pswd"],PASSWORD_DEFAULT);
        $voyageur=new Tvoyageur($_POST["email"],$passwordHash,$_POST["nom"],$_POST["prenom"],$_POST["dateNaissance"],$_POST["telephone"]);
        $voyageur->sendToDatabase();
        
        $_SESSION["prenom"]=$voyageur->getPrenom();
        $_SESSION["nom"]=$voyageur->getNom();
        $_SESSION["email"]=$voyageur->getEmail();
        $_SESSION["pswd"]=$passwordHash;
        header("Location:index.php");
        
    }
    else {
        echo " <p class='text-left text-danger'> Les mots de passe ne correspondent pas";
    }
}
ob_end_flush();
?></p>
                            <br>
                            <button type="submit" class="btn btn-outline-info" style="width: 100%;">S'inscrire</button>
                        </form>
                        <br>
        
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

    
</BODY>
</HTML>
