<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/7194bdd5cb.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="/../../public/assets/img/logo.svg">
    <link rel="stylesheet" href="../../public/assets/css/mobile.css">
    <link rel="stylesheet" href="../../public/assets/css/desktop.css">
    <?= isset($isOnMenu) ? '<link rel="stylesheet" href="../../public/assets/css/menu.css">' : '' ; ?>
    <?= isset($isOnReview) ? '<link rel="stylesheet" href="../../public/assets/css/review.css">' : '' ; ?>
    <?= isset($isOnAccount) ? '<link rel="stylesheet" href="../../public/assets/css/account.css">' : '' ; ?>
    <title>L'annexe</title>
</head>
<body>
    <div class="overlayMenuBurger">
        <div class="overlay">
            <div class="overlayMenuContent">
                <div class="topContainer">
                    <img class="close" src="../../public/assets/img/close.svg" alt="">
                </div>
                <div class="menuLinks">
                        <a href="../accueil"><h3>Home</h3></a>
                        <a href="../menu"><h3>Menu</h3></a>
                        <a href="../commentaires"><h3>Commentaires</h3></a>
                        <a href="../galerie"><h3>Galerie</h3></a>
                        <div class="connect">
                            <a href="../connexion"><h3>Connexion</h3></a>
                            <a href="../inscription"><h3>Inscription</h3></a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <!-- Barre de navigation -->

    <nav>
        <a href="/accueil#reservation"><button>Réservation</button></a>
        <div class="burgerMenuIcon">
            <div class="menu">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"> </div>
            </div>
        </div>
        <div class="menuLinksDesktop">
            <a href="../accueil" class="linkNav"><h3>Accueil</h3></a>
            <a href="../menu" class="linkNav"><h3>Menu</h3></a>
            <a href="../commentaires" class="linkNav"><h3>Commentaires</h3></a>
            <a href="../commentaires" class="linkNav"><h3>Galerie</h3></a>
            <div class="connect">
                <a href="../connexion"><button>Connexion</button></a>
            </div>
        </div>
    </nav>