<?php

$con  = mysqli_connect("localhost", "root", "", "kysoft");
$req = 	"UPDATE produit 
					  SET ref_produit = ?, nom_produit = ?, prix_unitaire_ht = ?, description = ?, no_marque = ?, no_categorie = ?, no_sous_categorie = ?
					  WHERE ref_produit =". $_GET['ref']. "";
$res = mysqli_prepare($con, $req);
mysqli_stmt_bind_param($res, "isisiii", $_POST["ref"],  $_POST["nomProduit"],$_POST["prix"],$_POST["description"],$_POST["marque"],$_POST["categorie"],$_POST["sousCategorie"]);
if(mysqli_stmt_execute($res))
{
	echo "<p>Mise à jour du produit effectuée <a href='administration.php'>Retour vers l'administration</a></p>";
}

?>
