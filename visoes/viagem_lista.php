<h1>Viagens</h1>
<a href="viagem/cadastro.php">Adicionar</a> |
<a href="viagem/lista.php">Todas</a>
<a href="viagem/lista.php?situacao=0">Aguardando aprovação</a>
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
foreach($viagens as $viagem) {
	if(@$altRow) $altRow = 0; else $altRow = 1;
?>
	<tr<?php echo ($altRow)?" class=\"alt\"":"";?>>
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
<?php if($_SESSION["usuario"]->getTipo() > 0) {?>
		<td>
		<a href="viagem/cadastro.php?id=<?php echo $viagem -> getID();?>">Editar</a>
		<a onclick="if(confirm('Deseja realmente apagar esta viagem')) return true; else return false;" href="viagem/excluir.php?id=<?php echo $viagem -> getID();?>">Apagar</a>
		</td>
<?php } else {?>
		<td>
		<a href="viagem/cadastro.php?id=<?php echo $viagem -> getID();?>">Detalhes</a>
		</td>	
<?php }?>
		</tr>
		<?php }?>
</table>
<?php if(!isset($situacao)): ?>
<div>
<?php if($paginaAtual > 1) {?>
	<a href="viagem/lista.php?p=<?php echo $paginaAtual - 1;?>">Anterior</a>
<?php } else {?>
	<a>Anterior</a>
<?php }?>
<?php for($i=1;$i<=$totalDePaginas;$i++) {?>
	<a href="viagem/lista.php?p=<?php echo $i;?>"><?php echo $i;?></a>
<?php }?>
<?php if($paginaAtual < $totalDePaginas) {?>
	<a href="viagem/lista.php?p=<?php echo $paginaAtual + 1;?>">Próxima</a>
<?php } else {?>
	<a>Próxima</a>
<?php }?>
</div>
<?php endif;?>