<!DOCTYPE html>
<html>
<head>
	<title>Connexion</title>
	<meta charset="utf-8"/>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body>
	<?php include("navbar.php");?>
	<div class="container">
		<div class="row">	
			<div class="col-lg-12">
				<h3>Connexion</h3>
			</div>
		</div>
	
		<div class="row">
			<div class="col-lg-offset-4 col-lg-3">
				<div class="well well-lg">
					<form method="POST" action="trt_connexion.php">
						<div id="lgn" class="form-group">
							<label id="Login" class="sr-only">Login:</label>
							<input type="text" name="login" id="login" placeholder="Votre login" class="input-lg form-control"/>
						</div>
						<div id="mdp" class="form-group">
							<label for="motDePasse" class="sr-only">Mot de passe:</label>
							<input type="password" name="motDePasse" id="motDePasse" placeholder="Votre mot de passe" class="input-lg form-control"/>
						</div>
						<div class="form-group">
							<input type="submit" value="Se connecter" id="submit" class="btn btn-primary "/>
						</div>
						<div id="styleErreur" class="">
						<span id="msgErreur"></span>
						</div>
					</form>
				</div>
			</div>
		</div>

	</div>
	<script	src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script>
	$("#submit").on("click", function(e)
	{
		if(($("#login").val()=="")||(($("#motDePasse").val()=="")))
		{
			e.preventDefault();
			if($("#login").val()=="")
			{
				$("#lgn").addClass("has-error");
			}
			if($("#motDePasse").val()=="")
			{
				$("#mdp").addClass("has-error");
			}
			$("#msgErreur").html("Login et/ou mot de passe non saisi(s)");
			$("#styleErreur").addClass("alert alert-danger");
		}
	});
	</script>
	
	
</body>
</html>