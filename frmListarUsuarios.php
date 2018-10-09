<?php
  
session_start();
require '_cabecalho.php';
$Session = new Assinatura();
$Session->setValidaSession(array(12));

$usuarios = new Usuario;


if(isset($_POST['BUSCAR']) && $_POST['BUSCAR'] != ""){
    $usuarios->setNu_pessoa_cpf($_POST['NU_CPF']);
    $usuarios->setNo_pessoa($_POST['NO_PESSOA']);
    
    $users = $usuarios->listarUsuarios();
}

//__visArray($usuarios->listarUsuarios());
    
?>
<fieldset>
    <legend>Listar Usu&aacute;rios</legend>
    <form name="frmListarUsuarios" id="frmListarUsuarios" action="frmListarUsuarios.php" method="POST">
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
if(isset($users) && count($users) > 0){
    echo 'Foram encontrados ('.count($users).') usu&aacute;rios';
?>
    <table>
        <thead>
            <tr>
                <th></th>    
                <th>COD</th>
                <th>CPF</th>
                <th>Nome</th>
                <th>-</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $conta = 1;
                foreach($users as $user){
                    echo '<tr>';
                    echo '<td>'.$conta++.'</td>';
                    echo '<td>'.$user['CO_SEQ_PESSOA'].'</td>';
                    echo '<td>'.$user['NU_PESSOA_CPF'].'</td>';
                    echo '<td>'.$user['NO_PESSOA'].'</td>';
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
