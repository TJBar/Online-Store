<?php 
session_start();

if(!isset($_SESSION['display_username'])){
	header("location:login.php");
	die();
} 
?>

<html>
<head>
<title>Fatura</title>
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
                        <h1>Client´s Orders/</h1>
                        <p>Orders to work on.</p>
                    </div>
                </div>
            </div>
        </div>
</head>
<body>
<div class="services-full-width-container">
        	<div class="container">
	            <div class="row">
	                <div class="col-sm-12 services-full-width-text wow fadeInLeft">	
<center>	

	<form action="" method="post">
		<center> <span class="violet"><big>Fatura</big></span></center>
		<p><span class="violet">Preco Final: </span><input type="text" name="preco_final" size="30" value="" />	</p>
		<button type="submit" id="submit_fatura" name="submit_fatura" class="btn">Send</button>
	</form>	

</div>
</div>
</div>

</div>
</body>
</html>
<?php
	
	if(isset($_POST['submit_fatura'])){  
	require_once ('mysqli_connect.php');
		$preco_fatura = $_POST['preco_final'];
		$query_fatura = "INSERT INTO Fatura(n_fatura,preco_final,data_emissao)  VALUES  (DEFAULT,?,NOW())";					  
		$stmt = mysqli_prepare($dbc, $query_fatura);                
		mysqli_stmt_bind_param($stmt, "s", $preco_fatura);
		mysqli_stmt_execute($stmt);		
		$affected_rows = mysqli_stmt_affected_rows($stmt);
	
	if($affected_rows == 1){            
		echo 'Fatura Entered';            
		mysqli_stmt_close($stmt);            
		mysqli_close($dbc);            
			}else {            
		echo 'Error Occurred<br />';				
		mysqli_stmt_close($stmt);           
		mysqli_close($dbc);           
			}
	}
?>