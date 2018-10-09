<?php
        include "class/Domain/conf.php";
        include "class/JSON.php";
        
        if(isset($_GET['estado']) && $_GET['estado'] != ""){
            
        $sg_uf = $_GET['estado'];
                
        $municipios = new DadosMunicipio();
        $municipios->setUf($sg_uf);
        $cidades    = $municipios->carregarMunicipios();
            
        echo "<option value=''>Selecione o munic&iacute;pio</option>";
        foreach($cidades as $cidade){
            echo "<option value='".$cidade['CO_MUNICIPIO_IBGE']."'>".$cidade['NO_MUNICIPIO']."</option>";
        }
        
        }elseif(isset($_GET['cnpj']) && $_GET['cnpj'] != ""){
               
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
        
        }elseif(isset($_GET['cpf']) && $_GET['cpf'] != ""){
            
        $cpf = $_GET['cpf'];
        $cpfn = str_pad(ereg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);

        $pessoa = new DadosCPF;
        $ps     = $pessoa->localizarCPF($cpfn);

        $json = new Services_JSON;
        if(isset($ps) && $ps[0][0] != "")
        {
            $ps['resultado'] = 1;
            echo "var resultadoCPF = ".$json->encode($ps);
        }else{
            $ps['resultado'] = 0;
        }
        
        }
        
        /* inserido por Jaime - Verifica o curso de graduação do participante*/
        $participante = new Participante;
        
        $pro    = $participante->localizarTipoProfissional();
        $titu   = $participante->localizarTitulacao();
        $ch_sem = $participante->localizarCargaHoraria();
        $vergra = $participante->localizarCursoGraduacao();
        $verano = $participante->localizarAno();

        /*echo "<pre>";
        var_dump($verano);
        echo "</pre>";
        exit;*/

        if(isset($_GET['tp']) && $_GET['tp'] == "11" ){

            echo "<br><br><div style='color:#21668f'><strong>Complemento:</strong></div><br>";
            echo 'Categoria Profissional:<span>*</span><br>
                <select name="CATEGORIA_PS">
                    <option></option>
                ';
                        foreach($pro as $p){
                            echo "<option>".utf8_encode($p['DS_CBO_OCUPACAO'])."</option>";  
                        }
                    echo'        </select><br>';

            echo ' Titula&ccedil;&abreve;o:<span>*</span><br>          
                    <select name="TITULACAO">
                    <option></option>';

                        foreach($titu as $t){
                            echo "<option>".utf8_encode($t['DS_ESCOLARIDADE'])."</option>";  
                        }

                echo '</select><br>';

                echo 'Institui&ccedil;&abreve;o a qual est&aacute; vinculado:<span>*</span><br>
                <input type="text" name="NO_INSTITUICAO" id="NO_INSTITUICAO"><br>';

                echo 'Área de concentração <span>*</span><br>
                        <input type="text" name="AREA_DE_CONCENTRACAO" id="AREA_DE_CONCENTRACAO"></input><br>'; 
                echo 'Matrícula na IES:<span>*</span><br>
                        <input type="text" name="MATRICULA_IES" id="MATRICULA_IES"></input><br>'; 
                echo 'Carga hor&aacute;ria:<span>*</span><br>
                <select name="CH_SEM">
                    <option></option>';

                        foreach($ch_sem as $ch){
                            echo "<option>".utf8_encode($ch['DS_TIPO_DURACAO'])."</option>";  
                        }

                echo '</select><br>';
                exit();

        }elseif(isset($_GET['tp']) && $_GET['tp'] == "10"){
            echo "<br><br><div style='color:#21668f'><strong>Complemento:</strong></div><br>";
            echo 'Categoria Profissional:<span>*</span><br>
                <select name="CATEGORIA_PS">
                <option></option>
                ';
                        foreach($pro as $p){
                            echo "<option>".utf8_encode($p['DS_CBO_OCUPACAO'])."</option>";  
                        }
                    echo'        </select><br>';

            echo ' Titula&ccedil;&abreve;o:<span>*</span><br>          
                    <select name="TITULACAO">
                    <option></option>';

                        foreach($titu as $t){
                            echo "<option>".utf8_encode($t['DS_ESCOLARIDADE'])."</option>";  
                        }

                echo '</select><br>';

                echo 'Institui&ccedil;&abreve;o a qual est&aacute; vinculado:<span>*</span><br>
                <input type="text" name="NO_INSTITUICAO" id="NO_INSTITUICAO"><br>

                Carga hor&aacute;ria:<span>*</span><br>
                <select name="CH_SEM">
                    <option></option>';

                        foreach($ch_sem as $ch){
                            echo "<option>".utf8_encode($ch['DS_TIPO_DURACAO'])."</option>";  
                        }

                echo '</select><br>';
                exit();

                }

                elseif(isset($_GET['tp']) && $_GET['tp'] == "12"){

                echo "<br><br><div style='color:#21668f'><strong>Complemento:</strong></div><br>";
                echo 'Categoria Profissional:<span>*</span><br>
                    <select name="CATEGORIA_PS">
                    <option></option>
                    ';
                        foreach($pro as $p){
                            echo "<option>".utf8_encode($p['DS_CBO_OCUPACAO'])."</option>";  
                        }
                    echo'        </select><br>';

            echo 'Número CNES:<span>*</span><br>
                <input type="text" name="NU_CNES">
                    ';
                    exit();
                }

                    elseif(isset($_GET['tp']) && $_GET['tp'] == "13"){

                echo "<br><br><div style='color:#21668f'><strong>Complemento:</strong></div><br>";
                echo 'Curso de graduação:<span>*</span><br>
                    <select name="CURSO_GRADUACAO">
                    <option></option>
                    ';
                        foreach($vergra as $p){
                            echo "<option value=".utf8_encode($p['DS_CURSO']).">".utf8_encode($p['DS_CURSO'])."</option>";  
                        }
                    echo '</select><br>';

                    echo 'Ano de ingresso:<span>*</span><br>
                    <select name="ANO_INGRESSO">
                    <option></option>
                    ';
                        foreach($verano as $p){
                            echo "<option value=".utf8_encode($p['NU_ANO']).">".utf8_encode($p['NU_ANO'])."</option>";  
                        }
                    echo '</select><br>';

            echo 'Número CNES:<span>*</span><br>
                    <input type="text" name="NU_CNES">
                    ';
                    exit();
        }

        else{

        }
?>
