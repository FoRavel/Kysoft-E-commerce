<?php
$_GET["sousCategorie"] = 7;
$_GET["categorie"] =  1;
$con2 = mysqli_connect("localhost", "root", "", "kysoft");
$req4 = "SELECT COUNT(*) FROM produit WHERE no_categorie = ? AND no_sous_categorie = ?";
					$res4 = mysqli_prepare($con2, $req4);
					mysqli_stmt_bind_param($res4, "ii", $_GET["categorie"], $_GET["sousCategorie"]);
					mysqli_stmt_execute($res4);
					mysqli_stmt_bind_result($res4, $nbProduits);
					mysqli_stmt_fetch($res4);
					
echo $nbProduits ."<br>azaz" ;