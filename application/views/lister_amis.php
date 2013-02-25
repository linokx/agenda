<div id="centre"><h2>Contact</h2>
<div style="width:440px; margin-right:50px; display:inline-block">
<h3>Mes amis</h3>
<?php foreach($amis as $ami): ?><div>
	<h4><?php echo anchor(site_url().'membre/'.$ami->login, $ami->prenom.' '.$ami->nom, 'title="Voir le profil de '.$ami->prenom.'"'); ?></h4>
	<img src="<?php echo base_url().'/'.IMG_DIR; ?>/membre/<?php echo $ami->photo; ?>" width="50px" title="<?php echo $ami->prenom.' '.$ami->nom; ?>" />
		<?php echo anchor(site_url().'message/'.$ami->login, 'Envoyer un message', 'class="message_amis"'); ?>
	</div><?php endforeach; ?>
</div>
<div style="width:440px; display:inline-block">
<h3>Liste noire</h3>

</div>
</div>