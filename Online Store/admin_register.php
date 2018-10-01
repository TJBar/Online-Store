<?php 
session_start();
if(!isset($_SESSION['display_username'])){
	header("location:login.php");
	die();
} 
?>

<html>
	<head>
	<title>Register</title>
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
										<li><a href="delivery.php"><i class="fa fa-user"></i><br>Delivery</a></li> 
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
		
<div class="services-full-width-container">
        	<div class="container">
	            <div class="row">
	                <div class="col-sm-12 services-full-width-text wow fadeInLeft">	
<center>	
<?php if($_SESSION['authority']==3){ ?>		
	
	
	
	<form action="" method="post">
	
	<p><span class="violet"><b>Tipo de conta a criar:</b></span></p>
		<input type="radio" name="account_type" value="admin" <?php if(isset($_POST['account_type']) && ($_POST['account_type']=='admin')) echo "checked='checked'"; ?> onclick=submit() />  Administrador  
		<input type="radio" name="account_type" value="func" <?php if(isset($_POST['account_type']) && ($_POST['account_type']=='func')) echo "checked='checked'"; ?> onclick=submit() /> Funcionario 	
		<input type="radio" name="account_type" value="cli" <?php if(isset($_POST['account_type']) && ($_POST['account_type']=='cli')) echo "checked='checked'"; ?> onclick=submit()  /> Cliente 
						   
	</form>
	
<?php } ?>

<?php if($_SESSION['authority']==2){ ?>
	
	<form action="" method="post">
	
	<p><span class="violet"><b>Tipo de conta a criar: </b></p></span>
		<input type="radio" name="account_type" value="cli" <?php if(isset($_POST['account_type']) && ($_POST['account_type']=='cli')) echo "checked='checked'"; ?> onclick=submit()  /> Cliente
	 					   
	</form>

<?php } ?>
	
	<?php if(isset($_POST['account_type']) && ($_POST['account_type']=='admin')){  ?>
	<form action="" method="post">
		<p><center> <big>Registar Administrador Novo</big> </center></p>
		<p><span class="violet">Username: </span><input type="text" name="username" size="30" value="" />	</p>
		<p><span class="violet">Password: </span><input type="text" name="password" size="30" value="" />	</p>
		<p><span class="violet">Nome: </span><input type="text" name="nome" size="30" value="" />	</p>
		<p><span class="violet">Email: </span><input type="text" name="email" size="30" value="" />	</p>
		<p><span class="violet">Codigo-Postal: </span><input type="text" name="cod_postal" size="30" value="" />	</p>
		<p><span class="violet">Localidade: </span><input type="text" name="local" size="30" value="" />	</p>
		<p><span class="violet">NIF: </span><input type="text" name="nif" size="30" value="" />	</p>
		<p><span class="violet">Contacto: </span><input type="text" name="contacto" size="30" value="" />	</p>
		<p><button type="submit" id="submit_admin" name="submit_admin" class="btn">Send</button></p>
		<p><button type="reset" class="btn">Clear</button></p>
	</form>	
	<?php } ?>

	
	<?php if(isset($_POST['account_type']) && ($_POST['account_type']=='func')){ ?>
	<form action="" method="post">
		<p><center> <big>Registar Funcionario Novo</big> </center></p>
		<p><span class="violet">Username: </span><input type="text" name="username" size="30" value="" />	</p>
		<p><span class="violet">Password: </span><input type="text" name="password" size="30" value="" />	</p>
		<p><span class="violet">Nome: </span><input type="text" name="nome" size="30" value="" />	</p>
		<p><span class="violet">Email: </span><input type="text" name="email" size="30" value="" />	</p>
		<p><span class="violet">Codigo-Postal: </span><input type="text" name="cod_postal" size="30" value="" />	</p>
		<p><span class="violet">Localidade: </span><input type="text" name="local" size="30" value="" />	</p>
		<p><span class="violet">NIF: </span><input type="text" name="nif" size="30" value="" />	</p>
		<p><span class="violet">Contacto: </span><input type="text" name="contacto" size="30" value="" />	</p>
		<p><span class="violet">Salario: </span><input type="text" name="salario" size="30" value="" />	</p>
		<p><span class="violet">Especializacao: </span><input type="text" name="especializacao" size="30" value="" />	</p>
		<button type="submit" id="submit_func" name="submit_func" class="btn">Send</button>
		<p><button type="reset" class="btn">Clear</button></p>
	</form>	
	<?php } ?>
	
	<?php if(isset($_POST['account_type']) && ($_POST['account_type']=='cli')){ ?>
	<form action="" method="post">
		<p><center> <big>Registar Cliente Novo</big> </center></p>
		<p><span class="violet">Username: </span><input type="text" name="username" size="30" value="" />	</p>
		<p><span class="violet">Password: </span><input type="text" name="password" size="30" value="" />	</p>
		<p><span class="violet">Nome: </span><input type="text" name="nome" size="30" value="" />	</p>
		<p><span class="violet">Email: </span><input type="text" name="email" size="30" value="" />	</p>
		<p><span class="violet">Codigo-Postal: </span><input type="text" name="cod_postal" size="30" value="" />	</p>
		<p><span class="violet">Localidade: </span><input type="text" name="local" size="30" value="" />	</p>
		<p><span class="violet">NIF: </span><input type="text" name="nif" size="30" value="" />	</p>
		<p><span class="violet">Contacto: </span><input type="text" name="contacto" size="30" value="" />	</p>
		<p><button type="submit" id="submit_cli" name="submit_cli" class="btn">Send</button></p>
		<p><button type="reset" class="btn">Clear</button></p>
	</form>	
	<?php } ?>
 </center>
</div>
	            </div>
	        </div>
        </div>	

	


<?php

if(isset($_POST['submit_func'])){
	
	$data_missing = array();
		
	if(empty($_POST['username'])){			
		$data_missing[] = 'Username';			
	} else {
		$client_username = trim($_POST['username']);			
	}
		
	if(empty($_POST['password'])){			
		$data_missing[] = 'Password';			
	} else {
		$client_password = trim($_POST['password']);			
	}
		
	if(empty($_POST['nome'])){			
		$data_missing[] = 'Nome';			
	} else {
		$client_name = trim($_POST['nome']);			
	}
		
	if(empty($_POST['email'])){			
		$data_missing[] = 'Email';			
	} else {
		$client_email = trim($_POST['email']);			
	}
		
	if(empty($_POST['cod_postal'])){			
		$data_missing[] = 'Codigo-Postal';			
	} else {
		$client_zip = trim($_POST['cod_postal']);			
	}
		
	if(empty($_POST['local'])){			
		$data_missing[] = 'Localidade';			
	} else {
		$client_local = trim($_POST['local']);			
	}
		
	if(empty($_POST['nif'])){			
		$data_missing[] = 'NIF';			
	} else {
		$client_nif = trim($_POST['nif']);			
	}
		
	if(empty($_POST['contacto'])){			
		$data_missing[] = 'Contacto';			
	} else {
		$client_contact = trim($_POST['contacto']);			
	}
		
	if(empty($_POST['especializacao'])){			
		$data_missing[] = 'especializacao';			
	} else {
		$client_spec = trim($_POST['especializacao']);			
	}
		
	if(empty($_POST['salario'])){			
		$data_missing[] = 'salario';			
	} else {
		$client_sal = trim($_POST['salario']);			
	}			
	
	if(empty($data_missing)){
		
		require_once ('mysqli_connect.php');
		$query = "	(SELECT username,email	FROM Cliente	WHERE  (Cliente.username='$client_username') OR  (Cliente.email='$client_email'))
		UNION (SELECT username,email	FROM Funcionario	WHERE  (Funcionario.username='$client_username') OR  (Funcionario.email='$client_email'))";		
														
		$result = mysqli_query($dbc,$query) or die (mysqli_error($dbc));				
		$numrows=mysqli_num_rows($result);
			
		if($numrows==0){
				
			$query = "INSERT INTO Funcionario(nome_funcionario,salario,especializacao,localidade,contacto,NIF,email,codigo_postal,username,password)  VALUES  (?,?,?,?,?,?,?,?,?,?)";					  
			$stmt = mysqli_prepare($dbc, $query);                
			mysqli_stmt_bind_param($stmt, "ssssssssss", $client_name,$client_sal,$client_spec,$client_local,$client_contact,$client_nif,$client_email,$client_zip,$client_username,$client_password);
        	mysqli_stmt_execute($stmt);			
			$affected_rows = mysqli_stmt_affected_rows($stmt);
		
			if($affected_rows == 1){            
				echo "<script type='text/javascript'>alert('Employee register successfully')</script>";            
				mysqli_stmt_close($stmt);            
				mysqli_close($dbc);            
			}else {            
				echo "<script type='text/javascript'>alert('Error Ocurred!')</script>";				
				mysqli_stmt_close($stmt);           
				mysqli_close($dbc);           
			}
		}else {
			echo "<script type='text/javascript'>alert('Username or Email already in use')</script>";  
		}	
	}else{
		echo "You are missing: <br />";
		foreach($data_missing as $missing){
		echo "$missing <br />";
		}
	}
}

if(isset($_POST['submit_cli'])){
	
	$data_missing = array();
		
	if(empty($_POST['username'])){			
		$data_missing[] = 'Username';			
	} else {
		$client_username = trim($_POST['username']);			
	}
		
	if(empty($_POST['password'])){			
		$data_missing[] = 'Password';			
	} else {
		$client_password = trim($_POST['password']);			
	}
		
	if(empty($_POST['nome'])){			
		$data_missing[] = 'Nome';			
	} else {
		$client_name = trim($_POST['nome']);			
	}
		
	if(empty($_POST['email'])){			
		$data_missing[] = 'Email';			
	} else {
		$client_email = trim($_POST['email']);			
	}
		
	if(empty($_POST['cod_postal'])){			
		$data_missing[] = 'Codigo-Postal';			
	} else {
		$client_zip = trim($_POST['cod_postal']);			
	}
		
	if(empty($_POST['local'])){			
		$data_missing[] = 'Localidade';			
	} else {
		$client_local = trim($_POST['local']);			
	}
		
	if(empty($_POST['nif'])){			
		$data_missing[] = 'NIF';			
	} else {
		$client_nif = trim($_POST['nif']);			
	}
		
	if(empty($_POST['contacto'])){			
		$data_missing[] = 'Contacto';			
	} else {
		$client_contact = trim($_POST['contacto']);			
	}
	
	if(empty($data_missing)){
			
		require_once ('mysqli_connect.php');			
		$query = "	(SELECT username,email	FROM Cliente	WHERE  (Cliente.username='$client_username') OR  (Cliente.email='$client_email'))
		UNION (SELECT username,email	FROM Funcionario	WHERE  (Funcionario.username='$client_username') OR  (Funcionario.email='$client_email'))";	
		
		$result = mysqli_query($dbc,$query) or die (mysqli_error($dbc));				
		$numrows=mysqli_num_rows($result);
			
		if($numrows==0){
			
			$query = "INSERT INTO Cliente(username,password,nome_cliente,email,codigo_postal,localidade,nif,contacto)  VALUES  (?,?,?,?,?,?,?,?)";
			  
			$stmt = mysqli_prepare($dbc, $query);
              
			mysqli_stmt_bind_param($stmt, "ssssssss", $client_username,$client_password,$client_name,$client_email,$client_zip,$client_local,$client_nif,$client_contact);
        
			mysqli_stmt_execute($stmt);
			
			$affected_rows = mysqli_stmt_affected_rows($stmt);
			
			if($affected_rows == 1){
			
				echo "<script type='text/javascript'>alert('Client Entered')</script>";  
				mysqli_stmt_close($stmt);
            
				mysqli_close($dbc);
            
			}else {            
				echo "<script type='text/javascript'>alert('Error Ocurred')</script>";  
				mysqli_stmt_close($stmt);
				mysqli_close($dbc);           
			}
		}else {
			echo "<script type='text/javascript'>alert('Username or Email already in use!')</script>";
		}
	}else{
		echo "You are missing: <br />";
		foreach($data_missing as $missing){
		echo "$missing <br />";
		}
	}
}

if(isset($_POST['submit_admin'])){
	
	$data_missing = array();
		
	if(empty($_POST['username'])){			
		$data_missing[] = 'Username';			
	} else {
		$client_username = trim($_POST['username']);			
	}
		
	if(empty($_POST['password'])){			
		$data_missing[] = 'Password';			
	} else {
		$client_password = trim($_POST['password']);			
	}
		
	if(empty($_POST['nome'])){			
		$data_missing[] = 'Nome';			
	} else {
		$client_name = trim($_POST['nome']);			
	}
		
	if(empty($_POST['email'])){			
		$data_missing[] = 'Email';			
	} else {
		$client_email = trim($_POST['email']);			
	}
		
	if(empty($_POST['cod_postal'])){			
		$data_missing[] = 'Codigo-Postal';			
	} else {
		$client_zip = trim($_POST['cod_postal']);			
	}
		
	if(empty($_POST['local'])){			
		$data_missing[] = 'Localidade';			
	} else {
		$client_local = trim($_POST['local']);			
	}
		
	if(empty($_POST['nif'])){			
		$data_missing[] = 'NIF';			
	} else {
		$client_nif = trim($_POST['nif']);			
	}
		
	if(empty($_POST['contacto'])){			
		$data_missing[] = 'Contacto';			
	} else {
		$client_contact = trim($_POST['contacto']);			
	}
	
	if(empty($data_missing)){
			
		require_once ('mysqli_connect.php');			
		$query = "	(SELECT username,email	FROM Cliente	WHERE  (Cliente.username='$client_username') OR  (Cliente.email='$client_email'))
		UNION (SELECT username,email	FROM Funcionario	WHERE  (Funcionario.username='$client_username') OR  (Funcionario.email='$client_email'))";				
		$result = mysqli_query($dbc,$query) or die (mysqli_error($dbc));				
		$numrows=mysqli_num_rows($result);
			
		if($numrows==0){
			
			$query = "INSERT INTO Cliente(username,password,nome_cliente,email,codigo_postal,localidade,nif,nivel_acesso,contacto)  VALUES  (?,?,?,?,?,?,?,3,?)";
			  
			$stmt = mysqli_prepare($dbc, $query);
              
			mysqli_stmt_bind_param($stmt, "ssssssss", $client_username,$client_password,$client_name,$client_email,$client_zip,$client_local,$client_nif,$client_contact);
        
			mysqli_stmt_execute($stmt);
			
			$affected_rows = mysqli_stmt_affected_rows($stmt);
			
			if($affected_rows == 1){
			
				echo "<script type='text/javascript'>alert('Admin registered successfully!')</script>";
				mysqli_stmt_close($stmt);
            
				mysqli_close($dbc);
            
			}else {            
				echo "<script type='text/javascript'>alert('Error ocurred!')</script>";
				mysqli_stmt_close($stmt);
				mysqli_close($dbc);           
			}
		}else {
			echo "<script type='text/javascript'>alert('Username or Email already in use!')</script>";
		}
	}else{
		echo "You are missing: <br />";
		foreach($data_missing as $missing){
		echo "$missing <br />";
		}
	}
}
?>

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