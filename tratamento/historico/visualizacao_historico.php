
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
$hist   =  mysqli_query($conn, "SELECT * FROM historicos_enf  WHERE paciente_id = '$row_dados[paciente_id]'");
$data_hist         =  mysqli_fetch_assoc($hist);


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
	 	<div class="toggle-btn" onclick="toggleSidebar()"><a>
	 		<i class="fas fa-bars"></i>
		    </a>
		</div>
	<div class="faixa"></div>
	</div>
    <div id="sidebar">
        <b><a href="../../prontuario.php?alterar=<?php echo $row_dados['paciente_id']; ?>">Gerenciamento do Prontuário</a></b><hr/>
    </div>
	<div id="content" >
  
        <input type="hidden" name="paciente_id" value="<?php echo $row_dados['paciente_id']; ?>">
        <input type="hidden" name="usuario_id" value="<?php echo $row_dados['usuario_id']; ?>">
        <input type="hidden" name="endereco_id" value="<?php echo $row_dados['endereco_id']; ?>">

        <br><br>
		<div class="faixa navbar-default navbar-fixed-top" style="margin-top: 52px;" >
			<div class="coluna1">
				
			</div>
			<div class="" style="margin-left:220px; margin-top:7px ; margin-right:20px;">
				<input type="text" style="background-color:lightgreen" name="nome" disabled value="Paciente: <?php echo $row_dados['nome']; ?>">

        <?php
          if( $data_hist['vomito'] == 'Sim' && $data_hist['dor'] == 'sim' && $data_hist['abdome'] == 'Distendido' ){ ?>
           <div class="alert alert-danger" role="alert">
               O diagnostico constou CONSTIPAÇÃO
          </div>
         <?php } 
          elseif($data_hist['vomito'] == 'Sim' && $data_hist['ritmo_intestinal'] == 'Flatulência' && ($data_hist['estadoEmocional'] == 'anisoso' || $data_hist['estadoEmocional'] == 'agitado')  ){ ?>
           <div class="alert alert-danger" role="alert">
               O diagnostico constou CONSTIPAÇÃO
          </div>
         <?php } 
          elseif($data_hist['dor'] == 'sim' && $data_hist['abdome'] == 'Distendido' && $data_hist['ritmo_intestinal'] == 'Flatulência' ){ ?>
           <div class="alert alert-danger" role="alert">
               O diagnostico constou CONSTIPAÇÃO
          </div>
         <?php } 
          elseif($data_hist['dor'] == 'sim' && $data_hist['ritmo_intestinal'] == 'Flatulência' && ($data_hist['estadoEmocional'] == 'anisoso' || $data_hist['estadoEmocional'] == 'agitado')  ){ ?>
           <div class="alert alert-danger" role="alert">
               O diagnostico constou CONSTIPAÇÃO
          </div>
         <?php }
          elseif($data_hist['dor'] == 'sim' && $data_hist['ritmo_intestinal'] == 'Flatulência' && $data_hist['vomito'] == 'Sim'  ){ ?>
            <div class="alert alert-danger" role="alert">
                O diagnostico constou CONSTIPAÇÃO
           </div>
          <?php } 
          elseif($data_hist['dor'] == 'sim' && ($data_hist['estadoEmocional'] == 'anisoso' || $data_hist['estadoEmocional'] == 'agitado') && $data_hist['vomito'] == 'Sim' ){ ?>
           <div class="alert alert-danger" role="alert">
               O diagnostico constou CONSTIPAÇÃO
          </div>
         <?php } 
          elseif($data_hist['abdome'] == 'Distendido' && $data_hist['ritmo_intestinal'] == 'Flatulência' && ($data_hist['estadoEmocional'] == 'anisoso' || $data_hist['estadoEmocional'] == 'agitado')  ){ ?>
           <div class="alert alert-danger" role="alert">
               O diagnostico constou CONSTIPAÇÃO
          </div>
         <?php } 
          elseif($data_hist['abdome'] == 'Distendido' && ($data_hist['estadoEmocional'] == 'anisoso' || $data_hist['estadoEmocional'] == 'agitado') && $data_hist['vomito'] == 'Sim'  ){ ?>
           <div class="alert alert-danger" role="alert">
               O diagnostico constou CONSTIPAÇÃO
          </div>
         <?php } 
          elseif($data_hist['ritmo_intestinal'] == 'Flatulência' && ($data_hist['estadoEmocional'] == 'anisoso' || $data_hist['estadoEmocional'] == 'agitado') && $data_hist['vomito'] == 'Sim' ){ ?>
           <div class="alert alert-danger" role="alert">
               O diagnostico constou CONSTIPAÇÃO
          </div>
         <?php } 

        elseif($data_hist['abdome'] == 'Distendido' && ($data_hist['estadoEmocional'] == 'anisoso' || $data_hist['estadoEmocional'] == 'agitado') && $data_hist['dor'] == 'sim' ){ ?>
          <div class="alert alert-danger" role="alert">
              O diagnostico constou CONSTIPAÇÃO
        </div>
        <?php } 

        elseif($data_hist['ritmo_intestinal'] == 'Flatulência' &&  $data_hist['dor'] == 'sim' && $data_hist['vomito'] == 'Sim' ){ ?>
          <div class="alert alert-danger" role="alert">
              O diagnostico constou CONSTIPAÇÃO
        </div>
        <?php } 

        ?>
			</div>
		</div>
        <fieldset id="admissao">
        <legend><h3>ADMISSÃO</h3></legend>

        <form method="POST" action="tratar.php">

        <input type="hidden" name="paciente_id" value="<?php echo $row_dados['paciente_id']; ?>">

          <div style="border:2px solid #ccc; border-radius:5px">
            <div style="margin:20px">
              <label>Entrada</label>
              <div class="form-group row">
                <label for="leito" class="col-sm-2 col-form-label">Leito</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control-plaintext" id="leito" name="leito" disabled value="<?php echo $data_hist['leito']; ?>">
                </div>
              </div>

              <div class="form-group row">
                <label for="unidade" class="col-sm-2 col-form-label">Unidade</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="unidade" name="unidade"disabled value="<?php echo $data_hist['unidade']; ?>">
                </div>
              </div>

              <div class="form-group row">
                <label for="data" class="col-sm-2 col-form-label">Data</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="data" name="data_hora"disabled value="<?php echo date('d/m/Y - H:i', strtotime($data_hist['data_hora'])); ?>">
                </div>
              </div>

            </div>
          </div>

          <div style="border:2px solid #ccc; border-radius:5px; margin-top:10px">
            <div style="margin:20px">

                <div class="form-group row">
                  <label for="origem" class="col-sm-2 col-form-label">Origem</label>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio"    disabled name="origem" id="domicilio" value="Domicílio"<?php if($data_hist['origem'] == "Domicílio"){?>  checked="checked" <?php }?>>
                    <label class="form-check-label" for="domicilio">Domicílio</label>
                    <input class="form-check-input" type="radio" <?php if($data_hist['origem'] == "Ambulatório"){?>  checked="checked" <?php }?>   disabled name="origem" id="ambulatorio" value="Ambulatório">
                    <label class="form-check-label" for="ambulatorio">Ambulatório</label>
                    <input class="form-check-input" type="radio" <?php if($data_hist['origem'] == "Emergência"){?>  checked="checked" <?php }?>   disabled name="origem" id="emergencia" value="Emergência">
                    <label class="form-check-label" for="emergencia">Emergência</label>
                    <input class="form-check-input" type="radio" <?php if($data_hist['origem'] == "OutrosHospitais"){?>  checked="checked" <?php }?>   disabled name="origem" id="outrosHospitais" value="OutrosHospitais">
                    <label class="form-check-label" for="outrosHospitais">Outros Hospitais</label>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Condição de Chegada</label>
                  <div class="form-check form-check-inline">
                    <input  type="radio"  name="condicaoChegada" id="ambulancia" <?php if($data_hist['condicaoChegada'] == "ambulancia"){?>  checked="checked" <?php }?>   disabled value="ambulancia">
                    <label  for="ambulancia">De ambulância</label>
                    <input  type="radio" name="condicaoChegada" id="maca" <?php if($data_hist['condicaoChegada'] == "maca"){?>  checked="checked" <?php }?>   disabled value="maca">
                    <label  for="maca">Maca</label>
                    <input  type="radio"  name="condicaoChegada" id="cadeiraRodas" <?php if($data_hist['condicaoChegada'] == "cadeiraRodas"){?>  checked="checked" <?php }?>   disabled value="cadeiraRodas">
                    <label  for="cadeiraRodas">Cadeira de rodas</label>
                    <input  type="radio" name="condicaoChegada" id="colo" <?php if($data_hist['condicaoChegada'] == "colo"){?>  checked="checked" <?php }?>   disabled value="colo">
                    <label  for="colo">Colo</label>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Estado emocional</label>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" <?php if($data_hist['estadoEmocional'] == "calmo"){?>  checked="checked" <?php }?>   disabled name="estadoEmocional" id="calmo" value="calmo">
                    <label class="form-check-label" for="calmo">Calmo</label>
                    <input class="form-check-input" type="radio" <?php if($data_hist['estadoEmocional'] == "ansioso"){?>  checked="checked" <?php }?>   disabled name="estadoEmocional" id="ansioso" value="ansioso">
                    <label class="form-check-label" for="ansioso">Ansioso</label>
                    <input class="form-check-input" type="radio" <?php if($data_hist['estadoEmocional'] == "agitado"){?>  checked="checked" <?php }?>   disabled name="estadoEmocional" id="agitado" value="agitado">
                    <label class="form-check-label" for="agitado">Agitado</label>
                    <input class="form-check-input" type="radio" <?php if($data_hist['estadoEmocional'] == "outros"){?>  checked="checked" <?php }?>   disabled name="estadoEmocional" id="outros" value="outros">
                    <label class="form-check-label" for="outros">Outros</label>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Alteração na saúde recentemente</label>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" <?php if($data_hist['saude_recentemente'] == "sim"){?>  checked="checked" <?php }?>   disabled name="saude_recentemente" id="sim" value="sim">
                    <label class="form-check-label" for="sim">Sim</label>
                    <input class="form-check-input" type="radio" <?php if($data_hist['saude_recentemente'] == "nao"){?>  checked="checked" <?php }?>   disabled name="saude_recentemente" id="nao" value="nao">
                    <label class="form-check-label" for="nao">Não</label>
                  </div>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="usaude_recentementenidade" name="saude_recentementeText" disabled value="<?php echo $data_hist['saude_recentementeText']; ?>">
                  </div>
                </div>


                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Informante do quadro de saúde</label>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" <?php if($data_hist['informante'] == "responsavel"){?>  checked="checked" <?php }?>   disabled name="informante" id="informanteResponsavel" value="responsavel">
                    <label class="form-check-input" for="informanteResponsavel">Responsável</label>
                    <input class="form-check-input" type="radio" <?php if($data_hist['informante'] == "paciente"){?>  checked="checked" <?php }?>   disabled name="informante" id="paciente" value="paciente">
                    <label class="form-check-input" for="paciente">Paciente</label> 
                  </div> 
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="informanteResponsavel" name="informanteResponsavel" disabled value="<?php echo $data_hist['informanteResponsavel']; ?>">
                  </div>
                </div>

                <div class="form-group row">
                <label for="data" class="col-sm-2 col-form-label">Motivo da internação</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="motivoInternacao" name="motivo_internacao" disabled value="<?php echo $data_hist['motivo_internacao']; ?>">
                </div>
              </div>


              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Dor</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" <?php if($data_hist['dor'] == "sim"){?>  checked="checked" <?php }?>   disabled name="dor" id="simSenteDor" value="sim">
                  <label class="form-check-label" for="simSenteDor">Sim</label>
                  <input class="form-check-input" type="radio" <?php if($data_hist['dor'] == "nao"){?>  checked="checked" <?php }?>   disabled name="dor" id="naoSenteDor" value="nao">
                  <label class="form-check-label" for="naoSenteDor">Não</label>
                </div>
              </div>

              <div class="form-group row">
                <label for="data" class="col-sm-2 col-form-label">Queixa principal</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="queixa_principal" id="queixaPrincipal" disabled value="<?php echo $data_hist['queixa_principal']; ?>">
                </div>
              </div>

              <div class="form-group row">
                <label for="data" class="col-sm-2 col-form-label">Quando iniciou</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="quando_iniciou" id="quandoIniciou" disabled value="<?php echo $data_hist['quando_iniciou']; ?>">
                </div>
              </div>

              <div class="form-group row">
                <label for="data" class="col-sm-2 col-form-label">Como foi controlada em casa</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="tratamento_em_casa" id="tratamentoEmCasa" disabled value="<?php echo $data_hist['tratamento_em_casa']; ?>">
                </div>
              </div>
              
              <div class="form-group row">
                <label for="data" class="col-sm-2 col-form-label">Grupo sanguíneo/Fator RH</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="tipo_sanguineo" id="grupoSanguineoeFatorRH" disabled value="<?php echo $data_hist['tipo_sanguineo']; ?>">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alergias especificas</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="alergia" type="radio" <?php if($data_hist['alergia'] == "nao"){?>  checked="checked" <?php }?>   disabled id="semAlergia" value="nao">
                  <label class="form-check-input" for="semAlergia">Não</label>
                  <input class="form-check-input" name="alergia" type="radio" <?php if($data_hist['alergia'] == "medicamentosa"){?>  checked="checked" <?php }?>   disabled id="alergiaMedicamentos" value="medicamentosa">
                  <label class="form-check-input" for="alergiaMedicamentos">Medicamentosa</label>
                  <input class="form-check-input" name="alergia" type="radio" <?php if($data_hist['alergia'] == "alimentar"){?>  checked="checked" <?php }?>   disabled id="alergiaAlimentos" value="alimentar">
                  <label class="form-check-input" for="alergiaAlimentos">Alimentar</label>
                  <input class="form-check-input" name="alergia" type="radio" <?php if($data_hist['alergia'] == "outros"){?>  checked="checked" <?php }?>   disabled id="alergiaOutrass" value="outros">
                  <label class="form-check-input" for="alergiaOutrass">Outras</label>
                </div> 
                <div class="col-sm-10"style="margin-left: 195px;">
                  <input type="text" class="form-control" name="alergiaText" id="alergiasOutras"disabled value="<?php echo $data_hist['alergiaText']; ?>">
                </div>
              </div>

              <div class="form-group row">
                <label for="data" class="col-sm-2 col-form-label">Hospitalização anterior</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="hospitalizacao_anterior" id="hospitalizacaoAnterior"disabled value="<?php echo $data_hist['hospitalizacao_anterior']; ?>">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Cirugias anteriores</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="cirurgia_anteriores" type="radio" <?php if($data_hist['cirurgia_anteriores'] == "sim"){?>  checked="checked" <?php }?>   disabled id="simCirurgias" value="sim">
                  <label class="form-check-input" for="simCirurgias">Sim</label>
                  <input class="form-check-input" name="cirurgia_anteriores" type="radio" <?php if($data_hist['cirurgia_anteriores'] == "nao"){?>  checked="checked" <?php }?>   disabled id="naoCirurgias" value="nao">
                  <label class="form-check-input" for="naoCirurgias">Não</label>
                </div> 
                <div class="col-sm-10"style="margin-left: 195px;">
                  <input type="text" class="form-control" name="cirurgiaRealizada" id="cirurgias"disabled value="<?php echo $data_hist['cirurgiaRealizada']; ?>">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Exames recentes</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="exames_recentes" type="radio" <?php if($data_hist['exames_recentes'] == "sim"){?>  checked="checked" <?php }?>   disabled id="simExameRecente" value="sim">
                  <label class="form-check-input" for="simExameRecente">Sim</label>
                  <input class="form-check-input" name="exames_recentes" type="radio" <?php if($data_hist['exames_recentes'] == "nao"){?>  checked="checked" <?php }?>   disabled id="naoExameRecente" value="nao">
                  <label class="form-check-input" for="naoExameRecente">Não</label>
                </div> 
                <div class="col-sm-10"style="margin-left: 195px;">
                  <input type="text" class="form-control"name="exameRecente" disabled value="<?php echo $data_hist['exameRecente']; ?>">
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
                  <input class="form-check-input" name="tabagismo" type="radio" <?php if($data_hist['tabagismo'] == "sim"){?>  checked="checked" <?php }?>   disabled id="simTabagismo" value="sim">
                  <label class="form-check-input" for="simTabagismo">Sim</label>
                  <input class="form-check-input" name="tabagismo" type="radio" <?php if($data_hist['tabagismo'] == "nao"){?>  checked="checked" <?php }?>   disabled id="naoTabagismo" value="nao">
                  <label class="form-check-input" for="naoTabagismo">Não</label>
                </div> 
                <div class="col-sm-10"style="margin-left: 195px;">
                  <input type="text" class="form-control"name="tabagismoText"disabled value="<?php echo $data_hist['tabagismoText']; ?>" >
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Neoplasia</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="neoplasia" type="radio" <?php if($data_hist['neoplasia'] == "sim"){?>  checked="checked" <?php }?>   disabled id="simneoplasia" value="sim">
                  <label class="form-check-input" for="simneoplasia">Sim</label>
                  <input class="form-check-input" name="neoplasia" type="radio" <?php if($data_hist['neoplasia'] == "nao"){?>  checked="checked" <?php }?>   disabled id="naoneoplasia" value="nao">
                  <label class="form-check-input" for="naoneoplasia">Não</label>
                </div> 
                <div class="col-sm-10"style="margin-left: 195px;">
                  <input type="text" class="form-control"name="neoplasiaText" disabled value="<?php echo $data_hist['neoplasiaText']; ?>">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Doença auto imune</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="doenca_auto_imune" type="radio" <?php if($data_hist['doenca_auto_imune'] == "sim"){?>  checked="checked" <?php }?>   disabled id="simDoencaAutoImune" value="sim">
                  <label class="form-check-input" for="simDoencaAutoImune">Sim</label>
                  <input class="form-check-input" name="doenca_auto_imune" type="radio" <?php if($data_hist['doenca_auto_imune'] == "nao"){?>  checked="checked" <?php }?>   disabled id="naoDoencaAutoImune" value="nao">
                  <label class="form-check-input" for="naoDoencaAutoImune">Não</label>
                </div> 
                <div class="col-sm-10"style="margin-left: 195px;">
                  <input type="text" class="form-control"name="doenca_auto_imuneText" disabled value="<?php echo $data_hist['doenca_auto_imune']; ?>">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Doença respiratória</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="doenca_respiratoria" type="radio" <?php if($data_hist['doenca_respiratoria'] == "sim"){?>  checked="checked" <?php }?>   disabled id="simDoencaRespiratoria" value="sim">
                  <label class="form-check-input" for="simDoencaRespiratoria">Sim</label>
                  <input class="form-check-input" name="doenca_respiratoria" type="radio" <?php if($data_hist['doenca_respiratoria'] == "nao"){?>  checked="checked" <?php }?>   disabled id="naoDoencaRespiratoria" value="nao">
                  <label class="form-check-input" for="naoDoencaRespiratoria">Não</label>
                </div> 
                <div class="col-sm-10"style="margin-left: 195px;">
                  <input type="text" class="form-control"name="doenca_respiratoriaText"disabled value="<?php echo $data_hist['doenca_respiratoriaText']; ?>" >
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Doença renal</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="doenca_renal" type="radio" <?php if($data_hist['doenca_renal'] == "sim"){?>  checked="checked" <?php }?>   disabled id="simDoencaRenal" value="sim">
                  <label class="form-check-input" for="simDoencaRenal">Sim</label>
                  <input class="form-check-input" name="doenca_renal" type="radio" <?php if($data_hist['doenca_renal'] == "nao"){?>  checked="checked" <?php }?>   disabled id="naoDoencaRenal" value="nao">
                  <label class="form-check-input" for="naoDoencaRenal">Não</label>
                </div> 
                <div class="col-sm-10"style="margin-left: 195px;">
                  <input type="text" class="form-control"name="doenca_renalText"disabled value="<?php echo $data_hist['doenca_renalText']; ?>" >
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Doença cardiovascular</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="doenca_cardiovascular" type="radio" <?php if($data_hist['doenca_cardiovascular'] == "sim"){?>  checked="checked" <?php }?>   disabled id="simDoencaCardiovascular" value="sim">
                  <label class="form-check-input" for="simDoencaCardiovascular">Sim</label>
                  <input class="form-check-input" name="doenca_cardiovascular" type="radio" <?php if($data_hist['doenca_cardiovascular'] == "nao"){?>  checked="checked" <?php }?>   disabled id="naoDoencaCardiovascular" value="nao">
                  <label class="form-check-input" for="naoDoencaCardiovascular">Não</label>
                </div> 
                <div class="col-sm-10"style="margin-left: 195px;">
                  <input type="text" class="form-control"name="doenca_cardiovascularText"disabled value="<?php echo $data_hist['doenca_cardiovascularText']; ?>" >
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Diabetes</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="diabetes" type="radio" <?php if($data_hist['diabetes'] == "sim"){?>  checked="checked" <?php }?>   disabled id="simdiabetes" value="sim">
                  <label class="form-check-input" for="simdiabetes">Sim</label>
                  <input class="form-check-input" name="diabetes" type="radio" <?php if($data_hist['diabetes'] == "nao"){?>  checked="checked" <?php }?>   disabled id="naodiabetes" value="nao">
                  <label class="form-check-input" for="naodiabetes">Não</label>
                </div> 
                <div class="col-sm-10"style="margin-left: 195px;">
                  <input type="text" class="form-control"name="diabetesText"disabled value="<?php echo $data_hist['diabetesText']; ?>" >
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Distúrbios comportamentais</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="disturbios_comportamentais" type="radio" <?php if($data_hist['disturbios_comportamentais'] == "sim"){?>  checked="checked" <?php }?>   disabled id="simDisturbiosComportamentais" value="sim">
                  <label class="form-check-input" for="simDisturbiosComportamentais">Sim</label>
                  <input class="form-check-input" name="disturbios_comportamentais" type="radio" <?php if($data_hist['disturbios_comportamentais'] == "nao"){?>  checked="checked" <?php }?>   disabled id="naoDisturbiosComportamentais" value="nao">
                  <label class="form-check-input" for="naoDisturbiosComportamentais">Não</label>
                </div> 
                <div class="col-sm-10">
                  <input type="text" class="form-control"name="disturbiosComportamentaisText" disabled value="<?php echo $data_hist['disturbiosComportamentaisText']; ?>">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Doenças infectocontagiosas</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="donecas_infectocontagiosas" type="radio" <?php if($data_hist['donecas_infectocontagiosas'] == "sim"){?>  checked="checked" <?php }?>   disabled id="simDoencasInfectocontagiosas" value="sim">
                  <label class="form-check-input" for="simDoencasInfectocontagiosas">Sim</label>
                  <input class="form-check-input" name="donecas_infectocontagiosas" type="radio" <?php if($data_hist['donecas_infectocontagiosas'] == "nao"){?>  checked="checked" <?php }?>   disabled id="naoDoencasInfectocontagiosas" value="nao">
                  <label class="form-check-input" for="naoDoencasInfectocontagiosas">Não</label>
                </div> 
                <div class="col-sm-10">
                  <input type="text" class="form-control"name="donecas_infectocontagiosasText" disabled value="<?php echo $data_hist['donecas_infectocontagiosasText']; ?>">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Dislipidemia</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="dislipidemia" type="radio" <?php if($data_hist['dislipidemia'] == "sim"){?>  checked="checked" <?php }?>   disabled id="simDislipidemia" value="sim">
                  <label class="form-check-input" for="simDislipidemia">Sim</label>
                  <input class="form-check-input" name="dislipidemia" type="radio" <?php if($data_hist['dislipidemia'] == "nao"){?>  checked="checked" <?php }?>   disabled id="naoDislipidemia" value="nao">
                  <label class="form-check-input" for="naoDislipidemia">Não</label>
                </div> 
                <div class="col-sm-10"style="margin-left: 195px;">
                  <input type="text" class="form-control"name="dislipidemiaText"disabled value="<?php echo $data_hist['dislipidemiaText']; ?>" >
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Etilismo</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="etilismo" type="radio" <?php if($data_hist['etilismo'] == "sim"){?>  checked="checked" <?php }?>   disabled id="simetilismo" value="sim">
                  <label class="form-check-input" for="simetilismo">Sim</label>
                  <input class="form-check-input" name="etilismo" type="radio" <?php if($data_hist['etilismo'] == "nao"){?>  checked="checked" <?php }?>   disabled id="naoetilismo" value="nao">
                  <label class="form-check-input" for="naoetilismo">Não</label>
                </div> 
                <div class="col-sm-10"style="margin-left: 195px;">
                  <input type="text" class="form-control"name="etilismoText" disabled value="<?php echo $data_hist['etilismoText']; ?>" >
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Hipertensão</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="hipertensao" type="radio" <?php if($data_hist['hipertensao'] == "sim"){?>  checked="checked" <?php }?>   disabled id="simhipertensao" value="sim">
                  <label class="form-check-input" for="simhipertensao">Sim</label>
                  <input class="form-check-input" name="hipertensao" type="radio" <?php if($data_hist['hipertensao'] == "nao"){?>  checked="checked" <?php }?>   disabled id="naohipertensao" value="nao">
                  <label class="form-check-input" for="naohipertensao">Não</label>
                </div> 
                <div class="col-sm-10"style="margin-left: 195px;">
                  <input type="text" class="form-control"name="hipertensaoText"disabled value="<?php echo $data_hist['hipertensaoText']; ?>" >
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Transfusão sanguinea</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="transfusao_sanguinea" type="radio" <?php if($data_hist['transfusao_sanguinea'] == "sim"){?>  checked="checked" <?php }?>   disabled id="simTransfusaoSanguinea" value="sim">
                  <label class="form-check-input" for="simTransfusaoSanguinea">Sim</label>
                  <input class="form-check-input" name="transfusao_sanguinea" type="radio" <?php if($data_hist['transfusao_sanguinea'] == "nao"){?>  checked="checked" <?php }?>   disabled id="naoTransfusaoSanguinea" value="nao">
                  <label class="form-check-input" for="naoTransfusaoSanguinea">Não</label>
                </div> 
                <div class="col-sm-10"style="margin-left: 195px;">
                  <input type="text" class="form-control"name="transfusao_sanguineaText"disabled value="<?php echo $data_hist['transfusao_sanguineaText']; ?>" >
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Uso de drogas ilícitas</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="drogas_ilicitas" type="radio" <?php if($data_hist['drogas_ilicitas'] == "sim"){?>  checked="checked" <?php }?>   disabled id="simDrogasIlicitas" value="sim">
                  <label class="form-check-input" for="simDrogasIlicitas">Sim</label>
                  <input class="form-check-input" name="drogas_ilicitas" type="radio" <?php if($data_hist['drogas_ilicitas'] == "nao"){?>  checked="checked" <?php }?>   disabled id="naoDrogasIlicitas" value="nao">
                  <label class="form-check-input" for="naoDrogasIlicitas">Não</label>
                </div> 
                <div class="col-sm-10"style="margin-left: 195px;">
                  <input type="text" class="form-control"name="drogas_ilicitasText"disabled value="<?php echo $data_hist['drogas_ilicitasText']; ?>" >
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Virose na infância</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="virose_infancia" type="radio" <?php if($data_hist['virose_infancia'] == "sim"){?>  checked="checked" <?php }?>   disabled id="simViroseInfancia" value="sim">
                  <label class="form-check-input" for="simViroseInfancia">Sim</label>
                  <input class="form-check-input" name="virose_infancia" type="radio" <?php if($data_hist['virose_infancia'] == "nao"){?>  checked="checked" <?php }?>   disabled id="naoViroseInfancia" value="nao">
                  <label class="form-check-input" for="naoViroseInfancia">Não</label>
                </div> 
                <div class="col-sm-10"style="margin-left: 195px;">
                  <input type="text" class="form-control"name="virose_infanciaText"disabled value="<?php echo $data_hist['virose_infanciaText']; ?>" >
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Outros</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="outros" type="radio" <?php if($data_hist['outros'] == "sim"){?>  checked="checked" <?php }?>   disabled id="simoutros" value="sim">
                  <label class="form-check-input" for="simoutros">Sim</label>
                  <input class="form-check-input" name="outros" type="radio" <?php if($data_hist['outros'] == "nao"){?>  checked="checked" <?php }?>   disabled id="naooutros" value="nao">
                  <label class="form-check-input" for="naooutros">Não</label>
                </div> 
                <div class="col-sm-10"style="margin-left: 195px;">
                  <input type="text" class="form-control"name="outrosText" disabled value="<?php echo $data_hist['outrosText']; ?>">
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
                  <input class="form-check-input" name="nivel_consciencia" type="radio" <?php if($data_hist['nivel_consciencia'] == "orientado"){?>  checked="checked" <?php }?>   disabled id="orientado" value="orientado">
                  <label class="form-check-input" for="orientado">Orientado</label>
                  <input class="form-check-input" name="nivel_consciencia" type="radio" <?php if($data_hist['nivel_consciencia'] == "desorientado"){?>  checked="checked" <?php }?>   disabled id="desorientado" value="desorientado">
                  <label class="form-check-input" for="desorientado">Desorientado</label>
                  <input class="form-check-input" name="nivel_consciencia" type="radio" <?php if($data_hist['nivel_consciencia'] == "comatoso"){?>  checked="checked" <?php }?>   disabled id="comatoso" value="comatoso">
                  <label class="form-check-input" for="comatoso">Comatoso</label>
                  <input class="form-check-input" name="nivel_consciencia" type="radio" <?php if($data_hist['nivel_consciencia'] == "outros"){?>  checked="checked" <?php }?>   disabled id="conscienciaOutra" value="outros">
                  <label class="form-check-input" for="conscienciaOutra">Outro</label>
                </div> 
                <div class="col-sm-10"style="margin-left: 195px;">
                  <input type="text" class="form-control" name="nivel_conscienciaText"disabled value="<?php echo $data_hist['nivel_conscienciaText']; ?>">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Linguagem</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="linguagem" type="radio" <?php if($data_hist['linguagem'] == "clara"){?>  checked="checked" <?php }?>   disabled id="clara" value="clara">
                  <label class="form-check-input" for="clara">Clara</label>
                  <input class="form-check-input" name="linguagem" type="radio" <?php if($data_hist['linguagem'] == "incompreensivel"){?>  checked="checked" <?php }?>   disabled id="incompreensivel" value="incompreensivel">
                  <label class="form-check-input" for="incompreensivel">Incompreensível</label>
                  <input class="form-check-input" name="linguagem" type="radio" <?php if($data_hist['linguagem'] == "afasico"){?>  checked="checked" <?php }?>   disabled id="afasico" value="afasico">
                  <label class="form-check-input" for="afasico">Afásico</label>
                  <input class="form-check-input" name="linguagem" type="radio" <?php if($data_hist['linguagem'] == "barreira de idioma"){?>  checked="checked" <?php }?>   disabled id="barreiraidioma" value="barreira de idioma">
                  <label class="form-check-input" for="barreiraidioma">Barreira de idioma</label>
                  <input class="form-check-input" name="linguagem" type="radio" <?php if($data_hist['linguagem'] == "outroProblemaLinguagem"){?>  checked="checked" <?php }?>   disabled id="outroLinguagem" value="outroProblemaLinguagem">
                  <label class="form-check-input" for="outroLinguagem">Outro</label>
                </div> 
                <div class="col-sm-10"style="margin-left: 195px;">
                  <input type="text" class="form-control" name="linguagemText"disabled value="<?php echo $data_hist['linguagemText']; ?>">
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
                  <input class="form-check-input" name="alteracao_visao" type="radio" <?php if($data_hist['alteracao_visao'] == "simVisao"){?>  checked="checked" <?php }?>   disabled id="simVisao" value="simVisao">
                  <label class="form-check-input" for="simVisao">Sim</label>
                  <input class="form-check-input" name="alteracao_visao" type="radio" <?php if($data_hist['alteracao_visao'] == "naoVisao"){?>  checked="checked" <?php }?>   disabled id="naoVisao" value="naoVisao">
                  <label class="form-check-input" for="naoVisao">Não</label>
                  <input class="form-check-input" name="alteracao_visao" type="radio" <?php if($data_hist['alteracao_visao'] == "oculus"){?>  checked="checked" <?php }?>   disabled id="oculus" value="oculus">
                  <label class="form-check-input" for="oculus">Óculos</label>
                  <input class="form-check-input" name="alteracao_visao" type="radio" <?php if($data_hist['alteracao_visao'] == "lente"){?>  checked="checked" <?php }?>   disabled id="lente" value="lente">
                  <label class="form-check-input" for="lente">Lente</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alteração na audição</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="alteracao_audicao" type="radio" <?php if($data_hist['alteracao_audicao'] == "simAudicao"){?>  checked="checked" <?php }?>   disabled id="simAudicao" value="simAudicao">
                  <label class="form-check-input" for="simAudicao">Sim</label>
                  <input class="form-check-input" name="alteracao_audicao" type="radio" <?php if($data_hist['alteracao_audicao'] == "naoAudicao"){?>  checked="checked" <?php }?>   disabled id="naoAudicao" value="naoAudicao">
                  <label class="form-check-input" for="naoAudicao">Não</label>
                  <input class="form-check-input" name="alteracao_audicao" type="radio" <?php if($data_hist['alteracao_audicao'] == "aparelhoAuditivo"){?>  checked="checked" <?php }?>   disabled id="aparelhoAuditivo" value="aparelhoAuditivo">
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
                  <input class="form-check-input" name="respiracao" type="radio" <?php if($data_hist['respiracao'] == "Sem alteracao"){?>  checked="checked" <?php }?>   disabled id="semAlteracaorespiracao" value="Sem alteracao">
                  <label class="form-check-input" for="semAlteracaorespiracao">Sem alteração</label>
                  <input class="form-check-input" name="respiracao" type="radio" <?php if($data_hist['respiracao'] == "ruidosa"){?>  checked="checked" <?php }?>   disabled id="ruidosa" value="ruidosa">
                  <label class="form-check-input" for="ruidosa">Ruidosa</label>
                  <input class="form-check-input" name="respiracao" type="radio" <?php if($data_hist['respiracao'] == "Dispneia"){?>  checked="checked" <?php }?>   disabled id="Dispneia" value="Dispneia">
                  <label class="form-check-input" for="Dispneia">Dispneia</label>
                  <input class="form-check-input" name="respiracao" type="radio" <?php if($data_hist['respiracao'] == "Aleteo nasal"){?>  checked="checked" <?php }?>   disabled id="aleteonasal" value="Aleteo nasal">
                  <label class="form-check-input" for="aleteonasal">Aleteo nasal</label>
                  <input class="form-check-input" name="respiracao" type="radio" <?php if($data_hist['respiracao'] == "tosse"){?>  checked="checked" <?php }?>   disabled id="tosse" value="tosse">
                  <label class="form-check-input" for="tosse">Tosse</label>
                  <input class="form-check-input" name="respiracao" type="radio" <?php if($data_hist['respiracao'] == "outroRespiracao"){?>  checked="checked" <?php }?>   disabled id="outroRespiracao" value="outroRespiracao">
                  <label class="form-check-input" for="outroRespiracao">Outro</label>
                </div> 
                <div class="col-sm-10"style="margin-left: 195px;">
                  <input type="text" class="form-control" name="respiracaoText"disabled value="<?php echo $data_hist['respiracaoText']; ?>">
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
                  <input class="form-check-input" name="apetite" type="radio" <?php if($data_hist['apetite'] == "apetite normal"){?>  checked="checked" <?php }?>   disabled id="apetitenormal" value="apetite normal">
                  <label class="form-check-input" for="apetitenormal">Normal</label>
                  <input class="form-check-input" name="apetite" type="radio" <?php if($data_hist['apetite'] == "apetite aumentada"){?>  checked="checked" <?php }?>   disabled id="apetiteaumentada" value="apetite aumentada">
                  <label class="form-check-input" for="apetiteaumentada">Aumentada</label>
                  <input class="form-check-input" name="apetite" type="radio" <?php if($data_hist['apetite'] == "apetite diminuido"){?>  checked="checked" <?php }?>   disabled id="apetite diminuido" value="apetite diminuido">
                  <label class="form-check-input" for="apetite diminuido">Diminuido</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Redução da ingestão alimentar na última semana</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="reducao_alimentar" type="radio" <?php if($data_hist['reducao_alimentar'] == "Redução alimentar"){?>  checked="checked" <?php }?>   disabled id="reducaoSim" value="Redução alimentar">
                  <label class="form-check-input" for="reducaoSim">Sim</label>
                  <input class="form-check-input" name="reducao_alimentar" type="radio" <?php if($data_hist['reducao_alimentar'] == "SemRedução"){?>  checked="checked" <?php }?>   disabled id="reducaoNao" value="SemRedução">
                  <label class="form-check-input" for="reducaoNao">Não</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Mudança de peso nos últimos 03 meses</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="mudanca_de_peso" type="radio" <?php if($data_hist['mudanca_de_peso'] == "Mudança de peso"){?>  checked="checked" <?php }?>   disabled id="mudancaSim" value="Mudança de peso">
                  <label class="form-check-input" for="mudancaSim">Sim</label>
                  <input class="form-check-input" name="mudanca_de_peso" type="radio" <?php if($data_hist['mudanca_de_peso'] == "Sem mudança"){?>  checked="checked" <?php }?>   disabled id="mudancaNao" value="Sem mudança">
                  <label class="form-check-input" for="mudancaNao">Não</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Ingestão diária de líquidos</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="ingestao_agua" type="radio" <?php if($data_hist['ingestao_agua'] == "0 a 5 copos"){?>  checked="checked" <?php }?>   disabled id="0a5copos" value="0 a 5 copos">
                  <label class="form-check-input" for="0a5copos">0-5 copos</label>
                  <input class="form-check-input" name="ingestao_agua" type="radio" <?php if($data_hist['ingestao_agua'] == "5 a 10 copos"){?>  checked="checked" <?php }?>   disabled id="5a10copos" value="5 a 10 copos">
                  <label class="form-check-input" for="5a10copos">5-10 copos</label>
                  <input class="form-check-input" name="ingestao_agua" type="radio" <?php if($data_hist['ingestao_agua'] == "Acima de 10 copos"){?>  checked="checked" <?php }?>   disabled id="10copos" value="Acima de 10 copos">
                  <label class="form-check-input" for="10copos">> 10 copos</label>
                  <input class="form-check-input" name="ingestao_agua" type="radio" <?php if($data_hist['ingestao_agua'] == "Restrição Hídrica"){?>  checked="checked" <?php }?>   disabled id="resticao" value="Restrição Hídrica">
                  <label class="form-check-input" for="resticao">Restrição Hídrica</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Prótese</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="protese" type="radio" <?php if($data_hist['protese'] == "Não Protese"){?>  checked="checked" <?php }?>   disabled id="naoProtese" value="Não Protese">
                  <label class="form-check-input" for="naoProtese">Não</label>
                  <input class="form-check-input" name="protese" type="radio" <?php if($data_hist['protese'] == "Protese"){?>  checked="checked" <?php }?>   disabled id="simProtese" value="Protese">
                  <label class="form-check-input" for="simProtese">Sim</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Distúrbios</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="disturbios" type="radio" <?php if($data_hist['disturbios'] == "Nenhum distúrbio"){?>  checked="checked" <?php }?>   disabled id="nenhum" value="Nenhum distúrbio">
                  <label class="form-check-input" for="nenhum">Nenhum</label>
                  <input class="form-check-input" name="disturbios" type="radio" <?php if($data_hist['disturbios'] == "Náusea"){?>  checked="checked" <?php }?>   disabled id="nausea" value="Náusea">
                  <label class="form-check-input" for="nausea">Náuseas</label>
                  <input class="form-check-input" name="disturbios" type="radio" <?php if($data_hist['disturbios'] == "Dor"){?>  checked="checked" <?php }?>   disabled id="dor" value="Dor">
                  <label class="form-check-input" for="dor">Dor</label>
                  <input class="form-check-input" name="disturbios" type="radio" <?php if($data_hist['disturbios'] == "Pirose"){?>  checked="checked" <?php }?>   disabled id="pirose" value="Pirose">
                  <label class="form-check-input" for="pirose">Pirose</label>
                  <input class="form-check-input" name="disturbios" type="radio" <?php if($data_hist['disturbios'] == "Disfagia"){?>  checked="checked" <?php }?>   disabled id="disfagia" value="Disfagia">
                  <label class="form-check-input" for="disfagia">Disfagia</label>
                  <input class="form-check-input" name="disturbios" type="radio" <?php if($data_hist['disturbios'] == "Lesao na boca"){?>  checked="checked" <?php }?>   disabled id="lesaonaboca" value="Lesao na boca">
                  <label class="form-check-input" for="lesaonaboca">Lesão na boca</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Uso de sonda</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="uso_de_sonda" type="radio" <?php if($data_hist['uso_de_sonda'] == "Não Sonda"){?>  checked="checked" <?php }?>   disabled id="naoSonda" value="Não Sonda">
                  <label class="form-check-input" for="naoSonda">Não</label>
                  <input class="form-check-input" name="uso_de_sonda" type="radio" <?php if($data_hist['uso_de_sonda'] == "Sonda"){?>  checked="checked" <?php }?>   disabled id="simSonda" value="Sonda">
                  <label class="form-check-input" for="simSonda">Sim</label>
                  <input class="form-check-input" name="uso_de_sonda" type="radio" <?php if($data_hist['uso_de_sonda'] == "gastrotomia"){?>  checked="checked" <?php }?>   disabled id="gastrotomia" value="gastrotomia">
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
                  <input class="form-check-input" name="diurese" type="radio" <?php if($data_hist['diurese'] == "Sem Alteração"){?>  checked="checked" <?php }?>   disabled id="semAlteracaodiurese" value="Sem Alteração">
                  <label class="form-check-input" for="semAlteracaodiurese">Sem Alteração</label>
                  <input class="form-check-input" name="diurese" type="radio" <?php if($data_hist['diurese'] == "Incontinência"){?>  checked="checked" <?php }?>   disabled id="incontinencia" value="Incontinência">
                  <label class="form-check-input" for="incontinencia">Incontinência</label>
                  <input class="form-check-input" name="diurese" type="radio" <?php if($data_hist['diurese'] == "Anúria"){?>  checked="checked" <?php }?>   disabled id="anuria" value="Anúria">
                  <label class="form-check-input" for="anuria">Anúria</label>
                  <input class="form-check-input" name="diurese" type="radio" <?php if($data_hist['diurese'] == "Disúria"){?>  checked="checked" <?php }?>   disabled id="disuria" value="Disúria">
                  <label class="form-check-input" for="disuria">Disúria</label>
                  <input class="form-check-input" name="diurese" type="radio" <?php if($data_hist['diurese'] == "Hematúria"){?>  checked="checked" <?php }?>   disabled id="hematuria" value="Hematúria">
                  <label class="form-check-input" for="hematuria">Hematúria</label>
                  <input class="form-check-input" name="diurese" type="radio" <?php if($data_hist['diurese'] == "Piúria"){?>  checked="checked" <?php }?>   disabled id="piuria" value="Piúria">
                  <label class="form-check-input" for="piuria">Piúria</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Uso de sonda</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="uso_de_sonda_diurese" type="radio" <?php if($data_hist['uso_de_sonda_diurese'] == "Não uso de sonda"){?>  checked="checked" <?php }?>   disabled id="naoUsoDeSonda" value="Não uso de sonda">
                  <label class="form-check-input" for="naoUsoDeSonda">Não</label>
                  <input class="form-check-input" name="uso_de_sonda_diurese" type="radio" <?php if($data_hist['uso_de_sonda_diurese'] == "Foley"){?>  checked="checked" <?php }?>   disabled id="sondaFoley" value="Foley">
                  <label class="form-check-input" for="sondaFoley">Sonda Foley</label>
                  <input class="form-check-input" name="uso_de_sonda_diurese" type="radio" <?php if($data_hist['uso_de_sonda_diurese'] == "Cistostamia"){?>  checked="checked" <?php }?>   disabled id="cistostamia" value="Cistostamia">
                  <label class="form-check-input" for="cistostamia">Cistostamia</label>
                </div>
              </div>


              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Ritmo Intestinal</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="ritmo_intestinal" type="radio" <?php if($data_hist['ritmo_intestinal'] == "Sem Alteração"){?>  checked="checked" <?php }?>   disabled id="semAlteracaoRitimo" value="Sem Alteração">
                  <label class="form-check-input" for="semAlteracaoRitimo">Sem Alteração</label>
                  <input class="form-check-input" name="ritmo_intestinal" type="radio" <?php if($data_hist['ritmo_intestinal'] == "Ritmo Lento"){?>  checked="checked" <?php }?>   disabled id="ritmoLento" value="Ritmo Lento">
                  <label class="form-check-input" for="ritmoLento">Lento</label>
                  <input class="form-check-input" name="ritmo_intestinal" type="radio" <?php if($data_hist['ritmo_intestinal'] == "Acelerado"){?>  checked="checked" <?php }?>   disabled id="ritmoAcelerado" value="Acelerado">
                  <label class="form-check-input" for="ritmoAcelerado">Acelerado</label>
                  <input class="form-check-input" name="ritmo_intestinal" type="radio" <?php if($data_hist['ritmo_intestinal'] == "Flatulência"){?>  checked="checked" <?php }?>   disabled id="flatulencia" value="Flatulência">
                  <label class="form-check-input" for="flatulencia">Flatulência</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Abdome</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="abdome" type="radio" <?php if($data_hist['abdome'] == "Globoso"){?>  checked="checked" <?php }?>   disabled id="globoso" value="Globoso">
                  <label class="form-check-input" for="globoso">Globoso</label>
                  <input class="form-check-input" name="abdome" type="radio" <?php if($data_hist['abdome'] == "Flácido"){?>  checked="checked" <?php }?>   disabled id="flacido" value="Flácido">
                  <label class="form-check-input" for="flacido">Flácido</label>
                  <input class="form-check-input" name="abdome" type="radio" <?php if($data_hist['abdome'] == "Distendido"){?>  checked="checked" <?php }?>   disabled id="distendido" value="Distendido">
                  <label class="form-check-input" for="distendido">Distendido</label>
                  <input class="form-check-input" name="abdome" type="radio" <?php if($data_hist['abdome'] == "Ascitico"){?>  checked="checked" <?php }?>   disabled id="ascitico" value="Ascitico">
                  <label class="form-check-input" for="ascitico">Ascitico</label>
                  <input class="form-check-input" name="abdome" type="radio" <?php if($data_hist['abdome'] == "Escavado"){?>  checked="checked" <?php }?>   disabled id="escavado" value="Escavado">
                  <label class="form-check-input" for="escavado">Escavado</label>
                  <input class="form-check-input" name="abdome" type="radio" <?php if($data_hist['abdome'] == "Timpânico"){?>  checked="checked" <?php }?>   disabled id="timpanico" value="Timpânico">
                  <label class="form-check-input" for="timpanico">Timpânico</label>
                  <input class="form-check-input" name="abdome" type="radio" <?php if($data_hist['abdome'] == "Plano"){?>  checked="checked" <?php }?>   disabled id="plano" value="Plano">
                  <label class="form-check-input" for="plano">Plano</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Vômito</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="vomito" type="radio" <?php if($data_hist['vomito'] == "Sim"){?>  checked="checked" <?php }?>   disabled id="simVomito" value="Sim">
                  <label class="form-check-input" for="simVomito">Sim</label>
                  <input class="form-check-input" name="vomito" type="radio" <?php if($data_hist['vomito'] == "Não"){?>  checked="checked" <?php }?>   disabled id="naoVomito" value="Não">
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
                  <input class="form-check-input" name="aparelho_urinario" type="radio" <?php if($data_hist['aparelho_urinario'] == "sim"){?>  checked="checked" <?php }?>   disabled id="simAparelhoUrinario" value="sim">
                  <label class="form-check-input" for="simAparelhoUrinario">Sim</label>
                  <input class="form-check-input" name="aparelho_urinario" type="radio" <?php if($data_hist['aparelho_urinario'] == "Não"){?>  checked="checked" <?php }?>   disabled id="naoAparelhoUrinario" value="Não">
                  <label class="form-check-input" for="naoAparelhoUrinario">Não</label>
                  <input class="form-check-input" name="aparelho_urinario" type="radio" <?php if($data_hist['aparelho_urinario'] == "Não Observado"){?>  checked="checked" <?php }?>   disabled id="naoOBservado" value="Não Observado">
                  <label class="form-check-input" for="naoOBservado">Não Observado</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Menopausa</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="menopausa" type="radio" <?php if($data_hist['menopausa'] == "Menopausa"){?>  checked="checked" <?php }?>   disabled id="menopausasim" value="Menopausa">
                  <label class="form-check-input" for="menopausasim">Sim</label>
                  <input class="form-check-input" name="menopausa" type="radio" <?php if($data_hist['menopausa'] == "Não"){?>  checked="checked" <?php }?>   disabled id="menopausanao" value="Não">
                  <label class="form-check-input" for="menopausanao">Não</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Preventivo / Próstata</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="preventivo_prostata" type="radio" <?php if($data_hist['preventivo_prostata'] == "Prostata"){?>  checked="checked" <?php }?>   disabled id="preventivo_prostatasim" value="Prostata">
                  <label class="form-check-input" for="preventivo_prostatasim">Sim</label>
                  <input class="form-check-input" name="preventivo_prostata" type="radio" <?php if($data_hist['preventivo_prostata'] == "Não"){?>  checked="checked" <?php }?>   disabled id="preventivo_prostatanao" value="Não">
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
                  <input class="form-check-input" name="pele" type="radio" <?php if($data_hist['pele'] == "Pele sem alteração"){?>  checked="checked" <?php }?>   disabled id="peleSemAlteracao" value="Pele sem alteração">
                  <label class="form-check-input" for="peleSemAlteracao">Sem alteração</label>
                  <input class="form-check-input" name="pele" type="radio" <?php if($data_hist['pele'] == "Cianose"){?>  checked="checked" <?php }?>   disabled id="cianose" value="Cianose">
                  <label class="form-check-input" for="cianose">Cianose</label>
                  <input class="form-check-input" name="pele" type="radio" <?php if($data_hist['pele'] == "Icterícia"){?>  checked="checked" <?php }?>   disabled id="Ictericia" value="Icterícia">
                  <label class="form-check-input" for="Ictericia">Icterícia</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tugor / Elasticidade</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="tugor_elasticidade" type="radio" <?php if($data_hist['tugor_elasticidade'] == "Sem Alteração"){?>  checked="checked" <?php }?>   disabled id="tugor_elasticidadeSemAlteracao" value="Sem Alteração">
                  <label class="form-check-input" for="tugor_elasticidadeSemAlteracao">Sem alteração</label>
                  <input class="form-check-input" name="tugor_elasticidade" type="radio" <?php if($data_hist['tugor_elasticidade'] == "Elasticidade"){?>  checked="checked" <?php }?>   disabled id="Elasticidade" value="Elasticidade">
                  <label class="form-check-input" for="Elasticidade">Elasticidade</label>
                  <input class="form-check-input" name="tugor_elasticidade" type="radio" <?php if($data_hist['tugor_elasticidade'] == "Tugor diminuido"){?>  checked="checked" <?php }?>   disabled id="tugordiminuido" value="Tugor diminuido">
                  <label class="form-check-input" for="tugordiminuido">Diminuído</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Edema</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="edema" type="radio" <?php if($data_hist['edema'] == "Edema"){?>  checked="checked" <?php }?>   disabled id="edemaSim" value="Edema">
                  <label class="form-check-input" for="edemaSim">Sim</label>
                  <input class="form-check-input" name="edema" type="radio" <?php if($data_hist['edema'] == "Não edema"){?>  checked="checked" <?php }?>   disabled id="naoEdema" value="Não edema">
                  <label class="form-check-input" for="naoEdema">Não</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Prurido</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="prurido" type="radio" <?php if($data_hist['prurido'] == "Prurido"){?>  checked="checked" <?php }?>   disabled id="PruridoSim" value="Prurido">
                  <label class="form-check-input" for="PruridoSim">Sim</label>
                  <input class="form-check-input" name="prurido" type="radio" <?php if($data_hist['prurido'] == "Não Prurido"){?>  checked="checked" <?php }?>   disabled id="naoPrurido" value="Não Prurido">
                  <label class="form-check-input" for="naoPrurido">Não</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Lesão</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="lesao" type="radio" <?php if($data_hist['lesao'] == "Hematomas e equimoses na pele"){?>  checked="checked" <?php }?>   disabled id="lesaoSim" value="Hematomas e equimoses na pele">
                  <label class="form-check-input" for="lesaoSim">Sim</label>
                  <input class="form-check-input" name="lesao" type="radio" <?php if($data_hist['lesao'] == "Não lesao"){?>  checked="checked" <?php }?>   disabled id="naolesao" value="Não lesao">
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
                  <input class="form-check-input" name="sedentarismo" type="radio" <?php if($data_hist['sedentarismo'] == "sedentário"){?>  checked="checked" <?php }?>   disabled id="sedentarismoSim" value="sedentário">
                  <label class="form-check-input" for="sedentarismoSim">Sim</label>
                  <input class="form-check-input" name="sedentarismo" type="radio" <?php if($data_hist['sedentarismo'] == "Não sedentarismo"){?>  checked="checked" <?php }?>   disabled id="naosedentarismo" value="Não sedentarismo">
                  <label class="form-check-input" for="naosedentarismo">Não</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Dificuldade para dormir</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="dificuldade_dormir" type="radio" <?php if($data_hist['dificuldade_dormir'] == "Dificuldade para iniciar o sono"){?>  checked="checked" <?php }?>   disabled id="dificuldade_dormirSim" value="Dificuldade para iniciar o sono">
                  <label class="form-check-input" for="dificuldade_dormirSim">Sim</label>
                  <input class="form-check-input" name="dificuldade_dormir" type="radio" <?php if($data_hist['dificuldade_dormir'] == "Não dificuldade dormir"){?>  checked="checked" <?php }?>   disabled id="naodificuldade_dormir" value="Não dificuldade dormir">
                  <label class="form-check-input" for="naodificuldade_dormir">Não</label>
                </div>
              </div>


              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Aux. para dormir</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="aux_dormir" type="radio" <?php if($data_hist['aux_dormir'] == "farmacológico"){?>  checked="checked" <?php }?>   disabled id="aux_dormirSim" value="farmacológico">
                  <label class="form-check-input" for="aux_dormirSim">Sim</label>
                  <input class="form-check-input" name="aux_dormir" type="radio" <?php if($data_hist['aux_dormir'] == "Sem auxilio para dormir"){?>  checked="checked" <?php }?>   disabled id="naoaux_dormir" value="Sem auxilio para dormir">
                  <label class="form-check-input" for="naoaux_dormir">Não</label>
                </div>
              </div>

            </div>
          </div>
          <div style="margin-top:20px; margin-bottom:70px">
            <button type="submit" class="btn btn-success" >Diagnostico</button>
          </div>
         

        </form>
        </fieldset>

     
            
	</div>
</div>
</body>
</html>