<div id="connexion"><div id="fb-root"></div>
  <script>
    window.fbAsyncInit = function() {
      FB.init({
        appId      : '394296693978717', // App ID
        status     : false, // check login status
        cookie     : true, // enable cookies to allow the server to access the session
        xfbml      : true  // parse XFBML
      });
    };

    // Load the SDK Asynchronously
    (function(d){
      var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
      js = d.createElement('script'); js.id = id; js.async = true;
      js.src = "//connect.facebook.net/en_US/all.js";
      d.getElementsByTagName('head')[0].appendChild(js);
    }(document));
  </script>
		<?php
			echo form_open('member/login',array('method'=>'post'));
			echo form_fieldset('');
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
			echo form_password($mdpInput);
			$data = array(
    			'name'        => 'remember',
    			'id'          => 'remember',
    			'value'       => 'accept',
    			'checked'     => TRUE,
    		);
			echo form_checkbox('remember', 'accept', TRUE);
			echo form_label('Se souvenir de moi','remember').'<br />';
			echo anchor('membre/mdp','Mot de passe oublié', 'title="Retrouver le mot de passe"');
			echo form_fieldset_close(); 
			echo form_fieldset('','id=social');
			echo 'Se connecter avec';
			?>
  <fb:login-button show-faces="true" width="200" max-rows="1" scope="publish_actions">
  </fb:login-button>
			<a href="https://www.facebook.com/dialog/oauth?
			client_id=394296693978717
			&redirect_uri=http%3A%2F%2Flettrage-bekaert.eu%2Fagenda
  			&scope=user_birthday
  			&response_type=token">Facebook</a>

  			
			<?php
			echo form_fieldset_close(); 
			echo form_fieldset('','id=envoi');
			echo form_submit('check','Connexion');
			echo '<span style="font-size:14px;margin:0 12px;padding:10px 0;display:inline-block">ou</span>';
			echo anchor('member/inscription','Me créer un compte','title="Créer un compte en 2 minutes" class="pop"');
			echo form_fieldset_close(); 
			echo form_close();
		?>
	</div>