<?php include_once 'cabecalho.php';?>
<?php require_once 'conexao.php'; ?>

<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$descricao = $_POST["descricao"];

	foreach ($_POST as $key => $value)
	{
		if(empty($value))
		{
			if ($key == "descricao")
			{
				$erros["descricao"] = true;
			}
		}
	}

	if (!$erros)
	{
		$qryInsert = sprintf("insert into raca (descricao) values ('%s')",$descricao);
		$result = mysqli_query($link,$qryInsert);
		header("Location: raca.php");
	}	
}

?>

<table bgcolor="#F5F5DC" border="0" width=80% align="center">
<tr><td>

<h3>Nova Raça</h3>
<hr>

<form action="raca_novo.php" method="POST" class="form-horizontal" role="form">
	<div class="form-group <?php if ($erros["descricao"]) echo 'has-error' ?>">
		<label for="inputDescricao" class="col-sm-2 control-label">Descrição:</label>
		<div class="col-sm-3">
			<input type="text" name="descricao" id="inputDescricao" class="form-control" required="required">
			<?php if ($erros["descricao"]): ?>
				<span class="help-block">*O campo descrição da raça é obrigatório</span>				
			<?php endif ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 col-sm-offset-2">
			<button type="submit" class="btn btn-primary">Salvar</button>
		</div>
	</div>
</form>

</td></tr></table>

<?php include_once 'rodape.php';?>
