<h1>Ve&iacute;culos</h1>
<a href="veiculo/cadastro.php">Adicionar</a>
<table border="0">
	<tr>
		<th>Placa</th>
		<th>Tipo</th>
		<th>Categoria</th>
		<th>Qtd. de Pessoas</th>
		<th>&nbsp;</th>
	</tr>
<?php
	foreach($veiculos as $veiculo) {
		if(@$altRow) $altRow = 0; else $altRow = 1;
?>
	<tr<?php echo ($altRow)?" class=\"alt\"":"";?>>
		<td>
		<?php echo $veiculo -> getPlaca();?>
		</td>
		<td>
		<?php echo $veiculo -> getTipo();?>
		</td>
		<td>
		<?php echo $veiculo -> getCategoria();?>
		</td>
		<td>
		<?php echo $veiculo -> getQtdPessoas();?>
		</td>
		<td>
		<a href="veiculo/cadastro.php?id=<?php echo $veiculo -> getID();?>">Editar</a>
		<a onclick="if(confirm('Deseja realmente apagar esta veiculo')) return true; else return false;" href="veiculo/excluir.php?id=<?php echo $veiculo -> getID();?>">Excluir</a>
		</td>
	</tr>
	<?php }?>
</table>
