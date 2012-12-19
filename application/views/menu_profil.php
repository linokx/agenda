<div class="sousmenu profil">
    <h3><?php echo $info->prenom.' '.$info->nom; ?></h3>
    <img src="<?php echo base_url().'/'.IMG_DIR; ?>/membre/<?php echo $info->photo; ?>"/>
    <p>Célibataire<br />
        <?php echo $info->adresse; ?><br />
        Mouscron (Belgique)
    </p>

    <?php echo anchor('message/'.$info->login, 'Envoyer un message', 'title="Envoyer un message à Ludovic" class="bouton"'); ?>
</div>
<div class="sousmenu amis">
    <h3>Amis (<?php echo count($amis); ?>)</h3>
    <?php
    if(empty($amis)):
        echo '<p>'.$info->login.' n\'a encore aucun ami dans sa liste</p>';
    else:
        foreach($amis as $ami): ?>
            <a href="<?php echo site_url().'membre/'.$ami->login; ?>">
                <img src="<?php echo base_url().'/'.IMG_DIR; ?>/membre/<?php echo $ami->photo; ?>" width="5px" title="<?php echo $ami->prenom.' '.$ami->nom; ?>" />
            </a>
            <?php
        endforeach; 
        echo anchor('amis/'.$info->login, 'Voir la liste entière', 'title="Voir tous les amis de '.$info->prenom.'" style="display:block"');
    endif;?>
</div>