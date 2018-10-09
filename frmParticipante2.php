<?php
  
session_start();
require '_cabecalho.php';
$Session = new Assinatura();
$Session->setValidaSession(array(10));

    $participante = new Participante;
    
    $uf     = new DadosUf;
    $ufs    = $uf->carregarUf();
    
    if(isset($_POST['CONTINUAR']) && $_POST['CONTINUAR']){
        
        $dados = array(
            'NU_SIPAR'          => $_POST['NU_SIPAR'],
            'TP_PARTICIPANTE'   => $_POST['TP_PARTICIPANTE'],
            'NU_CPF'            => $_POST['NU_CPF'],
            'NO_PESSOA'         => $_POST['NO_PESSOA'],
            'DT_NASCIMENTO'     => $_POST['DT_NASCIMENTO'],
            'SG_SEXO'           => $_POST['SG_SEXO'],
            'ESTADO_CIVIL'      => $_POST['ESTADO_CIVIL'],
            'NO_CONJUGE'        => $_POST['NO_CONJUGE'],
            'NO_MAE'            => $_POST['NO_MAE'],
            'NO_PAI'            => $_POST['NO_PAI'],
            'NU_RG'             => $_POST['NU_RG'],
            'CO_ALUNO'          => $_POST['CO_ALUNO'],
            'NU_CEP'            => $_POST['NU_CEP'],
            'NO_LOGRADOURO'     => $_POST['NO_LOGRADOURO'],
            'NU_LOGRADOURO'     => $_POST['NU_LOGRADOURO'],
            'DS_COMPLEMENTO'    => $_POST['DS_COMPLEMENTO'],
            'NO_BAIRRO'         => $_POST['NO_BAIRRO'],
            'SG_UF'             => $_POST['SG_UF'],
            'NO_MUNICIPIO'      => $_POST['NO_MUNICIPIO'],
            'CO_MUNICIPIO_IBGE' => $_POST['CO_MUNICIPIO_IBGE']
        );
        
                
        $doc = new DadosCPF;
                        
        $erros = null;
        
        $cpf = str_pad(ereg_replace('[^0-9]', '', $dados['NU_CPF']), 11, '0', STR_PAD_LEFT);
                
        $docs = $doc->localizarCPF($cpf);
        $participante->setNu_cpf($cpf);
        /*
        if($docs == false){
            $erros[] = 'CPF irregular ou inexistente';
        }
        if($docs['DT_NASCIMENTO'] != $dados['DT_NASCIMENTO']){
            $erros[] = 'A data de nascimento n&atilde;o confere';
        }/*
        if($participante->localizarParticipante()){
            $erros[] = 'CPF j&aacute; cadastrado';
        }
                        
        if(!isset($erros)){
            
        }else{
            header('Location: frmParticipante.php?erro=true&erros='.$erros);
        }
        */
        
        //__visArray($dados);
    }
    
    
    
?>
<div id="passo02"></div> 
<fieldset>
    <legend>Cadastro de Participante - Dados de Contato</legend>   
    <form action='frmParticipante3.php' method='POST' name='frmParticipante' id='frmParticipante'>
        <ul class="ulform">
            <li><label>CEP:<span>*</span></label>
            <input type="text" name="NU_CEP" id="NU_CEP" value="<?php echo $dados['NU_CEP']; ?>">
            </li>
            <li><label>Logradouro:<span>*</span></label>
            <input type="text" name="NO_LOGRADOURO" id="NO_LOGRADOURO" value="<?php echo $dados['NO_LOGRADOURO']; ?>">
            </li>
            <li><label>N&ordm;:</label>
            <input type="text" name="NU_LOGRADOURO" id="NU_LOGRADOURO" value="<?php echo $dados['NU_LOGRADOURO']; ?>">
            </li>
            <li><label>Complemento:</label>
            <input type="text" name="DS_COMPLEMENTO" id="DS_COMPLEMENTO" value="<?php echo $dados['DS_COMPLEMENTO']; ?>">
            </li>
            <li><label>Bairro:<span>*</span></label>
            <input type="text" name="NO_BAIRRO" id="NO_BAIRRO" value="<?php echo $dados['NO_BAIRRO']; ?>">
            </li>
            <li><label>UF:<span>*</span></label>
                <select name="SG_UF" id="SG_UF">
                    <option value="<?php echo $dados['SG_UF']; ?>"><?php echo $dados['SG_UF']; ?></option>
                    <?php
                        foreach($ufs as $u){
                            echo '<option value="'.$u['SG_UF'].'">'.$u['SG_UF'].'</option>';
                        }
                    ?>
                </select>
            </li>
            <li><label>Munic&iacute;pio:<span>*</span></label>
                <select name="NO_MUNICIPIO" id="NO_MUNICIPIO">
                    <option value="<?php echo $dados['CO_MUNICIPIO_IBGE']; ?>"><?php echo $dados['NO_MUNICIPIO']; ?></option>
                    <?php
                        if($dados['NO_MUNICIPIO'] != 'null'){
                            $municipios = new DadosMunicipio;
                            $municipios->setUf($u['SG_UF']);
                            $municipio  = $municipios->carregarMunicipios();
                            foreach($municipio as $m){
                                echo '<option value="'.$m['CO_MUNICIPIO_IBGE'].'">'.$m['NO_MUNICIPIO'].'</option>';
                            }
                        }
                    ?>
                </select>
            </li>
            <li><label>Telefone Comercial:<span>*</span></label>
            <input type="text" name="DDD_NU_COMERCIAL" id="DDD_NU_COMERCIAL" class="ddd" size="3">
            <input type="text" name="NU_COMERCIAL" id="NU_COMERCIAL" class="tel">
            </li>
            <li><label>Telefone Celular:<span>*</span></label>
            <input type="text" name="DDD_NU_CELULAR" id="DDD_NU_CELULAR" class="ddd" size="3">
            <input type="text" name="NU_CELULAR" id="NU_CELULAR" class="tel">
            </li>
            <li><label>Telefone Residencial:</label>
            <input type="text" name="DDD_NU_RESIDENCIAL" class="ddd" size="3">
            <input type="text" name="NU_RESIDENCIAL" id="NU_RESIDENCIAL" class="tel">
            </li>
            <li><label>Email:<span>*</span></label>
            <input type="text" name="DS_EMAIL" id="DS_EMAIL">
            </li>   
        </ul>
        <!-- HIDDENS -->
        <input type="hidden" name="TP_PARTICIPANTE"     id="TP_PARTICIPANTE"    value="<?php echo $dados['TP_PARTICIPANTE']; ?>">
        <input type="hidden" name="NU_CPF"              id="NU_CPF"             value="<?php echo $cpf; ?>">
        <input type="hidden" name="NO_PESSOA"           id="NO_PESSOA"          value="<?php echo $dados['NO_PESSOA']; ?>">
        <input type="hidden" name="DT_NASCIMENTO"       id="DT_NASCIMENTO"      value="<?php echo $dados['DT_NASCIMENTO']; ?>">
        <input type="hidden" name="SG_SEXO"             id="SG_SEXO"            value="<?php echo $dados['SG_SEXO']; ?>">
        <input type="hidden" name="ESTADO_CIVIL"        id="ESTADO_CIVIL"       value="<?php echo $dados['ESTADO_CIVIL']; ?>">
        <input type="hidden" name="NO_CONJUGE"          id="NO_CONJUGE"         value="<?php echo $dados['NO_CONJUGE']; ?>">
        <input type="hidden" name="NO_MAE"              id="NO_MAE"             value="<?php echo $dados['NO_MAE']; ?>">
        <input type="hidden" name="NO_PAI"              id="NO_PAI"             value="<?php echo $dados['NO_PAI']; ?>">
        <input type="hidden" name="NU_RG"               id="NU_RG"              value="<?php echo $dados['NU_RG']; ?>">
        <input type="hidden" name="CO_ALUNO"            id="CO_ALUNO"           value="<?php echo $dados['CO_ALUNO']; ?>">
        <!-- HIDDENS -->
        <div id="submit">
            <input type="button" name="VOLTAR" id="VOLTAR" value="<< Voltar">
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
       $("#NU_CEP").mask("999.999-99");
       $("#NU_COMERCIAL").mask("9999-9999");
       $("#NU_CELULAR").mask("9999-9999");
       $("#NU_RESIDENCIAL").mask("9999-9999");
       $('#SG_UF').change(function(){
        if($('#SG_UF').val() != '' ){
            $('#NO_MUNICIPIO').removeAttr('disabled');
            $('#NO_MUNICIPIO').load('ajaxGeral.php?uf='+$('#SG_UF').val());       
        }else{
            $('#NO_MUNICIPIO').attr('disabled', 'disabled'); 
            $('#NO_MUNICIPIO').load('');
        }
    });
    
    
    $("#VOLTAR").click(function(){
       history.back(); 
    }); 
    
       $("#frmParticipante").validate({
         rules:{
             NU_CEP:{
                 required: true
             },
             NO_LOGRADOURO:{
                 required: true
             },
             NU_BAIRRO:{
                 required: true
             },
             SG_UF:{
                 required: true
             },
             NO_MUNICIPIO:{
                 required: true
             },
             DDD_NU_COMERCIAL:{
                 required: true,
                 number: true
             },
             NU_COMERCIAL:{
                 required: true
             },
             DDD_NU_CELULAR:{
                 required: true,
                 number: true
             },
             NU_CELULAR:{
                 required: true
             },
             DDD_NU_RESIDENCIAL:{
                 number: true
             },
             DS_EMAIL:{
                 required: true,
                 Email: 'valid'
             }
         },
         messages:{
             NU_CEP:{
                 required: 'Informe seu CEP'
             },
             NO_LOGRADOURO:{
                 required: 'Informe o Logradouro'
             },
             NU_BAIRRO:{
                 required: 'Informe o bairro'
             },
             SG_UF:{
                 required: 'Selecione a uf'
             },
             NO_MUNICIPIO:{
                 required: 'Selecione o munic&iacute;pio'
             },
             DDD_NU_COMERCIAL:{
                 required: 'Informe o ddd',
                 number: 'Apenas número'
             },
             NU_COMERCIAL:{
                 required: 'Informe seu telefone'
             },
             DDD_NU_CELULAR:{
                 required: 'Informe o ddd',
                 number: 'Apenas número'
             },
             NU_CELULAR:{
                 required: 'Informe seu telefone'
             },
             DDD_NU_RESIDENCIAL:{
                 number: 'Apenas número'
             },
             DS_EMAIL:{
                 required: 'Informe email para contato',
                 Email: 'Email inv&aacute;lido'
             }
         }
       });
    });
</script>
<style type="text/css">
    span{
        color: #ff0000;
    }
    #passo02{ height: 40px; background: url(imgs/passo2.png); width: 699px; border: #ccc 1px solid; }
</style>
