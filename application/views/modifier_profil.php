<div id="centre">
<?php

	$pseudo  	= array('name' => 'pseudo',	'id' => 'pseudo',	'value' => $login);
	$nom 		= array('name' => 'nom',	'id' => 'nom', 		'value' => $nom);
	$prenom  	= array('name' => 'prenom',	'id' => 'prenom', 	'value' => $prenom);
	$mail	 	= array('name' => 'mail',	'id' => 'mail', 	'value' => $mail);
	$num_adresse= array('name' => 'num',	'id' => 'num',		'value' => $num);
	$rue 		= array('name' => 'rue',	'id' => 'rue',		'value' => $adresse);
	$jour 		= array();
	for($i=1;$i<=31;$i++){
		$jour[$i] = $i;
	}
	$pays	= array(
          			'1' => 'Belgique',
          			'2' => 'France',
          			'3' => 'Luxembourg',
          			'4' => 'Royaume-Uni'
        		);

	echo form_open_multipart('profil/modifier',array('method'=>'post'));

	echo form_label('Pseudo','pseudo').form_input($pseudo).'<br />';
	echo form_label('Nom','nom').form_input($nom).'<br />';
	echo form_label('Prénom ','prenom').form_input($prenom).'<br />';
	echo form_label('Mail ','mail').form_input($mail).'<br />';
	echo form_label('Date de naissance ','jour').form_dropdown('jour', $jour, $naissance, 'id="jour"').'<br/>';
	echo form_label('Adresse ','adresse').form_input($num_adresse).form_input($rue).'<br />';
	echo form_label('Pays ','pays').form_dropdown('pays', $pays, $id_pays, 'id="pays"').'<br/>';
	echo form_label('Photo','photo').'<br/>';
	?>
    <img src="<?php echo base_url().'/'.IMG_DIR; ?>/membre/<?php echo $photo; ?>" width="100px" style="border:2px gray solid"/>
    <?php 

	echo form_upload(array('name'=>'photo','id'=>'photo')).form_submit('check','Mettre à jour le profil');
	echo form_close();
?>
</div>