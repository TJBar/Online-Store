<?php 
session_start();
if(!isset($_SESSION['display_username'])){
	header("location:login.php");
	die();
} 
?>

<html>
<head>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
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
                        <h1>Repair Center/</h1>
                        <p>Fill the form and send us a ticket with your problem.</p>
                    </div>
                </div>
            </div>
        </div>


		
<div class="services-full-width-container">
        	<div class="container">
	            <div class="row">
	                <div class="col-sm-12 services-full-width-text wow fadeInLeft">	
<center>					
<div>
<p><b><span class="violet">Tipo de computador:</span></b>
<select name="pc_type" id="pc_type" onchange="populate(this.id,'pc_part')">
<option>-- Select PC Type --</option>
<option value="laptop">Laptop</option>
<option value="desktop">Desktop</option>
</select>
</p>
</div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->

<div id="group_pc_part" name="group_pc_part" ">
<p><b><span class="violet">Parte danificada: </span></b><select name="pc_part" id="pc_part">
<option>-- Damaged Part --</option>
</select>
</td></tr></p>
</div>

<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->


<div id="group_graph" name="group_graph" ">
<p><b><span class="violet">Marca: </span></b><select name="gc_brand" id="gc_brand" onchange="populate(this.id,'models')">
<option>-- Marca --</option>
<option value="nvidia">NVIDIA</option>
<option value="amd">AMD</option> </select> </p>
</select>
</td></tr></p>
</div>

<div id="group_ram" name="group_ram" ">
<p><b><span class="violet">Marca: </span></b><select name="ram_brand" id="ram_brand" onchange="populate(this.id,'models')">
<option>-- Marca --</option>
<option value="kingston">Kingston</option>
<option value="corsair">Corsair</option> </select> </p>
</select>
</td></tr></p>
</div>

<div id="group_disc" name="group_disc" ">
<p><b><span class="violet">Marca: </span></b><select name="disc_brand" id="disc_brand" onchange="populate(this.id,'models')">
<option>-- Marca --</option>
<option value="seagate">Seagate</option>
<option value="western_digital">Western Digital</option> </select> </p>
</select>
</td></tr></p>
</div>

<div id="group_proc" name="group_proc" ">
<p><b><span class="violet">Marca: </span></b><select name="proc_brand" id="proc_brand" onchange="populate(this.id,'models')">
<option>-- Marca --</option>
<option value="intel_proc">Intel</option>
<option value="amd_proc">AMD</option> </select> </p>
</select>
</td></tr></p>
</div>

<div id="group_cooler" name="group_cooler" ">
<p><b><span class="violet">Marca: </span><select name="cooler_brand" id="cooler_brand" onchange="populate(this.id,'models')">
<option>-- Marca --</option>
<option value="cooler_master">Cooler Master</option>
<option value="cryorig">Cryorig</option> </select> </p>
</select>
</td></tr></p>
</div>

<div id="group_mb" name="group_mb" ">
<p><b><span class="violet">Marca: </span></b><select name="mb_brand" id="mb_brand" onchange="populate(this.id,'models')">
<option>-- Marca --</option>
<option value="msi">MSI</option>
<option value="asus">Asus</option> </select> </p>
</select>
</td></tr></p>
</div>

<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->

<div id="group_models" name="group_models" ">
<p><b><span class="violet">Model: </span></b><select name="models" id="models">
</select>
</td></tr></p>
</div>

<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->

<div id="group4" name="group4"">
<form action="" method="post">	
<p><b><span class="violet">Curta descricao do problema</span></br></b> <textarea cols=30 rows=10 name="problem_desc" id="problem_desc" />-- Default Text --</textarea> </p>	
</form>
</div>

<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->


<div id="group_submit" name="group_submit"">
<form>
<button type="button" id="submit" name="submit" class="btn">Send</button>
 </form>
 </center>
 </div>
</div>
	            </div>
	        </div>
        </div>
<script type="text/javascript"> 

$("#pc_part").hide();
$("div[name='group_pc_part']").hide();
$("div[name='group_graph']").hide();
$("div[name='group_ram']").hide();
$("div[name='group_disc']").hide();
$("div[name='group_proc']").hide();
$("div[name='group_cooler']").hide();
$("div[name='group_mb']").hide();
$("div[name='group_models']").hide();
$("div[name='group_submit']").hide();

function hide(x) {
	
	if(x==1){
		$("div[name='group_graph']").hide();
		$("div[name='group_ram']").hide();
		$("div[name='group_disc']").hide();
		$("div[name='group_proc']").hide();
		$("div[name='group_cooler']").hide();
		$("div[name='group_mb']").hide();
		$("div[name='group_models']").hide();
		$("div[name='group_submit']").hide();
	}
}


$('#pc_type').change(function() {
		$("#pc_part").show();
		$("div[name='group_pc_part']").show();
		hide(1);
	});

$('#pc_part').change(function() {
	var part = $( "#pc_part" ).val();
	hide(1);
	if(part == "graphic_card"){	$("div[name='group_graph']").show();}
	if(part == "ram"){	$("div[name='group_ram']").show();}
	if(part == "disc"){	$("div[name='group_disc']").show();}
	if(part == "processor"){	$("div[name='group_proc']").show();}
	if(part == "cooler"){	$("div[name='group_cooler']").show();}
	if(part == "motherboard"){	$("div[name='group_mb']").show();}
	
});

$('#group_graph').change(function() {
	$("div[name='group_submit']").hide();
});

$('#group_ram').change(function() {
	$("div[name='group_submit']").hide();
});


$('#group_disc').change(function() {
	$("div[name='group_submit']").hide();
});


$('#group_proc').change(function() {
	$("div[name='group_submit']").hide();
});


$('#group_cooler').change(function() {
	$("div[name='group_submit']").hide();
});


$('#group_mb').change(function() {
	$("div[name='group_submit']").hide();
});


$('#gc_brand').change(function() {	$("div[name='group_models']").show(); });
$('#ram_brand').change(function() {	$("div[name='group_models']").show(); });
$('#disk_brand').change(function() {	$("div[name='group_models']").show(); });
$('#proc_brand').change(function() {	$("div[name='group_models']").show(); });
$('#disc_brand').change(function() {	$("div[name='group_models']").show(); });
$('#cooler_brand').change(function() {	$("div[name='group_models']").show(); });
$('#mb_brand').change(function() {	$("div[name='group_models']").show(); });

$('#models').change(function() {
		$("div[name='group_submit']").show();
});


//------------------------------------------------------	

function populate(s1,s2){
	var s1 = document.getElementById(s1);
	var s2 = document.getElementById(s2);
	
	s2.innerHTML = "";
	if(s1.value == "laptop"){
		var optionArray = ["|","l_graphic_card|Placa Grafica","l_ram|Memoria RAM","l_disc|Disco Rigido","l_processor|Processador","l_cooler|Cooler","l_motherboard|Motherboard"];
	} else if(s1.value == "desktop"){
		var optionArray = ["|","graphic_card|Placa Grafica","ram|Memoria RAM","disc|Disco Rigido","processor|Processador","cooler|Cooler","motherboard|Motherboard"];
	} else if(s1.value=="nvidia"){
		var optionArray = ["|","1080|GTX 1080","1070|GTX 1070"];
	} else if(s1.value == "amd"){
		var optionArray = ["|","r9_380x|R9 380X","r7_360|R7 360"];
	}else if(s1.value == "kingston"){
		var optionArray = ["|","king_192000|PC4-19200","king_17000|PC4-17000"];
	}else if(s1.value == "corsair"){
		var optionArray = ["|","cors_27700|PC4-27700","cors_21300|PC4-21300"];
	}else if(s1.value == "seagate"){
		var optionArray = ["|","enterprise|Enterprise 500GB","slim|Slim 1TB"];
	}else if(s1.value == "western_digital"){
		var optionArray = ["|","black|Black 2TB","blue|Blue 1TB"];
	}else if(s1.value == "intel_proc"){
		var optionArray = ["|","intel_6800k|I7 6800K","intel_6850K|I7 6850K"];
	}else if(s1.value == "amd_proc"){
		var optionArray = ["|","bulldozer|Bulldozer 8-core","vishera|Vishera 8-core"];
	}else if(s1.value == "cooler_master"){
		var optionArray = ["|","hyper_612|Hyper 612","master_8|Master Air Maker 8"];
	}else if(s1.value == "cryorig"){
		var optionArray = ["|","m91|M91","c1|C1"];
	}else if(s1.value == "msi"){
		var optionArray = ["|","maximum_hero_8|Maximum Hero VIII","msi_970|MSI 970 Gaming"];
	}else if(s1.value == "asus"){
		var optionArray = ["|","asrock_z97x|Asrock Fatality Z97X","Sabertooth_z97|Sabertooth z97"];
	}
	
	for(var option in optionArray){
		var pair = optionArray[option].split("|");
		var newOption = document.createElement("option");
		newOption.value = pair[0];
		newOption.innerHTML = pair[1];
		s2.options.add(newOption);
	}
}


$("#submit").click(function(){
	var type = $( "#pc_type" ).val();
	var part = $( "#pc_part" ).val();
	var brand = $( "#gc_brand" ).val();
	var model = $( "#models" ).val();
	var problem_desc = $( "#problem_desc" ).val();
	
	$.ajax({
	 
		method: 'POST',	
		url: 'test.php',  
		data: {t:type, p:part, b:brand, m:model, d:problem_desc},
	/*	success: function (data) {
            alert('success');
		}*/
		
	})
		.done(function(data){
			$("#testing").html(data);
		});
		
	
	document.location.href = 'display_order.php';

}); 

</script>

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