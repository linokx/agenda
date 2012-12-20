<div id="centre">
<?php
foreach($messages as $message):
	?>
    <div>
        <a style="display:inline-block" href="<?php echo site_url().'membre/'.$message->login; ?>">
            <img src="<?php echo base_url().'/'.IMG_DIR; ?>/membre/<?php echo $message->photo; ?>" width="40px" />
        </a>
        <p style="display:inline-block"><?php echo $message->message; ?></p>
        <span style="float:right" title="<?php echo date('d/m/Y',strtotime($message->date)); ?>"><?php echo date('H:i',strtotime($message->date)); ?></span>
	</div>
    <?php
endforeach;
?>
    <div>
    	<form id="message" action="<?php echo site_url().'message/ajouter/'.$correspondant; ?>" method="post">
    		<fieldset>
    			<textarea cols='90' rows="8" name="message"></textarea>
                <input name="id_convers" type="hidden" value="<?php echo $message->id_convers; ?>">
    			<input type="submit" value="Envoyer" class="bouton"/>
    		</fieldset>
    	</form>
    </div>
</div>