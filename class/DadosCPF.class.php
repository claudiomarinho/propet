<?php

class DadosCPF extends ConexaoPOLO{    
    //private $var = null;
	
    public function __construct() {
    }
       
    //public function setVar ($value) { $this->var = $value; }
    
    public function localizarCPF($nuCPF) {
        $sql = "select p.nu_cpf_cnpj_pessoa,
                    p.no_pessoa,
                    p.no_logradouro,
                    p.nu_logradouro,
                    p.ds_complemento,
                    p.no_bairro,
                    p.nu_cep,
                    p.no_municipio,
                    p.co_municipio_ibge,
                    p.sg_uf,
                    pf.nu_cpf,
                    pf.dt_nascimento,
                    pf.no_mae,
                    pf.tp_sexo,
                    pf.sg_sexo,
                    al.co_seq_aluno
                from dbpessoa.tb_pessoa P
                left join dbpessoa.tb_pessoa_fisica PF
                    on P.NU_CPF_CNPJ_PESSOA = PF.NU_CPF
                left join dbpolo.tb_aluno al
                    on al.nu_cpf = pf.nu_cpf
                where P.ST_REGISTRO_ATIVO = 'S'
                AND TP_SITUACAO_CPF = 0
                AND PF.NU_CPF = :NU_CPF";
        $param = array();
        $param[] = array(":NU_CPF", $nuCPF);
        $this->res = parent::queryDql($sql, $param);
	if (isset($this->res[0][0]) && $this->res[0][0] != ""){		    
            return $this->res[0];
        }
        else{
            return false;
        }	
    }	
}

?>