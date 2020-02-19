<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
$dsn    = "mysql:dbname=tcc;host=localhost"; // a database com o nome do banco
$dbuser = "root";	//usuario do banco
$dbpass = "";		//senha do banco
try{
	global $pdo; //variavel global para executar conexoes ao banco
	$pdo = new PDO($dsn, $dbuser, $dbpass);   //pegando os params e conectando
	//$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e){
	echo "Falhou: ".$e->getMessage();
}



if(isset($_POST['procurar'])){
	$nomeBuscar   =  $_POST['nomeBuscar'];

	$pegar      =  "SELECT p.paciente_id, u.nome, p.peso, p.altura, u.celular FROM pacientes p INNER JOIN 
						usuarios u ON (u.id=p.usuario_id) WHERE u.nome LIKE '%{$nomeBuscar}%' ORDER BY nome ASC";
	$pegar      = $pdo->query($pegar);	
}else{
	$pegar      =  "SELECT p.paciente_id, u.nome, p.peso, p.altura, u.celular FROM pacientes p INNER JOIN 
    usuarios u ON (u.id=p.usuario_id)  ORDER BY nome ASC";
	$pegar      = $pdo->query($pegar);
}
?>