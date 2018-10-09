<?php

class Projeto extends ConexaoPOLO {

    private $co_projeto = null;
    private $co_subprojeto = null;
    private $nu_sipar = null;
    private $co_uf = null;
    private $co_municipio = null;
    private $qt_aprovados = null;
    private $no_subprojeto = null;
    private $ds_subprojeto = null;
    private $no_coordenador = null;
    private $cnpj;
    private $co_munprojsies = null;

    /* GETTERS */

    public function getCoProjeto() {
        return $this->co_projeto;
    }

    public function getNuSipar() {
        return $this->nu_sipar;
    }

    public function getCoUf() {
        return $this->co_uf;
    }

    public function getCoMunicipio() {
        return $this->co_municipio;
    }

    public function getQtAprovados() {
        return $this->qt_aprovados;
    }

    /* SUBPROJETO */

    public function getCoSubProjeto() {
        return $this->co_subprojeto;
    }

    public function getNoSubProjeto() {
        return $this->no_subprojeto;
    }

    public function getDsSubProjeto() {
        return $this->ds_subprojeto;
    }

    public function getNoCoordenador() {
        return $this->no_coordenador;
    }

    /* SETTERS */

    public function setCoProjeto($value) {
        $this->co_projeto = $value;
    }

    public function setNuSipar($value) {
        $this->nu_sipar = $value;
    }

    public function setCoUf($value) {
        $this->co_uf = $value;
    }

    public function setCoMunicipio($value) {
        $this->co_municipio = $value;
    }

    public function setQtAprovados($value) {
        $this->qt_aprovados = $value;
    }

    /* SUBPROJETO */

    public function setCoSubProjeto($value) {
        $this->co_subprojeto = $value;
    }

    public function setNoSubProjeto($value) {
        $this->no_subprojeto = $value;
    }

    public function setDsSubProjeto($value) {
        $this->ds_subprojeto = $value;
    }

    public function setNoCoordenador($value) {
        $this->no_coordenador = $value;
    }

    /* SETTERS INSTITUIÇÕES */
   
    public function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }
    
    /* SETTERS MUNICIPIOS */
    
    public function setCo_munprojsies($co_munprojsies) {
        $this->co_munprojsies = $co_munprojsies;
    }

        
    public function incluirProjeto() {
        $sql = "select *
                from dbpolo.tb_projeto_sies
                where nu_sipar = :SIPAR and co_tipo_projeto = 10";

        $param = array();
        $param[] = array(":SIPAR", $this->getNuSipar());
        $res = parent::queryDql($sql, $param);

        if (isset($res[0][0]) && $res[0][0] != "") {
            return false;
        } else {
            $sql = "INSERT INTO dbpolo.TB_projeto_sies
                    (co_seq_projetosies,
                    nu_sipar,
                    co_municipio_ibge,
                    qt_grupo,
                    co_tipo_projeto) 
                VALUES 
                    (dbpolo.SQ_PROJETOSIES_COSEQPROJSIES.nextval + 500,
                    :SIPAR,
                    :CO_MUNICIPIO,
                    :QT_APROVADOS,
                    :TIPO_PROJETO)";

            $param = array();
            $param[] = array(":SIPAR", $this->getNuSipar());
            $param[] = array(":CO_MUNICIPIO", $this->getCoMunicipio());
            $param[] = array(":QT_APROVADOS", $this->getQtAprovados());
            $param[] = array(":TIPO_PROJETO", 10);

            try {
                parent::queryDml($sql, $param);
                $sql = "select max(ps.co_seq_projetosies)
                        from dbpolo.tb_projeto_sies ps
                        where nu_sipar = :SIPAR
                        ";
                $res = parent::queryDql($sql,$param);
                if(isset($res[0][0]) && $res[0][0] != ""){
                    $this->co_projeto = $res[0][0];
                }
                return true;
            } catch (Exception $e) {
                throw new Exception("Exeção: " . $e->getMessage());
            }
        }
    }

    public function localizarProjetos($sipar) {
        $sql = "select sies.co_seq_projetosies,
                   sies.nu_sipar,
                   sies.no_projeto,
                   sies.co_pessoa,
                   sies.qt_grupo,
                   pes.no_pessoa
              from dbpolo.tb_projeto_sies sies
              join dbpolo.tb_pessoa pes
                on pes.nu_atuacao_projeto = sies.nu_sipar
                where sies.nu_sipar like '%$sipar%'
                and sies.co_tipo_projeto = 10";
        $res = parent::queryDql($sql);
        if ($res[0][0] != "" && isset($res[0][0])) {
            return $res;
        } else {
            return false;
        }
    }

    public function localizarProjeto($co_projeto) {
        $sql = "select  co_seq_projetosies,
                        nu_sipar,
                        no_projeto,
                        co_pessoa,
                        co_municipio_ibge,
                        qt_grupo
                    from dbpolo.tb_projeto_sies
                    where co_seq_projetosies = :CO_PROJETO";

        $param = array();
        $param[] = array(":CO_PROJETO", $co_projeto);
        $res = parent::queryDql($sql, $param);
        if ($res[0][0] != "" && isset($res[0][0])) {
            return $res;
        } else {
            return false;
        }
    }

    public function atualizarProjeto($co_projeto) {
        $sql = "select *
                from dbpolo.tb_projeto_sies
                where nu_sipar = :NU_SIPAR
                ";

        $param = array();
        $param[] = array(":NU_SIPAR", $this->getNuSipar());
        //$param[] = array(":CO_PROJETO", $co_projeto);
        $res = parent::queryDql($sql, $param);

        if (isset($res[0][0]) && $res[0][0] != "" && $res[0]['CO_SEQ_PROJETOSIES'] != $co_projeto) {
            return false;
        } else {
            $sql = "update dbpolo.tb_projeto_sies
                        set nu_sipar = :NU_SIPAR,
                            qt_grupo = :QT_GRUPO
                        where co_seq_projetosies = :CO_PROJETO";
            $param = array();
            $param[] = array(":CO_PROJETO", $co_projeto);
            $param[] = array(":NU_SIPAR", $this->getNuSipar());
            $param[] = array(":QT_GRUPO", $this->getQtAprovados());
            try {
                parent::queryDml($sql, $param);
                return true;
            } catch (Exception $e) {
                throw new Exception("Exeção: " . $e->getMessage());
            }
        }
    }

    public function listarProjetos() {
        $sql = "select sies.co_seq_projetosies,
                   sies.nu_sipar,
                   sies.no_projeto,
                   sies.co_pessoa,
                   sies.qt_grupo,
                   pes.no_pessoa
              from dbpolo.tb_projeto_sies sies
              join dbpolo.tb_pessoa pes
                on pes.nu_atuacao_projeto = sies.nu_sipar
                where sies.co_tipo_projeto = 10
                ";

        $res = parent::queryDql($sql);
        if ($res[0][0] != "" && isset($res[0][0])) {
            return $res;
        } else {
            return false;
        }
    }

    public function listarSubProjetos($co_projeto) {
        $sql =  "
            select tt.co_seq_turma,
                tt.no_turma,
                ps.nu_sipar,
                tt.co_projetosies,
                tt.ds_linhapesquisa
            from dbpolo.tb_turma tt
            inner join dbpolo.tb_projeto_sies ps
                on ps.co_seq_projetosies = tt.co_projetosies
            where co_projetosies = :CO_PROJETO
                ";
        $param = array();
        $param[] = array(":CO_PROJETO", $co_projeto);
        $res = parent::queryDql($sql, $param);
        if ($res[0][0] != "" && isset($res[0][0])) {
            return $res;
        } else {
            return false;
        }
    }

    public function dadosSubprojeto($cod_Sub) {
        $sql =  "
            select tt.co_seq_turma,
                tt.no_turma,
                ps.nu_sipar,
                tt.co_projetosies,
                tt.ds_linhapesquisa
            from dbpolo.tb_turma tt
            inner join dbpolo.tb_projeto_sies ps
                on ps.co_seq_projetosies = tt.co_projetosies
            where co_seq_turma = :CO_SUBPROJETO
                ";
        $param = array();
        $param[] = array(":CO_SUBPROJETO", $cod_Sub);
        $res = parent::queryDql($sql, $param);
        if ($res[0][0] != "" && isset($res[0][0])) {
            return $res;
        } else {
            return false;
        }
    }    
    
    
    
    public function localizarSubProjeto() {
       $sql = "select co_seq_turma,
                    no_turma,
                    ds_linhapesquisa
                    from dbpolo.tb_turma
                    where co_seq_turma = :CO_SUBPROJETO";
        $param = array();
        $param[] = array(":CO_SUBPROJETO", $this->getCoSubProjeto());
        $res = parent::queryDql($sql, $param);
        if ($res[0][0] != "" && isset($res[0][0])) {
            return $res;
        } else {
            return false;
        }
    }

    public function incluirSubProjeto() {
        $subproj = $this->localizarSubProjeto();
        
        if ($subproj) {
            $sql = "update dbpolo.tb_turma
                        set no_turma = :NO_SUBPROJETO,
                            ds_linhapesquisa = :DS_SUBPROJETO
                        where
                            co_seq_turma = :CO_SUBPROJETO";
            $param = array();
            $param[] = array(":NO_SUBPROJETO", $this->no_subprojeto);
            $param[] = array(":DS_SUBPROJETO", $this->ds_subprojeto);
            $param[] = array(":CO_SUBPROJETO", $this->co_subprojeto);
            try {
                parent::queryDml($sql, $param);
                return true;
            } catch (Exception $e) {
                return false;
                parent::closeConnection();
                throw new Exception("Exeção: " . $e->getMessage());
            }
        } else {
            $sql = "insert into dbpolo.tb_turma
                    (co_seq_turma, no_turma, co_projetosies, ds_linhapesquisa)
                    values
                    (dbpolo.sq_turma_coseqturma.nextval, :NO_SUBPROJETO, :CO_PROJETO, :DS_SUBPROJETO)";
            $param = array();
            $param[] = array(":NO_SUBPROJETO", $this->no_subprojeto);
            $param[] = array(":CO_PROJETO", $this->co_projeto);
            $param[] = array(":DS_SUBPROJETO", $this->ds_subprojeto);
            try {
                parent::queryDml($sql, $param);
                return true;
            } catch (Exception $e) {
                return false;
                parent::closeConnection();
                throw new Exception("Exeção: " . $e->getMessage());
            }
        }
    }
    
    
    public function incluirInstituicao(){
        $sql = "insert into dbpolo.tb_proponente pro
                (pro.co_seq_proponente, pro.co_projetosies, pro.nu_cpf_cnpj_pessoa)
                values
                ((select case when max(co_seq_proponente) is null then 1 else max(co_seq_proponente) + 1 end from dbpolo.tb_proponente),
                :COPROJETOSIES, :NUCPFCNPJPESSOA)";
        $param = array();
        $param[] = array(':COPROJETOSIES', $this->co_projeto);
        $param[] = array(':NUCPFCNPJPESSOA', $this->cnpj);
        $return = true;
        try{
            parent::queryDml($sql, $param);
        }catch(Exception $e){
            $return = false;
            parent::closeConnection();
            echo 'Erro: '.$e->getMessage();
        }
        return $return;
    }
    
    public function listarInstituicoes(){
        /*
        $sql = "select co_projetosies, nu_cpf_cnpj_pessoa
                from dbpolo.tb_proponente
                where co_projetosies = :COPROJETOSIES";
        
        */
        $sql = "select tpp.co_projetosies, tpp.nu_cpf_cnpj_pessoa, tps.no_pessoa
                from dbpolo.tb_proponente tpp
                left join dbpessoa.tb_pessoa tps
                    on tps.nu_cpf_cnpj_pessoa = tpp.nu_cpf_cnpj_pessoa
                where tpp.co_projetosies = :COPROJETOSIES "; 
        
        $param = array();
        $param[] = array(":COPROJETOSIES", $this->co_projeto);
        $res = parent::queryDql($sql, $param);
        if(isset($res[0][0]) && $res[0][0] != ""){
            return $res;
        }else{
            return false;
        }
    }
    
    public function incluirMunicipio(){
        $sql = "insert into dbpolo.rl_municipio_projetosies
                values
                ((select case
                            when max(co_seq_munprojsies) is null then
                            1
                            else
                            max(co_seq_munprojsies) + 1
                        end
                    from dbpolo.rl_municipio_projetosies),
                :COPROJETOSIES,
                :CO_MUNICIPIO_IBGE,
                sysdate)";
        $param = array();
        $param[] = array(':COPROJETOSIES', $this->co_projeto);
        $param[] = array(':CO_MUNICIPIO_IBGE', $this->co_municipio);
        $result = true;
        try{
            parent::queryDml($sql, $param);    
        }catch(Exception $e){
            echo 'Erro: '.$e->getMessage();
            parent::closeConnection();
            $result = false;
        }
        return $result;
    }
    
    public function localizaMunicipio(){
        $sql = "select co_seq_munprojsies, co_projetosies, co_municipio_ibge, dt_entrada
                from dbpolo.rl_municipio_projetosies
                where co_municipio_ibge = :CO_MUNICIPIO_IBGE
                and co_projetosies = :COPROJETOSIES
                ";
        $param = array();
        $param[] = array(':COPROJETOSIES', $this->co_projeto);
        $param[] = array(':CO_MUNICIPIO_IBGE', $this->co_municipio);
        $res = parent::queryDql($sql, $param);
        if(isset($res[0][0]) && $res[0][0] != ""){
            return true;
        }else{
            return false;
        }
    }
    
    public function listarMunicipios(){
        $sql = "select co_seq_munprojsies, co_projetosies, co_municipio_ibge, dt_entrada
                from dbpolo.rl_municipio_projetosies
                where co_projetosies = :COPROJETOSIES
                ";
        $param = array();
        $param[] = array(':COPROJETOSIES', $this->co_projeto);
        $res = parent::queryDql($sql, $param);
        if(isset($res[0][0]) && $res[0][0] != ""){
            return $res;
        }else{
            return false;
        }
    }
    
    public function deletarMunicipio(){
        $sql = "delete from dbpolo.rl_municipio_projetosies where co_seq_munprojsies = :CO_MUNPROJSIES";
        $param = array();
        $param[] = array(':CO_MUNPROJSIES', $this->co_munprojsies);
        $result = true;
        try{
            parent::queryDml($sql, $param);
        }catch(Exception $e){
            parent::closeConnection();
            echo 'Erro: '.$e->getMessage();
            $result = false;
        }
        return $result;
    }

    
        public function buscaQtdGrupos($sipar) {
        $sql =  "
            select *
            from dbpolo.tb_projeto_sies
            where qt_grupo > 2 
            and nu_sipar = :SIPAR 
                ";
        $param = array();
        $param[] = array(":SIPAR", $sipar);
        $res = parent::queryDql($sql, $param);
        if ($res[0][0] != "" && isset($res[0][0])) {
            return $res;
        } else {
            return false;
        }
    } 
    
    
}

?>
