<div class="dishes">
	<h1>BANNIÈRE</h1>

	<div class="openBurger">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
			<!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
			<path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
		</svg>
	</div>

	<img class="bannerPreview" src="../../public/assets/banner/banner.jpg" alt="">
	<h2>Modification</h2>

	<form method="POST" action="/admin/banner/edit" enctype="multipart/form-data" class="bannerForm">
		<label for="banner">
			Ajoutez un fichier pour modifier la bannière
		</label>
		<input type="file" id="banner" name="img">

		<button type="submit">Modifier</button>
	</form>

	<div class="modale">
		<div class="modaleContent">
			<h2>Supprimer le plat</h2>
			<div class="modaleBtn">
				<button>Annuler</button>
				<a class="deleteMenuLink" href="">Supprimer</a>
			</div>
		</div>
	</div>

	<?php $message = SessionFlash::get('message') ?>
	<?= ($message == '') ? '' : '<div class="messageContainer"><div class="message">' . $message . '</div></div>'; ?>

	<?php $message = SessionFlash::get('error') ?>
	<?= ($message == '') ? '' : '<div class="messageContainer"><div class="errorMessage">' . $message . '</div></div>'; ?>

	<script src="../../public/assets/js/deleteConfirm.js"></script>
	<script src="../../public/assets/js/modifyImg.js"></script>