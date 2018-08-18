<?php include_once 'cabecalho.php';?>
<?php require_once 'conexao.php'; ?>

<?php 
	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		$id = $_GET["id"];
		$sql = "select
					c.id,
					c.data,
					m.brinco as macho,
					f.brinco as femea,
					c.consanguinidade
				from 
					cobertura c
					left join animal m on m.id = c.idmacho
					left join animal f on f.id = c.idfemea
				where
					c.id = $id";
		$result = mysqli_query($link,$sql);
		$detalhe = mysqli_fetch_array($result);		
	}else{
		$id = $_POST["id"];
		$data_exclusao = date("Y-m-d H:i:s");
		$result = mysqli_query($link,"update cobertura set data_exclusao = '$data_exclusao' where id = ".$id);
		if($result){
			header("Location: cobertura.php");
		}else{
			header("Location: cobertura_excluir.php?id=".$id);
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
				Data:
			</dt>
			<dd>
				<?php $data=implode("/", array_reverse(explode("-", $detalhe["data"])));  echo $data; ?>
			</dd>
			<dt>
				Macho:
			</dt>
			<dd>
				<?php echo $detalhe["macho"] ?>
			</dd>
			<dt>
				Fêmea:
			</dt>
			<dd>
				<?php echo $detalhe["femea"] ?>
			</dd>
			<dt>
				% Consanguinidade:
			</dt>
			<dd>
				<?php echo $detalhe["consanguinidade"] * 100; ?>
			</dd>
		</dl>
	</div>
</div>

<form action="cobertura_excluir.php" method="post" class="form-horizontal">
	<div class="form-group">
		<div class="col-sm-1 col-md-1 col-lg-1">
			<input type="hidden" name="id" id="inputId" class="form-control" value="<?php echo $detalhe["id"] ?>">	
			<button type="submit" class="btn btn-danger">Excluir</button>
			<button type="button" class="btn btn-danger" onClick="location.href='cobertura.php'">Voltar</button>
		</div>
	</div>
</form>

</td></tr></table>
<?php include_once 'rodape.php';?>
