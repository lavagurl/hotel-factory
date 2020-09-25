<?php 
$routeCalled = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hotel Factory</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="/script/css/styles.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <link rel="shortcut icon" type="image/png" href="www/script/images/favicon.ico"/>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark" id="mainNav">
        <div class="container">
            <a class="nav-link js-scroll-trigger <?php echo ($routeCalled == "/dashboard")? "active":"" ?>"" class="navbar-brand js-scroll-trigger" href="/home"><img src="/script/images/logo_2.png" class="img-nav" alt="" /></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ml-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ml-auto">
                    <?php if ($_SESSION['role'] == 1) : ?>
                        <li class="nav-item"> <a class="nav-link js-scroll-trigger <?php echo ($routeCalled == "/dashboard")? "active":"" ?>" <?php echo ($routeCalled == "/dashboard")? "active":"" ?>" href="/dashboard">Accueil</a> </li>
                        <li class="nav-item"> <a class="nav-link js-scroll-trigger <?php echo ($routeCalled == "/dashboard/comments")? "active":"" ?>" href="/dashboard/comments">Commentaires</a> </li>
                        <li class="nav-item"> <a class="nav-link js-scroll-trigger <?php echo ($routeCalled == "/dashboard/permissions")? "active":"" ?>" href="/dashboard/permissions">Permissions</a> </li>
                        <li class="nav-item"> <a class="nav-link js-scroll-trigger <?php echo ($routeCalled == "/dashboard/comment/signal")? "active":"" ?>" href="/dashboard/comment/signal">Signalement</a> </li>
                        <li class="nav-item"> <a class="nav-link js-scroll-trigger <?php echo ($routeCalled == "/dashboard/faq")? "active":"" ?>" href="/dashboard/faq">FAQ</a> </li>
                        <li class="nav-item"> <a class="nav-link js-scroll-trigger <?php echo ($routeCalled == "/dashboard/hotels")? "active":"" ?>" href="/dashboard/hotels">Hotels</a> </li>

                    <?php elseif ($_SESSION['role'] == 2) : ?>
                        <li class="nav-item"> <a class="nav-link js-scroll-trigger <?php echo ($routeCalled == "/settings")? "active":"" ?>" href="/settings">Accueil</a> </li>
                        

                        <?php if (isset($_SESSION['hotel']) && !(empty($_SESSION['hotel']))) : ?>
                            <li class="nav-item"> <a class="nav-link js-scroll-trigger <?php echo ($routeCalled == "/settings/mes-pages")? "active":"" ?>" href="/settings/mes-pages">Mes pages</a> </li>
                            <li class="nav-item"> <a class="nav-link js-scroll-trigger <?php echo ($routeCalled == "/settings/update_hotel")? "active":"" ?>" href="/settings/update_hotel">Mon hotel</a> </li>
                            <li class="nav-item"> <a class="nav-link js-scroll-trigger <?php echo ($routeCalled == "/settings/permissions")? "active":"" ?>" href="/settings/permissions">Permissions</a> </li>
                            <li class="nav-item"> <a class="nav-link js-scroll-trigger <?php echo ($routeCalled == "/settings/comment/list")? "active":"" ?>" href="/settings/comment/list">Commentaires</a> </li>
                        <?php else : ?>
                            <li class="nav-item"> <a class="nav-link js-scroll-trigger <?php echo ($routeCalled == "/settings/create_hotel")? "active":"" ?>" href="/settings/create_hotel">Mon hotel</a> </li>
                        <?php endif; ?>
                        <li class="nav-item"> <a class="nav-link js-scroll-trigger <?php echo ($routeCalled == "/settings/parametres")? "active":"" ?>" href="/settings/parametres">Paramètres</a> </li>
                        <li class="nav-item"> <a class="nav-link js-scroll-trigger <?php echo ($routeCalled == "/settings/faq")? "active":"" ?>" href="/settings/faq">FAQ</a> </li>

                    <?php elseif ($_SESSION['role'] == 3 && $_SESSION['hotel'] == 1) : ?>
                        <li class="nav-item"> <a class="nav-link js-scroll-trigger <?php echo ($routeCalled == "/dashboard")? "active":"" ?>" href="/dashboard">Accueil</a> </li>
                        <li class="nav-item"> <a class="nav-link js-scroll-trigger <?php echo ($routeCalled == "/dashboard/comments")? "active":"" ?>" href="/dashboard/comments">Commentaires</a> </li>
                        <li class="nav-item"> <a class="nav-link js-scroll-trigger <?php echo ($routeCalled == "/dashboard/comment/signal")? "active":"" ?>" href="/dashboard/comment/signal">Signalement</a> </li>
                        <li class="nav-item"> <a class="nav-link js-scroll-trigger <?php echo ($routeCalled == "/dashboard/faq")? "active":"" ?>" href="/dashboard/faq">FAQ</a> </li>
                        
                    <?php else : ?>
                        <li class="nav-item"> <a class="nav-link js-scroll-trigger <?php echo ($routeCalled == "/settings")? "active":"" ?>" href="/settings">Accueil</a> </li>
                        <li class="nav-item"> <a class="nav-link js-scroll-trigger <?php echo ($routeCalled == "/settings/comment/list")? "active":"" ?>" href="/settings/comment/list">Commentaires</a> </li>
                        <li class="nav-item"> <a class="nav-link js-scroll-trigger <?php echo ($routeCalled == "/settings/mes-pages")? "active":"" ?>" href="/settings/mes-pages">Mes pages</a> </li>
                        <li class="nav-item"> <a class="nav-link js-scroll-trigger <?php echo ($routeCalled == "/settings/faq")? "active":"" ?>" href="/settings/faq">FAQ</a> </li>
                    <?php endif; ?>
                    <li class="nav-item"> <a class="nav-link js-scroll-trigger <?php echo ($routeCalled == "/profile")? "active":"" ?>" href="/profile">Mon profil</a> </li>
                    <li class="nav-item"> <a class="nav-link js-scroll-trigger <?php echo ($routeCalled == "/se-deconnecter")? "active":"" ?>" href="/se-deconnecter">Se déconnecter</a> </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <?php include "views/" . $this->view . ".view.php"; ?>
    </div>
</body>

</html>