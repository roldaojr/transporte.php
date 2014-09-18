<h1>Relatório de Quilometragem</h1>
<div>
	De <?php echo $data_inicio; ?> até <?php echo $data_fim; ?>
</div>
<table cellsapcing="0" border="0" width="100%">
	<tr>
		<td>Data Solicitação</td>
		<td>Requisição</td>
		<td>Saida</td>
		<td>Chegada</td>
		<td>Km (saída)</td>
		<td>Km (retorno)</td>
		<td>Km Total</td>
	</tr>
<?php foreach($viagens as $viagem) {?>
	<tr>
		<td><?php echo $viagem -> getData(); ?></td>
		<td><?php echo $viagem -> getID(); ?></td>
		<td><?php echo $viagem -> getSaida(); ?></td>
		<td><?php echo $viagem -> getChegada(); ?></td>
		<td><?php echo $viagem -> getKmSaida(); ?></td>
		<td><?php echo $viagem -> getKmChegada(); ?></td>
		<td><?php echo $viagem -> getKmChegada() - $viagem -> getKmSaida(); ?></td>
	</tr>
<?php } ?>
</table>