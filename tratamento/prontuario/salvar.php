<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

require "../../config/banco.php"; 
date_default_timezone_set('America/Sao_Paulo');

if(!empty($_POST['paciente_id']) && !empty($_POST['anotacao']) && !empty($_POST['evolucao']) ){

    $paciente_id            = addslashes($_POST['paciente_id']);
    $pa                     = addslashes($_POST['pa']);
    $hgt                    = addslashes($_POST['hgt']);
    $irpm                   = addslashes($_POST['irpm']);
    $temperatura            = addslashes($_POST['temperatura']);
    $anotacao               = addslashes($_POST['anotacao']);
    $evolucao               = addslashes($_POST['evolucao']);
    $data_hora              = date('Y-m-d H:i');

    
    $prontuarios = $pdo->prepare("INSERT INTO prontuarios (paciente_id, pa, hgt,
    irpm, temperatura, anotacao, evolucao, data_hora) 
    VALUES (:paciente_id, :pa, :hgt,
    :irpm, :temperatura, :anotacao, :evolucao, :data_hora)");
 
    $prontuarios->bindValue(":paciente_id", $paciente_id);
    $prontuarios->bindValue(":pa", $pa);
    $prontuarios->bindValue(":hgt", $hgt);
    $prontuarios->bindValue(":irpm", $irpm);
    $prontuarios->bindValue(":temperatura", $temperatura);
    $prontuarios->bindValue(":anotacao", $anotacao);
    $prontuarios->bindValue(":evolucao", $evolucao);
    $prontuarios->bindValue(":data_hora", $data_hora);

    $prontuarios->execute();

    header("Location:../../anotacao.php?alterar=".$paciente_id);

}

?>