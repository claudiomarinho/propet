<?php

class Participante extends ConexaoPOLO{
    
    private $no_aluno, $dt_nascimento, $no_mae, $no_pai, $nu_cpf, $ds_endereco, $ds_bairro, $ds_complemento, $nu_cep,
            $nu_endereco, $ds_email, $co_sexo, $co_municipio_ibge, $co_municipio_natural, $co_rednda, $co_escolaridade, 
            $co_tipo_curso, $nu_rg, $dt_rg_emissao, $co_tipo_rg, $sg_uf_rg, $co_vinculo, $co_situacao_matricula,
            $ds_obs, $nu_ddd, $nu_telefone1, $nu_ddd2, $nu_telefone2, $nu_serie, $no_conjuge, $dt_cadastro, $nu_ies, 
            $co_tipo_duracao, $ds_formacao, $nu_ano, $co_segmento, $co_curso, $co_agencia_bancaria, $co_ocupacao, 
            $co_pessoa, $co_tipo_sanguineo, $co_raca_cor, $no_nis, $dt_primeiro_emprego, $nu_conta_corrente, 
            $co_banco, $sg_uf_crm, $qt_dependente, $tp_conta, $co_estado_civil, $nu_ddd_celular, $nu_celular, $nu_ordem, $co_tipo_gestao, $nu_cnes, $co_aluno;
    
    /* GETTERS */
    public function getCo_sexo  () { return $this->co_sexo; }
    
    /* SETTERS */
    public function setNo_aluno($no_aluno) {
        $this->no_aluno = $no_aluno;
    }

    public function setDt_nascimento($dt_nascimento) {
        $this->dt_nascimento = $dt_nascimento;
    }

    public function setNo_mae($no_mae) {
        $this->no_mae = $no_mae;
    }

    public function setNo_pai($no_pai) {
        $this->no_pai = $no_pai;
    }

    public function setNu_cpf($nu_cpf) {
        $this->nu_cpf = $nu_cpf;
    }

    public function setDs_endereco($ds_endereco) {
        $this->ds_endereco = $ds_endereco;
    }

    public function setDs_bairro($ds_bairro) {
        $this->ds_bairro = $ds_bairro;
    }

    public function setDs_complemento($ds_complemento) {
        $this->ds_complemento = $ds_complemento;
    }

    public function setNu_cep($nu_cep) {
        $this->nu_cep = $nu_cep;
    }

    public function setNu_endereco($nu_endereco) {
        $this->nu_endereco = $nu_endereco;
    }

    public function setDs_email($ds_email) {
        $this->ds_email = $ds_email;
    }

    public function setCo_sexo($co_sexo) {
        $this->co_sexo = $co_sexo;
    }

    public function setCo_municipio_ibge($co_municipio_ibge) {
        $this->co_municipio_ibge = $co_municipio_ibge;
    }

    public function setCo_municipio_natural($co_municipio_natural) {
        $this->co_municipio_natural = $co_municipio_natural;
    }

    public function setCo_rednda($co_rednda) {
        $this->co_rednda = $co_rednda;
    }

    public function setCo_escolaridade($co_escolaridade) {
        $this->co_escolaridade = $co_escolaridade;
    }

    public function setCo_tipo_curso($co_tipo_curso) {
        $this->co_tipo_curso = $co_tipo_curso;
    }

    public function setNu_rg($nu_rg) {
        $this->nu_rg = $nu_rg;
    }

    public function setDt_rg_emissao($dt_rg_emissao) {
        $this->dt_rg_emissao = $dt_rg_emissao;
    }

    public function setCo_tipo_rg($co_tipo_rg) {
        $this->co_tipo_rg = $co_tipo_rg;
    }

    public function setSg_uf_rg($sg_uf_rg) {
        $this->sg_uf_rg = $sg_uf_rg;
    }

    public function setCo_vinculo($co_vinculo) {
        $this->co_vinculo = $co_vinculo;
    }

    public function setCo_situacao_matricula($co_situacao_matricula) {
        $this->co_situacao_matricula = $co_situacao_matricula;
    }

    public function setDs_obs($ds_obs) {
        $this->ds_obs = $ds_obs;
    }

    public function setNu_ddd($nu_ddd) {
        $this->nu_ddd = $nu_ddd;
    }

    public function setNu_telefone1($nu_telefone1) {
        $this->nu_telefone1 = $nu_telefone1;
    }

    public function setNu_ddd2($nu_ddd2) {
        $this->nu_ddd2 = $nu_ddd2;
    }

    public function setNu_telefone2($nu_telefone2) {
        $this->nu_telefone2 = $nu_telefone2;
    }

    public function setNu_serie($nu_serie) {
        $this->nu_serie = $nu_serie;
    }

    public function setNo_conjuge($no_conjuge) {
        $this->no_conjuge = $no_conjuge;
    }

    public function setDt_cadastro($dt_cadastro) {
        $this->dt_cadastro = $dt_cadastro;
    }

    public function setNu_ies($nu_ies) {
        $this->nu_ies = $nu_ies;
    }

    public function setCo_tipo_duracao($co_tipo_duracao) {
        $this->co_tipo_duracao = $co_tipo_duracao;
    }

    public function setDs_formacao($ds_formacao) {
        $this->ds_formacao = $ds_formacao;
    }

    public function setNu_ano($nu_ano) {
        $this->nu_ano = $nu_ano;
    }

    public function setCo_segmento($co_segmento) {
        $this->co_segmento = $co_segmento;
    }

    public function setCo_curso($co_curso) {
        $this->co_curso = $co_curso;
    }

    public function setCo_agencia_bancaria($co_agencia_bancaria) {
        $this->co_agencia_bancaria = $co_agencia_bancaria;
    }

    public function setCo_ocupacao($co_ocupacao) {
        $this->co_ocupacao = $co_ocupacao;
    }

    public function setCo_pessoa($co_pessoa) {
        $this->co_pessoa = $co_pessoa;
    }

    public function setCo_tipo_sanguineo($co_tipo_sanguineo) {
        $this->co_tipo_sanguineo = $co_tipo_sanguineo;
    }

    public function setCo_raca_cor($co_raca_cor) {
        $this->co_raca_cor = $co_raca_cor;
    }

    public function setNo_nis($no_nis) {
        $this->no_nis = $no_nis;
    }

    public function setDt_primeiro_emprego($dt_primeiro_emprego) {
        $this->dt_primeiro_emprego = $dt_primeiro_emprego;
    }

    public function setNu_conta_corrente($nu_conta_corrente) {
        $this->nu_conta_corrente = $nu_conta_corrente;
    }

    public function setCo_banco($co_banco) {
        $this->co_banco = $co_banco;
    }

    public function setSg_uf_crm($sg_uf_crm) {
        $this->sg_uf_crm = $sg_uf_crm;
    }

    public function setQt_dependente($qt_dependente) {
        $this->qt_dependente = $qt_dependente;
    }

    public function setTp_conta($tp_conta) {
        $this->tp_conta = $tp_conta;
    }

    public function setCo_estado_civil($co_estado_civil) {
        $this->co_estado_civil = $co_estado_civil;
    }

    public function setNu_ddd_celular($nu_ddd_celular) {
        $this->nu_ddd_celular = $nu_ddd_celular;
    }

    public function setNu_celular($nu_celular) {
        $this->nu_celular = $nu_celular;
    }

    public function setNu_ordem($nu_ordem) {
        $this->nu_ordem = $nu_ordem;
    }

    public function setCo_tipo_gestao($co_tipo_gestao) {
        $this->co_tipo_gestao = $co_tipo_gestao;
    }

    public function setNu_cnes($nu_cnes) {
        $this->nu_cnes = $nu_cnes;
    }
            
    public function setCo_aluno($co_aluno) {
        $this->co_aluno = $co_aluno;
    }

        
    public function incluirParticipante(){   
        $sql="insert into dbpolo.tb_aluno
                (co_seq_aluno,
                no_aluno,
                dt_nascimento,
                co_sexo,
                no_conjuge,
                no_mae,
                no_pai,
                nu_cpf,
                nu_rg,
                ds_endereco,
                nu_endereco,
                ds_complemento,
                ds_bairro,
                nu_cep,
                NU_TELEFONE1,
                NU_TELEFONE2,
                NU_FONE_CELULAR,
                ds_email,
                co_agencia_bancaria,
                co_vinculo,
                co_municipio_ibge,
                nu_ddd,
                nu_ddd_celular,
                nu_ddd2,
                CO_ESTADO_CIVIL,
                nu_IES,
                co_tipo_duracao,
                co_escolaridade,
                co_curso,
                co_segmento,                
                nu_ano,
                co_ocupacao,
                co_tipo_gestao,
                nu_carteira_trabalho,
                nu_serie,
                dt_cadastro)
            values
                (dbpolo.sq_aluno_coseqaluno.nextval,
                :NO_ALUNO,
                :DT_NASCIMENTO,
                :CO_SEXO,
                :NO_CONJUGE,
                :NO_MAE,
                :NO_PAI,
                :NU_CPF,
                :NU_RG,
                :DS_ENDERECO,
                :NU_ENDERECO,
                :DS_COMPLEMENTO,
                :DS_BAIRRO,
                :NU_CEP,
                :NU_TELEFONE1,
                :NU_TELEFONE2,
                :NU_FONE_CELULAR,
                :DS_EMAIL,
                :NU_ORDEM,
                :CO_VINCULO,
                :CO_MUNICIPIO_IBGE,
                :NU_DDD,
                :NU_DDD_CELULAR,
                :NU_DDD2,
                :CO_ESTADO_CIVIL,
                :NU_IES,
                :CO_TIPO_DURACAO,
                :CO_ESCOLARIDADE,
                :CO_CURSO,
                :CO_SEGMENTO,
                :NU_ANO,
                :CO_OCUPACAO,
                :CO_TIPO_GESTAO,
                :NU_CNES,
                :NU_SERIE,
                SYSDATE)";              
        $param = array();
        $param[] = array(":NO_ALUNO",  $this->no_aluno);
        $param[] = array(":DT_NASCIMENTO",  $this->dt_nascimento);
        $param[] = array(":CO_SEXO",  $this->co_sexo);
        $param[] = array(":NO_CONJUGE",  $this->no_conjuge);
        $param[] = array(":NO_MAE",  $this->no_mae);
        $param[] = array(":NO_PAI",  $this->no_pai);
        $param[] = array(":NU_CPF",  $this->nu_cpf);
        $param[] = array(":NU_RG",  $this->nu_rg);
        $param[] = array(":DS_ENDERECO",  $this->ds_endereco);
        $param[] = array(":NU_ENDERECO",  $this->nu_endereco);
        $param[] = array(":DS_COMPLEMENTO",  $this->ds_complemento);
        $param[] = array(":DS_BAIRRO",  $this->ds_bairro);
        $param[] = array(":NU_CEP",  $this->nu_cep);
        $param[] = array(":NU_TELEFONE1",  $this->nu_telefone1);
        $param[] = array(":NU_TELEFONE2",  $this->nu_telefone2);
        $param[] = array(":NU_FONE_CELULAR",  $this->nu_celular);
        $param[] = array(":DS_EMAIL",  $this->ds_email);
        $param[] = array(":NU_ORDEM",  $this->nu_ordem);
        $param[] = array(":CO_VINCULO",  $this->co_vinculo);
        $param[] = array(":CO_MUNICIPIO_IBGE",  $this->co_municipio_ibge);
        $param[] = array(":NU_DDD",  $this->nu_ddd);
        $param[] = array(":NU_DDD_CELULAR",  $this->nu_ddd_celular);
        $param[] = array(":NU_DDD2",  $this->nu_ddd2);
        $param[] = array(":CO_ESTADO_CIVIL",  $this->co_estado_civil);
        $param[] = array(":NU_IES",  $this->nu_ies);
        $param[] = array(":CO_TIPO_DURACAO",  $this->co_tipo_duracao);
        $param[] = array(":CO_ESCOLARIDADE",  $this->co_escolaridade);
        $param[] = array(":CO_CURSO",  $this->co_curso);
        $param[] = array(":CO_SEGMENTO",  $this->co_segmento);
        $param[] = array(":NU_ANO",  $this->nu_ano);
        $param[] = array(":CO_OCUPACAO",  $this->co_ocupacao);
        $param[] = array(":CO_TIPO_GESTAO",  $this->co_tipo_gestao);
        $param[] = array(":NU_CNES",  $this->nu_cnes);
        $param[] = array(":NU_SERIE",  $this->nu_serie);
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
    
    public function atualizarParticipante(){
        $sql="update dbpolo.tb_aluno set
                no_aluno = :NO_ALUNO,
                dt_nascimento = :DT_NASCIMENTO, 
                co_sexo = :CO_SEXO,
                no_conjuge = :NO_CONJUGE,
                no_mae = :NO_MAE,
                no_pai = :NO_PAI,
                nu_cpf = :NU_CPF,
                nu_rg = :NU_RG,
                ds_endereco = :DS_ENDERECO,
                nu_endereco = :NU_ENDERECO,
                ds_complemento = :DS_COMPLEMENTO,
                ds_bairro = :DS_BAIRRO,
                nu_cep = :NU_CEP,
                NU_TELEFONE1 = :NU_TELEFONE1,
                NU_TELEFONE2 = :NU_TELEFONE2,
                NU_FONE_CELULAR = :NU_FONE_CELULAR,
                ds_email = :DS_EMAIL,
                co_agencia_bancaria = :NU_ORDEM,
                co_vinculo = :CO_VINCULO,
                co_municipio_ibge = :CO_MUNICIPIO_IBGE,
                nu_ddd = :NU_DDD,
                nu_ddd_celular = :NU_DDD_CELULAR,
                nu_ddd2 = :NU_DDD2,
                CO_ESTADO_CIVIL = :CO_ESTADO_CIVIL,
                nu_IES = :NU_IES,
                co_tipo_duracao = :CO_TIPO_DURACAO,
                co_escolaridade = :CO_ESCOLARIDADE,
                co_curso = :CO_CURSO,
                co_segmento = :CO_SEGMENTO,                
                nu_ano = :NU_ANO,
                co_ocupacao = :CO_OCUPACAO,
                co_tipo_gestao = :CO_TIPO_GESTAO,
                nu_carteira_trabalho = :NU_CNES,
                nu_serie = :NU_SERIE,
                dt_cadastro = SYSDATE
            where co_seq_aluno = :CO_ALUNO";              
        $param = array();
        $param[] = array(":NO_ALUNO",  $this->no_aluno);
        $param[] = array(":DT_NASCIMENTO",  $this->dt_nascimento);
        $param[] = array(":CO_SEXO",  $this->co_sexo);
        $param[] = array(":NO_CONJUGE",  $this->no_conjuge);
        $param[] = array(":NO_MAE",  $this->no_mae);
        $param[] = array(":NO_PAI",  $this->no_pai);
        $param[] = array(":NU_CPF",  $this->nu_cpf);
        $param[] = array(":NU_RG",  $this->nu_rg);
        $param[] = array(":DS_ENDERECO",  $this->ds_endereco);
        $param[] = array(":NU_ENDERECO",  $this->nu_endereco);
        $param[] = array(":DS_COMPLEMENTO",  $this->ds_complemento);
        $param[] = array(":DS_BAIRRO",  $this->ds_bairro);
        $param[] = array(":NU_CEP",  $this->nu_cep);
        $param[] = array(":NU_TELEFONE1",  $this->nu_telefone1);
        $param[] = array(":NU_TELEFONE2",  $this->nu_telefone2);
        $param[] = array(":NU_FONE_CELULAR",  $this->nu_celular);
        $param[] = array(":DS_EMAIL",  $this->ds_email);
        $param[] = array(":NU_ORDEM",  $this->nu_ordem);
        $param[] = array(":CO_VINCULO",  $this->co_vinculo);
        $param[] = array(":CO_MUNICIPIO_IBGE",  $this->co_municipio_ibge);
        $param[] = array(":NU_DDD",  $this->nu_ddd);
        $param[] = array(":NU_DDD_CELULAR",  $this->nu_ddd_celular);
        $param[] = array(":NU_DDD2",  $this->nu_ddd2);
        $param[] = array(":CO_ESTADO_CIVIL",  $this->co_estado_civil);
        $param[] = array(":NU_IES",  $this->nu_ies);
        $param[] = array(":CO_TIPO_DURACAO",  $this->co_tipo_duracao);
        $param[] = array(":CO_ESCOLARIDADE",  $this->co_escolaridade);
        $param[] = array(":CO_CURSO",  $this->co_curso);
        $param[] = array(":CO_SEGMENTO",  $this->co_segmento);
        $param[] = array(":NU_ANO",  $this->nu_ano);
        $param[] = array(":CO_OCUPACAO",  $this->co_ocupacao);
        $param[] = array(":CO_TIPO_GESTAO",  $this->co_tipo_gestao);
        $param[] = array(":NU_CNES",  $this->nu_cnes);
        $param[] = array(":NU_SERIE",  $this->nu_serie);
        $param[] = array(":CO_ALUNO", $this->co_aluno);
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
       
    public function listarParticipantes(){
        $sql = "select al.co_seq_aluno,
                   al.no_aluno,
                   al.nu_cpf,
                   vl.ds_vinculo
                   from dbpolo.tb_aluno  al
                   join dbpolo.tb_vinculo vl on vl.co_vinculo = al.co_vinculo
                   where nu_serie = :NU_SIPAR
                   and nu_cpf = :NU_CPF";
        $param = array();
        $param[] = array(':NU_CPF', $this->nu_cpf);
        $param[] = array(':NO_PESSOA', $this->no_aluno);
        $param[] = array(':NU_SIPAR', $this->nu_serie);
        $res = parent::queryDql($sql, $param);
        if(isset($res[0][0]) && $res[0][0] != ''){
            return $res;
        }else{
            $sql = "select al.co_seq_aluno,
                   al.no_aluno,
                   al.nu_cpf,
                   vl.ds_vinculo
                   from dbpolo.tb_aluno  al
                   join dbpolo.tb_vinculo vl on vl.co_vinculo = al.co_vinculo
                   where nu_serie = :NU_SIPAR
                   and al.no_aluno like '%$this->no_aluno%' ";
            $res = parent::queryDql($sql, $param);
            if(isset($res[0][0]) && $res[0][0] != ''){
                return $res;
            }else{
                return false;
            }
        }
        
    }
    
    public function localizarParticipante(){
        $sql = "select co_seq_aluno from dbpolo.tb_aluno where nu_cpf = :NU_CPF";
        $param = array();
        $param[] = array(":NU_CPF",  $this->nu_cpf);
        $res = parent::queryDql($sql, $param);
        if(isset($res[0][0]) && $res[0][0] != ""){
            return true;
        }else{
            parent::closeConnection();
            return false;
        }
    }
    
    public function localizarTipoParticipante(){
        $sql = "select * from dbpolo.tb_vinculo where co_vinculo in (9,10,11,12,13,14) order by co_vinculo";
        $res = parent::queryDql($sql);
        if(isset($res[0][0]) && $res[0][0] != ""){
            return $res;
        }else{
            parent::closeConnection();
            return false;
        }
    }
    
    public function localizarAgenciaBB(){
        $sql = "select co_agencia
                from dbgeral.tb_agencia
                where co_banco = '001'
                and st_registro_ativo = 'S'
                order by co_agencia";
        $res = parent::queryDql($sql);
        if(isset($res[0][0]) && $res[0][0] != ""){
            return $res;
        }else{
            parent::closeConnection();
            return false;
        }
    }
       
    /* inserido por Jaime - Verifica o curso de graduação do participante*/
    
    public function localizarCursoGraduacao(){
        $sql = "Select co_seq_curso,ds_curso from dbpolo.tb_curso order by ds_curso";
        $res = parent::queryDql($sql);
        if(isset($res[0][0]) && $res[0][0] != ""){
            return $res;
        }else{
            parent::closeConnection();
            return false;
        }
    }
    public function localizarAno(){
        $sql = "Select nu_ano from dbpolo.tb_ano order by nu_ano";
        $res = parent::queryDql($sql);
        if(isset($res[0][0]) && $res[0][0] != ""){
            return $res;
        }else{
            parent::closeConnection();
            return false;
        }
    }
    
    public function localizarSemestres(){
        $sql = "select *
                from dbpolo.tb_segmento
                where co_seq_segmento >= 9
                order by co_seq_segmento";
        $res = parent::queryDql($sql);
        if(isset($res[0][0]) && $res[0][0] != ""){
            return $res;
        }else{
            parent::closeConnection();
            return false;
        }
    }
    
    public function localizarProUni(){
        $sql = "Select co_certidao, no_certidao
                from dbpolo.tb_tipo_certidao
                order by co_certidao
                ";
        $res = parent::queryDql($sql);
        if(isset($res[0][0]) && $res[0][0] != ""){
            return $res;
        }else{
            parent::closeConnection();
            return false;
        }
    }
    
    public function localizarTipoProfissional(){
        $sql = "select co_cbo_ocupacao, DS_CBO_OCUPACAO
                from dbgeral.tb_cbo_ocupacao
                where co_cbo_ocupacao in ('XXX',
                                        '221205',
                                        '221105',
                                        '223810',
                                        '251605',
                                        '223208',
                                        '223505',
                                        '223405',
                                        '223605',
                                        '223115',
                                        '223305',
                                        '223710',
                                        '234410',
                                        '251510',
                                        '223620',
                                        '211115',
                                        '211205',
                                        '251120',
                                        '239415',
                                        '251105',
                                        '234740',
                                        '234745',
                                        '241005',
                                        '252105',
                                        '222205')
                order by DS_CBO_OCUPACAO";
        $res = parent::queryDql($sql);
        if(isset($res[0][0]) && $res[0][0] != ""){
            return $res;
        }else{
            parent::closeConnection();
            return false;
        }
    }
    
    public function localizarTitulacao(){
        $sql = "select co_escolaridade, ds_escolaridade
                from dbgeral.tb_escolaridade
                where co_escolaridade in ('09', '10', '11', '12')
                order by co_escolaridade";
        $res = parent::queryDql($sql);
        if(isset($res[0][0]) && $res[0][0] != ""){
            return $res;
        }else{
            parent::closeConnection();
            return false;
        }
    }
    
    public function localizarCargaHoraria(){
        $sql = "select co_seq_tipo_duracao, ds_tipo_duracao
                from dbpolo.tb_tipo_duracao
                where co_seq_tipo_duracao >= 5
                order by co_seq_tipo_duracao";
        $res = parent::queryDql($sql);
        if(isset($res[0][0]) && $res[0][0] != ""){
            return $res;
        }else{
            parent::closeConnection();
            return false;
        }
    }
    
    public function localizarEstadoCivil(){
        $sql = "select *
                from dbgeral.tb_estado_civil
                where co_estado_civil not in (07, 99)
                order by ds_estado_civil";
        $res = parent::queryDql($sql);
        if(isset($res[0][0]) && $res[0][0] != ""){
            return $res;
        }else{
            parent::closeConnection();
            return false;
        }
    }
    
    public function localizarCursos(){
        $sql = "select *
                from dbpolo.tb_curso
                where co_seq_curso in ('12',
                                        '10',
                                        '7',
                                        '1',
                                        '3',
                                        '4',
                                        '14',
                                        '8',
                                        '13',
                                        '2',
                                        '6',
                                        '5',
                                        '9',
                                        '11')";
        $res = parent::queryDql($sql);
        if(isset($res[0][0]) && $res[0][0] != ""){
            return $res;
        }else{
            parent::closeConnection();
            return false;
        }
    }
    
    public function localizarTipoIdentidade(){
        $sql = "select co_orgao_emissor,
                    ds_orgao_emissor,
                    sg_orgao_emissor
                from dbgeral.tb_orgao_emissor";
        $res = parent::queryDql($sql);
        if(isset($res[0][0]) && $res[0][0] != ""){
            return $res;
        }else{
            parent::closeConnection();
            return false;
        }
    }
    
}
?>
