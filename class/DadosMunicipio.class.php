<?php

class DadosMunicipio extends ConexaoPOLO {

    private $uf = null;
    private $cnpj = null;

    public function setUf($value) {
        $this->uf = $value;
    }

    public function setCnpj($value) {
        $this->cnpj = $value;
    }

    public function carregarMunicipios() {

        $sql = "select co_municipio_ibge, no_municipio
                from dbgeral.tb_municipio
                where sg_uf = :SG_UF
                order by no_municipio
                ";
        $param = array();
        $param[] = array(":SG_UF", $this->uf);
        $res = parent::queryDql($sql, $param);
        if ($res) {
            return $res;
        } else {
            return false;
        }
    }

    public function localizarMunicipio($co_municipio) {

        $sql = "select no_municipio, sg_uf
                from dbgeral.tb_municipio
                where co_municipio_ibge = :CO_MUNICIPIO_IBGE";
        $param = array();
        $param[] = array(":CO_MUNICIPIO_IBGE", $co_municipio);
        $res = parent::queryDql($sql, $param);
        if ($res) {
            return $res;
        } else {
            return false;
        }
    }

    public function carregaInstituicoes() {
        $sql = "select no_pessoa from dbpessoa.tb_pessoa where nu_cpf_cnpj_pessoa = :CNPJ";
        $param = array();
        $param[] = array(":CNPJ", $this->cnpj);
        $res = parent::queryDql($sql, $param);
        if ($res) {
            return $res;
        } else {
            return false;
        }
    }

}

?>
