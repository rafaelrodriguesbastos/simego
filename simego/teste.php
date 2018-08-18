<?php
	$conexao = mysqli_connect("127.0.0.1", "root", "", "simegodb")
	or die("Nao foi possivel conectar ao banco de dados");
	
	$login = $_POST ["login"];
	$senha = $_POST ["senha"];
	$testar = $_POST ["palavra"];
	
	session_start();
    if ($testar == $_SESSION["palavra"]){
        echo "<h1>Voce Acertou</h1>";
	
	/*$sql = "select 
				id, 
				login,
				senha,
			from 
				usuarios 
			where
				(login like '$login') AND (senha like '$senha')";
				
		$resultado = mysqli_query($conexao, $sql) or die ('Usuário não cadastrado!');
		
		while ($dados = mysqli_fetch_array($resultado)) {
			$idusuario = $dados['id'];
			}*/
	
	if ($login == "admin" AND $senha == "admin"){
				session_start();
				$_SESSION['logado']='s';
				$_SESSION['id']=1;
		$url = 'animal.php';
		header('location: ' . $url);
	}
	
	}
	else{
        echo "<h1>Voce nao acertou!</h1>";
        $url = 'erro.php';
		header('location: ' . $url);
		}
 ?>