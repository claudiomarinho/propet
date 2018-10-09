<?php
include_once 'class/Domain/conf.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
        if (isset($_SESSION) && count($_SESSION) > 0) {
            ?>
            <meta http-equiv="Refresh" content="1800; url=logout.php?time=true" />
            <?php
        }
        ?>
        <title>.:: SIGPROPET ::.</title>
        <link href="css/geral.css" rel="stylesheet" type="text/css" />
        <link href="css/forms.css" rel="stylesheet" type="text/css" />
        <script src="script/jquery-1.7.2.min.js" type="text/javascript"></script>
    </head>

    <body>
        <!-- tarja ministerio -->
        <div id="barra-brasil-v3">
            <div>
                <div class="imagemGov">
                    <a href="http://www.brasil.gov.br" target="_blank" class="brasilgov"></a>
                </div>
            </div>
        </div>
        <!-- tarja ministerio -->
        <div class="geral">
            <!-- GERAL --><br>
                <div class="contente">
                    <!-- Content -->
                    <div align="center"><img src="imgs/logo_topo.png" /></div>
                    <?php
                    if (isset($_SESSION['NO_LOGIN'])) {

                        $pessoa = new DadosPessoa;
                        $pessoa->setCoPerfilPessoa($_SESSION['CO_PERFIL']);
                        $perfil = $pessoa->localizarPerfilPessoa();

                        //__visArray($perfil);
                        //$pessoa->setCoPessoa($_SESSION['CO_SEQ_PESSOA']);
                        //__visArray($pessoa->localizarPessoa());
                        echo "<form action='logout.php' method=post name='logout'>";
                        echo "<div class='menuPrincipal'>" . $_SESSION['NO_PESSOA'] . " ( " . $perfil[0]['DS_PERFIL'] . " )";
                        echo "&nbsp;&nbsp;<input type=submit name='Sair' value='Sair'>";
                        echo "</div>";
                        echo "</form>";
                    } else {
                        echo "<div class='menuPrincipal'></div>";
                    }
                    require("_menuLateral.php");
                    ?>
                    <div class="principal">