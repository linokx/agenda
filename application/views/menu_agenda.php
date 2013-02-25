<div class="sousmenu">
<p>
    <?php echo anchor('agenda', lang('ag_show'), 'title="'.lang('ag_show_title').'"'); ?><br/>
    <?php echo anchor('agenda/voir', lang('ag_show_friend'), 'title="Agenda d\'un ami"'); ?><br/>
    <?php echo anchor('agenda/croiser', lang('ag_mix'), 'title="Superposer plusieurs agendas"'); ?>
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
<p><?php echo anchor('agenda/ajouter', lang('ag_add'), 'title="Nouvel évênement" class="pop"'); ?></p>
</div>