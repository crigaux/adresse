<div class="dishes">
	<h1>MENU</h1>
	<h2>Modification</h2>

	<form action="/admin/menu/edit/<?=$id?>" class="dishEditForm" method="POST">
		<input type="text" name="title" value="<?= $dish->title ?>" required>
		<div class="errorMessage">
			<?= $errors['title'] ?? '' ;?>
		</div>
		<input type="text" name="price" value="<?= $dish->price ?>" required>
		<div class="errorMessage">
			<?= $errors['price'] ?? '' ;?>
		</div>
		<textarea name="description" cols="30" rows="8"><?= $dish->description ?></textarea>
		<div class="errorMessage">
			<?= $errors['description'] ?? '' ;?>
		</div>
		<div class="toGoCheckbox">
			<input id="toGoCheckbox" type="checkbox" name="toGo" value="1" <?= ($dish->togo == 1) ? 'checked' : '' ?>>
			<label for="toGoCheckbox">Disponible au retrait</label>
		</div>
		<div class="errorMessage">
			<?= $errors['toGoCheckbox'] ?? '' ;?>
		</div>

		<button type="submit">Modifier</button>
	</form>
</div>

<div class="openBurger">
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
		<!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
		<path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
	</svg>
</div>