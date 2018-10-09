<?php
require "_cabecalho.php";

$co_projeto = $_POST['CO_PROJETO'];
$nu_sipar   = $_POST['NU_SIPAR'];

if (isset($_POST['GRAVAR']) && !empty($_POST['GRAVAR'])) {
    
    $projeto = new Projeto();
    
    $projeto->setCoProjeto($_POST['CO_PROJETO']);
    $projeto->setCoMunicipio($_POST['MUNICIPIO']);
    
    if(!$projeto->localizaMunicipio()){
        $municipio = $projeto->incluirMunicipio();
    
        if ($municipio) {
            $msg_muni = 'S';
            //echo '<div class="ok">Munic&iacute;pio cadastrado com sucesso</div>';
            header("Location: frmProjeto.php?projeto=".base64_encode($co_projeto)."&msg_muni=".$msg_muni);
        } else {
            echo '<div class="erro">Erro ao gravar</div>';
        }
    }else{
        echo '<div class="erro">Munic&iacute;pio j&aacute; cadastrado</div>';
    }
    //__visArray($_POST);
}

$unfed  = new DadosUf();
$uf     = $unfed->carregarUf();

?>
N&deg SIPAR:<strong><?php echo " ".$nu_sipar; ?></strong><br> 

<form action="frmNovoMunicipio.php" id="frmNovoMunicipio" name="frmNovoMunicipio" method="POST">
    <input type="hidden" id="CO_PROJETO" name="CO_PROJETO" value="<?php echo $co_projeto; ?>">
    <input type="hidden" id="NU_SIPAR" name="NU_SIPAR" value="<?php echo $nu_sipar; ?>">
    <fieldset>
        <legend><strong>Munic&iacute;pio</strong></legend>
        <ul class="ulform">
            <li>
                <label>UF:<span>*</span></label>
                <select name='SG_UF' id='SG_UF'>
                    <option value=""></option>
                    <?php
                        foreach($uf as $u){
                            echo '<option value="'.$u['SG_UF'].'">'.$u['SG_UF'].'</option>';
                        }
                    ?>
                </select>
            </li>
            <li>
                <label>Munic&iacute;pio:<span>*</span></label>
                <select name='MUNICIPIO' id='MUNICIPIO' disabled="disabled">
                    <option value=""></option>
                </select>
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
    $('#SG_UF').change(function(){
        if($('#SG_UF').val() != '' ){
            $('#MUNICIPIO').removeAttr('disabled');
            $('#MUNICIPIO').load('ajaxGeral.php?uf='+$('#SG_UF').val());       
        }else{
            $('#MUNICIPIO').attr('disabled', 'disabled'); 
            $('#MUNICIPIO').load('');
        }
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