<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>SISTEMA DE ENFERMAGEM</title>
<style>
	body {font-family: Arial, Helvetica, sans-serif;
		text-align: center;
		background-color: #fafafa;
	}
	form {border: 3px solid #f1f1f1;}

	input[type=text], 
	input[type=password] {
	  width: 50%;
	  padding: 12px 5px;
	  margin: 8px 0;
	  display: inline-block;
	  border: 1px solid #ccc;
	  box-sizing: border-box;
	}

	button {
	  background-color: #2D3135;
	  color: white;
	  padding: 14px 20px;
	  margin: 8px 0;
	  border: none;
	  cursor: pointer;
	  width: 50%;
	}

	button:hover {
	  opacity: 0.8;
	}

	.container {
	  padding: 16px; 
	}

</style>
</head>
<body>

	<h2> - Sistema de Enfermagem - </h2>

	<form action="tratamento/logando/verificar_login.php" method="post">

	  <div class="container">
	    <label for="usuario"><b>Email:</b></label><br>
	    <input type="text" placeholder="email@exemplo.com" name="email" required><br>

	    <br><label for="senha"><b>Senha:</b></label><br>
	    <input type="password" placeholder="1234" name="senha" required>
	        
	    <button type="submit" ><b>Logar</b></button>
	  </div>


	  </div>
	</form>

</body>
</html>