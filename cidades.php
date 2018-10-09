<?php
        include "class/Domain/conf.php";

        $sg_uf = $_GET['estado'];
                
        $municipios = new DadosMunicipio();
        $municipios->setUf($sg_uf);
        $cidades    = $municipios->carregarMunicipios();
            
            echo "<option></option>";
        foreach($cidades as $cidade){
            echo "<option value='".$cidade['CO_MUNICIPIO_IBGE']."'>".$cidade['NO_MUNICIPIO']."</option>";
        }
?>
