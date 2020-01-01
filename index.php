<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Chat en Php</title>
    </head>
    <style>form{text-align:center;}</style>
    <body>
        <form action="chat_post.php" method="post">
            <p>
                <label for="pseudo">Pseudo</label> : <input type="text" name="pseudo" id="pseudo" value="<?php if(isset($_COOKIE['pseudo'])) {echo $_COOKIE['pseudo'];} ?>"/><br/>
                <label for="message">Message</label> : <input type="text" name="message" id="message"/><br/>
                <input type="submit" value="Envoyer"/>
            </p>
            <!--Permet de refresh la page-->
            <p> <a href="javascript:window.location.reload()">Recharger la page</a></p>
        </form>

        <?php
        //Connexion à la Bdd
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=serieytb;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch(Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $reponse = $bdd->query('SELECT pseudo, message,
            DAY(date_msg) AS day,
            MONTH(date_msg) AS month,
            YEAR(date_msg) AS years,
            HOUR(date_msg) AS hour,
            MINUTE(date_msg) AS minute,
            SECOND(date_msg) AS second FROM chat ORDER BY ID ASC LIMIT 10');
            
            while($donnees = $reponse->fetch()) {
                echo '<p>Le '.$donnees['day'].'/'.$donnees['month'].'/'.$donnees['years'].' à '.$donnees['hour'].'h'.$donnees['minute'].'<br/><strong>'. htmlspecialchars($donnees['pseudo']).'</strong> : '. htmlspecialchars($donnees['message']).'</p>';
            }
            $reponse->closeCursor();
        ?>
    </body>
</html>