<h2>Liste des amis</h2>
<?php foreach($amis as $ami): ?><div class="amis">
		<img src="#" >
		<h4><?php echo $ami->prenom.' '.$ami->nom; ?></h4>
		<p>Amis depuis le <?php echo $ami->date; ?></p>
		<a href="#" class="message_amis">Envoyer un message</a>
	</div><?php endforeach; ?>