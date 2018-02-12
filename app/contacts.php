<?php
$msg_erreur = "Erreur. Les champs suivants doivent être obligatoirement 
remplis :<br/><br/>";
$msg_ok = "Votre demande a bien été prise en compte.";
$message = $msg_erreur;
define('MAIL_DESTINATAIRE','vanessadettwiller@gmail.com'); 
define('MAIL_SUJET','Demande de contact d\'un utilisateur');
 

 
$interets = $_POST['interets'];
$sqlinterets = '';
for ($i=0; $i<count($interets); $i++)
{
  $sqlinterets .= $interets[$i];
  $sqlinterets .= ', ';
}
 
//Préparation de l'entête du mail:
$mail_entete  = "MIME-Version: 1.0\r\n";
$mail_entete .= "From: {$_POST['name'] ['surname']} "
             ."<{$_POST['mail']}>\r\n";
$mail_entete .= 'Reply-To: '.$_POST['mail']."\r\n";
$mail_entete .= 'Content-Type: text/plain; charset="iso-8859-1"';
$mail_entete .= "\r\nContent-Transfer-Encoding: 8bit\r\n";
$mail_entete .= 'X-Mailer:PHP/' . phpversion()."\r\n";
 
// préparation du corps du mail
$mail_corps  = "Message de : $name $surname\n";
$mail_corps .= "Téléphone : $telephone\n";
$mail_corps .= "Email : $mail\n\n";
$mail_corps .= "Ville : $city\n";
$mail_corps .= "Objet : $object\n\n";
$mail_corps .= "Message : $message\n";

$mail_corps .= $comments;
 
// envoi du mail
if (mail(MAIL_DESTINATAIRE,MAIL_SUJET,$mail_corps,$mail_entete)) {
  //Le mail est bien expédié
  echo $msg_ok;
} else {
  //Le mail n'a pas été expédié
  echo "Une erreur est survenue lors de l'envoi du formulaire par email";
}
 
?>