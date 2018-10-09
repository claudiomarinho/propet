<div class="menulateral">
<?php
if(!isset($_SESSION['NO_LOGIN'])){

?>
  <form name="form1" class="form1" method="post" action="acessoRestrito.php">
    Usuário: <br>
    <input type="text" name="usuario" id="Usuario">
    <br>
    Senha: <br>
    <input type="password" name="senha" id="Senha">
    <p>
    <input type="submit" name="Acessar" id="Acessar" value="Acessar">
  </form>
<?php
  if (isset($_GET["time"])) {
      Echo "<font color='red'>Tempo esgotado! Efetue novo acesso.</font>";
  }elseif (isset($_GET["denied"])) {
      Echo "<font color='red'>Acesso Negado.</font>";
  }
  echo '<ul id="Menu" style="display:'.$menuOff.'">';
  echo '<li><a href="index.php">Início</a></li>';
  //echo '<li><a href="#">Perguntas Frequentes</a></li>';
  echo '<li><a href="contato.php">Fale Conosco</a></li>';
  echo '</ul>';
}else{
    echo '<ul id="Menu">';
    switch ($_SESSION["CO_PERFIL"]) {
        case 1:
            echo '<li><a href="indexRestrito.php">Início</a></li>';
            break;
        case 10: //Coordenador
            $user = new Usuario;
            $user->setCo_pessoa($_SESSION['CO_SEQ_PESSOA']);
            if(!$user->localizarAlterarSenha()){
                echo '<li><a href="indexRestrito.php">Início</a></li>';
                echo '<li><a href="#">Participantes <font size="3">&#187;</font></a>';
                echo '<ul>';
                echo '<li><a href="frmParticipante.php">Cadastrar Participante</a></li>';
                echo '<li><a href="frmListarParticipantes.php">Listar Participantes</a></li>';
                echo '</ul>';
                echo '</li>';
                echo '<li><a href="frmSubprojetos.php">Cadastrar Subprojeto</a></li>';
                //<img src="imgs/seta.png" style="float:right;" border="0">
                echo '<li><a href="#">Pagamento <font size="3">&#187;</font></a>
                
                      <ul>
                        <li><a href="#">Gerenciar Bolsas</a></li>
                        <li><a href="#">Visualizar Folha</a></li>
                      </ul>
                      </li>';

                if ($_SESSION['QT_GRUPO'] > 1 ){ // por > 2
                    echo '<li><a href="frmCadastroCoordAdjunto.php">Coordenador Adjunto</a></li>';
                }
                echo '<li><a href="logout.php">Sair</a></li>';
                $alterSenha = false;
            }else{
                $alterSenha = true;
                echo '<li><a href="logout.php">Sair</a></li>';
            }
            break;        
        case 12: //SGTES
            echo '<li><a href="indexRestrito.php">Início</a></li>';
            echo '<li><a href="frmCadastroProjeto.php">Cadastrar Proposta</a></li>';
            echo '<li><a href="frmProjetos.php">Propostas</a></li>';
            echo '<li><a href="#">Usu&aacute;rios <font size="3">&#187;</font></a>';
            echo '<ul>';
            echo '<li><a href="frmCadastroUsuario.php">Cadastrar Usuários</a></li>';
            echo '<li><a href="frmListarUsuarios.php">Listar Usuários</a></li>';
            echo '</ul>';
            //Echo '<li><a href="frmParticipante.php">Cadastrar Participante</a></li>';
            echo '<li><a href="logout.php">Sair</a></li>';
            break;        
        }
    echo '</ul>';
}
?>
</div>
<style type="text/css">
    .cor{
        color: #01509f; 
        font-size: 20px;
        font-weight: bold;
        
        margin: 0px;
        padding: 0px;
        float:right;
        
    }
</style>