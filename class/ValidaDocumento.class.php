<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ValidaDocumento
 *
 * @author NTI-DAB
 */
class ValidaDocumento {
    //put your code here

    public function validaCPF($cpf){

        $cpf = str_pad(ereg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);
    	
    	// Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
        if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999')
    	{
    	   return false;
        }
    	else
    	{   // Calcula os números para verificar se o CPF é verdadeiro
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

    public function validaCNPJ($cnpj){
        if (strlen($cnpj) <> 14)
                return false;

        $soma1 = ($cnpj[0] * 5) +
                                ($cnpj[1] * 4) +
                                ($cnpj[2] * 3) +
                                ($cnpj[3] * 2) +
                                ($cnpj[4] * 9) +
                                ($cnpj[5] * 8) +
                                ($cnpj[6] * 7) +
                                ($cnpj[7] * 6) +
                                ($cnpj[8] * 5) +
                                ($cnpj[9] * 4) +
                                ($cnpj[10] * 3) +
                                ($cnpj[11] * 2);
        $resto = $soma1 % 11;
        $digito1 = $resto < 2 ? 0 : 11 - $resto;

        $soma2 = ($cnpj[0] * 6) +
                                ($cnpj[1] * 5) +
                                ($cnpj[2] * 4) +
                                ($cnpj[3] * 3) +
                                ($cnpj[4] * 2) +
                                ($cnpj[5] * 9) +
                                ($cnpj[6] * 8) +
                                ($cnpj[7] * 7) +
                                ($cnpj[8] * 6) +
                                ($cnpj[9] * 5) +
                                ($cnpj[10] * 4) +
                                ($cnpj[11] * 3) +
                                ($cnpj[12] * 2);
        $resto = $soma2 % 11;
        $digito2 = $resto < 2 ? 0 : 11 - $resto;

        return (($cnpj[12] == $digito1) && ($cnpj[13] == $digito2));

    }
    
    function ValidaData($data,$menorAnoValido=null){
        $data = explode("/",$data); // fatia a string $dat em pedados, usando / como referência
        $d = $data[0];
        $m = $data[1];
    	$y = $data[2];

        if ($menorAnoValido && $y<$menorAnoValido) {
            $res = false;
        } elseif (!$d || !$m || !$y){
            $res = false;
        } else {
            $res = checkdate($m,$d,$y);
        }
        return $res;
    }    

    
    function validaSipar($nu_sipar){
        if(strlen($nu_sipar) != 20){
            return false;
        }else{
            return true;
        }
    }
    
    
}
?>