<?php

session_start();
require '_cabecalho.php';
$Session = new Assinatura();
$Session->setValidaSession(array(10));

$cod = $_SESSION['CO_PROPOSTA'];

//echo $cod; exit;

$projeto = new Projeto;
$proj = $projeto->localizarProjeto($cod);
$subp = $projeto->listarSubProjetos($cod);

$municipio = new DadosMunicipio;
$mun = $municipio->localizarMunicipio($proj[0]['CO_MUNICIPIO_IBGE']);

?>
<fieldset>
    <legend><strong>Subprojetos</strong></legend>
    <form action="frmNovoSubProjeto.php" method="POST" name="frmNovoSubProjeto">
        <input type="hidden" name="CO_PROJETO" value="<?php echo $cod; ?>">
        <input type="hidden" name="NU_SIPAR" value="<?php echo $proj[0]['NU_SIPAR']; ?>">
        <input type="hidden" name="MUNICIPIO" value="<?php echo $mun[0]['NO_MUNICIPIO'] . "/" . $mun[0]['SG_UF']; ?>">
        <input type="submit" name="SUBPROJETO" value="Novo Subprojeto">
    </form><br>
    <div style="float:right;">Quantidade de grupos aprovados<?php echo ' ('.$_SESSION['QT_GRUPO'].')'; ?></div>
    <?php
    if ($subp) {
        echo "<table width=100%>";
        echo "<thead>";
        echo "<tr>";
        //echo "<th>CO_SEQ_TURMA</th>";
        echo "<th>Nome do Projeto</th>";
        echo "<th>Detalhar</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($subp as $sub) {
            echo "<form name='" . $sub[''] . "' method='POST' action='#'>";
            echo "<tr>";
            //echo "<td>" . $sub['CO_SEQ_TURMA'] . "</td>";
            echo "<td class='alinha'>&nbsp;&nbsp;&nbsp;" . $sub['NO_TURMA'] . "</td>";
            echo "<td width='100'>
                    <a href='frmSubprojeto.php?co_subprojeto=".$sub['CO_SEQ_TURMA']."'>
                        <img src='imgs/lupa.png' border='0' title='Detalhar'>
                    </a>
                  </td>";
            echo "</tr>";
            echo "</form>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "Não há Subprojetos cadastrados.";
    }
    ?>
</fieldset>
<?php
require "_rodape.php";
?>
<script src="script/jquery.maskedinput-1.3.min.js" type="text/javascript"></script>
<script src="script/jquery.validate.js" type="text/javascript"></script>

<script language="javascript" type="text/javascript">
    $(document).ready(function() {
        $(".SIPAR").mask("99?999.999999/9999-99");
        $('tbody tr:odd').addClass('odd');
        $('tbody tr:even').addClass('even');
    });
</script>

<style type="">
    .even{background-color: #f4f4f4;}
    .alinha{ text-align: left;} 
    .odd{
        background-color: #ffffff;
    }
    span{
        color: #ff0000;
    }
    h4{
        color: #00500f;
    }
</style>