<div class="orders">
	<h1>COMMANDES</h1>

	<?php
	foreach ($reservations as $reservation) {
		$orders = Order::getAll($reservation->id);
	?>
		<div class="orderContainer">
			<div class="orderHead">
				<div class="name"><?= $reservation->lastname ?></div>
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
				foreach ($orders as $order) {
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
						<div class="delOrderBtn btnDeleteOrderConf" id="<?=$order->id?>">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
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
				foreach ($orders as $order) {
					$total += $order->price * $order->quantity;
				}
				?>
				<span><?= $total ?>€</span>
			</div>
			<a href="/profil/commande/edit/<?= $reservation->id ?>"><button type="submit">
				Modifier
			</button></a>
			<div class="btnDeleteConf" id="<?= $reservation->id ?>">Supprimer</div>
		</div>
	<?php
	}
	?>
</div>

<div class="openBurger">
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
		<!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
		<path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
	</svg>
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

<div class="modale modale2">
	<div class="modaleContent">
		<h2>Supprimer le plat</h2>
		<div class="modaleBtn">
			<button>Annuler</button>
			<a class="deleteOneOrderLink" href="">Supprimer</a>
		</div>
	</div>
</div>

<?php $message = SessionFlash::get('message') ?>
<?= ($message == '') ? '' : '<div class="messageContainer"><div class="message">' . $message . '</div></div>'; ?>

<?php $message = SessionFlash::get('error') ?>
<?= ($message == '') ? '' : '<div class="messageContainer"><div class="errorSession">' . $message . '</div></div>'; ?>

<script src="../../public/assets/js/menuBurgerDB.js"></script>
<script src="../../public/assets/js/confirmOrderUserDelete.js"></script>
<script src="../../public/assets/js/confirmOneOrderDelete.js"></script>