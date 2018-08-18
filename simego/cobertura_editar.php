<?php include_once 'cabecalho.php';?>
<?php require_once 'conexao.php'; ?>

<?php 

if ($_SERVER["REQUEST_METHOD"] == "GET")
{
	$id = $_GET["id"];
	$result = mysqli_query($link,"select * from cobertura where id = ".$id);
	$dados = mysqli_fetch_array($result);
}else{
	$id = $_POST["id"];
	$data = $_POST["data"];
	$idmacho = $_POST["idmacho"];
	$idfemea = $_POST["idfemea"];
	
	if ($data == "")
	{
		$erroData = "has-error";
		$temErro = true;
	}

	if($temErro){
		$dados["id"] = $id;
		$dados["data"] = $data;
		$dados["idmacho"] = $idmacho;
		$dados["idfemea"] = $idfemea;
		$alert = "erro";
	}else{

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
							
		$sqlUpdate = sprintf("update cobertura set 
			data = '%s',
			idmacho = %s,
			idfemea = %s,
			consanguinidade = %s
			where
			id = %s",
			$data,
			$idmacho,
			$idfemea,
			$consanguinidade,
			$id);

		$result = mysqli_query($link,$sqlUpdate);

		if ($result)
		{
			$alert = "sucesso";
			$result = mysqli_query($link,"select * from cobertura where id = ".$id);
			$dados = mysqli_fetch_array($result);
		}
	
	}
}

?>

<table bgcolor="#F5F5DC" border="0" width=80% align="center">
<tr><td>

<h2>Editar Cobertura</h2>

<div class="form-horizontal">
	<form action="cobertura_editar.php" method="POST" role="form">
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
		<div class="form-group <?php echo $erroData ?>">
			<label for="inputData" class="control-label col-sm-2 col-md-2 col-lg-2">Data da cobertura</label>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<input type="date" name="data" id="inputData" class="form-control" value="<?php echo $dados['data']; ?>" required="required">
				<?php if ($erroData == 'has-error') echo "<span class='help-block'>*O campo data da cobertura é obrigatório</span>" ?>
			</div>
		</div>
		<div class="form-group <?php echo $erroIdmacho ?>">
			<label for="inputIdmacho" class="control-label col-sm-2 col-md-2 col-lg-2">Macho</label>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<div class="col-sm-2">
					<select name="idmacho" id="inputIdmacho" class="form-control"> 
						<option value="">--Selecione--</option> 
						<?php
							$sql = "select id, brinco from animal where data_exclusao is null and sexo = 'M' and id not in ($id)  order by brinco";
							$res = mysqli_query($link, $sql);
							while ($temp = mysqli_fetch_array($res)) {
								$idm = $temp['id'];
								$brinc = $temp['brinco'];
								
								if ($dados['idmacho'] == $idm) {
									$sel = "selected";
								}
								else {
									$sel = "";
								}
								
								echo "<option value='$idm' $sel>$brinc</option>";
							}
						?>
					</select>
					<?php if ($erros["idmacho"]): ?>
						<span class="help-block">*O campo Macho é obrigatório</span>			
					<?php endif ?>			
				</div>
				<?php if ($erroIdmacho == 'has-error') echo "<span class='help-block'>*O campo macho é obrigatório</span>" ?>
			</div>
		</div>
		<div class="form-group <?php echo $erroIdfemea ?>">
			<label for="inputIdfemea" class="control-label col-sm-2 col-md-2 col-lg-2">Fêmea</label>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
					<select name="idfemea" id="inputIdfemea" class="form-control"> 
						<option value="">--Selecione--</option> 
						<?php
							$sql = "select id, brinco from animal where data_exclusao is null and sexo = 'F' and id not in ($id) order by brinco";
							$res = mysqli_query($link, $sql);
							while ($temp = mysqli_fetch_array($res)) {
								$idf = $temp['id'];
								$brinc = $temp['brinco'];
								
								if ($dados['idfemea'] == $idf) {
									$sel = "selected";
								}
								else {
									$sel = "";
								}
								
								echo "<option value='$idf' $sel>$brinc</option>";
							}
						?>
					</select>
				<?php if ($erroIdfemea == 'has-error') echo "<span class='help-block'>*O campo fêmea é obrigatório</span>" ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-offset-2 col-md-2">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<button type="button" class="btn btn-primary" onClick="location.href='cobertura.php'">Voltar</button>
			</div>
		</div>
	</form>
</div>
</div>

</td></tr></ta	ble>
<?php include_once 'rodape.php';?>
