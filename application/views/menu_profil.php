<div class="sousmenu profil">
    <h3><?php echo $info->prenom.' '.$info->nom; ?></h3>
    <img src="<?php echo base_url().'/'.IMG_DIR; ?>/membre/<?php echo $info->photo; ?>"/>
    <p>Célibataire<br />
        <?php echo $info->adresse; ?><br />
        Mouscron (Belgique)
    </p>

    <?php echo anchor('message/voir/'.$info->login, 'Envoyer un message', 'title="Envoyer un message à Ludovic" class="bouton"'); ?>
</div>
<div class="sousmenu amis">
    <h3>Amis (<?php echo count($amis); ?>)</h3>
    <?php foreach($amis as $ami): ?>
    <a href="<?php echo site_url().'/profil/voir/'.$ami->login; ?>">
        <img src="<?php echo base_url().'/'.IMG_DIR; ?>/membre/<?php echo $ami->photo; ?>" width="5px" title="<?php echo $ami->prenom.' '.$ami->nom; ?>" />
    </a>
    <?php endforeach; ?>
    <?php echo anchor('amis', 'Voir la liste entière', 'title="Voir tous les amis de Ludovic" style="display:block"'); ?>
</div>