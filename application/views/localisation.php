<div id="popup">
	<div class="localisation">
		<h2>Utiliser une adresse</h2>
		<img src="<?php echo base_url().IMG_DIR; ?>/home.png" />
		<form method="post" action='sortie/localiser'>
			<label for="adresse">Adresse</label>
			<input id="adresse" />
			<label for="ville">Ville</label>
			<input id="ville" />
			<input value="0" name="lat" id="lat" type="hidden">
			<input value="0" name="lon" id="lon" type="hidden">
			<input type="submit" class="bouton" value="Localiser"/>
		</form>
	</div>
	<div class="localisation"><h2>Utiliser la géolocalisation</h2>
		<img src="<?php echo base_url().IMG_DIR; ?>/mobile.png" />
		<span>Si vous utilisez cette option avec un ordinateur, le résultat risque d'être incorrect.</span>
			<a href="#" class="bouton">Lancer la géolocalisation</a>
	</div>
</div>