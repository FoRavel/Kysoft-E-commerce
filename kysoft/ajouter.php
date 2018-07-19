<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
	<title>Ajout produt</title>
	<meta charset="utf-8"/>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
include("navbar.php"); 
//echo $_GET["notif"];
?> 
<div class="container">
	<h1>Ajout produit</h1>
	<div class="row">
		<div class="col-lg-4">
			<div class="well well-lg">
				<form method="POST" action="trt_ajout.php">
					<div id="refError" class="form-group">
						<label for="reference" class="sr-only">Réf Produit</label>
						<input type="text" name="ref" id="ref" class="form-control" placeholder="Référence"/>
					</div>
					<div id="nomError" class="form-group">
						<label for="nomProduit" class="sr-only">Nom Produit</label>
						<input type="text" name="nomProduit" id="nomProduit" class="form-control" placeholder="Libellé du produit"/>
					</div>
					<div id="prixError" class="form-group">
						<label for="prix" class="sr-only">Prix Unitaire HT</label>
						<input type="number" name="prix" id="prix" class="form-control" placeholder="Prix hors taxe"/>
					</div>
					<div id="marqueError" class="form-group">
						<label for="marque" class="sr-only">Marque</label>
						<select name="marque" id="marque" class="form-control">
						<option value="" disabled selected>Marque</option>
						<?php
						$con = mysqli_connect("localhost", "root", "", "kysoft");
						$req3 = "SELECT no_marque, nom_marque FROM marque";
						$res3 = mysqli_query($con, $req3);
						while($ligne3 = mysqli_fetch_array($res3))
						{
							echo "<option value=".$ligne3['no_marque'].">".$ligne3['nom_marque']."</option>";
						}
						mysqli_close($con);
						?>
						</select>
					</div>
					<div id="catError" class="form-group">
						<label for="categorie" class="sr-only">Catégorie</label>
						<select name="categorie" id="categorie" class="form-control">
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
					<div id="sousCatError" class="form-group">
						<label for="sousCategorie" class="sr-only">Sous-catégorie</label>
						<select name="sousCategorie" id="sousCategorie" class="form-control">
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
					<div id="descError"class="form-group">
						<label for="description" class="sr-only">Description</label>
						<textarea name="description" id="description" class="form-control" placeholder="Descriptif du produit"></textarea>
					</div>
					<input type="submit" value="Ajouter le produit" id="envoyer" class="btn btn-primary"/>
				</form>
			</div>
		</div>
	
	<div class="col-lg-3">
		<div id="styleErreur" class="" role="">
			<span id="msgErr"></span>
		</div>
	</div>
	<div class="col-lg-3">
		<div id="styleErreurFormat" class="" role="">
			<span id="msgErrFrmt"></span>
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
	$marque = $("#marque");
	$categorie = $("#categorie");
	$sousCate = $("#sousCategorie");
	$desc = $("#description");
	$regexPrix = /^([0-9]+\.[0-9]{2})?$/;
	//$regexNom 
	//$regexRef
	//$regexDesc
	if($ref.val()==""||$nom.val()==""||$prix.val()==""||$marque.val()==""||$categorie.val()==""||$sousCate.val()==""||$desc.val()=="" || $myRegex.test($prix.val()) == false)
	{
		e.preventDefault();
		$("#msgErr").html("<strong>Information(s) manquante(s):</strong><ul id=listErr></ul>");
		$("#styleErreur").addClass("alert alert-warning");
		$("#msgErrFrmt").html("<strong>Format incorrect pour les informations suivantes:</strong><ul id=listErrFrmt></ul>");
		$("#styleErreurFormat").addClass("alert alert-warning");
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
		if($prix.val() == "" || $regexPrix.test($prix.val()) == false)
		{
			if($prix.val() == "")
			{
				$("#prixError").addClass("has-error");
				$("#listErr").append("<li>Prix hors taxe</li>");
			}
			else
				if ($regexPrix.test($prix.val()) == false) 
				{
					$("#prixError").addClass("has-warning");
					$("#listErrFrmt").append("<li>Prix hors-taxe, exemple: 1000.00</li>");
				}
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
	else
	{
		alert("Produit ajouté!");
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

<!-- Formulaire pour renseigner les informations concernant un produit. Les informations sont envoyées vers la page trt_ajoutt.php puis traitée par cette même page.
