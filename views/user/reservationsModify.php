<div class="userProfil">
	<h1>MES RÉSERVATIONS</h1>

	<h2>Modifier</h2>
	<div class="openBurger">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
	</div>

	<form method="POST" action="/profil/reservation/edit/<?=$id?>" class="">
		<label for="clients">Nombre de couverts</label>
		<input type="number" min="1" max="8" step="1" id="clients" placeholder="Nombre de personne (max 8 personnes)" name="nbOfClients" value="<?= $nbOfClients ?? $reservation->number_of_persons?>" pattern="^[1-8]$" required>
		<?= empty($errors['nbOfClients']) ? '' : '<div class="errorMessage">'.$errors['nbOfClients'].'</div>'?>

		<label for="date">Date de réservation</label>
		<input type="date" name="date" value="<?= $date ?? ''?>" pattern="^[0-9]{4}-[0-9]{2}-[0-9]{2}$" required>
		<?= empty($errors['date']) ? '' : '<div class="errorMessage">'.$errors['date'].'</div>'?>

		<label for="time">Créneaux horaire</label>
		<select name="time" pattern="^[1-2]$" required>
			<option value="0">Choisissez votre créneaux</option>
			<option value="1" <?= (isset($time) && $time == 1) ? 'selected' : '' ?>>Midi</option>
			<option value="2" <?= (isset($time) && $time == 2) ? 'selected' : '' ?>>Soir</option>
		</select>
		<?= empty($errors['time']) ? '' : '<div class="errorMessage">'.$errors['time'].'</div>'?>

		<button type="submit">Réserver</button>
	</form>
</div>

<script src="/../public/assets/js/menuBurgerDB.js"></script>