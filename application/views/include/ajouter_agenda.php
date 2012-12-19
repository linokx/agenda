<div id="ajouter" style="display:none"><?php

    $date_deb   = array('name' => 'date_deb',   'id' => 'date_deb');
    $heure_deb  = array('name' => 'heure_deb',  'id' => 'heure_deb');
    $date_fin   = array('name' => 'date_fin',   'id' => 'date_fin');
    $heure_fin  = array('name' => 'heure_fin',  'id' => 'heure_fin');
    $lieu       = array('name' => 'lieu',       'id' => 'lieu');
    $id_lieu    = array('name' => 'id_lieu',    'id' => 'id_lieu', 'type' => 'hidden');
    $descript   = array('name' => 'descript',   'id' => 'descript');
    $prive      = array('name' => 'prive',      'id' => 'prive');
    $types      = array(
                    '1' => 'Important',
                    '2' => 'Travail',
                    '3' => 'Anniversaire',
                    '4' => 'Loisir',
                    '5' => 'Réunion',
                    '6' => 'Autre'
                );
    $rappels    = array(
                    '0' => 'Aucun',
                    '1' => 'Un jour avant',
                    '2' => 'Deux jours avant',
                    '3' => 'Une semaine avant',
                    '4' => 'Deux semaines avant',
                    '5' => 'Un mois avant'
                );


    echo form_open('agenda/ajouter',array('method'=>'post'));
    echo form_fieldset('');
    echo form_label('Date de debut ','date_deb').form_input($date_deb).' à '.form_input($heure_deb).'<br />';
    echo form_label('Date de fin ','date_fin').form_input($date_fin).' à '.form_input($heure_fin).'<br />';
    echo form_label('Lieu ','lieu').form_input($lieu).'<br />';
    echo form_input($id_lieu);
    echo form_label('Type');
    foreach($types as $key=>$value){
        echo form_radio('type',$key,FALSE,'id="type'.$key.'" style="display:none"');
        echo form_label($value,'type'.$key);
    }
    echo '<br/>';
    echo form_label('Description ','descript').form_textarea($descript).'<br />';
    echo form_label('Rappel ','rappel').form_dropdown('rappel', $rappels, 'id="rappel"').'<br/>';
    echo form_label('Privé ','prive'). form_checkbox($prive);
    echo form_submit('check','Ajouter à l\'agenda');
    echo form_fieldset_close();
    echo form_close();
?>
</div>