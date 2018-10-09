<?php

class Acesso extends ConexaoPOLO{    
    private $coSeqAcesso,$coPessoa,$nuCpf,$dsSenha,$stAcesso,$dtUltAcesso,$dsCodConf,$stConf;
    private $noPessoa,$dsEmail,$coTipoPessoa,$stPessoa;    
	
    public function __construct() {
    }
       
    public function getCoSeqPessoa() { return $this->coSeqAcesso; }
    public function getCoPessoa() { return $this->coPessoa; }
    public function getNoPessoa() { return $this->noPessoa; }
    public function getDsEmail() { return $this->dsEmail; }
    public function getNuCpf() { return $this->nuCpf; }
    public function getDsSenha() { return $this->dsSenha; }
    public function getStAcesso() { return $this->stAcesso; }
    public function getDtUltAcesso() { return $this->dtUltAcesso; }
    public function getDsCodConf() { return $this->dsCodConf; }
    public function getStConf() { return $this->stConf; }
    
    public function setCpf        ($value){$this->nuCpf = $value;}
    
    public function localizarAcesso() {
        $sql = "SELECT 
                    CO_SEQ_ACESSO,
                    CO_PESSOA,
                    DS_SENHA,
                    ST_ACESSO,
                    DT_ULT_ACESSO,
                    DS_COD_CONF,
                    ST_CONF,
                    ST_PESSOA,
                    CO_TIPO_PESSOA,
                    NO_PESSOA,
                    DS_EMAIL
                FROM 
                    dbsgtes.tb_fmed_acesso a
                    JOIN dbsgtes.tb_fmed_pessoa p on p.co_seq_pessoa = a.co_pessoa
                WHERE
                    p.nu_cpf_cnpj_pessoa = :CPF";
        $param = array();
        $param[] = array(":CPF", $this->nuCpf);
        $ac = parent::queryDql($sql, $param);
	if (isset($ac[0][0]) && $ac[0][0] != ""){		    
            $this->coSeqAcesso = $ac[0]["CO_SEQ_ACESSO"];
            $this->coPessoa = $ac[0]["CO_PESSOA"];
            $this->dsSenha = $ac[0]["DS_SENHA"];
            $this->stAcesso = $ac[0]["ST_ACESSO"];
            $this->dtUltAcesso = $ac[0]["DT_ULT_ACESSO"];
            $this->dsCodConf = $ac[0]["DS_COD_CONF"];
            $this->stConf = $ac[0]["ST_CONF"];
            $this->stPessoa = $ac[0]["ST_PESSOA"];
            $this->coTipoPessoa = $ac[0]["CO_TIPO_PESSOA"];
            $this->noPessoa = $ac[0]["NO_PESSOA"];
            $this->dsEmail = $ac[0]["DS_EMAIL"];
            return true;
        }
        else{
            return false;
        }	
    }	

    public function criarAcesso($coPessoa,$dsSenha) { 
        $sql = "
            INSERT INTO dbsgtes.tb_fmed_acesso a
                (CO_SEQ_ACESSO,CO_PESSOA,DS_SENHA,ST_ACESSO,DT_ULT_ACESSO,DS_COD_CONF,ST_CONF)
            VALUES 
                (
                (SELECT CASE WHEN MAX(CO_SEQ_ACESSO) IS NULL THEN 1 ELSE MAX(CO_SEQ_ACESSO)+1 END FROM dbsgtes.tb_fmed_acesso),
                :COPESSOA,:DSSENHA,1,NULL,:DSCODCONF,'N'
                )";
        $param = array();
        $param[] = array(':COPESSOA', $coPessoa);        
        $param[] = array(':DSSENHA', encriptar_senha($dsSenha));
        $param[] = array(':DSCODCONF', gerar_hash());
        $result = true;                
        try{
            parent::queryDml($sql, $param);
        }  catch (Exception $e){
            $result = false;
            parent::closeConnection();
            throw new Exception("Erro na execução: ".$e->getMessage());
        }
        return $result;        
    }        
            
    public function atualizarDtUltAcesso() {
        $sql = "
            UPDATE
                dbsgtes.tb_fmed_acesso a
            SET
                DT_ULT_ACESSO = SYSDATE
            WHERE
                CO_SEQ_ACESSO = :COSEQACESSO
        ";        
        $param = array();
        $param[] = array(':COSEQACESSO', $this->coSeqAcesso);        
        $result = true;                
        try{
            parent::queryDml($sql, $param);
        }  catch (Exception $e){
            $result = false;
            parent::closeConnection();
            throw new Exception("Erro na execução: ".$e->getMessage());
        }
        return $result;        
    }
   
    public function confirmaEmail() { 
        $sql = "
            UPDATE
                dbsgtes.tb_fmed_acesso a
            SET
                ST_CONF = 'S',
                DS_COD_CONF = NULL
            WHERE
                CO_SEQ_ACESSO = :COSEQACESSO
        ";        
        $param = array();
        $param[] = array(':COSEQACESSO', $this->coSeqAcesso);        
        $result = true;                
        try{
            parent::queryDml($sql, $param);
        }  catch (Exception $e){
            $result = false;
            parent::closeConnection();
            throw new Exception("Erro na execução: ".$e->getMessage());
        }
        return $result;        
    }    
    
    public function confirmaInscricao(){
        $Email = new PHPMailer();
        $Email->SetLanguage("br");
        $Email->IsSMTP();
        $Email->From        = "no-reply@saude.gov.br";
        $Email->FromName    = utf8_decode("Sistema de Abatimento FIESMed");
        $Email->AddReplyTo("no-reply@saude.gov.br","Sistema de Abatimento FIESMed");
        $Email->Subject     = utf8_decode("Confirmação da Inscrição no Sistema de Abatimento FIESMed");
        $Email->IsHTML(true);
        $Email->CharSet     = 'iso-8859-1';
        $Email->AddAddress($this->dsEmail); 
        $Email->Body        = '
                <html>
                Para confirmar seu cadastro no Sistema de Abatimento FIESMed, confirme este e-mail acessando o endereço abaixo:<BR>
                http://srvdf048/fiesmed/confirmacao_email.php?cpf='.$this->nuCpf.'&cod='.$this->dsCodConf.'<BR>
                </html>';      
        $Email->Send();
    }    
    
}

?>