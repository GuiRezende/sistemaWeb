<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
//chamada da conexao ao banco
require "../../config/banco.php"; 

//verificando alguns banco se vem do formulario
if(!empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['senha']) ){

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
            $registro       = addslashes($_POST['registro']);
            $data_admissao  = addslashes($_POST['data_admissao']);
            $email          = addslashes($_POST['email']);
            $senha          = addslashes($_POST['senha']);
            $cargo          = addslashes($_POST['cargo']);
            $permissao      = "Admin";

            $funcionario = $pdo->prepare("INSERT INTO funcionarios (usuario_id, registro, data_admissao, email, senha, cargo, permissao) 
                            VALUES (:usuario_id, :registro, :data_admissao, :email, :senha, :cargo, :permissao)");

            $funcionario->bindValue(":usuario_id", $usuario_id);
            $funcionario->bindValue(":registro", $registro);
            $funcionario->bindValue(":data_admissao", $data_admissao);
            $funcionario->bindValue(":email", $email);
            $funcionario->bindValue(":senha",$senha);
            $funcionario->bindValue(":permissao",$permissao);
            $funcionario->bindValue(":cargo",$cargo);
            $funcionario->execute();

        }
    }

    header("Location: ../../buscar_funcionario.php");
}else{
   echo "nao entrou...";
}
?>