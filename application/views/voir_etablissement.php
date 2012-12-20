<div id="centre" 
        data-id="<?php echo $id_lieu; ?>"
        data-info="<?php echo $nom.', '.$ville ?>">
	<h3><?php echo $nom; ?></h3>
	<div id="info_lieu">
		<img class="apercu_lieu" src="<?php echo base_url().IMG_DIR.'/etablissement/'.$photo;?>" />
		<p class="desc_lieu">
			<?php if(empty($information)){echo 'Aucune description';}else{echo $information;}
			echo '<br/>'.$adresse.' à '.$ville; ?><br/>
			Ouvert tous les jours de <?php echo $horaire; ?><br/>
			Fermé le <?php echo $fermeture; ?>
		</p><?php
        if($this->session->userdata('logged_in')){
            echo anchor('agenda/ajouter/lieu/'.$id_lieu,'Ajouter à l\'agenda','title="Prévoir une sortie à cet endroit" class="ajout"');
        }
    ?>
    </div>
    <h4>Photo</h4>
    <div id="photo_lieu">
    	<?php
    	if(empty($galerie)){
    		echo "<p>Aucune photo</p>";
    	}
    	else{
	    	foreach ($galerie as $photo):?>
	    	<img title="Photo postée par <?php echo $photo->membre; ?>" src="<?php echo base_url().IMG_DIR.'/etablissement/'.$photo->photo; ?>" alt="" width="100px" height="100px"	/>
	    	<?php
	    	endforeach;
	    }
    	?>
    </div>
    <h4>Itinéraire</h4>
	<div id="bigmap" data-position="<?php echo $position['lat'].','.$position['lon']; ?>" data-destination="<?php echo $lat.','.$lon; ?>">
	Problème lors du chargement de la carte
	</div>
	<h4>Commentaire</h4>
	<div id="commentaire">
		Aucun commentaire
		<form method="post" action="#">
			<fieldset>
				<textarea cols="125" rows="10"></textarea>
				<input type="submit" value="Ajouter le commentaire" />
			</fieldset>
		</form>
	</div>
<?php $this->load->view('include/ajouter_agenda'); ?>
</div>