<!DOCTYPE HTML>
<html lang="fr-BE">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().CSS_DIR;?>/style.css" media="screen" />
	<title>Accueil | Agenda</title>
</head>
<body>
	<div id="conteneur">
		<header>
			<h1>
				<?php echo anchor(base_url(), 'Agenda', 'title="Page d\'accueil"'); ?>
			</h1>
		</header><nav>
			<ul><li>
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
						<?php echo anchor('member/inscription','Inscription','title="Me créer un compte" class="pop"'); ?>
					</li>
				<?php endif; ?>
			</ul>
		</nav>
		<?php if(!$this->session->userdata('logged_in')): ?>
		<div id="intro"></div><?php echo $connexion; ?>
		</div>
	<?php endif; ?><div id="full">
			<h2>Les prochains évênements</h2>
			<div class="sujet">
				<h3>Concert et Théâtre</h3>
				<div class="recent">
					<h4>Soirée Halloween</h4><img src="http://placehold.it/100x100"/>
					<div><p>Description du lieu, description du lieu, description du lieu, description du lieu</p><p>n°, rue de nulpart, description du lieu, description<br/>Liège</p>
					<a href="#" class="ajout">Ajouter à l'agenda</a>
					</div>
				</div><div class="recent">
					<h4>Soirée Halloween</h4>
					<img src="#"/>
					<div><p>Description du lieu, description du lieu, description du lieu, description du lieu</p><p>n°, rue de nulpart, description du lieu, description<br/>Liège</p>
					<a href="#" class="ajout">Ajouter à l'agenda</a>
					</div>
				</div>
			</div>
			<div class="sujet">
				<h3>Musée et Culture</h3>
				<div class="recent">
					<h4>Soirée Halloween</h4>
					<img src="#"/>
					<div><p>Description du lieu, description du lieu, description du lieu, description du lieu</p><p>n°, rue de nulpart, description du lieu, description<br/>Liège</p>
					<a href="#" class="ajout">Ajouter à l'agenda</a>
					</div>
				</div><div class="recent">
					<h4>Soirée Halloween</h4>
					<img src="#"/>
					<div><p>Description du lieu, description du lieu, description du lieu, description du lieu</p><p>n°, rue de nulpart, description du lieu, description<br/>Liège</p>
					<a href="#" class="ajout">Ajouter à l'agenda</a>
					</div>
				</div>
			</div>
		</div>
		<footer>© Bekaert Ludovic</footer>
	</div>
	<div id='overlay'></div>
		<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDp9rhTUfZDGTY4p6X0JCxL2tHt8KKk1Y0&sensor=false"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
		<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
		<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
		<script src="<?php echo base_url().JS_DIR; ?>/script.js"></script>
</body>
</html>