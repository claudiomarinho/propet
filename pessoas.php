<?php

 include "class/Domain/conf.php";
 include "class/JSON.php";

$cpf = $_GET['cpf'];
$cpfn = str_pad(ereg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);

$pessoa = new DadosCPF;
$ps     = $pessoa->localizarCPF($cpfn);

$json = new Services_JSON;
if(isset($ps) && $ps[0][0] != "")
{
    $ps['resultado'] = 1;
    echo "var resultadoCPF = ".$json->encode($ps);
}else{
    $ps['resultado'] = 0;
}

//__visArray($arr);

?>
