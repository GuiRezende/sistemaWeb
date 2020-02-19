<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
require "../../config/banco.php";


$paciente_id       = addslashes($_POST['paciente_id']); 
$usuario_id           = addslashes($_POST['usuario_id']); 
$endereco_id          = addslashes($_POST['endereco_id']);


if(!empty($_POST)){

    $pais      = addslashes($_POST['pais']); //tratando a chegada das info pegada pelo POST
    $estado    = addslashes($_POST['estado']);
    $municipio = addslashes($_POST['municipio']);
    $cep       = addslashes($_POST['cep']);
    $bairro    = addslashes($_POST['bairro']);
    
    //fazendo uma chamada ao insert e atribuido valores
    $endereco = $pdo->prepare("UPDATE enderecos 
                    SET pais=:pais, estado=:estado, municipio=:municipio, cep=:cep, bairro=:bairro WHERE id=:endereco_id");        
    
    $endereco->bindParam(':endereco_id', $endereco_id);
    $endereco->bindParam(':pais', $pais); //passando os valores para as variaveis da chamada acima
    $endereco->bindParam(':estado', $estado);
    $endereco->bindParam(':municipio', $municipio);
    $endereco->bindParam(':cep', $cep);
    $endereco->bindParam(':bairro', $bairro);
    $endereco->execute(); //salva no banco de dados
   
    //se foi inserido ao banco passa.
    if($endereco){

        $nome               = addslashes($_POST['nome']);
        $cpf                = addslashes($_POST['cpf']);
        $nome_mae           = addslashes($_POST['nome_mae']);
        $nome_pai           = addslashes($_POST['nome_pai']);
        $rg                 = addslashes($_POST['rg']);
        $celular            = addslashes($_POST['celular']);
        $data_nascimento    = addslashes($_POST['data_nascimento']);
        $telefone           = addslashes($_POST['telefone']);
        $sexo               = addslashes($_POST['sexo']);
        $estado_civil       = addslashes($_POST['estadoCivil']);

    
        $usuarios = $pdo->prepare("UPDATE usuarios SET nome=:nome, nome_mae=:nome_mae, nome_pai=:nome_pai,
                cpf=:cpf, rg=:rg, celular=:celular, data_nascimento=:data_nascimento, telefone=:telefone, sexo=:sexo, estado_civil=:estado_civil WHERE id=:usuario_id");

        
        $usuarios->bindParam(':usuario_id', $usuario_id);
        $usuarios->bindParam(":nome", $nome);
        $usuarios->bindParam(":nome_mae", $nome_mae);
        $usuarios->bindParam(":nome_pai", $nome_pai);
        $usuarios->bindParam(":cpf", $cpf);
        $usuarios->bindParam(":rg", $rg);
        $usuarios->bindParam(":celular", $celular);
        $usuarios->bindParam(":data_nascimento", $data_nascimento);
        $usuarios->bindParam(":telefone", $telefone);
        $usuarios->bindParam(":sexo", $sexo);
        $usuarios->bindParam(":estado_civil", $estado_civil);
        $usuarios->execute();

        if($usuarios){
        
            $religiao       = addslashes($_POST['religiao']);
            $peso           = addslashes($_POST['peso']);
            $altura         = addslashes($_POST['altura']);
            $profissao      = addslashes($_POST['profissao']);            
            $escolaridade   = addslashes($_POST['escolaridade']);
            
            
            $paciente = $pdo->prepare("UPDATE pacientes SET religiao=:religiao, peso=:peso, 
            altura=:altura, profissao=:profissao, escolaridade=:escolaridade WHERE paciente_id=:paciente_id");


            $paciente->bindParam(":paciente_id", $paciente_id);
            $paciente->bindParam(":religiao", $religiao);
            $paciente->bindParam(":peso", $peso);
            $paciente->bindParam(":altura", $altura);
            $paciente->bindParam(":profissao",$profissao);
            $paciente->bindParam(":escolaridade",$escolaridade);
            $paciente->execute();

        }
    }

    header("Location: ../../buscar_paciente.php");
}else{
   echo "nao entrou...";
}


?>