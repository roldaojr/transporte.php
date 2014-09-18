<h1><?php echo $titulo; ?></h1>
<form action="motorista/salvar.php" method="post">
	<input type="hidden" name="id" value="<?php echo $motorista->getID() ?>" />
	<fieldset>
		<legend>Dados do motorista</legend>
		<table border="0">
			<tr>
				<td>Nome:</td>
				<td>
				<input type="text" name="nome" value="<?php echo $motorista->getNome() ?>">
				</td>
			</tr>
			<tr>
				<td>Telefone:</td>
				<td>
				<input name="telefone" type="text" id="telefone" value="<?php echo $motorista->getTelefone() ?>">
				</td>
			</tr>
			<tr>
				<td>Endereco:</td>
				<td>
				<input name="endereco" type="text" id="endereco" value="<?php echo $motorista->getEndereco() ?>">
				</td>
			</tr>
			<tr>
				<td>Nº da Carteira:</td>
				<td>
				<input name="cnhnumero" type="text" id="cnhnumero" value="<?php echo $motorista->getCnhNumero() ?>">
				</td>
			</tr>
			<tr>
				<td>Categoria:</td>
				<td>
				<input name="cnhcategoria" type="text" id="cnhcategoria" value="<?php echo $motorista->getCnhCategoria() ?>">
				</td>
			</tr>
		</table>
		<input type="submit" name="salvar" value="Salvar"/>
	</fieldset>
</form>
