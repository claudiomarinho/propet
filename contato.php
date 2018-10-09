<?php
require "_cabecalho.php";

if(isset($_POST) && !empty($_POST)){
    
    session_start();
    
    include_once 'class/dapphp-securimage-b3e4d81/securimage.php';

    $securimage = new Securimage();
    
    if ($securimage->check($_POST['captcha_code']) == false) {
        echo "<font color=red>O código de segurança de segurança está incorreto.</font><br /><br />";
        echo "<font color=red>Por favor <a href='javascript:history.go(-1)'>Volte</a> e tente novamente.</font>";
        require "_rodape.php";
    exit;
    }


    
    require "class/PHPMailer_v51/class.phpmailer.php";
    
    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->Host = "smtpaplicacao.saude.gov";
    
    $mail->From = "info.sgtes@saude.gov.br";
    $mail->FromName = "SIGPROPET";
    
    $mail->AddAddress("prosaude@saude.gov.br", "SIGPROPET");
    
    $mail->IsHTML(true);
    
    $mensagem = "Nome: ".$_POST['NOME']."<br>";
    $mensagem.= "Email: ".$_POST['EMAIL']."<br>";
    $mensagem.= "Mensagem:<br>".$_POST['MENSAGEM'];
   
    $mail->Subject = utf8_decode($_POST['ASSUNTO']);
    $mail->Body = utf8_decode($mensagem);
    
    $enviar = $mail->Send();
    $mail->ClearAllRecipients();
    $mail->ClearAttachments();
	 
	// Exibe uma mensagem de resultado
    if ($enviar) {
	echo "<span>E-mail enviado com sucesso!</span>";
    } else {
	echo "<span>Não foi possível enviar o e-mail.</span>";
	//echo "<b>Informações do erro:</b> <br />" . $mail->ErrorInfo;
    }
    
}

$indexTab = 1;
?>
<fieldset>
    <legend>Fale Conosco</legend>
<form action="contato.php" name="contato" id="contato" method="POST">
    Nome:<span>*</span><br>
    <input type="text" tabindex="<? echo $indexTab++; ?>" name="NOME"><br>
    Email:<span>*</span><br>
    <input type="text" tabindex="<? echo $indexTab++; ?>" name="EMAIL"><br>
    Assunto:<span>*</span><br>
    <input type="text" tabindex="<? echo $indexTab++; ?>" name="ASSUNTO"><br>
    Mensagem:<span>*</span><br>
    <textarea name="MENSAGEM" tabindex="<? echo $indexTab++; ?>"></textarea><br><br>
    <div style="border:#000 1px solid; width: 215px;">
    <img id="captcha" src="class/dapphp-securimage-b3e4d81/securimage_show.php" alt="CAPTCHA Image" /></div><br>
    C&oacute;digo de seguran&ccedil;a:<span>*</span><br>
    <input type="text" name="captcha_code" size="10" maxlength="6" />
    <a href="#" onclick="document.getElementById('captcha').src = 'class/dapphp-securimage-b3e4d81/securimage_show.php?' + Math.random(); return false"><img src="class/dapphp-securimage-b3e4d81/images/refresh.png" border="0" height="17"></a>
    <br>
    <input type="submit" name="ENVIAR" value="Enviar">
</form>
</fieldset>
<?php
require "_rodape.php";
?>
<script src="script/jquery.validate.js" type="text/javascript"></script>
<script src="script/jquery.Email.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
$(document).ready(function() {
    $('#contato').validate({
        rules: {
            NOME: {
                required: true
            },
            EMAIL: {
                required: true,
                Email: 'valid'
            },
            ASSUNTO:{
                required: true
            },
            MENSAGEM:{
                required: true               
            },
            captcha_code:{
                required: true
            }
        },
        messages: {
            NOME: {
                required: ' <span>Informe o seu nome</span>'
            },
            EMAIL: {
                required: ' <span>Informe seu email de contato</span>',
                Email: '<span>Insira um email válido</span>'
            },
            ASSUNTO:{
                required: ' <span>Informe um assunto</span>'
            },
            MENSAGEM:{
                required: ' <span>Informe a mensagem</span>'               
            },
            captcha_code:{
                required: '<span>Informe o código de segurança</span>'
            }
        }
    });
});
</script>
<style type="">
    span{
        color: #ff0000;
    }
    h4{
        color: #00500f;
    }
</style>