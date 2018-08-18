<?php include_once 'cabecalho.php';?>
<?php require_once 'conexao.php'; ?>

<?php 
	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		$id = $_GET["id"];
		$sql = "select
					a.id,
					a.brinco as brinco,
					a.sexo as sexo,
					r.descricao as raca,
					p.brinco as pai,
					m.brinco as mae
				from
					animal a
					left join raca r on r.id = a.idraca
					left join animal p on p.id = a.idpai
					left join animal m on m.id = a.idmae
				where
					a.data_exclusao is null
				and
					a.id =".$id;
					
		$result = mysqli_query($link,$sql);
		$detalhe = mysqli_fetch_array($result);		
	}else{
		$id = $_POST["id"];
		$data_exclusao = date("Y-m-d H:i:s");
		$result = mysqli_query($link,"update animal set data_exclusao = '$data_exclusao' where id = ".$id);
		if($result){
			header("Location: animal.php");
		}else{
			header("Location: animal_excluir.php?id=".$id);
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
				Brinco:
			</dt>
			<dd>
				<?php echo $detalhe["brinco"]; ?>
			</dd>
			<dt>
				Sexo:
			</dt>
			<dd>
				<?php echo $detalhe["sexo"]; ?>
			</dd>
			<dt>
				Raça:
			</dt>
			<dd>
				<?php echo $detalhe["raca"] ?>
			</dd>
			<dt>
				Pai:
			</dt>
			<dd>
				<?php echo $detalhe["pai"] ?>
			</dd>
			<dt>
				Mãe:
			</dt>
			<dd>
				<?php echo $detalhe["mae"] ?>
			</dd>
		</dl>
	</div>
</div>

<form action="animal_excluir.php" method="post" class="form-horizontal">
	<div class="form-group">
		<div class="col-sm-1 col-md-1 col-lg-1">
			<input type="hidden" name="id" id="inputId" class="form-control" value="<?php echo $detalhe["id"] ?>">	
			<button type="submit" class="btn btn-danger">Excluir</button>
			<button type="button" class="btn btn-danger" onClick="location.href='animal.php'">Voltar</button>
		</div>
	</div>
</form>

</td></tr></table>

<?php include_once 'rodape.php';?>
