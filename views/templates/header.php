<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/7194bdd5cb.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="/../../public/assets/img/logo.svg">
    <link rel="stylesheet" media="" href="../../public/assets/css/mobile.css">
    <link rel="stylesheet" href="../../public/assets/css/desktop.css">
    <?= isset($isOnMenu) ? '<link rel="stylesheet" href="../../public/assets/css/menu.css">' : ''; ?>
    <?= isset($isOnReview) ? '<link rel="stylesheet" href="../../public/assets/css/review.css">' : ''; ?>
    <?= isset($isOnGalery) ? '<link rel="stylesheet" href="../../public/assets/css/galery.css">' : ''; ?>
    <title>L'Annexe</title>
</head>

<body>
    <div class="overlayMenuBurger">
        <div class="overlay">
            <div class="overlayMenuContent">
                <div class="topContainer">
                    <svg class="close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg>
                </div>
                <div class="menuLinks">
                    <a href="/accueil">
                        <h3>Accueil</h3>
                    </a>
                    <a href="/menu">
                        <h3>Menu</h3>
                    </a>
                    <a href="/commentaires">
                        <h3>Commentaires</h3>
                    </a>
                    <a href="/galerie">
                        <h3>Galerie</h3>
                    </a>
                    <div class="connect">
                        <?php
                        if (isset($_SESSION['user'])) {
                            if ($_SESSION['user']->admin == 1) {
                        ?>
                                <a href="/admin/menu">
                                    <h3>Dashboard</h3>
                                </a>
                            <?php
                            } else {
                            ?>
                                <a href="/profil">
                                    <h3>Mon compte</h3>
                                </a>
                            <?php
                            }
                            ?>
                            <a href="/disconnect" class="logOutIcon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                    <path d="M160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96C43 32 0 75 0 128V384c0 53 43 96 96 96h64c17.7 0 32-14.3 32-32s-14.3-32-32-32H96c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32h64zM504.5 273.4c4.8-4.5 7.5-10.8 7.5-17.4s-2.7-12.9-7.5-17.4l-144-136c-7-6.6-17.2-8.4-26-4.6s-14.5 12.5-14.5 22v72H192c-17.7 0-32 14.3-32 32l0 64c0 17.7 14.3 32 32 32H320v72c0 9.6 5.7 18.2 14.5 22s19 2 26-4.6l144-136z" />
                                </svg>
                            </a>
                        <?php
                        } else {
                        ?>
                            <a href="/connexion">
                                <h3>Connexion</h3>
                            </a>
                            <a href="/inscription">
                                <h3>Inscription</h3>
                            </a>
                        <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <header>

        <!-- Barre de navigation -->

        <nav>
            <a href="/accueil#reservation"><button>Réservation</button></a>
            <div class="burgerMenuIcon openBurger">
                <div class="menu">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"> </div>
                </div>
            </div>
            <div class="menuLinksDesktop">
                <a href="../accueil" class="linkNav">
                    <h3>Accueil</h3>
                </a>
                <a href="../menu" class="linkNav">
                    <h3>Menu</h3>
                </a>
                <a href="../commentaires" class="linkNav">
                    <h3>Commentaires</h3>
                </a>
                <a href="../galerie" class="linkNav">
                    <h3>Galerie</h3>
                </a>
                <div class="connect">
                    <?php
                    if (isset($_SESSION['user'])) {
                        if ($_SESSION['user']->admin == 1) {
                    ?>
                            <a href="/admin/menu"><button>DashBoard</button></a>
                        <?php
                        } else {
                        ?>
                            <a href="/profil"><button>Mon compte</button></a>
                        <?php
                        }
                        ?>
                        <a href="/disconnect" class="logOutIconDesk">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96C43 32 0 75 0 128V384c0 53 43 96 96 96h64c17.7 0 32-14.3 32-32s-14.3-32-32-32H96c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32h64zM504.5 273.4c4.8-4.5 7.5-10.8 7.5-17.4s-2.7-12.9-7.5-17.4l-144-136c-7-6.6-17.2-8.4-26-4.6s-14.5 12.5-14.5 22v72H192c-17.7 0-32 14.3-32 32l0 64c0 17.7 14.3 32 32 32H320v72c0 9.6 5.7 18.2 14.5 22s19 2 26-4.6l144-136z" />
                            </svg>
                        </a>
                    <?php
                    } else {
                    ?>
                        <a href="/connexion"><button>Connexion</button></a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </nav>

        <!-- Bannière -->
        <a href="../accueil">
            <h1>L'ANNEXE</h1>
        </a>
        <div class="whiteBrushBottom"></div>

    </header>
    <main>