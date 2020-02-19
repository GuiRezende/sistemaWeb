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

date_default_timezone_set('America/Sao_Paulo');

if(!$conn){
	die("Conexão falhou: " .mysqli_connect_error());
}

$alterar           =  filter_input(INPUT_GET, 'alterar', FILTER_SANITIZE_NUMBER_INT);
$busca_dos_dados   =  mysqli_query($conn, "SELECT * FROM usuarios u INNER JOIN pacientes p ON (u.id=p.usuario_id) INNER JOIN enderecos e ON (u.endereco_id=e.id) WHERE p.paciente_id = '$alterar'");
$row_dados         =  mysqli_fetch_assoc($busca_dos_dados);

require "config/banco.php";

$busca             =  "SELECT * FROM prontuarios  WHERE paciente_id = '$row_dados[paciente_id]'ORDER BY data_hora DESC";
$prontuarios       =  $pdo->query($busca);

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
      <b><a href="prontuario.php?alterar=<?php echo $row_dados['paciente_id']; ?>">Gerenciamento do Prontuário</a></b><hr/>
    </div>
    <div id="content">
    
    <div style="border:2px solid #ccc; border-radius:5px; margin-top: 50px">
    <legend><h3>Prontuário do Enfermeiro</h3></legend>
            	<div style="margin:20px">
            <form  style="margin: 30px" action="tratamento/prontuario/salvar.php" method="POST">
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputEmail4">Nome</label>
                <input type="text" disabled class="form-control" id="inputEmail4" value="<?php echo $row_dados['nome'];  ?>">
                <input type="hidden" name="paciente_id" value="<?php echo $row_dados['paciente_id'] ?>">
                </div>
                <div class="form-group col-md-6">
                <label for="inputPassword4">Idade</label>
                <?php
                    $data1                  = date_create(date('Y-m-d', strtotime($row_dados['data_nascimento'])));
                    $data2                  = date_create(date('Y-m-d'));
                    $comp                   = date_diff($data1, $data2);
                    $idade                  = $comp->y;
                ?>
                <input type="text" class="form-control" disabled id="inputPassword4" value="<?php echo $idade ?> anos">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="pa">P.A</label>
                    <input type="text" class="form-control" name="pa" id="pa">
                </div>
                <div class="form-group col-md-3">
                    <label for="temperatura">Temperatura</label>
                    <input type="text" class="form-control" name="temperatura" id="temperatura">
                </div>
                <div class="form-group col-md-3">
                    <label for="hgt">HGT</label>
                    <input type="text" class="form-control" name="hgt" id="hgt">
                </div>
                <div class="form-group col-md-3">
                    <label for="irpm">IRPM</label>
                    <input type="text" class="form-control" name="irpm" id="irpm">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="anatocao">Anotações de Enfermagem</label>
                    <textarea type="text" class="form-control" name="anotacao" id="anatocao"></textarea>
                </div>
            </div>
           
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="evolucoes">Evoluções de Enfermagem</label>
                    <textarea type="text" class="form-control" name="evolucao" id="evolucoes"></textarea>
                </div>
            </div>
           
            <div class="form-row" style="padding-left: 15px;">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
            </form>

       

            <div style=margin:40px">       
                <table class="table">
                    <thead>
                        <tr>
                            <th rowspan="8"><label style="margin-left: 250%;">HISTÓRICO</label></th>
                        </tr>
                        
                    </thead>
                    <tr>
                            <th scope="col">Data</th>
                            <th scope="col">Anotação de Enfermagem</th>
                            <th scope="col">Evolução de Enfermagem</th>
                            <th scope="col">P.A</th>
                            <th scope="col">Temperatura</th>
                            <th scope="col">HGT</th>
                            <th scope="col">IRPM</th>
                        </tr>
                    <tbody>
                    <?php
                        foreach($prontuarios->fetchAll() as $prontuario){ ?>
                        <tr>
                        <td><?php echo date('d/m/Y - H:i', strtotime($prontuario['data_hora'])); ?></td>
                        <td><?php echo $prontuario['anotacao'] ?></td>
                        <td><?php echo $prontuario['evolucao'] ?></td>
                        <td><?php echo $prontuario['pa'] ?></td>
                        <td><?php echo $prontuario['temperatura'] ?></td>
                        <td><?php echo $prontuario['hgt'] ?></td>
                        <td><?php echo $prontuario['irpm'] ?></td>
                        <tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>


</body>
</html>