        <section class="inscriptionForm">
            <?php $message = SessionFlash::get('error') ?>
            <?= ($message == '') ? '' : '<div class="errorContainer"><div class="error">'.$message.'</div></div>'; ?>
            <form method="POST" action="">
                <legend>Inscription</legend>
                <input type="text" name="name" placeholder="Nom*" value="<?=$lastname ?? ''?>" required pattern="^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$">
                <div class="errorMessage"><?= $errors['name'] ?? '' ?></div>
                <input type="text" name="firstname" placeholder="Prénom*" value="<?=$firstname ?? ''?>" required pattern="^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$">
                <div class="errorMessage"><?= $errors['firstname'] ?? '' ?></div>
                <input type="email" name="email" placeholder="Adresse mail*" value="<?=$email ?? ''?>" required pattern="^[a-zA-Z0-9_.+-]+@[a-zA-Z-]+\.[a-zA-Z-.]+$">
                <div class="errorMessage"><?= $errors['email'] ?? '' ?></div>
                <input type="phone" name="phone" placeholder="Numéro de téléphone*" value="<?=$phoneNb ?? ''?>" required pattern="^[0][1-9]-?[0-9]{2}-?[0-9]{2}-?[0-9]{2}-?[0-9]{2}$">
                <div class="errorMessage"><?= $errors['phone'] ?? '' ?></div>
                <input type="password" id="password" name="password" placeholder="Mot de passe*" required pattern="(?=.*[A-Z])(?=.*\d)(?=.*[!@#$&*])[A-Za-z\d!@#$&*]{8,}" value="">
                <div class="errorMessage"><?= $errors['password'] ?? '' ?></div>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirmation*" required pattern="(?=.*[A-Z])(?=.*\d)(?=.*[!@#$&*])[A-Za-z\d!@#$&*]{8,}" value="">
                <div class="errorMessage"><?= $errors['confirmPassword'] ?? '' ?></div>
                <fieldset>
                    <input type="checkbox" name="cgu" class="checkbox" value="1" value="<?=$cgu ?? ''?>">
                    <label><a href="">CGU*</a></label>
                </fieldset>
                <div class="errorMessage"><?= $errors['cgu'] ?? '' ?></div>
                <fieldset>
                    <input type="checkbox" name="newsletter" class="checkbox" value="1" value="<?=$newsletter ?? ''?>">
                    <label><a href="">Recevoir notre newsletter*</a></label>
                </fieldset>
                <div class="errorMessage"><?= $errors['newsletter'] ?? '' ?></div>
                <button type="submit">Inscription</button>
                <a href="../connexion">Déjà inscrit ?</a>
            </form>
            
            <!-- Message d'erreur si le mot de passe ne correspond pas aux prérequis  -->
            <div class="passwordRequires">
                <div class="passwordLength">8 caractères minimum</div>
                <div class="passwordUpper">1 majuscule</div>
                <div class="passwordNumber">1 chiffre</div>
                <div class="passwordSpecial">1 caractère spécial</div>
            </div>
        </section>
    </main>
    <!-- <script src="../../public/assets/js/script.js"></script> -->
    <script src="../../public/assets/js/menuBurger.js"></script>
    <script src="../../public/assets/js/pwdTest.js"></script>
</body>
</html>