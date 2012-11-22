<div id="centre">
        <?php
        foreach($actualite as $actu):?>
        <div>
        <img src="<?php echo base_url().IMG_DIR; ?>/membre/<?php echo $actu->photo; ?>" width="50px" />
        <p style="display:inline-block">
            <?php 
            switch ($actu->type) {
                case 1:
                    echo 'C\'est l\'anniversaire de <a href="'.site_url('profil/voir').'/'.$actu->login.'" title="Voir le profil" style="color:black">'.$actu->login.'</a> aujourd\'hui ! Lui envoyer un message';
                    break;
                case 2:
                    echo '<a href="'.site_url('profil/voir').'/'.$actu->login.'" title="Voir le profil" style="color:black">'.$actu->login.'</a> ajouté un nouvel événement à son agenda. Voir son agenda';
                    break;
                case 3:
                    echo 'Inscription de <a href="'.site_url('profil/voir').'/'.$actu->login.'" title="Voir le profil" style="color:black">'.$actu->login.'</a>. Lui souhaiter la bienvenue';
                    break;
                default:
                    # code...
                    break;
            }
            ?>
            <br/>
            <span><?php echo $actu->date; ?></span>
        </p>
    </div>
        <?php
        endforeach;
        ?></div>