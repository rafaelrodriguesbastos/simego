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
	$dados = mysqli_fetch_array($result);
}else{
	$id = $_POST["id"];
	$brinco = $_POST['brinco'];
	$sexo = $_POST["sexo"];
	$idraca = $_POST["idraca"];
	$idpai = $_POST["idpai"];
	$idmae = $_POST["idmae"];
	
	if ($sexo == "")
	{
		$erroSexo = "has-error";
		$temErro = true;
	}
	if ($idraca == "")
	{
		$erroRaca = "has-error";
		$temErro = true;
	}

	if($temErro){
		$dados["id"] = $id;
		$dados["sexo"] = $sexo;
		$dados["raca"] = $idraca;
		$alert = "erro";
	}else{
		//$sexo = str_replace($sexo,"'","");
		$sqlUpdate = sprintf("update animal set 
			brinco = '%s',
			sexo = '%s',
			idraca = %s,
			idpai = %s,
			idmae = %s
			where
			id = %s",
			$brinco, $sexo, $idraca, $idpai, $idmae, $id);

		$result = mysqli_query($link,$sqlUpdate);

		if ($result)
		{
			$alert = "sucesso";
			$result = mysqli_query($link,"select * from animal where id = ".$id);
			$dados = mysqli_fetch_array($result);
		}
	}
}

?>

<table bgcolor="#F5F5DC" border="0" width=80% align="center">
<tr><td>

<h2>Editar Animal</h2>

<div class="form-horizontal">
	<form action="animal_editar.php" method="POST" role="form">
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
		<div class="form-group <?php echo $erroSexo ?>">
			<label for="inputBrinco" class="control-label col-sm-2 col-md-2 col-lg-2">Brinco</label>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<input type="text" name="brinco" id="inputBrinco" class="form-control" value="<?php echo $dados['brinco']; ?>" required="required">
				<?php if ($erroBrinco == 'has-error') echo "<span class='help-block'>*O campo brinco do animal é obrigatório</span>" ?>
			</div>
		</div>
		<div class="form-group <?php echo $erroSexo ?>">
			<label for="inputSexo" class="control-label col-sm-2 col-md-2 col-lg-2">Sexo</label>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<select name="sexo" id="inputSexo" class="form-control" required="required"> 
					<option value="Selecione"> </option> 
					<option value="M" <?php if ($dados['sexo'] == 'M') echo "selected"; ?>>Macho</option> 
					<option value="F" <?php if ($dados['sexo'] == 'F') echo "selected"; ?>>Fêmea</option> 
				</select>
				<?php if ($erroSexo == 'has-error') echo "<span class='help-block'>*O campo sexo do animal é obrigatório</span>" ?>
			</div>
		</div>
		<div class="form-group <?php echo $erroRaca ?>">
			<label for="inputRaca" class="control-label col-sm-2 col-md-2 col-lg-2">Raça</label>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<select name="idraca" id="inputRaca" class="form-control" required="required"> 
					<option value="">--Selecione--</option> 
					<?php
						$sql = "select id, descricao from raca where data_exclusao is null order by descricao";
						$res = mysqli_query($link, $sql);
						while ($temp = mysqli_fetch_array($res)) {
							$idraca = $temp['id'];
							$desc = $temp['descricao'];
							
							if ($dados['raca'] == $desc) {
								$sel = "selected";
							}
							else {
								$sel = "";
							}
							
							echo "<option value='$idraca' $sel>$desc</option>";
						}
					?>
				</select>
				<?php if ($erroRaca == 'has-error') echo "<span class='help-block'>*O campo raça do animal é obrigatório</span>" ?>
			</div>
		</div>
		<div class="form-group <?php echo $erroPai ?>">
			<label for="inputPai" class="control-label col-sm-2 col-md-2 col-lg-2">Pai</label>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<select name="idpai" id="inputPai" class="form-control"> 
					<option value="">--Selecione--</option> 
					<?php
						$sql = "select id, brinco from animal where data_exclusao is null and sexo = 'M' order by brinco";
						$res = mysqli_query($link, $sql);
						while ($temp = mysqli_fetch_array($res)) {
							$idp = $temp['id'];
							$brinc = $temp['brinco'];
							
							if ($dados['pai'] == $brinc) {
								$sel = "selected";
							}
							else {
								$sel = "";
							}
							
							echo "<option value='$idp' $sel>$brinc</option>";
						}
					?>
				</select>
			</div>
		</div>
		<div class="form-group <?php echo $erroMae ?>">
			<label for="inputMae" class="control-label col-sm-2 col-md-2 col-lg-2">Mãe</label>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<select name="idmae" id="inputMae" class="form-control"> 
					<option value="">--Selecione--</option> 
					<?php
						$sql = "select id, brinco from animal where data_exclusao is null and sexo = 'F' order by brinco";
						$res = mysqli_query($link, $sql);
						while ($temp = mysqli_fetch_array($res)) {
							$idm = $temp['id'];
							$brinc = $temp['brinco'];
							
							if ($dados['mae'] == $brinc) {
								$sel = "selected";
							}
							else {
								$sel = "";
							}
							
							echo "<option value='$idm' $sel>$brinc</option>";
						}
					?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-offset-2 col-md-2">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<button type="button" class="btn btn-primary" onClick="location.href='animal.php'">Voltar</button>
			</div>
		</div>
	</form>
</div>
</div>

</td></tr></table>
<?php include_once 'rodape.php';?>
