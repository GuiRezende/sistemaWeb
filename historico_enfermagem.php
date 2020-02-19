<?php 

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

$dsn    = "localhost"; // a database com o nome do banco
$dbuser = "root";	   //usuario do banco
$dbpass = "";		   //senha do banco
$dbname = "tcc";       //nome da DataBase

date_default_timezone_set('America/Sao_Paulo');

$conn = mysqli_connect($dsn, $dbuser, $dbpass, $dbname);

if(!$conn){
	die("Conexão falhou: " .mysqli_connect_error());
}

$alterar           =  filter_input(INPUT_GET, 'alterar', FILTER_SANITIZE_NUMBER_INT);
$busca_dos_dados   =  mysqli_query($conn, "SELECT * FROM usuarios u INNER JOIN pacientes p INNER JOIN enderecos e ON p.usuario_id = u.id  WHERE p.paciente_id = '$alterar'");
$row_dados         =  mysqli_fetch_assoc($busca_dos_dados);


$id_historico      =  filter_input(INPUT_GET, 'id_historico', FILTER_SANITIZE_NUMBER_INT);
$hist   =  mysqli_query($conn, "SELECT id FROM historicos_enf  WHERE paciente_id = '$row_dados[paciente_id]'");
$data_hist         =  mysqli_fetch_assoc($hist);

//se foi salvo vai aparecer o id_historico na url, caso nao tenha ai passa direto.



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
	<div id="content" >
  
        <input type="hidden" name="paciente_id" value="<?php echo $row_dados['paciente_id']; ?>">
        <input type="hidden" name="usuario_id" value="<?php echo $row_dados['usuario_id']; ?>">
        <input type="hidden" name="endereco_id" value="<?php echo $row_dados['endereco_id']; ?>">
        
        <?php
        $paciente_id = $row_dados['paciente_id'];
        $id          = $data_hist['id'];

       
        if($data_hist['id']){

          header("Location:tratamento/historico/visualizacao_historico.php?alterar=".$paciente_id."&id_historico=".$id);

        }else{
          ?>
        
        <br><br>
        <div class="faixa navbar-default navbar-fixed-top" style="margin-top: 52px;" >
			<div class="coluna1">
				
			</div>
			<div class="" style=" padding-left:220px; padding-right:20px;">
				<input type="text" style="background-color:lightgreen" name="nome" disabled value="Paciente: <?php echo $row_dados['nome']; ?>">
			</div>
		</div>
        <fieldset id="admissao">
        <legend><h3>ADMISSÃO</h3></legend>

        <form method="POST" action="tratamento/historico/tratar.php">

        <input type="hidden" name="paciente_id" value="<?php echo $row_dados['paciente_id']; ?>">

          <div style="border:2px solid #ccc; border-radius:5px">
            <div style="margin:20px">
              <label>Entrada</label>
              <div class="form-group row">
                <label for="leito" class="col-sm-2 col-form-label">Leito</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control-plaintext" id="leito" required name="leito">
                </div>
              </div>

              <div class="form-group row">
                <label for="unidade" class="col-sm-2 col-form-label">Unidade</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="unidade" required name="unidade">
                </div>
              </div>

              <div class="form-group row">
                <label for="data" class="col-sm-2 col-form-label">Data</label>
                <div class="col-sm-10">
                  <input type="datetime-local" class="form-control" id="data" required name="data_hora">
                </div>
              </div>

            </div>
          </div>

          <div style="border:2px solid #ccc; border-radius:5px; margin-top:10px">
            <div style="margin:20px">

                <div class="form-group row">
                  <label for="origem" class="col-sm-2 col-form-label">Origem</label>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" required name="origem" id="domicilio" value="Domicílio">
                    <label class="form-check-label" for="domicilio">Domicílio</label>
                    <input class="form-check-input" type="radio" required name="origem" id="ambulatorio" value="Ambulatório">
                    <label class="form-check-label" for="ambulatorio">Ambulatório</label>
                    <input class="form-check-input" type="radio" required name="origem" id="emergencia" value="Emergência">
                    <label class="form-check-label" for="emergencia">Emergência</label>
                    <input class="form-check-input" type="radio" required name="origem" id="outrosHospitais" value="OutrosHospitais">
                    <label class="form-check-label" for="outrosHospitais">Outros Hospitais</label>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Condição de Chegada</label>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" required name="condicaoChegada" id="ambulancia" value="ambulancia">
                    <label class="form-check-label" for="ambulancia">De ambulância</label>
                    <input class="form-check-input" type="radio" required name="condicaoChegada" id="maca" value="maca">
                    <label class="form-check-label" for="maca">Maca</label>
                    <input class="form-check-input" type="radio" required name="condicaoChegada" id="cadeiraRodas" value="cadeiraRodas">
                    <label class="form-check-label" for="cadeiraRodas">Cadeira de rodas</label>
                    <input class="form-check-input" type="radio" required name="condicaoChegada" id="colo" value="colo">
                    <label class="form-check-label" for="colo">Colo</label>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Estado emocional</label>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" required name="estadoEmocional" id="calmo" value="calmo">
                    <label class="form-check-label" for="calmo">Calmo</label>
                    <input class="form-check-input" type="radio" required name="estadoEmocional" id="ansioso" value="ansioso">
                    <label class="form-check-label" for="ansioso">Ansioso</label>
                    <input class="form-check-input" type="radio" required name="estadoEmocional" id="agitado" value="agitado">
                    <label class="form-check-label" for="agitado">Agitado</label>
                    <input class="form-check-input" type="radio" required name="estadoEmocional" id="outros" value="outros">
                    <label class="form-check-label" for="outros">Outros</label>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Alteração na saúde recentemente</label>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" required name="saude_recentemente" id="sim" value="sim">
                    <label class="form-check-label" for="sim">Sim</label>
                    <input class="form-check-input" type="radio" required name="saude_recentemente" id="nao" value="nao">
                    <label class="form-check-label" for="nao">Não</label>
                  </div>
                  <div class="col-sm-10">
                    <textarea class="form-control" id="usaude_recentementenidade" name="saude_recentementeText"></textarea>
                  </div>
                </div>


                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Informante do quadro de saúde</label>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" required name="informante" id="informanteResponsavel" value="responsavel">
                    <label class="form-check-input" for="informanteResponsavel">Responsável</label>
                    <input class="form-check-input" type="radio" required name="informante" id="paciente" value="paciente">
                    <label class="form-check-input" for="paciente">Paciente</label> 
                  </div> 
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="informanteResponsavel" required name="informanteResponsavel">
                  </div>
                </div>

                <div class="form-group row">
                <label for="data" class="col-sm-2 col-form-label">Motivo da internação</label>
                <div class="col-sm-10">
                  <textarea class="form-control" id="motivoInternacao" name="motivo_internacao"></textarea>
                </div>
              </div>


              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Dor</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" required name="dor" id="simSenteDor" value="sim">
                  <label class="form-check-label" for="simSenteDor">Sim</label>
                  <input class="form-check-input" type="radio" required name="dor" id="naoSenteDor" value="nao">
                  <label class="form-check-label" for="naoSenteDor">Não</label>
                </div>
              </div>

              <div class="form-group row">
                <label for="data" class="col-sm-2 col-form-label">Queixa principal</label>
                <div class="col-sm-10">
                  <textarea class="form-control"  name="queixa_principal" id="queixaPrincipal"></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label for="data" class="col-sm-2 col-form-label">Quando iniciou</label>
                <div class="col-sm-10">
                  <textarea class="form-control"  name="quando_iniciou" id="quandoIniciou"></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label for="data" class="col-sm-2 col-form-label">Como foi controlada em casa</label>
                <div class="col-sm-10">
                  <textarea class="form-control"  name="tratamento_em_casa" id="tratamentoEmCasa"></textarea>
                </div>
              </div>
              
              <div class="form-group row">
                <label for="data" class="col-sm-2 col-form-label">Grupo sanguíneo/Fator RH</label>
                <div class="col-sm-10">
                  <textarea class="form-control"  name="tipo_sanguineo" id="grupoSanguineoeFatorRH"></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alergias especificas</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="alergia" type="radio" id="semAlergia" value="nao">
                  <label class="form-check-input" for="semAlergia">Não</label>
                  <input class="form-check-input" required name="alergia" type="radio" id="alergiaMedicamentos" value="medicamentosa">
                  <label class="form-check-input" for="alergiaMedicamentos">Medicamentosa</label>
                  <input class="form-check-input" required name="alergia" type="radio" id="alergiaAlimentos" value="alimentar">
                  <label class="form-check-input" for="alergiaAlimentos">Alimentar</label>
                  <input class="form-check-input" required name="alergia" type="radio" id="alergiaOutrass" value="outros">
                  <label class="form-check-input" for="alergiaOutrass">Outras</label>
                </div> 
                <div class="col-sm-10" style="margin-left: 195px;">
                  <textarea class="form-control"  name="alergiaText" id="alergiasOutras" placeholder="Especifique as alergias"></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label for="data" class="col-sm-2 col-form-label">Hospitalização anterior</label>
                <div class="col-sm-10" style="margin-left: 195px;">
                  <textarea class="form-control"  name="hospitalizacao_anterior" id="hospitalizacaoAnterior"></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Cirugias anteriores</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="cirurgia_anteriores" type="radio" id="simCirurgias" value="sim">
                  <label class="form-check-input" for="simCirurgias">Sim</label>
                  <input class="form-check-input" required name="cirurgia_anteriores" type="radio" id="naoCirurgias" value="nao">
                  <label class="form-check-input" for="naoCirurgias">Não</label>
                </div> 
                <div class="col-sm-10">
                  <textarea class="form-control" style="margin-left: 195px;" name="cirurgiaRealizada" id="cirurgias"  placeholder="Qual(is) cirurgia(s)"></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Exames recentes</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="exames_recentes" type="radio" id="simExameRecente" value="sim">
                  <label class="form-check-input" for="simExameRecente">Sim</label>
                  <input class="form-check-input" required name="exames_recentes" type="radio" id="naoExameRecente" value="nao">
                  <label class="form-check-input" for="naoExameRecente">Não</label>
                </div> 
                <div class="col-sm-10">
                  <textarea class="form-control" style="margin-left: 195px;" name="exameRecente" placeholder="Qual(is) exames(s)"></textarea>
                </div>
              </div>

            </div>
          </div>
        

          <legend><h3>HISTÓRICO DE SAÚDE E DOENÇA</h3></legend>

          <div style="border:2px solid #ccc; border-radius:5px">
            <div style="margin:20px">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tabagismo</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="tabagismo" type="radio" id="simTabagismo" value="sim">
                  <label class="form-check-input" for="simTabagismo">Sim</label>
                  <input class="form-check-input" required name="tabagismo" type="radio" id="naoTabagismo" value="nao">
                  <label class="form-check-input" for="naoTabagismo">Não</label>
                </div> 
                <div class="col-sm-10" style="margin-left: 195px;">
                  <textarea class="form-control" name="tabagismoText" ></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Neoplasia</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="neoplasia" type="radio" id="simneoplasia" value="sim">
                  <label class="form-check-input" for="simneoplasia">Sim</label>
                  <input class="form-check-input" required name="neoplasia" type="radio" id="naoneoplasia" value="nao">
                  <label class="form-check-input" for="naoneoplasia">Não</label>
                </div> 
                <div class="col-sm-10" style="margin-left: 195px;">
                  <textarea class="form-control" name="neoplasiaText" ></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Doença auto imune</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="doenca_auto_imune" type="radio" id="simDoencaAutoImune" value="sim">
                  <label class="form-check-input" for="simDoencaAutoImune">Sim</label>
                  <input class="form-check-input" required name="doenca_auto_imune" type="radio" id="naoDoencaAutoImune" value="nao">
                  <label class="form-check-input" for="naoDoencaAutoImune">Não</label>
                </div> 
                <div class="col-sm-10" style="margin-left: 195px;">
                  <textarea class="form-control" name="doenca_auto_imuneText" ></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Doença respiratória</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="doenca_respiratoria" type="radio" id="simDoencaRespiratoria" value="sim">
                  <label class="form-check-input" for="simDoencaRespiratoria">Sim</label>
                  <input class="form-check-input" required name="doenca_respiratoria" type="radio" id="naoDoencaRespiratoria" value="nao">
                  <label class="form-check-input" for="naoDoencaRespiratoria">Não</label>
                </div> 
                <div class="col-sm-10"style="margin-left: 195px;">
                  <textarea class="form-control" name="doenca_respiratoriaText" ></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Doença renal</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="doenca_renal" type="radio" id="simDoencaRenal" value="sim">
                  <label class="form-check-input" for="simDoencaRenal">Sim</label>
                  <input class="form-check-input" required name="doenca_renal" type="radio" id="naoDoencaRenal" value="nao">
                  <label class="form-check-input" for="naoDoencaRenal">Não</label>
                </div> 
                <div class="col-sm-10" style="margin-left: 195px;">
                  <textarea class="form-control" name="doenca_renalText" ></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Doença cardiovascular</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="doenca_cardiovascular" type="radio" id="simDoencaCardiovascular" value="sim">
                  <label class="form-check-input" for="simDoencaCardiovascular">Sim</label>
                  <input class="form-check-input" required name="doenca_cardiovascular" type="radio" id="naoDoencaCardiovascular" value="nao">
                  <label class="form-check-input" for="naoDoencaCardiovascular">Não</label>
                </div> 
                <div class="col-sm-10" style="margin-left: 195px;">
                  <textarea class="form-control" name="doenca_cardiovascularText" ></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Diabetes</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="diabetes" type="radio" id="simdiabetes" value="sim">
                  <label class="form-check-input" for="simdiabetes">Sim</label>
                  <input class="form-check-input" required name="diabetes" type="radio" id="naodiabetes" value="nao">
                  <label class="form-check-input" for="naodiabetes">Não</label>
                </div> 
                <div class="col-sm-10" style="margin-left: 195px;">
                  <textarea class="form-control" name="diabetesText" ></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Distúrbios comportamentais</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="disturbios_comportamentais" type="radio" id="simDisturbiosComportamentais" value="sim">
                  <label class="form-check-input" for="simDisturbiosComportamentais">Sim</label>
                  <input class="form-check-input" required name="disturbios_comportamentais" type="radio" id="naoDisturbiosComportamentais" value="nao">
                  <label class="form-check-input" for="naoDisturbiosComportamentais">Não</label>
                </div> 
                <div class="col-sm-10">
                  <textarea class="form-control" name="disturbiosComportamentaisText" ></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Doenças infectocontagiosas</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="donecas_infectocontagiosas" type="radio" id="simDoencasInfectocontagiosas" value="sim">
                  <label class="form-check-input" for="simDoencasInfectocontagiosas">Sim</label>
                  <input class="form-check-input" required name="donecas_infectocontagiosas" type="radio" id="naoDoencasInfectocontagiosas" value="nao">
                  <label class="form-check-input" for="naoDoencasInfectocontagiosas">Não</label>
                </div> 
                <div class="col-sm-10">
                  <textarea class="form-control" name="donecas_infectocontagiosasText" ></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Dislipidemia</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="dislipidemia" type="radio" id="simDislipidemia" value="sim">
                  <label class="form-check-input" for="simDislipidemia">Sim</label>
                  <input class="form-check-input" required name="dislipidemia" type="radio" id="naoDislipidemia" value="nao">
                  <label class="form-check-input" for="naoDislipidemia">Não</label>
                </div> 
                <div class="col-sm-10" style="margin-left: 195px;">
                  <textarea class="form-control" name="dislipidemiaText" ></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Etilismo</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="etilismo" type="radio" id="simetilismo" value="sim">
                  <label class="form-check-input" for="simetilismo">Sim</label>
                  <input class="form-check-input" required name="etilismo" type="radio" id="naoetilismo" value="nao">
                  <label class="form-check-input" for="naoetilismo">Não</label>
                </div> 
                <div class="col-sm-10" style="margin-left: 195px;">
                  <textarea class="form-control" name="etilismoText" ></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Hipertensão</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="hipertensao" type="radio" id="simhipertensao" value="sim">
                  <label class="form-check-input" for="simhipertensao">Sim</label>
                  <input class="form-check-input" required name="hipertensao" type="radio" id="naohipertensao" value="nao">
                  <label class="form-check-input" for="naohipertensao">Não</label>
                </div> 
                <div class="col-sm-10" style="margin-left: 195px;">
                  <textarea class="form-control" name="hipertensaoText" ></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Transfusão sanguinea</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="transfusao_sanguinea" type="radio" id="simTransfusaoSanguinea" value="sim">
                  <label class="form-check-input" for="simTransfusaoSanguinea">Sim</label>
                  <input class="form-check-input" required name="transfusao_sanguinea" type="radio" id="naoTransfusaoSanguinea" value="nao">
                  <label class="form-check-input" for="naoTransfusaoSanguinea">Não</label>
                </div> 
                <div class="col-sm-10"style="margin-left: 195px;">
                  <textarea class="form-control" name="transfusao_sanguineaText" ></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Uso de drogas ilícitas</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="drogas_ilicitas" type="radio" id="simDrogasIlicitas" value="sim">
                  <label class="form-check-input" for="simDrogasIlicitas">Sim</label>
                  <input class="form-check-input" required name="drogas_ilicitas" type="radio" id="naoDrogasIlicitas" value="nao">
                  <label class="form-check-input" for="naoDrogasIlicitas">Não</label>
                </div> 
                <div class="col-sm-10" style="margin-left: 195px;">
                  <textarea class="form-control" name="drogas_ilicitasText" ></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Virose na infância</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="virose_infancia" type="radio" id="simViroseInfancia" value="sim">
                  <label class="form-check-input" for="simViroseInfancia">Sim</label>
                  <input class="form-check-input" required name="virose_infancia" type="radio" id="naoViroseInfancia" value="nao">
                  <label class="form-check-input" for="naoViroseInfancia">Não</label>
                </div> 
                <div class="col-sm-10" style="margin-left: 195px;">
                  <textarea class="form-control" name="virose_infanciaText" ></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Outros</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="outros" type="radio" id="simoutros" value="sim">
                  <label class="form-check-input" for="simoutros">Sim</label>
                  <input class="form-check-input" required name="outros" type="radio" id="naooutros" value="nao">
                  <label class="form-check-input" for="naooutros">Não</label>
                </div> 
                <div class="col-sm-10" style="margin-left: 195px;">
                  <textarea class="form-control" name="outrosText" ></textarea>
                </div>
              </div>

            </div>
          </div>

          <legend><h3>AVALIAÇÃO FISIOLÓGICA</h3></legend>

          <div style="border:2px solid #ccc; border-radius:5px; margin-top:10px">
            <div style="margin:20px">
              <legend>1. FUNÇÃO NEUROLÓGICA</legend>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nível de consciência</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="nivel_consciencia" type="radio" id="orientado" value="orientado">
                  <label class="form-check-input" for="orientado">Orientado</label>
                  <input class="form-check-input" required name="nivel_consciencia" type="radio" id="desorientado" value="desorientado">
                  <label class="form-check-input" for="desorientado">Desorientado</label>
                  <input class="form-check-input" required name="nivel_consciencia" type="radio" id="comatoso" value="comatoso">
                  <label class="form-check-input" for="comatoso">Comatoso</label>
                  <input class="form-check-input" required name="nivel_consciencia" type="radio" id="conscienciaOutra" value="outros">
                  <label class="form-check-input" for="conscienciaOutra">Outro</label>
                </div> 
                <div class="col-sm-10" style="margin-left: 195px;">
                  <textarea class="form-control"  name="nivel_conscienciaText"></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Linguagem</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="linguagem" type="radio" id="clara" value="clara">
                  <label class="form-check-input" for="clara">Clara</label>
                  <input class="form-check-input" required name="linguagem" type="radio" id="incompreensivel" value="incompreensivel">
                  <label class="form-check-input" for="incompreensivel">Incompreensível</label>
                  <input class="form-check-input" required name="linguagem" type="radio" id="afasico" value="afasico">
                  <label class="form-check-input" for="afasico">Afásico</label>
                  <input class="form-check-input" required name="linguagem" type="radio" id="barreiraidioma" value="barreira de idioma">
                  <label class="form-check-input" for="barreiraidioma">Barreira de idioma</label>
                  <input class="form-check-input" required name="linguagem" type="radio" id="outroLinguagem" value="outroProblemaLinguagem">
                  <label class="form-check-input" for="outroLinguagem">Outro</label>
                </div> 
                <div class="col-sm-10" style="margin-left: 195px;">
                  <textarea class="form-control"  name="linguagemText"></textarea>
                </div>
              </div>

            </div>
          </div>


          <div style="border:2px solid #ccc; border-radius:5px; margin-top:10px; margin-top:10px">
            <div style="margin:20px">
              <legend>2. SENTIDOS</legend>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alteração na visão</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="alteracao_visao" type="radio" id="simVisao" value="simVisao">
                  <label class="form-check-input" for="simVisao">Sim</label>
                  <input class="form-check-input" required name="alteracao_visao" type="radio" id="naoVisao" value="naoVisao">
                  <label class="form-check-input" for="naoVisao">Não</label>
                  <input class="form-check-input" required name="alteracao_visao" type="radio" id="oculus" value="oculus">
                  <label class="form-check-input" for="oculus">Óculos</label>
                  <input class="form-check-input" required name="alteracao_visao" type="radio" id="lente" value="lente">
                  <label class="form-check-input" for="lente">Lente</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alteração na audição</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="alteracao_audicao" type="radio" id="simAudicao" value="simAudicao">
                  <label class="form-check-input" for="simAudicao">Sim</label>
                  <input class="form-check-input" required name="alteracao_audicao" type="radio" id="naoAudicao" value="naoAudicao">
                  <label class="form-check-input" for="naoAudicao">Não</label>
                  <input class="form-check-input" required name="alteracao_audicao" type="radio" id="aparelhoAuditivo" value="aparelhoAuditivo">
                  <label class="form-check-input" for="aparelhoAuditivo">Aparelho Auditivo</label>
                </div>
              </div>

            </div>
          </div>

          <div style="border:2px solid #ccc; border-radius:5px;  margin-top:10px; margin-top:10px">
            <div style="margin:20px">
            <legend>3. FUNÇÃO RESPIRATÓRIA</legend>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Respiração</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="respiracao" type="radio" id="semAlteracaorespiracao" value="Sem alteracao">
                  <label class="form-check-input" for="semAlteracaorespiracao">Sem alteração</label>
                  <input class="form-check-input" required name="respiracao" type="radio" id="ruidosa" value="ruidosa">
                  <label class="form-check-input" for="ruidosa">Ruidosa</label>
                  <input class="form-check-input" required name="respiracao" type="radio" id="Dispneia" value="Dispneia">
                  <label class="form-check-input" for="Dispneia">Dispneia</label>
                  <input class="form-check-input" required name="respiracao" type="radio" id="aleteonasal" value="Aleteo nasal">
                  <label class="form-check-input" for="aleteonasal">Aleteo nasal</label>
                  <input class="form-check-input" required name="respiracao" type="radio" id="tosse" value="tosse">
                  <label class="form-check-input" for="tosse">Tosse</label>
                  <input class="form-check-input" required name="respiracao" type="radio" id="outroRespiracao" value="outroRespiracao">
                  <label class="form-check-input" for="outroRespiracao">Outro</label>
                </div> 
                <div class="col-sm-10" style="margin-left: 195px;">
                  <textarea class="form-control"  name="respiracaoText"></textarea>
                </div>
              </div>

            </div>
          </div>

          <div style="border:2px solid #ccc; border-radius:5px;  margin-top:10px">
            <div style="margin:20px">
            <legend>4. NUTRIÇÃO</legend>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Apetite</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="apetite" type="radio" id="apetitenormal" value="apetite normal">
                  <label class="form-check-input" for="apetitenormal">Normal</label>
                  <input class="form-check-input" required name="apetite" type="radio" id="apetiteaumentada" value="apetite aumentada">
                  <label class="form-check-input" for="apetiteaumentada">Aumentada</label>
                  <input class="form-check-input" required name="apetite" type="radio" id="apetite diminuido" value="apetite diminuido">
                  <label class="form-check-input" for="apetite diminuido">Diminuido</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Redução da ingestão alimentar na última semana</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="reducao_alimentar" type="radio" id="reducaoSim" value="Redução alimentar">
                  <label class="form-check-input" for="reducaoSim">Sim</label>
                  <input class="form-check-input" required name="reducao_alimentar" type="radio" id="reducaoNao" value="SemRedução">
                  <label class="form-check-input" for="reducaoNao">Não</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Mudança de peso nos últimos 03 meses</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="mudanca_de_peso" type="radio" id="mudancaSim" value="Mudança de peso">
                  <label class="form-check-input" for="mudancaSim">Sim</label>
                  <input class="form-check-input" required name="mudanca_de_peso" type="radio" id="mudancaNao" value="Sem mudança">
                  <label class="form-check-input" for="mudancaNao">Não</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Ingestão diária de líquidos</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="ingestao_agua" type="radio" id="0a5copos" value="0 a 5 copos">
                  <label class="form-check-input" for="0a5copos">0-5 copos</label>
                  <input class="form-check-input" required name="ingestao_agua" type="radio" id="5a10copos" value="5 a 10 copos">
                  <label class="form-check-input" for="5a10copos">5-10 copos</label>
                  <input class="form-check-input" required name="ingestao_agua" type="radio" id="10copos" value="Acima de 10 copos">
                  <label class="form-check-input" for="10copos">> 10 copos</label>
                  <input class="form-check-input" required name="ingestao_agua" type="radio" id="resticao" value="Restrição Hídrica">
                  <label class="form-check-input" for="resticao">Restrição Hídrica</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Prótese</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="protese" type="radio" id="naoProtese" value="Não Protese">
                  <label class="form-check-input" for="naoProtese">Não</label>
                  <input class="form-check-input" required name="protese" type="radio" id="simProtese" value="Protese">
                  <label class="form-check-input" for="simProtese">Sim</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Distúrbios</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="disturbios" type="radio" id="nenhum" value="Nenhum distúrbio">
                  <label class="form-check-input" for="nenhum">Nenhum</label>
                  <input class="form-check-input" required name="disturbios" type="radio" id="nausea" value="Náusea">
                  <label class="form-check-input" for="nausea">Náuseas</label>
                  <input class="form-check-input" required name="disturbios" type="radio" id="dor" value="Dor">
                  <label class="form-check-input" for="dor">Dor</label>
                  <input class="form-check-input" required name="disturbios" type="radio" id="pirose" value="Pirose">
                  <label class="form-check-input" for="pirose">Pirose</label>
                  <input class="form-check-input" required name="disturbios" type="radio" id="disfagia" value="Disfagia">
                  <label class="form-check-input" for="disfagia">Disfagia</label>
                  <input class="form-check-input" required name="disturbios" type="radio" id="lesaonaboca" value="Lesao na boca">
                  <label class="form-check-input" for="lesaonaboca">Lesão na boca</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Uso de sonda</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="uso_de_sonda" type="radio" id="naoSonda" value="Não Sonda">
                  <label class="form-check-input" for="naoSonda">Não</label>
                  <input class="form-check-input" required name="uso_de_sonda" type="radio" id="simSonda" value="Sonda">
                  <label class="form-check-input" for="simSonda">Sim</label>
                  <input class="form-check-input" required name="uso_de_sonda" type="radio" id="gastrotomia" value="gastrotomia">
                  <label class="form-check-input" for="gastrotomia">Gastrotomia</label>
                </div>
              </div>

            </div>
          </div>


          <div style="border:2px solid #ccc; border-radius:5px;  margin-top:10px">
            <div style="margin:20px">
            <legend>5. ELIMINAÇÃO</legend>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Diurese</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="diurese" type="radio" id="semAlteracaodiurese" value="Sem Alteração">
                  <label class="form-check-input" for="semAlteracaodiurese">Sem Alteração</label>
                  <input class="form-check-input" required name="diurese" type="radio" id="incontinencia" value="Incontinência">
                  <label class="form-check-input" for="incontinencia">Incontinência</label>
                  <input class="form-check-input" required name="diurese" type="radio" id="anuria" value="Anúria">
                  <label class="form-check-input" for="anuria">Anúria</label>
                  <input class="form-check-input" required name="diurese" type="radio" id="disuria" value="Disúria">
                  <label class="form-check-input" for="disuria">Disúria</label>
                  <input class="form-check-input" required name="diurese" type="radio" id="hematuria" value="Hematúria">
                  <label class="form-check-input" for="hematuria">Hematúria</label>
                  <input class="form-check-input" required name="diurese" type="radio" id="piuria" value="Piúria">
                  <label class="form-check-input" for="piuria">Piúria</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Uso de sonda</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="uso_de_sonda_diurese" type="radio" id="naoUsoDeSonda" value="Não uso de sonda">
                  <label class="form-check-input" for="naoUsoDeSonda">Não</label>
                  <input class="form-check-input" required name="uso_de_sonda_diurese" type="radio" id="sondaFoley" value="Foley">
                  <label class="form-check-input" for="sondaFoley">Sonda Foley</label>
                  <input class="form-check-input" required name="uso_de_sonda_diurese" type="radio" id="cistostamia" value="Cistostamia">
                  <label class="form-check-input" for="cistostamia">Cistostamia</label>
                </div>
              </div>


              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Ritmo Intestinal</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="ritmo_intestinal" type="radio" id="semAlteracaoRitimo" value="Sem Alteração">
                  <label class="form-check-input" for="semAlteracaoRitimo">Sem Alteração</label>
                  <input class="form-check-input" required name="ritmo_intestinal" type="radio" id="ritmoLento" value="Ritmo Lento">
                  <label class="form-check-input" for="ritmoLento">Lento</label>
                  <input class="form-check-input" required name="ritmo_intestinal" type="radio" id="ritmoAcelerado" value="Acelerado">
                  <label class="form-check-input" for="ritmoAcelerado">Acelerado</label>
                  <input class="form-check-input" required name="ritmo_intestinal" type="radio" id="flatulencia" value="Flatulência">
                  <label class="form-check-input" for="flatulencia">Flatulência</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Abdome</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="abdome" type="radio" id="globoso" value="Globoso">
                  <label class="form-check-input" for="globoso">Globoso</label>
                  <input class="form-check-input" required name="abdome" type="radio" id="flacido" value="Flácido">
                  <label class="form-check-input" for="flacido">Flácido</label>
                  <input class="form-check-input" required name="abdome" type="radio" id="distendido" value="Distendido">
                  <label class="form-check-input" for="distendido">Distendido</label>
                  <input class="form-check-input" required name="abdome" type="radio" id="ascitico" value="Ascitico">
                  <label class="form-check-input" for="ascitico">Ascitico</label>
                  <input class="form-check-input" required name="abdome" type="radio" id="escavado" value="Escavado">
                  <label class="form-check-input" for="escavado">Escavado</label>
                  <input class="form-check-input" required name="abdome" type="radio" id="timpanico" value="Timpânico">
                  <label class="form-check-input" for="timpanico">Timpânico</label>
                  <input class="form-check-input" required name="abdome" type="radio" id="plano" value="Plano">
                  <label class="form-check-input" for="plano">Plano</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Vômito</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="vomito" type="radio" id="simVomito" value="Sim">
                  <label class="form-check-input" for="simVomito">Sim</label>
                  <input class="form-check-input" required name="vomito" type="radio" id="naoVomito" value="Não">
                  <label class="form-check-input" for="naoVomito">Não</label>
                </div>
              </div>

            </div>
          </div>


          <div style="border:2px solid #ccc; border-radius:5px;  margin-top:10px">
            <div style="margin:20px">
            <legend>6. APARELHO GENITO-URINÁRIO</legend>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alteração</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="aparelho_urinario" type="radio" id="simAparelhoUrinario" value="sim">
                  <label class="form-check-input" for="simAparelhoUrinario">Sim</label>
                  <input class="form-check-input" required name="aparelho_urinario" type="radio" id="naoAparelhoUrinario" value="Não">
                  <label class="form-check-input" for="naoAparelhoUrinario">Não</label>
                  <input class="form-check-input" required name="aparelho_urinario" type="radio" id="naoOBservado" value="Não Observado">
                  <label class="form-check-input" for="naoOBservado">Não Observado</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Menopausa</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="menopausa" type="radio" id="menopausasim" value="Menopausa">
                  <label class="form-check-input" for="menopausasim">Sim</label>
                  <input class="form-check-input" required name="menopausa" type="radio" id="menopausanao" value="Não">
                  <label class="form-check-input" for="menopausanao">Não</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Preventivo / Próstata</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="preventivo_prostata" type="radio" id="preventivo_prostatasim" value="Prostata">
                  <label class="form-check-input" for="preventivo_prostatasim">Sim</label>
                  <input class="form-check-input" required name="preventivo_prostata" type="radio" id="preventivo_prostatanao" value="Não">
                  <label class="form-check-input" for="preventivo_prostatanao">Não</label>
                </div>
              </div>

            </div>
          </div>

          <div style="border:2px solid #ccc; border-radius:5px;  margin-top:10px">
            <div style="margin:20px">
            <legend>7. PELE</legend>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Cor</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="pele" type="radio" id="peleSemAlteracao" value="Pele sem alteração">
                  <label class="form-check-input" for="peleSemAlteracao">Sem alteração</label>
                  <input class="form-check-input" required name="pele" type="radio" id="cianose" value="Cianose">
                  <label class="form-check-input" for="cianose">Cianose</label>
                  <input class="form-check-input" required name="pele" type="radio" id="Ictericia" value="Icterícia">
                  <label class="form-check-input" for="Ictericia">Icterícia</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tugor / Elasticidade</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="tugor_elasticidade" type="radio" id="tugor_elasticidadeSemAlteracao" value="Sem Alteração">
                  <label class="form-check-input" for="tugor_elasticidadeSemAlteracao">Sem alteração</label>
                  <input class="form-check-input" required name="tugor_elasticidade" type="radio" id="Elasticidade" value="Elasticidade">
                  <label class="form-check-input" for="Elasticidade">Elasticidade</label>
                  <input class="form-check-input" required name="tugor_elasticidade" type="radio" id="tugordiminuido" value="Tugor diminuido">
                  <label class="form-check-input" for="tugordiminuido">Diminuído</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Edema</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="edema" type="radio" id="edemaSim" value="Edema">
                  <label class="form-check-input" for="edemaSim">Sim</label>
                  <input class="form-check-input" required name="edema" type="radio" id="naoEdema" value="Não edema">
                  <label class="form-check-input" for="naoEdema">Não</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Prurido</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="prurido" type="radio" id="PruridoSim" value="Prurido">
                  <label class="form-check-input" for="PruridoSim">Sim</label>
                  <input class="form-check-input" required name="prurido" type="radio" id="naoPrurido" value="Não Prurido">
                  <label class="form-check-input" for="naoPrurido">Não</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Lesão</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="lesao" type="radio" id="lesaoSim" value="Hematomas e equimoses na pele">
                  <label class="form-check-input" for="lesaoSim">Sim</label>
                  <input class="form-check-input" required name="lesao" type="radio" id="naolesao" value="Não lesao">
                  <label class="form-check-input" for="naolesao">Não</label>
                </div>
              </div>

            </div>
          </div>

          <div style="border:2px solid #ccc; border-radius:5px;  margin-top:10px">
            <div style="margin:20px">
            <legend>8. ATIVIDADE E REPOUSO</legend>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Sedentarismo</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="sedentarismo" type="radio" id="sedentarismoSim" value="sedentário">
                  <label class="form-check-input" for="sedentarismoSim">Sim</label>
                  <input class="form-check-input" required name="sedentarismo" type="radio" id="naosedentarismo" value="Não sedentarismo">
                  <label class="form-check-input" for="naosedentarismo">Não</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Dificuldade para dormir</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="dificuldade_dormir" type="radio" id="dificuldade_dormirSim" value="Dificuldade para iniciar o sono">
                  <label class="form-check-input" for="dificuldade_dormirSim">Sim</label>
                  <input class="form-check-input" required name="dificuldade_dormir" type="radio" id="naodificuldade_dormir" value="Não dificuldade dormir">
                  <label class="form-check-input" for="naodificuldade_dormir">Não</label>
                </div>
              </div>


              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Aux. para dormir</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required name="aux_dormir" type="radio" id="aux_dormirSim" value="farmacológico">
                  <label class="form-check-input" for="aux_dormirSim">Sim</label>
                  <input class="form-check-input" required name="aux_dormir" type="radio" id="naoaux_dormir" value="Sem auxilio para dormir">
                  <label class="form-check-input" for="naoaux_dormir">Não</label>
                </div>
              </div>

            </div>
          </div>
          <div style="margin-top:20px; margin-bottom:70px">
            <button type="submit" class="btn btn-success" >Diagnostico</button>
          </div>
          <?php
        }
        ?>

        </form>
        </fieldset>
        

     
            
	</div>
</div>
</body>
</html>