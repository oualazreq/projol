<?php session_start();?>

<?php include 'header.php'; ?>

<?php 
	if (!empty($_POST['datedep']))
		{
									
			$_SESSION['classe']= $_POST['classe'];
			$_SESSION['villedep']= $_POST['villedep'];
			$_SESSION['datedep']= $_POST['datedep'];
			$_SESSION['villearr']= $_POST['villearr'];
			$_SESSION['dateret']= $_POST['dateret'];
			$_SESSION['nbreadultes']= $_POST['nbreadultes'];
			$_SESSION['nbreenfants']= $_POST['nbreenfants'];

			/**déclaration des variables de session**/
			$classe=$_SESSION['classe'];
			$villedep=$_SESSION['villedep'];
			$datedep=$_SESSION['datedep'];
			$villearr=$_SESSION['villearr'];
			$dateret=$_SESSION['dateret'];
			$nbreadultes=$_SESSION['nbreadultes'];
			$nbreenfants=$_SESSION['nbreenfants'];


			$_SESSION['type']=$_POST['m_ctrlFlightSearchMini$rbtTrip'];
			
			/**End déclaration des variables de session **/

			if(($nbreadultes+$nbreenfants) <= 4)

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
		        			die('Erreur : connexion à la bd échouée '.$e->getMessage());
		        			exit();
						}
						
					if($classe === "Eco")
						{
						
							$reqd= $db->query("SELECT *,(tarifs.tarifeco_adulte * $nbreadultes)+(tarifs.tarifeco_enfant * $nbreenfants) AS ta FROM flight,tarifs WHERE tarifs.num_vol=flight.num_vol  AND flight.ville_dep= '$villedep' AND flight.ville_arr='$villearr' "); 				
							$nbreresult = $reqd->rowCount(); 
							
						}

					else/***choix Business**/
						{
							$reqd= $db->query("SELECT *, (tarifs.tarifb_adulte * $nbreadultes)+(tarifs.tarifb_enfant * $nbreenfants) AS ta FROM flight,tarifs WHERE tarifs.num_vol=flight.num_vol  AND flight.ville_dep= '$villedep' AND flight.ville_arr='$villearr'");							
							$nbreresult = $reqd->rowCount(); /*** tronçon aller **/
									
						}

					
					 
					 /** choix aller retour**/
					if($_SESSION['type'] === "aller_retour" )
						{
							if (!empty($_POST['dateret']))					
								{		
									if($classe === "Eco")/**choix Eco***/
										
										{
											$reqr= $db->query("SELECT *,(tarifs.tarifeco_adulte * $nbreadultes)+(tarifs.tarifeco_enfant * $nbreenfants) AS ta FROM flight,tarifs WHERE tarifs.num_vol=flight.num_vol  AND flight.ville_dep= '$villearr' AND flight.ville_arr='$villedep' "); 													$nbreresult = $reqr->rowCount();
										
										}

									else/***choix Business**/
										{										
											$reqr= $db->query("SELECT *, (tarifs.tarifb_adulte * $nbreadultes)+(tarifs.tarifb_enfant * $nbreenfants) AS ta FROM flight,tarifs WHERE tarifs.num_vol=flight.num_vol  AND flight.ville_dep= '$villearr' AND flight.ville_arr='$villedep'");							
											$nbreresult = $reqr->rowCount(); /*** tronçon aller **/								
										}	
								}
							else 
								{
									echo "<script>alert(\"Veuillez choisir vos dates de voyage !\");</script>";
									header("refresh:1;url=/projet_s6_php/flight.php");
								}

						}
				}
			else
				{
					echo "<script>alert(\"Le nombre total des passagers ne doit pas dépasser 4 !\");</script>";
          
          			header("refresh:0;url=/projet_s6_php/flight.php");
				}
		}
	else
		{
			echo "<script>alert(\"Veuillez choisir vos dates de voyage !\");</script>";
			header("refresh:0;url=/projet_s6_php/flight.php");     
		}


					
?>

<body>
<!--Parcours choisi-->

<div  id="search-header" class="container-fluid"  style="height:auto;margin-left:150px;">
	<div>
		<h3 style="display:block;color:#26313b;flot:left;">Votre parcours</h3>
		<div  class="h4 col-sm-5 ng-scope" style="border-left: 1px solid #CCC;margin-top:20px;">
			<span > <?php echo $villedep ;?></span> 
			<span> <?php echo $villearr ;?></span> 
			<small style="display:block; margin-top:10px;" class="ng-binding"><?php echo $datedep ;?></small>
		</div>
<?php if($_POST['m_ctrlFlightSearchMini$rbtTrip'] === "aller_retour") 
	{?>
		<div class="h4 col-sm-5 ng-scope" style="border-left: 1px solid #CCC;margin-top:20px;">
			<span><?php echo $villearr ;?></span> 
			<span><?php echo $villedep ;?></span> 	
			<small style="display:block ; margin-top:10px;"><?php echo $dateret ;?></small>
		</div>
<?php } ?>
		<div class="h4 col-sm-5" >
			<small style="display:block;margin-top:20px;">PASSAGERS</small> 
			<span><?php echo $nbreadultes ;?></span> adultes 
			<span><?php echo $nbreenfants ;?></span> enfants 
		</div>
		<div class="h4 col-sm-5" style="padding-left:15px;margin-top:20px;">
			<small>CLASSE</small> 
			<span style="display:block"><?php echo $classe ;?></span>
		</div>
	</div>
</div>

<!--End Parcours choisi-->

<!--Résultat recherche -->
<!--choix aller -->

<form style="width: 70% ;border: none;" action="booking_req.php" method="Post">
	<fieldset style=" padding-left:120px;">
	<label style="margin-left:-80px;"><h3 style="color:#f53f1a;"> Aller </h3></label>

<?php while ($aller = $reqd->fetch(PDO::FETCH_ASSOC)) 
	{?>

<div>
	<div class="row">
		<div class="col-xs-9 col-sm-5 summary">
			
				<input type="radio" name="bookd" value="<?php  echo $aller['num_vol']; ?>">
					<strong> Vol:<?php echo $aller['num_vol']; ?></strong>
				</input>
				<img src="images/<?php echo $aller['airline'];?>.jpg">
				<strong class="ng-binding" > <?php echo $aller['airline'];?></strong>
							
		</div> 
		<div class="col-xs-6 col-sm-2 departure">
			<div class="airport-code ng-binding"><?php echo $aller['ville_dep']; ?>
				<div><?php echo $datedep; ?></div>
			</div>
			<div class="ng-binding">
				<strong><?php echo $aller['heure_dep']; ?></strong>
			</div>	 	
		</div>
		<div class="col-xs-6 col-sm-2 arrival">
			<div class="airport-code ng-binding"><?php echo $aller['ville_arr']; ?>
				<div><?php echo $datedep; ?></div>
			</div>
			<div class="ng-binding">
				<strong><?php echo $aller['heure_arr'];?></strong>
			</div>	 	
		</div>
		<hr class="visible-xs">
		<div class="col-xs-6 col-sm-2 price" style="display:inline-block">
			<small>
				A partir de :
			</small>
			 
			 	<strong><?php  echo $aller['ta']; ?></strong><sup>Dh</sup>
		</div>
	</div>
</div>
<?php } ; ?>
</fieldset>

	
<!--choix retour --> 
<?php if($_POST['m_ctrlFlightSearchMini$rbtTrip'] === "aller_retour")
{ ?>
<fieldset style="padding-left:120px;">
<label style="margin-left:-80px;"><h3 style="color:#f53f1a;"> Retour</h3></label>

<?php while ($retour = $reqr->fetch(PDO::FETCH_ASSOC)) 
	{?>
<div>
	<div class="row">
		<div class="col-xs-9 col-sm-5 summary">

			<input type="radio" name="bookr" value="<?php echo  $retour['num_vol']; ?>" >
			 		<strong> Vol :<?php echo $retour['num_vol']; ?></strong>
			</input>
			<img src="images/<?php echo $retour['airline'];?>.jpg">
			
			<strong class="ng-binding"> <?php echo $retour['airline']; ?></strong>
							
		</div>
		<div class="col-xs-6 col-sm-2 departure">
			<div class="airport-code ng-binding"><?php echo $retour['ville_dep']; ?>
				<div><?php echo $dateret; ?></div>
				</div>
			<div class="ng-binding">
				<strong><?php echo $retour['heure_dep']; ?></strong>
			</div>	 	
		</div>
		<div class="col-xs-6 col-sm-2 arrival">
			<div class="airport-code ng-binding"><?php echo $retour['ville_arr']; ?>
				<div><?php echo $dateret; ?></div>
			</div>
			<div class="ng-binding">
				<strong><?php echo $retour['heure_arr'];?></strong>
			</div>	 	
		</div>
		<hr class="visible-xs">
		<div class="col-xs-6 col-sm-2 price" style="display:inline-block">
			<small>
				A partir de :
			</small>
			 <strong><?php  echo $retour['ta']; ?></strong><sup>Dh</sup>

		</div>
	</div>
</div>	
<?php } ?>
</fieldset>

<?php } ?>

	<div class="sub" style="width:120%;">
	<input type="submit" role="button" aria-disabled="false" value="Réserver" name="book" style="margin-bottom:20px;margin-left:300px;">
	</div>
	
	
</form>





<!-- End Résultat recherche -->
<?php include 'footer.php'; ?>
