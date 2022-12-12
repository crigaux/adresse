<div class="userReviews admin">
	<h1>COMMENTAIRES</h1>

	<div class="openBurger">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
			<!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
			<path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
		</svg>
	</div>

	<?php
	foreach ($reviews as $review) {
	?>
		<div class="reviewContainer">
			<form method="POST" action="/admin/commentaire/edit/validate/<?= $review->id ?>" class="formReviewValidate">
				<?php
				if ($review->moderated_at == NULL) {
				?>
					<label class="reviewLabel"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
							<!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
							<path d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z" />
						</svg></label>
					<input type="text" name="validate" value="<?= $review->email; ?>">
				<?php
				} else {
				?>
					<label><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="fill:#41D888">
							<!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
							<path d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z" />
						</svg></label>
				<?php
				}
				?>
			</form>
			<div class="reviewHeader">
				<h3><?= $review->title ?></h3>
			</div>
			<div class="reviewBody">
				<p>&ldquo;<?= $review->content ?>&rdquo;</p>
				<p class="name"><?= $review->firstname . ' ' . $review->lastname ?></p>
			</div>
			<div class="btnDeleteConf" id="<?= $review->id ?>">Supprimer</div>
		</div>
	<?php
	}
	?>
</div>

<div class="modale">
	<div class="modaleContent">
		<h2>Supprimer le commentaire</h2>
		<div class="modaleBtn">
			<button>Annuler</button>
			<a class="deleteReviewLink" href="">Supprimer</a>
		</div>
	</div>
</div>

<?php $message = SessionFlash::get('message') ?>
<?= ($message == '') ? '' : '<div class="messageContainer"><div class="message">' . $message . '</div></div>'; ?>

<?php $message = SessionFlash::get('error') ?>
<?= ($message == '') ? '' : '<div class="messageContainer"><div class="errorSession">' . $message . '</div></div>'; ?>

<script src="../../public/assets/js/validateReview.js"></script>
<script src="../../public/assets/js/confirmReviewDelete.js"></script>