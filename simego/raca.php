<?php include_once 'cabecalho.php';?>	
<?php require_once 'conexao.php'; ?>

<?php 
	$result = mysqli_query($link, "select * from raca where data_exclusao is null");
?>

<table bgcolor="#F5F5DC" border="0" width=80% align="center">
<tr><td>

<div class="row">
	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
		<?php
			require_once 'menuraca.php'; ?>	
	</div>	
</div>
<hr/>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<table width=100%class="table table-striped table-hover" id="tblRaca">

				<tr width=100%>
					<th>Id</th>	
					<th>Descrição</th>
					<th></th>
				</tr>
				<?php 
					while ($dados = mysqli_fetch_array($result)) {
						$id = $dados['id'];
						$descricao = $dados['descricao'];
						echo "<tr width=100% align='center'>
							<td>$id</td>
							<td>$descricao</td>
							<td>
								<a class='menu2' href=raca_detalhes.php?id=$id>Detalhes</a> |
								<a class='menu2' href=raca_editar.php?id=$id>Editar</a> |
								<a class='menu2' href=raca_excluir.php?id=$id>Excluir</a>
							</td>
						</tr>";
					}
				?>
			</tbody>
		</table>
	</div>	
</div>

</td></tr></table>

<?php include_once 'rodape.php'; ?>

