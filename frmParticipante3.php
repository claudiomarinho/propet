<?php
  
session_start();
require '_cabecalho.php';
$Session = new Assinatura();
$Session->setValidaSession(array(10));

    $participante = new Participante;
            
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
            'CO_ALUNO'          => $_POST['CO_ALUNO'],
            'NU_RG'             => $_POST['NU_RG'],
            'NU_CEP'            => str_pad(ereg_replace('[^0-9]', '', $_POST['NU_CEP']), 8, '0', STR_PAD_LEFT),
            'NO_LOGRADOURO'     => $_POST['NO_LOGRADOURO'],
            'NU_LOGRADOURO'     => $_POST['NU_LOGRADOURO'],
            'DS_COMPLEMENTO'    => $_POST['DS_COMPLEMENTO'],
            'NO_BAIRRO'         => $_POST['NO_BAIRRO'],
            'SG_UF'             => $_POST['SG_UF'],
            'CO_MUNICIPIO_IBGE' => $_POST['NO_MUNICIPIO'],
            'DDD_NU_COMERCIAL'  => $_POST['DDD_NU_COMERCIAL'],
            'NU_COMERCIAL'      => str_pad(ereg_replace('[^0-9]', '', $_POST['NU_COMERCIAL']), 8, '0', STR_PAD_LEFT),
            'DDD_NU_CELULAR'    => $_POST['DDD_NU_CELULAR'],
            'NU_CELULAR'        => str_pad(ereg_replace('[^0-9]', '', $_POST['NU_CELULAR']), 8, '0', STR_PAD_LEFT),
            'DDD_NU_RESIDENCIAL'=> $_POST['DDD_NU_RESIDENCIAL'],
            'NU_RESIDENCIAL'    => str_pad(ereg_replace('[^0-9]', '', $_POST['NU_RESIDENCIAL']), 8, '0', STR_PAD_LEFT),
            'DS_EMAIL'          => $_POST['DS_EMAIL']
        );        
               
        $agencias   = $participante->localizarAgenciaBB();
        $catprofs   = $participante->localizarTipoProfissional();
        $titulacao  = $participante->localizarTitulacao();
        $qtch       = $participante->localizarCargaHoraria();
        $cursos     = $participante->localizarCursos();
        $anos       = $participante->localizarAno();
        $semestres  = $participante->localizarSemestres();
        //$prouni     = $participante->localizarProUni();
        
        switch($dados['TP_PARTICIPANTE']){
           case 10:{
               //COORDENADOR
               $form = '<li><label>Agencia Bancaria</label>';
               $form.= '<select name="AGENCIA_BB">';
               $form.= '<option value=""></option>';
               foreach($agencias as $agencia){
                   $form.= '<option value="'.$agencia['CO_AGENCIA'].'">'.$agencia['CO_AGENCIA'].'</option>';
               }
               $form.= '</select> Apenas Banco do Brasil</li>';
               $form.= '<li><label>Categoria Profissional</label>';
               $form.= '<select name="CAT_PROFISSIONAL">';
               $form.= '<option value=""></option>';
               foreach($catprofs as $cat){
                   $form.= '<option value="'.$cat['CO_CBO_OCUPACAO'].'">'.utf8_encode($cat['DS_CBO_OCUPACAO']).'</option>';
               }
               $form.= '</select></li>';
               $form.= '<li><label>Titula&ccedil;&atilde;o</label>';
               $form.= '<select name="TITULACAO">';
               $form.= '<option value=""></option>';
               foreach($titulacao as $titu){
                   $form.= '<option value="'.$titu['CO_ESCOLARIDADE'].'">'.utf8_encode($titu['DS_ESCOLARIDADE']).'</option>';
               }
               $form.= '</select></li>';
               $form.= '<li><label>Institui&ccedil;&atilde;o a qual est&aacute; vinculado</label>';
               $form.= '<input type="text" name="DS_INSTITUICAO">';
               $form.= '</li>';
               $form.= '<li><label>Carga Hor&aacute;ria</label>';
               $form.= '<select name="QT_CH">';
               $form.= '<option value=""></option>';
               foreach($qtch as $ch){
                   $form.= '<option value="'.$ch['CO_SEQ_TIPO_DURACAO'].'">'.$ch['DS_TIPO_DURACAO'].'</option>';
               }
               $form.= '</select></li>';
               break;
           }
           case 11:{
               //TUTOR
               $form = '<li><label>Agencia Bancaria</label>';
               $form.= '<select name="AGENCIA_BB">';
               $form.= '<option value=""></option>';
               foreach($agencias as $agencia){
                   $form.= '<option value="'.$agencia['CO_AGENCIA'].'">'.$agencia['CO_AGENCIA'].'</option>';
               }
               $form.= '</select> Apenas Banco do Brasil</li>';
               $form.= '<li><label>Categoria Profissional</label>';
               $form.= '<select name="CAT_PROFISSIONAL">';
               $form.= '<option value=""></option>';
               foreach($catprofs as $cat){
                   $form.= '<option value="'.$cat['CO_CBO_OCUPACAO'].'">'.utf8_encode($cat['DS_CBO_OCUPACAO']).'</option>';
               }
               $form.= '</select></li>';
               $form.= '<li><label>Titula&ccedil;&atilde;o</label>';
               $form.= '<select name="TITULACAO">';
               $form.= '<option value=""></option>';
               foreach($titulacao as $titu){
                   $form.= '<option value="'.$titu['CO_ESCOLARIDADE'].'">'.utf8_encode($titu['DS_ESCOLARIDADE']).'</option>';
               }
               $form.= '</select></li>';
               $form.= '<li><label>Faculdade a qual est&aacute; vinculada</label>';
               $form.= '<input type="text" name="FACULDADE">';
               $form.= '</li>';
               $form.= '<li><label>&Aacute;rea de concentra&ccedil;&atilde;o</label>';
               $form.= '<input type="text" name="AREA_CONCENTRACAO">';
               $form.= '</li>';
               $form.= '<li><label>Matr&iacute;cula da I.E.S</label>';
               $form.= '<input type="text" name="MATRICULA_IES">';
               $form.= '</li>';
               $form.= '<li><label>Carga Hor&aacute;ria</label>';
               $form.= '<select name="QT_CH">';
               $form.= '<option value=""></option>';
               foreach($qtch as $ch){
                   $form.= '<option value="'.$ch['CO_SEQ_TIPO_DURACAO'].'">'.$ch['DS_TIPO_DURACAO'].'</option>';
               }
               $form.= '</select></li>';
               break;
           }
           case 12:{
               //PRECEPTOR
               $form = '<li><label>Agencia Bancaria</label>';
               $form.= '<select name="AGENCIA_BB">';
               $form.= '<option value=""></option>';
               foreach($agencias as $agencia){
                   $form.= '<option value="'.$agencia['CO_AGENCIA'].'">'.$agencia['CO_AGENCIA'].'</option>';
               }
               $form.= '</select> Apenas Banco do Brasil</li>';
               $form.= '<li><label>Categoria Profissional</label>';
               $form.= '<select name="CAT_PROFISSIONAL">';
               $form.= '<option value=""></option>';
               foreach($catprofs as $cat){
                   $form.= '<option value="'.$cat['CO_CBO_OCUPACAO'].'">'.utf8_encode($cat['DS_CBO_OCUPACAO']).'</option>';
               }
               $form.= '</select></li>';
               $form.= '<li><label>N&deg; CNES</label>';
               $form.= '<input type="text" name="NU_CNES">';
               $form.= '</li>';
               break;
           }
           case 13:{
               //ESTUDANTE BOLSISTA 
               $form = '<li><label>Agencia Bancaria</label>';
               $form.= '<select name="AGENCIA_BB">';
               $form.= '<option value=""></option>';
               foreach($agencias as $agencia){
                   $form.= '<option value="'.$agencia['CO_AGENCIA'].'">'.$agencia['CO_AGENCIA'].'</option>';
               }
               $form.= '</select> Apenas Banco do Brasil</li>';
               $form.= '<li><label>Curso de Gradua&ccedil;&atilde;o</label>';
               $form.= '<select name="CURSO_GRADUACAO">';
               $form.= '<option value=""></option>';
               foreach($cursos as $curso){
                   $form.= '<option value="'.$curso['CO_SEQ_CURSO'].'">'.$curso['DS_CURSO'].'</option>';
               }
               $form.= '</select></li>';
               $form.= '<li><label>Ano Ingresso</label>';
               $form.= '<select name="NU_ANO">';
               $form.= '<option value=""></option>';
               foreach($anos as $ano){
                   $form.= '<option value="'.$ano['NU_ANO'].'">'.$ano['NU_ANO'].'</option>';
               }
               $form.= '</select></li>';
               $form.= '<li><label>Semestre que est&aacute;</label>';
               $form.= '<select name="DS_SEMESTRE">';
               $form.= '<option value=""></option>';
               foreach($semestres as $semestre){
                   $form.= '<option value="'.$semestre['CO_SEQ_SEGMENTO'].'">'.$semestre['DS_SEGMENTO'].'</option>';
               }
               $form.= '</select></li>';
               break;
           }
           case 14:{
               //ALUNO NÃO BOLSISTA
               $form.= '<li><label>Curso de Gradua&ccedil;&atilde;o</label>';
               $form.= '<select name="CURSO_GRADUACAO">';
               $form.= '<option value=""></option>';
               foreach($cursos as $curso){
                   $form.= '<option value="'.$curso['CO_SEQ_CURSO'].'">'.$curso['DS_CURSO'].'</option>';
               }
               $form.= '</select></li>';
               $form.= '<li><label>Ano Ingresso</label>';
               $form.= '<select name="NU_ANO">';
               $form.= '<option value=""></option>';
               foreach($anos as $ano){
                   $form.= '<option value="'.$ano['NU_ANO'].'">'.$ano['NU_ANO'].'</option>';
               }
               $form.= '</select></li>';
               $form.= '<li><label>Semestre que est&aacute;</label>';
               $form.= '<select name="DS_SEMESTRE">';
               $form.= '<option value=""></option>';
               foreach($semestres as $semestre){
                   $form.= '<option value="'.$semestre['CO_SEQ_SEGMENTO'].'">'.$semestre['DS_SEGMENTO'].'</option>';
               }
               $form.= '</select></li>';
               break;
           }
       }
        
        
        $erros = null;
                        
        //__visArray($dados);                        
        if(!isset($erros)){
            
        }else{
            header('Location: frmParticipante.php?erro=true&erros='.$erros);
        }
        
        
        //__visArray($dados);
    }
    
    $passos = 'passo03';
    
    if(isset($_POST['CONCLUIR']) && $_POST['CONCLUIR'] != ""){
        //__visArray($_POST);
        $participante->setNo_aluno($_POST['NO_PESSOA']);
        $participante->setDt_nascimento($_POST['DT_NASCIMENTO']);
        $participante->setCo_sexo($_POST['SG_SEXO']);
        $participante->setNo_conjuge($_POST['NO_CONJUGE']);
        $participante->setNo_mae($_POST['NO_MAE']);
        $participante->setNo_pai($_POST['NO_PAI']);
        $participante->setNu_cpf($_POST['NU_CPF']);
        $participante->setNu_rg($_POST['NU_RG']);
        $participante->setDs_endereco($_POST['NO_LOGRADOURO']);
        $participante->setNu_endereco($_POST['NU_LOGRADOURO']);
        $participante->setDs_complemento($_POST['DS_COMPLEMENTO']);
        $participante->setDs_bairro($_POST['NO_BAIRRO']);
        $participante->setNu_cep($_POST['NU_CEP']);
        $participante->setNu_telefone1($_POST['NU_COMERCIAL']);
        $participante->setNu_telefone2($_POST['NU_RESIDENCIAL']);
        $participante->setNu_celular($_POST['NU_CELULAR']);
        $participante->setDs_email($_POST['DS_EMAIL']);
        $participante->setNu_ordem($_POST['AGENCIA_BB']);
        $participante->setCo_vinculo($_POST['TP_PARTICIPANTE']);
        $participante->setCo_municipio_ibge($_POST['CO_MUNICIPIO_IBGE']);
        $participante->setNu_ddd($_POST['DDD_NU_COMERCIAL']);
        $participante->setNu_ddd_celular($_POST['DDD_NU_CELULAR']);
        $participante->setNu_ddd2($_POST['DDD_NU_RESIDENCIAL']);
        $participante->setCo_estado_civil($_POST['ESTADO_CIVIL']);
        $participante->setNu_ies($_POST['MATRICULA_IES']);
        $participante->setCo_tipo_duracao($_POST['QT_CH']);
        $participante->setCo_escolaridade($_POST['TITULACAO']);
        $participante->setCo_curso($_POST['CURSO_GRADUACAO']);
        $participante->setCo_segmento($_POST['DS_SEMESTRE']);
        $participante->setNu_ano($_POST['NU_ANO']);
        $participante->setCo_ocupacao($_POST['CAT_PROFISSIONAL']); //PROFISSIONAL
        $participante->setCo_tipo_gestao(6); //PROPET
        $participante->setNu_serie($_SESSION['NU_SIPAR']);
        $participante->setNu_cnes($_POST['NU_CNES']);
        $participante->setCo_aluno($_POST['CO_ALUNO']);
        
        if(isset($_POST['CO_ALUNO']) && $_POST['CO_ALUNO'] != ''){
            if($participante->atualizarParticipante()){
                $gravou = true;
                $passos = 'passo04';                
            }else{
                $gravou = false;
            }
        }else{
            if($participante->incluirParticipante()){
                $gravou = true;
                $passos = 'passo04';
            }else{
                $gravou = false;
            }
        }
    }
    
?>
<div id="<?php echo $passos; ?>"></div> 
<fieldset>
    <?php
        if($gravou){
    ?>
    <legend>Cadastro de Participante - Cadastro Concluido</legend>
    <div id="concluido"><img src="imgs/msgConfirm.png" height="30">Cadastro concluido com Sucesso</div>
    </fieldset>
    <?php
        require '_rodape.php';
        exit();
        }
    ?>
    <legend>Cadastro de Participante - Dados de Contato</legend>   
    <form action='frmParticipante3.php' method='POST' name='frmParticipante' id='frmParticipante'>
        <ul class="ulform">
            <?php
                echo $form;
            ?>
        </ul>
        <!-- HIDDENS -->
        <input type="hidden" name="TP_PARTICIPANTE"     id="TP_PARTICIPANTE"    value="<?php echo $dados['TP_PARTICIPANTE']; ?>">
        <input type="hidden" name="NU_CPF"              id="NU_CPF"             value="<?php echo $dados['NU_CPF']; ?>">
        <input type="hidden" name="NO_PESSOA"           id="NO_PESSOA"          value="<?php echo $dados['NO_PESSOA']; ?>">
        <input type="hidden" name="DT_NASCIMENTO"       id="DT_NASCIMENTO"      value="<?php echo $dados['DT_NASCIMENTO']; ?>">
        <input type="hidden" name="SG_SEXO"             id="SG_SEXO"            value="<?php echo $dados['SG_SEXO']; ?>">
        <input type="hidden" name="ESTADO_CIVIL"        id="ESTADO_CIVIL"       value="<?php echo $dados['ESTADO_CIVIL']; ?>">
        <input type="hidden" name="NO_CONJUGE"          id="NO_CONJUGE"         value="<?php echo $dados['NO_CONJUGE']; ?>">
        <input type="hidden" name="NO_MAE"              id="NO_MAE"             value="<?php echo $dados['NO_MAE']; ?>">
        <input type="hidden" name="NO_PAI"              id="NO_PAI"             value="<?php echo $dados['NO_PAI']; ?>">
        <input type="hidden" name="NU_RG"               id="NU_RG"              value="<?php echo $dados['NU_RG']; ?>">
        <!-- -->
        <input type="hidden" name="CO_ALUNO"            id="CO_ALUNO"           value="<?php echo $dados['CO_ALUNO']; ?>">
        <input type="hidden" name="NU_CEP"              id="NU_CEP"             value="<?php echo $dados['NU_CEP']; ?>">
        <input type="hidden" name="NO_LOGRADOURO"       id="NO_LOGRADOURO"      value="<?php echo $dados['NO_LOGRADOURO']; ?>">
        <input type="hidden" name="NU_LOGRADOURO"       id="NU_LOGRADOURO"      value="<?php echo $dados['NU_LOGRADOURO']; ?>">
        <input type="hidden" name="DS_COMPLEMENTO"      id="DS_COMPLEMENTO"     value="<?php echo $dados['DS_COMPLEMENTO']; ?>">
        <input type="hidden" name="NO_BAIRRO"           id="SG_SEXO"            value="<?php echo $dados['NO_BAIRRO']; ?>">
        <input type="hidden" name="SG_UF"               id="SG_UF"              value="<?php echo $dados['SG_UF']; ?>">
        <input type="hidden" name="CO_MUNICIPIO_IBGE"   id="CO_MUNICIPIO_IBGE"  value="<?php echo $dados['CO_MUNICIPIO_IBGE']; ?>">
        <input type="hidden" name="DDD_NU_COMERCIAL"    id="DDD_NU_COMERCIAL"   value="<?php echo $dados['DDD_NU_COMERCIAL']; ?>">
        <input type="hidden" name="NU_COMERCIAL"        id="NU_COMERCIAL"       value="<?php echo $dados['NU_COMERCIAL']; ?>">
        <input type="hidden" name="DDD_NU_CELULAR"      id="DDD_NU_CELULAR"     value="<?php echo $dados['DDD_NU_CELULAR']; ?>">
        <input type="hidden" name="NU_CELULAR"          id="NU_CELULAR"         value="<?php echo $dados['NU_CELULAR']; ?>">
        <input type="hidden" name="DDD_NU_RESIDENCIAL"  id="DDD_NU_RESIDENCIAL" value="<?php echo $dados['DDD_NU_RESIDENCIAL']; ?>">
        <input type="hidden" name="NU_RESIDENCIAL"      id="NU_RESIDENCIAL"     value="<?php echo $dados['NU_RESIDENCIAL']; ?>">
        <input type="hidden" name="DS_EMAIL"            id="DS_EMAIL"           value="<?php echo $dados['DS_EMAIL']; ?>">
        <!-- HIDDENS -->
        <div id="submit">
            <input type="button" name="VOLTAR" id="VOLTAR" value="<< Voltar">
            <input type="submit" name="CONCLUIR" id="CONCLUIR" value="Concluir">
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
    
    $("#VOLTAR").click(function(){
       history.back(); 
    }); 
    
       $("#frmParticipante").validate({
         rules:{
             AGENCIA_BB:{
                 required: true
             },
             CURSO_GRADUACAO:{
                 required: true
             },
             CAT_PROFISSIONAL:{
                 required: true
             },
             TITULACAO:{
                 required: true
             },
             DS_INSTITUICAO:{
                 required: true
             },
             QT_CH:{
                 required: true
             },
             FACULDADE:{
                 required: true
             },
             AREA_CONCENTRACAO:{
                 required: true
             },
             MATRICULA_IES:{
                 required: true
             },
             NU_CNES:{
                 required: true
             },
             NU_ANO:{
                 required: true
             },
             DS_SEMESTRE:{
                 required: true
             },
             PROUNI:{
                 required: true
             }
         },
         messages:{
             AGENCIA_BB:{
                 required: 'Selecione a agencia'
             },
             CURSO_GRADUACAO:{
                 required: 'Selecione o curso de gradua&ccedil;&atilde;o'
             },
             CAT_PROFISSIONAL:{
                 required: 'Selecione a categoria profissional'
             },
             TITULACAO:{
                 required: 'Informe a titula&ccedil;&atilde;o'
             },
             DS_INSTITUICAO:{
                 required: 'Informe o nome da Institui&ccedil;&atilde;o'
             },
             QT_CH:{
                 required: 'Selecione a quantidade de horas'
             },
             FACULDADE:{
                 required: 'Informe a Faculdade'
             },
             AREA_CONCENTRACAO:{
                 required: 'Informe a &aacute;rea de concentra&ccedil;&atilde;o'
             },
             MATRICULA_IES:{
                 required: 'Informe a matr&iacute;cula'
             },
             NU_CNES:{
                 required: 'Informe o n&uacute;mero do CNES'
             },
             NU_ANO:{
                 required: 'Selecione o ano'
             },
             DS_SEMESTRE:{
                 required: 'Selecione o semestre'
             },
             PROUNI:{
                 required: 'Bolsista PROUNI?'
             }
         }
       });
});
</script>
<style type="text/css">
    span{
        color: #ff0000;
    }
    #passo03{ height: 40px; background: url(imgs/passo3.png); width: 699px; border: #ccc 1px solid; }
    #passo04{ height: 40px; background: url(imgs/passo4.png); width: 699px; border: #ccc 1px solid; }
    #concluido{ padding: 50px; height: 80px; font-size: large; font-weight: bold; text-align: center; }
</style>
