<section class="presentation">
    <div class="presImgContainer">
        <img src="../public/assets/img/couple.jpg" alt="">
        <img src="../public/assets/img/foodPhoto.jpg" alt="">
    </div>
    <div class="about">
        <h2>À propos</h2>
        <h3>Notre histoire</h3>
        <p>Bienvenue à "L'adresse", notre restaurant italien situé en plein cœur de la ville d'Amiens. Nous proposons une cuisine authentique et savoureuse, préparée avec des ingrédients frais et de qualité. Venez découvrir notre sélection de plats traditionnels, ainsi que notre carte des vins exceptionnelle. Réservation recommandée. Nous vous attendons !</p>
    </div>
</section>

<!-- Formulaire de réservation -->

<section id="reservation" class="reservation">
    <div class="whiteBrushTop"></div>
    <?php
    if (!isset($_SESSION['user'])) {
    ?>
        <h2>Reservation</h2>
        <h3 class="logNeeded">Connectez-vous pour réserver</h3>
        <div class="containerButton">
            <a href="/connexion">
                <button>Connexion</button>
            </a>
            <a href="https://beefast.coopcycle.org/fr/restaurant/13-l-adresse" target="_blank">
                <button>
                    Livrez moi
                </button>
            </a>
        </div>
    <?php

    } else {
    ?>
        <div class="container">
            <h2>Reservation</h2>
            <div class="stars">&#x2605;<span>&#x2605;</span>&#x2605;</div>

            <div class="reservationType">
                <button>Sur place</button>
                <button class="inactive">À emporter</button>
                <a href="https://beefast.coopcycle.org/fr/restaurant/13-l-adresse" target="_blank">
                    <button class="inactive">
                        Livrez moi
                    </button>
                </a>
            </div>

            <!-- Message pour valider l'ajout d'un rendez vous -->
            <?php $message = SessionFlash::get('added') ?>
            <?= ($message == '') ? '' : '<div class="messageContainer"><div class="message">' . $message . '</div></div>'; ?>

            <!-- Message prévenir que le nombre de clients est trop grand -->
            <?php $message = SessionFlash::get('error') ?>
            <?= ($message == '') ? '' : '<div class="errorContainer"><div class="error">' . $message . '</div></div>'; ?>


            <form method="POST" action="/accueil#reservation" class="reservationOnSpot">
                <input type="text" placeholder="Nom" name="name" value="<?= $name ?? $_SESSION['user']->lastname ?>" pattern="^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$" required>
                <?= empty($errors['name']) ? '' : '<div class="errorMessage">' . $errors['name'] . '</div>' ?>

                <input type="tel" placeholder="Numéro de téléphone" name="phoneNb" value="<?= $phoneNb ?? $_SESSION['user']->phone ?>" pattern="^[0][1-9]-?[0-9]{2}-?[0-9]{2}-?[0-9]{2}-?[0-9]{2}$" required>
                <?= empty($errors['phoneNb']) ? '' : '<div class="errorMessage">' . $errors['phoneNb'] . '</div>' ?>

                <input type="number" min="1" max="8" step="1" placeholder="Nombre de personne (max 8 personnes)" name="nbOfClients" value="<?= $nbOfClients ?? '' ?>" pattern="^[1-8]$" required>
                <?= empty($errors['nbOfClients']) ? '' : '<div class="errorMessage">' . $errors['nbOfClients'] . '</div>' ?>

                <input type="date" name="date" value="<?= $date ?? '' ?>" pattern="^[0-9]{4}-[0-9]{2}-[0-9]{2}$" required>
                <?= empty($errors['date']) ? '' : '<div class="errorMessage">' . $errors['date'] . '</div>' ?>

                <select name="time" pattern="^[1-2]$" required>
                    <option value="0">Choisissez votre créneaux</option>
                    <option value="1" <?= (isset($time) && $time == 1) ? 'selected' : '' ?>>Midi</option>
                    <option value="2" <?= (isset($time) && $time == 2) ? 'selected' : '' ?>>Soir</option>
                </select>
                <?= empty($errors['time']) ? '' : '<div class="errorMessage">' . $errors['time'] . '</div>' ?>

                <input type="hidden" name="form" value="1">

                <button type="submit">Réserver</button>
            </form>

            <form method="POST" action="/accueil#reservation" class="reservationToGo">
                <input type="text" placeholder="Nom" name="name" value="<?= $name ?? $_SESSION['user']->lastname ?>" pattern="^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$" required>
                <?= empty($errors['name']) ? '' : '<div class="errorMessage">' . $errors['name'] . '</div>' ?>

                <input type="tel" placeholder="Numéro de téléphone" name="phoneNb" value="<?= $phoneNb ?? $_SESSION['user']->phone ?>" pattern="^[0][1-9]-?[0-9]{2}-?[0-9]{2}-?[0-9]{2}-?[0-9]{2}$" required>
                <?= empty($errors['phoneNb']) ? '' : '<div class="errorMessage">' . $errors['phoneNb'] . '</div>' ?>

                <input type="date" name="date" value="<?= $date ?? '' ?>" pattern="^<?= date('Y', time()) ?>-<?= date('m', time()) ?>-[0-3][0-9]$" required>
                <?= empty($errors['date']) ? '' : '<div class="errorMessage">' . $errors['date'] . '</div>' ?>

                <select name="time" pattern="^(matin)|(soir)$" required>
                    <option value="0" disabled selected>Choisissez votre créneaux</option>
                    <option value="1">Midi</option>
                    <option value="2">Soir</option>
                </select>
                <?= empty($errors['time']) ? '' : '<div class="errorMessage">' . $errors['time'] . '</div>' ?>

                <div class="dishes">
                    <script>
                        fetch(`/getDishesAjax`)
                            .then(response => response.json())
                            .then(data => {
                                let div =
                                    `<div class="dish">`;
                                let select =
                                    `<select name="dishList[]">`;
                                let select2 =
                                    `<select name="quantity[]">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>`;
                                let del =
                                    `<div class="del">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                        </div>`;
                                data.forEach(element => {
                                    select += `<option value="${element.id}">${element.title}</option>`;
                                });
                                select += `</select>`;
                                div += select + select2 + del + `</div>`;
                                dishesContainer.innerHTML += div;

                                let deleteDishes = document.querySelectorAll('.reservation .del');
                                deleteDishes.forEach(element => {
                                    element.addEventListener('click', () => {
                                        element.parentNode.remove();
                                    })
                                });
                            })
                    </script>
                </div>

                <div class="addDish">+</div>

                <input type="hidden" name="form" value="2">
                <button type="submit">Réserver</button>
            </form>
        <?php
    }
        ?>
        </div>
        <div class="whiteBrushBottom"></div>
</section>

<!-- Présentation des points forts du restaurant -->

<section class="ourForces">
    <h2>Caractéristiques</h2>
    <h3>Pourquoi venir chez nous ?</h3>
    <div class="stars">&#x2605;<span>&#x2605;</span>&#x2605;</div>

    <div class="featureContainer">
        <div>
            <img src="../public/assets/img/feature1.png" alt="">
            <h4>Un menu pour tous</h4>
            <p>Notre vous proposons des menus adaptés pour tous les goûts et tous les besoins, que vous soyez végétarien ou que vous ayez des allergies.</p>
        </div>
        <div>
            <img src="../public/assets/img/feature2.png" alt="">
            <h4>Des ingrédients frais préparés sur place</h4>
            <p>Notre restaurant met un point d'honneur à utiliser des produits frais dans la préparation de nos plats afin de vous servir des plats exquis.</p>
        </div>
        <div>
            <img src="../public/assets/img/feature3.png" alt="">
            <h4>Une équipe passionnée</h4>
            <p>L'équipe du restaurant "L'adresse" est passionnée et dévouée à offrir une expérience culinaire exceptionnelle à nos clients.</p>
        </div>
    </div>

</section>

<!-- Présentation d'un aperçu du menu -->

<section class="menuPreview">
    <div class="whiteBrushTop"></div>

    <h2>Menu</h2>
    <h3>Aperçu de nos spécialités</h3>
    <div class="stars">&#x2605;<span>&#x2605;</span>&#x2605;</div>

    <div class="menuPreviewContainer">
        <div class="categories">
            <div>
                <div class="categoriesItem" id="starterPreview">Entrées</div>
            </div>
            <div>
                <div class="categoriesItem" id="mainDishesPreview">Plats</div>
            </div>
            <div>
                <div class="categoriesItem" id="dessertPreview">Desserts</div>
            </div>
        </div>
        <div class="catDishesContainer">
            <script>
                fetch(`/getLastStartersAjax`)
                    .then(response => response.json())
                    .then(data => {
                        container.innerHTML = '';
                        data.forEach(element => {
                            container.innerHTML +=
                                `<div class="catDishiesItem">
                                <div class="catDishiesItemTitle">
                                    <h4>${element.title}</h4>
                                    <span>${element.price}€</span>
                                </div>
                                <p>${element.description}</p>
                            </div>
                            `
                        })
                    })
            </script>
        </div>
    </div>

    <a href="../menu"><button>Voir tout</button></a>

    <div class="whiteBrushBottom"></div>
</section>

<!-- Aperçu d'un commentaire client -->

<section class="reviewPreview">
    <h2>Livre d'or</h2>
    <h3>Commentaires client</h3>
    <div class="stars">&#x2605;<span>&#x2605;</span>&#x2605;</div>
    <div id="displayedReview">
        <script>
            fetch(`/getLastReviewsAjax`)
            .then(response => response.json())
            .then(data => {
                displayedReview.innerHTML = '';
                data.forEach(element => {
                    displayedReview.innerHTML +=
                        `
                        <hr>
                        <h3>${element.title}</h3>
                        <p>&ldquo;${element.content}&rdquo;</p>
                        <h4>${element.firstname}</h4>
                        `
                    })
                })
        </script>
    </div>
    <a href="../commentaires" class="reviewsPreviewBtn"><button>Voir tout</button></a>
</section>

<?php $message = SessionFlash::get('message') ?>
<?= ($message == '') ? '' : '<div class="messageContainer"><div class="message">' . $message . '</div></div>'; ?>

<?php $message = SessionFlash::get('error') ?>
<?= ($message == '') ? '' : '<div class="messageContainer"><div class="errorSession">' . $message . '</div></div>'; ?>