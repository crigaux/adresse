<div class="dishesContainerMain">
    <!-- Affichage de tout les boutons avec une redirection par ancre à la section convenue -->
    <div class="containerButtonMenu">
        <?php for($i = 1; $i < $typesOfDishes; $i++ ) : ?>
            <?php $dishTypeName = Dish::dishTypeName($i) ?>
            <a href="#<?= $dishTypeName ?>">
            <button>
                <?= ucfirst($dishTypeName) ?>
            </button>
            </a>
        <?php endfor; ?>
    </div>

    <?php for ($i=1; $i < $typesOfDishes ; $i++) :?>
        <?php $dishTypeName = Dish::dishTypeName($i) ?>
        <section id="<?= $dishTypeName ?>">
            <h2><?= ucfirst($dishTypeName) ?></h2>
            <div class="stars">&#x2605;<span>&#x2605;</span>&#x2605;</div>
            <div class="foodCardContainer">
                <?php foreach (Dish::getAll($i) as $element) : ?>
                    <div class="foodCard">
                        <div class="foodCardImg">
                            <img src="/public/assets/img/couple.jpg" alt="">
                            <!-- <img src=<?= ($element->image == $i) ? "/public/assets/galery/".strtolower(str_replace(' ', '', $element->id)).".jpg" : '/public/assets/baseImg/dish.jpg'?> alt="Photo de <?= $element->title ;?>"> -->
                        </div>
                        <div class="foodCardDesc">
                            <h3><?= $element->title ?></h3>
                            <h4><?= $element->price ?>€</h4>
                            <p><?= $element->description ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endfor; ?>

    <!-- Return to top -->
    <div class="returnToTop">
        <a href="#top">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#f3f3f3" d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"/></svg>
        </a>
    </div>
</div>