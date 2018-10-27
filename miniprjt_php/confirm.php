<?php session_start();?>
<?php include 'header.php'; ?>
<!-- login erreur-->
<div class="container">
	<div class="main">
		<div class="error-404 text-center">

	<?php if(isset($_POST['confirm'])) 
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
            }

		$email=$_SESSION['email'];
		$dflight=$_SESSION['dflight'];
		$nbreplaces=$_SESSION['nbreadultes']+$_SESSION['nbreenfants'];
		$bookdate=date("Y-m-d");

		if ($_SESSION['type']==="aller_retour")

                {$rflight=$_SESSION['rflight'];}
		

		 
		do {	
				 $bookid = uniqid();
				 $reqconf= $db->query("select id_res from booking where id_res='bookid'");
				 $result = $reqconf->fetch(PDO::FETCH_ASSOC) ;

		}while($result == $bookid);

				
		
		$newbook= $db->exec("INSERT INTO booking VALUES ('$bookid','$bookdate','$nbreplaces','$dflight','$email',$rflight)") or die ("Echec de la requete");

		}

	?>
 
				<h4>Votre réservation est Confirmée. </h4>
				<p><?php echo "Numéro de Réservation :"  .$bookid ;?></p>
				<h5>Un email de confirmation vous a été envoyé. </h5>
				<a  onclick="imprimer_page()" class="b-home" style="diplay:inline-block"  href="index.php">Imprimer</a>


			<?php	session_destroy();
					

			?>
			</div>
	</div>


<?php include 'footer.php'; ?>

<script type="text/javascript">
function imprimer_page(){
  window.print();
}
</script>
