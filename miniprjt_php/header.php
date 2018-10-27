<!DOCTYPE HTML>
<html>
<head>
<title>Voguish a Blogging Category Flat Bootstarp Responsive Website Template | Home :: w3layouts</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<meta charset="utf-8" />	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Voguish Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

	<!-- Modernizr -->
	<script src="js/js_form/modernizr.js"></script>
	<!-- Webforms2 -->
	<script src="js/js_form/webforms2/webforms2-p.js"></script>	
	<!-- jQuery  -->
	<script src="js/js_form/jquery-1.4.3.min.js"></script>
	<script src="js/js_form/jquery-ui-1.8.5.min.js"></script>

	<script src="js/jquery.min.js"></script>
	<script src="js/responsiveslides.min.js"></script>
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all">
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
	<link rel="stylesheet" href="css/styleFormulaire.css">
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Libre+Baskerville:400,700' rel='stylesheet' type='text/css'>
	

	<!-- jQuery Numeric Spinner -->
	<script src="js/js_form/spinner.js"></script>  
 

<script>
    $(function () {
      $("#slider").responsiveSlides({
      	auto: true,
      	nav: true,
      	speed: 500,
        namespace: "callbacks",
        pager: true,
      });
    });
	
  </script>
	
</head>
<body>
<!-- header -->
	<div class="header">
		<div class="container">
			<div class="logo">
				<a href="index.php"><img src="images/test_gr.png" class="img-responsive" alt=""></a>			
			</div>
			<div class="head-nav">
				<span class="menu"> </span>
				<ul class="cl-effect-1">
					<li class="active"><a href="index.php">Accueil</a></li>
					<li ><a href="flight.php">Vol</a></li>
					<li><a href="tours.php">Voyages Organisés</a></li>
					<li><a href="blog.php">Blog</a></li>
					<li><a href="contact.php">Contact</a></li>
					<li><a href="login.php">Login</a></li>
					<li><?php if(isset($_SESSION['email']))  echo $_SESSION['email']; else echo " Bienvenue!"; ?></li>
					<li><a></a></li>
					<li>
						<div class="discon">
							<form action="logout.php" method="Post" id="logoutform">
    							<input type="submit" value="LOGOUT">
							</form>
						</div>
					</li>
					<div class="clearfix"></div>
				</ul>	
			</div>
						<!-- script-for-nav -->
							<script>
								$( "span.menu" ).click(function() {
								  $( ".head-nav ul" ).slideToggle(300, function() {
									// Animation complete.
								  });
								});
							</script>
						<!-- script-for-nav -->
			<div class="clearfix"> </div>
		</div>
	</div>
	
<!-- header -->
