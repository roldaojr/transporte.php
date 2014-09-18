<h1>Motoristas</h1>
<form action="viagem/salvar.php" method="post">
	<table border="0">
		<tr>
			<th>&nbsp;</th>
			<th>Nome</th>
			<th>Endereco</th>
			<th>Telefone</th>
			<th>N&deg; carteira</th>
			<th>Categoria</th>
		</tr>
		<?php foreach ($motoristas as $motorista){?>
		<tr>
			<td>
			<input type="radio" name="motorista_id" value="<?php echo $motorista -> getID();?>"/>
			</td>
			<td>
			<?php echo $motorista -> getNome();?>
			</td>
			<td>
			<?php echo $motorista -> getEndereco();?>
			</td>
			<td>
			<?php echo $motorista -> getTelefone();?>
			</td>
			<td>
			<?php echo $motorista -> getCnhNumero();?>
			</td>
			<td>
			<?php echo $motorista -> getCnhCategoria();?>
			</td>
		</tr>
		<?php }?>
	</table>
	<input type="hidden" name="viagem_id" value="<?php echo $viagem_id ?>"/>
	<input type="submit" name="alterar_motorista" value="Alterar"/>
	<a href="viagem/cadastro.php?id=<?php echo $viagem_id ?>">Voltar</a>
</form>
