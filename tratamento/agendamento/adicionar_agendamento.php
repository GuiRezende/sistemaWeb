<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
//chamada da conexao ao banco
require "../../config/banco.php"; 


//verificando alguns banco que vem do formulario
if(!empty($_POST['data_agendamento']) && !empty($_POST['hora_agendamento'])){

    $hora_agendamento     = addslashes($_POST['hora_agendamento']); //tratando a chegada das info pegada pelo POST
    $data_agendamento     = addslashes($_POST['data_agendamento']);
    $paciente_id          = addslashes($_POST['paciente_id']);
    $funcionario_id       = addslashes($_POST['funcionario_id']);

    
    //fazendo uma chamada ao insert e atribuido valores
    $consulta = $pdo->prepare("INSERT INTO consultas (paciente_id, funcionario_id, hora_agendamento, data_agendamento) 
                VALUES (:paciente_id, :funcionario_id, :hora_agendamento, :data_agendamento)");

    $consulta->bindValue(":paciente_id", $paciente_id); //passando os valores para as variaveis da chamada acima
    $consulta->bindValue(":funcionario_id", $funcionario_id);
    $consulta->bindValue(":hora_agendamento", $hora_agendamento);
    $consulta->bindValue(":data_agendamento", $data_agendamento);
    $consulta->execute(); //executa a linha de comando do insert into
   

    echo "cadastrou";
   header("Location: ../../agendar_consulta.php");
}else{
   echo "nao entrou...";
}
?>