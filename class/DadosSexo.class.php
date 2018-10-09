<?php

class Sexo extends ConexaoPOLO{
    
    public function __construct() {  }
    
    public function carregaSexo(){
        $sql = "select *
                from dbgeral.tb_sexo
                where co_sexo = 'M' or co_sexo = 'F'
                order by co_sexo desc
                ";
        $res = parent::queryDql($sql);
        if($res[0][0] != "" && isset($res[0][0])){
            return $res;
        }else{
            return false;
        }
    }
    
}

?>
