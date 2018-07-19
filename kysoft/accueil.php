<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
	<title>Accueil</title>
	<meta charset="utf-8"/>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
<?php
	include("navbar.php");
?>
	<div class="container">
		<h3>Accueil</h3>
		<div class="row">
			<form method="GET" action="produit.php" class="col-lg-3">
			<div class="well well-lg">
				<h4>Trouver des produits</h4>
					<!-- Catégories -->
					<div class="form-group">
					<label for="categorie" class="sr-only">Catégorie:</label>
					<select name="categorie" id="categorie" class="form-control input-lg">
					<option value="" disabled selected>Catégorie</option>
					<?php
					$con = mysqli_connect("localhost", "root", "", "kysoft");
					$req = "SELECT C.no_categorie, C.nom_categorie FROM categorie C";
					$res = mysqli_query($con, $req);
					while($ligne = mysqli_fetch_array($res))
					{
						echo "<option value=".$ligne['no_categorie'].">".$ligne['nom_categorie']."</option>";
					}
					mysqli_close($con);
					?>
					</select>
					</div>
					<!-- Sous-Catégories -->
					<div class="form-group">
					<label for="sousCategorie" class="sr-only">Sous-Catégorie</label>
					<select name="sousCategorie" id="sousCategorie" class="form-control input-lg">
					<option value="" disabled selected>Sous-Categorie</option>
					<?php
					$con = mysqli_connect("localhost", "root", "", "kysoft");
					$req2 = "SELECT SC.no_sous_categorie, SC.nom_sous_categorie FROM sous_categorie SC";
					$res2 = mysqli_query($con, $req2);
					while($ligne2 = mysqli_fetch_array($res2))
					{
						echo "<option value=".$ligne2['no_sous_categorie'].">".$ligne2['nom_sous_categorie']."</option>";
					}
					mysqli_close($con);
					?>
					</select>
					</div>
					<input class="btn btn-primary" type="submit" value="Rechercher" id="submit"/>
				</div>
			</form>
			<div class="col-lg-6">
				
			</div>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script>
	$("#categorie").on("change", function(e)
	{
		$.post
		(
			"trt_ajax/ajax_trt_accueil.php",
			{
				noCategorie : $("#categorie").val()
			},
			function(data)
			{
				$("#sousCategorie").html(data);
			},
			"text"
		);
	});
	</script>
	
</body>
</html>
<!-- Cette page contient 2 listes déroulantes: Catégorie et sous-catégorie. Lorsque l'utilisateur valide ses choix il est redirigé vers la page produit.php .
	 Le formulaire transmet les numéros de catégories et sous-catégories qui permettront d'affiner l'affichage des produits sur produit.php