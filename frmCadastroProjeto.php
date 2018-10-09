<?php
require "_cabecalho.php";

session_start();
$Session = new Assinatura();
$Session->setValidaSession(array(12));

if (isset($_POST) && !empty($_POST)) {

    $projeto = new Projeto();

    $projeto->setNuSipar($_POST['sipar']);
    //$projeto->setCoUf($_POST['uf']);
    $projeto->setCoMunicipio($_POST['municipio']);
    $projeto->setQtAprovados($_POST['grupos_aprovados']);

    $proj = $projeto->incluirProjeto();

    if ($proj) {
        //echo '<div class="ok">Dados gravados com sucesso!</div>';
        header("Location: frmProjeto.php?projeto=".base64_encode($projeto->getCoProjeto()));
    } else {
        echo '<div class="erro">Sipar já cadastrado.</div>';
    }
}

$uf = new DadosUf();
$estados = $uf->carregarUf();


//__visArray($uf->carregarUf());
?>
<fieldset>
    <legend>Cadastrar Proposta</legend>
    <form action="frmCadastroProjeto.php" name="frmCadastroProjeto" id="frmCadastroProjeto" method="post">
        <ul class="ulform">
            <li>
                <label>Sipar:<span>*</span></label>
                <input type="text" name="sipar" class="sipar" value="">
            </li>
        <!--
        Uf:<span>*</span><br>
        <select name="uf" id="uf">
            <option></option>
            <?php
            foreach ($estados as $estado) {
                ?>
                <option value="<?php echo $estado['SG_UF'] ?>"><?php echo $estado['SG_UF']; ?></option>
                <?php
            }
            ?>
        </select><br>
        Munic&iacute;pio:<span>*</span><br>
        <select name="municipio" id="municipio">
            <option></option>
        </select><br>-->
        <li>
            <label>Qt. Grupos Aprovados:<span>*</span></label>
            <input type="text" name="grupos_aprovados" value="" style='width:40px; text-align: center;'>
        </li>
        </ul>
        <div id="submit">
            <input type="submit" name="confirmar" value="Confirmar">
        </div>
    </form>
</fieldset>
<?php
require "_rodape.php";
?>
<script src="script/jquery.maskedinput-1.3.min.js" type="text/javascript"></script>
<script src="script/jquery.validate.js" type="text/javascript"></script>

<script language="javascript" type="text/javascript">
    $(document).ready(function() {
        $(".sipar").mask("99999.999999/9999-99");
        $('#frmCadastroProjeto').validate({
            rules: {
                sipar: {
                    required: true
                },
                uf: {
                    required: true
                },
                municipio:{
                    required: true
                },
                grupos_aprovados:{
                    required: true               
                }
            },
            messages: {
                sipar: {
                    required: ' <span>Informe o nº do sipar</span>'
                },
                uf: {
                    required: ' <span>Selecione uma uf</span>'
                },
                municipio:{
                    required: ' <span>Selecione um munic&iacute;pio</span>'
                },
                grupos_aprovados:{
                    required: ' <span>Informe quantos grupos foram aprovados</span>'               
                }
            }
        });
        $('#uf').change(function(){
            $('#municipio').html("<option>Carregando...</option>");
            setTimeout(function(){
                $('#municipio').load('cidades.php?estado='+$('#uf').val() );
            }, 2000);
        
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
</style>