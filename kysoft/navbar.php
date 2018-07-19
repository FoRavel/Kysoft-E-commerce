		<div class="container">
			<div class="row">
				<div class="col-lg-12">
				<div class="page-header">
					<header class="jumbotron">			
							<h1>KYSOFT</h1>
							<h2>Vente de matériels informatiques</h2>		
					</header>
				</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<nav class="navbar navbar-default">
						<div class="navbar-header">
							<a class="navbar-brand" href="accueil.php">KYSOFT</a>
						</div>
						<ul class="nav navbar-nav">
							<li><a href="accueil.php">Accueil</a></li>
							<li><a href="produit.php">Produits</a></li>
							<li><a href="administration.php">Administration</a></li>			
						</ul>
						<ul class=" nav navbar-nav navbar-right">
						<?php 
						if(!ISSET($_SESSION["login"]) AND !ISSET($_SESSION["motDePasse"]))
						{
							echo "<li><a href='connexion.php'><span class='glyphicon glyphicon-user'></span> Se connecter</a></li>";
						}
						else
						{
							echo "<li><a href='deconnexion.php'><span class='glyphicon glyphicon-user'></span> Se Déconnecter</a></li>";
						}
						?>
						</ul>
					</nav>
				</div>
				<!--
				<footer class="navbar navbar-default navbar-fixed-bottom">
				<div class="container"><p>azaz</p></div>
				</footer>
				-->
			</div>
		</div>

	<!-- Page à afficher sur toutes les pages. Le lien de connexion s'affiche seulement s'il n'y a pas de variables de session en cours. Dans le cas contraire
	 c'est le lien de déconnexion qui s'affiche. -->
	 