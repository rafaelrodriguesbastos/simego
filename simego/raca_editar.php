<?php include_once 'cabecalho.php';?>
<?php require_once 'conexao.php'; ?>

<?php 

if ($_SERVER["REQUEST_METHOD"] == "GET")
{
	$id = $_GET["id"];
	$result = mysqli_query($link,"select * from raca where id = ".$id);
	$dados = mysqli_fetch_array($result);
}else{
	$id = $_POST["id"];
	$descricao = $_POST["descricao"];
	
	if ($descricao == "")
	{
		$erroDescricao = "has-error";
		$temErro = true;
	}

	if($temErro){
		$dados["id"] = $id;
		$dados["descricao"] = $sexo;
		$alert = "erro";
	}else{
		$sqlUpdate = sprintf("update raca set 
			descricao = '%s'
			where
			id = %s",
			$descricao,
			$id);

		$result = mysqli_query($link,$sqlUpdate);

		if ($result)
		{
			$alert = "sucesso";
			$result = mysqli_query($link,"select * from raca where id = ".$id);
			$dados = mysqli_fetch_array($result);
		}
	}
}

?>

<table bgcolor="#F5F5DC" border="0" width=80% align="center">
<tr><td>

<h2>Editar Raça</h2>

<div class="form-horizontal">
	<form action="raca_editar.php" method="POST" role="form">
		<?php if ($alert == "sucesso") 
			{
				echo "<div class='alert alert-success alert-dismissible' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
							<span aria-hidden='true'>&times;</span>
						</button>
						Dados Salvos com sucesso!
					  </div>"; 
			}else if ($alert == "erro"){
				echo "<div class='alert alert-danger alert-dismissible' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
							<span aria-hidden='true'>&times;</span>
						</button>
						Erro ao salvar os dados!
					  </div>"; 
			}
		?>
		<input type="hidden" name="id" id="inputId" class="form-control" value="<?php echo $dados['id']; ?>">
		<div class="form-group <?php echo $erroDescricao ?>">
			<label for="inputDescricao" class="control-label col-sm-2 col-md-2 col-lg-2">Descrição</label>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<input type="text" name="descricao" id="inputDescricao" class="form-control" value="<?php echo $dados['descricao']; ?>" required="required">
				<?php if ($erroDescricao == 'has-error') echo "<span class='help-block'>*O campo descrição da raça é obrigatório</span>" ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-offset-2 col-md-2">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<button type="button" class="btn btn-primary" onClick="location.href='raca.php'">Voltar</button>
			</div>
		</div>
	</form>
</div>
</div>

</td></tr></table>

<?php include_once 'rodape.php';?>
