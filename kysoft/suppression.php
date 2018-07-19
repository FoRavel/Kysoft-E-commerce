<?php

$con = mysqli_connect("localhost", "root", "", "kysoft");
$req = "DELETE FROM produit WHERE ref_produit = ?";
$res = mysqli_prepare($con, $req);
mysqli_stmt_bind_param($res, "i", $_GET["ref"]);
if(mysqli_stmt_execute($res))
{
	echo "<p>Le produit a été supprimé</p>";
	echo "<a href='administration.php'>Retour à l'Administration</a>";
}

?>