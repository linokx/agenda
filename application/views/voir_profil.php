<?php var_dump($actualite); ?>

    <p style="text-align:right; height:40px;"><?php echo anchor('agenda/voir/1', 'Voir son agenda', 'title="Voir tous les amis de Ludovic" class="bouton"'); ?></p>
    <div id="centre">
	<h3>Dernières activités</h3>
	<?php for($i=0; $i<10; $i++):
			foreach($actualite as $actu): ?>
		<p></p>
	<?php endforeach;
	endfor; ?>
	</div>