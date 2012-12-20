<div class="sousmenu">
<p>
    <?php echo anchor('agenda', 'Afficher mon agenda', 'title="Voir mon agenda"'); ?><br/>
    <?php echo anchor('agenda/voir', 'Voir l\'agenda d\'un ami', 'title="Agenda d\'un ami"'); ?><br/>
    <?php echo anchor('agenda/croiser', 'Croiser les agendas', 'title="Superposer plusieurs agendas"'); ?>
</p>
<form method="get" action="index.php" id="liste_amis">
	<?php
    $semaine = (isset($_GET['w']))?$_GET['w'] : date('W');
	$annee = (isset($_GET['y']))?$_GET['y'] : date('Y'); ?>	
    <input type="hidden" name="w" value="<?php echo $semaine; ?>" />
    <input type="hidden" name="y" value="<?php echo $annee; ?>" />
    <?php if(count($amis)): ?>
    <select name="id_membre">
        <option value="">-------------</option>
        <?php foreach($amis as $ami): ?>
            <option <?php echo "value='".$ami->login."'"; ?>>
                <?php echo $ami->prenom.' '.$ami->nom; ?>
            </option>
        <?php endforeach; ?>
    </select>
<?php endif; ?>
    <input type="submit" value="Voir l'agenda" />
</form>
<p><?php echo anchor('agenda/ajouter', 'Ajouter un évênement', 'title="Nouvel évênement" class="pop"'); ?></p>
</div>