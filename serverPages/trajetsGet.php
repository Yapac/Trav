<?php
  if (isset($GET["vdp"]) AND isset($GET["vda"])) 
  {
    foreach (Tvoyage::getVoyages($GET["vdp"],$GET["vda"]) as $data) {
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