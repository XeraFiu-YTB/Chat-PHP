<?php
setCookie('pseudo', $_POST['pseudo'], time()+365*24*3600, null, null, false, true);
try {
    $bdd = new PDO('mysql:host=localhost;dbname=serieytb;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch(Exception $e) {
    die('Erreur : '. $e->getMessage());
}

$requete = $bdd->prepare('INSERT INTO chat (pseudo,message,date_msg) VALUES(?,?, NOW())');
$requete->execute(array($_POST['pseudo'], $_POST['message']));
//Il faut mtn rediriger le visiteur sur l'index
header('Location: index.php');

?>