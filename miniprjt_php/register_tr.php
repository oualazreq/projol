<?php session_start();?>
<?php 
if(isset($_POST['email']) && $_POST['password']!=null)
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

	
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirm = $_POST['confirm'];
		if($confirm==$password)
		{
			$db->beginTransaction();
			
			$req="INSERT into users(nom,prenom,email,password,confirm) values('$nom','$prenom','$email','$password','$confirm')";
			
			$result=$db->exec($req);
			if($result==1)
				{
					$db->commit();
					echo "<script>alert(\"votre enregistrement est pris en compte , veuillez vconsulter votre boite email\");</script>";
					header("refresh:2;url=/projet_s6_php/index.php");
				}
			else
				{	
					$db->rollback();
					echo "<script>alert(\"Compte Utilisateur/Email existant, Veuillez utiliser une autre adresse email!\");</script>";
					header("refresh:2;url=/projet_s6_php/register.php");
				}
		}
		else
		{
			echo "<script>alert(\"les mot de passe(s) doivent correspondre\");</script>";

		}
	}
?>