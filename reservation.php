<?php 
ob_start();
    session_start();
    
    include_once('classes/Tvoyage.php');
    include_once('classes/Tbillet.php');
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
   .reserv{
  transform: scale(1);
  transition-property: transform;
  transition-duration: 400ms;

  }
  .reserv:hover {
    text-decoration: none;
    text-decoration-line: none;

    transform: scale(1.15);
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
                <a class="nav-link" href="acc.php">Accueil</a>
              </li>
              <li class="nav-item active " style="padding-right: 800px;">
                <a class="nav-link" href="trajets.php">Trajets</a>
              </li>

              <li class="nav-item" >
                <a class="nav-link <?php if(!isset($_SESSION["email"])){echo "disabled";} ?>" href="logout.php">Log out</a>
              </li>
            </ul>
          </div>
          
        </nav>
      </header>
  </div> 
  <?php 
    if (isset($_SESSION["email"]) AND isset($_SESSION["pswd"])) {
      echo"
      <div class='alert alert-success alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <strong>".$_SESSION["prenom"].' '.$_SESSION["nom"]. " !</strong> Vous êtes connecté en utilisant ".$_SESSION["email"].".
      </div>  
      ";
    }
    else {
      header("Location:index.php");
    }

  ?>


    <div class="container mt-4">
        <div class="row">    
            <h2 class="p-2">Les détails du voyage :</h2>     
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Code voyage</th>
                      <th>Départ</th>
                      <th>Arrivée</th>
                      <th>Prix</th>    
                    </tr>
                  </thead>
                <tbody>
<?php
  if (isset($_GET["codeVoyage"])) 
  {
    $_SESSION["codeVoyage"]=$_GET["codeVoyage"];
    foreach (Tvoyage::getVoyage($_GET["codeVoyage"]) as $data) {
      echo"
      <tr>
        <th>".$_GET["codeVoyage"]."</th>
        <th>".$data["heureD"]."</th>
        <th>".$data["heureA"]."</th>
        <th>".$data["prixVoyage"]." DH</th>
        
      </tr>
      ";
    }
  }
?>              
 
                  </tbody>
                </table>
        </div>
    </div>
    <form class="jumbotron jumbotron-fluid mt-4" method="POST" action="reservation.php">
        <div class="container">    
            <h2 class="p-2" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Acheter le billet:</h2>     
            <p style="font-size:1.5em;color:#777">L'achat de ce billet vous permet de l'imprimer et du pas perder du temps dans le jour de ton voyage! <br>
                <span class="text-info">info: le prix de site et le meme en notre agences!</span>
            </p>
            <div class="row p-3">
                <div class="col">
                    <label for="prenom" class="float-left">Detenteur de la carte:</label>
                    <input type="text" class="form-control" placeholder="Enter Detenteur de la carte" name="detenteur" required>
                </div>
                <div class="col">
                    <label for="nom" class="float-left">Annee d'expiration:</label>
                    <input type="text" class="form-control" placeholder="Enter Annee d'expiration" name="anneeexp" required>
                </div>
                <div class="col">
                    <label for="nom" class="float-left">Mois d'expiration:</label>
                    <input type="text" class="form-control" placeholder="Enter Mois d'expiration" name="moisexp" required>
                </div>
            </div>
            <div class="row p-3">
                <div class="col">
                    <label for="prenom" class="float-left">Numero de la carte:</label>
                    <input type="text" class="form-control" placeholder="Enter Numero de la carte" name="num_Carte" required>
                </div>
                <div class="col">
                    <label for="nom" class="float-left">Cryptogramme:</label>
                    <input type="text" class="form-control" placeholder="Enter Cryptogramme" name="crypto" required>
                </div>
               
                
                
            </div>
            <div class="row d-flex justify-content-between text-center m-2">
                <input type="submit" value="Acheter" class="btn btn-success w-50 m-2">
                <a href="trajets.php" class="btn btn-danger w-25 m-2">Anuler</a>            
            </div>

        </div>
    </form>
  <?php
  
  if (isset($_POST["num_Carte"])) {
    echo $_SESSION["codeVoyage"];
      if(Tbillet::checkCarte($_POST["detenteur"],$_POST["anneeexp"],$_POST["moisexp"],$_POST["num_Carte"],$_POST["crypto"]))
      {
        header("Location:achat.php?codeVoyage=".$_SESSION['codeVoyage']."");
      }
  }
  ob_end_flush();
  ?>
   <!--    Footer      !-->

   <footer>
        <div class="container-fluid mt-5 mx-auto text-center" style="background-color: #444">
        <img src="images/LogoHor.png" class="mt-2" style="width:150px" alt="">
        <div class="text-white p-2">Copyright © Tous droits reservés.</div>
        </div>
    </footer>


</BODY>
</HTML>
