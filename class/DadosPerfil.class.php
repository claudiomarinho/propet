<?php

class DadosPerfil extends ConexaoPOLO{
    
    public function __construct() {
        
    }
    
    public function listarPerfil(){
        $sql ="
            select co_seq_perfil, ds_perfil
            from dbpolo.tb_perfil
            where co_seq_perfil in (10, 12, 16)
            order by 2
            ";
        $res = parent::queryDql($sql);
        if(isset($res[0][0]) && $res[0][0] != ""){
            return $res;
        }else{
            return false;
        }
    }
    
}

?>
