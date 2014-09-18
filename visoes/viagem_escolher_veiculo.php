<h1>Escolher Ve&iacute;culos</h1>
<form action="viagem/salvar.php" method="post">
	<table border="0">
		<tr>
			<th>&nbsp;</th>
			<th>Placa</th>
			<th>Tipo</th>
			<th>Categoria</th>
			<th>Qtd. de Pessoas</th>
		</tr>
		<?php foreach($veiculos as $veiculo) {?>
		<tr>
			<td>
			<input type="radio" name="veiculo_id" value="<?php echo $veiculo -> getID();?>"/>
			</td>
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
		</tr>
		<?php }?>
	</table>
	<input type="hidden" name="viagem_id" value="<?php echo $viagem_id ?>"/>
	<input type="submit" name="alterar_veiculo" value="Salvar"/>
	<a href="viagem/cadastro.php?id=<?php echo $viagem_id ?>">Voltar</a>
</form>
