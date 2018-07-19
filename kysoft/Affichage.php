<?php
	$nombreResultat=0;
	while(mysqli_stmt_fetch($res3))
	{
		$nombreResultat++;
		?>
		<br>
		<div class='row'>
			<div class="col-lg-12">
				<div class="panel panel-default">		
					<div class="panel-heading">
						<div class="row">
							<div class="col-lg-3">
								<h2 class="panel-title"><a href="leproduit.php?ref=<?php echo $ref; ?>&nom=<?php echo $nomProduit ;?>"><?php echo $nomProduit; ?></a></h2> 
							</div>
							<div class="col-lg-offset-7 col-lg-2">
								<span><?php echo $prixUnitaire; ?> €</span>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class='col-lg-12'>
								<?php echo $description; ?>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-lg-offset-9 col-lg-3">
								<a class="btn btn-default" href="leproduit.php?ref=<?php echo $ref; ?>&nom=<?php echo $nomProduit ;?>" role="button">Consulter</a>
								<a class="btn btn-primary" href="#" role="button">Aquérir</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	if($nombreResultat == 0)
	{
		echo "</br><div class='row'>";
		echo "<div class='alert col-lg-7 alert-warning'><p>Aucun résultat correspondant à votre recherche n'a été trouvé</p></div>";
		echo "</div>";
	}

?>