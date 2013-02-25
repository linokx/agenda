<?php $this->lang->load('layout', $this->config->item('language')); ?>
<!DOCTYPE HTML>
<html lang="fr-BE">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().CSS_DIR;?>/style.css" media="screen" />
	<title><?php echo $main_title; ?></title>
	<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDp9rhTUfZDGTY4p6X0JCxL2tHt8KKk1Y0&sensor=false"></script>
	<script type="text/javascript" src="<?php echo base_url().JS_DIR; ?>/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url().JS_DIR; ?>/script.js"></script>
</head>
<body>
	<div id="bg_header">
		<header>
			<h1>
				<?php echo anchor(base_url(), 'Agenda', 'title="Page d\'accueil"'); ?>
			</h1>
		</header><nav>
			<ul>
				<li>
					<?php echo anchor(base_url(), lang('home'), 'title="Page d\'accueil"'); ?>
				</li>
				<li><?php echo anchor('sortie', lang('trip'), 'title="Sorties dans les environs"'); ?>
				</li>
				<?php if($this->session->userdata('logged_in')): ?>
					<li>
						<?php echo anchor('agenda', lang('agenda'), 'title="Voir mon emploi du temps"'); ?>
					</li>
				<?php endif; ?>
				<?php if($this->session->userdata('logged_in')): ?>
					<li><?php echo anchor('amis', lang('bloc'), 'title="Voir la liste de contact"'); ?>						
						<ul>
							<li>
								<?php echo anchor('#','Gérer ma liste d\'amis','title="Gérer ma liste d\'amis"'); ?>
							</li>		
							<li>
								<?php echo anchor('#', 'Carnet d\'adresse', 'title="Infos sur mes amis"'); ?>
							</li>
						</ul>
					</li>
					<li><?php echo anchor('message', lang('message'), 'title="Accéder à la messagerie"'); ?>
					</li>
					<li class="profil">
						<a href="profil" title="Voir mon profil">
							<img src="<?php echo base_url().'/'.IMG_DIR; ?>/membre/<?php echo $this->session->userdata('logged_in')->photo; ?>" width="36px" /> \/
						</a>
						<ul>
							<li>
								<?php echo anchor('profil/modifier','Paramètres du compte','title="Modifier mes informations"'); ?>
							</li>		
							<li>
								<?php echo anchor('member/logout', 'Deconnection', 'title="Me deconnecter"'); ?>
							</li>
						</ul>
					</li>
				<?php else: ?>
					<li>
						<?php echo anchor('inscription',lang('signup'),array('title'=>"Me créer un compte", 'class'=>"pop")); ?>
					</li>
				<?php endif; ?>
				<li>
					<a href="#">O\</a>
				</li>
			</ul>
		</nav>
	</div>
	<div id="conteneur">
		<?php if(!empty($top_menu)): ?>

		    <h2>Dernieres actualités de vos amis</h2>
		    	<?php echo $top_menu; ?>
		<?php endif; ?>
		<?php if(!empty($menu)): ?>
			<div id="menu">
				<?php echo $menu; ?>
			</div>
		<?php endif;?><div id="content">
			<?php echo $vue; ?>
		</div>
	</div>
	<footer>© Bekaert Ludovic - <?php echo anchor('etablissement/proposer', 'Proposer un etablissement', array('title'=>"Voir mon profil")); ?></footer>
	<div id='overlay'></div>
</body>
</html>