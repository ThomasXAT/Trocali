<?php

$header = 
    '<header>
        <h1>Trocali</h1>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="generate.php">Générer des articles</a></li>
                <li><a href="clear.php">Supprimer les articles</a></li>
            </ul>
        </nav>
    </header>';

$newsletter = "
        <section class='newsletter'>
            <h2>Inscrivez-vous à notre formulaire de News Letter</h2>	
            <form  action='newsLetter.php' method='POST' > 
                <input class='email' type='email' name='mail'  placeholder='Votre adresse email' class = 'email'><br />
                <section class = 'checkboxs'>
                    <ul>
                        <li><input class='case' type='checkbox' name='condition_util'><span>J'ai pris connaissance de la </span><a href='documents/politiqueConfidentialite.pdf'>Politique de Confidentialité</a></li>
                        <li><input class='case' type='checkbox' name='recevoir_mail'><span>J'accepte de recevoir des mails publicitaires</span></li>
                    </ul>
                </section>
                <p>Vous pouvez vous désinscrire à tout moment à l'aide des liens de désincription ou en nous contactant sur contact@trocali.com</p>

                <input class='valider' type='submit' value='Confirmer'>
            </form>
        </section>";

$footer = "
    <footer>
        Développé par Thomas JORGE, Noé JOUVE, Guilhem POTIES, Evan SPICKA et parfois Rémi DUPIN (alternant) dans le cadre de la SAÉ 3.01.
    </footer>";

function afficherListeMots() {
    foreach(getListeMots() as $mot) {
        print $mot;
        print "<br>";
    }
}
?>