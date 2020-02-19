<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

//chamada da conexao ao banco
require "../../config/banco.php"; 

$funcionario_id       = addslashes($_POST['funcionario_id']); 
$usuario_id           = addslashes($_POST['usuario_id']); 
$endereco_id          = addslashes($_POST['endereco_id']);

//verificando alguns banco se vem do formulario
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
    
        $usuarios = $pdo->prepare("UPDATE usuarios 
                SET nome=:nome, nome_mae=:nome_mae, nome_pai=:nome_pai,
                cpf=:cpf, rg=:rg, celular=:celular, data_nascimento=:data_nascimento, telefone=:telefone, sexo=:sexo, estado_civil=:estado_civil WHERE id=:usuario_id");

        $usuarios->bindParam(':usuario_id', $usuario_id);
        $usuarios->bindParam(':nome', $nome);
        $usuarios->bindParam(':nome_mae', $nome_mae);
        $usuarios->bindParam(':nome_pai', $nome_pai);
        $usuarios->bindParam(':cpf', $cpf);
        $usuarios->bindParam(':rg', $rg);
        $usuarios->bindParam(':celular', $celular);
        $usuarios->bindParam(':data_nascimento', $data_nascimento);
        $usuarios->bindParam(':telefone', $telefone);
        $usuarios->bindParam(':sexo', $sexo);
        $usuarios->bindParam(':estado_civil', $estado_civil);
        $usuarios->execute(); //salva no banco de dados

        if($usuarios){
        
            $registro       = addslashes($_POST['registro']);
            $data_admissao  = addslashes($_POST['data_admissao']);
            $email          = addslashes($_POST['email']);
            $senha          = md5(addslashes($_POST['senha']));
            $cargo          = addslashes($_POST['cargo']);
            $permissao      = "Admin";

            $funcionario = $pdo->prepare("UPDATE funcionarios
                            SET (registro=:registro, data_admissao=:data_admissao, email=:email, senha=:senha, cargo=:cargo, permissao=:permissao) WHERE id=:funcionario_id");

            $funcionario->bindParam(':funcionario_id', $funcionario_id);
            $funcionario->bindParam(':registro', $registro);
            $funcionario->bindParam(':data_admissao', $data_admissao);
            $funcionario->bindParam(':email', $email);
            $funcionario->bindParam(':senha', $senha);
            $funcionario->bindParam(':permissao', $permissao);
            $funcionario->bindParam(':cargo', $cargo);
            $funcionario->execute(); //salva no banco de dados
            
        }
    }

  
}else{
   echo "nao entrou...";
}
?>