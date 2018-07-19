<?php

	$bdd = new PDO("mysql:host=localhost;dbname=kysoft;charset=utf8", "root", "");
	$req = $bdd -> query("SELECT * FROM produit WHERE nom_produit REGEXP '^$_POST[valeurDuChamp] ?'");
	while($data = $req -> fetch())
	{
		echo "<option value=".$data['nom_produit'].">".$data['nom_produit']."</option>";
	}
	//LIKE '... %'

	$con = mysqli_connect("localhost", "root", "", "kysoft");
	$req = "SELECT * FROM produit WHERE nom_produit REGEXP '^$_POST[valeurDuChamp] ?'";
	$res = mysqli_query($con, $req);
	while($ligne = mysqli_fetch_array($res))
	{
		echo "<option value=".$data['nom_produit'].">".$data['nom_produit']."</option>";
	}
	?>
