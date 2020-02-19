<?php 

if(!isset($_SESSION)) 
{ 
	session_start(); 
} 

$dsn    = "localhost"; // a database com o nome do banco
$dbuser = "root";	//usuario do banco
$dbpass = "";		//senha do banco
$dbname = "tcc";    //nome da DataBase

$conn = mysqli_connect($dsn, $dbuser, $dbpass, $dbname);

if(!$conn){
	die("Conexão falhou: " .mysqli_connect_error());
}

if(isset($_GET['delete'])){
	$delete_id    =  $_GET['delete'];
	mysqli_query($conn, "DELETE FROM pacientes WHERE paciente_id = '$delete_id'");

	$_SESSION['message'] = "Registro excluído com sucesso!";
	$_SESSION['msg_type'] = "danger";


	header("Location: buscar_paciente.php");
}

?>