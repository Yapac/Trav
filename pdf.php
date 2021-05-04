<?php 
    require_once 'dompdf/autoload.inc.php';

    use Dompdf\Dompdf;

    $document =new Dompdf();
    $html="     
        <table style='border-collapse: collapse;margin:15px'>
                <thead>
                  <tr>
                    <th style='border: 1px solid black;padding:15px'>Numero de billet</th>
                    <th style='border: 1px solid black;padding:15px'>Code Voyage</th>
                    <th style='border: 1px solid black;padding:15px'>Date de billet</th>
                    <th style='border: 1px solid black;padding:15px'>email</th>    
                  </tr>
                </thead>
                <tbody>
                    <th style='border: 1px solid black;padding:15px'>".$_GET["Numbillet"]."</th>
                    <th style='border: 1px solid black;padding:15px'>".$_GET["codeVoyage"]."</th>
                    <th style='border: 1px solid black;padding:15px'>".$_GET["dateBillet"]."</th>
                    <th style='border: 1px solid black;padding:15px'>".$_GET["email"]."</th> 
                    <th> <img src='http://localhost:8080/oncf/index.php'  style='width:100px' /></th>
                </tbody>
                
        </table>
        
        ";
    $document->loadHtml($html);
    $document->setPaper('A4','landscape');
    $document->render();
    $document->stream("billet:".$_GET["Numbillet"],array("Attachment"=>0));
?>