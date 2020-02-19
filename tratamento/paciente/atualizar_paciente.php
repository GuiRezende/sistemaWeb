
<?php 

if(!isset($_SESSION)) 
{ 
	session_start(); 
} 
$dsn    = "localhost"; // a database com o nome do banco
$dbuser = "root";	   //usuario do banco
$dbpass = "";		   //senha do banco
$dbname = "tcc";       //nome da DataBase

$conn = mysqli_connect($dsn, $dbuser, $dbpass, $dbname);

if(!$conn){
	die("Conexão falhou: " .mysqli_connect_error());
}

$alterar           =  filter_input(INPUT_GET, 'alterar', FILTER_SANITIZE_NUMBER_INT);
$busca_dos_dados   =  mysqli_query($conn, "SELECT * FROM usuarios u INNER JOIN pacientes p ON (u.id=p.usuario_id) INNER JOIN enderecos e ON (u.endereco_id=e.id) WHERE p.paciente_id = '$alterar'");
$row_dados         =  mysqli_fetch_assoc($busca_dos_dados);

?>


<!DOCTYPE html>

<html lang="pt-br">
<head>

    <meta charset="utf-8">
    <title>SISTEMA DE ENFERMAGEM</title>
    <script defer src="https://use.fontawesome.com/releases/v5.6.3/js/all.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <link rel="stylesheet" href="../../style.css">
	<link rel="stylesheet" type="text/css" href="../../assest/css/bootstrap.min.css" />
	<script type="text/javascript" src="../../assest/js/jquery.min.js"></script>
	<script type="text/javascript" src="../../assest/js/bootstrap.min.js"></script>
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
	 	<div class="toggle-btn" onclick="toggleSidebar()"><a>
	 		<i class="fas fa-bars"></i>
		    </a>
		</div>
		<div class="faixa"></div>
	</div>
	<div id="sidebar">
		<b><a href="../../buscar_paciente.php">Buscar paciente</a></b><hr/> 
	</div>

<br>
<div id="content">
	<form id="inforPaciente" action="update_paciente.php" method="POST">
		<fieldset id="cdPaciente">
			<legend><h3>ATUALIZAÇÃO DE PACIENTE</h3></legend>


            <input type="hidden" name="paciente_id" value="<?php echo $row_dados['paciente_id']; ?>">
			<input type="hidden" name="usuario_id" value="<?php echo $row_dados['usuario_id']; ?>">
			<input type="hidden" name="endereco_id" value="<?php echo $row_dados['endereco_id']; ?>">


			<div style="border:2px solid #ccc; border-radius:5px">
            	<div style="margin:20px">
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Nome:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_nome" name="nome" value="<?php echo $row_dados['nome']; ?>">
						</div>
					</div>

				
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Nome da Mãe:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_nomeMae" name="nome_mae"value="<?php echo $row_dados['nome_mae']; ?>">
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Nome do Pai:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_nomePai" name="nome_pai" value="<?php echo $row_dados['nome_pai']; ?>" >
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">CPF:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_cpf" name="cpf" value="<?php echo $row_dados['cpf']; ?>" >
						</div>
					</div>
				
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">RG:</label>
						<div class="col-sm-10">
						<input type="text" class="campo_rg" name="rg" value="<?php echo $row_dados['rg']; ?>"  >
					</div>
				</div>
				
				<div class="form-group row">
						<label class="col-sm-2 col-form-label">Telefone:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_telefone" name="telefone" value="<?php echo $row_dados['telefone']; ?>" >
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Celular:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_celular" name="celular" value="<?php echo $row_dados['celular']; ?>" >
						</div>
					</div>
				
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Profissão:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_profissao" name="profissao" value="<?php echo $row_dados['profissao']; ?>">
						</div>
					</div>
				
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Escolaridade:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_escolaridade" name="escolaridade" value="<?php echo $row_dados['escolaridade']; ?>" >
						</div>
					</div>
				
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Religião:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_religiao" name="religiao" value="<?php echo $row_dados['religiao']; ?>">
						</div>
					</div>
				
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Data de Nascimento:</label>
						<div class="col-sm-10">
							<input type="date" class="campo_dtNascimento" name="data_nascimento" value="<?php echo $row_dados['data_nascimento']; ?>">
						</div>
					</div>

				
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Peso:</label>
						<div class="col-sm-10">
							<input id="peso" type="text" name="peso" value="<?php echo $row_dados['peso']; ?>"  onfocus="calcularImc()">	
						</div>
					</div>
				
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Altura:</label>
						<div class="col-sm-10">
							<input id="altura" type="text" name="altura" value="<?php echo $row_dados['altura']; ?>" onblur="calcularImc()">
						</div>
					</div>

				
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Sexo:</label>
						<div class="col-sm-10">
							<input type="radio" name="sexo" id="homem" <?php if($row_dados['sexo'] == "homem"){?>  checked="checked" <?php }?> value="homem">
							<label for="homem">Masculino</label>
							<input type="radio" name="sexo" id="mulher" <?php if($row_dados['sexo'] == "mulher"){?>  checked="checked" <?php }?> value ="mulher">
							<label for="mulher">Feminino</label>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Estado civil:</label>
						<div class="col-sm-10">
							<input type="radio" name="estadoCivil" id="solteiro"<?php if($row_dados['estado_civil'] == "solteiro"){?>  checked="checked" <?php }?>   value="solteiro">
							<label for="solteiro">Solteiro(a)</label>
							<input type="radio" name="estadoCivil" id="casado"<?php if($row_dados['estado_civil'] == "casado"){?>  checked="checked" <?php }?>   value="casado">
							<label for="casado">Casado(a)</label>
							<input type="radio" name="estadoCivil" id="separado"<?php if($row_dados['estado_civil'] == "separado"){?>  checked="checked" <?php }?>   value="divorciado">
							<label for="separado">Divorciado(a)</label>
							<input type="radio" name="estadoCivil" id="viuvo"<?php if($row_dados['estado_civil'] == "viuvo"){?>  checked="checked" <?php }?>   value="viuvo">
							<label for="viuvo">Viúvo(a)</label>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">País:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_pais" name="pais" value="<?php echo $row_dados['pais']; ?>" >
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Estado:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_estado" name="estado" value="<?php echo $row_dados['estado']; ?>" >
						</div>
					</div>
				
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Município:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_cidade" name="municipio" value="<?php echo $row_dados['municipio']; ?>" >
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Bairro:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_bairro" name="bairro" value="<?php echo $row_dados['bairro']; ?>" >
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">CEP:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_cep" name="cep" value="<?php echo $row_dados['cep']; ?>"> 
						</div>
					</div>
				</div>
			</div>	
		</fieldset>
		<br>

		<input type="submit" value="Atualizar" class="btn">
		
	</form>	
</div>
</body>
</html>