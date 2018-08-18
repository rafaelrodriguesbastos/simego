<?php include_once 'cabecalho.php';?>
<?php require_once 'conexao.php'; ?>

<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$data = implode("-", array_reverse(explode("/", $_POST['data'])));
	$idmacho = $_POST["idmacho"];
	$idfemea = $_POST["idfemea"];

	foreach ($_POST as $key => $value)
	{
		if(empty($value))
		{
			$erros[$key] = true;
		}
	}

	if (!$erros)
	{

		$sql = "select idpai, idmae from animal where id = $idmacho";
		$res = mysqli_query($link, $sql);
		$temp = mysqli_fetch_array($res);
		$idpaiM = $temp['idpai'];
		$idmaeM = $temp['idmae'];

		if ($idpaiM != "" && $idmaeM != "") {
			$sql = "select idpai, idmae from animal where id = $idpaiM";
			$res = mysqli_query($link, $sql);
			$temp = mysqli_fetch_array($res);
			$idpaiPM = $temp['idpai'];
			$idmaePM = $temp['idmae'];

			$sql = "select idpai, idmae from animal where id = $idmaeM";
			$res = mysqli_query($link, $sql);
			$temp = mysqli_fetch_array($res);
			$idpaiMM = $temp['idpai'];
			$idmaeMM = $temp['idmae'];
		}

		$sql = "select idpai, idmae from animal where id = $idfemea";
		$res = mysqli_query($link, $sql);
		$temp = mysqli_fetch_array($res);
		$idpaiF = $temp['idpai'];
		$idmaeF = $temp['idmae'];
		
		if ($idpaiF != "" && $idmaeF != "") {
			$sql = "select idpai, idmae from animal where id = $idvmM";
			$res = mysqli_query($link, $sql);
			$temp = mysqli_fetch_array($res);
			$idpaiPF = $temp['idpai'];
			$idmaePF = $temp['idmae'];

			$sql = "select idpai, idmae from animal where id = $idvfM";
			$res = mysqli_query($link, $sql);
			$temp = mysqli_fetch_array($res);
			$idpaiMF = $temp['idpai'];
			$idmaeMF = $temp['idmae'];
		}
		
		if ($idpaiM == "" && $idpaiF == "" && $idmaeM == "" && $idmaeF == "") {
			$consanguinidade = 0;
		}
		elseif ($idpaiM == $idpaiF && $idmaeM == $idmaeF) {
			$consanguinidade = 0.25;
		}
		elseif ($idpaiM == $idpaiF || $idmaeM == $idmaeF) {
			$consanguinidade = 0.125;
		}
		elseif (($idpaiPM == $idpaiPF || $idpaiPM == $idpaiMF || $idpaiMM == $idpaiPF || $idpaiMM == $idpaiMF) && ($idmaePM == $idmaePF || $idmaePM == $idmaeMF || $idmaeMM == $idmaePF || $idmaeMM == $idmaeMF)){
			$consanguinidade = 0.0625;
		}
							

		$qryInsert = sprintf("insert into cobertura (data, idmacho, idfemea, consanguinidade) values ('%s', %s, %s, %s)",$data, $idmacho, $idfemea, $consanguinidade);
		$result = mysqli_query($link,$qryInsert);
		header("Location: cobertura.php");
	}	
}

?>

<table bgcolor="#F5F5DC" border="0" width=80% align="center">
<tr><td>

<h3>Nova Cobertura</h3>
<hr>

<form action="cobertura_novo.php" method="POST" class="form-horizontal" role="form">
	<div class="form-group <?php if ($erros["data"]) echo 'has-error' ?>">
		<label for="inputData" class="control-label col-sm-2 col-md-2 col-lg-2">Data da cobertura:</label>
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<input type="date" name="data" id="inputData" class="form-control" required="required">
			<?php if ($erros["data"]): ?>
				<span class="help-block">*O campo data da cobertura é obrigatório</span>				
			<?php endif ?>
		</div>
	</div>
	<div class="form-group <?php if ($erros["idmacho"]) echo 'has-error' ?>">
		<label for="inputIdmacho" class="col-sm-2 control-label">Macho:</label>
		<div class="col-sm-2">
			<select name="idmacho" id="inputIdmacho" class="form-control"> 
				<option value="">--Selecione--</option> 
				<?php
					$sql = "select id, brinco from animal where data_exclusao is null and sexo = 'M' order by brinco";
					$res = mysqli_query($link, $sql);
					while ($temp = mysqli_fetch_array($res)) {
						$idm = $temp['id'];
						$brinc = $temp['brinco'];
						
						echo "<option value='$idm'>$brinc</option>";
					}
				?>
			</select>
			<?php if ($erros["idmacho"]): ?>
				<span class="help-block">*O campo Macho é obrigatório</span>			
			<?php endif ?>			
		</div>
	</div>
	<div class="form-group <?php if ($erros["idfemea"]) echo 'has-error' ?>">
		<label for="inputIdfemea" class="col-sm-2 control-label">Fêmea:</label>
		<div class="col-sm-2">
			<select name="idfemea" id="inputIdfemea" class="form-control"> 
				<option value="">--Selecione--</option> 
				<?php
					$sql = "select id, brinco from animal where data_exclusao is null and sexo = 'F' order by brinco";
					$res = mysqli_query($link, $sql);
					while ($temp = mysqli_fetch_array($res)) {
						$idf = $temp['id'];
						$brinc = $temp['brinco'];
						
						echo "<option value='$idf'>$brinc</option>";
					}
				?>
			</select>
			<?php if ($erros["idfemea"]): ?>
				<span class="help-block">*O campo fêmea é obrigatório</span>			
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

