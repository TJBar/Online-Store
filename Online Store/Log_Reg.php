<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Sign-Up/Login Form</title>
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>   
    <link rel="stylesheet" href="css/normalize.css">    
    <link rel="stylesheet" href="css/style.css"> 
  </head>

  <body>

     <div class="form">
      
      <ul class="tab-group">
      <li class="tab active"><a href="#signup">Sign Up</a></li>
        <li class="tab"><a href="#login">Log In</a></li>
      </ul>
      
      <div class="tab-content">
     <div id="signup">   
          <h1>Sign Up for Free</h1>
          
          <form action="" method="post">
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                Username
              </label>
              <input type="text" name="username" size="30" value="" required autocomplete="off"/>
            </div>
        
            <div class="field-wrap">
              <label>
               Password
              </label>
              <input type="password" name="password" size="30" value="" required autocomplete="off"/>
            </div>
          </div>

          <div class="field-wrap">
            <label>
             Name
            </label>
            <input type="text" name="nome" size="30" value="" required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Email
            </label>
           <input type="text" name="email" size="30" value="" required autocomplete="off"/>
          </div>
 
          <div class="field-wrap">
            <label>
              Zip Code
            </label>
           <input type="text" name="cod_postal" size="30" value="" required autocomplete="off"/>
          </div>
 
           <div class="field-wrap">
            <label>
              Local
            </label>
           <input type="text" name="local" size="30" value="" required autocomplete="off"/>
          </div>

          <div class="field-wrap">
            <label>
              NIF
            </label>
           <input type="text" name="nif" size="30" value="" required autocomplete="off"/>
          </div>

          <div class="field-wrap">
            <label>
              Contact
            </label>
           <input type="text" name="contacto" size="30" value="" required autocomplete="off"/>
          </div>
		  
           <input type="submit" name="submit_register" value="Get Started"/>
          
          </form>

        </div>
        
		  <div id="login">   
          <h1>Welcome Back!</h1>
          
          <form action="" method="post">
          
            <div class="field-wrap">
            <label>
              Username
            </label>
			<input type="text" name="username" size="30" value="" required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password
            </label>
            <input type="text" name="password" size="30" value="" required autocomplete="off"/>	
          </div>
             
        <input type="submit" name="submit_login" value="Send" /> 
        
          </form>

        </div>

      </div><!-- tab-content -->
   
</div> <!-- /form -->
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="js/index.js"></script>

  </body>
</html>

<?php


	if(isset($_POST['submit_register'])){
		
	$client_username = trim($_POST['username']);
	$client_password = trim($_POST['password']);
	$client_name = trim($_POST['nome']);	
	$client_email = trim($_POST['email']);
	$client_zip = trim($_POST['cod_postal']);
	$client_local = trim($_POST['local']);
	$client_nif = trim($_POST['nif']);
	$client_contact = trim($_POST['contacto']);
	
			
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
            
					echo "<script type='text/javascript'>alert('Client Registered Successfully!')</script>";
					mysqli_stmt_close($stmt);
            
					mysqli_close($dbc);
            
				} else {            
					echo "<script type='text/javascript'>alert('Error Ocurred!')</script>";
					
					mysqli_stmt_close($stmt);
            
					mysqli_close($dbc);           
				}
			}else {
				echo "<script type='text/javascript'>alert('Username or Email already in use!')</script>";
			}

    }

if(isset($_POST['submit_login'])){
			
			require_once ('mysqli_connect.php');
			
			$client_username = $_POST['username'];	
			$client_password = $_POST['password'];
				
			$query = "	(SELECT username,password,nivel_acesso	FROM Cliente	WHERE  (Cliente.username='$client_username') AND  (Cliente.password='$client_password'))
			UNION (SELECT username,password,nivel_acesso	FROM Funcionario	WHERE  (Funcionario.username='$client_username') AND  (Funcionario.password='$client_password'))";				
			$result = mysqli_query($dbc,$query) or die (mysqli_error($dbc));
			$numrows=mysqli_num_rows($result);	
			
			$query2 = "	(SELECT n_cliente	FROM Cliente	WHERE  (Cliente.username='$client_username') AND  (Cliente.password='$client_password'))";
			$result2 = mysqli_query($dbc,$query2) or die (mysqli_error($dbc));
			
			$query3 = "	(SELECT n_funcionario	FROM Funcionario	WHERE  (Funcionario.username='$client_username') AND  (Funcionario.password='$client_password'))";
			$result3 = mysqli_query($dbc,$query3) or die (mysqli_error($dbc));
			
			if($numrows != 0){
				$row = mysqli_fetch_array($result);
				$row2 = mysqli_fetch_array($result2);
				$row3 = mysqli_fetch_array($result3);
				
				$check_username = $row['username'];
				$check_password = $row['password'];
				$check_restriction_level = $row['nivel_acesso'];
				$client_number = $row2['n_cliente'];
				$func_number = $row3['n_funcionario'];				
								
			if($client_username==$check_username && $client_password==$check_password){
				session_start();
				$_SESSION['display_username'] = $client_username;
				$_SESSION['authority'] = $check_restriction_level;
				$_SESSION['client_number'] = $client_number;
				$_SESSION['func_number'] = $func_number;
				
			header("Location: member.php"); // Redirect browser
					
			}else{	echo "<script type='text/javascript'>alert('Username or password incorrect!')</script>";	}			
			}else{ echo "<script type='text/javascript'>alert('Username or password incorrect!')</script>";	}	
	}
?>	
