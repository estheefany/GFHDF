<?php

/**
* Funcao para pegar um valor de um array de forma segura
* sem dar erro caso nao exista
* $arr $key
*/
function _v($arr,$val){
	if (isset($arr[$val])){
		return $arr[$val];	
	} else {
		return "";	
	}
}

function dd($arr){
    print "<pre>";
    print_r($arr);
    print "</pre>";
    die();
}

/**
* AmericanDate to PtBrDate
*/
function dateToBr($date = ""){
    if ($date == ""){
        return "";
    }
    
    $date = date_create_from_format('Y-m-d',$date);
    return date_format($date, 'd/m/Y');
}

/**
* AmericanDate to PtBrDate
*/
function dateToEUA($date = ""){
    if ($date == ""){
        return "";
    }
    
    $date = date_create_from_format('d/m/Y', $date);
    return date_format($date, 'Y/m/d');
}

function setValidationError($field, $msg){
    if (!isset($_SESSION['errors'])){
        $_SESSION['errors'] = [];
    }
    $_SESSION['errors'][$field] = $msg;
}
function hasError($field, $return){
    if (isset($_SESSION['errors']) && isset($_SESSION['errors'][$field])){
        if ($return)
            return $return;
        else
            return true;
    } else {
        if ($return)
            return "";
        else
            return false;
    }
}


function getValidationError($field){
    if (isset($_SESSION['errors']) && isset($_SESSION['errors'][$field])){
        $msg = $_SESSION['errors'][$field];
        unset($_SESSION['errors'][$field]);
        return $msg;
    }
}

function old($field, $default){
    if (isset($_SESSION['old']) && isset($_SESSION['old'][$field])){
        return $_SESSION['old'][$field];
    } else {
        return $default;
    }
}

function validateRequired($data, $field){
    if ( trim(_v($data,$field)) == ""){
        return false;
    }
    return true;
}

function validateDate($date, $format = 'Y-m-d H:i:s') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}


function validateCPF($cpf = null) {

	// Verifica se um número foi informado
	if(empty($cpf)) {
		return false;
	}

	// Elimina possivel mascara
	$cpf = preg_replace("/[^0-9]/", "", $cpf);
	$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
	
	// Verifica se o numero de digitos informados é igual a 11 
	if (strlen($cpf) != 11) {
		return false;
	}
	// Verifica se nenhuma das sequências invalidas abaixo 
	// foi digitada. Caso afirmativo, retorna falso
	else if ($cpf == '00000000000' || 
		$cpf == '11111111111' || 
		$cpf == '22222222222' || 
		$cpf == '33333333333' || 
		$cpf == '44444444444' || 
		$cpf == '55555555555' || 
		$cpf == '66666666666' || 
		$cpf == '77777777777' || 
		$cpf == '88888888888' || 
		$cpf == '99999999999') {
		return false;
	 // Calcula os digitos verificadores para verificar se o
	 // CPF é válido
	 } else {   
		
		for ($t = 9; $t < 11; $t++) {
			
			for ($d = 0, $c = 0; $c < $t; $c++) {
				$d += $cpf{$c} * (($t + 1) - $c);
			}
			$d = ((10 * $d) % 11) % 10;
			if ($cpf{$c} != $d) {
				return false;
			}
		}

		return true;
	}
}

function setFlash($key, $msg){
    if (!isset($_SESSION['flash'])){
        $_SESSION['flash'] = [];
    }

    $_SESSION['flash'][$key] = ["msg"=>$msg, "out"=>false];
}

function getFlash($key){
    if (isset($_SESSION['flash']) && isset($_SESSION['flash'][$key])){
        $_SESSION['flash'][$key]["out"] = true;
        return $_SESSION['flash'][$key]["msg"];
    } else {
        return "";
    }
}