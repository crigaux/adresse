<div class="reservations user">
	<h1>RÉSERVATIONS</h1>

	<div class="openBurger">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
			<!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
			<path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
		</svg>
	</div>

	<?php
	foreach ($reservations as $reservation) {

	?>
		<div class="reservationCard">
			<div class="reservationCardHead">
				<?= $reservation->lastname ?>
				<?= '(' . $reservation->number_of_persons . ' couverts)' ?>
				<form method="POST" action="/admin/reservation/edit/validate/<?= $reservation->id ?>" class="formReservationValidate">
					<?php
					if ($reservation->validated_at != NULL) {
					?>
						<label class="reservationLabelUser"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="fill:#41D888">
								<!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
								<path d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z" />
							</svg></label>
					<?php
					}
					?>
				</form>
			</div>
			<div class="reservationCardBody userCardBody">
				<div class="date">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
						<!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
						<path d="M152 64H296V24C296 10.75 306.7 0 320 0C333.3 0 344 10.75 344 24V64H384C419.3 64 448 92.65 448 128V448C448 483.3 419.3 512 384 512H64C28.65 512 0 483.3 0 448V128C0 92.65 28.65 64 64 64H104V24C104 10.75 114.7 0 128 0C141.3 0 152 10.75 152 24V64zM48 448C48 456.8 55.16 464 64 464H384C392.8 464 400 456.8 400 448V192H48V448z" />
					</svg>
					<?= ucfirst($formatDate->format(strtotime($reservation->reservation_date))) ?>
				</div>
				<div class="time">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
						<!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
						<path d="M232 120C232 106.7 242.7 96 256 96C269.3 96 280 106.7 280 120V243.2L365.3 300C376.3 307.4 379.3 322.3 371.1 333.3C364.6 344.3 349.7 347.3 338.7 339.1L242.7 275.1C236 271.5 232 264 232 255.1L232 120zM256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0zM48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48C141.1 48 48 141.1 48 256z" />
					</svg>
					<?= ucfirst($formatHour->format(strtotime($reservation->reservation_date))) ?>
				</div>
			</div>
			<a href="/profil/reservation/edit/<?= $reservation->id ?>" class="editReservation"><button>MODIFIER</button></a>
			<div class="btnDeleteConf" id="<?= $reservation->id ?>">Supprimer</div>
		</div>
	<?php
	}
	?>
</div>

<div class="modale">
	<div class="modaleContent">
		<h2>Supprimer la réservation</h2>
		<div class="modaleBtn">
			<button>Annuler</button>
			<a class="deleteReservationLink" href="">Supprimer</a>
		</div>
	</div>
</div>

<?php $message = SessionFlash::get('message') ?>
<?= ($message == '') ? '' : '<div class="messageContainer"><div class="message">' . $message . '</div></div>'; ?>

<?php $message = SessionFlash::get('error') ?>
<?= ($message == '') ? '' : '<div class="messageContainer"><div class="errorSession">' . $message . '</div></div>'; ?>

<script src="../../public/assets/js/menuBurgerDB.js"></script>
<script src="../../public/assets/js/confirmReservationDeleteUser.js"></script>