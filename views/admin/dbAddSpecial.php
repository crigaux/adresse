<div class="dishes">
	<h1>ARDOISE</h1>
	<h2>Ajouter un plat</h2>

	<form action="/admin/ardoise/ajout" class="dishEditForm" method="POST" enctype="multipart/form-data" >
		<select type="text" name="dish_type" required placeholder="Titre du plat">
			<?php
			for ($i = 1 ; $i <= 3 ; $i++) {
				$dishes = Special::getAll($i);
			?>
				<option value="<?= $i ?>"><?= Special::specialTypeName($i) ?></option>
			<?php
			}
			?>
		</select>
		<div class="errorMessage">
			<?= $errors['dish_type'] ?? '' ;?>
		</div>
		<input type="text" name="title" required placeholder="Titre du plat" value="<?= $title ?? ''?>">
		<div class="errorMessage">
			<?= $errors['title'] ?? '' ;?>
		</div>
		<input type="text" name="price" required placeholder="Prix du plat" value="<?= $price ?? ''?>">
		<div class="errorMessage">
			<?= $errors['price'] ?? '' ;?>
		</div>
		<textarea name="description" cols="30" rows="8" placeholder="Description du plat"><?= $description ?? ''?></textarea>
		<div class="errorMessage">
			<?= $errors['description'] ?? '' ;?>
		</div>
		<input type="file" name="img">
		<div class="errorMessage">
			<?= $errors['img'] ?? '' ;?>
		</div>

		<button type="submit">Ajouter</button>
	</form>
</div>

<div class="openBurger">
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
		<!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
		<path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
	</svg>
</div>