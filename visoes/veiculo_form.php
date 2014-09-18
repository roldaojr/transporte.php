<?php
$js_import = array("jquery", "jquery.ui");
$css_import = array("jquery.ui");
?>
<h1>
<?php echo $titulo;?>
</h1>
<form action="veiculo/salvar.php" method="post">
	<input type="hidden" name="id" value="<?php echo $veiculo->getID() ?>" />
	<fieldset>
		<legend>
			Dados do Ve&iacute;culo
		</legend>
		<table border="0">
			<tr>
				<td>Tipo:</td>
				<td>
				<input type="text" name="tipo" maxlength="20" value="<?php echo $veiculo->getTipo() ?>" />
				</td>
			</tr>
			<tr>
				<td>Placa:</td>
				<td>
				<input type="text" name="placa" maxlength="10" value="<?php echo $veiculo->getPlaca() ?>" />
				</td>
			</tr>
			<tr>
				<td>Categoria:</td>
				<td>
				<input type="text" name="categoria" maxlength="20" value="<?php echo $veiculo->getCategoria() ?>" />
				</td>
			</tr>
			<tr>
				<td>Qtd. de Pessoas:</td>
				<td>
				<input type="text" name="qtdpessoas" maxlength="10" value="<?php echo $veiculo->getQtdPessoas() ?>" />
				</td>
			</tr>
		</table>
		<input type="submit" name="salvar" value="Salvar" />
	</fieldset>
</form>
<?php if($veiculo->getID()) {?>
<form action="veiculo/adicionar_revisao.php" method="post">
	<input type="hidden" name="veiculo_id" value="<?php echo $veiculo->getID(); ?>" />
	<fieldset>
		<legend>
			Revis&otilde;es
		</legend>
		<table border="0">
			<tr>
				<th>Data</th>
				<th>KM</th>
				<th>Descri&ccedil;&atilde;o</th>
			</tr>
			<?php foreach($veiculo->ListarRevisoes() as $revisao) {
			?>
			<tr>
				<td>
				<?php echo $revisao -> getData();?>
				</td>
				<td>
				<?php echo $revisao -> getQuilometragem();?>
				</td>
				<td>
				<?php echo $revisao -> getDescricao();?>
				</td>
				<td>
				<a onclick="if(confirm('Deseja realmente remover esta revisão')) return true; else return false;" href="veiculo/remover_revisao.php?id=<?php echo $revisao -> getID();?>&veiculo_id=<?php echo $veiculo -> getID();?>">Excluir</a>
				</td>
			</tr>
			<?php }?>
			<tr>
				<td>
				<input type="text" name="data" size="10" value="<?php echo date("d/m/Y");?>" />
				</td>
				<td>
				<input type="text" name="quilometragem" size="4" />
				</td>
				<td>
				<input type="text" name="descricao" size="20" />
				</td>
				<td>
				<input type="submit" value="Adicionar" />
				</td>
			</tr>
		</table>
	</fieldset>
</form>
<?php }?>
<script language="JavaScript">
	$(document).ready(function(){
		$("input[name=data]").datepicker({
			dateFormat: 'dd/mm/yy'
		});
	});
</script>