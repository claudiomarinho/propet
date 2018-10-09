<?php
require "_cabecalho.php";

$cod_Sub = $_REQUEST['co_subprojeto'];

$projeto = new Projeto;
$subpro = $projeto->dadosSubprojeto($cod_Sub);

if (isset($subpro[0]['CO_SEQ_TURMA']) && !empty($subpro[0]['CO_SEQ_TURMA'])){
    $co_projeto     = $subpro[0]['CO_PROJETOSIES'];
    $co_subproj     = $subpro[0]['CO_SEQ_TURMA'];
    $nu_sipar       = $subpro[0]['NU_SIPAR'];
    $no_subproj     = $subpro[0]['NO_TURMA'];
    $ds_subproj     = $subpro[0]['DS_LINHAPESQUISA'];
}

if (isset($_POST['NO_SUBPROJETO']) && !empty($_POST['NO_SUBPROJETO'])) {
    $projeto->setNoSubProjeto($_POST['NO_SUBPROJETO']);
    $projeto->setDsSubProjeto($_POST['DS_SUBPROJETO']);
    $projeto->setCoProjeto($_POST['CO_PROJETO']);
    $projeto->setCoSubProjeto($_POST['CO_SUBPROJETO']);
   
    $sub = $projeto->incluirSubProjeto();

    if ($sub) {
        header("Location: frmSubprojetos.php");
    } else {
        echo "<span>Erro ao gravar</span>";
    }
}
?>
<strong>&nbsp;&nbsp;&nbsp;N&deg SIPAR:</strong> <?= $nu_sipar; ?> <br><br>
<form action="frmSubprojeto.php" name="frmSubprojeto" method="POST">
    <fieldset>
        <legend><strong>Subprojeto</strong></legend>
        <ul class="ulform">
            <li>
                <label>Nome do Subprojeto:<span>*</span></label>
                <input type='text' name='NO_SUBPROJETO' value='<?php echo $no_subproj; ?>'><br>
            </li>
            <li>
                <label>Detalhes do Projeto:<span>*</span></label>
                <textarea name='DS_SUBPROJETO' class=estilotextarea><?php echo $ds_subproj; ?></textarea>
                <input type='hidden' name='CO_PROJETO' value='<?php echo $co_projeto; ?>'>
                <input type='hidden' name='CO_SUBPROJETO' value='<?php echo $co_subproj; ?>'>
                <input type='hidden' name='NU_SIPAR' value='<?php echo $nu_sipar; ?>'>
            </li>  
        </ul>
        <div id="submit">
            <input type='submit' name='Atualizar' value='Atualizar'>
        </div>
    </fieldset>
</form>
<?php require "_rodape.php"; ?>
<script src="script/jquery.maskedinput-1.3.min.js" type="text/javascript"></script>
<script src="script/jquery.validate.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
    $(document).ready(function() {
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
                    required: '<span>Informe o N&reg; do SIPAR</span>'
                },
                QT_GRUPO:{
                    required: '<span>Informe a quantidade de grupos aprovados</span>',
                    number: '<span>Apenas números</span>'
                }
            }
        });
    });
</script>
<style type="text/css">
    span{
        color: #ff0000;
    }
    h4{
        color: #00500f;
    }
    .estilotextarea {
        width:300px;
        height:80px;
    }
</style>