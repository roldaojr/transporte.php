<?php
// Código para mostrar fotos aleatoreamente
$cwd = getcwd();
chdir(dirname(__FILE__) . "/../imagens/fotos");
$fotos = glob("*.png");
$foto = $fotos[mt_rand(0, count($fotos)-1)];
chdir($cwd);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<base href="/transporte/" />
		<link rel="stylesheet" href="css/estilos.css" type="text/css" />
		<?php
		if(isset($css_import) and is_array($css_import)) {
			foreach($css_import as $css) {
				printf("<link rel=\"stylesheet\" href=\"css/%s.css\" type=\"text/css\" />", $css);
			}
		}
		if(isset($js_import) and is_array($js_import)) {
			foreach($js_import as $js) {
				printf("<script language=\"JavaScript\" src=\"js/%s.js\"></script>\n", $js);
			}
		}
		?>
		<title>
			<?php
			if(isset($titulo)) {
				echo "$titulo - ";
			}
			?>Sistema de Controle de Ve&iacute;culos
		</title>
	</head>
	<body>
		<div class="topo">
			<div class="logo">
				<img class="imagem" src="imagens/logo.png" alt="Logo" height="50" />
				<span class="titulo">Sistema de Controle de Veículos</span>
			</div>
			<div class="sessao">
				<a href="usuario/logout.php">Sair</a>
			</div>
			<div class="fotos" align="center">
				<img src="imagens/fotos/<?php echo $foto;?>"/>
			</div>
		</div>
		<div id="menu">
			<ul>
				<?php if($_SESSION["usuario"] -> getTipo() == 1) { ?>
				<li>
					Cadastro
					<ul>
						<li>
							<a href="veiculo/lista.php">Ve&iacute;culos Cadastrados</a>
						</li>
						<li>
							<a href="veiculo/cadastro.php">Cadastrar Ve&iacute;culo</a>
						</li>
						<li>
							<a href="motorista/lista.php">Motoristas Cadastrados</a>
						</li>
						<li>
							<a href="motorista/cadastro.php">Cadastrar Motorista</a>
						</li>
					</ul>
				</li>
				<li>
					Viagem
					<ul>
						<li>
							<a href="viagem/cadastro.php">Solicitar viagem</a>
						</li>
						<li>
							<a href="viagem/lista.php">Registro de viagem</a>
						</li>
					</ul>
				</li>
				<li>
					Relat&oacute;rios
					<ul>
						<li>
							<a href="relatorio/auditoria.php">Auditoria</a>
						</li>
						<li>
							<a href="relatorio/quilometragem.php">Quilometragem</a>
						</li>
					</ul>
				</li>
				<?php } else {?>
				<li>
					Viagem
					<ul>
						<li>
							<a href="viagem/cadastro.php">Solicitar viagem</a>
						</li>
						<li>
							<a href="viagem/lista.php">Registro de viagem</a>
						</li>
					</ul>
				</li>
				<?php }?>
			</ul>
		</div>
		<?php if(isset($mensagem) and $mensagem) {
		?>
		<div class="mensagem">
			<?php echo $mensagem ?>
		</div><?php }?>
		<div id="principal">
			<?php echo $conteudo;?>
		</div>
	</body>
</html>
