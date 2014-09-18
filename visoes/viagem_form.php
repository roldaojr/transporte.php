<?php
$js_import = array("jquery", "jquery.ui");
$css_import = array("jquery.ui");
?>
<h1>
<?php echo $titulo;?>
</h1>
<form method="post" action="viagem/salvar.php">
	<?php if($viagem -> getID()) {
	?>
	<input type="hidden" name="viagem_id" value="<?php echo $viagem -> getID();?>" />
<?php if($_SESSION["usuario"]->getTipo() > 0) {?>
	<?php if($viagem->getSituacao() == VIAGEM_SITUACAO_APROVADA) {
	?>
	<input type="submit" name="imprimir" value="Imprimir Guia" />
	<input type="submit" name="realizada" value="Realizada" />
	<?php }?>
	<?php if($viagem->getSituacao() == VIAGEM_SITUACAO_SOLICITADA) {
	?>
	<input type="submit" name="aprovar" value="Aprovar" />
	<input type="submit" name="reprovar" value="Reprovar" />
	<?php }?>
	<?php if($viagem->getSituacao() != VIAGEM_SITUACAO_CANCELADA and $viagem->getSituacao() != VIAGEM_SITUACAO_REALIZADA) {
	?>
	<input type="submit" name="cancelar" value="Cancelar" />
	<?php }?>
<?php }?>
	<?php } // $viagem->getID()?>
	<form action="viagem/salvar.php" method="post">
		<fieldset>
			<legend>
				Informa&ccedil;&otilde;es essenciais
			</legend>
			<table>
				<tr>
					<td>Solicitante</td>
					<td>
					<?php
if($_SESSION["usuario"] -> getTipo() == 1) {
	if($viagem -> getID()) {
		echo $viagem -> getSolicitante() -> getID() . " - " . htmlentities($viagem -> getSolicitante() -> getNome());
	} else {
?>
					<input type="text" size="11" id="solicitante_id" name="solicitante_id" value="<?php echo $viagem -> getSolicitante() -> getID();?>" />
					<input type="button" id="procurar_solicitante" name="procurar_solicitante" value="Procurar"/>
					<span id="solicitante_nome">
						<?php echo htmlentities($viagem -> getSolicitante() -> getNome());?>
					</span>
<?php
	}
} else {
	echo $_SESSION["usuario"] -> getID() . " - " . htmlentities($_SESSION["usuario"] -> getNome());
}
?>
					</td>
				</tr>
				<tr>
					<td>Destino</td>
					<td>
					<input type="text" name="destino" size="50" value="<?php echo $viagem -> getDestino();?>" />
					</td>
				</tr>
				<tr>
					<td>Motivo</td>
					<td>
					<input type="text" name="motivo" size="50" value="<?php echo $viagem -> getMotivo();?>" />
					</td>
				</tr>
				<tr>
					<td>Qtd. Pessoas</td>
					<td>
					<input type="text" name="qtd_pessoas" size="10" value="<?php echo $viagem -> getQtdpessoas();?>" />
					</td>
				</tr>
				<tr>
					<td>Saída</td>
					<td>
					<input type="text" name="saida" size="20" value="<?php $d = $viagem -> getSaida();echo ($d)?$d:date("d/m/Y"); ?>" />
					</td>
				</tr>
				<tr>
					<td>Chegada</td>
					<td>
					<input type="text" name="chegada" size="20" value="<?php $d = $viagem -> getChegada(); echo ($d)?$d:date("d/m/Y"); ?>" />
					</td>
				</tr>
<?php if($viagem -> getID()) { ?>
				<tr>
					<td>Sitau&ccedil;&atilde;o</td>
					<td>
					<?php echo $viagem -> getSituacaoAsString();?>
					</td>
				</tr>
<?php } ?>
			</table>
		</fieldset>
<?php if(!in_array($viagem -> getSituacao(), array(VIAGEM_SITUACAO_SOLICITADA, VIAGEM_SITUACAO_REPROVADA, VIAGEM_SITUACAO_CANCELADA))) { ?>
		<fieldset>
			<legend>
				Informa&ccedil;&otilde;es adicionais
			</legend>
			<table>
				<tr>
					<td>Km Saída</td>
					<td>
					<input type="text" name="km_saida" size="10" value="<?php echo $viagem -> getKmSaida();?>" />
					</td>
				</tr>
				<tr>
					<td>Km Chegada</td>
					<td>
					<input type="text" name="km_chegada" size="10" value="<?php echo $viagem -> getKmChegada();?>" />
					</td>
				</tr>
				<tr>
					<td>Abastecido</td>
					<td>
					<input type="text" name="abastecido" size="10" value="<?php echo $viagem -> getAbastecido();?>" />
					</td>
				</tr>
				<tr>
					<td>Veículo</td>
					<td>
					<?php echo $viagem -> getVeiculo() -> getTipo() . ' ' . $viagem -> getVeiculo() -> getPlaca();?>
<?php if($_SESSION["usuario"]->getTipo() > 0) {?>
					<a href="viagem/escolher_veiculo.php?viagem_id=<?php echo $viagem -> getID();?>">Alterar</a>
<?php }?>
					</td>
				</tr>
				<tr>
					<td>Motorista</td>
					<td>
					<?php echo $viagem -> getMotorista() -> getNome();?>
<?php if($_SESSION["usuario"]->getTipo() > 0) {?>
					<a href="viagem/escolher_motorista.php?viagem_id=<?php echo $viagem -> getID();?>">Alterar</a>
<?php }?>
					</td>
				</tr>
			</table>
		</fieldset><?php }?>
<?php if($_SESSION["usuario"]->getTipo() > 0 and ($viagem->getSituacao() != VIAGEM_SITUACAO_CANCELADA and $viagem->getSituacao() != VIAGEM_SITUACAO_REALIZADA)) {?>
    <input type="submit" name="salvar" value="Salvar" />
<?php } elseif($viagem->getSituacao() == VIAGEM_SITUACAO_SOLICITADA) {?>
    <input type="submit" name="salvar" value="Salvar" />
<?php } else {?>
    <!--- sem botão salvar --->
<?php }?>
	</form>
</form>
<script language="JavaScript">
	$(document).ready(function(){
		$("input[name=saida]").datepicker({
			dateFormat: 'dd/mm/yy'
		});
		$("input[name=chegada]").datepicker({
			dateFormat: 'dd/mm/yy'
		});
		$("#procurar_solicitante").click(function(){
			var id = $("#solicitante_id").val();
			$("#solicitante_nome").load("usuario/procurar.php?id="+id);
		});
	});
</script>