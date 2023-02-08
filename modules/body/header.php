<body>
<!-- Header -->  
    <?php     
    if (isset($_SESSION['user'])) {
        $account = $_SESSION['user'][0];
    }
    else {
        $account = "déconnecté";
    }
    ?>
    <header>
        <section class="content">
            <h1>Trocali</h1>
            <nav>
                <ul>
                    <li <?php if ($page=="index") {print 'class="selected"';} ?>><a href="index.php"><i class="fa-sharp fa-solid fa-house"></i> Accueil</a></li>
                    <li <?php if ($page=="cart") {print 'class="selected"';} ?>><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i> Mon panier</a></li>
                    <li <?php if ($page=="notifications") {print 'class="selected"';} ?>><a href=""><i class="fa-solid fa-cart-shopping"></i> Notifications</a></li>
                    <li <?php if ($page=="account") {print 'class="selected"';} ?>><a href="account.php"><i class="fa-solid fa-user-large"></i> Mon compte (<?php print $account; ?>)</a></li>
                </ul>
            </nav>
        </section>
        <?php include "modules/body/notifications.php"; ?>
    </header>
