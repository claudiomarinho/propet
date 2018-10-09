<?php
require "class/PHPMailer_v51/class.phpmailer.php";

class Usuario extends ConexaoPOLO {

    private $no_pessoa, $nu_pessoa_cpf, $nu_sipar, $co_sexo, $ds_email, $co_perfil, $ds_login, $ds_senha,
            $st_pessoa, $co_tipo_pessoa, $st_sistema, $projeto, $co_pessoa;

    //SETTERS
    
    public function setNo_pessoa($no_pessoa) {
        $this->no_pessoa = $no_pessoa;
    }

    public function setNu_pessoa_cpf($nu_pessoa_cpf) {
        $this->nu_pessoa_cpf = $nu_pessoa_cpf;
    }

    public function setNu_sipar($nu_sipar) {
        $this->nu_sipar = $nu_sipar;
    }

    public function setCo_sexo($co_sexo) {
        $this->co_sexo = $co_sexo;
    }

    public function setDs_email($ds_email) {
        $this->ds_email = $ds_email;
    }

    public function setCo_perfil($co_perfil) {
        $this->co_perfil = $co_perfil;
    }

    public function setDs_login($ds_login) {
        $this->ds_login = $ds_login;
    }

    public function setDs_senha($ds_senha) {
        $this->ds_senha = $ds_senha;
    }

    public function setSt_pessoa($st_pessoa) {
        $this->st_pessoa = $st_pessoa;
    }

    public function setCo_tipo_pessoa($co_tipo_pessoa) {
        $this->co_tipo_pessoa = $co_tipo_pessoa;
    }
    public function setProjeto($projeto) {
        $this->projeto = $projeto;
    }
    
    public function setSt_sistema($st_sistema) {
        $this->st_sistema = $st_sistema;
    }
    
    public function setCo_pessoa($co_pessoa) {
        $this->co_pessoa = $co_pessoa;
    }

    
    //GETTERS
    
    public function getDs_senha() {
        return $this->ds_senha;
    }

            
    public function localizaCPF() {
        $sql = "select nu_pessoa_cpf from dbpolo.tb_pessoa where nu_pessoa_cpf = :NU_PESSOA_CPF";
        $param = array();
        $param[] = array(":NU_PESSOA_CPF", $this->nu_pessoa_cpf);
        $res = parent::queryDql($sql, $param);
        if (isset($res[0][0]) && $res[0][0] != "") {
            return true;
        } else {
            return false;
        }
    }

    public function localizaSIPAR() {
        $sql = "select nu_sipar from dbpolo.tb_projeto_sies where nu_sipar = :NU_SIPAR";
        $param = array();
        $param[] = array(":NU_SIPAR", $this->nu_sipar);
        $res = parent::queryDql($sql, $param);
        if (isset($res[0][0]) && $res[0][0] != "") {
            return true;
        } else {
            return false;
        }
    }
    
    public function localizaUsuario(){
        $sql = "select nu_pessoa_cpf
                from dbpolo.tb_pessoa
                where ds_pessoa_login = :DS_LOGIN";
        $param = array();
        $param[] = array(":DS_LOGIN", $this->ds_login);
        $res = parent::queryDql($sql, $param);
        if (isset($res[0][0]) && $res[0][0] != "") {
            return true;
        } else {
            return false;
        }
    }
    
    public function localizaVinculo(){
        $sql = "select nu_atuacao_projeto
                from dbpolo.tb_pessoa
                where nu_atuacao_projeto = :NU_SIPAR";
        $param = array();
        $param[] = array(":NU_SIPAR", $this->nu_sipar);
        $res = parent::queryDql($sql, $param);
        if (isset($res[0][0]) && $res[0][0] != "") {
            return true;
        } else {
            return false;
        }
    }

    public function incluirUsuario() {
        $sql = "insert into dbpolo.tb_pessoa
                (co_seq_pessoa,
                no_pessoa,
                nu_pessoa_cpf,
                ds_email,
                st_pessoa,
                co_tipo_pessoa,
                co_sexo,
                co_perfil,
                st_pessoa_escola,
                nu_atuacao_projeto)
                values
                (dbpolo.sq_coseqpessoa.nextval,
                :NO_PESSOA,
                :NU_PESSOA_CPF,
                :DS_EMAIL,
                :ST_PESSOA,
                :CO_TIPO_PESSOA,
                :CO_SEXO,
                :CO_PERFIL,
                :ST_SISTEMA,
                :NU_ATUACAO_PROJETO)
                ";
        $param = array();
        $param[] = array(":NO_PESSOA", $this->no_pessoa);
        $param[] = array(":NU_PESSOA_CPF", $this->nu_pessoa_cpf);
        $param[] = array(":DS_EMAIL", $this->ds_email);
        $param[] = array(":ST_PESSOA", $this->st_pessoa);
        $param[] = array(":CO_TIPO_PESSOA", $this->co_tipo_pessoa);
        $param[] = array(":CO_SEXO", $this->co_sexo);
        $param[] = array(":DS_LOGIN", $this->ds_login);
        $param[] = array(":DS_SENHA", $this->ds_senha);
        $param[] = array(":CO_PERFIL", $this->co_perfil);
        $param[] = array(":ST_SISTEMA", $this->st_sistema);
        $param[] = array(":NU_ATUACAO_PROJETO", $this->projeto);
        try{
            parent::queryDml($sql, $param);
            $sql = "insert into dbpolo.tb_usuario
                    values
                    (dbpolo.sq_cosequsuario.nextval, :DS_LOGIN, :DS_SENHA, 
                    (select max(pes.co_seq_pessoa) from dbpolo.tb_pessoa pes where pes.nu_pessoa_cpf = :NU_PESSOA_CPF), 1)
                    ";
            try{               
                parent::queryDml($sql, $param);
                return true;
            }catch(Exception $e){
                parent::closeConnection();
                throw new Exception("Exceção: ".$e->getMessage());
                return false;
            }
            
        }catch(Exception $e){
            parent::closeConnection();
            throw new Exception("Exceção: ".$e->getMessage());
            return false;
        }
    }
    
    public function localizarAlterarSenha(){
        $sql = "select usu.ds_usuario_senha
                from dbpolo.tb_pessoa pes
                join dbpolo.tb_usuario usu
                    on usu.co_pessoa = pes.co_seq_pessoa
                where pes.nu_pessoa_cpf = usu.ds_usuario_senha
                and co_seq_pessoa = :COPESSOA";
        $param = array();
        $param[] = array(":COPESSOA", $this->co_pessoa);
        $res = parent::queryDql($sql, $param);
        if (isset($res[0][0]) && $res[0][0] != "") {
            return true;
        } else {
            return false;
        }
    }
        
    public function localizarSenha(){
        $sql = "select *
                from dbpolo.tb_usuario
                where co_pessoa = :COPESSOA
                and ds_usuario_senha = :DS_SENHA
                ";
        $param = array();
        $param[] = array(":COPESSOA", $this->co_pessoa);
        $param[] = array(":DS_SENHA", $this->ds_senha);
        $res = parent::queryDql($sql, $param);
        if (isset($res[0][0]) && $res[0][0] != "") {
            return true;
        } else {
            return false;
        }
    }
    
    public function alterarSenha(){
        $sql = "update dbpolo.tb_usuario
                set ds_usuario_senha = :DS_SENHA
                where co_pessoa = :COPESSOA
                ";
        $param = array();
        $param[] = array(":COPESSOA", $this->co_pessoa);
        $param[] = array(":DS_SENHA", $this->ds_senha);
         try{
                parent::queryDml($sql, $param);
                return true;
            }catch(Exception $e){
                parent::closeConnection();
                throw new Exception("Exceção: ".$e->getMessage());
                return false;
            }
    }
    
    public function enviaEmail(){    
        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = "smtpaplicacao.saude.gov";

        $mail->From = "info.sgtes@saude.gov.br";
        $mail->FromName = "SIGPROPET";

        $mail->AddAddress($this->ds_email, "SIGPROPET");

        $mail->IsHTML(true);
        /*    
        $mensagem = "Prezado(a) ".$this->no_pessoa.",<br><br>";
        $mensagem.= "Seu cadastro foi realizado no sistema SIGPROPET.<br>";
        $mensagem.= "Para entrar no sistema acesse o link xxxxxx utilizando os dados abaixo.<br>";
        $mensagem.= "Usu&aacute;rio: {$this->ds_login}<br>Senha: {$this->ds_senha}";
        */
        
        $mensagem = "
 
            Prezado(a)<b> ".$this->no_pessoa." </b>,<br><br>

            Iniciaremos as atividades referentes ao PET-Saúde no mês de agosto e para tanto estamos disponibilizando o sistema para cadastro dos bolsistas. Solicitamos atenção às orientações que seguem.<br><br>

            Para entrar no sistema acesse o link <a href='http://propet.saude.gov.br'>http://propet.saude.gov.br</a> utilizando os dados abaixo.<br>
            Usuário:<b> {$this->ds_login} </b><br>
            Senha:<b> {$this->ds_senha} </b><br>
            Esta senha deverá ser alterada já no primeiro acesso ao Sistema.<br><br>
            
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


            --<br>
            Atenciosamente,<br><br>

            COORDENAÇÃO DO PRÓ-SAÚDE/PET-SAÚDE<br>
            DEPARTAMENTO DE GESTÃO DA EDUCAÇÃO<br>
            SECRETARIA DE GESTÃO DO TRABALHO E DA EDUCAÇÃO NA SAÚDE<br>
            MINISTÉRIO DA SAÚDE<br><br>

            ";
        
        $mail->Subject = utf8_decode('SIGPROPET');
        $mail->Body = utf8_decode($mensagem);

        $enviar = $mail->Send();
        $mail->ClearAllRecipients();
        $mail->ClearAttachments();

        if ($enviar) {
            return true;
        } else {
            return false;
        }
    }

    public function buscaCoordAdjunto($nrSipar) {
        /*
        $sql = "
            select tps.co_seq_projetosies,
                tps.nu_sipar,
                tps.qt_grupo,
                tps.co_pessoa                
            from dbpolo.tb_projeto_sies tps
            where tps.nu_sipar = :NU_SIPAR 
               ";
        */
        $sql = "
            select tp.co_seq_pessoa,
                tp.no_pessoa,
                tp.nu_pessoa_cpf,
                tp.ds_email,
                tp.st_pessoa,
                tp.co_tipo_pessoa,
                tp.co_sexo,
                tp.co_perfil,
                tp.st_pessoa_escola,
                tp.nu_atuacao_projeto,
                tps.co_pessoa,
                tu.ds_usuario_login,
                tu.ds_usuario_senha
            from dbpolo.tb_pessoa tp
            left join dbpolo.tb_projeto_sies tps
                on tps.nu_sipar = tp.nu_atuacao_projeto
            left join dbpolo.tb_usuario tu 
                on tu.co_pessoa = tps.co_pessoa
            where tp.nu_atuacao_projeto = :NU_SIPAR
                ";
        $param = array();
        $param[] = array(":NU_SIPAR", $nrSipar);
        $res = parent::queryDql($sql, $param);
        if(isset($res[0][0]) && $res[0][0] != ""){
            return $res[0];
        }else{
            return false;
            parent::connectionClose();
        }
    }
    
    public function incluirCoodAdjunto() {
        $this->incluirUsuario();
        $sql = "
            select max(co_seq_pessoa) 
            from dbpolo.tb_pessoa tp
            where tp.nu_pessoa_cpf = :NU_CPF
               ";
        $param = array();
        $param[] = array(':NU_CPF', $this->nu_pessoa_cpf);
        $res = parent::queryDql($sql, $param);
        if ($res[0][0] != '' && isset($res[0][0])){
            $sql = "
                update dbpolo.tb_projeto_sies
                set co_pessoa = :CO_PESSOA
                where nu_sipar = :NU_SIPAR
                   ";
            $param = array();
            $param[] = array(':CO_PESSOA', $res[0][0]);
            $param[] = array(':NU_SIPAR', $this->nu_sipar);
            try{               
                parent::queryDml($sql, $param);
                return true;
            }catch(Exception $e){
                parent::closeConnection();
                throw new Exception("Exceção: ".$e->getMessage());
                return false;
            }   
        }        
    }
   
    
    public function listarUsuarios(){
        $sql = "select 
                    pes.co_seq_pessoa,
                    pes.no_pessoa,
                    pes.nu_pessoa_cpf,
                    pes.co_tipo_pessoa,
                    usu.co_seq_usuario                
                from 
                dbpolo.tb_pessoa pes 
                join dbpolo.tb_usuario usu on usu.co_pessoa = pes.co_seq_pessoa
                join dbpolo.tb_projeto_sies sies on sies.nu_sipar = pes.nu_atuacao_projeto
                and sies.co_tipo_projeto = 10
                where pes.nu_pessoa_cpf = :NU_CPF
                order by pes.no_pessoa";
        $param = array();
        $param[] = array(':NU_CPF', $this->nu_pessoa_cpf);
        $res = parent::queryDql($sql, $param);
        if(isset($res[0][0]) && $res[0][0] != ''){
            return $res;
        }else{
            $sql = "select 
                        pes.co_seq_pessoa,
                        pes.no_pessoa,
                        pes.nu_pessoa_cpf,
                        pes.co_tipo_pessoa,
                        usu.co_seq_usuario                
                    from 
                    dbpolo.tb_pessoa pes 
                    join dbpolo.tb_usuario usu on usu.co_pessoa = pes.co_seq_pessoa
                    join dbpolo.tb_projeto_sies sies on sies.nu_sipar = pes.nu_atuacao_projeto
                    and sies.co_tipo_projeto = 10
                    where pes.no_pessoa like '%$this->no_pessoa%'
                    order by pes.no_pessoa";
            $res = parent::queryDql($sql, $param);
            if(isset($res[0][0]) && $res[0][0] != ''){
                return $res;
            }else{
                return false;
            }
        }
    }
    
}

?>