<?php

function __visArray($arr, $leg = null) {
    echo "<fieldset>";
    echo "<legend>$leg</legend>";
    echo "<pre>";
    var_dump($arr);
    echo "</pre>";
    echo "</fieldset>";
}

function __autoload($classe) {
    if (file_exists($classe . '.class.php')) {
        include_once $classe . '.class.php';
    } elseif (file_exists('class/' . $classe . '.class.php')) {
        include_once 'class/' . $classe . '.class.php';
    } elseif (file_exists('class/Domain/' . $classe . '.class.php')) {
        include_once 'class/Domain/' . $classe . '.class.php';
    } elseif ($classe == 'PHPMailer') {
        include_once 'class/PHPMailer_v51/class.phpmailer.php';
    }
}

function gerar_login($ds_login){
    $login_ini = array_shift(explode(" ", $ds_login));
    $login_fim = array_pop(explode(" ", $ds_login));
    
    return $login_ini.".".$login_fim;
}

function aumentar_letra($string){
    return strtr(strtoupper($string),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
}


$urlImgs = "imgs/";
$urlCss = "css/";
$urlJs = "script/";
?>