<?php include_once 'cabecalho.php';?>
<?php require_once 'conexao.php'; ?>

<?php 
	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		$id = $_GET["id"];
		$result = mysqli_query($link,"select * from raca where data_exclusao is null and id = ".$id);
		$detalhe = mysqli_fetch_array($result,MYSQLI_BOTH);		
	}else{
		$id = $_POST["id"];
		$data_exclusao = date("Y-m-d H:i:s");
		$result = mysqli_query($link,"update raca set data_exclusao = '$data_exclusao' where id = ".$id);
		if($result){
			header("Location: raca.php");
		}else{
			header("Location: raca_excluir.php?id=".$id);
		}
	}

?>

<table bgcolor="#F5F5DC" border="0" width=80% align="center">
<tr><td>

<h2>Excluir</h2>
<hr/>

<div class="row">
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		<dl class="dl-horizontal">
			<dt>
				Id:
			</dt>
			<dd>
				<?php echo $detalhe["id"] ;?>
			</dd>
			<dt>
				Descrição:
			</dt>
			<dd>
				<?php echo $detalhe["descricao"]; ?>
			</dd>
		</dl>
	</div>
</div>

<form action="raca_excluir.php" method="post" class="form-horizontal">
	<div class="form-group">
		<div class="col-sm-1 col-md-1 col-lg-1">
			<input type="hidden" name="id" id="inputId" class="form-control" value="<?php echo $detalhe["id"] ?>">	
			<button type="submit" class="btn btn-danger">Excluir</button>
			<button type="button" class="btn btn-danger" onClick="location.href='raca.php'">Voltar</button>
		</div>
	</div>
</form>

</td></tr></table>

<?php include_once 'rodape.php';?>
