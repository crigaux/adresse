<div class="userProfil">
	<h1>MES COMMANDES</h1>

	<h2>Modifier</h2>
	<div class="openBurger">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
			<!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
			<path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
		</svg>
	</div>

	<form method="POST" action="/profil/commande/edit/<?= $id ?>">
		<label for="date">Date de la réservation</label>
		<input type="date" name="date" value="<?= $date ?? '' ?>" pattern="^[0-9]{4}-[0-9]{2}-[0-9]{2}$" required>
		<?= empty($errors['date']) ? '' : '<div class="errorMessage">' . $errors['date'] . '</div>' ?>

		<label for="time">Créneaux horaire</label>
		<select name="time" pattern="^[1-2]$" required>
			<option value="0">Choisissez votre créneaux</option>
			<option value="1" <?= (isset($time) && $time == 1) ? 'selected' : '' ?>>Midi</option>
			<option value="2" <?= (isset($time) && $time == 2) ? 'selected' : '' ?>>Soir</option>
		</select>
		<?= empty($errors['time']) ? '' : '<div class="errorMessage">' . $errors['time'] . '</div>' ?>

		<label>Plats et quantités</label>
		<div class="orderSelect" id="orderSelect">
			<?php
			$orders = Order::getAll($id);
			foreach ($orders as $order) {
			?>
				<select name="dishes[]">
					<?php
					foreach ($dishes as $dish) {
					?>
						<option <?= ($dish->title == $order->title) ? 'selected' : ''; ?> value="<?= $dish->id ?>"><?= $dish->title ?></option>
					<?php
					}
					?>
				</select>
				<select name="quantity[]">
					<?php
					for ($i = 1; $i < 9; $i++) {
					?>
						<option <?= ($order->quantity == $i) ? 'selected' : ''; ?>><?= $i ?></option>
					<?php
					}
					?>
				</select>
			<?php
			}
			?>
		</div>
		<div class="addDish">+</div>
		<button type="submit">Modifier</button>
	</form>
</div>

<script src="/../public/assets/js/menuBurgerDB.js"></script>
<script src="/../public/assets/js/addDishOrder.js"></script>