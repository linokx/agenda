
<?php
    foreach($lieux as $lieu):?>
        <div class="sortie" style="margin-bottom:15px; background-color:white;padding-bottom:10px"
        data-id="<?php echo $lieu->id_lieu; ?>"
        data-title="<?php echo $lieu->nom; ?>" 
        data-position="<?php echo $lieu->lat.','.$lieu->lon; ?>"
        data-info="<?php echo $lieu->nom.', '.$lieu->ville ?>">
            <h3>
                <?php echo $lieu->nom.' ('.$lieu->distance.')'; ?>
                <span>
                   <?php echo anchor('etablissement/voir/'.$lieu->id_lieu, 'Voir la fiche complète', array('title'=>"Info sur le lieu", 'class'=>'icon-right icon-big')); ?>
                </span>
            </h3>
            <img src="<?php echo base_url().IMG_DIR.'/etablissement/thumbnail/'.$lieu->photo;?>"/><p>
            <?php echo $lieu->information; ?><br />
            Ouvert tous les jours de <?php echo $lieu->horaire; ?><br />
            Fermé le <?php echo $lieu->fermeture; ?><br />
            <?php echo $lieu->adresse.' - '.$lieu->ville; ?><br/ >
            <i class="icon-location">Centrer sur la carte</i></p>
            <?php
                if($this->session->userdata('logged_in')){
                    echo anchor('agenda/ajouter/lieu/'.$lieu->id_lieu,'Ajouter à l\'agenda','title="Prévoir une sortie à cet endroit" class="ajout ajouter"');
                }
            ?>  
        </div>
    <?php
    endforeach;
    
echo $this->pagination->create_links();

$this->load->view('include/ajouter_agenda');
?>
<div id="localiser" style="display:none">
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