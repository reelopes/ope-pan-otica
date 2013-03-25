<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


setlocale(LC_ALL, 'ptb', 'portuguese-brazil', 'pt-br', 'bra', 'brazil');
date_default_timezone_set('America/Sao_Paulo');




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

function subtraiHora($hora1,$hora2){
$hora1 = explode(":",$hora1);
$hora2 = explode(":",$hora2);
$acumulador1 = ($hora1[0] * 3600) + ($hora1[1] * 60);
$acumulador2 = ($hora2[0] * 3600) + ($hora2[1] * 60);
$resultado = $acumulador1 - $acumulador2;
$hora = floor($resultado / 3600);
$resultado = $resultado - ($hora * 3600);
$min = floor($resultado / 60);

if($hora>0 && $hora<10)$hora = '0'.$hora;
if($min>0 && $min<10)$min = '0'.$min;
return $hora.":".$min; 
} 
function somaHora($hora1,$hora2){
$hora1 = explode(":",$hora1);
$hora2 = explode(":",$hora2);
$acumulador1 = ($hora1[0] * 3600) + ($hora1[1] * 60);
$acumulador2 = ($hora2[0] * 3600) + ($hora2[1] * 60);
$resultado = $acumulador1 + $acumulador2;
$hora = floor($resultado / 3600);
$resultado = $resultado - ($hora * 3600);
$min = floor($resultado / 60);

if($hora>0 && $hora<10)$hora = '0'.$hora;
if($min>0 && $min<10)$min = '0'.$min;
return $hora.":".$min; 
} 




}
?>
