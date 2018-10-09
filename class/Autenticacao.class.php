<?php

class Autenticacao extends ConexaoPOLO{
    private $login, $password;
    private $acesso, $valdoc;

    public function __construct() {
        //$this->valdoc = new ValidaDocumento();
    }

    public function getAcesso      (){return $this->acesso;}  
    
    private function validaLogin(){
        /*
        $sqlLogin = "select co_seq_pessoa,
                            no_pessoa,
                            ds_pessoa_login,
                            co_perfil,
                            nu_atuacao_projeto
                      from dbpolo.tb_pessoa
                     where ds_pessoa_login = :NOLOGIN
                       and ds_pessoa_senha = :NOSENHA
                       and st_pessoa = 1
                    "; 
        */
        echo $sqlLogin = "select tp.co_seq_pessoa,
                            tp.no_pessoa,
                            us.ds_usuario_login,
                            tp.co_perfil,
                            tp.nu_atuacao_projeto,
                            tps.co_seq_projetosies,
                            tps.qt_grupo
                        from dbpolo.tb_pessoa tp
                        left join dbpolo.tb_projeto_sies tps
                        on tps.nu_sipar = tp.nu_atuacao_projeto
                        join dbpolo.tb_usuario us
                        on us.co_pessoa = tp.co_seq_pessoa
                        where UPPER(us.ds_usuario_login) = UPPER('$this->login')
                        and UPPER(us.ds_usuario_senha) = UPPER('$this->password')
                        and st_pessoa = 1
                        and tp.co_perfil = 12
                    ";		 
        $resultLogin = parent::queryDql($sqlLogin);
        if ((isset($resultLogin[0]["DS_USUARIO_LOGIN"]) && $resultLogin[0]["DS_USUARIO_LOGIN"] == $this->login)){
             $this->acesso = true;
             return $resultLogin;
        }else{
             $this->acesso = false;
        }
    }

    public function destroySession(){
        $_SESSION = array();
        session_destroy();
    }

    public function setLogin($login, $password){
        $this->login    = $login;
        $this->password = $password;
    }
    
    
    public function autorizacaoLogin(){ //Caso a validação seja verdadeira é setado as variaveis de sessão
        $result = $this->validaLogin();
        if ($this->acesso == true){ //Verificando o acesso
            parent::closeConnection();
            $_SESSION['NO_LOGIN']           = $this->login;
            $_SESSION['CO_SEQ_PESSOA']      = $result[0]["CO_SEQ_PESSOA"];
            $_SESSION['NO_PESSOA']          = $result[0]["NO_PESSOA"];
            $_SESSION['CO_PERFIL']          = $result[0]["CO_PERFIL"];
            $_SESSION['NU_SIPAR']           = $result[0]["NU_ATUACAO_PROJETO"];
            $_SESSION['CO_PROPOSTA']        = $result[0]["CO_SEQ_PROJETOSIES"];
            $_SESSION['QT_GRUPO']           = $result[0]["QT_GRUPO"];
        } else {
            $this->destroySession();
        }

    }

}
?>