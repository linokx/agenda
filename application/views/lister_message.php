<div id="centre">
        <?php
        foreach($messages as $message):?>
        <div>
        
    <img src="<?php echo base_url().'/'.IMG_DIR; ?>/membre/<?php echo $message->photo; ?>" width="50px" />
        <p><?php echo $message->message; ?></p>
    </div>
        <?php
        endforeach;
        ?></div>