<div id="accueil">
    <h2>Les prochains évênements</h2>
    <div class="sujet">
        <?php foreach($categories as $key=>$categorie):
            $nbre = 0; ?>
            <h3><?php echo $categorie; ?></h3>
            <?php
            foreach($lieux as $lieu):
                if($lieu->categorie == $key+1):
                    $nbre++;
                    ?>
                    <div class="recent">
                        <h4><?php echo $lieu->nom; ?></h4>
                        <img src="http://placehold.it/100x100"/>
                        <div>
                            <p><?php echo $lieu->description; ?></p>
                            <p><?php echo $lieu->adresse; ?><br/><?php echo $lieu->ville; ?></p>
                        <?php
                        if($this->session->userdata('logged_in')){
                            echo anchor('agenda','Ajouter à l\'agenda','title="Prévoir une sortie à cet endroit" class="ajout"');
                            //echo anchor('agenda/ajouter/lieu/'.$lieu->id_lieu,'Ajouter à l\'agenda','title="Prévoir une sortie à cet endroit" class="ajout"');
                        }
                        ?> 
                        </div>
                    </div>
                <?php
                endif;
            endforeach;
            if(!$nbre){
                echo '<p>Aucun evênement de prevu</p>';
            }
        endforeach;
        ?>
    </div>
</div> 