<?php
session_start();
require '_cabecalho.php';
$Session = new Assinatura();
$Session->setValidaSession(array(10));

$formOff = false;

if($_POST['ALTERAR'] != '' && isset($_POST['ALTERAR'])){
    
    $senha      = $_POST['DS_SENHA'];
    $c_senha    = $_POST['DS_CONF_SENHA'];
    
    $usuario = new Usuario;
    $usuario->setCo_pessoa($_SESSION['CO_SEQ_PESSOA']);
    $usuario->setDs_senha($_POST['DS_SENHA']);
    
    $erros = null;
    
    if($usuario->localizarSenha()){
        $erros[] = 'Por favor insira uma senha nova';
    }
    if($senha <> $c_senha){
        $erros[] = 'A senha e sua confirmação devem ser iguais';
    }
    
    if(!isset($erros)){
        if($usuario->alterarSenha()){
            echo '<div class="ok">Senha Alterarda com Sucesso</div>';
            $formOff = true;
        }else{
            echo '<div class="ok">Erro ao alterar senha</div>';
        }
    }else{
        foreach($erros as $erro){
            echo '<div class="erro">'.$erro.'</div><br>';
        }
    }
}

$tabIndex = 1

?>
<fieldset>
    <legend>Altera&ccedil;&atilde;o de senha</legend>
    <?php if(!$formOff){ ?>
    <h3>Coordenador</h3>
    <p>Por favor altere suas senha para sua segurança.</p>
    <form name="frmAlterarSenha" id="frmAlterarSenha" action="frmAlterarSenha.php" method="POST">
        <ul class="ulform">
            <li><label><span>*</span>Nova Senha:</label>
                <input type="password" tabindex="<?php echo $tabIndex++; ?>" name="DS_SENHA" id="DS_SENHA" size="15" maxlength="11">
            </li>
            <li><label><span>*</span>Confirmar Senha:</label>
                <input type="password" tabindex="<?php echo $tabIndex++; ?>" name="DS_CONF_SENHA" id="DS_CONF_SENHA" size="15" maxlength="11"><br>
            </li>
        </ul>
        <div id="submit">
            <input type="submit" name="ALTERAR" value="Alterar">
        </div>
    </form>
    <?php }else{ ?>
    <div id="Redireciona" style="min-height: 100px; text-align: center; padding-top: 40px; color: #626262; font-size: large;">
        Aguarde voc&ecirc; ser&aacute; redirecionado.
        <img src="imgs/carregando.gif" height="30">
        <?php
            $Str_Location = 'indexRestrito.php';
            exit('<meta http-equiv="refresh" content="5; url=' . urldecode($Str_Location) . '"/>'); 
        ?>
    </div>        
    <?php } ?>
</fieldset>
<?php
require '_rodape.php';
?>
<script src="script/jquery.validate.js" type="text/javascript"></script>
<script src="script/jquery.cpf.js" type="text/javascript"></script>
<script src="script/jquery.Email.js" type="text/javascript"></script>
<script src="script/jquery.pstrength-min.1.2.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
    $(document).ready(function() {
        $('#frmAlterarSenha').validate({
            rules: {
                DS_SENHA: {
                    required: true,
                    minlength: 8
                },
                DS_CONF_SENHA: {
                    equalTo: '#DS_SENHA'                    
                }
            },
            messages: {
                DS_SENHA: {
                    required: 'Informe a senha',
                    minlength: 'A senha deve possuir no m&iacute;nico<br> 8 caracteres'
                },
                DS_CONF_SENHA: {
                    equalTo: 'A senha e sua confirmação<br> devem ser iguais'
                }
            }
        });
        
        $("#DS_SENHA").pstrength({ minChar:8 });
        
        setTimeout(function(){
            $(".ok").slideUp();
        }, 2500);
    });
</script>
<style type="text/css">
span{ color:#FF0000;}
</style>