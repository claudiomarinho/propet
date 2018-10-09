<?php
require '_cabecalho.php';
@session_destroy();
if (isset($_POST['usuario'])){
    session_start();
    $autenticacao = new Autenticacao();
    $autenticacao->setLogin($_POST['usuario'], $_POST['senha']);
    $autenticacao->autorizacaoLogin();
    $autenticacao->closeConnection();
    
    if ($autenticacao->getAcesso()){
        header("location: indexRestrito.php");
        exit();
    }else{
       header("location: logout.php?failure=true");
    }
}elseif ($_POST['Sair']) {
    header("location: logout.php");
} else{
    header("location: logout.php?failure=true");
}
require '_rodape.php';
?>
