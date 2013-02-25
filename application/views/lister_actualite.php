<h3><?php echo $titre; ?></h3>
<div id="actualite">
<?php
    foreach($actualite as $actu):?>
    <div>
    <p>
    <img src="<?php echo base_url().IMG_DIR; ?>/membre/<?php echo $actu->photo; ?>" width="35" />
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
        $duree = floor(time()-strtotime($actu->date));
            if($duree < 60){
                $texte_duree = $duree." secondes.";
            }
            elseif($duree/60 < 60){
                $texte_duree = floor($duree/60)." minutes.";
            }
            elseif($duree/3600 < 60){
                $texte_duree = floor($duree/3600)." heures";
            }
            elseif($duree/(3600*24) < 30){
                $texte_duree = floor($duree/(3600*24))." jours";
            }
            else{
                $texte_duree = floor($duree/(3600*24*30))." mois";
            }
        ?>
        <br/>
        <span title="<?php echo date('\L\e d/m à H:i:s', strtotime($actu->date)); ?>"><?php echo "Il y a ".$texte_duree; ?></span>
    </p>
</div>
    <?php
    endforeach;
    ?>
    <a href="#" class="suite">Voir la suite</a>
</div>