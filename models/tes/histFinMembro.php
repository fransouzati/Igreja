<?php
$nivel1 	= '';
$nivel2 	= '';
$comSaldo	= '';$menorAno = 0;$maiorAno=0;
switch ($hisFinanceiro) {
	case 1:
		//Listagem para historico finaceiro das contribui��es dos membros
		$lista = mysql_query('SELECT *,mesrefer AS mes,anorefer AS ano FROM dizimooferta WHERE lancamento<>"0" AND rol="'.$bsc_rol.'" AND credito!="803" ORDER BY anorefer,mesrefer ');
	break;
	case 2:
		$lista = mysql_query('SELECT *,DATE_FORMAT(data,"%c") AS mes,DATE_FORMAT(data,"%Y") AS ano FROM dizimooferta WHERE lancamento<>"0" AND igreja="'.$igreja.'" ORDER BY data,anorefer,mesrefer ');
	break;
	default:
		$lista = mysql_query('SELECT *,DATE_FORMAT(data,"%c") AS mes,DATE_FORMAT(data,"%Y") AS ano FROM dizimooferta WHERE lancamento<>"0" ORDER BY anorefer,mesrefer ');
	break;
}

//Lógica para monta o conjunto de variáveis para cmpor a tabelar a seguir
require_once 'help/tes/histFinanceiroMembro.php'; 

	if ($_GET['ano']=='') {
		$ano = date('Y');
	}elseif ($_GET['ano']<$menorAno){
		$ano = $menorAno;
	}elseif ($_GET['ano']>$maiorAno){
		$ano = $maiorAno;
	}else {
		$ano = $_GET['ano'];
	}
	 
	$ano = ($ano=='') ? date('Y'):$ano;
	
	$cor= true;
	for ($cont=1; $cont<13 ; $cont++){
		$bgcolor = $cor ? 'style="background:#ffffff"' : 'style="background:#d0d0d0"';
		$dz = 'dizimos'."$cont$ano"; $of = 'ofertaCultos'."$cont$ano"; $ofm = 'ofertaMissoes'."$cont$ano";
		$ofs = 'ofertaSenhoras'."$cont$ano"; $ofmoc = 'ofertaMocidade'."$cont$ano"; $ofi = 'ofertaInfantil'."$cont$ano";
		$ofe = 'ofertaEnsino'."$cont$ano";$ofCampanha = 'ofertaCampanha'."$cont$ano";
		$ofExtra = 'ofertaExtra'."$cont$ano";
		 
		//Soma da coluna
		$totDizAno  += $$dz;$totOfertaExtraAno  += $$ofExtra;$totOfertaAno  += $$of;
		$totMissoesAno  += $$ofm;$totSenhorasAno  += $$ofs;$totMocidadeAno  += $$ofmoc;
		$totInfantilAno  += $$ofi;$totEnsinoAno  += $$ofe;$totCampanhaAno += $$ofCampanha;

		//Soma linha
		$totMes = $$dz+$$of+$$ofm+$$ofs+$$ofmoc+$$ofi+$$ofe+$$ofCampanha;//Total do mes (linha)
		$subTotal= $$dz+$$ofExtra+$$of;//Total do dizimo + Ofertas Extras + ofertas + votos dos cultos
		$totSubTotal +=$subTotal;
		$totTotal += $totMes;

		$nivel1 .= '<tbody><tr '.$bgcolor.' class="sub"><th><strong>'.sprintf("%02u",$cont ).'/'.$ano.'</strong></th>';
		$nivel1 .= '<td id="moeda">'.number_format($$dz,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$ofExtra,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$of,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($subTotal,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$ofCampanha,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$ofm,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$ofs,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$ofmoc,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$ofi,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$ofe,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($totMes,2,',','.').' </td></tr>';

		for ($i=1; $i < 6; $i++) { 
			$dizSem = $dz.$i;$ofSem = $of.$i;$ofExtraSem = $ofExtra.$i;
			$ofCampanhaSem	= $ofCampanha.$i;$ofmSem = $ofm.$i;$ofsSem = $ofs.$i;
			$ofmocSem = $ofmoc.$i;$ofiSem = $ofi.$i;$ofeSem = $ofe.$i;
			$totMesSem = $$dizSem+$$ofSem+$$ofmSem+$$ofsSem+$$ofmocSem+$$ofiSem+$$ofeSem+$$ofCampanhaSem;//Total da Semana (linha)
			$subTotalSem = $$dizSem+$$ofExtraSem+$$ofSem;

			$nivel1 .= '<tr><td><strong>'.$i.'&ordf;&nbsp; Sem</strong></td>';
			$nivel1 .= '<td id="moeda">'.number_format($$dizSem,2,',','.').'</td>';
			$nivel1 .= '<td id="moeda">'.number_format($$ofExtraSem,2,',','.').'</td>';
			$nivel1 .= '<td id="moeda">'.number_format($$ofSem,2,',','.').'</td>';
			$nivel1 .= '<td id="moeda">'.number_format($subTotalSem,2,',','.').'</td>';
			$nivel1 .= '<td id="moeda">'.number_format($$ofCampanhaSem,2,',','.').'</td>';
			$nivel1 .= '<td id="moeda">'.number_format($$ofmSem,2,',','.').'</td>';
			$nivel1 .= '<td id="moeda">'.number_format($$ofsSem,2,',','.').'</td>';
			$nivel1 .= '<td id="moeda">'.number_format($$ofmocSem,2,',','.').'</td>';
			$nivel1 .= '<td id="moeda">'.number_format($$ofiSem,2,',','.').'</td>';
			$nivel1 .= '<td id="moeda">'.number_format($$ofeSem,2,',','.').'</td>';
			$nivel1 .= '<td id="moeda">'.number_format($totMesSem,2,',','.').' </td></tr>';
			$nivel1 .= '</tr>';
		}


		$nivel1 .= '</tbody>';


		$cor = !$cor;
	}

	?>


<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
//<![CDATA[
           
	$(document).ready(function() {
		var mais = '<a href="#"><img src="img/mais.gif" alt="Revelar/ocultar cidades" class="maismenos" /></a>'
			$('table#horario tbody tr:not(.sub):even').addClass('impar');			
			$('table#horario tbody tr:not(.sub)').hide();	 
			$('.sub th').css({borderBottom: '1px solid #333'}).prepend(mais);
				$('img',$('.sub th'))
					.click(function(event){
						event.preventDefault();
						if (($(this).attr('src')) == 'img/menos.gif'){
						$(this).attr('src', 'img/mais.gif')
						.parents()
						.siblings('tr').hide(); 
						} else {
						$(this).attr('src', 'img/menos.gif')
						.parents().siblings('tr').show();
						}; 
				});
		});
// ]]>	
</script>