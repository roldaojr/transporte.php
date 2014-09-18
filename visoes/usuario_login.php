<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="/transporte/css/estilos.css" type="text/css" />
		<title>Sistema de Controle de Ve&iacute;culos</title>
		<style>
			html, body {
				width: 100%;
				height: 100%;
				vertical-align: middle;
			}
			div#login {
				display: block;
				padding: 10px;
				margin: auto;
				background-color: #eeffee;
			}
			table.login_block {
				width: 100%;
				height: 100%;
			}
			#login {
				background-color: #ccffcc;
				display: inline;
			}
		</style>
	</head>
	<body>
		<table class="login_block" border="0">
			<tr>
				<td valign="middle" align="center">
				<form action="autenticar.php" method="post">
					<?php if($mensagem) {?><span class="mensagem"><?php echo $mensagem ?></span><?php }?>
					<fieldset id="login">
						<legend>
							Autentica&ccedil;&atilde;o de Usuário
						</legend>
						<table align="center">
							<tr>
								<td>Login:</td>
								<td>
								<input type="text" name="login" />
								</td>
							</tr>
							<tr>
								<td>Senha:</td>
								<td>
								<input type="password" name="senha" />
								</td>
							</tr>
							<tr>
								<td colspan="2" align="right">
								<input type="submit" value="Entrar" />
								</td>
							</tr>
						</table>
					</fieldset>
				</form>
				</td>
			</tr>
		</table>
	</body>
</html>
