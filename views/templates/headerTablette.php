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
    <link rel="stylesheet" href="../../public/assets/css/menu.css">
    <link rel="stylesheet" href="../../public/assets/css/tablet.css">
    <script defer src="../../public/assets/js/tabletMode.js"></script>
    <meta name="description" content="Découvrez la cuisine authentique de L'adresse, notre restaurant italien situé au cœur d'Amiens. Nous proposons une large sélection de plats traditionnels préparés avec les meilleurs ingrédients frais. Réservez une table aujourd'hui pour goûter à notre délicieuse cuisine italienne.">
    <title>L'adresse</title>
</head>

<body>
    <div class="navbarTablet fullDishes">
        <div class="containerButtonTablet">
            <?php for($i = $firstDishType ; $i < $typesOfDishes ; $i++) : ?>
                <?php if(!empty(Dish::getAllActive($i))) : ?>
                    <?php $dishTypeName = Dish::dishTypeName($i) ?>
                    <a href="#<?= $dishTypeName ?>">
                    <button>
                        <?= ucfirst($dishTypeName) ?>
                    </button>
                    </a>
                <?php endif ;?>
            <?php endfor; ?>
        </div>
    </div>
    <div class="navbarTablet fullDrinks hidden">
        <div class="containerButtonTablet">
            <?php for($i = $firstDrinkType ; $i < $typesOfDrinks ; $i++) : ?>
                <?php if(!empty(Drink::getAllActive($i))) { ?>
                    <?php $dishTypeName = Drink::drinkTypeName($i) ?>
                    <?php if($dishTypeName != '') : ?>
                    <a href="#<?= $dishTypeName ?>">
                    <button>
                        <?= ucfirst($dishTypeName) ?>
                    </button>
                    </a>
                    <?php endif; ?>
                <?php } ?>
            <?php endfor; ?>
        </div>
    </div>
    <div class="navbarTablet fullArdoise hidden">
        <div class="containerButtonTablet">
            <a href="#">
                <button>
                    Ardoise
                </button>
            </a>
        </div>
    </div>
    <main>