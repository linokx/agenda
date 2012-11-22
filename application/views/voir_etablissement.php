<div id="centre" 
        data-id="<?php echo $id_lieu; ?>"
        data-info="<?php echo $nom.', '.$ville ?>">
	<h3><?php echo $nom; ?></h3>
	<img class="apercu_lieu" src="<?php echo base_url().IMG_DIR.'/etablissement/'.$photo;?>" />
	<p class="desc_lieu"><?php if(empty($information)){echo 'Aucune description';}else{echo $information;} ?></p>
	<p>
		<?php echo $adresse.' à '.$ville; ?>
	</p>
	<p>
		Ouvert tous les jours de <?php echo $horaire; ?><br/>
		Fermé le <?php echo $fermeture; ?>
	</p><?php
                if($this->session->userdata('logged_in')){
                    echo anchor('agenda/ajouter/lieu/'.$id_lieu,'Ajouter à l\'agenda','title="Prévoir une sortie à cet endroit" class="bouton ajouter"');
                }
            ?>  
	<div id="bigmap" data-position="<?php echo $position['lat'].','.$position['lon']; ?>" data-destination="<?php echo $lat.','.$lon; ?>">
	</div>
<?php $this->load->view('include/ajouter_agenda'); ?>
</div>