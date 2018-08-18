<?php include_once 'cabecalho.php';?>	
<?php require_once 'conexao.php'; ?>

<?php 
	$id = $_GET["id"];
	$result = mysqli_query($link,"select * from raca where id = ".$id);
	$dados = mysqli_fetch_array($result);
?>

<table bgcolor="#F5F5DC" border="0" width=80% align="center">
<tr><td>

<h2>Detalhes da Raça</h2>
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
				Descrição:
			</dt>
			<dd>
				<?php echo $dados["descricao"]; ?>
			</dd>
		</dl>
	</div>
</div>
<p>
	<?php printf("<a class='menu2' href=raca_editar.php?id=%s>Editar</a> | <a class='menu2' href=raca.php>Voltar para lista</a>  ",$dados["id"]); ?>
</p>

</td></tr></table>

<?php	include_once 'rodape.php'; ?>
