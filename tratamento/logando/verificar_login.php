<?php

    require "../../config/banco.php"; 


    if(isset($_POST['email']) && isset($_POST['senha'])){
        $email = $_POST['email'];
        $senha = $_POST['senha'];
    
        $verificar =  "SELECT u.nome FROM usuarios u INNER JOIN funcionarios f ON (u.id=f.usuario_id) WHERE f.email = '$email' AND f.senha = '$senha'";
        $verificar = $pdo->query($verificar);
 
        if($verificar->rowCount() > 0){ //se tiver arquivos
            foreach($verificar->fetchAll() as $dados): //pegar todos os pacientes
            session_start(); 

            $nome = $dados['nome'];
            $_SESSION['usuario_logado'] = $nome;

            echo $_SESSION['usuario_logado'];
           
            endforeach;
            header("Location: ../../buscar_paciente.php");

        } else{
            echo 'Usuário ou Senha incorreto!';
        }


    }


?>