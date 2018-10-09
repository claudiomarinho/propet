<?php
require '_cabecalho.php';

session_start();
$Session = new Assinatura();
$Session->setValidaSession(array(10,12));

include_once 'class/DadosSexo.class.php';

$erro = null;

$sexo = new Sexo;
$sex = $sexo->carregaSexo();

$perfil = new DadosPerfil;
$per = $perfil->listarPerfil();

if (isset($_POST['CADASTRAR']) && $_POST['CADASTRAR'] != "") {
    $cpf        = $_POST['CPF'];
    $cpfn       = str_pad(ereg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);
    $sipar      = $_POST['SIPAR'];
    $ds_login   = gerar_login($_POST['NOME']);
    $senha      = $cpfn;
        
    $usuario = new Usuario;

    $usuario->setNu_pessoa_cpf($cpfn);
    $usuario->setNu_sipar($sipar);
    $usuario->setDs_login($ds_login);

    //$nu_cpf     = $usuario->localizaCPF();
    $nu_sipar   = $usuario->localizaSIPAR();
    $vinculo    = $usuario->localizaVinculo();
    $login      = $usuario->localizaUsuario();

    $val = new ValidaDocumento;

    if (!$val->validaCPF($cpfn)) {
        $erro[] = "CPF inválido";
    }
    /*
    if ($nu_cpf) {
        $erro[] = "CPF já cadastrado";
    }
     */
    if(isset($sipar) && $sipar != ""){
        if (!$val->validaSipar($sipar)) {
            $erro[] = "SIPAR inválido";
        }
        if ($vinculo) {
            $erro[] = "Ja existe um usu&aacute;rio vinculado a este SIPAR";
        }
        if (!$nu_sipar) {
            $erro[] = "SIPAR não existe";
        }
    }
    if($login){
        $erro[] = "Login já existente";
    }
    /*
    if (!isset($senha) || strlen($senha) < 8 || $senha <> $csenha) {
        $erro[] = "Senha e confirmação de senha devem ser iguais e possuirem pelo menos 8 caracteres!";
    }
    */
   
    if (!isset($erro)) {
        $usuario->setCo_perfil($_POST['PERFIL']);
        $usuario->setCo_sexo($_POST['SEXO']);
        $usuario->setCo_tipo_pessoa(1);
        $usuario->setDs_email($_POST['EMAIL']);
        $usuario->setDs_login($ds_login);
        $usuario->setDs_senha($senha);
        $usuario->setNo_pessoa($_POST['NOME']);
        $usuario->setSt_pessoa($_POST['ST_CADASTRO']);
        $usuario->setSt_sistema($_POST['ST_SISTEMA']);
        $usuario->setProjeto($_POST['SIPAR']);
        $usuario->setNu_pessoa_cpf(str_pad(ereg_replace('[^0-9]', '', $_POST['CPF']), 11, '0', STR_PAD_LEFT));

        if ($_SESSION['CO_PERFIL'] == '10'){
            $usuario->setProjeto(null);
            $usuario->setNu_sipar($_SESSION['NU_SIPAR']);
            if($usuario->incluirCoodAdjunto())
            {
                echo $_SESSION['NU_SIPAR'];
                //header("Location: frmSubprojetos.php");
            }
        }else{
            if ($usuario->incluirUsuario()) {
                //echo "<div class='ok'>Usuário cadastrado com sucesso.</div>";
                if($usuario->enviaEmail()){
                    echo "<div class='ok'>Usuário cadastrado com sucesso.</div>";
                    echo "<br>";
                    echo "<div class='info'>Foi enviado para o email ".$_POST['EMAIL']." os dados para o acesso do sistemas.</div>";
                }
            } else {
                echo "<div class='erro'>Erro ao cadastrar o usuário.</div>";
                $rt_perfil = $_POST['PERFIL'];
                $rt_email  = $_POST['EMAIL'];
                $rt_cpf    = $_POST['CPF'];
                $rt_sipar  = $_POST['SIPAR'];
                $rt_nome   = $_POST['NOME'];
            }
        }
    }
    if (isset($erro)) {
        foreach ($erro as $err) {
            echo "<div class='erro'>" . $err . "</div><br>";
        }
        $rt_perfil = $_POST['PERFIL'];
        $rt_email  = $_POST['EMAIL'];
        $rt_cpf    = $_POST['CPF'];
        $rt_sipar  = $_POST['SIPAR'];
        $rt_nome   = $_POST['NOME'];
    }
}
$tabIndex = 1;
?>

<?php

if ($_SESSION['CO_PERFIL'] == '10')
    { //<input type='hidden' name="SIPAR" id="SIPAR" value="<?php echo $_SESSION['NU_SIPAR']; 
?>
    <form action="frmCadastroUsuario.php" method="POST" name="frmCadastroUsuario" id="frmCadastroUsuario">
        <fieldset>
            <legend><strong>Cadastro Coordenador Adjunto</strong></legend>
            <ul class="ulform">
                <li><label><span>*</span>CPF:</label>
                    
                    <input type="hidden" name="PERFIL" id="PERFIL" value="16">
                    <input type="hidden" name="ST_CADASTRO" id="ST_CADASTRO" value="1">
                    <input type="hidden" name="SISTEMA" id="SISTEMA" value="1">
                    <input type="text" tabindex="<?php echo $tabIndex++; ?>" name="CPF" id="CPF" size="15" maxlength="14" value="<?php echo $rt_cpf; ?>">
                </li>
                <li><label><span>*</span>Nome:</label>
                    <input type="text" tabindex="<?php echo $tabIndex++; ?>" name="NOME" id="NOME" size="60" readonly><br>
                </li>
                <li><label><span>*</span>Sexo:</label>               
                    <select name="SEXO" tabindex="<?php echo $tabIndex++; ?>" id="SEXO">
                        <?php
                        //   $sexo = ($_POST['SEXO'] == 'M') ? 'MASCULINO' : 'FEMININO';
                        ?>
                        <option value="">Selecione o sexo</option>
                        <?php
                        foreach ($sex as $mf) {
                            echo "<option value='" . $mf['CO_SEXO'] . "'>" . $mf['DS_SEXO'] . "</option>";
                        }
                        ?>
                    </select>
                </li>
                <li><label><span>*</span>Email:</label>
                    <input type="text" tabindex="<?php echo $tabIndex++; ?>" name="EMAIL" id="EMAIL" size="60" maxlength="60" value="<?php echo $rt_email; ?>"><br>
                </li>
            </ul>
            <div id="submit">
                <input type="submit" name="CADASTRAR" value="Cadastrar">
            </div>
        </fieldset>
    </form>

<?php }else{ ?>

    <form action="frmCadastroUsuario.php" method="POST" name="frmCadastroUsuario" id="frmCadastroUsuario">
        <fieldset>
            <legend><strong>Cadastro de Usuário</strong></legend>
            <ul class="ulform">
                <li><label><span>*</span>CPF:</label>
                    <input type="text" tabindex="<?php echo $tabIndex++; ?>" name="CPF" id="CPF" size="15" maxlength="14" value="<?php echo $rt_cpf; ?>">
                </li>
                <li><label><span>*</span>Nome:</label>
                    <input type="text" tabindex="<?php echo $tabIndex++; ?>" name="NOME" id="NOME" size="60" readonly><br>
                </li>
                <li><label><span>*</span>Sexo:</label>               
                    <select name="SEXO" tabindex="<?php echo $tabIndex++; ?>" id="SEXO">
                        <?php
                        //   $sexo = ($_POST['SEXO'] == 'M') ? 'MASCULINO' : 'FEMININO';
                        ?>
                        <option value="">Selecione o sexo</option>
                        <?php
                        foreach ($sex as $mf) {
                            echo "<option value='" . $mf['CO_SEXO'] . "'>" . $mf['DS_SEXO'] . "</option>";
                        }
                        ?>
                    </select>
                </li>

                <li><label><span>*</span>Email:</label>
                    <input type="text" tabindex="<?php echo $tabIndex++; ?>" name="EMAIL" id="EMAIL" size="60" maxlength="60" value="<?php echo $rt_email; ?>"><br>
                </li>
                <li><label>N&deg; do Sipar do Projeto:</label>
                    <input type="text" tabindex="<?php echo $tabIndex++; ?>" name="SIPAR" id="SIPAR" value="<?php echo $rt_sipar; ?>"><br>
                </li>
                <li><label><span>*</span>Perfil:</label>              
                    <select name="PERFIL" tabindex="<?php echo $tabIndex++; ?>" id="PERFIL">
                        <option value="">Selecione um perfil</option>
                        <?php
                        foreach ($per as $p) {
                            echo "<option value='" . $p['CO_SEQ_PERFIL'] . "'>" . utf8_encode($p['DS_PERFIL']) . "</option>";
                        }
                        ?>
                    </select>    
                </li>

                <li><label><span>*</span>Situa&ccedil;&atilde;o do Cadastro:</label>               
                    <select name="ST_CADASTRO" tabindex="<?php echo $tabIndex++; ?>" id="ST_CADASTRO">
                        <option value="">Selecione a Situa&ccedil;&atilde;o do Usuário</option>
                        <option value="1">ATIVO</option>
                        <option value="0">NÃO ATIVO</option>
                    </select>                   
                </li>
                <li><label><span>*</span>Sistema:</label>              
                    <select name="SISTEMA" tabindex="<?php echo $tabIndex++; ?>" id="SISTEMA">
                        <option value="1">ABERTO</option>
                        <option value="0">FECHADO</option>
                    </select>                   
                </li>
            </ul>
            <div id="submit">
                <input type="submit" name="CADASTRAR" value="Cadastrar">
            </div>
        </fieldset>
    </form>
<?php
}
require '_rodape.php';
?>
<script src="script/jquery.maskedinput-1.3.min.js" type="text/javascript"></script>
<script src="script/jquery.validate.js" type="text/javascript"></script>
<script src="script/jquery.cpf.js" type="text/javascript"></script>
<script src="script/jquery.Email.js" type="text/javascript"></script>
<!-- <script src="script/jquery.pstrength-min.1.2.js" type="text/javascript"></script> -->
<script language="javascript" type="text/javascript">
    $(document).ready(function() {
        $("#SIPAR").mask("99999.999999/9999-99", {placeholder: "_"});
        $("#CPF").mask("999.999.999-99");
        $('#frmCadastroUsuario').validate({
            rules: {
                NOME: {
                    required: true
                },
                CPF: {
                    required: true,
                    cpf: 'valid'
                },
                SEXO:{
                    required: true               
                },
                EMAIL:{
                    required: true,
                    Email: 'valid'
                },
                PERFIL:{
                    required: true
                },
                ST_CADASTRO:{
                    required: true
                },
                SISTEMA:{
                    required: true
                }
            },
            messages: {
                NOME: {
                    required: 'Informe o nome'
                },
                CPF: {
                    required: 'Informe o CPF',
                    cpf:      'CPF inválido'
                },
                SEXO:{
                    required: 'Informe o sexo'               
                },
                EMAIL:{
                    required: 'Informe o email',
                    Email:    'Email inválido'
                },
                PERFIL:{
                    required: 'Selecione um perfil'
                },
                ST_CADASTRO:{
                    required: 'Selecione a situacao'
                },
                SISTEMA:{
                    required: 'Selecione situação do sistema'
                }
            }
        });
        
        //$("#SENHA").pstrength();
        
        setTimeout(function(){
            $(".ok").slideUp();
        }, 2500);
        
        setTimeout(function(){
            $(".info").slideUp();
        }, 5000);
        
        $("#CPF").blur(function(){
           if($.trim($("#CPF").val()).length == 14){
                       	$.getScript("ajaxGeral.php?cpf="+$("#CPF").val(), function(){
				if(resultadoCPF["resultado"]){
                                        $("#NOME").val(unescape(resultadoCPF["NO_PESSOA"]));
				}else{
                                        $("#NOME").val("");
					alert("CPF inexistente!");
				}
			});				
		}else{
                    alert("Preecha corretamente o CPF");
                     $("#NOME").val("");
                }
        });
    });
</script>
<style type="text/css">
    span{
        color: #ff0000;
    }
    /* AVISOS */
    .ok {
    background: #CFFFBF url(imgs/msgConfirm.png) center no-repeat;
    background-size: 20px;
    background-position: 15px 50%;
    text-align: left;
    padding: 5px 20px 5px 45px;
    border-top: 2px solid #1e8839;
    border-bottom: 2px solid #1e8839;
    }
 
    .info {
    background: #F8FAFC url(imgs/info.png) center no-repeat;
    background-size: 20px;
    background-position: 15px 50%;
    text-align: left;
    padding: 5px 20px 5px 45px;
    border-top: 2px solid #B5D4FE;
    border-bottom: 2px solid #B5D4FE;
    }
 
    .erro {
    background: #FFBFBF url(imgs/msgErro.png) center no-repeat;
    background-size: 20px;
    background-position: 15px 50%;
    text-align: left;
    padding: 5px 20px 5px 45px;
    border-top: 2px solid #FF2424;
    border-bottom: 2px solid #FF2424;
    }
    
/* AVISOS */
</style>