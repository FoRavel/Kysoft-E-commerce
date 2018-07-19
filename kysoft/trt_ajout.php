<?php

if(!ISSET($_POST['ref']) OR !ISSET($_POST['nomProduit']) OR !ISSET($_POST['prix']) OR !ISSET($_POST['description']) OR !ISSET($_POST['marque']) OR !ISSET($_POST['sousCategorie']) OR !ISSET($_POST['categorie']))
{
	echo "Vous n'avez pas renseigné tous les champs. <a href='ajouter.php'>Retour</a>";
}
else
{
	$con = mysqli_connect("localhost", "root", "", "kysoft");

	$reference = $_POST['ref'];
	$nomProduit = $_POST['nomProduit'];
	$prix = $_POST['prix'];
	$description = $_POST['description'];
	$marque = $_POST['marque'];
	$sousCategorie = $_POST['sousCategorie'];
	$categorie = $_POST['categorie'];


	$req = "INSERT INTO produit(ref_produit, nom_produit, prix_unitaire_ht, description, no_marque, no_categorie, no_sous_categorie)
							VALUES(?, ?, ?, ?, ?, ?, ?)";
							
	$res = mysqli_prepare($con, $req);
	mysqli_stmt_bind_param($res, "isisiii", $reference, $nomProduit, $prix, $description, $marque, $categorie, $sousCategorie);
	if(mysqli_stmt_execute($res))
	{
		  /*
		  $notification = "<p>Ajout avec succès</p>";
		  header("location: ajouter.php?trt=true&notif=". $notification . "");
		  */
		  echo "<p>Produit enregistré et ajouté</p>";
		  echo "<a href='ajouter.php'>Ajouter un nouvel article</a>";
		  echo "<br><a href='administration.php'>Retour à l'Administration</a>";
	}					
}