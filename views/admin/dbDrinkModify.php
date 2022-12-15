<div class="dishes">
	<h1>BOISSONS</h1>
	<h2>Modifier une boisson</h2>

	<form action="/admin/boissons/edit/<?= $drink->id ?>" class="dishEditForm" method="POST" enctype="multipart/form-data" >
		<select type="text" name="type" required placeholder="Titre du plat">
			<?php

			for ($i = $firstDrinkType; $i < $typesOfDrinks; $i++) {
				$drinks = Drink::getAll($i);
				if(!empty($drinks)){
			?>
				<option <?= ($drink->type == $i) ? 'selected' : '' ?> value="<?= $i ?>"><?= Drink::drinkTypeName($i) ?></option>
			<?php
				}
			}
			?>
		</select>
		<div class="errorMessage">
			<?= $errors['type'] ?? '' ;?>
		</div>
		<input type="text" name="title" required placeholder="Titre de la boisson" value="<?= $drink->titre ?? ''?>">
		<div class="errorMessage">
			<?= $errors['title'] ?? '' ;?>
		</div>
		<input type="text" name="price" required placeholder="Prix de la boisson" value="<?= $drink->prix ?? ''?>">
		<div class="errorMessage">
			<?= $errors['price'] ?? '' ;?>
		</div>
		<input type="text" name="provenance" placeholder="Provenance de la boisson" value="<?= $drink->provenance ?? ''?>">
		<div class="errorMessage">
			<?= $errors['provenance'] ?? '' ;?>
		</div>
		<input type="text" name="appellation" placeholder="Appellation de la boisson" value="<?= $drink->appellation ?? ''?>">
		<div class="errorMessage">
			<?= $errors['appellation'] ?? '' ;?>
		</div>


		<input type="text" name="prix_bouteille" placeholder="Prix de la bouteille" value="<?= $drink->prix_bouteille ?? ''?>">
		<div class="errorMessage">
			<?= $errors['prix_bouteille'] ?? '' ;?>
		</div>
		<input type="text" name="prix_demibouteille	" placeholder="Prix de la demi-bouteille" value="<?= $drink->prix_demibouteille ?? ''?>">
		<div class="errorMessage">
			<?= $errors['prix_demibouteille	'] ?? '' ;?>
		</div>
		<input type="text" name="prix_verre" placeholder="Prix du verre" value="<?= $drink->prix_verre ?? ''?>">
		<div class="errorMessage">
			<?= $errors['prix_verre'] ?? '' ;?>
		</div>
		<input type="text" name="prix_carafe" placeholder="Prix de la carafe" value="<?= $drink->prix_carafe ?? ''?>">
		<div class="errorMessage">
			<?= $errors['prix_carafe'] ?? '' ;?>
		</div>
		<input type="text" name="prix_demicarafe" placeholder="Prix de la demi-carafe" value="<?= $drink->prix_demicarafe ?? ''?>">
		<div class="errorMessage">
			<?= $errors['prix_demicarafe'] ?? '' ;?>
		</div>



		<textarea name="description" cols="30" rows="8" placeholder="Description de la boisson"><?= $drink->description ?? ''?></textarea>
		<div class="errorMessage">
			<?= $errors['description'] ?? '' ;?>
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