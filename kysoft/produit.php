<!DOCTYPE html>
<?php session_start(); ?>
<html>
	<head>
		<title>Produits</title>
		<meta charset="utf-8"/>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
	<?php include("navbar.php"); ?>
	<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h3>Affichage des produits</h3>
		</div>
	</div>

	<?php	
		//Déterminer le rang du  produit à partir duquel commencer le listage des produits (utile ultérieurement pour le système de pagination)
		if(!ISSET($_GET["numeroPage"]))
		{
			$numeroPageCourante = 1;
		}
		else
		{
			$numeroPageCourante = $_GET["numeroPage"];
		}
		$nombreDeProduitsParPage = 5;
		$rangPremierProduit = ($numeroPageCourante-1)*$nombreDeProduitsParPage;
	?>	
		<div class="row">
		
			<form method="GET" action="produit.php" class="form-inline col-lg-4">
				<!-- Liste Catégories -->
				<div class="form-group">
					<label for="categorie" class="sr-only">Categories</label>
					<select name="categorie" id="categorie" class="form-control">
					<option value="" disabled selected>Catégorie</option>
				<?php
					//Lire toutes les Catégories
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
				<!-- Liste Sous-Catégories -->
				<div class="form-group">
					<label for="sousCategorie" class="sr-only">Sous-catégories</label>
					<select name="sousCategorie" id="sousCategorie" class="form-control">
					<option value="" disabled selected>Sous-Categorie</option>
				<?php
					//Lire toutes les Sous Catégories
					$con = mysqli_connect("localhost", "root", "", "kysoft");
					$req2 = "SELECT SC.no_sous_categorie, SC.nom_sous_categorie FROM sous_categorie SC";
					$res2 = mysqli_query($con, $req2);
					while($ligne2 = mysqli_fetch_array($req2))
					{
						echo "<option value=".$ligne2['no_sous_categorie'].">".$ligne2['nom_sous_categorie']."</option>";
					}
					mysqli_close($con);
					
				?>
					</select>
				</div>
				<input type="submit" value="Trier" id="submit" class="btn btn-default"/>
			</form>

			<!-- Champ de recherche -->
			<form  method="GET" action="produit.php" class="form-inline col-lg-8">
				<div class="input-group">
					<input list="suggestionsDeRecherche" type="text" name="recherche" id="champ" placeholder="Nom d'un produit" class="form-control"/>
					<datalist id="suggestionsDeRecherche">
					<!-- Options insérées par l'ajax -->
					</datalist>
					<span class="input-group-btn"><input type="submit" value="Rechercher" id="submit" class="btn btn-default"/></span>
				</div>
			</form>
		</div>
		
	<?php
		//Si aucune recherche n'a été effectuée à partir de la barre de recherche
		if(!ISSET($_GET["recherche"]))
		{
			//Et si aucune catégorie et sous-catégorie n'a été sélectionnée dans les listes déroulantes
			if(!ISSET($_GET["categorie"]) AND !ISSET($_GET["sousCategorie"]))
			{	
				echo "</br><div class='row'>";
				echo "<div class='col-lg-8'><div class='alert  alert-danger'><p>Sélectionnez une catégorie et/ou une sous-catégorie ou effectuez une recherche pour trouver un produit</p></div></div>";
				echo "</div>";
			}
			//Dans le cas contraire trier les résultats en fonction de la catégorie et/ou sous-catégorie choises dans les listes déroulantes
			else
			{
				//Si aucune sous-catégorie sélectionnée, afficher tous les produits de la catégorie choisie
				if(!ISSET($_GET["sousCategorie"]))
				{
					$con = mysqli_connect("localhost", "root", "", "kysoft");
					$req3  = "SELECT ref_produit, nom_produit, prix_unitaire_ht, description
							  FROM produit
							  WHERE no_categorie = ?
							  LIMIT $rangPremierProduit, $nombreDeProduitsParPage";
					$res3 = mysqli_prepare($con, $req3);
					mysqli_stmt_bind_param($res3, "i", $_GET["categorie"]);
					mysqli_stmt_execute($res3);
					mysqli_stmt_bind_result($res3, $ref, $nomProduit, $prixUnitaire, $description);
					include("Affichage.php");
					mysqli_close($con);	
					//Afin de déterminer le nombre de page nécessaires il faut diviser le nombre total de produits trouvés par le nombre de produit à afficher par page
					//Compter tous les produits
					$con = mysqli_connect("localhost", "root", "", "kysoft");
					$req4 = "SELECT COUNT(*) AS nbProduits FROM produit WHERE no_categorie = ?";
					$res4 = mysqli_prepare($con, $req4);
					mysqli_stmt_bind_param($req4, "i", $_GET["categorie"]);
					mysqli_stmt_execute($req4);
					mysqli_stmt_bind_result($req4, $nbProduits);
						
					$nombreTotalDeProduits = $nbProduits;
					$nbPages = ceil($nombreTotalDeProduits/$nombreDeProduitsParPage);
					//Stocker les pages dans un tableau (pour les afficher ultérieurement en bas de page)
					$pagination = array();
					for($i = 1; $i <= $nbPages; $i++)
					{
						$pagination[$i] = "<li><a data-page=".$i." href=produit.php?numeroPage=".$i."&categorie=".$_GET['categorie'].">Page".$i."</a></li>";
					}
					mysqli_close($con);
				}
				
				//Si aucune catégorie sélectionnée afficher toute la sous-catégorie choisie
				if(!ISSET($_GET["categorie"]))
				{
					$con = mysqli_connect("localhost", "root", "", "kysoft");
					$req3 = "SELECT ref_produit, nom_produit, prix_unitaire_ht, description
						    FROM produit
						    WHERE no_sous_categorie = ?
						    LIMIT $rangPremierProduit, $nombreDeProduitsParPage";
					$res3 = mysqli_prepare($con, $req3);
					mysqli_stmt_bind_param($res3, "i", $_GET["sousCategorie"]);
					mysqli_stmt_execute($res3);
					mysqli_stmt_bind_result($res3, $ref, $nomProduit, $prixUnitaire, $description);
					include("Affichage.php");
					mysqli_close($con);	
					
					$con = mysqli_connect("localhost", "root", "", "kysoft");
					$req4 = "SELECT COUNT(*) AS nbProduits FROM produit WHERE no_categorie = ?";
					$res4 = mysqli_prepare($con, $req4);
					mysqli_stmt_bind_param($res4, "i", $_GET["sousCategorie"]);
					mysqli_stmt_execute($res4);
					mysqli_stmt_bind_result($res4, $nbProduits);
					$nombreTotalDeProduits = $nbProduits;
					$nbPages = ceil($nombreTotalDeProduits/$nombreDeProduitsParPage);
					//Stocker les pages dans un tableau (pour les afficher ultérieurement en bas de page)
					$pagination = array();
					for($i = 1; $i <= $nbPages; $i++)
					{
						$pagination[$i] = "<a data-page=".$i." href=produit.php?numeroPage=".$i."&sousCategorie=".$_GET['sousCategorie'].">Page".$i."</a>";
					}
					mysqli_close($con);	
				}
				
				else if(ISSET($_GET["categorie"]) AND ISSET($_GET["sousCategorie"]))
				{
					$con = mysqli_connect("localhost", "root", "", "kysoft");
					$req3 = "SELECT ref_produit, nom_produit, prix_unitaire_ht, description
										  FROM produit
										  WHERE no_categorie = ? AND no_sous_categorie = ?
										  LIMIT $rangPremierProduit, $nombreDeProduitsParPage";
					$res3 = mysqli_prepare($con, $req3);
					mysqli_stmt_bind_param($res3, "ii", $_GET["categorie"],$_GET["sousCategorie"]);
					mysqli_stmt_execute($res3);
					mysqli_stmt_bind_result($res3, $ref, $nomProduit, $prixUnitaire, $description);
					include("Affichage.php");	
					mysqli_close($con);	
					
					$con = mysqli_connect("localhost", "root", "", "kysoft");	
					$req4 = "SELECT COUNT(*) AS nbProduits FROM produit WHERE no_categorie = ? AND no_sous_categorie = ?";
					$res4 = mysqli_prepare($con, $req4);
					mysqli_stmt_bind_param($res4, "ii", $_GET["categorie"], $_GET["sousCategorie"]);
					mysqli_stmt_execute($res4);
					mysqli_stmt_bind_result($res4, $nbProduits);
					mysqli_stmt_fetch($res4);

					$nombreTotalDeProduits = $nbProduits;
					$nbPages = ceil($nombreTotalDeProduits/$nombreDeProduitsParPage);
					//Stocker les pages dans un tableau (pour les afficher ultérieurement en bas de page)
					$pagination = array();
					for($i = 1; $i <= $nbPages; $i++)
					{
						$pagination[$i] = "<li><a data-page=".$i." href=produit.php?numeroPage=".$i."&categorie=".$_GET['categorie']."&sousCategorie=".$_GET['sousCategorie'].">".$i."</a></li>";
					}
					mysqli_close($con);				
				}			
			}
		}
		//Si une recherche a été effectuée à partir de la barre de recherche lire seulement les entrées de la table qui correspondent à la saisie
		else
			if(ISSET($_GET["recherche"]))
			{
				$con = mysqli_connect("localhost", "root", "", "kysoft");
				$req = "SELECT ref_produit, nom_produit, prix_unitaire_ht, description FROM produit
									  WHERE nom_produit LIKE '$_GET[recherche]%' LIMIT $rangPremierProduit, $nombreDeProduitsParPage";
				$res = mysqli_query($con, $req);
				while($ligne = mysqli_fetch_array($res))
				{
				?>
					<br>
					<div class='row'>
						<div class="col-lg-12">
							<div class="panel panel-default">		
								<div class="panel-heading">
									<div class="row">
										<div class="col-lg-3">
											<h2 class="panel-title"><a href="leproduit.php?ref=<?php echo $ligne["ref_produit"]; ?>&nom=<?php echo $ligne["nom_produit"] ;?>"><?php echo $ligne["nom_produit"]; ?></a></h2> 
										</div>
										<div class="col-lg-offset-7 col-lg-2">
											<span><?php echo $ligne["prix_unitaire_ht"]; ?></span>
										</div>
									</div>
								</div>
								<div class="panel-body">
									<div class="row">
										<div class='col-lg-12'>
											<?php echo $ligne["description"]; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php
				}		
				mysqli_close($con);					
				
				$con = mysqli_connect("localhost", "root", "", "kysoft");
				$req2 = "SELECT COUNT(*) AS nbProduits FROM produit WHERE nom_produit LIKE '$_GET[recherche]%'";
				$res2 = mysqli_query($con, $req2);
				//Pagination
				$ligne2 = mysqli_fetch_array($res2);
				$nombreTotalDeProduits = $ligne2["nbProduits"];
				$nbPages = ceil($nombreTotalDeProduits/$nombreDeProduitsParPage);
				//Stocker les pages dans un tableau (pour les afficher ultérieurement en bas de page)
				$pagination = array();
				for($i = 1; $i <= $nbPages; $i++)
				{
					$pagination[$i] = "<li><a data-page=".$i." href=produit.php?numeroPage=".$i."&recherche=".$_GET['recherche'].">".$i."</a></li>";
				}			
			}
		//Afficher les pages du tableau $pagination
		if(ISSET($_GET["categorie"]) OR ISSET($_GET["sousCategorie"]) OR ISSET($_GET["recherche"]))
		{
			?>
			<nav aria-label='Page navigation'>
			<ul class='pagination'>	
			<?php
			foreach($pagination as $valeur)
			{
				echo $valeur;
			}
			?>	
			</ul>
			</nav>
			<?php
		}
		echo "</div>";
		
		
		?>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script>
		//Listes liées catégories, sous-catégories
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
		//Recherche instantanée
		$("#champ").on("keyup", function(){
		var valeur = $(this).val();
		$.post(
		"trt_ajax/trt_recherche.php",
		{
			valeurDuChamp: valeur
		},
		function(data){
			$("#suggestionsDeRecherche").html(data);
		},
		"text"
		);
		//Changement de page 
	});
		</script>
	</body>
</html>
<!-- Affichage des produits. Si la page est accédée sans passer par l'accueil et que par conséquent aucune catégorie ou sous-catégorie n'a été 
	 sélectionnée alors, la page affiche tous les produits. 
	 L'utilisateur peut trier l'affichage en temps réel depuis cette même page (ajout personnel). -->