<?php include_once 'cabecalho.php';?>	
<?php require_once 'conexao.php'; ?>

<?php 
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
			order by
				a.brinco";
				
	$result = mysqli_query($link, $sql);
?>

<table bgcolor="#F5F5DC" border="0" width=80% align="center">
<tr><td>

<div class="row">
	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
		<?php
			require_once 'menuanimal.php'; ?>
	</div>	
</div>

<hr/>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<table  width=100%  class="table table-striped table-hover" id="tblAnimais">
				<tr width=100% >
					<th>Id</th>	
					<th>Brinco</th>
					<th>Raça</th>
					<th>Sexo</th>
					<th>Pai</th>
					<th>Mãe</th>
					<th></th>
				</tr>
			
				<?php 
					while ($dados = mysqli_fetch_array($result)) {
						$id = $dados['id'];
						$brinco = $dados['brinco'];
						$raca = $dados['raca'];
						$sexo = $dados['sexo'];
						$pai = $dados['pai'];
						$mae = $dados['mae'];
						echo "
						<tr width=100% align='center'>
							<td>$id</td>
							<td>$brinco</td>
							<td>$raca</td>
							<td>$sexo</td>
							<td>$pai</td>
							<td>$mae</td>
							<td>
								<a class='menu2' href=animal_detalhes.php?id=$id>Detalhes</a> |
								<a class='menu2' href=animal_editar.php?id=$id>Editar</a> |
								<a class='menu2' href=animal_excluir.php?id=$id>Excluir</a>
							</td>
						</tr>";
					}
				?>
			</tbody>
		</table>
	</div>	
</div>

</td></tr>
</table>

<?php include_once 'rodape.php'; ?>

