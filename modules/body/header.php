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
<header class="main">
        <section class="content">
            <section class="title">
                <h1>Trocali</h1>
            </section>
            <nav class="landscape">
                <ul>
                    <li <?php if ($page=="index") {print 'class="selected"';} ?>><a href="index.php"><i class="fa-sharp fa-solid fa-house fa-xl"></i></a></li>
                    <li <?php if ($page=="cart") {print 'class="selected"';} ?>><a href="cart.php"><i class="fa-solid fa-cart-shopping fa-xl"></i></a></li>
                    <li <?php if ($page=="notifications") {print 'class="selected"';} ?>><a href=""><i class="fa-solid fa-bell fa-xl"></i> 0</a></li>
                    <li <?php if ($page=="account") {print 'class="selected"';} ?>><a href="account.php"><i class="fa-solid fa-user fa-xl"></i> <?php print $account; ?></a></li>
                </ul>
            </nav>
            <nav class="portrait">
                <ul>

                </ul>
            </nav>
        </section>
        <?php include "modules/body/notifications.php"; ?>
    </header>
<!-- Main -->  
