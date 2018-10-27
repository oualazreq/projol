<?php 
session_start();
$loginSucc = false;
if(isset($_POST['email']) && $_POST['password']!=null)
	{
		$pass = "";
		$user = "root";
		$base = "projet_s6_php";
		$host = "localhost";
		$db = new PDO("mysql:host=$host;dbname=$base",$user,$pass);

		$email=$_POST['email'];
		$password=$_POST['password'];

		$req= $db->query("select password from users where email='$email' ");
		$result = $req->fetch(PDO::FETCH_ASSOC);
		
		if($password==$result['password'])
			{
				$_SESSION['email']=$email;
			

				if($_SESSION['email']=$email)
					{
						$loginSucc= true;
						header("location:index.php");
					}	
			}
			
		else
			{
			echo "<script>alert(\"email ou mot de passe invalide!\");</script>";
			header("refresh:1;url=/projet_s6_php/login.php");

			}
		
	}
else { echo "<script>alert(\"veuillez remplir tous les champs !\");</script>" ;}

?>