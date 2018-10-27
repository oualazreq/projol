<?php
if(!empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['objet']) && !empty($_POST['message']))
{
            $dest = 'ouafaa.lazreq@gmail.com';
            $email = htmlentities($_POST['email']);
            if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',str_replace('&amp;','&',$email)))
             {
                      $objet = 'Contact: '.stripslashes($_POST['objet']);
                     $message = stripslashes($_POST['message']);
                      $headers = "From: <".$email.">\n";
                     $headers .= "Reply-To: ".$email."\n";
                    $headers .= "Content-Type: text/plain; charset=\"iso-8859-1\"";
                     if(mail($dest,$objet,$message,$headers))
                     {
                        echo "<strong>Votre message est envoy&eacute; nous vous .</strong>";
                      }
                    else
                      {
                         echo "<strong style=\"color:red;\">Une erreur c'est produite lors de l'envoi du message.</strong>";
                      }
              }
           else
              {
                  echo "<strong style=\"color:red;\">L'adresse email que vous avez saisie est invalide.</strong>";

                  header("refresh:1;url=/projet_s6_php/contact.php");
              }
}
else 
{
  echo "<strong style=\"color:red;\">Veuillez remplir tous les champs.</strong>";
  header("refresh:1;url=/projet_s6_php/contact.php");
}

?>