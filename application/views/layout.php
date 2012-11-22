<!DOCTYPE HTML>
<html lang="fr-BE">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().CSS_DIR;?>/style.css" media="screen" />
	<title><?php echo $main_title; ?></title>
	<style>
        .ui-effects-transfer { border: 2px dotted gray; }
    </style>
</head>
<body>
	<div id="conteneur">
		<header>
			<h1>
				<?php echo anchor(base_url(), 'Agenda', 'title="Page d\'accueil"'); ?>
			</h1>
		</header><nav>
			<ul>
				<li>
					<?php echo anchor(base_url(), 'Accueil', 'title="Page d\'accueil"'); ?>
				</li>
				<?php if($this->session->userdata('logged_in')): ?>
					<li>
						<?php echo anchor('agenda', 'Agenda', 'title="Voir mon emploi du temps"'); ?>
					</li>
				<?php endif; ?>
				<li><?php echo anchor('sortie', 'Sorties', 'title="Sorties dans les environs"'); ?>
				</li>
				<?php if($this->session->userdata('logged_in')): ?>
					<li><?php echo anchor('amis', 'Amis', 'title="Voir la liste de contact"'); ?>
					</li>
					<li><?php echo anchor('message', 'Message', 'title="Accéder à la messagerie"'); ?>
					</li>
					<li>Profil
						<ul>
							<li>
								<?php echo anchor('profil', 'Mon Profil', 'title="Voir mon profil"'); ?>
							</li>						
							<li>
								<?php echo anchor('member/logout', 'Deconnection', 'title="Me deconnecter"'); ?>
							</li>
						</ul>
					</li>
				<?php else: ?>
					<li>
						<?php echo anchor('member/inscription','Inscription',array('title'=>"Me créer un compte", 'class'=>"pop")); ?>
					</li>
				<?php endif; ?>
			</ul>
		</nav>
		<?php if(!empty($top_menu)): ?>

		    <h2>Dernieres actualités de vos amis</h2>
		    	<?php echo $top_menu; ?>
		<?php endif; ?>
		<?php if(!empty($menu)): ?>
			<div id="menu">
				<?php echo $menu; ?>
			</div><div id="content">
		<?php else: ?>
			<div id="full">
		<?php endif; ?>
			<?php echo $vue; ?>
		</div>
		<footer>© Bekaert Ludovic - <?php echo anchor('etablissement/proposer', 'Proposer un etablissement', array('title'=>"Voir mon profil")); ?></footer>
	</div>
	<div id='overlay'></div>
		<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
		<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
		<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDp9rhTUfZDGTY4p6X0JCxL2tHt8KKk1Y0&sensor=false"></script>
		<script src="<?php echo base_url().JS_DIR; ?>/script.js"></script>
</body>
</html>