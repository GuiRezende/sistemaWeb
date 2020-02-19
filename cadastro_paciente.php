<!DOCTYPE html>
<?php
session_start();
?>
<html lang="pt-br">
<head>

    <meta charset="utf-8">
    <title>SISTEMA DE ENFERMAGEM</title>
    <script defer src="https://use.fontawesome.com/releases/v5.6.3/js/all.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
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
    <<div class="barra navbar-default navbar-fixed-top">	
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
		<b><a href="agendar_consulta.php">Agendar consulta</a></b><hr/>
		<b><a href="buscar_paciente.php">Buscar paciente</a></b><hr/> 
		<b><a href="cadastro_funcionario.php">Cadastrar funcionário</a></b><hr/> 
		<b><a href="buscar_funcionario.php">Buscar funcionários</a></b><hr/>

	</div>
<br>
<div id="content">
	<form id="inforPaciente" action="tratamento/paciente/adicionar_paciente.php" method="POST">
		<fieldset id="cdPaciente">
			<legend><h3>CADASTRO DE PACIENTE</h3></legend>
			<div style="border:2px solid #ccc; border-radius:5px">
            	<div style="margin:20px">
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Nome:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_nome" name="nome" id="nomePaciente" size="50px" >
						</div>
					</div>
				
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Nome da Mãe:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_nomeMae" name="nome_mae" id="nomeMaePaciente" size="50">
						</div>
					</div>
				
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Nome do Pai:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_nomePai" name="nome_pai" id="nomePaiPaciente"  >
						</div>
					</div>
				
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">CPF:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_cpf" name="cpf" id="cpfPaciente"  >
						</div>
					</div>
				
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">RG:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_rg" name="rg" id="rgPaciente"   >
						</div>
					</div>
				
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Telefone:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_telefone" name="telefone" id="telefonePaciente"  >
						</div>
					</div>
				
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Celular:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_celular" name="celular" id="celularPaciente"  >
						</div>
					</div>
				
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Profissão:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_profissao" name="profissao" id="religiaoPaciente"  >
						</div>
					</div>
				
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Escolaridade:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_escolaridade" name="escolaridade" id="religiaoPaciente"  >
						</div>
					</div>
				
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Religião:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_religiao" name="religiao" id="religiaoPaciente"  >
						</div>
					</div>
				
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Data de Nascimento:</label>
						<div class="col-sm-10">
							<input type="date" class="campo_dtNascimento" name="data_nascimento" id="dtNacimentoPaciente"  >
						</div>
					</div>

				
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Peso:</label>
						<div class="col-sm-10">
							<input id="peso" type="text" name="peso" onfocus="calcularImc()"/>	
						</div>
					</div>
				
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Altura:</label>
						<div class="col-sm-10">
							<input id="altura" type="text" name="altura" onblur="calcularImc()"/>
						</div>
					</div>
				
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Sexo:</label>
						<div class="col-sm-10">
							<input type="radio" name="sexo" id="homem" value="homem">
							<label for="homem">Masculino</label>
							<input type="radio" name="sexo" id="mulher" value ="mulher">
							<label for="mulher">Feminino</label>
						</div>
					</div>
				
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Estado civil:</label>
						<div class="col-sm-10">
							<input type="radio" name="estadoCivil" id="solteiro" value="solteiro">
							<label for="solteiro">Solteiro(a)</label>
							<input type="radio" name="estadoCivil" id="casado" value="casado">
							<label for="casado">Casado(a)</label>
							<input type="radio" name="estadoCivil" id="separado" value="divorciado">
							<label for="separado">Divorciado(a)</label>
							<input type="radio" name="estadoCivil" id="viuvo" value="viuvo">
							<label for="viuvo">Viúvo(a)</label>
						</div>
					</div>
				

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">País:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_pais" name="pais" id="paisPaciente" >
						</div>
					</div>
				
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Estado:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_estado" name="estado" id="estadoPaciente" >
						</div>
					</div>
				
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Município:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_cidade" name="municipio" >
						</div>
					</div>
				
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Bairro:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_bairro" name="bairro" >
						</div>
					</div>
				
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">CEP:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_cep" name="cep"> 
						</div>
					</div>
				</div>
			</div>	
		</fieldset>

		<button class="btn btn-succes btn-lg" type="submit">Salvar</button>
		<input class="btn btn-danger btn-lg" type="reset" value="Limpar" style="background-color:red">
		
		<br><br>
	</form>	
</div>
</body>
</html>