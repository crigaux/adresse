<div class="dishesContainerMain">
    <section class="starter">
        <h2>Entrées</h2>
        <div class="stars">&#x2605;<span>&#x2605;</span>&#x2605;</div>
        <div class="foodCardContainer">
            <?php
                foreach ($starters as $starter) {
            ?>
                    <div class="foodCard">
                        <div class="foodCardImg">
                            <img src=<?= ($starter->image == 2) ? "/public/assets/galery/".strtolower(str_replace(' ', '', $starter->id)).".jpg" : '/public/assets/baseImg/dish.jpg'?> alt="Photo de <?= $starter->title ;?>">
                        </div>
                        <div class="foodCardDesc">
                            <h3><?= $starter->title ?></h3>
                            <h4><?= $starter->price ?>€</h4>
                            <p><?= $starter->description ?></p>
                        </div>
                    </div>
            <?php
                }
            ?>
        </div>
    </section>
    
            <!-- Détail des plats -->
    
    <section class="mainDishies">
        <h2>Plats</h2>
        <div class="stars">&#x2605;<span>&#x2605;</span>&#x2605;</div>
        
        <div class="foodCardContainer">
        <?php
                foreach ($dishes as $dish) {
            ?>
                    <div class="foodCard">
                        <div class="foodCardImg">
                            <img src=<?= ($dish->image == 2) ? "/public/assets/galery/".strtolower(str_replace(' ', '', $dish->id)).".jpg" : '/public/assets/baseImg/dish.jpg'?> alt="Photo de <?= $dish->title ;?>">
                        </div>
                        <div class="foodCardDesc">
                            <h3><?= $dish->title ?></h3>
                            <h4><?= $dish->price ?>€</h4>
                            <p><?= $dish->description ?></p>
                        </div>
                    </div>
            <?php
                }
            ?>
        </div>
    </section>
    
            <!-- Détail des dessert -->
    
    <section class="dessert">
        <h2>Desserts</h2>
        <div class="stars">&#x2605;<span>&#x2605;</span>&#x2605;</div>
        <div class="foodCardContainer">
        <?php
                foreach ($desserts as $dessert) {
            ?>
                    <div class="foodCard">
                        <div class="foodCardImg">
                            <img src=<?= ($dessert->image == 2) ? "/public/assets/galery/".strtolower(str_replace(' ', '', $dessert->id)).".jpg" : '/public/assets/baseImg/dish.jpg'?> alt="Photo de <?= $dessert->title ;?>">
                        </div>
                        <div class="foodCardDesc">
                            <h3><?= $dessert->title ?></h3>
                            <h4><?= $dessert->price ?>€</h4>
                            <p><?= $dessert->description ?></p>
                        </div>
                    </div>
            <?php
                }
            ?>
        </div>
    </section>
</div>