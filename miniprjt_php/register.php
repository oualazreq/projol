<?php session_start();?>
<?php include 'header.php'; ?>
<!-- registration -->
<div class="container">
	<div class="main-1">
		
			<div class="register">
		  	  <form  style="overflow:hidden;padding:50px;" action="register_tr.php" method="Post"> 
				 <div class="register-top-grid">
					<h3>INFORMATIONS PERSONNELLES</h3>
					 <div class="wow fadeInLeft" data-wow-delay="0.4s">
						<span>PRENOM<label>*</label></span>
						<input type="text" name="prenom" required> 
					 </div>
					 <div class="wow fadeInRight" data-wow-delay="0.4s">
						<span>NOM<label>*</label></span>
						<input type="text" name="nom"  required> 
					 </div>
					 <div class="wow fadeInRight" data-wow-delay="0.4s">
						 <span> Addresse Email <label>*</label></span>
						 <input type="text" name="email" required> 
					 </div>
					 <div class="clearfix"> </div>
					   <a class="news-letter" href="#">
						 
					   </a>
					 </div>
				     <div class="register-bottom-grid">
						    <h3>INFORMATIONS LOGIN</h3>
							 <div class="wow fadeInLeft" data-wow-delay="0.4s">
								<span>Mot de Passe<label>*</label></span>
								<input type="password" name="password"  required>
							 </div>
							 <div class="wow fadeInRight" data-wow-delay="0.4s">
								<span>Confirmer Mot de Passe<label>*</label></span>
								<input type="password" name="confirm"  required>
							 </div>
							 <div class="register-but">
				   				<input  style="padding:10px; width:60%;" type="submit" value="VALIDER">
					   			<div class="clearfix"> </div>
					   		</div>
				</div>
					 </div>
				</form>
				<div class="clearfix"> </div>
		   </div>
	</div>
<!-- registration -->

<?php include 'footer.php'; ?>