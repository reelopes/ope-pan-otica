<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Util {

function data_user_para_mysql($y){
    $data_inverter = explode("/",$y);
    $x = $data_inverter[2].'/'. $data_inverter[1].'/'. $data_inverter[0];
    return $x;
}

function data_mysql_para_user($y)
{
	if ($y != '')
	{
		$data_inverter = explode("-",$y);
		$x = $data_inverter[2].'/'. $data_inverter[1].'/'. $data_inverter[0];
		return $x;
	}
	else
	{
		return '';
	}

}
function valida_data($data, $tipo = "pt")
{

	if ($tipo == 'pt')
	{
		$d = explode("/", $data);
		$dia = $d[0];
		$mes = $d[1];
		$ano = $d[2];
	}
	else if ($tipo == 'en')
	{
		$d = explode("-",$data);
		$dia = $d[2];
		$mes = $d[1];
		$ano = $d[0];
	}

	//usando função checkdate para validar a data
	if (checkdate($mes, $dia, $ano))
	{
		$data = $ano.'/'.$mes.'/'.$dia;

		if (
			//verificando se o ano tem 4 dígitos
			(strlen($ano) != '4') ||
			//verificando se o mês é menor que zero
			($mes <= '0') ||
                        //verificando se o mês é maior que 12
                        ($mes > '12') ||
			//verificando se o dia é menor que zero
			($dia <= '0') ||
                        //verificando se o dia é maior que 31
                        ($dia > '31')
		    )
		{
			return false;
		}

		if (strlen($data) == 10)
			return true;
	}
	else
	{
		return false;
	}
}



}
?>
