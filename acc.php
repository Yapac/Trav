<?php 
  include_once("classes/Tbillet.php");
  session_start();
  if (!isset($_SESSION["email"]) AND !isset($_SESSION["pswd"])) {
    header("Location:index.php");
  }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
  <TITLE> Trav </TITLE>
  <meta charset="utf-8"> 
  <link rel="stylesheet" href="./css/bootstrap.min.css" />
  <link rel="stylesheet" href="./css/styles.css" />
  <script src="./js/jquery-3.3.1.slim.min.js"></script>
  <script src="./js/popper.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  <script src="js/script.js"></script>
  <script src="./js/jquery-1.11.1.min.js"></script>
  <link rel="stylesheet" href="css/glyphicones.css">
  <link rel="stylesheet" href="css/styles.css">
   
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
              <li class="nav-item active">
                <a class="nav-link" href="acc.php">Accueil</a>
              </li>
              <li class="nav-item active " style="padding-right: 800px;">
                <a class="nav-link" href="trajets.php">Trajets</a>
              </li>
              <li class="nav-item" >
                <a class="nav-link" href="logout.php">Log out</a>
              </li>
            </ul>
          </div>

        </nav>
      </header>
  </div> 


  <!--    Section 1 Image(background)    !-->
 <section>
  <div class="container-fluid mb-5" id="acc"> 
  
  <!-- AFFICHAGE DU JUMBOTRON -->
    <div class="jumbotron jumbotron-fluid text-white" style="background-image: url('./images/oncf.jpg'); background-size: cover; background-position: center">
    
        <div class="display-4 p-4"style="color:white h1;text-shadow: 2px 2px 4px gray;">
        Bienvenue <?php echo $_SESSION["prenom"]; ?> ,C'est Bon Vous etes Chez<br/> TRAV.</div>
      
    </div>

  </div>

 </section>


  <section class="container mb-5">
    
    <h2>Vos dernières réservations</h2>
    <p>Voici tes dernières réservations  :</p>

    <ul class="list-group list-group-flush">
    <?php 
      foreach (Tbillet::getBillets($_SESSION["email"]) as $data ) {
        echo"
        <li class='list-group-item'>
        <table class='table table-striped table-bordered'>
                <thead>
                  <tr>
                    <th>Numero de billet</th>
                    <th>Code Voyage</th>
                    <th>Date de billet</th>
                    <th>email</th>    
                  </tr>
                </thead>
                <tbody>
                    <th>".$data["Numbillet"]."</th>
                    <th>".$data["codeVoyage"]."</th>
                    <th>".$data["dateBillet"]."</th>
                    <th>".$_SESSION["email"]."</th> 
                    <th class='text-center reserv '><a href='pdf.php?Numbillet=".$data["Numbillet"]."&codeVoyage=".$data["codeVoyage"]."&dateBillet=".$data["dateBillet"]."&email=".$data["email"]."' style='text-decoration:none;'>Impimer</a></th>
                </tbody>
        </table>
      </li>
        
        ";
      }
    
    ?>

    </ul>
  </section>
  <!--    Section 2 Slider    !-->

  <section id="destinations">


    <div class="container"> 
      <h2>Voici un exemple de notre destinations:</h2>
    <div class="carousel slide" data-ride="carousel" id="carouselExample">
      
      
        <ol class="carousel-indicators">
          <li data-target="#carouselExample" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExample" data-slide-to="1"></li>
        <li data-target="#carouselExample" data-slide-to="2"></li>
      
        </ol>
        
        <div class="carousel-inner">
          <div class="carousel-item active">
            <p>Maroc , rabat</p>
            <img src="./images/slide0.jpg"  class="d-block w-100 h-75 mx-auto"/>
            <div class="carousel-caption">
            
            
            </div>
          </div>
        
        <div class="carousel-item">
            <p>Maroc , tetouen</p>
            <img src="./images/slide1.jpg"  class="d-block w-100 h-75 mx-auto"/>
            <div class="carousel-caption">
              
              
            </div>
          </div>
        <div class="carousel-item">
            <p>Maroc, souira</p>
            <img src="./images/slide2.jpg"  class="d-block w-100 h-75 mx-auto" />
        <div class="carousel-caption">
              
            
            </div>
          </div>





        </div>
        
        <a class="carousel-control-prev" data-slide-to="prev" href="#carouselExample">
          <span class="carousel-control-prev-icon"></span>
        </a>
        
        <a class="carousel-control-next" data-slide="next" href="#carouselExample">
          <span class="carousel-control-next-icon"></span>
        </a>
        
      </div>

    </div>
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
