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

<?php

require_once ('mysqli_connect.php');
$rep = $_SESSION['num_rep'] ;

	$query = "SELECT *	
			  FROM Linhas_Reparacao	
			  WHERE n_reparacao = $rep";
	
	$result = mysqli_query($dbc,$query) or die (mysqli_error($dbc));
	$result_sec = mysqli_query($dbc,$query) or die (mysqli_error($dbc));	
	$row_sec = mysqli_fetch_array($result_sec);
	$num_peca = $row_sec['n_peca'];
	
echo "<p>";
	echo "<table><tr><th>Numero da Peca</th><th>Parte Danificada</th><th>Quantidade para troca</th><th>Preco</th></tr>";
		while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
			echo "<tr><td>" . $row['n_peca'] . "</td><td>" . $row['parte_danificada'] . "</td><td>" . $row['quantidade'] . "</td><td>" . $row['preco'] . "</td></tr>";  
		}
		echo "</table>";
echo "</p>";	
echo "<p>";	
	
	$query2 = "SELECT *	
			  FROM Peca	
			  WHERE n_peca = $num_peca";			  
	$result2 = mysqli_query($dbc,$query2) or die (mysqli_error($dbc));	
	
	echo "<table><tr><th>Numero da Peca</th><th>Numero da marca</th><th>Nome da peca</th><th>Quantidade em stock</th></tr>";
	while($row2 = mysqli_fetch_array($result2)){   
		echo "<tr><td>" . $row2['n_peca'] . "</td><td>" . $row2['n_marca'] . "</td><td>" . $row2['nome_peca'] . "</td><td>" . $row2['qtd_stock'] . "</td></tr>";  
	}
	echo "</table>";
echo "</p>";	
?>

	<form action="" method="post">
		<p><span class="violet">Preco: </span><input type="text" name="preco_func" size="30" value="" />	</p>
		<p><span class="violet">Quantidade para troca: </span><input type="text" name="quant_func" size="30" value="" />	</p>
		<p><span class="violet">Estado: </span><input type="text" name="estado_func" size="30" value="" />	</p>
		<button type="submit" id="submit_order" name="submit_order" class="btn">Send</button>
	</form>	
</body>

<?php
if(isset($_POST['submit_order'])){
	$preco_func = $_POST['preco_func'];
	$quant_func = $_POST['quant_func'];
	$estado_func = $_POST['estado_func'];

if(!empty($_POST['preco_func'])){	
	$query2 = "UPDATE Linhas_Reparacao SET preco=$preco_func  WHERE n_reparacao = $rep";
	$result = mysqli_query($dbc,$query2) or die (mysqli_error($dbc));
}

if(empty($_POST['preco_func'])){	
	$query2_sec = "UPDATE Linhas_Reparacao SET preco=0.00  WHERE n_reparacao = $rep";
	$result_sec = mysqli_query($dbc,$query2_sec) or die (mysqli_error($dbc));
}	

if(!empty($_POST['quant_func'])){	
	$query3 = "UPDATE Linhas_Reparacao SET quantidade=$quant_func  WHERE n_peca = $rep";
	$result2 = mysqli_query($dbc,$query3) or die (mysqli_error($dbc));
	
	$query3_sec = "UPDATE Peca SET qtd_stock = qtd_stock - 1  WHERE n_peca = $num_peca";
	$result2_sec = mysqli_query($dbc,$query3_sec) or die (mysqli_error($dbc));
}

if(!empty($_POST['estado_func'])){	
	$query4 = "UPDATE Reparacao SET estado='$estado_func' WHERE n_reparacao = $rep";
	$result3 = mysqli_query($dbc,$query4) or die (mysqli_error($dbc));
}
echo "<script type='text/javascript'>alert('Updated!')</script>";
echo("<meta http-equiv='refresh' content='1'>");
}

?>
<p><a href="fatura.php">Fatura</a> </p>
<p><a href="display_client_order.php">Back</a> </p>
</div>
</div>
</div>
</div>


</html>