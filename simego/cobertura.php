<?php include_once 'cabecalho.php';?>	
<?php require_once 'conexao.php'; ?>

<?php 
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
			c.data_exclusao is null
		order by
			c.data";
	$result = mysqli_query($link, $sql);
?>

<table bgcolor="#F5F5DC" border="0" width=80% align="center">
<tr><td>

<div class="row">
	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
		<?php
			require_once 'menucobertura.php'; ?>
	</div>	
</div>
<hr/>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<table width=100% class="table table-striped table-hover" id="tblCoberturas">
				<tr width=100%>
					<th>Id</th>	
					<th>Data</th>
					<th>Macho</th>
					<th>Fêmea</th>
					<th>% Consanguinidade</th>
					<th></th>
				</tr>
				<?php 
					while ($dados = mysqli_fetch_array($result)) {
						$id = $dados['id'];
						$data = implode("/", array_reverse(explode("-", $dados['data'])));
						$macho = $dados['macho'];
						$femea = $dados['femea'];
						$consanguinidade = $dados['consanguinidade'] * 100;
						
						echo "<tr width=100% align='center'>
							<td>$id</td>
							<td>$data</td>
							<td>$macho</td>
							<td>$femea</td>
							<td>$consanguinidade</td>
							<td>
								<a class='menu2' href=cobertura_detalhes.php?id=$id>Detalhes</a> |
								<a class='menu2' href=cobertura_editar.php?id=$id>Editar</a> |
								<a class='menu2' href=cobertura_excluir.php?id=$id>Excluir</a>
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

