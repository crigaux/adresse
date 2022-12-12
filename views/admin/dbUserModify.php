<div class="users">
	<h1>MEMBRES</h1>

	<h2>Modification</h2>

	<form method="POST" action="/admin/membre/edit/<?= $user->id ?>">
		<input type="text" name="lastname" placeholder="Nom*" value="<?= $lastname ?? $user->lastname ?>" required pattern="^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$">
		<div class="errorMessage"><?= $errors['name'] ?? '' ?></div>
		<input type="text" name="firstname" placeholder="Prénom*" value="<?= $firstname ?? $user->firstname ?>" required pattern="^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$">
		<div class="errorMessage"><?= $errors['firstname'] ?? '' ?></div>
		<input type="email" name="email" placeholder="Adresse mail*" value="<?= $email ?? $user->email ?>" required pattern="^[a-zA-Z0-9_.+-]+@[a-zA-Z-]+\.[a-zA-Z-.]+$">
		<div class="errorMessage"><?= $errors['email'] ?? '' ?></div>
		<input type="phone" name="phone" placeholder="Numéro de téléphone*" value="<?= $phoneNb ?? $user->phone ?>" required pattern="^[0][1-9]-?[0-9]{2}-?[0-9]{2}-?[0-9]{2}-?[0-9]{2}$">
		<div class="errorMessage"><?= $errors['phone'] ?? '' ?></div>
		<select name="role">
			<option <?= ($user->admin == 1) ? 'selected' : '' ?> value="1">Admin</option>
			<option <?= ($user->admin == 0) ? 'selected' : '' ?> value="2">Utilisateur</option>
		</select>
		<button type="submit">Modifier</button>
	</form>
</div>

<div class="openBurger">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
	</div>