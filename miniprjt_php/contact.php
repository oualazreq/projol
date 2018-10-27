<?php session_start();?>
<?php include 'header.php'; ?>
<div class="container">
	<div class="contact">
 		<div class="main-head-section">	
		 	<h3>Retrouver votre agence</h3>
			<div class="contact-map">
			<iframe src="http://regiohelden.de/google-maps/map_en.php?width=1200&amp;height=350&amp;hl=en&amp;q=RESIDENCE%20HELLOU%20oujda+(DreamTravel)&amp;ie=UTF8&amp;t=&amp;z=18&amp;iwloc=A&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="1200px" height="350px" frameborder="0" style="border:0"></iframe>
			</div>
		</div>
		<div class="contact_top">	
			<div class="col-md-8 contact_left">
			 	<h4>Besoin d'aide, vous avez une Question? </h4>
			 	<p>Veuillez saisir vos cordonnées et votre message , nous vous répondrons dans les plus brefs délais .</p>
				<form action="contact_tr.php" method="Post">
					<div style="padding:50px 50px 50px 100px"class="form_details">
					    <input type="text" class="text" name="nom"  value="Votre Nom" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Votre Nom';}">
						<input type="text" class="text" name="email" value="Votre Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Votre Email';}">
						<input type="text" class="text" name="objet" value="Objet" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Objet';}">
						<textarea  name="message" value="Tapez votre message ici" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Tapez votre message ici';}"></textarea>
					<div class="clearfix"> </div>
						<div class="sub-button">
							<input type="submit" value="Envoyer">
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-4 company-right">
				<div class="company_ad">
					<h3>DreamTravel</h3>
	
				    <address>
						<p>email:<a href="#">supmti@gmail.com</a></p>
						<p>phone: 05 36 01 01 01 </p>
						<p>Bd MED V</p>
						<p>Oujda, Moroccos</p>			 	 	
					</address>  					
				</div>
			</div>	
			<div class="clearfix"> </div>
		</div>
	</div>
<?php include 'footer.php'; ?>