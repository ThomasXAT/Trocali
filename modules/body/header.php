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
<header class="row">
        <section class="headerClass">
            <img src="images/system/Logo_Trocali.png">
            <h1 class="col-xs-2">Trocali</h1>
            <div class="listeIcone">
                <nav class="btn-group">
                    <div  class="col-xs-3" <?php if ($page=="index") {print 'class="selected"';} ?>><a href="index.php" class=" btn btn-info"><i class="fa-sharp fa-solid fa-house "></i></a></div>
                    <div  class="col-xs-3" <?php if ($page=="cart") {print 'class="selected"';} ?>><a href="cart.php" class=" btn btn-info"><i class="fa-solid fa-cart-shopping "></i></a></div>
                    <div  class="col-xs-3" onclick="menu();"  style="color:white"<?php if ($page=="notifications") {print 'class="selected"';} ?>><a class=" btn btn-info" ><i class="fa-solid fa-bell "></i> <?php $ok=getNbNotif($account); print($ok); ?></a></div>
                    <div  class="col-xs-3" <?php if ($page=="account") {print 'class="selected"';} ?>><a href="account.php" class=" btn btn-info"><i class="fa-solid fa-user "></i> <?php print $account; ?></a></div>
                </nav>
                <?php include "modules/body/notifications.php"; ?>
            </div>
        </section>
        
    </header>

<!-- Main -->  
