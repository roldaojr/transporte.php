<h1>Viagens Solicitadas</h1>
<table border="0" width="100%">
	<tr>
		<th>Solicitante</th>
		<th>Solicitado em</th>
		<th>Destino</th>
		<th>Motivo</th>
		<th>Quant. Pessoas</th>
		<th>Sa&iacute;da</th>
		<th>Chegada</th>
		<th>Situa&ccedil;&atilde;o</th>
		<th>&nbsp;</th>
	</tr>
	<?php
foreach($viagens_solicitadas as $viagem) {
if(@$altRow) $altRow = 0; else $altRow = 1;
	?>
	<tr<?php echo ($altRow)?" class=\"alt\"":"";?>
		>
		<td>
		<?php echo htmlentities($viagem -> getSolicitante() -> getNome());?>
		</td>
		<td>
		<?php echo htmlentities($viagem -> getData());?>
		</td>
		<td>
		<?php echo htmlentities($viagem -> getDestino());?>
		</td>
		<td>
		<?php echo htmlentities($viagem -> getMotivo());?>
		</td>
		<td>
		<?php echo $viagem -> getQtdPessoas();?>
		</td>
		<td>
		<?php echo $viagem -> getSaida();?>
		</td>
		<td>
		<?php echo $viagem -> getChegada();?>
		</td>
		<td>
		<?php echo $viagem -> getSituacaoAsString();?>
		</td>
		</tr>
		<?php }?>
</table>
<h1>Viagens Aprovadas</h1>
<table border="0" width="100%">
	<tr>
		<th>Solicitante</th>
		<th>Solicitado em</th>
		<th>Destino</th>
		<th>Motivo</th>
		<th>Quant. Pessoas</th>
		<th>Sa&iacute;da</th>
		<th>Chegada</th>
		<th>Situa&ccedil;&atilde;o</th>
		<th>&nbsp;</th>
	</tr>
	<?php
foreach($viagens_aprovadas as $viagem) {
if(@$altRow) $altRow = 0; else $altRow = 1;
	?>
	<tr<?php echo ($altRow)?" class=\"alt\"":"";?>
		>
		<td>
		<?php echo htmlentities($viagem -> getSolicitante() -> getNome());?>
		</td>
		<td>
		<?php echo htmlentities($viagem -> getData());?>
		</td>
		<td>
		<?php echo htmlentities($viagem -> getDestino());?>
		</td>
		<td>
		<?php echo htmlentities($viagem -> getMotivo());?>
		</td>
		<td>
		<?php echo $viagem -> getQtdPessoas();?>
		</td>
		<td>
		<?php echo $viagem -> getSaida();?>
		</td>
		<td>
		<?php echo $viagem -> getChegada();?>
		</td>
		<td>
		<?php echo $viagem -> getSituacaoAsString();?>
		</td>
		</tr>
		<?php }?>
</table>