<?php
	if (isset($_POST['cpf']) && isset($_POST['senha']))
{
	//se o usu�rio acabou de tentar efetuar login
	$cpf = $_POST['cpf'];
	$senha = md5($_POST['senha']);

	$query = 'select * from usuario '
			.'where cpf="'.$cpf.'" '
			.'and senha="'.$senha.'" AND situacao="1"';
 $result = mysql_query($query) or die (mysql_error());
 if (mysql_num_rows($result)>0)
	{
		// se o usu�rio estiver no banco de dados, registra o id do usu�rio
		$col = mysql_fetch_array($result);

		$_SESSION['nivel']=$col["nivel"];
		$_SESSION['valid_user'] = $col["cpf"];
		$_POST["rol"] = $col["cpf"];
		$_SESSION['cargo']= $col["cargo"];
		$_SESSION['nome']=$col["nome"];
		$_SESSION['computador'] = $_SERVER["REMOTE_ADDR"];
		$_SESSION["setor"] = $col["setor"];
		//echo "<h1>{$col["rol"]} - {$_SESSION['nivel']}</h1>";
		 if ( strstr($_SERVER["HTTP_USER_AGENT"], "MSIE") )
			 {
			//se for IE
				echo "<script> alert('Aconselhamos fortemente que voc� feche o Internet Explorer e abra o sistema com o Mozilla Firefox!');alert('Bem vindo aos nossos Sistemas!'); location.href='./?escolha=adm/cadastro_membro.php'; </script>";
			 }

				$hora=date('H');

				if ($hora>"18")
					{
						$sauda="Boa Noite! ";
					}elseif ($hora>"12") {

						$sauda="Boa Tarde! ";

					}else{
						$sauda="Bom Dia! ";
					}

		if ($_SESSION['setor']=='2') {
			echo "<script> alert('".$sauda.$_SESSION['nome']." . $quant_aniv'); location.href='./?escolha=tesouraria/agenda.php&menu=top_tesouraria';</script>";
		}else {
			$aniv = new aniversario();
			if ($aniv->qt_dia()>1){
					$quant_aniv = "Hoje temos ".$aniv->qt_dia()." aniversariantes!";
				}elseif ($aniv->qt_dia()==1) {
					$quant_aniv = "Hoje temos apenas um aniversariante!";
				}else {
					$quant_aniv = "Hoje n�o temos aniversariantes!";
				}
			echo "<script> alert('".$sauda.$_SESSION['nome']." . $quant_aniv'); location.href='./?escolha=aniv/aniversario.php&menu=top_aniv';</script>";
		}

	}
}
	if (isset($_SESSION['valid_user']))
	{
		echo "<h5> Nome: ".$_SESSION['nome']."<br/> Cargo: ".$_SESSION['cargo']."<br/> CPF: ".$_SESSION['valid_user'].
				'<br/>Host: '.$_SESSION['computador'].'</h5>';
		echo "<p><a class='btn btn-info' href='logout.php'>Sair</a>
		<a class='btn btn-info' href='./?escolha=alt_senha.php'>Trocar Senha</a></p>";

		//Verifica se a senha foi alterada ap�s inicializa��o caso contr�rio chama p�gina de aletra��o
		$senha_crip = md5($_SESSION["valid_user"]);
		$query_senha = "select * from usuario "
		."where cpf='{$_SESSION["valid_user"]}'"
		." and senha='$senha_crip' ";
 		$result_senh = mysql_query($query_senha) or die (mysql_error());

 		if (mysql_num_rows($result_senh)>0){

 			echo "Desculpe-nos, por�m voc� s� poder� continuar no sistema ap�s alterar sua senha atual!";
 			$_GET ["escolha"] = "alt_senha.php";
 		}

	}
	else
	{
		if (isset($cpf))
		{
			// se o usu�rio tentar efetuar o login e falhar
			echo "<script> alert('Usu�rio desconhecido ou senha incorreta!');</script>";
		}
	// o usu�rio n�o tentou efetuar o login ainda ou saiu

		// fornece um formul�rio para efetuar o login
?>
<fieldset>
<legend>Entrar</legend>
  <form name="" method="post" action="">
	<label>CPF:</label>
	<input name="cpf" type="text" id="cpf" autofocus="autofocus"
	required='required' class="form-control" tabindex="<?php echo ++$ind;?>">
	<label>Senha:</label>
	<input name="senha" type="password" id="senha" required='required'
	class="form-control" tabindex="<?php echo ++$ind;?>">
	<br>
  	<input type="submit" name="Submit" value="logar"
  	class='btn btn-primary' tabindex="<?php echo ++$ind;?>" />
  </form>
</fieldset>
<?php
	}
?>
