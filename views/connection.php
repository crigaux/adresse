        <section class="connectForm">
            <form method="POST">
                <legend>Connexion</legend>
                <input type="email" name="email" placeholder="Adresse mail" value="<?=$email ?? ''?>" required>
                <div class="errorMessage"><?= $errors['email'] ?? '' ?></div>
                <input type="password" name="password" placeholder="Mot de passe" required value="">
                <div class="errorMessage"><?= $errors['password'] ?? '' ?></div>
                <button type="submit">Connexion</button>
                <a href="../inscription">Pas de compte ?</a>
                <a href="../oubli-mot-de-passe">Mot de passe oublié</a>
            </form>
        </section>
    </main>

    <?php $message = SessionFlash::get('message') ?>
    <?= ($message == '') ? '' : '<div class="messageContainer"><div class="message">'.$message.'</div></div>'; ?>

    <?php $message = SessionFlash::get('error') ?>
    <?= ($message == '') ? '' : '<div class="messageContainer"><div class="errorMessage">'.$message.'</div></div>'; ?>

    <!-- <script src="../../public/assets/js/script.js"></script> -->
    <script src="../../public/assets/js/menuBurger.js"></script>
</body>
</html>