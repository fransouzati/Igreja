<?php 
if ($_SESSION["setor"]==2 || $_SESSION["setor"]>50){
?><p>
<a <?PHP $b=id_corrente ("receita");?> href="./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec=1">
	<button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Contabilidade</button></a>
<a <?PHP $b=id_corrente ("despesa");?> href="./?escolha=controller/despesa.php&menu=top_tesouraria&rec=1">
	<button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Despesas</button></a>
	  <a <?PHP $b=id_corrente ("recibo");?> href="./?escolha=controller/recibo.php&menu=top_tesouraria&rec=1">
	<button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Recibos</button></a>
	  <a <?PHP $b=id_corrente ("prestacao");?> href="./?escolha=tesouraria/prestacao.php&menu=top_tesouraria">
	<button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Presta&ccedil;&atilde;o de Contas</button></a>
	  <a <?PHP $b=id_corrente ("adiant");?> href="./?escolha=controller/limpeza.php&menu=top_tesouraria">
	<button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Mat. de Limpeza</button></a>
	  <a <?PHP $b= id_corrente ("agenda");?> href="./?escolha=tesouraria/agenda.php&menu=top_tesouraria">
	<button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Agenda</button></a>
	  <a <?PHP $b=id_corrente ("envelope");?> href="./?escolha=tesouraria/envelope.php&menu=top_tesouraria">
	<button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Envelope</button></a>
	</p>
<?php
}
?>