<div class="orders admin">
	<h1>COMMANDES</h1>

	<?php
		foreach ($reservations as $reservation) {
			$orders = Order::getAll($reservation->id);
	?>
		<div class="orderContainer">
			<div class="orderHead ">
				<div class="name"><?= $reservation->lastname ?></div>
				<div class="contact">
					<a href="tel:<?= $reservation->phone ?>">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg>
						<?= $reservation->phone ?></a>
					<a href="tel:<?= $reservation->email ?>">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
						<?= $reservation->email ?>
					</a>
				</div>
			</div>
			<div class="orderBody">
			<div class="date">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M152 64H296V24C296 10.75 306.7 0 320 0C333.3 0 344 10.75 344 24V64H384C419.3 64 448 92.65 448 128V448C448 483.3 419.3 512 384 512H64C28.65 512 0 483.3 0 448V128C0 92.65 28.65 64 64 64H104V24C104 10.75 114.7 0 128 0C141.3 0 152 10.75 152 24V64zM48 448C48 456.8 55.16 464 64 464H384C392.8 464 400 456.8 400 448V192H48V448z"/></svg>
					<?= ucfirst($formatDate->format(strtotime($reservation->reservation_date))) ?>
				</div>
				<div class="time">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M232 120C232 106.7 242.7 96 256 96C269.3 96 280 106.7 280 120V243.2L365.3 300C376.3 307.4 379.3 322.3 371.1 333.3C364.6 344.3 349.7 347.3 338.7 339.1L242.7 275.1C236 271.5 232 264 232 255.1L232 120zM256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0zM48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48C141.1 48 48 141.1 48 256z"/></svg>
					<?= ucfirst($formatHour->format(strtotime($reservation->reservation_date))) ?>
				</div>
				<?php
					foreach($orders as $order) {
						$target_file = $order->id_dishes . '.jpg';
				?>
						<div class="order">
							<img src="<?= "/public/assets/galery/" . $target_file ?>" alt="photo du plat : <?= $order->title ?>">
							<div class="orderInfo">
								<div class="dish">
									<div class="title"><?= $order->title ?></div>
									<div class="price"><?= $order->price ?>€</div>
								</div>
								<div class="orderPrice">
									<div class="quantity">x <?= $order->quantity ?></div>
									<div class="totalPrice"><?= $order->price * $order->quantity ?>€</div>
								</div>
							</div>
						</div>
				<?php
						}
				?>
			</div>
			<div class="totalCart">
				Prix total de la commande : 
				<?php
					$total = 0;
					foreach($orders as $order) {
						$total += $order->price * $order->quantity;
					}
				?>
				<span><?= $total ?>€</span>
			</div>
			<form action="/admin/commandes/validate" method="POST">
				<div class="errorMessage"><?= $errors['validate'] ?? '' ?></div>
				<input type="hidden" name="validate" value="<?= $reservation->id ?>">
				
					<?php
						if ($reservation->validated_at == NULL) {
					?>
							<button type="submit">
								Valider
							</button>
					<?php
						} else {
					?>
							<button class="validatedBtn" type="submit" disabled>
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>
								Validée
							</button>
					<?php
						}
					?>
					<div class="btnDeleteConf" id="<?=$reservation->id?>">Supprimer</div>
			</form>
		</div>
	<?php
		}
	?>
</div>

<div class="openBurger">
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
</div>

<div class="modale">
	<div class="modaleContent">
			<h2>Supprimer la commande</h2>
			<div class="modaleBtn">
				<button>Annuler</button>
				<a class="deleteOrderLink" href="">Supprimer</a>
			</div>
	</div>
</div>

<?php $message = SessionFlash::get('message') ?>
<?= ($message == '') ? '' : '<div class="messageContainer"><div class="message">'.$message.'</div></div>'; ?>

<?php $message = SessionFlash::get('error') ?>
<?= ($message == '') ? '' : '<div class="messageContainer"><div class="errorMessage">'.$message.'</div></div>'; ?>

<script src="../../public/assets/js/confirmOrderDelete.js"></script>