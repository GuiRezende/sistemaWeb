<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
require "../../config/banco.php";

if(!empty($_POST['nome']) && !empty($_POST['cpf']) && !empty($_POST['rg']) && !empty($_POST['municipio'])){

    $pais      = addslashes($_POST['pais']); //tratando a chegada das info pegada pelo POST
    $estado    = addslashes($_POST['estado']);
    $municipio = addslashes($_POST['municipio']);
    $cep       = addslashes($_POST['cep']);
    $bairro    = addslashes($_POST['bairro']);
    
    //fazendo uma chamada ao insert e atribuido valores
    $endereco = $pdo->prepare("INSERT INTO enderecos (pais, estado, municipio, cep, 
                bairro) VALUES (:pais, :estado, :municipio, :cep, :bairro)");

    $endereco->bindValue(":pais", $pais); //passando os valores para as variaveis da chamada acima
    $endereco->bindValue(":estado", $estado);
    $endereco->bindValue(":municipio", $municipio);
    $endereco->bindValue(":cep", $cep);
    $endereco->bindValue(":bairro", $bairro);
    $endereco->execute(); //executa a linha de comando do insert into
   
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
        $endereco_id        = $pdo->lastInsertId();
    
        $usuarios = $pdo->prepare("INSERT INTO usuarios (nome, nome_mae, nome_pai,
                cpf, rg, celular, data_nascimento, telefone, sexo, estado_civil, endereco_id) 
                VALUES (:nome, :nome_mae, :nome_pai,
                :cpf, :rg, :celular, :data_nascimento, :telefone, :sexo, :estado_civil, :endereco_id)");

        $usuarios->bindValue(":nome", $nome);
        $usuarios->bindValue(":nome_mae", $nome_mae);
        $usuarios->bindValue(":nome_pai", $nome_pai);
        $usuarios->bindValue(":cpf", $cpf);
        $usuarios->bindValue(":rg", $rg);
        $usuarios->bindValue(":celular", $celular);
        $usuarios->bindValue(":data_nascimento", $data_nascimento);
        $usuarios->bindValue(":telefone", $telefone);
        $usuarios->bindValue(":sexo", $sexo);
        $usuarios->bindValue(":estado_civil", $estado_civil);
        $usuarios->bindValue(":endereco_id", $endereco_id);
        $usuarios->execute();

        if($usuarios){
        
            $usuario_id     = $pdo->lastInsertId();
            $religiao       = addslashes($_POST['religiao']);
            $peso           = addslashes($_POST['peso']);
            $altura         = addslashes($_POST['altura']);
            $profissao      = addslashes($_POST['profissao']);            
            $escolaridade   = addslashes($_POST['escolaridade']);

            $paciente = $pdo->prepare("INSERT INTO pacientes (usuario_id, religiao, peso, altura, profissao, escolaridade) 
                            VALUES (:usuario_id, :religiao, :peso, :altura, :profissao, :escolaridade)");

            $paciente->bindValue(":usuario_id", $usuario_id);
            $paciente->bindValue(":religiao", $religiao);
            $paciente->bindValue(":peso", $peso);
            $paciente->bindValue(":altura", $altura);
            $paciente->bindValue(":profissao",$profissao);
            $paciente->bindValue(":escolaridade",$escolaridade);
            $paciente->execute();

        }
    }

    header("Location: ../../agendar_consulta.php");

}else{
   echo "nao entrou...";
}


?>