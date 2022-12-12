<?php

$header = 
    '<header>
        <h1>Trocali</h1>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</i><a></li>
                <li><a href="generate.php">Générer des articles</i><a></li>
                <li><a href="clear.php">Supprimer les articles</i><a></li>
            </ul>
        </nav>
    </header>';

$newsletter = "
        <section class='newsletter'>
            <h2>Inscrivez-vous à notre formulaire de News Letter</h2>	
            <form  action='main.php' method='POST' > 
                <input class='email' type='email' name='mail'  placeholder='Votre adresse email' class = 'email'><br />
                <input class='case' type='checkbox' name='condition_util'><span>J'ai pris connaissance de la Politique de confidentialité</span><br />
                <input class='case' type='checkbox' name='recevoir_mail'><span>J'accepte de recevoir des mails publicitaires</span><br>

                <p>Vous pouvez vous désinscrire à tout moment à l'aide des liens de désincription ou en nous contactant sur contact@trocali.com</p>

                <input class='valider' type='submit' value='Confirmer'>
            </form>
        </section>";

$footer = "
    <footer>
        Développé par Thomas JORGE, Noé JOUVE, Guilhem POTIES, Evan SPICKA et parfois Rémi DUPIN (alternant) dans le cadre de la SAÉ 3.01.
    </footer>";

?>