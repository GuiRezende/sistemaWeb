<?php 
require "tratamento/funcionario/deletar_funcionario.php";
require "tratamento/funcionario/listar_funcionario.php";

if(!isset($_SESSION)) 
{ 
	session_start(); 
} 

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
		<b><a href="verificar_horarios.php">Verificar horários</a></b><hr/>
		<b><a href="cadastro_paciente.php">Cadastrar paciente</a></b><hr/> 
		<b><a href="buscar_paciente.php">Buscar paciente</a></b><hr/> 
		<b><a href="cadastro_funcionario.php">Cadastrar funcionário</a></b><hr/>
	</div>




<div id="content">
	<div style="border:2px solid #ccc; border-radius:5px; margin-top:50px">
		<div style="margin:20px">
			<fieldset>
			<legend><h3>Busca por Funcionário</h3></legend>
				<form method="POST">
					<input type="text" name="nomeBuscar" placeholder="Busca por nome...">
					<input type="submit" name="procurar" value="Buscar" style="margin-top:8px; margin-bottom:8px"> 
				</form>
				<table class="table">
					<tr>
						<th>Funcionário</th>
						<th>Cargo</th>
						<th>Email</th>
						<th>Celular</th>	
						<th>Ações</th>
					</tr>
					<?php 
						if($filtrar->rowCount() > 0){ //se tiver arquivos
							foreach($filtrar->fetchAll() as $funcionario): //pegar todos e nomear de funcionario
						
					?>
					<tr>
						<td style="padding-top: 16px;"><?php echo $funcionario['nome']; ?></td>
						<td style="padding-top: 16px;"><?php echo $funcionario['cargo']; ?></td>
						<td style="padding-top: 16px;"><?php echo $funcionario['email']; ?></td>
						<td style="padding-top: 16px;"><?php echo $funcionario['telefone']; ?></td>
						<td><a type="button" class="btn btn-danger" href="buscar_funcionario.php?delete=<?php echo $funcionario['funcionario_id']; ?>" onClick='return confirm("Você tem certeza que deseja deletar o cadastro do funcionário?");'> <i class="far fa-trash-alt"></i> Excluir </a> 
						<a type="button" class="btn btn-warning" href="tratamento/funcionario/atualizar_funcionario.php?alterar= <?php echo $funcionario['funcionario_id']; ?>"><i class="fas fa-pencil-alt"></i> Alterar</a> </td>
					</tr>
					<?php
						endforeach;
					}
				?>
			</table>
			</fieldset>	
		</div>
	</div>
</div>
</body>
</html>