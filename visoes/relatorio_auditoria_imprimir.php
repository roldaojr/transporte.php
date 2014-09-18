<h1>Relatório de Veículos (Auditoria)</h1>
<div>
	De <?php echo $data_inicio; ?> até <?php echo $data_fim; ?>
</div>
<h2>Controle de Uso dos Veículos Oficiais</h2>
<table cellspacing="0" border="0" width="100%">
	<tr>
		<th>Servidor/Motorista</th>
		<th>Carro/Tipo</th>
		<th>Destino</th>
		<th>Saída</th>
		<th>Retorno</th>
		<th>Km (saída)</th>
		<th>Km (retorno)</th>
		<th>Abastecimento</th>
	</tr>
<?php foreach($viagens as $viagem) {?>
	<tr>
		<td><?php echo $viagem -> getMotorista() -> getNome(); ?></td>
		<td><?php echo $viagem -> getVeiculo() -> getTipo(); ?></td>
		<td><?php echo $viagem -> getDestino(); ?></td>
		<td><?php echo $viagem -> getSaida(); ?></td>
		<td><?php echo $viagem -> getChegada(); ?></td>
		<td><?php echo $viagem -> getKmSaida(); ?></td>
		<td><?php echo $viagem -> getKmChegada(); ?></td>
		<td><?php echo $viagem -> getAbastecido(); ?></td>
	</tr>
<?php } ?>
</table>