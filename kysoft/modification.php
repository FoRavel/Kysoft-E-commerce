<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
	<title>Modification produit</title>
	<meta charset="utf-8"/>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
include("navbar.php"); 
$con = mysqli_connect("localhost", "root", "", "kysoft");
$req ="SELECT C.no_categorie, C.nom_categorie FROM categorie C";
$res = mysqli_query($con,$req);
$req2 = "SELECT SC.no_sous_categorie, SC.nom_sous_categorie FROM sous_categorie SC";
$res2 = mysqli_query($con,$req2);
$req3 = "SELECT no_marque, nom_marque FROM marque";
$res3 = mysqli_query($con,$req3);

$req4 = "SELECT P.ref_produit, P.nom_produit, P.prix_unitaire_ht, P.description, P.no_categorie, P.no_sous_categorie, P.no_marque
						 FROM produit P
						 WHERE ref_produit = ?";
$res4 = mysqli_prepare($con, $req4);
mysqli_stmt_bind_param($res4, "i", $_GET["ref"]);						 
mysqli_stmt_execute($res4);
mysqli_stmt_bind_result($res4, $ref, $nomProduit, $prix, $description, $noCategorie, $noSousCategorie, $noMarque);
mysqli_stmt_fetch($res4);

?>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1>Modification de produit</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<div class="well well-lg">
					<form method="POST" action="trt_modification.php?ref=<?php echo $ref;?>">
						<div id="refError" class="form-group">
							<label for="reference" class="sr-only">Réf Produit</label>
							<input type="text" value="<?php echo $ref ;?>" name="ref" id="ref" class="form-control" placeholder="Référence"/>
						</div>
						<div id="nomError" class="form-group">
							<label for="nomProduit" class="sr-only">Nom Produit</label>
							<input type="text" value="<?php echo $nomProduit;?>" name="nomProduit" id="nomProduit" class="form-control" placeholder="Libellé"/>
						</div>
						<div id="prixError" class="form-group">
							<label for="prix" class="sr-only">Prix Unitaire HT</label>
							<input type="number" value="<?php echo $prix;?>" name="prix" id="prix" class="form-control" placeholder="Prix unitaire H.T"/>
						</div>
						<div  id="marqueError" class="form-group">
							<label for="marque" class="sr-only">Marque</label>
							<select name="marque" id="marque" class="form-control">
							<?php

							while($ligne3 = mysqli_fetch_array($res3))
							{
								if($ligne3['no_marque'] == $noMarque)
								{
									echo "<option value=".$ligne3['no_marque']." selected>".$ligne3['nom_marque']."</option>";
								}
								else
								{
									echo "<option value=".$ligne3['no_marque'].">".$ligne3['nom_marque']."</option>";
								}
							}
							?>
							</select>
						</div>
						<div id="catError" class="form-group">
							<label for="categorie" class="sr-only">Catégorie</label>
							<select name="categorie" id="categorie" class="form-control">
							<option value="" disabled selected>Catégorie</option>
							<?php
							while($ligne = mysqli_fetch_array($res))
							{
								if($ligne["no_categorie"] == $noMarque)
								{
									echo "<option value=".$ligne['no_categorie']." selected>".$ligne['nom_categorie']."</option>";
								}
								else
								{
									echo "<option value=".$ligne['no_categorie'].">".$ligne['nom_categorie']."</option>";
								}
							}
							?>
							</select>
						</div>
						<div id="sousCatError" class="form-group">
							<label for="sousCategorie" class="sr-only">Sous-catégorie</label>
							<select name="sousCategorie" id="sousCategorie" class="form-control">
							<option value="" disabled selected>Sous-Categorie</option>
								<?php
								while($ligne2 = mysqli_fetch_array($res2))
								{
									if($data2["no_sous_categorie"] == $noMarque)
									{
										echo "<option value=".$ligne2['no_sous_categorie']." selected>".$ligne2['nom_sous_categorie']."</option>";
									}
									else
									{
										echo "<option value=".$ligne2['no_sous_categorie'].">".$ligne2['nom_sous_categorie']."</option>";
									}
								}
								?>
							</select>
						</div>
						<div id="descError" class="form-group">
							<label for="description" class="sr-only">Description</label>
							<textarea name="description" id="description" class="form-control"><?php echo $description;?></textarea>
						</div>
						<input type="submit" value="Envoyer" id="envoyer" class="btn btn-primary"/>
					</form>
				</div>
			</div>
			<div class="col-lg-3">
				<div id="styleErreur" class="" role="">
					<span id="msgErr"></span>
				</div>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>
$("#envoyer").on("click", function(e){
	$ref = $("#ref");
	$nom = $("#nomProduit");
	$prix = $("#prix");
	$desc = $("#description");
	$marque = $("#marque");
	$categorie = $("#categorie");
	$sousCate = $("#sousCategorie");
	if($ref.val()==""||$nom.val()==""||$prix.val()==""||$desc.val()==""||$categorie.val()==""||$sousCate.val()==""||$marque.val()=="")
	{
		e.preventDefault();
		$("#msgErr").html("<strong>Information(s) manquante(s):</strong><ul id=listErr></ul>");
		$("#styleErreur").addClass("alert alert-warning");
		if($ref.val() == "")
		{
			$("#refError").addClass("has-error");
			$("#listErr").append("<li>Référence du produit</li>");
		}
		if($nom.val() == "")
		{
			$("#nomError").addClass("has-error");
			$("#listErr").append("<li>Libellé</li>");
		}
		if($prix.val() == "")
		{
			$("#prixError").addClass("has-error");
			$("#listErr").append("<li>Prix hors taxe</li>");
		}
		if($marque.val()=="")
		{
			$("#marqueError").addClass("has-error");
			$("#listErr").append("<li>Marque</li>");
		}
		if($categorie.val()=="")
		{
			$("#catError").addClass("has-error");
			$("#listErr").append("<li>Categorie</li>");
		}
		if($sousCate.val()=="")
		{
			$("#sousCatError").addClass("has-error");
			$("#listErr").append("<li>Sous-categorie</li>");
		}
		if($desc.val() == "")
		{
			$("#descError").addClass("has-error");
			$("#listErr").append("<li>Descriptif</li>");
		}
		
	}
});
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
<!-- Lecture en base de donnée et affichage de la ligne du produit en fonction de sa référence. La référence est transmise depuis la page d'administration.
	 Les informations des champs sont affichées et pré-sélectionnées dans les champs de saisies de formulaire. Le formulaire cible la page trt_modification.php. Où les informations sont mises à jours.
	 AJOUT ULTERIEUR:
	 Ajouter ligne qui récapitule le produit.
	 
		