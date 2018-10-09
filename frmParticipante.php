<?php
  
session_start();
require '_cabecalho.php';
$Session = new Assinatura();
$Session->setValidaSession(array(10));

    $participante = new Participante;
    $par    = $participante->localizarTipoParticipante();
    $est_cv = $participante->localizarEstadoCivil();
    //$ident  = $participante->localizarTipoIdentidade();
    
    if(isset($_GET['erro']) && $_GET['erro'] != "" ){
        //__visArray($_GET['erros']);
    }
    
?>
<div id="passo01"></div> 
<fieldset>
    <legend>Cadastro de Participante - Dados Pessoais</legend>   
    <form action='frmParticipante2.php' method='POST' name='frmParticipante' id='frmParticipante'>
        <ul class="ulform">
            <li><label>N&deg; SIPAR:</label>
            <input type="text" name="NU_SIPAR" value="<?php echo $_SESSION['NU_SIPAR']; ?>" class="readonly" readonly>
            </li>
            <li><label>Tipo do participante:<span>*</span></label>
            <select name="TP_PARTICIPANTE" id="TP_PARTICIPANTE">
                <option value=""></option>
                <?php
                    foreach($par as $p){
                        echo "<option value='".$p['CO_VINCULO']."'>".utf8_encode($p['DS_VINCULO'])."</option>";  
                    }
                ?>
            </select>
            </li>        
            <li><label>CPF:<span>*</span></label>
            <input type="text" name="NU_CPF" id="NU_CPF">
            </li>    
            <li><label>Nome:<span>*</span></label>
            <input type="text" name="NO_PESSOA" id="NO_PESSOA" readonly>
            </li>
            <li><label>Data Nascimento:<span>*</span></label>
            <input type="text" name="DT_NASCIMENTO" id="DT_NASCIMENTO" >
            </li>
            <li><label>Sexo:<span>*</span></label>
            Masculino<input type="radio" name="SG_SEXO" id="SG_SEXO" value="M">
            Feminino <input type="radio" name="SG_SEXO" id="SG_SEXO" value="F">
            <div style="width: 50px; background: transparent; height: 10px;"></div>
            </li> 
            <li><label>Estado Civil:<span>*</span></label>
            <select name="ESTADO_CIVIL" id="ESTADO_CIVIL">
                <option value=''></option>
                <?php
                    foreach($est_cv as $e){
                        echo "<option value='".$e['CO_ESTADO_CIVIL']."'>".utf8_encode($e['DS_ESTADO_CIVIL'])."</option>";  
                    }
                ?>
            </select>
            </li>           
            <li><label>Nome do Conjuge:</label>
            <input type="text" name="NO_CONJUGE" id="NO_CONJUGE">
            </li>
            <li><label>Nome da Mãe:<span>*</span></label>
            <input type="text" name="NO_MAE" id="NO_MAE">
            </li>
            <li><label>Nome do Pai:</label>
            <input type="text" name="NO_PAI" id="NO_PAI">
            </li>
            <li><label>RG:<span>*</span></label>
            <input type="text" name="NU_RG" id="NU_RG" maxlength="8">
            </li>    
            </ul>
            <!-- HIDDENS -->
            <input type="hidden" name="CO_ALUNO"            id="CO_ALUNO"           value="">
            <input type="hidden" name="NU_CEP"              id="NU_CEP"             value="">
            <input type="hidden" name="NO_LOGRADOURO"       id="NO_LOGRADOURO"      value="">
            <input type="hidden" name="NU_LOGRADOURO"       id="NU_LOGRADOURO"      value="">
            <input type="hidden" name="DS_COMPLEMENTO"      id="DS_COMPLEMENTO"     value="">
            <input type="hidden" name="NO_BAIRRO"           id="NO_BAIRRO"          value="">
            <input type="hidden" name="SG_UF"               id="SG_UF"              value="">
            <input type="hidden" name="NO_MUNICIPIO"        id="NO_MUNICIPIO"       value="">
            <input type="hidden" name="CO_MUNICIPIO_IBGE"   id="CO_MUNICIPIO_IBGE"  value="">
            <!-- HIDDENS -->
        <div id="submit">    
            <input type="submit" name="CONTINUAR" id="CONTINUAR" value="Continuar >>">
        </div>
</form>
</fieldset>

<?php
    require "_rodape.php";
?>
<script src="script/jquery.maskedinput-1.3.min.js" type="text/javascript"></script>
<script src="script/jquery.validate.js" type="text/javascript"></script>
<script src="script/jquery.cpf.js" type="text/javascript"></script>
<script src="script/jquery.Email.js" type="text/javascript"></script>
<script src="script/jquery.dateBR.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
       $(document).ready(function(){      
       $("#NU_CPF").mask("999.999.999-99");
       $("#frmParticipante").validate({
         rules:{
             TP_PARTICIPANTE:{
                 required: true
             },
             NU_CPF:{
                 required: true,
                 cpf: 'valid'
             },
             NO_PESSOA:{
                 required: true
             },
             DT_NASCIMENTO:{
                 required: true
             },
             SG_SEXO:{
                 required: true
             },
             ESTADO_CIVIL:{
                 required: true
             },
             NO_MAE:{
                 required: true
             },
             NU_RG:{
                 required: true,
                 number: true
             }
         },
         messages:{
             TP_PARTICIPANTE:{
                 required: 'Selecione o tipo do participante'
             },
             NU_CPF:{
                 required: 'Informe o CPF',
                 cpf: 'Informe um CPF válido'
             },
             NO_PESSOA:{
                 required: 'Informe o nome do participante'
             },
             DT_NASCIMENTO:{
                 required: 'Informe a data de nascimento'
             },
             SG_SEXO:{
                 required: 'Informe o sexo'
             },
             ESTADO_CIVIL:{
                 required: 'Informe o estado civil'
             },
             NO_MAE:{
                 required: 'Informe o nome da m&atilde;e'
             },
             NU_RG:{
                 required: 'Informe o RG',
                 number: 'Apenas n&uacute;meros'
             }
         }
       });
       
       $('#SG_UF_NATURAL').change(function(){
        if($('#SG_UF_NATURAL').val() != '' ){
            $('#CO_MUNICIPIO_NATURAL').removeAttr('disabled');
            $('#CO_MUNICIPIO_NATURAL').load('ajaxGeral.php?uf='+$('#SG_UF_NATURAL').val());       
        }else{
            $('#CO_MUNICIPIO_NATURAL').attr('disabled', 'disabled'); 
            $('#CO_MUNICIPIO_NATURAL').load('');
        }
    });
       
       $("#NU_CPF").blur(function(e){
		if($.trim($("#NU_CPF").val()).length == 14){
                       	$.getScript("ajaxGeral.php?cpf="+$("#NU_CPF").val(), function(){
				if(resultadoCPF["resultado"]){
                                        if(unescape(resultadoCPF["NO_LOGRADOURO"]) == 'null'){ resultadoCPF["NO_LOGRADOURO"] = '' }
                                        if(unescape(resultadoCPF["NU_LOGRADOURO"]) == 'null'){ resultadoCPF["NU_LOGRADOURO"] = '' }
                                        if(unescape(resultadoCPF["DS_COMPLEMENTO"]) == 'null'){ resultadoCPF["DS_COMPLEMENTO"] = '' }
                                        if(unescape(resultadoCPF["NO_BAIRRO"]) == 'null'){ resultadoCPF["NO_BAIRRO"] = '' }
                                        if(unescape(resultadoCPF["CO_ALUNO"]) == 'null'){ resultadoCPF["CO_SEQ_ALUNO"] = '' }
                                        $("#NO_PESSOA").val(unescape(resultadoCPF["NO_PESSOA"]));
                                        $("#DT_NASCIMENTO").val(unescape(resultadoCPF["DT_NASCIMENTO"]));
                                        $("#SG_SEXO").val(unescape(resultadoCPF["SG_SEXO"]));
                                        $("#NO_MAE").val(unescape(resultadoCPF["NO_MAE"]));
                                        $("#NU_CEP").val(unescape(resultadoCPF["NU_CEP"]));
                                        $("#NO_LOGRADOURO").val(resultadoCPF["NO_LOGRADOURO"]);
                                        $("#NU_LOGRADOURO").val(resultadoCPF["NU_LOGRADOURO"]);
                                        $("#DS_COMPLEMENTO").val(resultadoCPF["DS_COMPLEMENTO"]);
                                        $("#NO_BAIRRO").val(resultadoCPF["NO_BAIRRO"]);
                                        $("#SG_UF").val(unescape(resultadoCPF["SG_UF"]));
                                        $("#NO_MUNICIPIO").val(unescape(resultadoCPF["NO_MUNICIPIO"]));
                                        $("#CO_MUNICIPIO_IBGE").val(unescape(resultadoCPF["CO_MUNICIPIO_IBGE"]));
                                        $("#CO_ALUNO").val(resultadoCPF["CO_SEQ_ALUNO"]);
				}else{
                                        $("#NO_PESSOA").val('');
                                        $("#DT_NASCIMENTO").val('');
                                        $("#SG_SEXO").val('');
                                        $("#NO_MAE").val('');
                                        $("#NU_CEP").val('');
                                        $("#NO_LOGRADOURO").val('');
                                        $("#NU_LOGRADOURO").val('');
                                        $("#DS_COMPLEMENTO").val('');
                                        $("#NO_BAIRRO").val('');
                                        $("#SG_UF").val('');
                                        $("#NO_MUNICIPIO").val('');
                                        $("#CO_MUNICIPIO_IBGE").val('');
                                        $("#CO_ALUNO").val('');
					alert("CPF inexistente ou n&atilde;o regularizado.");
				}
			});				
		}else{
                    $("#NO_PESSOA").val('');
                    $("#DT_NASCIMENTO").val('');
                    $("#SG_SEXO").val('');
                    $("#NO_MAE").val('');
                    $("#NU_CEP").val('');
                    $("#NO_LOGRADOURO").val('');
                    $("#NU_LOGRADOURO").val('');
                    $("#DS_COMPLEMENTO").val('');
                    $("#NO_BAIRRO").val('');
                    $("#SG_UF").val('');
                    $("#NO_MUNICIPIO").val('');
                    $("#CO_MUNICIPIO_IBGE").val('');
                    $("#CO_ALUNO").val('');
                }		
	})
    });
</script>
<style type="text/css">
    span{
        color: #ff0000;
    }
    #passo01{ height: 40px; background: url(imgs/passo1.png); width: 699px; border: #ccc 1px solid; }
</style>
