<?php


$req = "SELECT P.ref_produit, P.nom_produit, P.prix_unitaire_ht, C.nom_categorie, SC.nom_sous_categorie, M.nom_marque 
					  FROM produit P, categorie C, sous_categorie SC, marque M
					  WHERE P.no_categorie = ?
					  AND P.no_sous_categorie = ?
					  AND P.no_marque = ?
					  AND P.nom_produit = ?";
$res = mysqli_prepare($con, $req);
mysqli_stmt_bind_param($res, "iiis", $categorie, $sousCategorie, $marque, $nomProduit);
if(mysqli_stmt_execute($res))
{
	echo "aaza";
}
