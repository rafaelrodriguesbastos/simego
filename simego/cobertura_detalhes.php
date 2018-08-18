<?php include_once 'cabecalho.php';?>	
<?php require_once 'conexao.php'; ?>

<?php 
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
	$dados = mysqli_fetch_array($result);
?>

<table bgcolor="#F5F5DC" border="0" width=80% align="center">
<tr><td>

<h2>Detalhes da cobertura</h2>
<hr/>

<div class="row">
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		<dl class="dl-horizontal">
			<dt>
				Id:
			</dt>
			<dd>
				<?php echo $dados["id"] ;?>
			</dd>
			<dt>
				Data da cobertura:
			</dt>
			<dd>
				<?php $data=implode("/", array_reverse(explode("-", $dados["data"])));  echo $data; ?>
			</dd>
			<dt>
				Macho:
			</dt>
			<dd>
				<?php echo $dados["macho"] ?>
			</dd>
			<dt>
				Fêmea:
			</dt>
			<dd>
				<?php echo $dados["femea"] ?>
			</dd>
			<dt>
				% Consanguinidade:
			</dt>
			<dd>
				<?php echo $dados["consanguinidade"] * 100; ?>
			</dd>
		</dl>
	</div>
</div>

<p>
	<?php printf("<a class='menu2' href=cobertura_editar.php?id=%s>Editar</a> | <a class='menu2' href=cobertura.php>Voltar para lista</a>  ",$dados["id"]); ?>
</p>

</td></tr></table>

<?php	include_once 'rodape.php'; ?>
