<?php 
session_start();
if(!isset($_SESSION['display_username'])){
	header("location:login.php");
	die();
} 
?>

<html>
	<head>
	<title>About Us</title>
	<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DivideByZero</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Droid+Sans">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lobster">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		
        <link rel="stylesheet" href="assets/css/animate.css">
        <link rel="stylesheet" href="assets/css/magnific-popup.css">
        <link rel="stylesheet" href="assets/flexslider/flexslider.css">
        <link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/media-queries.css">

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
	</head>
	
	<body>
        <!-- Top menu -->
		<nav class="navbar" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="member.php">DivideByZero - The Greatest Place on Earth for you computer</a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="top-navbar-1">
					<ul class="nav navbar-nav navbar-right">
					
						<li>
							<a href="member.php" >
								<i class="fa fa-home"></i><br>Home 
							</a>
							
						</li>
						
						<?php if($_SESSION['authority'] == 1 || $_SESSION['authority'] == 3){ ?>
						<li>
							<a href="Repair.php"><i class="fa fa-stethoscope"></i><br>Services</a>
						</li>
						<?php } ?>
						
						<?php if($_SESSION['authority'] == 2){ ?>
						<li>
							<a href="display_client_order.php"><i class="fa fa-eye"></i><br>Check Client's Orders</a>
						</li>
						<?php } ?>

						<?php if($_SESSION['authority'] == 1 || $_SESSION['authority'] == 3){ ?>
						<li>
							<a href="display_order.php"><i class="fa fa-eye"></i><br>Check Tickets</a>
						</li>
						<?php } ?>
						
						<?php if($_SESSION['authority'] > 1){ ?>
						<li>
							<a href="admin_register.php"><i class="fa fa-users"></i><br>Register</a>
						</li>
			
						<?php } ?>
						
						<?php if($_SESSION['authority'] ==3){ 
							require_once ('mysqli_connect.php');
							$query = "SELECT *	
							FROM Peca	
							ORDER BY qtd_stock ";			  
							$result = mysqli_query($dbc,$query) or die (mysqli_error($dbc));
							
							while($row = mysqli_fetch_array($result)){ 
								$qtd_stock = $row['qtd_stock'];
								$num_peca = $row['n_peca'];
								$nome = $row['nome_peca'];
								if($qtd_stock < 10){?>
										<li><a href="delivery.php"><i class="fa fa-exclamation-triangle"></i><br>Delivery</a></li> 
								<?php $_SESSION["n_peca"] = $num_peca;
								}
							}
						}
						?>
						
						<li>
							<a href="about.php"><i class="fa fa-user"></i><br>About</a>
						</li>
						<li>
							<a href="logout.php"><i class="fa fa-power-off"></i><br>Logout</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	 <!-- Page Title -->
        <div class="page-title-container">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 wow fadeIn">
                        <i class="fa fa-tasks"></i>
                        <h1>Register /</h1>
                        <p>Register new members</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- About Us Text -->
        <div class="about-us-container">
        	<div class="container">
	            <div class="row">
	                <div class="col-sm-12 about-us-text wow fadeInLeft">
	                    <h3>About DivideByZero</h3>
	                    <p>
	                    	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et. 
	                    	Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper <span class="violet">suscipit lobortis</span> 
	                    	nisl ut aliquip ex ea commodo consequat. Lorem ipsum <strong>dolor sit amet</strong>, consectetur adipisicing elit, 
	                    	sed do eiusmod tempor incididunt ut labore et. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper 
	                    	suscipit lobortis nisl ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
	                    	sed do <strong>eiusmod tempor</strong> incididunt.
	                    </p>
	                    <h3>Our Mission</h3>
	                    <p>
	                    	Lorem ipsum dolor sit amet, <span class="violet">consectetur adipisicing</span> elit, sed do eiusmod tempor incididunt 
	                    	ut labore et. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip 
	                    	ex ea commodo consequat. Lorem ipsum dolor sit amet, <strong>consectetur adipisicing</strong> elit, sed do eiusmod 
	                    	<span class="violet">tempor incididunt</span> ut labore et. Ut wisi enim ad minim veniam, quis nostrud exerci tation 
	                    	ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur 
	                    	adipisicing elit, sed do eiusmod tempor incididunt.
	                    </p>
	                    <h3>Why Choose Us</h3>
	                    <p>
	                    	Lorem ipsum dolor sit amet, <strong>consectetur adipisicing elit</strong>, sed do eiusmod tempor incididunt ut labore et. 
	                    	Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo 
	                    	consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et. 
	                    	Ut wisi enim ad minim veniam, quis <span class="violet">nostrud exerci</span> tation ullamcorper suscipit lobortis 
	                    	nisl ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod 
	                    	tempor incididunt.
	                    </p>
	                </div>
	            </div>
	        </div>
        </div>

        <!-- Meet Our Team -->
        <div class="team-container">
        	<div class="container">
	            <div class="row">
		            <div class="col-sm-12 team-title wow fadeIn">
		                <h2>Meet Our Team</h2>
		            </div>
	            </div>
	            <div class="row">	            	
	            	<div class="col-sm-3">
		                <div class="team-box wow fadeInUp">
		                    <img src="assets/img/team/1.jpg" alt="" data-at2x="assets/img/team/1.jpg">
		                    <h3>Tiago Barbosa</h3>
		                    <p>God.</p>
		                    <div class="team-social">		                        
		                        <a href="#"><i class="fa fa-facebook"></i></a>
		                        <a href="#"><i class="fa fa-twitter"></i></a>
		                        <a href="#"><i class="fa fa-linkedin"></i></a>
		                        <a href="#"><i class="fa fa-envelope"></i></a>
		                    </div>
		                </div>
	                </div>
	                <div class="col-sm-3">
		                <div class="team-box wow fadeInDown">
		                    <img src="assets/img/team/2.jpg" alt="" data-at2x="assets/img/team/2.jpg">
		                    <h3>Rui Gomes</h3>
		                    <p>Caça-Patos.</p>
		                    <div class="team-social">		                        
		                        <a href="#"><i class="fa fa-facebook"></i></a>
		                        <a href="#"><i class="fa fa-twitter"></i></a>
		                        <a href="#"><i class="fa fa-linkedin"></i></a>
		                        <a href="#"><i class="fa fa-envelope"></i></a>
		                    </div>
		                </div>
	                </div>
	                <div class="col-sm-3">
		                <div class="team-box wow fadeInUp">
		                    <img src="assets/img/team/3.jpg" alt="" data-at2x="assets/img/team/3.jpg">
		                    <h3>José Azevedo</h3>
		                    <p>O Padrinho.</p>
		                    <div class="team-social">		                        
		                        <a href="#"><i class="fa fa-facebook"></i></a>
		                        <a href="#"><i class="fa fa-twitter"></i></a>
		                        <a href="#"><i class="fa fa-linkedin"></i></a>
		                        <a href="#"><i class="fa fa-envelope"></i></a>
		                    </div>
		                </div>
	                </div>
	                <div class="col-sm-3">
		                <div class="team-box wow fadeInDown">
		                    <img src="assets/img/team/4.jpg" alt="" data-at2x="assets/img/team/4.jpg">
		                    <h3>Simão Azevedo</h3>
		                    <p>O Gabiru.</p>
		                    <div class="team-social">		                        
		                        <a href="#"><i class="fa fa-facebook"></i></a>
		                        <a href="#"><i class="fa fa-twitter"></i></a>
		                        <a href="#"><i class="fa fa-linkedin"></i></a>
		                        <a href="#"><i class="fa fa-envelope"></i></a>
		                    </div>
		                </div>
	                </div>
	            </div>
	        </div>
        </div>
		
<!-- Testimonials -->
        <div class="testimonials-container">
	        <div class="container">
	        	<div class="row">
		            <div class="col-sm-12 testimonials-title wow fadeIn">
		                <h2>Testimonials</h2>
		            </div>
	            </div>
	            <div class="row">
	                <div class="col-sm-10 col-sm-offset-1 testimonial-list">
	                	<div role="tabpanel">
	                		<!-- Tab panes -->
	                		<div class="tab-content">
	                			<div role="tabpanel" class="tab-pane fade in active" id="tab1">
	                				<div class="testimonial-image">
	                					<img src="assets/img/testimonials/1.jpg" alt="" data-at2x="assets/img/testimonials/1.jpg">
	                				</div>
	                				<div class="testimonial-text">
		                                <p>
		                                	"Such an amazing and chill place. I was close to dress in drag and do the hula. Not enough bugs though.
											Hakuna Matata!"<br>
		                                	<a href="#">Timon, jungle.co.amaz</a>
		                                </p>
	                                </div>
	                			</div>
	                			<div role="tabpanel" class="tab-pane fade" id="tab2">
	                				<div class="testimonial-image">
	                					<img src="assets/img/testimonials/2.jpg" alt="" data-at2x="assets/img/testimonials/2.jpg">
	                				</div>
	                				<div class="testimonial-text">
		                                <p>
		                                	"I am groot!!"<br>
		                                	<a href="#">Groot</a>
		                                </p>
	                                </div>
	                			</div>
	                   		</div>
<!-- Nav tabs -->
	                		<ul class="nav nav-tabs" role="tablist">
	                			<li role="presentation" class="active">
	                				<a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab"></a>
	                			</li>
	                			<li role="presentation">
	                				<a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab"></a>
	                			</li>
	                		
	                		</ul>
	                	</div>
	                </div>
	            </div>
	        </div>
        </div>

       <!-- Footer -->
      <footer>
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 footer-box wow fadeInUp">
                        <h4>About Us</h4>
                        <div class="footer-box-text">
	                        <p>
	                        	We are not 4 we are 11 million.
								Força Selecção.
	                        </p>
	                        <p><a href="about.php">Read more...</a></p>
                        </div>
                    </div>
                    <div class="col-sm-3 footer-box wow fadeInDown">
                        <h4>Email Updates</h4>
                        <div class="footer-box-text footer-box-text-subscribe">
                        	<p>Enter your email and you'll be one of the first to get new updates:</p>
                        	<form role="form" action="assets/subscribe.php" method="post">
		                    	<div class="form-group">
		                    		<label class="sr-only" for="subscribe-email">Email address</label>
		                        	<input type="text" name="email" placeholder="Email..." class="subscribe-email" id="subscribe-email">
		                        </div>
		                        <button type="submit" class="btn">Subscribe</button>
		                    </form>
		                    <p class="success-message"></p>
		                    <p class="error-message"></p>
                        </div>
                    </div>
                    <div class="col-sm-3 footer-box wow fadeInUp">
                        <h4>Support</h4>
                        <div class="footer-box-text">
	                        <p>
	                        	We are ready to receive your order.
	                        </p>
	                        <p><a href="Repair.php">One click away...</a></p>
                        </div>
                    </div>
                    <div class="col-sm-3 footer-box wow fadeInDown">
                        <h4>Contact Us</h4>
                        <div class="footer-box-text footer-box-text-contact">
	                        <p><i class="fa fa-map-marker"></i> Address: Universidade do Minho, Azurem, Guimarães, Portugal</p>
	                        <p><i class="fa fa-phone"></i> Phone: +351 000 00 00 000</p>
	                        <p><i class="fa fa-user"></i> Skype: Base_de_dados</p>
	                        <p><i class="fa fa-envelope"></i> Email: <a href="">contact@eletronica.co.uk</a></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                	<div class="col-sm-12 wow fadeIn">
                		<div class="footer-border"></div>
                	</div>
                </div>
                <div class="row">
                    <div class="col-sm-7 footer-copyright wow fadeIn">
                        <p>Copyright 2012 Andia - All rights reserved. Template by <a href="http://azmind.com">Azmind</a>.</p>
                    </div>
                    <div class="col-sm-5 footer-social wow fadeIn">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-dribbble"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/retina-1.1.0.min.js"></script>
        <script src="assets/js/jquery.magnific-popup.min.js"></script>
        <script src="assets/flexslider/jquery.flexslider-min.js"></script>
        <script src="assets/js/jflickrfeed.min.js"></script>
        <script src="assets/js/masonry.pkgd.min.js"></script>
        <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        <script src="assets/js/jquery.ui.map.min.js"></script>
        <script src="assets/js/scripts.js"></script>

    </body>

</html>