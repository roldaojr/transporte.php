<?php
$js_import = array("jquery", "jquery.ui");
$css_import = array("jquery.ui");
?>
<script language="JavaScript">
	function openPopup(){
		window.open("","_popup","toolbars=0,location=0,width=800,height=600");
		return true;
	}
</script>
<h1>Relat&oacute;rio de Auditoria</h1>
<form action="relatorio/auditoria_imprimir.php" target="_popup" onsubmit="return openPopup()">	
	<table>
		<tr>
			<td>Da data:</td>
			<td>
			<input type="text" name="data_inicio" value="<?php echo $data_inicio; ?>" />
			</td>
		</tr>
		<tr>
			<td>At&eacute; a data:</td>
			<td>
			<input type="text" name="data_fim" value="<?php echo $data_fim; ?>" />
			</td>
		</tr>
	</table>
	<input type="submit" value="Gerar Relatório" />
</form>
<script language="JavaScript">
	$(document).ready(function(){
		$("input[name=data_inicio]").datepicker({
			dateFormat: 'dd/mm/yy'
		});
		$("input[name=data_fim]").datepicker({
			dateFormat: 'dd/mm/yy'
		});
	});
</script>