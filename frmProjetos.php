<?php
require "_cabecalho.php";
session_start();
$Session = new Assinatura();
$Session->setValidaSession(array(12));

?>
<form action="frmProjetos.php" name="frmProjetos" id="frmProjetos" method="POST">
    <fieldset>
        <legend><strong>Consulta de propostas</strong></legend>
        Nº do SIPAR<br>
        <input type="text" name="SIPAR" class="SIPAR" value="<?php echo $_POST['SIPAR']; ?>">
        <input type="submit" name="BUSCAR" value="Buscar">
    </fieldset>
</form>
<?php
$proj = new Projeto;
$municipios = new DadosMunicipio;

if (isset($_POST) && !empty($_POST)) {
    //$proj->setNuSipar($_POST['SIPAR']);
    $projeto = $proj->localizarProjetos($_POST['SIPAR']);


    if ($projeto) {
        echo "<br>";
        echo "<strong>Foram encontrado(s) " . count($projeto) . " resultado(s)</strong>";
        echo "<br><br>";
        echo "<fieldset>";
        echo "<legend><strong>Resultados da busca<strong/></legend>";
        echo "<table width=100%>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>N SIPAR</th>";
        echo "<th>COORDENADOR</th>";
        echo "<th width='15%'>Detalhar</th>";
        echo "</tr>";
        echo "<tbody>";
        foreach ($projeto as $p) {
            $mun = $municipios->localizarMunicipio($p['CO_MUNICIPIO_IBGE']);
            echo "<tr>";
            echo "<td width='170'>" . $p['NU_SIPAR'] . "</td>";
            echo "<td>" . utf8_encode($p['NO_PESSOA']) . "</td>";
            echo "<td width='100'><a href='frmProjeto.php?projeto=" . base64_encode($p['CO_SEQ_PROJETOSIES']) . "'><img src='imgs/lupa.png' border='0' title='Detalhar'></a></td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</fieldset>";
    } else {
        echo "<br><strong>Não foram encotrados resultados para " . $_POST['SIPAR'] . "</strong>";
    }
} else {
    $tds_proj = $proj->listarProjetos();

    if ($tds_proj) {
        echo "<fieldset>";
        echo "<legend><strong>Todos Projetos (" . count($tds_proj) . ")</strong></legend>";
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>N&deg; SIPAR</th>";
        echo "<th>COORDENADOR</th>";
        echo "<th width='15%'>Detalhar</th>";
        echo "</tr>";
        echo "<tbody>";
        foreach ($tds_proj as $p) {
            $mun = $municipios->localizarMunicipio($p['CO_MUNICIPIO_IBGE']);
            echo "<tr>";
            echo "<td width='170'>" . $p['NU_SIPAR'] . "</td>";
            echo "<td>" . utf8_encode($p['NO_PESSOA']) . "</td>";
            echo "<td width='100'><a href='frmProjeto.php?projeto=" . base64_encode($p['CO_SEQ_PROJETOSIES']) . "'><img src='imgs/lupa.png' border='0' title='Detalhar'></a></td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</fieldset>";
    }
}

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