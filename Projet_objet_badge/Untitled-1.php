
<?php
$to = "mathiasbailet6@gmail.com";
$subject = "bonjour";
$message = "nullos t'y arrive pas";
$headers = "mathiasbailet7@gmail.com";

if (mail($to, $subject, $message, $headers)) {
    echo "E-mail envoyé avec succès.";
} else {
    echo "Erreur lors de l'envoi de l'e-mail.";
}
?>
