<?php include_once 'cabecalho.php';?>
<?php require_once 'conexao.php'; ?>

<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$brinco = $_POST["brinco"];
	$sexo = $_POST["sexo"];
	$idraca = $_POST["idraca"];
	$idpai = $_POST["idpai"]==""?'NULL':$_POST["idpai"];
	$idmae = $_POST["idmae"]==""?'NULL':$_POST["idmae"];

	foreach ($_POST as $key => $value)
	{
		if(empty($value))
		{
			if($key == "brinco")
			{
				$erros["brinco"] = true;
			}else if ($key == "sexo")
			{
				$erros["sexo"] = true;

			}else if($key == "idraca")
			{
				$erros["idraca"] = true;
			}

		}
	}

	print_r($erros);

	if (!$erros)
	{
		$qryInsert = sprintf("insert into animal (brinco, idraca, idpai, idmae, sexo) values ('%s',%s,%s,%s,'%s')",$brinco, $idraca, $idpai, $idmae, $sexo);
		$result = mysqli_query($link,$qryInsert);
		header("Location: animal.php");
	}	
}

?>

<table bgcolor="#F5F5DC" border="0" width=80% align="center">
<tr><td>

<h3>Novo Animal</h3>
<hr>

<form action="animal_novo.php" method="POST" class="form-horizontal" role="form">
		
	<div class="form-group <?php if ($erros["brinco"]) echo 'has-error' ?>">
		<label for="inputBrinco" class="col-sm-2 control-label">Brinco:</label>
		<div class="col-sm-3">
			<input type="text" name="brinco" id="inputBrinco" class="form-control" required="required">
			<?php if ($erros["brinco"]): ?>
				<span class="help-block">*O campo brinco do animal é obrigatório</span>				
			<?php endif ?>
		</div>
	</div>

	<div class="form-group <?php if ($erros["sexo"]) echo 'has-error' ?>">
		<label for="inputSexo" class="col-sm-2 control-label">Sexo:</label>
		<div class="col-sm-3">			 
			<select name="sexo" id="inputSexo" class="form-control" required="required"> 
				<option value="Selecione"> </option> 
				<option value="M">Macho</option> 
				<option value="F">Fêmea</option> 
			</select>
			<?php if ($erros["sexo"]): ?>
				<span class="help-block">*O campo sexo do animal é obrigatório</span>				
			<?php endif ?>
		</div>
	</div>

	<div class="form-group <?php if ($erros["raca"]) echo 'has-error' ?>">
		<label for="inputRaca" class="col-sm-2 control-label">Raça:</label>
		<div class="col-sm-2">
			<select name="idraca" id="inputRaca" class="form-control" required="required"> 
				<option value="">--Selecione--</option> 
				<?php
					$sql = "select id, descricao from raca where data_exclusao is null order by descricao";
					$res = mysqli_query($link, $sql);
					while ($temp = mysqli_fetch_array($res)) {
						$idraca = $temp['id'];
						$desc = $temp['descricao'];
						
						echo "<option value='$idraca'>$desc</option>";
					}
				?>
			</select>
			<?php if ($erros["raca"]): ?>
				<span class="help-block">*O campo raça do animal é obrigatório</span>			
			<?php endif ?>
		</div>
	</div>

	<div class="form-group <?php if ($erros["idpai"]) echo 'has-error' ?>">
		<label for="inputIdpai" class="col-sm-2 control-label">Pai:</label>
		<div class="col-sm-2">
			<select name="idpai" id="inputIdpai" class="form-control"> 
				<option value="">--Selecione--</option> 
				<?php
					$sql = "select id, brinco from animal where data_exclusao is null and sexo = 'M' order by brinco";
					$res = mysqli_query($link, $sql);
					while ($temp = mysqli_fetch_array($res)) {
						$idp = $temp['id'];
						$brinc = $temp['brinco'];
						
						echo "<option value='$idp'>$brinc</option>";
					}
				?>
			</select>
			<?php if ($erros["idpai"]): ?>
				<span class="help-block">*O campo Pai do animal é obrigatório</span>			
			<?php endif ?>			
		</div>
	</div>

	<div class="form-group <?php if ($erros["idmae"]) echo 'has-error' ?>">
		<label for="inputIdmae" class="col-sm-2 control-label">Mae:</label>
		<div class="col-sm-2">
			<select name="idmae" id="inputIdmae" class="form-control"> 
				<option value="">--Selecione--</option> 
				<?php
					$sql = "select id, brinco from animal where data_exclusao is null and sexo = 'F' order by brinco";
					$res = mysqli_query($link, $sql);
					while ($temp = mysqli_fetch_array($res)) {
						$idm = $temp['id'];
						$brinc = $temp['brinco'];
						
						echo "<option value='$idm'>$brinc</option>";
					}
				?>
			</select>
			<?php if ($erros["idmae"]): ?>
				<span class="help-block">*O campo Mae do animal é obrigatório</span>			
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
