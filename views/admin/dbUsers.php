<div class="users">
	<h1>MEMBRES</h1>

	<form action="/admin/membres/search" class="searchBar" method="POST">
		<input type="text" name="search" placeholder="Entrez une recherche">
		<button type="submit">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
				<!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352c79.5 0 144-64.5 144-144s-64.5-144-144-144S64 128.5 64 208s64.5 144 144 144z"/>
			</svg>
		</button>
	</form>
	<div class="userContainer">
		<?php
		foreach ($users as $user) {
		?>
			<div class="userCard">
				<div class="userCardHead">
					<div class="name"><?= $user->lastname . ' ' . $user->firstname ?></div>
				</div>
				<div class="userCardBody">
					<div class="email">
						<a href="tel:<?= $user->email ?>">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
								<!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
								<path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
							</svg>
							<?= $user->email ?></a>
					</div>
					<div class="phone">
						<a href="tel:<?= $user->phone ?>">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
								<!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
								<path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z" />
							</svg>
							<?= $user->phone ?></a>
					</div>
				</div>
				<a href="/admin/membre/edit/<?=$user->id?>"><button>Modifier</button></a>
				<div class="btnDeleteConf" id="<?=$user->id?>">Supprimer</div>
			</div>
		<?php
		}
		?>
	</div>
</div>

<div class="openBurger">
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
		<!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
		<path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
	</svg>
</div>

<div class="modale">
	<div class="modaleContent">
		<h2>Supprimer l'utilisateur</h2>
		<div class="modaleBtn">
			<button>Annuler</button>
			<a class="deleteUserLink" href="">Supprimer</a>
		</div>
	</div>
</div>

<?php $message = SessionFlash::get('message') ?>
<?= ($message == '') ? '' : '<div class="messageContainer"><div class="message">' . $message . '</div></div>'; ?>

<?php $message = SessionFlash::get('error') ?>
<?= ($message == '') ? '' : '<div class="errorContainer"><div class="errorSession">' . $message . '</div></div>'; ?>

<script src="../../public/assets/js/confirmUserDelete.js"></script>