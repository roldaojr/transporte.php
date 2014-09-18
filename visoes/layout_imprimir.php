<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<base href="/transporte/" />
		<link rel="stylesheet" href="css/estilos.css" type="text/css" />
		<title>
			<?php
			if(isset($titulo)) {
				echo "$titulo - ";
			}
			?>Sistema de Controle de Ve&iacute;culos
		</title>
	</head>
	<body>
		<div id="principal">
			<?php echo $conteudo;?>
		</div>
	</body>
</html>