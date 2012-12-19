<h2>Liste des amis</h2>
<?php foreach($amis as $ami): ?><div class="amis">
	<h4><?php echo anchor(site_url().'membre/'.$ami->login, $ami->prenom.' '.$ami->nom, 'title="Voir le profil de '.$ami->prenom.'"'); ?></h4>
	<img src="<?php echo base_url().'/'.IMG_DIR; ?>/membre/<?php echo $ami->photo; ?>" width="20px" title="<?php echo $ami->prenom.' '.$ami->nom; ?>" />
		<p>Amis depuis le <?php echo $ami->date; ?></p>
		<?php echo anchor(site_url().'message/'.$ami->login, 'Envoyer un message', 'class="message_amis"'); ?>
	</div><?php endforeach; ?>