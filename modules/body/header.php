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
        <section class="header">
            <h1 class="col-xs-2">Trocali</h1>
            <nav class="btn-group">
                <div  class="col-xs-3" <?php if ($page=="index") {print 'class="selected"';} ?>><a href="index.php" class=" btn btn-info"><i class="fa-sharp fa-solid fa-house fa-xl"></i></a></div>
                <div  class="col-xs-3" <?php if ($page=="cart") {print 'class="selected"';} ?>><a href="cart.php" class=" btn btn-info"><i class="fa-solid fa-cart-shopping fa-xl"></i></a></div>
                <div  class="col-xs-3" <?php if ($page=="notifications") {print 'class="selected"';} ?>><a href="" class=" btn btn-info"><i class="fa-solid fa-bell fa-xl"></i> 0</a></div>
                <div  class="col-xs-3" <?php if ($page=="account") {print 'class="selected"';} ?>><a href="account.php" class=" btn btn-info"><i class="fa-solid fa-user fa-xl"></i> <?php print $account; ?></a></div>
            </nav>
            <?php include "modules/body/notifications.php"; ?>
        </section>
        
    </header>

<!-- Main -->  
