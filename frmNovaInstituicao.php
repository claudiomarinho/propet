<?php
session_start();
require '_cabecalho.php';
$Session = new Assinatura();
$Session->setValidaSession(array(10));

$co_projeto = $_POST['CO_PROJETO'];
$nu_sipar   = $_POST['NU_SIPAR'];
//$municipio  = $_POST['MUNICIPIO'];


if (isset($_POST['GRAVAR']) && !empty($_POST['GRAVAR'])) {
        
    $projeto = new Projeto();
    
    $projeto->setCnpj($_POST['CNPJ']);
    $projeto->setCoProjeto($_POST['CO_PROJETO']);

    $inst = $projeto->incluirInstituicao();

    if ($inst) {
        $msg_inst = 'S';
        //echo '<div class="ok">Institui&ccedil;&atilde;o cadastrada com sucesso</div>';
        header("Location: frmProjeto.php?projeto=".base64_encode($co_projeto)."&msg_inst=".$msg_inst);
    } else {
        echo '<div class="erro">Erro ao gravar</div>';
    }

    //__visArray($_POST);
}

?>
N&deg SIPAR:<strong><?php echo " ".$nu_sipar; ?></strong><br> 

<form action="frmNovaInstituicao.php" id="frmNovaInstituicao" name="frmNovaInstituicao" method="POST">
    <fieldset>
        <legend><strong>Instituição</strong></legend>
        <ul class="ulform">
            <li>
                <label>CNPJ:<span>*</span></label>
                <input type='text' name='CNPJ' id='CNPJ' value='' maxlength='14'>
            </li>
            <li>
                <label>Nome da Institui&ccedil;&atilde;o:<span>*</span></label>
                <input type='text' name='NO_INSTITUICAO' id='NO_INSTITUICAO' readonly='readonly' class="readonly">
                <input type='hidden' name='CO_PROJETO' value='<?php echo $co_projeto; ?>'>
                <input type='hidden' name='NU_SIPAR' value='<?php echo $nu_sipar; ?>'>
            </li>
        </ul>
        <div id="submit">
            <input type='submit' name='GRAVAR' value='Gravar'>
        </div>
    </fieldset>
</form>
<?php
require "_rodape.php";
?>
<script src="script/jquery.validate.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
    $(document).ready(function() {
        $("#CNPJ").blur(function(e){
            if($.trim($("#CNPJ").val()).length == 14){
                $.getScript("ajaxGeral.php?cnpj="+$("#CNPJ").val(), function(){
                    if(resultadoCNPJ["resultado"]){
                        $("#NO_INSTITUICAO").val(unescape(resultadoCNPJ["NO_INSTITUICAO"]));
                    }else{
                        $("#NO_INSTITUICAO").val(unescape(resultadoCNPJ["NO_INSTITUICAO"]));
                        alert("CNPJ inexistente!");
                    }
                });				
            }		
        })
        $('#frmNovaInstituicao').validate({
            rules: {
                CNPJ: {
                    required: true,
                    number: true,
                    minlength: 14
                },
                NO_INSTITUICAO: {
                    required: true
                }
            },
            messages: {
                CNPJ: {
                    required: '<span>Informe o CNPJ da instituição</span>',
                    number: '<span>Apenas números</span>',
                    minlength: '<span>O CNPJ deve conter 14 números</span>'
                },
                NO_INSTITUICAO: {
                    required: '<span>Informe o CNPJ correto para carregar a instuição</span>'
                }
            }
        });
    });
    $('.ok').fadeIn('slow').delay(1500).fadeOut('slow');
</script>
<style type="text/css">
    span{
        color: #ff0000;
    }
    h4{
        color: #00500f;
    }
</style>