<?php

class DadosPessoa extends ConexaoPOLO{
    
    private $co_pessoa;
    private $co_perfil;
    
    public function setCoPessoa         ($value) { $this->co_pessoa = $value; }
    public function setCoPerfilPessoa   ($value) { $this->co_perfil = $value; }
    
    public function localizarPessoa(){
        $sql="select no_pessoa,
                     nu_atuacao_projeto
                from dbpolo.tb_pessoa
                where co_seq_pessoa = :CO_PESSOA";
        $param = array();
        $param[] = array(":CO_PESSOA", $this->co_pessoa);
        $res = parent::queryDql($sql, $param);
        if($res[0][0] != "" && isset($res[0][0])){
            return $res;
        }else{
            return false;
        }
    }
    
    public function localizarPerfilPessoa(){
        $sql="select ds_perfil from dbpolo.tb_perfil where co_seq_perfil = :CO_PERFIL";
        $param = array();
        $param[] = array(":CO_PERFIL", $this->co_perfil);
        $res = parent::queryDql($sql, $param);
        if($res[0][0] != "" && isset($res[0][0])){
            return $res;
        }else{
            return false;
        }
    }
    
}

?>
