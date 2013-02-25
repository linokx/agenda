<div id="centre">
<?php
	$pays	= array(
          			'1' => 'Belgique',
          			'2' => 'France',
          			'3' => 'Luxembourg',
          			'4' => 'Royaume-Uni'
        		);
?>
	<form action="modifier" accept-charset="utf-8" method="post" enctype="multipart/form-data">
	<p>Vous êtes connecté en tant que <?php echo $login; ?></p>
	<label>Prénom<input name="prenom" value="<?php echo $prenom; ?>"></label>
	<label>Nom<input name="nom" value="<?php echo $nom; ?>"></label>
	<label>Mail<input name="mail" value="<?php echo $mail; ?>"></label>
	<label>Date de naissance<input type="text" id="naissance" placeholder="08/02/2013" /></label><br/>
	<label>Adresse<input name="num" value="<?php echo $num; ?>"><input name="rue" value="" /></label>
	<label>Pays
		<?php echo form_dropdown('pays', $pays,''); ?></label>
    <img src="<?php echo base_url().'/'.IMG_DIR; ?>/membre/<?php echo $photo; ?>" width="100px" style="border:2px gray solid"/>
    <label>Photo<input type="file" name="photo" /></label>
    <input type="hidden" name="pseudo" value="<?php echo $login; ?>" /><br/>
    <input type="submit" name="check" value="Mettre à jour le profil" style="color:black" />
</form>
</div>