<h1><img src="img/loading2.gif" width="30" height="30"></h1>
<?PHP
/**
 * Joseilton Costa Bruce
 *
 * LICEN�A
 *
 * Please send an email
 * to hiltonbruce@gmail.com so we can send you a copy immediately.
 *
 * @category   Pessoal
 * @package
 * @subpackage
 * @copyright  Copyright (c) 2008-2009 Joseilton Costa Bruce (http://)
 * @license    http://
 * Insere dados no banco do form cad_usuario.php na tabela:usuario
 */
controle ("admin_user");

if ($_SESSION["setor"]==$_POST["setor"] XOR $_SESSION["setor"]>50) {
	
	$hist = $_SESSION['valid_user'].": ".$_SESSION['nome'];
	
	$value = "'','{$_POST["nome"]}','{$_POST["cpf"]}','{$_POST["nivel"]}','{$_POST["setor"]}','{$_POST["cargo"]}',
	md5({$_POST["senha"]}),'1','$hist',NOW()";	
	
	$dados = new insert ($value,"usuario");
	$dados->inserir();
	echo "<h1>".mysql_insert_id()."</h>";//recupera o id do �ltimo insert no mysql
	
		echo "<script>location.href='./?escolha=tab_auxiliar/cad_usuario.php'; </script>";
		echo "<a href='./?escolha=tab_auxiliar/cad_usuario.php'>Continuar...<a>";
	
	
	/*
	$value="'{$_SESSION["rol"]}','','','','','','','','','','','','','','','','','','','','','','','',''";
	$eclesiastico = new insert ("$value","eclesiastico");
	$eclesiastico->inserir();
	*/
}else {
	
	echo "<script>alert('Desculpe! Mas, lembre-se voc� deve ter privil�gio para adminstra��o do Sistema para conclus�o do cadastro de acesso ao sistema!{$_SESSION["setor"]} - {$_POST["setor"]}');window.history.go(-2);</script>";
}

?>
<p>&nbsp;</p>