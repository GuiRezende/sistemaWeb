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



$pegar_funcionario      =  "SELECT * FROM usuarios u INNER JOIN 
funcionarios f ON (u.id=f.usuario_id) ORDER BY nome ASC";
$pegar_funcionario      = $pdo->query($pegar_funcionario);

$pegar_paciente      =  "SELECT * FROM pacientes p INNER JOIN 
usuarios u ON (u.id=p.usuario_id)  ORDER BY nome ASC";
$pegar_paciente      = $pdo->query($pegar_paciente);

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
		<b><a href="verificar_horarios.php">Verificar horários</a></b><hr/>
		<b><a href="cadastro_paciente.php">Cadastrar paciente</a></b><hr/> 
		<b><a href="buscar_paciente.php">Buscar paciente</a></b><hr/> 
		<b><a href="cadastro_funcionario.php">Cadastrar funcionário</a></b><hr/> 
		<b><a href="buscar_funcionario.php">Buscar funcionários</a></b><hr/>
	</div>




<div id="content">
	<div style="border:2px solid #ccc; border-radius:5px; margin-top:50px">
		<div style="margin:20px">
			<fieldset>
			<legend><h3>Agendar consulta</h3></legend>
			
				<table class="table">
				
					<tr>
						<th>Data</th>
						<th>Hora</th>
						<th>Paciente</th>
						<th>Funcionário</th>	
					</tr>

					<tr>
					<form method="POST" action="tratamento/agendamento/adicionar_agendamento.php" >
					
						<td><input type="date" name="data_agendamento" required ></td>
						<td><input type="time" name="hora_agendamento" required></td>
						<td><select name="paciente_id"><option>Selecione..</option>
						<?php 
							if($pegar_paciente->rowCount() > 0){ //se tiver arquivos
							foreach($pegar_paciente->fetchAll() as $paciente): //pegar todos e nomear de pacientes
											
						?>
						<option value="<?php echo $paciente['paciente_id']; ?>"><?php echo $paciente['nome']; ?></option>
						<?php
						endforeach;
						}
						?></select> </td>
						<td><select name="funcionario_id"><option>Selecione..</option>
						<?php 
							if($pegar_funcionario->rowCount() > 0){ //se tiver arquivos
							foreach($pegar_funcionario->fetchAll() as $funcionario): //pegar todos e nomear de funcionarios
											
						?>
						<option value="<?php echo $funcionario['funcionario_id']; ?>"><?php echo $funcionario['nome']; ?></option>
						<?php
						endforeach;
						}
						?></select></td>
					</tr>
				</table>	
				<input type="submit" name="procurar" value="Agendar" style="margin-top:8px; margin-bottom:8px"> 
				</fieldset>
			</form>
		</div>
	</div>

</div>
</body>
</html>