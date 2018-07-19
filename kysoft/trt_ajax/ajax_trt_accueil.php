<?php	
	$con = mysqli_connect("localhost", "root", "", "kysoft");
	$req = "SELECT SC.no_sous_categorie, SC.nom_sous_categorie 
							FROM sous_categorie SC
							WHERE no_categorie = ?";
	$res = mysqli_prepare($con, $req);
	mysqli_stmt_bind_param($res, "i", $_POST["noCategorie"]);
	mysqli_stmt_execute($res);
	mysqli_stmt_bind_result($res, $noSousCat, $nomSousCat);
	while($ligne = mysqli_stmt_fetch($res))
	{
		echo "<option value=".$noSousCat.">".$nomSousCat."</option>";
	}
?>