<?php 

if(!isset($_SESSION)) 
{ 
	session_start(); 
} 

require "tratamento/agendamento/deletar_agendamento.php";

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



$pegar_agendamento_funcionario      =  "SELECT * FROM usuarios as u INNER JOIN funcionarios as f INNER JOIN consultas as c ON (u.id=f.usuario_id) and (f.funcionario_id=c.funcionario_id) ORDER BY data_agendamento";
$pegar_agendamento_funcionario      = $pdo->query($pegar_agendamento_funcionario);

$pegar_agendamento_paciente      =  "SELECT nome FROM usuarios as u INNER JOIN pacientes as p INNER JOIN consultas as c ON (u.id=p.usuario_id) and (p.paciente_id=c.paciente_id)";
$pegar_agendamento_paciente      = $pdo->query($pegar_agendamento_paciente);
   
?>




<!DOCTYPE html>

<html lang="pt-br">
<head>

    <meta charset="utf-8">
    <title>SISTEMA DE ENFERMAGEM</title>
    <script defer src="https://use.fontawesome.com/releases/v5.6.3/js/all.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" type="text/css" href="assest/css/bootstrap.min.css" />
	<script type="text/javascript" src="assest/js/jquery.min.js"></script>
	<script type="text/javascript" src="assest/js/bootstrap.min.js"></script>
	<script>
	  function toggleSidebar(){
	   document.getElementById("sidebar").classList.toggle('active');
	   document.getElementById("content").classList.toggle('active');
	  }
	</script>

</head>

<body class="cadPaciente">		
<div class="barra navbar-default navbar-fixed-top">	
	<div class="nav navbar-nav navbar-right" style="margin-top: 17px;
    margin-right: 45px;
    font-size: 17px; ">
	<?php echo 'Olá, '.$_SESSION['usuario_logado']; ?>
	<a href="logout.php"><i class="fas fa-sign-out-alt"></i> SAIR</a></div>
	
	
		<div class="titulo">
			Sistema de Enfermagem
		</div>
	 	<div class="toggle-btn navbar-left"style="margin-top:20px;" onclick="toggleSidebar()"><a>
	 		<i class="fas fa-bars"></i>
		    </a>
		</div>
		<div class="faixa"></div>
	</div>
	<div id="sidebar">
	    <b><a href="agendar_consulta.php">Agendar consulta</a></b><hr/>
	    <b><a href="cadastro_paciente.php">Cadastrar paciente</a></b><hr/> 
		<b><a href="cadastro_funcionario.php">Cadastrar funcionário</a></b><hr/> 
	    <b><a href="buscar_paciente.php">Buscar paciente</a></b><hr/> 
	</div>

<div id="content">
	<div style="border:2px solid #ccc; border-radius:5px; margin-top:50px">
		<div style="margin:20px">
			<fieldset>
			<legend><h3>Agendamentos marcados</h3></legend>
				<table class="table">
				<thead>
					<tr>
						<th>Data</th>
						<th>Hora</th>
						<th>Funcionário</th>
						<th>Paciente</th>
						<th>Açãos</th>	
					</tr>
				</thead>	
				<tbody>
					<tr style="background-color:white">
						<?php 
						if($pegar_agendamento_paciente->rowCount() > 0){
							foreach($pegar_agendamento_paciente as $paciente):
							if($pegar_agendamento_funcionario->rowCount() > 0){ //se tiver arquivos
								foreach($pegar_agendamento_funcionario as $agendamento): //pegar todos e nomear de funcionario
							
						?>
						<td style="padding-top: 16px;"><?php echo date('d/m/Y', strtotime($agendamento['data_agendamento'])); ?></td>
						<td style="padding-top: 16px;"><?php echo date('H:i a', strtotime($agendamento['hora_agendamento'])); ?></td>
						<td style="padding-top: 16px;"><?php echo $agendamento['nome']; ?></td>
						<td style="padding-top: 16px;"><?php echo $paciente['nome']; ?></td>
						<td style="padding-top: 16px;"><a type="button" class="btn btn-danger" href="verificar_horarios.php?delete= <?php echo $agendamento['id']; ?>" onClick='return confirm("Você tem certeza que deseja deletar o agendamento da consulta?");'> <i class="far fa-trash-alt"></i> Excluir </a> 
					</tr>
					</tbody>
					<?php  endforeach; } ?>      
					<?php  endforeach; } ?>      
				</table>
			</fieldset>	  
		</div>
	</div>     
</div>
</body>
</html>