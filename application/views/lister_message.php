<div id="centre">
<?php
foreach($conversations as $info):
	?>
    <div>
		<a style="color:black" href="<?php echo site_url().'membre/'.$info->correspondant->login; ?>">
    		<img style="margin-right:5px" src="<?php echo base_url().'/'.IMG_DIR; ?>/membre/<?php echo $info->correspondant->photo; ?>" width="50" title="<?php echo $info->correspondant->prenom.' '.$info->correspondant->nom; ?>" />
		</a>
    	
    	<a  style="color:black; display:inline-block" href="message/<?php echo $info->correspondant->login; ?>">
            <b><?php echo $info->correspondant->prenom.' '.$info->correspondant->nom; ?></b><br/>
    		<span style="line-height:35px"><?php echo $info->message; ?></span>
    	</a>
    </div>
	<?php
endforeach;
?>
</div>