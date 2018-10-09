<?php
session_start();
require "_cabecalho.php";

$Session = new Assinatura();
$Session->setValidaSession(array(12));


$codigo = (int) base64_decode($_GET['projeto']);

$projeto = new Projeto;

$confirma_instiruicao = $_REQUEST['msg_inst'];
$confirma_municipio =   $_REQUEST['msg_muni'];
if ($confirma_instiruicao == 'S'){
    echo '<div class="ok">Institui&ccedil;&atilde;o cadastrada com sucesso</div>';    
}
if ($confirma_municipio == 'S'){
    echo '<div class="ok">Munic&iacute;pio cadastrado com sucesso</div>';
}

if (isset($_POST['ATUALIZAR']) && !empty($_POST['ATUALIZAR'])) {

    $co_projeto = $_POST['CO_PROJETO'];
    $projeto->setNuSipar($_POST['SIPAR']);
    $projeto->setQtAprovados($_POST['QT_GRUPO']);

    if ($projeto->atualizarProjeto($co_projeto)) {
        echo "<div class='ok'>Dados atualizados com sucesso</div>";
    } else {
        echo "<div class='erro'>N&deg; SIPAR já existe. Por favor tente outro número</div>";
    }
}elseif(isset($_POST['EXCLUIR']) && !empty($_POST['EXCLUIR'])){
            
    $projeto->setCo_munprojsies($_POST['CO_SEQ_MUNPROJSIES']);
    
    if($projeto->deletarMunicipio()){
        echo "<div class='ok'>Munic&iacute;pio excluido com sucesso</div>";
    } else {
        echo "<div class='erro'>N&atilde;o foi poss&iacute;vel excluir o munic&iacute;pio</div>";
    }
    
}

$proj = $projeto->localizarProjeto($codigo);

if (!$proj) {
    echo "Erro! Página inexistente.";
    require "_rodape.php";
    exit();
}

$municipio = new DadosMunicipio;
$mun = $municipio->localizarMunicipio($proj[0]['CO_MUNICIPIO_IBGE']);

//__visArray($proj);
?>
<form action="frmProjeto.php?projeto=<?php echo base64_encode($proj[0]['CO_SEQ_PROJETOSIES']); ?>" name="frmProjeto" id="frmProjeto" method="POST">
    <fieldset>
        <legend><strong>Proposta</strong></legend>
        <ul class="ulform">
            <li>
                <label>N&deg; SIPAR:</label>
                <input type='text' name='SIPAR' class='SIPAR' value="<?php echo $proj[0]['NU_SIPAR']; ?>">
            </li>
            <li>
                <label>Qt. Grupos Aprovados:</label>
                <input type='text' name='QT_GRUPO' value="<?php echo $proj[0]['QT_GRUPO']; ?>" style='width:40px; text-align:center;'>
                <input type='hidden' name='CO_PROJETO' value="<?php echo $proj[0]['CO_SEQ_PROJETOSIES'] ?>">
            </li>
        </ul>
        <div id="submit">
            <input type='submit' name='ATUALIZAR' value='Atualizar'>
        </div>
    </fieldset>
</form>
<?php
$projeto->setCoProjeto($codigo);
$inst = $projeto->listarInstituicoes();
$muns = $projeto->listarMunicipios();

$cidade = new DadosMunicipio;

?>

<fieldset>
    <legend><strong>Munic&iacute;pios</strong></legend>
    <form action="frmNovoMunicipio.php" method="POST" name="frmNovoMunicipio">
        <input type="hidden" name="CO_PROJETO" value="<?php echo $codigo; ?>">
        <input type="hidden" name="NU_SIPAR" value="<?php echo $proj[0]['NU_SIPAR']; ?>">
        <input type="submit" name="MUNICIPIO" value="Novo Munic&iacute;pio">
    </form><br>
    <?php
    $linhas = 1;
    if ($muns) {
        echo "<table width=100%>";
        echo "<thead>";
        echo "<tr>";
        echo "<th></th>";
        echo "<th>Munic&iacute;pios</th>";
        echo "<th>Excluir</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($muns as $m) {
            $cid = $cidade->localizarMunicipio($m['CO_MUNICIPIO_IBGE']);
            echo "<tr>";
            echo "<td>".$linhas++."</td>";
            echo "<td class='alinha'>&nbsp;&nbsp;&nbsp;" . $cid[0][0] . "</td>";
            echo "<form name='" . $m['CO_SEQ_MUNPROJSIES'] . "' method='POST' action='frmProjeto.php?projeto=".base64_encode($proj[0]['CO_SEQ_PROJETOSIES'])."'>";
            echo "<input type='hidden' name='CO_SEQ_MUNPROJSIES' value='" . $m['CO_SEQ_MUNPROJSIES'] . "'>";
            echo "<td><input type='submit' id='EXCLUIR' name='EXCLUIR' value='.' title='Excluir' style='background:url(imgs/excluir.gif); border:0; width:20px; height:20px;'></td>";
            echo "</form>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "Não há munic&iacute;pios cadastrados.";
    }
    ?>
</fieldset>
<fieldset>
    <legend><strong>Instituições</strong></legend>
    <form action="frmNovaInstituicao.php" method="POST" name="frmNovaInstituicao">
        <input type="hidden" name="CO_PROJETO" value="<?php echo $codigo; ?>">
        <input type="hidden" name="NU_SIPAR" value="<?php echo $proj[0]['NU_SIPAR']; ?>">
        <input type="hidden" name="MUNICIPIO" value="<?php echo $mun[0]['NO_MUNICIPIO'] . "/" . $mun[0]['SG_UF']; ?>">
        <input type="submit" name="INSTITUICAO" value="Nova Instituição">
    </form><br>
    <?php
    if ($inst) {
        echo "<table width=100%>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>CNPJ</th>";
        echo "<th>NOME</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($inst as $i) {
            echo "<form name='" . $i['CO_SEQ_PROPONENTE'] . "' method='POST' action='#'>";
            echo "<tr>";
            echo "<td>" . $i['NU_CPF_CNPJ_PESSOA'] . "</td>";
            echo "<input type='hidden' name='NU_SIPAR' value='" . $proj[0]['NU_SIPAR'] . "'>";
            echo "<input type='hidden' name='CO_PROJETOSIES' value='" . $i['CO_PROJETOSIES'] . "'>";
            echo "<td class='alinha'>&nbsp;&nbsp;&nbsp;" . $i['NO_PESSOA'] . "</td>";
            echo "</tr>";
            echo "</form>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "Não há instituições cadastrados.";
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
        $('tbody tr:odd').addClass('odd');
        $(".SIPAR").mask("99999.999999/9999-99");
        $('#frmProjeto').validate({
            rules: {
                SIPAR: {
                    required: true
                },
                QT_GRUPO:{
                    required: true,
                    number: true
                }
            },
            messages: {
                SIPAR: {
                    required: '<span>Informe o N&deg; do SIPAR</span>'
                },
                QT_GRUPO:{
                    required: '<span>Informe a quantidade de grupos aprovados</span>',
                    number: '<span>Apenas números</span>'
                }
            }
        });
        $('.ok').fadeIn('slow').delay(1500).fadeOut('slow');
    });
</script>
<style type="">
    thead{
        background-color: #ccc;
    }
    tbody .odd{
        background-color: #eaeaea;
    }
    span{
        color: #ff0000;
    }
    h4{
        color: #00500f;
    }
    #ok, #erro{
        display: none;
        color: #ff0000;
    }
    .alinha{ text-align: left;} 
</style>