<?php
session_start();
require '_cabecalho.php';
$Session = new Assinatura();
$Session->setValidaSession(array(1,2,3,4,5,6,7,8,9,10,11,12));

if($_SESSION['CO_PERFIL'] == 10){
    if($alterSenha){
        header('Location: frmAlterarSenha.php');
    }else{
        ?>
        <fieldset>
            <legend>Index Restrito</legend>
            <p>Prezado(a)<b> "<?php echo $_SESSION['NO_PESSOA']; ?>" </b>,<br><br>

            Iniciaremos as atividades referentes ao PET-Saúde no mês de agosto e para tanto estamos disponibilizando o sistema para cadastro dos bolsistas. Solicitamos atenção às orientações que seguem.<br><br>
            
            O pagamento das bolsas ocorrerá somente após o cadastramento dos participantes no Sistema e envio dos formulários de cadastro (devidamente assinados pelos bolsistas e coordenadores) a este Ministério, e após a inserção de informações sobre os temas dos subprojetos PET-Saúde.<br><br>

            Desta forma, informamos que o Sistema de Informações Gerenciais do Pró-Saúde/PET-Saúde - SIG-PRÓ/PET-Saúde estará  disponível a partir de 02.08.2012 para inserção de dados pelos coordenadores das Propostas Pró-Saúde/PET-Saúde aprovados.<br><br>

            A seguir, orientações sobre sua utilização, <b>nesta primeira etapa de cadastro dos participantes (em conformidade com o número de grupos aprovados) e preenchimento dos dados sobre o(s) subprojeto(s), que devem ser realizados a partir de 1º até o dia 19 de agosto.</b><br><br>

            <b>1.</b> Incluir Coordenador Adjunto (menu disponível no lado esquerdo da tela apenas para os projetos aprovados com três ou mais grupos PET-Saúde: &#34;Cadastrar Coordenador Adjunto&#34; => a partir do CPF aparecerá o nome do coordenador adjunto. Inserir o email e o sistema irá gerar o login (primeiro nome.último nome) e Senha (CPF) automaticamente. No primeiro acesso ele deve alterar a senha.<br><br>
            
            <b>2.</b> Incluir Participantes (menu disponível no lado esquerdo da tela: &#34;Cadastrar Participante&#34;), selecionar entre as opções: coordenador, coordenador adjunto, tutor, preceptor e estudante bolsista. Atentar para os campos obrigatórios e para as três telas de informações. Ao digitar o CPF o sistema trará na tela os dados do participante que constam na Receita Federal. Estes dados podem ser alterados caso não estejam atualizados. <u>O CPF deve ser informado com seus 11 dígitos. Caso esteja irregular, o SIG-PRO/PET-Saúde não permitirá o cadastramento no Programa</u>.<br><br> 
            
            <b> Ao salvar as informações inseridas, imprimir, colher assinaturas e enviar para o endereço que aparece na tela.</b><br><br>
            
            
            Realizar também o cadastro do coordenador e do coordenador adjunto (quando for o caso) na tela de cadastro do participante para que possam constar da folha de pagamento. Enviar seu formulário assinado.<br><br>
            
            <b>3.</b> Inserir o(s) Subprojeto(s) => em &#34;Cadastrar suprojeto&#34; (menu disponível no lado esquerdo da tela) => clicar em &#34;Novo subprojeto&#34;. Esta informação é muito importante para respondermos as áreas do Ministério da Saúde. <b>Incluir objetivos, metodologia e resultados esperados do(s) Subprojeto(s).</b><br><br>

            &diams; <b>Não é necessário que os bolsistas abram conta no BANCO DO BRASIL.</b> O repasse será feito diretamente pelo Fundo Nacional de Saúde em conta beneficiário BB. Não se trata de conta corrente, mas uma conta específica vinculada ao Programa, a ser aberta pelo próprio banco. Os bolsistas receberão um cartão de débito, que poderá ser feito uma vez ao mês, ou ao longo do mês, se assim desejarem. No entanto, conforme pede o Sistema, todos devem indicar <b>agência BB mais próxima</b>, para a retirada do cartão Pró/PET-Saúde (recomendamos, caso haja dúvidas em relação ao número da agência BB, indicar apenas uma agência central, de fácil acesso para todos).<br><br>

            &diams; <b>Cuidado no preenchimento de dados cadastrais.</b> Recomendamos muita atenção em relação ao preenchimento de dados cadastrais dos participantes do Programa. Alguns bolsistas não puderam receber os benefícios, por informarem erroneamente CPF e nº de Agência Banco do Brasil.<br><br>

            &diams; No caso de participantes que, porventura, já estejam cadastrados no Sistema (PET-Saúde/Saúde da Família, Saúde Mental ou Vigilância em Saúde), aparecerá uma mensagem <i>&#34;CPF já cadastrado&#34;</i> e uma tela com a mensagem <i>&#34;Deseja recuperar os dados?&#34;</i>. Ao aceitar, basta atualizar as informações e salvar ao final. Dessa forma, é possível recuperar os formulários com os dados pessoais dos que já vinham participando no Programa.<br><br>
            
            &diams; Atentar sempre para o botão &#34;Salvar&#34; em todas as operações realizadas no Sistema.<br><br>
                        
            &diams; Esses formulários deverão ser assinados e encaminhados a este Departamento no seguinte endereço:<br><br><br>

            <i>Ministério da Saúde/Secretaria de Gestão do Trabalho e da Educação na Saúde/Departamento de Gestão da Educação na Saúde/Pró-Saúde e PET-Saúde.<br>
            Esplanada dos Ministérios - Bloco G - Edifício sede - Sala 725 - Brasília/DF - CEP: 70.058-900.</i><br><br><br><br>
            </p>
        </fieldset>    
        <?php
    }
}elseif($_SESSION['CO_PERFIL'] == 12){
?>
<fieldset>
    <legend>Index Restrito</legend>
    <p>Aviso aqui</p>
</fieldset>
<?php
}else{
    ?>
<fieldset>
    <legend>Index Restrito</legend>
    <p>Aviso aqui</p>
</fieldset>
<?php
}
require '_rodape.php';
?>
