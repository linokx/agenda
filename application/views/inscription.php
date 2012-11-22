<div id="popup">
		<?php
			echo form_open('member/inscription',array('method'=>'post'));
			echo form_fieldset('');
			echo form_label('Choix du login');
			$loginInput = array(
						'name' => 'nom',
						'id' => 'nom'
						);
			echo form_input($loginInput);
			echo '<br />';
			$mdpInput = array(
						'name' => 'mdp',
						'id' => 'mdp'
						);
			echo form_label('Choix du mot de passe');
			echo form_password($mdpInput);
			$data = array(
    			'name'        => 'remember',
    			'id'          => 'remember',
    			'value'       => 'accept',
    			'checked'     => TRUE,
    		);
			echo form_fieldset_close(); 
			echo form_fieldset('','id=social');
			echo 'Se connecter avec';
			echo form_fieldset_close(); 
			echo form_fieldset('','id=envoi');
			echo form_submit('check','M\'inscrire !');
			echo form_fieldset_close(); 
			echo form_close();
		?>
	</div>