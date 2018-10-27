<?php session_start();?>
<?php include 'header.php'; ?>
<!-- login -->
<div class="container">
	<div class="login-page">
			<div class="account_grid">
				<div class="col-md-6 login-left wow fadeInLeft" data-wow-delay="0.4s">
					<h3>NOUVEL UTILISATEUR</h3>
					<p>En créant un compte sur DreamTravel, vous pourrez bénéficier <br>de nos meilleures offres, réserver et payer vos voyages en toute sécurité.</p>
					<a class="acount-btn" href="register.php">Créer un Compte</a>
			   </div>
			   <div class="col-md-6 login-right wow fadeInRight" data-wow-delay="0.4s">
					<div>
						<h3>CLIENTS ENREGISTRES</h3>
						<p>Déjà Inscrit ? Veuillez vous connecter.</p>
				</div>
					<form action="login_tr.php" method="Post">
						<div>
							<span>Addresse Email <label>*</label></span>
							<input type="text" name="email"> 
						</div>
						<div>
							<span>Mot de Passe<label>*</label></span>
							<input type="password" name="password"> 
						</div>
						<input type="submit" value="Login">
						<a class="forgot" href="#">Mot de Passe Oublié?</a>
					</form>
			   </div>	
				<div class="clearfix"> </div>
			</div>
		</div>
<!-- End login -->
<?php include 'footer.php'; ?>