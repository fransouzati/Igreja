<?PHP

controle ("atualizar");

$rec_alterar = new DBRecord("tes_recibo", $_POST['id'], "id");
list($anov, $mesv, $diav) = explode("-", $rec_alterar->data());
//echo '<br />  - Data atual - ultimo Vencimento: '.$rec_alterar->data().' ---- '. ceil( (mktime() - mktime(0,0,0,$mesv,$diav,$anov))/(3600*24));
$diasemissao = ceil( (mktime() - mktime(0,0,0,$mesv,$diav,$anov))/(3600*24)); //quantidade de dias ap�s a emiss�o do recibo

if (($_POST ['tabela']=='tes_recibo' && $diasemissao<'2') || $_POST ['tabela']!='tes_recibo' || $_SESSION["setor"]=='99'){

$hist = $_SESSION['valid_user'].": ".$_SESSION['nome'];

$query = "select * from {$_POST["tabela"]} ";
//echo "ID: ".$_POST["id"]." Campo: ".$_POST["campo"]." Tabela: ".$_POST["tabela"]." Post[Post[campo]]: ".ltrim($_POST[$_POST["campo"]]);
	$query .="where id='{$_POST["id"]}'";
	$id = (int)$_POST["id"];
	
$result = mysql_query($query) or die (mysql_error());

   if (mysql_num_rows($result)>0)
	{
		//$rec = new UPDatesist($_POST["tabela"], $id,$_POST["campo"]);
		
		$rec = new updatesist ("{$_POST["tabela"]}",$id,"id"); //Aqui ser� selecionado a informa��o do campo
		print "<br \>Foi atualizado de:<h3>{$rec->$_POST["campo"]()}</h3>\n"; //Imprime o valor na tela
				
		$rec->$_POST["campo"] = ltrim($_POST[$_POST["campo"]]); //Aqui � atribuido a esta vari�vel um valor para UpDate
				
		$rec->Update(); //� feita a chamada do m�todo q realiza a atualiza��o no Banco
				
				
		print "Para:<h3> {$_POST[$_POST["campo"]]}</h3>";
		
		echo "<script> alert('Altera��o realizada com sucesso!');window.history.go(-1);</script>";
				/*echo "<script> alert('Altera��o realizada com sucesso!');  location.href='./?escolha=tab_auxiliar/cadastro_bairro.php&uf={$_POST["uf_end"]}';</script>";*/

	}
		
	echo mysql_error();
	

}elseif ($_POST["tabela"]=='tes_recibo') { //fim do if para verificar se prazo para altera��o do recibo expirou
	echo '<script> alert("O prazo para altera��o do recibo expirou!");window.history.go(-1);</script>';
}
 ?> 