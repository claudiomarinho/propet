<?php

class DbPOLO {

    // Desenvolvimento e Homologação 
    /*
    private $tipoBanco = "OCI";
    private $db = "DFDO1";
    private $host = "srvoradf2.saude.gov";
    private $usuario = "POLOWEB";
    private $senhaBanco = "poloweb";
    private $role = "set role ro_polo_t identified by POLOWEBdfdo1";
    
  */
    
    // Producao
    
      private $tipoBanco    = "OCI";
      private $db           = "DFPO1";
      private $host         = "srvoradf2.saude.gov";
      private $usuario      = "POLOWEB";
      private $senhaBanco   = "POLOWEB7462310";
      private $role	    = "set role ro_polo_t identified by POLOWEBdfpop1";
     

     
    public function SetTipoBanco($Valor) {
        $this->tipoBanco = $Valor;
    }

    public function SetDb($Valor) {
        $this->db = $Valor;
    }

    public function SetHost($Valor) {
        $this->host = $Valor;
    }

    public function SetUsuario($Valor) {
        $this->usuario = $Valor;
    }

    public function SetSenhaBanco($Valor) {
        $this->senhaBanco = $Valor;
    }

    public function SetRole($Valor) {
        $this->role = $Valor;
    }

    /*   Getters   */

    public function GetTipoBanco() {
        return $this->tipoBanco;
    }

    public function GetDb() {
        return $this->db;
    }

    public function GetHost() {
        return $this->host;
    }

    public function GetUsuario() {
        return $this->usuario;
    }

    public function GetSenhaBanco() {
        return $this->senhaBanco;
    }

    public function GetRole() {
        return $this->role;
    }

}

?>