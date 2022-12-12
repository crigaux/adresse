<div class="userProfil">
	<h1>MON PROFIL</h1>

	<div class="openBurger">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
	</div>

	<form method="POST" action="/profil/edit" class="profilForm">
		<input type="text" name="name" placeholder="Nom*" value="<?= $user->lastname ?? '' ?>" required pattern="^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$">
		<div class="errorMessage"><?= $errors['name'] ?? '' ?></div>
		<input type="text" name="firstname" placeholder="Prénom*" value="<?= $user->firstname ?? '' ?>" required pattern="^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$">
		<div class="errorMessage"><?= $errors['firstname'] ?? '' ?></div>
		<input type="email" name="email" placeholder="Adresse mail*" value="<?= $user->email ?? '' ?>" required pattern="^[a-zA-Z0-9_.+-]+@[a-zA-Z-]+\.[a-zA-Z-.]+$">
		<div class="errorMessage"><?= $errors['email'] ?? '' ?></div>
		<input type="phone" name="phone" placeholder="Numéro de téléphone*" value="<?= $user->phone ?? '' ?>" required pattern="^[0][1-9]-?[0-9]{2}-?[0-9]{2}-?[0-9]{2}-?[0-9]{2}$">
		<fieldset>
			<input type="checkbox" name="newsletter" class="checkbox" value="1" <?= $user->newsletter == 1 ? 'checked' : '' ; ?>>
			<label><a href="">Recevoir notre newsletter*</a></label>
		</fieldset>
		<div class="errorMessage"><?= $errors['newsletter'] ?? '' ?></div>
		<button type="submit">Modifier</button>
		<div class="btnDeleteConf">Supprimer</div>
	</form>
</div>

<div class="modale">
	<div class="modaleContent">
		<h2>Supprimer votre profil</h2>
		<div class="modaleBtn">
			<button>Annuler</button>
			<a class="deleteUserLink" href="">Supprimer</a>
		</div>
	</div>
</div>

<script src="../../public/assets/js/menuBurgerDB.js"></script>
<script src="../../public/assets/js/confirmProfilDelete.js"></script>