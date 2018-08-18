<?php include_once 'cabecalho.php';?>	
<?php require_once 'conexao.php'; ?>

<?php 
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
?>
<table bgcolor="#F5F5DC" border="0" width=80% align="center">
<tr><td>

<h2>Detalhes do animal</h2>
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
				Brinco:
			</dt>
			<dd>
				<?php echo $dados["brinco"]; ?>
			</dd>

			<dt>
				Sexo:
			</dt>
			<dd>
				<?php echo $dados["sexo"]; ?>
			</dd>
			<dt>

				Raça:

			</dt>
			<dd>
				<?php echo $dados["raca"] ?>
			</dd>

			<dt>
				Pai:
			</dt>
			<dd>
				<?php echo $dados["pai"] ?>
			</dd>
			<dt>
				Mãe:
			</dt>
			<dd>
				<?php echo $dados["mae"] ?>
			</dd>

		</dl>
	</div>
</div>
<p>
	<?php printf("<a class='menu2' href=animal_editar.php?id=%s>Editar</a> | <a class='menu2' href=animal.php>Voltar para lista</a>  ",$dados["id"]); ?>
</p>

</td></tr></table>

<?php	include_once 'rodape.php'; ?>
