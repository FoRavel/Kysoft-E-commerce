<!DOCTYPE html>
<html>
<head>
	<title>Le produit</title>
	<meta charset="utf-8"/>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<?php 
	include("navbar.php");
	$con = mysqli_connect("localhost", "root", "", "kysoft");
	$req = "SELECT ref_produit, nom_produit, prix_unitaire_ht, description
							FROM produit WHERE ref_produit = ?";
	$res = mysqli_prepare($con, $req);
	mysqli_stmt_bind_param($res, "i", $_GET["ref"]);
	mysqli_stmt_execute($res);
	mysqli_stmt_bind_result($res, $ref, $nomProduit, $prixUnitaire, $description);
	mysqli_stmt_fetch($res);
	?>
	<div class="container">
		<div class='row'>
			<div class="col-lg-12">
				<div class="panel panel-default">		
					<div class="panel-heading">
						<div class="row">
							<div class="col-lg-3">
								<h2 class="panel-title"><a href="leproduit.php?ref=<?php echo $ref; ?>&nom=<?php echo $nomProduit ;?>"><?php echo $nomProduit; ?></a></h2> 
							</div>
							<div class="col-lg-offset-7 col-lg-2">
								<span><?php echo $prixUnitaire; ?></span>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class='col-lg-12'>
								<?php echo $description; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<hr>
				<h4>Commentaires</h4>
			</div>
		</div>	
	</div>


	
</body>
</html>
