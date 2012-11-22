<div class="sousmenu">
<h3>Rechercher un lieu</h3>
<?php
            echo form_open('sortie',array('method'=>'post'));
            $rechercheInput = array(
                        'name' => 'mot',
                        'id' => 'mot',
                        'value' => $mot
                        );
            echo form_input($rechercheInput);
            
            echo form_submit('check','Rechercher');
            echo form_close();
        ?>
</div>
<div class="sousmenu">
<div id="minimap">
</div>

        <?php echo anchor('sortie/localiser', 'Changer ma position', array('title'=>"Modifier le point central", 'class'=>"bouton localiser")); ?>
</div>
<div class="sousmenu">
<h3>Filtres</h3>
<h4>Distance</h4>
<ul>
    <?php 
    foreach ($distances as $distance): ?>
    <li>
        <?php
        $class = "";
        if(isset($filtre['distance'])){
            if($filtre['distance'] == $distance['distance']){
                $class = 'class="active"';
            }
        }
        echo anchor('filtre/distance/'.$distance['distance'], $distance['texte'], 'title="Rayon de '.$distance['texte'].'km"'.$class);
    ?>
    </li>
    <?php endforeach; ?>
</ul>
<br>
<hr>
<h4>Type</h4>
<ul>
    <?php 
    foreach ($types as $type): ?>
    <li>
    <?php       
        $class = "";
        if(isset($filtre['type'])){
            if($filtre['type'] == $type['type']){
                $class = 'class="active"';
            }
        }
        echo anchor('filtre/type/'.$type['type'], $type['texte'], 'title="Rayon de '.$type['texte'].'"'.$class);
        ?>
    </li>
    <?php endforeach; ?>
</ul>
<br>
<hr>
<h4>Note minimum</h4>
<a>0</a>
<a>1</a>
</p>
</div>