<?php
$con = mysqli_connect("localhost", "root", "", "kysoft");

$req = "SELECT login_utilisateur, mot_de_passe 
	    FROM utilisateur 
	    WHERE login_utilisateur = ? AND mot_de_passe = ?";
$res = mysqli_prepare($con, $req);
mysqli_stmt_bind_param($res, "ss", $_POST["login"], $_POST["motDePasse"]);
mysqli_stmt_execute($res);
mysqli_stmt_bind_result($res, $login, $motDePasse);
if(!mysqli_stmt_fetch($res))
{
	echo "<p>Couple login et mot de passe incorrecte</p>";	
}
else
{
	session_start();
	$_SESSION["login"] = $login;
	$_SESSION["motDePasse"] = $motDePasse;	
	header("location:accueil.php");
}	

?>