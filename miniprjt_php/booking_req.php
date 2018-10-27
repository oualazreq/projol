<?php session_start(); ?>
<?php include 'header.php';?>

<?php
  if(isset($_POST['bookd']))
    { 
      if ($_SESSION['email']== NULL)
        {
        	session_destroy();
			header("Location:login_red.php");
        } 
      else 
        {


          try
            {
              $pass = "";
              $user = "root";
              $base = "projet_s6_php";
              $host = "localhost";
              $db = new PDO("mysql:host=$host;dbname=$base",$user,$pass);
              $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }

          catch(Exception $e)
            {
            // En cas d'erreur, on affiche un message 
                  die('Erreur :connexion à la bd échouée '.$e->getMessage());
            }
                  



            /**déclaration des variables de session**/

                  $classe=$_SESSION['classe'];  
                  $villedep=$_SESSION['villedep'];
                  $datedep=$_SESSION['datedep'];
                  $villearr=$_SESSION['villearr'];
                  $nbreadultes=$_SESSION['nbreadultes'];
                  $nbreenfants=$_SESSION['nbreenfants'];
                 
                    $_SESSION['dflight']=$_POST['bookd'];
                   
                    
                    $dflight=$_SESSION['dflight'];
                    

             /**End déclaration des variables de session **/
            
            
               
                  if ($_SESSION['classe'] === "Eco")
                      {
              $dbookreq= $db->query("SELECT *,(tarifs.tarifeco_adulte * $nbreadultes)+(tarifs.tarifeco_enfant * $nbreenfants) AS bta FROM flight,tarifs WHERE tarifs.num_vol=flight.num_vol  AND flight.num_vol= '$dflight'");      
              $dbooking = $dbookreq->fetch();
              
                        }
                  if ($_SESSION['classe'] === "Business")
                      {
              $dbookreq= $db->query("SELECT *,(tarifs.tarifb_adulte * $nbreadultes)+(tarifs.tarifb_enfant * $nbreenfants) AS bta FROM flight,tarifs WHERE tarifs.num_vol=flight.num_vol  AND flight.num_vol= '$dflight'");      
              $dbooking = $dbookreq->fetch();
             
                      }


            if ($_SESSION['type']==="aller_retour" && isset($_POST['bookr']))

                {

                  $dateret=$_SESSION['dateret'];
                  
                  $_SESSION['rflight']=$_POST['bookr'];
                   
                  $rflight=$_SESSION['rflight'];

                  if ($_SESSION['classe'] === "Eco")
                      {
              $rbookreq= $db->query("SELECT *,(tarifs.tarifeco_adulte * $nbreadultes)+(tarifs.tarifeco_enfant * $nbreenfants) AS btr FROM flight,tarifs WHERE tarifs.num_vol=flight.num_vol  AND flight.num_vol= '$rflight'");
              $rbooking = $rbookreq->fetch();
              
                      }
                  if ($_SESSION['classe'] === "Business")
                      {
              $rbookreq= $db->query("SELECT *,(tarifs.tarifb_adulte * $nbreadultes)+(tarifs.tarifb_enfant * $nbreenfants) AS btr FROM flight,tarifs WHERE tarifs.num_vol=flight.num_vol  AND flight.num_vol= '$rflight'");
              $rbooking = $rbookreq->fetch();
              
                      }
              }
        }
        
    }
?>

<!------ confirmation Itinéraire-->

<div id="tripSummary" style="color: rgb(118, 128, 133); font-family: Arial, Helvetica, sans-serif; width: 73%; padding: 50px; border: 2px solid ; border-color:#f53f1a; height: auto; margin-left:260px; background-color: #26313b;">
  <div id="title1" style="color: rgb(255, 255, 255); font-size: 1.1em; font-weight: bold; text-transform: uppercase; padding: 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: #f53f1a;">Trajet aller</div>
  <ul id="info1" style="list-style: none; margin-left: 0px; margin-top: 10px; margin-bottom: 10px; background-color: rgb(249, 249, 248);padding:50px;">
    <li><span style="font-weight:bold;color:#f53f1a"> Vol aller : </span><br>
      <div style="margin-top: 10px; line-height:15px;margin-bottom: 5px; color: #0c2b40; font-weight: bold;"><?php echo $datedep; ?> à <?php echo $dbooking['heure_dep']; ?>
      <br>
      <?php echo $villedep; ?>⇒ <?php echo $villearr; ?>
      <br>
      </div>Tarif :<?php echo $dbooking['bta']?> DH
    </li><hr>
    <li><?php echo $nbreadultes?> Adultes</li>
    <li><?php echo $nbreenfants?> Enfants</li>
  </ul>
  <?php if ($_SESSION['type']==="aller_retour" && isset($_POST['bookr'])) { ?>
  <div id="title2" style="color: rgb(255, 255, 255); font-size: 1.1em; font-weight: bold; text-transform: uppercase; padding: 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color:#f53f1a;">Trajet retour</div>
  <ul id="info2" style="list-style: none; margin-left: 0px; margin-top: 10px; margin-bottom: 10px; background-color: rgb(249, 249, 248);padding:50px;">
  <li><span style="font-weight:bold;color:#f53f1a;"> Vol retour : </span><br>
    <div style="margin-top: 10px; line-height:15px;margin-bottom: 5px; color: #0c2b40; font-weight: bold;"><?php echo $dateret; ?> à  <?php echo $dbooking['heure_arr']?>
    <br><?php echo $villearr; ?> ⇒ <?php echo $villedep; ?><br>
    </div> Tarif :<?php echo $rbooking['btr']?> DH
  </li><hr>
  <li><?php echo $nbreadultes?> Adultes</li>
  <li><?php echo $nbreenfants?> Enfants</li>
  </ul>
  <?php } ?>
  <div id="title3" style="color: rgb(255, 255, 255); font-size: 1.1em; font-weight: bold; text-transform: uppercase; padding: 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: #f53f1a;">Details de prix</div>
  <ul id="info3" style="list-style: none; margin-left: 0px; margin-top: 10px; margin-bottom: 10px; background-color: rgb(249, 249, 248);padding:50px;">
    
    <li> Classe: <?php echo $classe ?></li>
    <li><span class="total" style="font-weight:bold; font-size=150%">Total TTC : </span><span class="total2" style="font-size:200%; color:#f53f1a; font-weight:bold"><?php echo $dbooking['bta']+ $rbooking['btr']?> DH</span>
    </li>
  </ul>

  <div id="title3" style="color: rgb(255, 255, 255); font-size: 1.1em; font-weight: bold; text-transform: uppercase; padding: 5px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: #f53f1a;">Details Passagers</div>
  
  <form action ="confirm.php" method="Post" name="conf" id="conf" style="list-style: none;  margin-left: 0px; margin-top: 10px; margin-bottom: 10px; background-color: rgb(249, 249, 248); padding:50px;">
  <div style="font-weight:bold;color:#f53f1a;">Passager(s) Adulte(s)</div>
   <?php for($i=0;$i<$nbreadultes;$i++) {?>  
    <div>
          <p style="margin-top: 10px; line-height:15px;margin-bottom: 5px; color: #0c2b40; font-weight: bold;">  Passager <?php echo $i+1; ?></p>

        <div>
          <label>Nom Passager:</label>
          <input type="text" id="full_name" name="full_name" required>
        </div>
        <div>
          <label>Prenom Passager:</label>
          <input type="text" id="full_name" name="full_name" required>
        </div>
        <div>
          <label>N° Passeport/ID:</label>
          <input type="text" id="ID" name="ID" required>
        </div>
        <div>
          <label>Date NAissance</label>
          <input type="date" id="exp" name="exp" required>
        </div>
      </div>
     <?php }; ?>

     <div style="font-weight:bold;color:#f53f1a;">Passager(s) Enfant(s)</div>

     <?php for($j=0;$j<$nbreenfants;$j++) {?>  
    <div>
          <p style="margin-top: 10px; line-height:15px;margin-bottom: 5px; color: #0c2b40; font-weight: bold;">  Passager <?php echo $j+1; ?></p>

        <div>
          <label>Nom Passager:</label>
          <input type="text" id="full_name" name="full_name" required>
        </div>
        <div>
          <label>Prenom Passager:</label>
          <input type="text" id="full_name" name="full_name" required>
        </div>
        <div>
          <label>N° Passeport/ID:</label>
          <input type="text" id="ID" name="ID" required>
        </div>
        <div>
          <label>Date NAissance</label>
          <input type="date" id="exp" name="exp" required>
        </div>
      </div>
     <?php }; ?>
  
        <input style ="float:right; background-color:#f53f1a;color:#000; font-weight:700;" type="submit" name="confirm" value="Confirmer la Réservation" />
   
  </form>
</div>


  



<!--footer--> 
<?php include 'footer.php'; ?>