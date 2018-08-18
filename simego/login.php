<script type="text/javascript">

		function valida(){
		if (logsist.login.value == ""){
			alert("Digite um usuario valido");
			return false;
			}
		if (logsist.senha.value == ""){
			alert("Digite uma senha valida");
			return false;
			}
		else{
			return true;
			}
		}
		
</script>
<?php /*
<input type="button" name="bt_nsou" value="Não sou cadastrato" onclick="teste2()" style="width:250;height:60" class="botao">
<br><br>
*/?>

<table border="4" cellspacing=0 cellpadding=2 bordercolor="#2E8B57" align="center">
	<tr><th>Login<br></th></tr>
	<tr><td align="right">
	<form name="logsist" method="POST" action="teste.php" onsubmit="return valida()">
		<br>
		Usuário <input type="text" name="login"> <br> <br>
		Senha <input type="password" name="senha"> <br>
		<br>
		<img src="captcha.php?l=150&a=50&tf=20&ql=5"><br>
		Digite o captcha:<br><input type="text" name="palavra"><br>
		</td></tr>
		<tr><td align="right">
		<input type="submit" value="Ok">
	</form>
	</td></tr></table>