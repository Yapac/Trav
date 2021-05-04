<?php 
    session_start();

    include_once('classes/Tvoyage.php');
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
      echo"
      <div class='alert alert-warning alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <strong>Avertissement!</strong> Pour réserver, vous devez être connecté.   <a href='index.php' class='alert-link'>connectez vous maintenant!</a>.
      </div>  
      ";
    }

  ?>


 <div class="container">
        <div class="row"> 
          <section  class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
            <form action="trajets.php" method="POST" style="padding-top:15%;font-size: 60px;text-align: center">
              <h2><strong>Liste des Trajets</strong></h2>
                Choisir une Ville de départ: 
                <select class="form-control" name="vdp">
                  <?php 
                  foreach (Tvoyage::getVillesD() as $data) {
                    echo "<option value=". $data["villeD"] .">". $data["villeD"] ."</option>";
                  }
                  ?>
                </select>
                Choisir une Ville d'arrivée: 
                <select class="form-control" name="vda">
                  <?php 
                  foreach (Tvoyage::getVillesA() as $data) {
                    echo "<option value=". $data["villeA"] .">". $data["villeA"] ."</option>";
                  }
                  ?>
                </select>  
              <input type="submit" class="btn btn-info mt-3"  name="action"   value="Afficher"/>
            </div>
          </section>
        </div>
  </div>

  <div class="container mt-4">
            <div class="row">         
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
  if (isset($_POST["vdp"]) AND isset($_POST["vda"])) 
  {
    foreach (Tvoyage::getVoyages($_POST["vdp"],$_POST["vda"]) as $data) {
      echo"
      <tr>
        <th>".$data["codeVoyage"]."</th>
        <th>".$data["heureD"]."</th>
        <th>".$data["heureA"]."</th>
        <th>".$data["prixVoyage"]." DH</th>
        <th class='text-center reserv '><a href='reservation.php?codeVoyage=".$data["codeVoyage"]."' style='text-decoration:none;'>Reservation</a></th>
      </tr>
      ";
    }
  }
?>              
 
                  </tbody>
                </table>
            </div>
        </div>





   <!--    Footer      !-->

   <footer>
        <div class="container-fluid mt-5 mx-auto text-center" style="background-color: #444">
        <img src="images/LogoHor.png" class="mt-2" style="width:150px" alt="">
        <div class="text-white p-2">Copyright © Tous droits reservés.</div>
        </div>
    </footer>


</BODY>
</HTML>
