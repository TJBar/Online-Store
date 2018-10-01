<?php 
session_start();

if(!isset($_SESSION['display_username'])){
	header("location:login.php");
	die();
} 
?>

<html>
<head>
<title>Order</title>
<style>
table, th, td {
    border: 1px solid black;
}
</style>

<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DivideByZero</title>

		<link rel="stylesheet" href="css/style_table.css">
		
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
						
						<?php if($_SESSION['authority'] == 2){ ?>
						<li>
							<a href="display_client_order.php"><i class="fa fa-eye"></i><br>Check Client's Orders</a>
						</li>
						<?php } ?>
		
						<li>
							<a href="about.html"><i class="fa fa-user"></i><br>About</a>
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
                        <h1>Client´s Orders/</h1>
                        <p>Orders to work on.</p>
                    </div>
                </div>
            </div>
        </div>

<?php

if($_SESSION['authority'] == 2){ 
	require_once ('mysqli_connect.php');
	$func_number = $_SESSION['func_number'];
	
	$query = "SELECT *	
			  FROM Reparacao	
			  WHERE n_reparacao IN (SELECT n_reparacao  
									FROM Participacao 
									WHERE n_funcionario = $func_number)";
		
	$result = mysqli_query($dbc,$query) or die (mysqli_error($dbc));
	$numrows=mysqli_num_rows($result);
	if($numrows==0){echo "Nao Tem Nehuma Ordem";}
	
	$query2 = "SELECT n_reparacao	
			  FROM Reparacao	
			  WHERE n_reparacao IN (SELECT n_reparacao  
									FROM Participacao 
									WHERE n_funcionario = $func_number)";
	$result2 = mysqli_query($dbc,$query2) or die (mysqli_error($dbc));
}

if($_SESSION['authority'] == 3){ 
	require_once ('mysqli_connect.php');
	$func_number = $_SESSION['func_number'];
	
	$query = "SELECT *	
			  FROM Reparacao	
			  WHERE n_reparacao";
		
	$result = mysqli_query($dbc,$query) or die (mysqli_error($dbc));
	$numrows=mysqli_num_rows($result);
	if($numrows==0){echo "Nao Tem Nehuma Ordem";}
}
?>

<div class="services-full-width-container">
        	<div class="container">
	            <div class="row">
	                <div class="col-sm-12 services-full-width-text wow fadeInLeft">	
					<center>
<?php	while($row = mysqli_fetch_array($result)){ ?>
		<form action="" method="post">
		<span class="violet"><?php echo "Order number ";  echo $row['n_reparacao']; ?>	 <input type="radio" name="order" value="<?php echo $row['n_reparacao']; ?>" <?php if(isset($_POST['order']) && $_POST['order']==$row ) echo "checked='checked'"; ?>  onClick="this.form.submit();"/> 
		</span>
		</form>
<?php }?>

<div class="services-full-width-container">
        	<div class="container">
	            <div class="row">
	                <div class="col-sm-12 services-full-width-text wow fadeInLeft">	
<center>	

<?php
	if(isset($_POST['order'])){  
	
	$number = $_POST['order'];
	$_SESSION['num_rep'] = $number;

	$query3 = "SELECT *	
			  FROM Reparacao	
			  WHERE n_reparacao = $number";
			  
	$result3 = mysqli_query($dbc,$query3) or die (mysqli_error($dbc));
	
	echo "<table><tr><th>Tipo de Computador</th><th>Parte Danificada</th><th>Descricao do Problema</th><th>Estado</th></tr>";
		while($row3 = mysqli_fetch_array($result3)){   //Creates a loop to loop through results
			echo "<tr><td>" . $row3['tipo_pc'] . "</td><td>" . $row3['parte_danificada'] . "</td><td>" . $row3['descricao_problema'] . "</td><td>" . $row3['estado'] . "</td></tr>";  
		}
		echo "</table>";
	}

	
?>

</div>
	        </div>
        </div>
</div>

<?php	if(isset($_POST['order'])){ ?>
<p><a href="update_order.php" class="btn">Update Order</a> </p>
<?php }?>

 </center>
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
</body>
</html>