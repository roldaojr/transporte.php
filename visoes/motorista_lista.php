<h1>Cadastro de motorista</h1>
<a href="motorista/cadastro.php">Adicionar</a>
<table border='0'>
	<tr>
		<th>Nome</th>
		<th>Endereco</th>
		<th>Telefone</th>
		<th>N&deg; carteira</th>
		<th>Categoria</th>
		<th>&nbsp;</th>
	</tr>
<?php
	foreach ($motoristas as $motorista){
		if(@$altRow) $altRow = 0; else $altRow = 1;
?>
	<tr<?php echo ($altRow)?" class=\"alt\"":"";?>>
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
		<td>
		<a href="motorista/cadastro.php?id=<?php echo $motorista -> getID();?>">Editar</a>
		<a onclick="if(confirm('Deseja realmente apagar esta motorista')) return true; else return false;" href="motorista/excluir.php?id=<?php echo $motorista -> getID();?>">Apagar</a>
		</td>
	</tr>
	<?php }?>
</table>
