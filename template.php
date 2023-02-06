<?php
function html_head ($title) {
    session_start();
    print '<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>'.$title.'</title>
    <link href="style.css" rel="stylesheet">
    <link rel="icon" href="">
    <script src="https://kit.fontawesome.com/d003054d16.js" crossorigin="anonymous"></script>
</head>
';
}

function html_header () {
    if (isset($_SESSION['user'])) {
        $account = $_SESSION['user'][0];
    }
    else {
        $account = "déconnecté";
    }
    print '
<body>
    <header>
        <section class="content">
            <h1>Trocali</h1>
            <nav>
                <ul>
                    <li><a href="index.php"><i class="fa-sharp fa-solid fa-house"></i> Accueil</a></li>
                    <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i> Mon panier</a></li>
                    <li><a href="account.php"><i class="fa-solid fa-user-large"></i> Mon compte ('.$account.')</a></li>
                </ul>
            </nav>
        </section>
    </header>
';
}

function html_footer () {
    print '
    <footer>
        <section class="content">
            <p>Pied de page</p>
        </section>
    </footer>
</body>

</html>
';
}
?>