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
                <a class="nav-link" href="acc.php"></a>
              </li>
              <li class="nav-item active " style="padding-right: 800px;">
                <a class="nav-link" href="trajets.php"></a>
              </li>

              <li class="nav-item" >
                <a class="nav-link <?php if(!isset($_SESSION["email"])){echo "disabled";} ?>" href="logout.php">Log out</a>
              </li>
            </ul>
          </div>
          
        </nav>
      </header>
  </div> 

  <section class="jumbotron">
  <h1>Admin</h1>
  <br>
  <h4>Ajouter un nouveux voyage:</h4>
  <form action="admin.php" method="POST">
    <div class="form-row">
      <div class="col">
        <label for="">Code Voyage</label>
        <input type="text" class="form-control" placeholder="Code Voyage" name="_codeVoyage" required>
      </div>
      <div class="col">
        <label for="">Heure depart</label>
        <input type="time" class="form-control" placeholder="Heure depart" name="_heureD" required>
      </div>
      <div class="col">
      <label for="">Ville depart</label>
        <input type="text" class="form-control" placeholder="Ville depart" name="_villeD" required>
      </div>
      <div class="col">
      <label for="">Heure d'arriver</label>
        <input type="time" class="form-control" placeholder="Heure d'arriver" name="_heureA" required>
      </div>
      <div class="col">
      <label for="">Ville d'arriver</label>
        <input type="text" class="form-control" placeholder="Ville d'arriver" name="_villeA" required>
      </div>
      <div class="col">
      <label for="">Prix voyage</label>
        <input type="number" class="form-control" placeholder="Prix voyage" name="_prixVoyage" required>
      </div>
      <input type="submit" class="btn btn-primary" value="Submit">
    </div>

  </form>
  <?php
      if (isset($_POST["_codeVoyage"])) {
      if (Tvoyage::checkCode($_POST["_codeVoyage"])) {
        Tvoyage::addVoyage($_POST["_codeVoyage"],$_POST["_heureD"],$_POST["_villeD"],$_POST["_heureA"],$_POST["_villeA"],$_POST["_prixVoyage"]);
        header("Location:admin.php");
        echo"<p class='text-success'>Success</p>";  
      }
      else {
        echo"<p class='text-danger'>Code Voyage already used</p>";
      }
        
      }
    ?>
  <br>
  <h4>Liste des voyages:</h4>
    <table class="table table-secondary table-bordered">
    <thead>
      <tr>
        <th>Code Voyage</th>
        <th>Heure depart</th>
        <th>Ville depart</th>
        <th>Heure d'arriver</th>
        <th>Ville d'arriver</th>
        <th>Prix voyage</th>
      </tr>
    </thead>

    <tbody>
    <?php
    if (isset($_GET["page"])) {
      foreach (Tvoyage::getAllVoyagesLim($_GET["page"]) as $data ) {
        echo "
        <form action='admin.php' method='POST'>
          <tr>
            <td><input type='text' class='form-control' style='background-color:rgba(0, 0, 0, 0)' name='codeVoyage' readonly='readonly' value=".$data["codeVoyage"]."></td>
            <td><input type='text' class='form-control' style='background-color:rgba(0, 0, 0, 0)' name='heureD' value=".$data["heureD"]."></td>
            <td><input type='text' class='form-control' style='background-color:rgba(0, 0, 0, 0)' name='villeD' value=".$data["villeD"]."></td>
            <td><input type='text' class='form-control' style='background-color:rgba(0, 0, 0, 0)' name='heureA' value=".$data["heureA"]."></td>
            <td><input type='text' class='form-control' style='background-color:rgba(0, 0, 0, 0)' name='villeA' value=".$data["villeA"]."></td>
            <td><input type='text' class='form-control' style='background-color:rgba(0, 0, 0, 0)' name='prixVoyage' value=".$data["prixVoyage"]."></td>
            <td><input type='submit' class='form-control btn btn-outline-info' name='submit' value='Change'></td>
          </tr>
        </form>
          ";
        }
    }
    else {
      foreach (Tvoyage::getAllVoyagesLim(1) as $data ) {
        echo "
        <form action='admin.php' method='POST'>
          <tr>
            <td><input type='text' class='form-control' style='background-color:rgba(0, 0, 0, 0)' name='codeVoyage' readonly='readonly' value=".$data["codeVoyage"]."></td>
            <td><input type='text' class='form-control' style='background-color:rgba(0, 0, 0, 0)' name='heureD' value=".$data["heureD"]."></td>
            <td><input type='text' class='form-control' style='background-color:rgba(0, 0, 0, 0)' name='villeD' value=".$data["villeD"]."></td>
            <td><input type='text' class='form-control' style='background-color:rgba(0, 0, 0, 0)' name='heureA' value=".$data["heureA"]."></td>
            <td><input type='text' class='form-control' style='background-color:rgba(0, 0, 0, 0)' name='villeA' value=".$data["villeA"]."></td>
            <td><input type='text' class='form-control' style='background-color:rgba(0, 0, 0, 0)' name='prixVoyage' value=".$data["prixVoyage"]."></td>
            <td><input type='submit' class='form-control btn btn-outline-info' name='submit' value='Change'></td>
          </tr>
        </form>
          ";
        }
    }

    ?>
    </tbody>
  </table>
  <ul class="pagination justify-content-center" style="margin:20px 0">
  <?php
    $npage=ceil(Tvoyage::getNumVoyages()/5);
    
    for ($i=1; $i <= $npage; $i++) { 
      if (isset($_GET["page"])) 
      {
        if ($i==$_GET["page"]) {
          echo "<li class='page-item active'><a class='page-link' href='admin.php?page=".$i."'>".$i."</a></li>";
        }
        else {
          echo "<li class='page-item'><a class='page-link' href='admin.php?page=".$i."'>".$i."</a></li>";
  
        }
      }
      else 
      {
        if ($i==1) {
          
          echo "<li class='page-item active'><a class='page-link' href='admin.php?page=".$i."'>".$i."</a></li>";

        }
        else {
          echo "<li class='page-item'><a class='page-link' href='admin.php?page=".$i."'>".$i."</a></li>";
          
        }

      }

    }
 
  ?>

  </ul>
  </section>
  <?php 
  if (!empty($_POST["submit"])) 
  {
    Tvoyage::setVoyage($_POST["codeVoyage"],$_POST["heureD"],$_POST["villeD"],$_POST["heureA"],$_POST["villeA"],$_POST["prixVoyage"]);
    header("Location:admin.php");
  }

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
