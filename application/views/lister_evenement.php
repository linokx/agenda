<div id="accueil">
    <h2>Les prochains évênements</h2>
    <div class="sujet">
        <h3>Concert et Théâtre</h3>
        <?php
        foreach($lieux as $lieu):?>
            <div class="recent">
                <h4><?php echo $lieu->nom; ?></h4>
                <img src="http://placehold.it/100x100"/>
                <div>
                    <p><?php echo $lieu->description; ?></p>
                    <p><?php echo $lieu->adresse; ?><br/><?php echo $lieu->ville; ?></p>
                <?php
                if($this->session->userdata('logged_in')){
                    echo anchor('agenda/ajouter/lieu/'.$lieu->id_lieu,'Ajouter à l\'agenda','title="Prévoir une sortie à cet endroit" class="ajout"');
                }
                ?> 
                </div>
            </div>
        <?php
        endforeach;
        ?>
    </div>
</div> 