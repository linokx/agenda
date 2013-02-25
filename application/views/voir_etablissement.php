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
    <h4>Photo <?php echo ($galerie) ? '('.count($galerie).')':'';?></h4>
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
    	<a href="ajouterPhoto" style="color:#000; float:right">Ajouter des photos</a>
    	<form action="http://localhost/agenda/etablissement/ajouterPhoto" accept-charset="utf-8" method="post" enctype="multipart/form-data">
	<input type="hidden" name="id_lieu" value="<?php echo $this->uri->segment(2); ?>">
<input type="file" name="image" value="" id="image">
<input type="submit" name="" value="Ajouter la photo">
</form>
    </div>
    <h4>Itinéraire</h4>
	<div id="bigmap" data-position="<?php echo $position['lat'].','.$position['lon']; ?>" data-destination="<?php echo $lat.','.$lon; ?>">
	Problème lors du chargement de la carte
	</div>
	<h4>Commentaire <?php echo ($comments) ? '('.count($comments).')':'';?></h4>
	<div id="commentaire">
		<?php 
			if(empty($comments)){
				echo "<p>Aucun commentaire</p>";
			}
			else{
				foreach ($comments as $comment) {
					?>
					<div><img src="<?php echo base_url().'/'.IMG_DIR; ?>/membre/<?php echo $comment->photo;?>" width="50" height="50">
						<?php echo 'Posté par '.$comment->login.'<br/>'.$comment->content; ?></div>
					<?php
				}
			}
			?>
		<form method="post" action="">
			<fieldset>
				<textarea rows="10" name="comment"></textarea>
				<input type="submit" value="Ajouter le commentaire" />
			</fieldset>
		</form>
	</div>
</div>
<?php $this->load->view('include/ajouter_agenda'); ?>