<?php
session_start();
if(!isset($_SESSION['display_username'])){
	header("location:login.php");
	die();
}
?>

<?php

	$type = $_POST['t'];
	$part = $_POST['p'];
	$brand = $_POST['b'];
	$model = $_POST['m'];
	$descricao_problema = $_POST['d'];

	$client_user = $_SESSION['display_username'];
	require_once ('mysqli_connect.php');



	$query2 = "SELECT n_cliente	FROM Cliente	WHERE username='$client_user'";
	$result2 = mysqli_query($dbc,$query2) or die (mysqli_error($dbc));
	$row = mysqli_fetch_array($result2);
	$client_number = $row['n_cliente'];

	$query = "INSERT INTO Reparacao(n_cliente,n_fatura,tipo_pc,parte_danificada,marca_danificada,modelo_danificado,data_entrega,descricao_problema)  VALUES(?,NULL,?,?,?,?,NOW(),?)";

	$stmt = mysqli_prepare($dbc, $query);

	mysqli_stmt_bind_param($stmt,"isssss",$client_number,$type, $part,$brand,$model,$descricao_problema);

	mysqli_stmt_execute($stmt);

	$affected_rows = mysqli_stmt_affected_rows($stmt);

	if($affected_rows == 1){

		echo 'Order Sent';

		mysqli_stmt_close($stmt);

		mysqli_close($dbc);

	} else {
		echo 'Error Occurred<br />';

		mysqli_stmt_close($stmt);

		mysqli_close($dbc);
	}
?>