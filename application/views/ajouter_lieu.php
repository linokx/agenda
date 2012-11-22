<div id="popup">
	<?php
	echo 	form_open_multipart('',array('class'=>'ajout_lieu','method'=>'post'));
	echo 	form_fieldset('Information principale');
	echo 	form_label('Nom de l\'etablissement','nom').form_input(array('name'=>'nom','id'=>'nom')).'<br/>'.
			form_label('Adresse','adresse').form_input(array('name'=>'adresse','id'=>'adresse')).'<br/>'.
			form_label('Ville','ville').form_input(array('name'=>'ville','id'=>'ville')).'<br/>'.
			form_label('Pays','pays').form_dropdown('pays',array('1'=>'Belgique','2'=>'France')).
			form_input(array('name'=>'lat','id'=>'lat','value'=>'0','type'=>'hidden')).
			form_input(array('name'=>'lon','id'=>'lon','value'=>'0','type'=>'hidden'));
	?>
	<?php
	echo form_fieldset_close();
	echo form_fieldset('Information complémentaire');
	echo 	form_label('Description','information').form_textarea(array('name'=>'information','id'=>'information')).'<br/>'.
			form_label('Type','type').form_dropdown('type',array(	'1'=>'Bar et Club',
										'2'=>'Concert et Spectacle',
										'3'=>'Détente',
										'4'=>'Musée et Culture',
										'5'=>'Casino et Adulte',
										'6'=>'Sport'
									)).'<br/>'.
			form_label('Horaire','horaire').form_textarea(array('name'=>'horaire','id'=>'horaire')).'<br/>'.
			form_label('Fermeture','fermeture').form_textarea(array('name'=>'fermeture','id'=>'fermeture')).'<br/>'.
			form_label('Site web','site').form_input(array('name'=>'site','id'=>'site')).'<br/>'.
			form_label('Image','image').form_upload(array('name'=>'image','id'=>'image')).'<br/>'.
			form_submit('','Proposer l\'établissement');
	echo form_fieldset_close();
	echo form_close();
	?>
</div>