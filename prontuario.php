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

<body class="histEnfermagem">
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
      <b><a href="buscar_paciente.php" >Buscar paciente</a></b><hr/>
      <b><a href="agendar_consulta.php">Agendar consulta</a></b><hr/>
      <b><a href="verificar_horarios.php">Verificar horários</a></b><hr/>
      <b><a href="cadastro_funcionario.php">Cadastrar funcionário</a></b><hr/> 
      <b><a href="cadastro_paciente.php">Cadastrar paciente</a></b><hr/> 
    </div>
	<div id="content">
		<fieldset id="hEnfermagem">
      		<legend><h3>PACIENTE</h3></legend>

      		<input type="hidden" name="paciente_id" value="<?php echo $row_dados['paciente_id']; ?>">
			<input type="hidden" name="usuario_id" value="<?php echo $row_dados['usuario_id']; ?>">
			<input type="hidden" name="endereco_id" value="<?php echo $row_dados['endereco_id']; ?>">

			<div style="border:2px solid #ccc; border-radius:5px">
            	<div style="margin:20px">
					<div class="form-group row" >
						<label class="col-sm-2 col-form-label">Paciente:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_nome" name="nome" disabled value="<?php echo $row_dados['nome']; ?>">
						</div>
					</div>
				
					<div class="form-group row" >
						<label class="col-sm-2 col-form-label">Celular:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_celular" name="celular" disabled value="<?php echo $row_dados['celular']; ?>" >
						</div>
					</div>
		
					<div class="form-group row" >
						<label class="col-sm-2 col-form-label">Profissão:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_profissao" name="profissao" disabled value="<?php echo $row_dados['profissao']; ?>">
						</div>
					</div>
		
					<div class="form-group row" >
						<label class="col-sm-2 col-form-label">Escolaridade:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_escolaridade" name="escolaridade" disabled value="<?php echo $row_dados['escolaridade']; ?>" >
						</div>
					</div>
		
					<div class="form-group row" >
						<label class="col-sm-2 col-form-label">Religião:</label>
						<div class="col-sm-10">
							<input type="text" class="campo_religiao" name="religiao" disabled value="<?php echo $row_dados['religiao']; ?>">
						</div>
					</div>
		
					<div class="form-group row" >
						<label class="col-sm-2 col-form-label">Data de Nascimento:</label>
						<div class="col-sm-10">
							<input type="date" class="campo_dtNascimento" name="data_nascimento" disabled value="<?php echo $row_dados['data_nascimento']; ?>">
						</div>
					</div>

					<div class="form-group row" >
						<label class="col-sm-2 col-form-label">Peso:</label> 
						<div class="col-sm-10">
							<input id="peso" type="text" name="peso" disabled value="<?php echo $row_dados['peso']; ?>"  onfocus="calcularImc()">	
						</div>
					</div>
		
					<div class="form-group row" >
						<label class="col-sm-2 col-form-label">Altura:</label>
						<div class="col-sm-10">
							<input id="altura" type="text" name="altura" disabled value="<?php echo $row_dados['altura']; ?>" onblur="calcularImc()">
						</div>
					</div>

					<div class="form-group row" >
						<label class="col-sm-2 col-form-label">IMC:</label>
						<div class="col-sm-10">
							  <?php 
								 $peso = floatval($row_dados['peso']);
								 $altura = floatval(str_replace(",", ".", $row_dados['altura']));
								 $altura =  $altura * $altura;
								 $imc = $peso/$altura;
								 $imc = str_replace(".", ",", number_format($imc, 2, '.', ''));
							  ?>	
							<input id="imc" type="text" name="imc" disabled value="<?php echo $imc; ?>" >
						</div>
					</div>

					<div class="form-group row" >
						<label class="col-sm-2 col-form-label">Sexo:</label> 
						<div class="col-sm-10">
							<input type="radio" name="sexo" id="homem" <?php if($row_dados['sexo'] == "homem"){?>  checked="checked" <?php }?> disabled value="homem">
							<label for="homem">Masculino</label>
							<input type="radio" name="sexo" id="mulher" <?php if($row_dados['sexo'] == "mulher"){?>  checked="checked" <?php }?> disabled value="mulher">
							<label for="mulher">Feminino</label>
						</div>
					</div>
		
					<div class="form-group row" >    	
						<label class="col-sm-2 col-form-label">Estado civil:</label>
						<div class="col-sm-10">
							<input type="radio" name="estadoCivil" id="solteiro"<?php if($row_dados['estado_civil'] == "solteiro"){?>  checked="checked" <?php }?>   disabled value="solteiro">
							<label for="solteiro">Solteiro(a)</label>
							<input type="radio" name="estadoCivil" id="casado"<?php if($row_dados['estado_civil'] == "casado"){?>  checked="checked" <?php }?>   disabled value="casado">
							<label for="casado">Casado(a)</label>
							<input type="radio" name="estadoCivil" id="separado"<?php if($row_dados['estado_civil'] == "separado"){?>  checked="checked" <?php }?>   disabled value="divorciado">
							<label for="separado">Divorciado(a)</label>
							<input type="radio" name="estadoCivil" id="viuvo"<?php if($row_dados['estado_civil'] == "viuvo"){?>  checked="checked" <?php }?>   disabled value="viuvo">
							<label for="viuvo">Viúvo(a)</label>
						</div>
					</div>
				</div>
			</div>
        </fieldset>
	  <legend><h3>GERENCIAR</h3></legend>
 
	 
          <div class="col-6 col-md-4"><a class="btn btn-primary"  href="anotacao.php?alterar=<?php echo $row_dados['paciente_id']; ?>" role="button" >Acompanhamento do Prontuário</a></div>
		  <div class="col-6 col-md-4"><a class="btn btn-primary"  href="historico_enfermagem.php?alterar=<?php echo $row_dados['paciente_id']; ?>" role="button" >Histórico de Enfermagem</a></div>
		 <br><br>
     
  
	</div>
</body>
</html>