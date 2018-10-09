<?php
  
session_start();
require '_cabecalho.php';
$Session = new Assinatura();
$Session->setValidaSession(array(10));

$participante = new Participante;
    
$participante->setNu_serie($_SESSION['NU_SIPAR']);
//__visArray($participante->listarParticipantes());

if(isset($_POST['BUSCAR']) && $_POST['BUSCAR'] != ""){
    $participante->setNu_cpf($_POST['NU_CPF']);
    $participante->setNo_aluno($_POST['NO_PESSOA']);
    
    $participantes = $participante->listarParticipantes();
}
    
?>
<fieldset>
    <legend>Listar Participantes</legend>
    <form name="frmListarParticipantes" id="frmListarParticipantes" action="frmListarParticipantes.php" method="POST">
        <ul class="ulform">
            <li><label>CPF:</label>
                <input type="text" name="NU_CPF" id="NU_CPF" maxlength="11">
            </li>
            <li><label>Nome:</label>
                <input type="text" name="NO_PESSOA" id="NO_PESSOA">
            </li>
        </ul>
        <div id="submit">
            <input type="submit" name="BUSCAR" value="BUSCAR">
        </div>
    </form>
<?php
if(isset($participantes) && count($participantes) > 0){
    echo 'Foram encontrados ('.count($users).') participantes';
?>
    <table>
        <thead>
            <tr>
                <th></th>
                <th>COD</th>
                <th>CPF</th>
                <th>Aluno</th>
                <th>V&iacute;nculo</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $conta = 1;
                foreach($participantes as $p){
                    echo '<tr>';
                    echo '<td>'.$conta++.'</td>';
                    echo '<td>'.$p['CO_SEQ_ALUNO'].'</td>';
                    echo '<td>'.$p['NU_CPF'].'</td>';
                    echo '<td>'.utf8_encode($p['NO_ALUNO']).'</td>';
                    echo '<td>'.utf8_encode($p['DS_VINCULO']).'</td>';
                    echo '<td>Detalhar</td>';
                    echo '</tr>';
                }
            ?>
        </tbody>
    </table>
    <?php
}
    ?>
</fieldset>
<?php
    require "_rodape.php";
?>
<script src="script/jquery.validate.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
    $(document).ready(function() {
        $('#frmListarUsuarios').validate({
            rules: {
                NU_CPF: {
                    number: true,
                    minlength: 11
                },
                NO_PESSOA: {
                    minlength: 4
                }
            },
            messages: {
                NU_CPF: {
                    number: 'Apenas n&uacute;meros',
                    minlength: 'M&aacute;ximo 11 n&uacute;meros'
                },
                NO_PESSOA: {
                    minlength: 'Digite pelo menos 4 caracteres'
                }
            }
        });
    });
</script>
