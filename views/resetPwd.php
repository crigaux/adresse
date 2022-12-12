		<section class="connectForm forgotPwd">
			<form method="POST">
				<legend>Réinitialiser</legend>
				<input type="password" name="password" placeholder="Nouveau mot de passe" value="<?= $password ?? '' ?>">
				<input type="password" name="password2" placeholder="Confirmer le mot de passe" value="<?= $password2 ?? '' ?>">
				<button type="submit">Envoyer</button>
				<a href="../connexion">Connexion</a>
			</form>
		</section>

	</main>
	<script src="../../public/assets/js/script.js"></script>
</body>

</html>