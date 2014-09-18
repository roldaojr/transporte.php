<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<base href="/transporte/" />
		<link rel="stylesheet" href="css/estilos.css" type="text/css" />
		<style>
			body, table {
				font-size: 11pt
			}
			h1 {
				font-size: 12pt;
				text-align: center
			}
			h2 {
				font-size: 8pt;
				text-align: center
			}
			.bloco div {
				border: 1px solid black;
				border-bottom-style: none;
				font-size: 12pt;
			}
			.bloco div:last-child {
				border-bottom-style: solid;
			}
			caption {
				font-weight: bold;
			}
		</style>
		<title>
			REQUISI&Ccedil;&Atilde;O DE TRANSPORTE
		</title>
	</head>
	<body>
		<div id="principal">
			<div align="center"><img src="imagens/logo-ifrn.jpg" height="150" /></div>
			<h2>Departamento de administra&ccedil;&atilde;o de do Campus de Pau dos Ferros</h2>
			<h1>REQUISI&Ccedil;&Atilde;O DE TRANSPORTE</h1>
			<table width="100%">
				<tr>
					<td>
					Requisi&ccedil;&atilde;o No.: <?php echo str_pad($viagem -> getID(), 4, "0", STR_PAD_LEFT);?>
					</td>
					<td>
					Ve&iacute;ulo: <?php echo $viagem -> getVeiculo() -> getTipo();?>
					</td>
				</tr>
				<tr>
					<td>
					Data: <?php echo $viagem->getData(); ?>
					</td>
					<td>
					Placa: <?php echo $viagem->getVeiculo()->getPlaca(); ?>
					</td>
				</tr>
				<tr colspan="2">
					<td>
					Solicitante: <?php echo $viagem->getSolicitante()->getNome(); ?>
					</td>
				</tr>
				<tr colspan="2">
					<td>
					Destino: <?php echo $viagem->getDestino(); ?>
					</td>
				</tr>
				<tr>
					<td>Sa&iacute;da: <?php echo $viagem->getSaida(); ?></td>
					<td>Chegada: <?php echo $viagem->getChegada(); ?></td>
				</tr>
			</table>
			<div>Intiner&aacute;rio</div>
			<div class="bloco">
				<div>&nbsp;</div>
				<div>&nbsp;</div>
				<div>&nbsp;</div>
			</div>
			<br/>
			<h1>Relatório do condutor</h1>
			<div>Altera&ccedil;&otilde;es</div>
			<div class="bloco">
				<div>&nbsp;</div>
				<div>&nbsp;</div>
				<div>&nbsp;</div>
			</div>
			<br/>
			<table align="center">
				<tr>
					<td valign="top">
					<table>
						<caption>
							Abastecimento
						</caption>
						<tr>
							<td>Quantidade:</td>
							<td>________________L</td>
						</tr>
						<tr>
							<td>Quilometragem.:</td>
							<td>________________Km</td>
						</tr>
					</table>
					</td>
					<td valign="top">
					<table>
						<caption>
							Quilmetragem
						</caption>
						<tr>
							<td>Inicial:</td>
							<td>________________Km</td>
						</tr>
						<tr>
							<td>Final:</td>
							<td>________________Km</td>
						</tr>
						<tr>
							<td>Total:</td>
							<td>________________Km</td>
						</tr>
					</table>
					</td>
				</tr>
			</table>
			<table width="100%">
				<tr>
					<td align="center">
					<br/>
					<br/>
					________________________________
					<br/>
					Respons&aacute;vel pela autoriza&ccedil;&atilde;o
					</td>
					<td align="center">
					<br/>
					<br/>
					__________________________
					<br/>
					Motorista
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>