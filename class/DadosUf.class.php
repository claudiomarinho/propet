<?php

class DadosUf extends ConexaoPOLO{
    
    public function carregarUf(){
        
        $sql = "select co_regiao, sg_uf from dbgeral.tb_uf
                where co_regiao is not null
                order by sg_uf asc";
        $res = parent::queryDql($sql);
        if($res){
            return $res;
        }else{
            return false;
        }
    }
    
}

?>
