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

<body class="cadFuncionario">		
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
		<b><a href="agendar_consulta.php">Agendar consulta</a></b><hr/>
	    <b><a href="cadastro_paciente.php">Cadastrar paciente</a></b><hr/> 
		<b><a href="buscar_paciente.php">Buscar paciente</a></b><hr/> 
		<b><a href="buscar_funcionario.php">Buscar funcionários</a></b><hr/>
	</div>
<br>
<div id="content">
	<form id="inforFuncionario" action="tratamento/funcionario/adicionar_funcionario.php" method="POST">
		<fieldset id="cdFuncionario">
			<legend><h3>CADASTRO DE FUNCIONÁRIO</h3></legend>

			<div style="border:2px solid #ccc; border-radius:5px">
            	<div style="margin:20px">

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Nome:</label>				
						<div class="col-sm-10">
							<input type="text" class="campo_nome" required name="nome" id="nomeFuncionario" size="50px" >
						</div>
					</div>
	
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Nome da Mãe:</label>				
						<div class="col-sm-10">
							<input type="text" class="campo_nomeMae" required name="nome_mae" id="nomeMaeFuncionario" size="50">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Nome do Pai:</label>				
						<div class="col-sm-10">
							<input type="text" class="campo_nomePai" required name="nome_pai" id="nomePaiFuncionario"  >
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">CPF:</label>				
						<div class="col-sm-10">
							<input type="text" class="campo_cpf" required name="cpf" id="cpfFuncionario" maxlength="11" >
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">RG:</label>				
						<div class="col-sm-10">
							<input type="text" class="campo_rg" required name="rg" id="rgFuncionario" maxlength="10"  >
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Telefone:</label>				
						<div class="col-sm-10">
							<input type="text" class="campo_telefone" name="telefone" id="telefoneFuncionario"  >
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Celular:</label>				
						<div class="col-sm-10">
							<input type="text" class="campo_celular" name="celular" id="celularFuncionario"  >
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Data de Nascimento:</label>				
						<div class="col-sm-10">
							<input type="date" class="campo_dtNascimento" required name="data_nascimento"  >
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Sexo:</label>				
						<div class="col-sm-10">
							<input type="radio" name="sexo" id="homem" value="masculino" required>
							<label for="homem">Masculino</label>
							<input type="radio" name="sexo" id="mulher" value="feminino"required>
							<label for="mulher">Feminino</label>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Estado civil:</label>
						<div class="col-sm-10">
							<input type="radio" name="estadoCivil" id="solteiro" value="solteiro" required>
							<label for="solteiro">Solteiro(a)</label>
							<input type="radio" name="estadoCivil" id="casado" value="casado" required>
							<label for="casado">Casado(a)</label>
							<input type="radio" name="estadoCivil" id="separado" value="divorciado" required>
							<label for="separado">Divorciado(a)</label>
							<input type="radio" name="estadoCivil" id="viuvo" value="viuvo" required>
							<label for="viuvo">Viúvo(a)</label>
						</div><br>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">País:</label>
						<div class="col-sm-10">
							<input type="text" required class="campo_pais" name="pais" id="paisFuncionario" maxlength="20">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Estado:</label>
						<div class="col-sm-10">
							<input type="text" required class="campo_estado" name="estado" id="estadoFuncionario" >
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Município:</label>
						<div class="col-sm-10">
							<input type="text" required class="campo_cidade" name="municipio" >
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Bairro:</label>
						<div class="col-sm-10">
							<input type="text" required class="campo_bairro" name="bairro" >
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">CEP:</label>
						<div class="col-sm-10">
							<input type="text" required class="campo_cep" name="cep" > 
						</div>
					</div>
				</div>
			</div>		
		</fieldset>

		<fieldset>				
			<legend><h3>INFORMAÇÕES ESPECÍFICAS</h3></legend>
			<div style="border:2px solid #ccc; border-radius:5px">
				<div style="margin:20px">

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Cargo:</label>
						<div class="col-sm-10">
							<input type="text" required  name="cargo"  > 
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Data de admissão:</label>
						<div class="col-sm-10">
							<input type="date" required  name="data_admissao" > 
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Registro do conselho:</label>
						<div class="col-sm-10">
							<input type="text" required  name="registro" > 
						</div>
					</div>
				</div>
			</div>
		</fieldset>

		<fieldset >
			<legend><h3>LOGIN PARA O SISTEMA</h3></legend>
			<div style="border:2px solid #ccc; border-radius:5px">
				<div style="margin:20px">
					
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Usário:</label>
						<div class="col-sm-10">
							<input type="email" required  class="form-control" name="email"  > 
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Senha:</label>
						<div class="col-sm-10">
							<input type="password" required  name="senha"  class="form-control"> 
						</div>
					</div>
				</div>
			</div>	
		</fieldset>
		
		<div style="margin-top:20px; margin-bottom:70px">
			<button class="btn btn-succes btn-lg" type="submit">Salvar</button>
			<input class="btn btn-danger btn-lg" type="reset" value="Limpar" style="background-color:red">
		</div>
		
	</form>	
</div>
</body>
</html>