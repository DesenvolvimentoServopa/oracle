<?php
//chamando os bancos
include 'header.php';

include '../config/conexaoSmart.php';

include '../config/sqlSmart.php';

include '../config/conexaoSmartSelbetti.php';

$emp .= " WHERE e.id_empresa = " . $_GET['id_empresa'] . "";

$resultpes = ociparse($conn, $emp);
ociexecute($resultpes);

$rowemp = oci_fetch_array($resultpes, OCI_BOTH);

$consorcio = ($rowemp['CONSORCIO'] == 'S') ? 'SIM' : 'NÃO';

$situacao = ($rowemp['SITUACAO'] == 'A') ? 'ATIVO' : 'DESATIVADO';

$valueApollo = ($rowemp['EMPRESA_APOLLO'] == 0) ? '' : $rowemp['EMPRESA_APOLLO'];

$valueRevApollo = ($rowemp['REVENDA_APOLLO'] == 0) ? '' : $rowemp['REVENDA_APOLLO'];

$valueEmpNbs = ($rowemp['EMPRESA_NBS'] == 0) ? '' : $rowemp['EMPRESA_NBS'];




switch ($rowemp['SISTEMA']) {
    case "A":
        $sistema = "APOLLO";
        break;
    case "N":
        $sistema = "BANCO NBS";
        break;
    case "H":
        $sistema = "BANCO HARLEY";
        break;
    case " ":
        $sistema = "EMPRESA QUE NÃO USA SISTEMA ERP";
        break;
    case "0":
        $sistema = "EMPRESA QUE NÃO USA SISTEMA ERP";
        break;
}

if ($_GET['id_empresa'] != null) {

    echo '
<!-- INICIO DO CONTEUDO DA PÁGINA -->
<div class="container">

    <!-- Page Cabeçalho -->
    <title>Editar Regra Empresa</title>
    <h1 class="text-xs mb-6 text-gray-800" style="margin-left: 109px;">             
        <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
        <a href="smartshare.php?id_usuario=' . $_GET['id_usuario'] . '"><i class="fas fa-list"></i> BPMServopa</a> /
        <i class="fas fa-user-plus"></i> Editar Regra Empresa
    </h1>

    <div class="text-center">
        <h1 class="h3 mb-4 text-gray-800">EDITAR REGRA EMPRESA</h1>
    </div>


    <div class="col-lg-6" style="margin-left: 25%;">  

        <form id="editemp" name="editemp" method="POST" action="../bd/editemp.php?id_empresa=' . $_GET['id_empresa'] . '&id_usuario=' . $_GET['id_usuario'] . '">
            <div> 
                <input style="display:none" name="id" value="3"/>  
            </div> 

            <!-- INICIO INPUT EMPRESA -->
            <div class="form-group">
                <label for="empresa">EMPRESA:
                    <span>
                        <a href="javascript:" title="Campo obrigatório" style="color:red;">
                            <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <input type="text" class="form-control" value="' . $rowemp['NOME_EMPRESA'] . '" name="empresa" id="empresa" placeholder=" INSIRA NOVA EMPRESA" disabled>    
            </div>
            <!-- FIM INPUT EMPRESA -->

            <!-- INICIO DROP SISTEMA -->
            <div class="form-group">
                <label for="sistema" >SISTEMA:
                    <span>
                        <a href="javascript:" title="Campo obrigatório" style="color:red;">
                            <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <select class="form-control" onchange="camposObrigatorios()" placeholder="Sistema" name="sistema" type="text" id="sistema" required> 
                    <option value="' . $rowemp['SISTEMA'] . '" selected>' . $sistema . '</option>
                    <option>------------------</option>        
                    <option value="A">APOLLO</option>
                    <option value="N">BANCO NBS</option>
                    <option value="H">BANCO HARLEY</option>  
                    <option value="0">EMPRESA QUE NÃO USA SISTEMA ERP</option>        
                </select>
            </div>
            <!-- FIM DROP EMPRESA -->

            <!-- INICIO INPUT EMPRESA APOLLO -->
            <div class="form-group" id="empresaApollo">
                <label for="empApollo">EMPRESA APOLLO:
                    <span>
                        <a href="javascript:" title="Campo Obrigatório">
                            <i class="fas fa-asterisk" style="margin-left: 35%;color: red;font-size: 8px;"></i>
                        </a>
                    </span>
                </label>    
                <input type="text" class="form-control" onkeypress="onlynumber()" value="' . $valueApollo . '" maxlength="2" name="empApollo" id="empApollo" placeholder=" INSIRA EMPRESA APOLLO">  
            </div>
            <!-- FIM INPUT EMPRESA APOLLO -->

            <!-- INICIO INPUT REVENDA APOLLO -->
            <div class="form-group" id="revendaApollo">
                <label for="revApollo">REVENDA APOLLO:
                    <span>
                        <a href="javascript:" title="Campo Obrigatório"<i class="fas fa-asterisk" style="margin-left: 35%;color: red;font-size: 8px;"></i></a>
                    </span>
                </label>    
                <input type="text" class="form-control" onkeypress="onlynumber()" value="' . $valueRevApollo . '" maxlength="2" name="revApollo" id="revApollo" placeholder=" INSIRA REVENDA APOLLO">    
            </div>
            <!-- FIM INPUT REVENDA APOLLO -->

            <!-- INICIO INPUT EMPRESA NBS -->
            <div class="form-group" id="empresaNbs">
                <label for="empnbs">EMPRESA NBS:
                    <span>
                        <a href="javascript:" title="Campo Obrigatório"<i class="fas fa-asterisk" style="margin-left: 35%;color: red;font-size: 8px;"></i></a>
                    </span>
                </label>
                <input type="text" class="form-control" onkeypress="onlynumber()" value="' . $valueEmpNbs . '" maxlength="2" name="empnbs" id="empnbs" placeholder=" INSIRA EMPRESA NBS"> 
            </div>
            <!-- FIM INPUT EMPRESA NBS -->

            <!-- INICIO INPUT ORGANOGRAMA SENIOR -->
            <div class="form-group">
                <label for="orgsenior">ORGANOGRAMA SENIOR:
                    <span>
                        <a href="javascript:" title="Verificar informação com a Celina" style="color:red;">
                            <i class="fas fa-question-circle" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>       
                <input type="text" class="form-control" onkeypress="onlynumber()" value="' . $rowemp['ORGANOGRAMA_SENIOR'] . '" maxlength="2" name="orgsenior" id="orgsenior" placeholder=" INSIRA ORGANOGRAMA SENIOR" required>    
            </div>
            <!-- FIM INPUT ORGANOGRAMA SENIOR -->

            <!-- INICIO INPUT EMPRESA SENIOR -->
            <div class="form-group">
                <label for="empresasenior">EMPRESA SENIOR:
                    <span>
                        <a href="javascript:" title="Verificar informação com a Celina" style="color:red;">
                            <i class="fas fa-question-circle" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <input type="text" class="form-control" onkeypress="onlynumber()" value="' . $rowemp['EMPRESA_SENIOR'] . '" maxlength="2" name="empresasenior" id="empresasenior" placeholder=" INSIRA EMPRESA SENIOR" required>    
            </div>
            <!-- FIM INPUT EMPRESA SENIOR -->

            <!-- INICIO INPUT FILIAL SENIOR -->
            <div class="form-group">
                <label for="filialsenior">FILIAL SENIOR:
                    <span>
                        <a href="javascript:" title="Verificar informação com a Celina" style="color:red;">
                            <i class="fas fa-question-circle" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <input type="text" class="form-control" onkeypress="onlynumber()" value="' . $rowemp['FILIAL_SENIOR'] . '" maxlength="2" name="filialsenior" id="filialsenior" placeholder=" INSIRA FILIAL SENIOR" required>
            </div>
            <!-- FIM INPUT FILIAL SENIOR -->

            <!-- INICIO DROP CONSORCIO -->
            <div class="form-group">
                <label for="consorcio">CONSÓRCIO:
                    <span>
                        <a href="javascript:" title="Campo obrigatório" style="color:red;">
                            <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>       
                <select class="form-control" placeholder="Consórcio" name="consorcio" id="consorcio" required>
                    <option value="' . $rowemp['CONSORCIO'] . '" selected>' . $consorcio . '</option>
                    <option>------------------</option>  
                    <option value="S">SIM</option>
                    <option value="N">NÃO</option>
                </select>
            </div>
            <!-- FIM DROP CONSORCIO -->

            <!-- INICIO DROP SITUAÇÃO -->
            <div class="form-group">
                <label for="situacao">SITUAÇÃO:
                    <span>
                        <a href="javascript:" title="Campo obrigatório" style="color:red;">
                            <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>     
                <select class="form-control" placeholder="Situação" name="situacao" type="text" id="situacao" required> 
                    <option value="' . $rowemp['SITUACAO'] . '" selected>' . $situacao . '</option>   
                    <option>------------------</option>   
                    <option value="A">ATIVO</option>
                    <option value="D">DESATIVADO</option>
                </select>
            </div>
            <!-- FIM DROP SITUAÇÃO -->
            
            <!-- UF DA EMPRESA -->
            <div class="form-group">
                <label for="marca">UF
                    <span>
                        <a href="javascript:" title="Campo obrigatório" style="color:red;">
                            <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <select class="form-control" style="width:20%" placeholder="UF" name="estado" type="text" id="estado" required >
                    <option value="' . $rowemp['UF_GESTAO'] . '" selected>' . $rowemp['UF_GESTAO'] . '</option>     
                    <option value="">------------</option>
                    <option value="AC">AC</option>
                    <option value="AL">AL</option>
                    <option value="AP">AP</option>
                    <option value="AM">AM</option>
                    <option value="BA">BA</option>
                    <option value="CE">CE</option>
                    <option value="DF">DF</option>
                    <option value="ES">ES</option>
                    <option value="GO">GO</option>
                    <option value="MA">MA</option>
                    <option value="MT">MT</option>
                    <option value="MS">MS</option>
                    <option value="MG">MG</option>
                    <option value="PA">PA</option>
                    <option value="PB">PB</option>
                    <option value="PR">PR</option>
                    <option value="PE">PE</option>
                    <option value="PI">PI</option>
                    <option value="RJ">RJ</option>
                    <option value="RN">RN</option>
                    <option value="RS">RS</option>
                    <option value="RO">RO</option>
                    <option value="RR">RR</option>
                    <option value="SC">SC</option>
                    <option value="SP">SP</option>
                    <option value="SE">SE</option>
                    <option value="TO">TO</option>
                    <option value="EX">EX</option>
                </select>
            </div>
            <!-- fim -->

            <!-- INICIO NUMERO CAIXA -->
            <div class="form-group">
                <label for="numero_caixa">NÚMERO CAIXA:</label>
                <input type="text" class="form-control" onblur="aprovador()" onkeypress="onlynumber()" value="' . $rowemp['NUMERO_CAIXA'] . '" maxlength="5" name="numero_caixa" id="numero_caixa" style="width: 20%">
            </div>
            <!-- FIM NUMERO CAIXA -->

            <!-- INICIO NOME AP CAIXA -->
            <div class="form-group" style="display: ';
                echo empty($rowemp['NUMERO_CAIXA']) ? 'none' : 'block'; echo ';" id="liberarApro">
                <label for="marca">APROVADOR CAIXA:</label>
                <select class="form-control" placeholder="Situação" name="aproCaixa" type="text" id="aproCaixa">';
                    if(empty($rowemp['APROVADOR_CAIXA'])){
                        echo '<option>------------------</option>';
                    }else{
                        echo '
                        <option value="'.$rowemp['APROVADOR_CAIXA'].'">'.$rowemp['APROVADOR_CAIXA'].'</option>
                        <option>------------------</option>';
                    }
                    $queryUserApi .= " ORDER BY ds_usuario ASC";
                    $resultadoUsuario = oci_parse($conns, $queryUserApi);
                    oci_execute($resultadoUsuario);
                    
                    while(($usuario = oci_fetch_array($resultadoUsuario, OCI_BOTH)) != false) {
                        echo '<option value="'.$usuario['DS_LOGIN'].'">'.$usuario['DS_USUARIO'].' / '.$usuario['DS_LOGIN'].'</option>';
                    }
                    echo '
                </select>
            </div>
            <!-- FIM  NOME AP CAIXA -->

            <!--LOCALIZANDO USUARIO-->
            <script>
                function aprovador(){
                    var tela = document.getElementById("liberarApro").style.display;

                    if (tela == "none") {
                        document.getElementById("liberarApro").style.display = "block";
                        document.getElementById("aproCaixa").required = true;
                    } else {
                        document.getElementById("liberarApro").style.display = "none";
                        document.getElementById("aproCaixa").required = false;
                    }
                }
            </script>
            <script> 
                function buscanome(){
                    document.getElementById("editemp").action = "../bd/buscarAprovadorEmp.php?id_empresa='.$_GET['id_empresa'].'&id_usuario='.$_GET['id_usuario'].'&acao=1";
                    document.getElementById("editemp").submit();
                }
            </script>

            <!-- BOTÃO SALVAR -->
            <button class="btn btn-success" name="salvar" type="submit">Salvar</button>
            <a class="btn btn-danger" href="smartshare_pag.php?id_drop=1&id_usuario=' . $_GET['id_usuario'] . '">Voltar</a>
            <!-- BOTÃO SALVAR -->

            <script>
                function camposObrigatorios() {
                    var value = document.getElementById("sistema").value

                    if(value == "A") {                    
                        document.getElementById("empresaNbs").style.display = "none";
                        document.getElementById("empnbs").value = "";                     
                        document.getElementById("empresaApollo").style.display = "block";
                        document.getElementById("revendaApollo").style.display = "block";  
                        
                    }else{
                        document.getElementById("empresaNbs").style.display = "block";
                        document.getElementById("empresaApollo").style.display = "none";
                        document.getElementById("revendaApollo").style.display = "none";
                        document.getElementById("empApollo").value = ""; 
                        document.getElementById("revApollo").value = "";              
                    }
                }                
            </script>

        </form>
    </div>
</div>';
} else {
    echo '^';
}

include 'footer.php'
?>