        <section class="connectForm forgotPwd">
            <form method="POST">
                <legend>Mot de passe oublié</legend>
                <input type="email" name="email" placeholder="Adresse mail" value="<?=$email ?? ''?>">
                <button type="submit">Nouveau mot de passe</button>
                <a href="../connexion">Connexion</a>
            </form>
        </section>

        <?php $message = SessionFlash::get('message') ?>
        <?= ($message == '') ? '' : '<div class="messageContainer"><div class="message">' . $message . '</div></div>'; ?>

        <?php $message = SessionFlash::get('error') ?>
        <?= ($message == '') ? '' : '<div class="messageContainer"><div class="errorSession">' . $message . '</div></div>'; ?>

    </main>
    <!-- <script src="../../public/assets/js/script.js"></script> -->
    <script src="../../public/assets/js/menuBurger.js"></script>
</body>
</html>