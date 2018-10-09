<?php
        include "class/Domain/conf.php";
        include "class/JSON.php";
        
        $cnpj = $_GET['cnpj'];
        
        $json = new Services_JSON;
                        
        $municipios = new DadosMunicipio();
        $municipios->setCnpj($cnpj);
        $ins = $municipios->carregaInstituicoes();
        
        $instituicao = array();
        if(isset($ins) && $ins[0][0] != ""){
            $instituicao['NO_INSTITUICAO']  = $ins[0]['NO_PESSOA'];
            $instituicao['resultado']       = 1;
            echo "var resultadoCNPJ = ".$json->encode($instituicao);
        }else{
            $instituicao['NO_INSTITUICAO']  = "";
            $instituicao['resultado']       = 0;
            echo "var resultadoCNPJ = ".$json->encode($instituicao);
        }
        
?>