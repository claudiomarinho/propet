<?php
include "class/Domain/conf.php";
include "class/JSON.php";

/* BUSCA DADOS DA PESSOA ATRAVES DO CPF */
if (isset($_GET['cpf']) && $_GET['cpf'] != "") {

    $cpf = $_GET['cpf'];
    $cpfn = str_pad(ereg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);

    $pessoa = new DadosCPF;
    $ps = $pessoa->localizarCPF($cpfn);
    
    //__visArray(array_filter($ps));
    
    //$ps = array_filter($ps);
    
    $json = new Services_JSON;
    if (isset($ps) && $ps[0][0] != "") {
        $ps['resultado'] = 1;
        echo utf8_encode("var resultadoCPF = " . $json->encode($ps));
    } else {
        $ps['resultado'] = 0;
        echo utf8_encode("var resultadoCPF = " . $json->encode($ps));
    }
}
/* BUSCA DADOS DA PESSOA JURIDICA ATRAVES DO CNPJ */
elseif(isset($_GET['cnpj']) && $_GET['cnpj'] != ""){
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
}elseif(isset($_GET['uf']) && $_GET['uf'] != '' ){
        $sg_uf = $_GET['uf'];
                
        $municipios = new DadosMunicipio();
        $municipios->setUf($sg_uf);
        $cidades    = $municipios->carregarMunicipios();
            
        echo "<option>Selecione o Munic&iacute;pio</option>";
        foreach($cidades as $cidade){
            echo "<option value='".$cidade['CO_MUNICIPIO_IBGE']."'>".$cidade['NO_MUNICIPIO']."</option>";
        }
}

?>
