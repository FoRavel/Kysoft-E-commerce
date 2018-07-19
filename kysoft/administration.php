<?php
session_start();
if(!ISSET($_SESSION["login"]) AND !ISSET($_SESSION["motDePasse"]))
	{
		die("Vous devez disposer d'un compte utilisateur pour accéder à cette page <a href='accueil.php'>Retour à l'accueil</a>");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Administration</title>
		<meta charset="utf-8"/>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
	<?php include("navbar.php"); 
	
	?>
	<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h3>Affichage de tous les produits</h3>
		</div>
	</div>
			<?php
			$con = mysqli_connect("localhost","root", "", "kysoft");
			$req = "SELECT P.ref_produit, P.nom_produit, P.prix_unitaire_ht, C.nom_categorie, SC.nom_sous_categorie, M.nom_marque 
								  FROM produit P, categorie C, sous_categorie SC, marque M
								  WHERE P.no_categorie = C.no_categorie
								  AND P.no_sous_categorie = SC.no_sous_categorie
								  AND P.no_marque = M.no_marque";
			$res = mysqli_query($con, $req);

			?>
			<div class="row">
				<div class="col-lg-12">
				<div class="form-group">
					
					<a class="btn btn-default" href="ajouter.php" role="button"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ajouter un produit</a>
					
				</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<table class="table table-striped">
						<tr>
							<td>REFERENCE</td>
							<td>LIBELLE</td>
							<td>PRIX UNITAIRE HT</td>
							<td>MARQUE</td>
							<td>CATEGORIE</td>
							<td>SOUS-CATEGORIE</td>
							<td>SUPPR/MODIF</td>
						</tr>
					<?php
					while($ligne = mysqli_fetch_array($res))
					{		
					?>
					<tr>
						<td><?php echo $ligne["ref_produit"] ?></td>
						<td><?php echo $ligne["nom_produit"] ?></td>
						<td><?php echo $ligne["prix_unitaire_ht"]?></td>
						<td><?php echo $ligne["nom_marque"]?></td>
						<td><?php echo $ligne["nom_categorie"]?></td>
						<td><?php echo $ligne["nom_sous_categorie"]?></td>
						<td><a id="supprimer" href="suppression.php?ref=<?php echo $ligne['ref_produit'] ?>">Supprimer</a> <a href="modification.php?ref=<?php echo $ligne['ref_produit'];?>">Modifier</a></td>
					</tr>
					<?php
					}
					?>
				</table>
				</div>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script>
		$("#supprimer").on("click", function(e)
		{
			if(!confirm("Confirmer la suppression?"))
			{
				e.preventDefault();
			}
		});
		</script>
	</body>
</html>