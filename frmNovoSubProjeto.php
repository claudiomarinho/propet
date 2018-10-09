<?php
session_start();
require '_cabecalho.php';
$Session = new Assinatura();
$Session->setValidaSession(array(10));

$co_projeto = $_POST['CO_PROJETO'];
$nu_sipar   = $_POST['NU_SIPAR'];
$municipio  = $_POST['MUNICIPIO'];

if (isset($_POST['NO_SUBPROJETO']) && !empty($_POST['NO_SUBPROJETO'])) {
      
    $projeto = new Projeto;
 
    $projeto->setNoSubProjeto($_POST['NO_SUBPROJETO']);
    /* $projeto->setNoCoordenador($_POST['NO_COORDENADOR']);*/
    $projeto->setDsSubProjeto($_POST['DS_SUBPROJETO']);
    $projeto->setCoProjeto($co_projeto);

    $sub = $projeto->incluirSubProjeto();
    
    if ($sub) {
        header("Location: frmSubprojetos.php");
    } else {
        echo "<span>Erro ao gravar</span>";
    }
}
// echo"<script type='text/javascript'>alert('entrou aqui...');</script>";
// __visArray($proj);
?>
<strong>&nbsp;&nbsp;&nbsp;N&deg SIPAR:</strong> <?= $nu_sipar; ?> <br><br>
<form action="frmNovoSubProjeto.php" id="frmNovoSubProjeto" name="frmNovoSubProjeto" method="POST">
    <fieldset>
        <legend><strong>Subprojeto</strong></legend>
        <ul class="ulform">
            <li>
                <label>Nome do Subprojeto:<span>*</span></label>
                <input type='text' name='NO_SUBPROJETO' value=''>
            </li>
            <?php /*
            <li>
                <label>Nome do Coordenador:<span>*</span></label>
                <input type='text' name='NO_COORDENADOR' value=''>
            </li> 
            */ ?>
            <li>
                <label>Detalhes do Projeto:<span>*</span></label>
                <textarea name='DS_SUBPROJETO' class=estilotextarea ></textarea>
                <input type='hidden' name='CO_PROJETO' value='<?php echo $co_projeto; ?>'>
                <input type='hidden' name='NU_SIPAR' value='<?php echo $nu_sipar; ?>'>
                <input type='hidden' name='MUNICIPIO' value='<?php echo $municipio; ?>'>
            </li>  
        </ul>
        <div id="submit">
            <input type='submit' name='GRAVAR' value='Gravar'>
        </div>
    </fieldset>
</form>
<?php require "_rodape.php"; ?>
<script src="script/jquery.validate.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
    $(document).ready(function() {
        $('#frmNovoSubProjeto').validate({
            rules: {
                NO_SUBPROJETO: {
                    required: true
                },
                NO_COORDENADOR:{
                    required: true
                },
                DS_SUBPROJETO:{
                    required: true
                }
            },
            messages: {
                NO_SUBPROJETO: {
                    required: '<span>Informe o nome do subprojeto</span>'
                },
                NO_COORDENADOR:{
                    required: '<span>Informe o nome do coordenador</span>'
                },
                DS_SUBPROJETO:{
                    required: '<span>Informe os detalhes do projeto</span>'
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