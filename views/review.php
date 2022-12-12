<section class="reviews">
    <h2>Livre d'or</h2>
    <h3>Commentaires client</h3>
    <div class="stars">&#x2605;<span>&#x2605;</span>&#x2605;</div>
    <?php
    foreach ($reviews as $review) {
    ?>
        <div class="review">
            <p class="reviewTitle"><?= $review->title ?></p>
            <p class="reviewContent">&ldquo;<?= $review->content ?>&rdquo;</p>
            <h4><?= $review->firstname ?></h4>
        </div>
        <hr>
    <?php
    }
    ?>
    <div class="addReview">
        <?php
        if (isset($_SESSION['user'])) {
        ?>
            <form method="POST" action="/commentaires/ajout">
                <legend>Poster un commentaire</legend>
                <input type="text" name="nom" placeholder="Votre nom*" disabled value="<?= $_SESSION['user']->firstname ?>">
                <input type="text" name="title" placeholder="Titre*" required>
                <textarea name="review" cols="30" rows="10" required placeholder="Écrivez votre commentaire ici*"></textarea>
                <button type="submit">Envoyer</button>
            </form>
        <?php
        } else {
        ?>
            <h2>Poster un commentaire</h2>
            <a href="/connexion">
                <button>Connexion</button>
            </a>
        <?php
        }
        ?>
    </div>

    <?php $message = SessionFlash::get('message') ?>
    <?= ($message == '') ? '' : '<div class="messageContainer"><div class="message">' . $message . '</div></div>'; ?>

    <?php $message = SessionFlash::get('error') ?>
    <?= ($message == '') ? '' : '<div class="messageContainer"><div class="errorSession">' . $message . '</div></div>'; ?>
</section>