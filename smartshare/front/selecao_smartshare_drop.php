<?php
session_start();

//chamar o banco
include '../config/conexaoSmart.php';
include '../config/sqlSmart.php';
include '../config/conexaoSmartSelbetti.php';

switch ($_GET['id_drop']) {
    case 1:
        echo '
            <div class="text-center">
                <h2 class="h3 mb-5 text-gray-800"> Empresas</h2>
            </div>';

        //msn informando conforme a resposta do banco
        switch ($_GET['msn']) {
            case 1:
                echo
                '<div class="p-3 mb-2 bg-success text-white" id="msnEmp">Empresa adicionada com Sucesso! 
                            <a href="javascipt:" onclick="displayMsnEmp()">
                                <span>
                                    <i class="far fa-window-close" style="margin-left: 74%; color: white;"></i>
                                </span>
                            </a>
                         </div>';
                break;
            case 2:
                echo
                '<div class="p-3 mb-2 bg-success text-white" id="msnEmp">Empresa editada com Sucesso! 
                            <a href="javascipt:" onclick="displayMsnEmp()">
                                <span>  
                                    <i class="far fa-window-close" style="margin-left: 76%; color: white;"></i>
                                </span>
                            </a>
                         </div>';
                break;
            case 3:
                echo
                '<div class="p-3 mb-2 bg-success text-white" id="msnEmp">Empresa deletada com Sucesso!
                            <a href="javascipt:" onclick="displayMsnEmp()">
                                <span>
                                    <i class="far fa-window-close" style="margin-left: 76%; color: white;"></i>
                                </span>
                            </a>
                         </div>';
                break;
            case 4:
                echo
                '<div class="p-3 mb-2 bg-danger text-white" id="msnEmp">Já existe uma empresa cadastrada com esse nome!
                            <a href="javascipt:" onclick="displayMsnEmp()">
                                <span>
                                    <i class="far fa-window-close" style="margin-left: 63%; color: white;"></i>
                                </span>
                            </a>
                         </div>';
                break;
            case 5:
                echo
                '<div class="p-3 mb-2 bg-danger text-white" id="msnEmp">A empresa selecionada já possui relações em outras telas!
                            <a href="javascipt:" onclick="displayMsnEmp()">
                                <span>
                                    <i class="far fa-window-close" style="margin-left: 58%; color: white;"></i>
                                </span>
                            </a>
                         </div>';
                break;
            case 6:
                echo
                '<div class="p-3 mb-2 bg-danger text-white" id="msnEmp">Gestor Atualizado com sucesso!
                    <a href="javascipt:" onclick="displayMsnEmp()">
                        <span>
                            <i class="far fa-window-close" style="margin-left: 58%; color: white;"></i>
                        </span>
                    </a>
                </div>';
                break;
        }

        //query resultado para tabela empresa
        $resultemp = ociparse($conn, $emp);
        ociexecute($resultemp);

        /* Tabela Empresa */
        echo '
        <div class="card shadow mb-4"> 
            <div class="card-header py-3">
                <a href="novaRegraEmp.php?id_usuario=' . $_GET['id_usuario'] . '" class="float-right btn btn-success" style="margin-left: 1%" title="Nova Regra Empresa">
                    <i class="fas fa-plus"></i>
                </a>
                <a href="../bd/relatorioExcel.php?id_e=3" class="float-right btn btn-success" title="Exportar Excel" target="_blank">
                    <i class="fas fa-file-excel"></i>
                </a>
            </div>        
        <div class="row">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Id Regra</th>
                        <th>Empresa</th>
                        <th>UF</th>
                        <th>Sistema</th>
                        <th>Empresa Apollo</th>
                        <th>Revenda Apollo</th>
                        <th>Empresa NBS</th>
                        <th>Organograma Senior</th>
                        <th>Empresa Senior</th>
                        <th>Filial Senior</th>
                        <th>Consórcio</th>
                        <th>Situação</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>';
        while (($rowemp = oci_fetch_assoc($resultemp)) != FAlSE) {

            switch ($rowemp['SISTEMA']) {
                case 'A':
                    $empresa = 'APOLLO';
                    break;
                case 'N':
                    $empresa = 'BANCO NBS';
                    break;
                case 'H':
                    $empresa = 'BANCO HARLEY';
                    break;
                case ' ';
                    $empresa = 'NÃO USA E.R.P';
                    break;
                case '0';
                    $empresa = 'NÃO USA E.R.P';
                    break;
            }

            $consorcio = ($rowemp['CONSORCIO'] == 'S') ? 'SIM' : 'NÃO';
            $situacao = ($rowemp['SITUACAO'] == 'A') ? 'ATIVO' : 'DESATIVADO';

            echo '<tr>';
            echo '<td>' . $rowemp['ID_EMPRESA'] . '</td>';
            echo '<td>' . $rowemp['NOME_EMPRESA'] . '</td>';
            echo '<td>' . $rowemp['UF_GESTAO'] . '</td>';
            echo '<td>' . $empresa . '</td>';
            echo '<td>' . $rowemp['EMPRESA_APOLLO'] . '</td>';
            echo '<td>' . $rowemp['REVENDA_APOLLO'] . '</td>';
            echo '<td>' . $rowemp['EMPRESA_NBS'] . '</td>';
            echo '<td>' . $rowemp['ORGANOGRAMA_SENIOR'] . '</td>';
            echo '<td>' . $rowemp['EMPRESA_SENIOR'] . '</td>';
            echo '<td>' . $rowemp['FILIAL_SENIOR'] . '</td>';
            echo '<td>' . $consorcio . '</td>';
            echo '<td>' . $situacao . '</td>';
            echo '<td>
                    <a href="editemp.php?id_empresa=' . $rowemp['ID_EMPRESA'] . '&id_usuario=' . $_SESSION['id_usuario'] . '" class="text-success menu rigtIcones">
                        <i class="fas fa-pen" style="margin-left: 1px;"></i>
                    </a>
                    <a href="deletarEmp.php?id=' . $rowemp['ID_EMPRESA'] . '&id_usuario=' . $_SESSION['id_usuario'] . '" class="text-danger rigtIcones" title="Excluir">
                        <i class="fas fa-trash"></i>
                    </a>           
                </td>
                </tr>';
        }

        echo '
                </tbody>
                <tfoot>
                    <tr>
                        <th>Id Regra</th>
                        <th>Empresa</th>
                        <th>UF</th>
                        <th>Sistema</th>
                        <th>Empresa Apollo</th>
                        <th>Revenda Apollo</th>
                        <th>Empresa NBS</th>
                        <th>Organograma Senior</th>
                        <th>Empresa Senior</th>
                        <th>Filial Senior</th>
                        <th>Consórcio</th>                        
                        <th>Situação</th>
                        <th>Ação</th>
                    </tr>
                </tfoot>
            </table>
        </div>       
        
        <script>
            function displayMsnEmp() {
            document.getElementById("msnEmp").style.display = "none";
            }
        </script>       
        
        ';
        break;

    case 2:
        echo '
            <div class="text-center">
                <h2 class="h3 mb-5 text-gray-800"> Departamentos RH</h2>
            </div>';

        //msn informando conforme a resposta do banco
        switch ($_GET['msn']) {
            case 1:
                echo
                '<div class="p-3 mb-2 bg-success text-white" id="msnDpto">Departamento adicionado com Sucesso! 
                            <a href="javascipt:" onclick="displayMsnDpto()">
                                <span>
                                    <i class="far fa-window-close" style="margin-left: 70%; color: white;"></i>
                                </span>
                            </a>
                         </div>';
                break;
            case 2:
                echo
                '<div class="p-3 mb-2 bg-success text-white" id="msnDpto">Departamento editado com Sucesso! 
                            <a href="javascipt:" onclick="displayMsnDpto()">
                                <span>  
                                    <i class="far fa-window-close" style="margin-left: 73%; color: white;"></i>
                                </span>
                            </a>
                         </div>';
                break;
            case 3:
                echo
                '<div class="p-3 mb-2 bg-success text-white" id="msnDpto">Departamento deletado com Sucesso!
                            <a href="javascipt:" onclick="displayMsnDpto()">
                                <span>
                                    <i class="far fa-window-close" style="margin-left: 72%; color: white;"></i>
                                </span>
                            </a>
                         </div>';
                break;
            case 4:
                echo
                '<div class="p-3 mb-2 bg-danger text-white" id="msnDpto">Departamento já cadastrado!
                            <a href="javascipt:" onclick="displayMsnDpto()">
                                <span>
                                    <i class="far fa-window-close" style="margin-left: 78%; color: white;"></i>
                                </span>
                            </a>
                         </div>';
                break;
            case 5:
                echo
                '<div class="p-3 mb-2 bg-danger text-white" id="msnDpto">O departamento selecionado já possui relação em outras telas!
                            <a href="javascipt:" onclick="displayMsnDpto()">
                                <span>
                                    <i class="far fa-window-close" style="margin-left: 55%; color: white;"></i>
                                </span>
                            </a>
                         </div>';
                break;
        }

        //query resultado para tabela empresa
        $resultdeprh = ociparse($conn, $departrh);
        ociexecute($resultdeprh);

        /* Tabela Departamentos RH */
        echo '
        <div class="card shadow mb-4"> 
            <div class="card-header py-3">
                        <a href="novaRegraDep.php?id_usuario=' . $_GET['id_usuario'] . '" class="float-right btn btn-success" style="margin-left: 1%" title="Nova Regra Departamentos RH">
                            <i class="fas fa-plus"></i>
                        </a>
                        <a href="../bd/relatorioExcel.php?id_e=2" class="float-right btn btn-success" title="Exportar Excel" target="_blank">
                            <i class="fas fa-file-excel"></i>
                        </a>
                </div>
            <div class="row">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Id Regra</th>
                        <th>Nome Departamento</th>
                        <th>Situação</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>';
        while (($rowdeprh = oci_fetch_array($resultdeprh, OCI_BOTH)) != FAlSE) {

            if ($rowdeprh['SITUACAO'] == 'A') {
                $situacao = 'ATIVO';
            } else {
                $situacao = 'DESATIVADO';
            }
            echo '<tr>';
            echo '<td>' . $rowdeprh['ID_DEPARTAMENTO'] . '</td>';
            echo '<td>' . $rowdeprh['NOME_DEPARTAMENTO'] . '</td>';
            echo '<td>' . $situacao . '</td>';
            echo '<td>
                    <a href="editDep.php?id=' . $rowdeprh['ID_DEPARTAMENTO'] . '&id_usuario=' . $_SESSION['id_usuario'] . '" class="text-success menu rigtIcones">
                        <i class="fas fa-pen" style="margin-left: 1px;"></i>
                    </a>
                    <a href="deletarDep.php?id=' . $rowdeprh['ID_DEPARTAMENTO'] . '&id_usuario=' . $_SESSION['id_usuario'] . '" class="text-danger rigtIcones" title="Excluir">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
                </tr>';
        }
        echo '
                </tbody>
                <tfoot>
                    <tr>
                        <th>Id Regra</th>
                        <th>Nome Departamento</th>
                        <th>Situação</th>
                        <th>Ação</th>
                    </tr>
                </tfoot>                            
            </table>
        </div> 
        </div>

        <script>
            function displayMsnDpto() {
            document.getElementById("msnDpto").style.display = "none";
            }
        </script>';
        break;

    case 3:
        echo '
            <div class="text-center">
                <h2 class="h3 mb-5 text-gray-800"> Empresa X Departamento RH</h2>
            </div>';

        //msn informando conforme a resposta do banco
        switch ($_GET['msn']) {
            case 1:
                echo
                '<div class="p-3 mb-2 bg-success text-white" id="msnEmpDpto">Regra adicionada com Sucesso! 
                            <a href="javascipt:" onclick="displayMsnEmpDpto()">
                                <span>
                                    <i class="far fa-window-close" style="margin-left: 76%; color: white;"></i>
                                </span>
                            </a>
                         </div>';
                break;
            case 2:
                echo
                '<div class="p-3 mb-2 bg-success text-white" id="msnEmpDpto">Regra editada com Sucesso!
                            <a href="javascipt:" onclick="displayMsnEmpDpto()">
                                <span>  
                                    <i class="far fa-window-close" style="margin-left: 79%; color: white;"></i>
                                </span>
                            </a>
                         </div>';
                break;
            case 3:
                echo
                '<div class="p-3 mb-2 bg-success text-white" id="msnEmpDpto">Regra deletada com Sucesso!
                            <a href="javascipt:" onclick="displayMsnEmpDpto()">
                                <span>
                                    <i class="far fa-window-close" style="margin-left: 78%; color: white;"></i>
                                </span>
                            </a>
                         </div>';
                break;
            case 4:
                echo
                '<div class="p-3 mb-2 bg-danger text-white" id="msnEmpDpto">Já existe uma regra adicionada com a empresa e o departamento informado!
                            <a href="javascipt:" onclick="displayMsnEmpDpto()">
                                <span>
                                    <i class="far fa-window-close" style="margin-left: 46%; color: white;"></i>
                                </span>
                            </a>
                         </div>';
                break;
        }

        /* Empresa X Departamento */
        $resultempdep = ociparse($conn, $empdep);
        ociexecute($resultempdep);
        echo '
        <div class="card shadow mb-4"> 
                <div class="card-header py-3">
                    <a href="novaRegraEmpDep.php?id_usuario=' . $_GET['id_usuario'] . '" class="float-right btn btn-success" style="margin-left: 1%" title="Nova Regra Aprovadores">
                        <i class="fas fa-plus"></i>
                    </a>
                    <a href="../bd/relatorioExcel.php?id_e=4" class="float-right btn btn-success" title="Exportar Excel" target="_blank">
                        <i class="fas fa-file-excel"></i>
                    </a>
                </div>
        <div class="row">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Id Regra</th>
                        <th>Empresa</th>
                        <th>Departamento</th>                        
                        <th>Gerente Aprova</th>
                        <th>Superintendente Aprova</th>
                        <th>Situação</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>';
        while (($rowempdep = oci_fetch_array($resultempdep, OCI_BOTH)) != FAlSE) {

            $situacao = ($rowempdep['SITUACAO'] == 'A') ? 'ATIVO' : 'DESATIVADO';
            $gerAp = ($rowempdep['GERENTE_APROVA'] == 'S') ? 'SIM' : 'NÃO';
            $supAp = ($rowempdep['SUPERINTENDENTE_APROVA'] == 'S') ? 'SIM' : 'NÃO';
            echo '<tr>';
            echo '<td>' . $rowempdep['ID_EMPDEP'] . '</td>';
            echo '<td>' . $rowempdep['NOME_EMPRESA'] . '</td>';
            echo '<td>' . $rowempdep['NOME_DEPARTAMENTO'] . '</td>';
            echo '<td>' . $gerAp . '</td>';
            echo '<td>' . $supAp . '</td>';
            echo '<td>' . $situacao . '</td>';
            echo '<td>
                    <a href="editEmpDep.php?id_empdep=' . $rowempdep['ID_EMPDEP'] . '&id_usuario=' . $_SESSION['id_usuario'] . '" class="text-success menu rigtIcones">
                        <i class="fas fa-pen" style="margin-left: 1px;"></i>
                    </a>
                    <a href="deletarEmpDep.php?id=' . $rowempdep['ID_EMPDEP'] . '&id_usuario=' . $_SESSION['id_usuario'] . '" class="text-danger rigtIcones" title="Excluir">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
                </tr>';
        }
        echo '
                </tbody>
                <tfoot>
                    <tr>
                        <th>Id Regra</th>
                        <th>Empresa</th>
                        <th>Departamento</th>
                        <th>Gerente Aprova</th>
                        <th>Superintendente Aprova</th>
                        <th>Situação</th>
                        <th>Ação</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        </div> 
        <script>
            function displayMsnEmpDpto() {
            document.getElementById("msnEmpDpto").style.display = "none";
            }
        </script>';
        break;

    case 4:
        /* Tabela Aprovadores_RH */
        $resultaprov = ociparse($conn, $aprov);
        ociexecute($resultaprov);

        echo '
            <div class="text-center">
                <h2 class="h3 mb-5 text-gray-800"> Aprovadores</h2>
            </div>';

        //msn informando conforme a resposta do banco
        switch ($_GET['msn']) {
            case 1:
                echo
                '<div class="p-3 mb-2 bg-success text-white" id="msnAprov">Aprovador adicionado com Sucesso!
                            <a href="javascipt:" onclick="displayMsnAprov()">
                                <span>
                                    <i class="far fa-window-close" style="margin-left: 73%; color: white;"></i>
                                </span>
                            </a>
                         </div>';
                break;
            case 2:
                echo
                '<div class="p-3 mb-2 bg-success text-white" id="msnAprov">Aprovador editado com Sucesso!
                            <a href="javascipt:" onclick="displayMsnAprov()">
                                <span>  
                                    <i class="far fa-window-close" style="margin-left: 75%; color: white;"></i>
                                </span>
                            </a>
                         </div>';
                break;
            case 3:
                echo
                '<div class="p-3 mb-2 bg-success text-white" id="msnAprov">Aprovador deletado com Sucesso!
                            <a href="javascipt:" onclick="displayMsnAprov()">
                                <span>
                                    <i class="far fa-window-close" style="margin-left: 74%; color: white;"></i>
                                </span>
                            </a>
                         </div>';
                break;
            case 4:
                echo
                '<div class="p-3 mb-2 bg-danger text-white" id="msnAprov">Já exite uma empresa cadastrada com esse departamento!
                            <a href="javascipt:" onclick="displayMsnAprov()">
                                <span>
                                    <i class="far fa-window-close" style="margin-left: 58%; color: white;"></i>
                                </span>
                            </a>
                         </div>';
                break;
        }

        echo '
            <div class="card shadow mb-4"> 
                <div class="card-header py-3">
                    <a href="novaRegraAp.php?id_usuario=' . $_GET['id_usuario'] . '" class="float-right btn btn-success" style="margin-left: 1%" title="Nova Regra Aprovadores">
                        <i class="fas fa-plus"></i>
                    </a>     
                    <a href="../bd/relatorioExcel.php?id_e=1" class="float-right btn btn-success" title="Exportar Excel" target="_blank">
                        <i class="fas fa-file-excel"></i>
                    </a>
                </div>
                <div class="row">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id Regra</th>
                            <th>Empresa</th>                                         
                            <th>Departamento</th>                        
                            <th>Area</th>
                            <th>Filial</th>
                            <th>Marca</th>                        
                            <th>Gerente Geral</th>
                            <th>Superintendente</th>
                            <th>Situação</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                <tbody>';
        while (($rowaprov = oci_fetch_array($resultaprov, OCI_BOTH)) != FAlSE) {
            if ($rowaprov['SITUACAO'] == 'A') {
                $situacao = 'ATIVO';
            } else {
                $situacao = 'DESATIVADO';
            }
            echo '<tr>';
            echo '<td>' . $rowaprov['ID_APROVADOR'] . '</td>';
            echo '<td>' . $rowaprov['NOME_EMPRESA'] . '</td>';
            echo '<td>' . $rowaprov['NOME_DEPARTAMENTO'] . '</td>';
            echo '<td>' . $rowaprov['APROVADOR_AREA'] . '</td>';
            echo '<td>' . $rowaprov['APROVADOR_FILIAL'] . '</td>';
            echo '<td>' . $rowaprov['APROVADOR_MARCA'] . '</td>';
            echo '<td>' . $rowaprov['APROVADOR_GERENTE'] . '</td>';
            echo '<td>' . $rowaprov['APROVADOR_SUPERINTENDENTE'] . '</td>';
            echo '<td>' . $situacao . '</td>';
            echo '<td>
                    <a href="editAp.php?id_aprovador=' . $rowaprov['ID_APROVADOR'] . '&id_usuario=' . $_SESSION['id_usuario'] . '" class="text-success menu rigtIcones">
                        <i class="fas fa-pen" style="margin-left: 1px;"></i>
                    </a>
                    <a href="deletar.php?id=' . $rowaprov['ID_APROVADOR'] . '&id_usuario=' . $_SESSION['id_usuario'] . '" class="text-danger rigtIcones" title="Excluir">                                                                                            
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
                </tr>';
        }
        echo '
                </tbody>
                <tfoot>
                    <tr>
                        <th>Id Regra</th>
                        <th>Empresa</th>                                        
                        <th>Departamento</th>                        
                        <th>Area</th>
                        <th>Filial</th>
                        <th>Marca</th>                        
                        <th>Gerente Geral</th>
                        <th>Superintendente</th>
                        <th>Situação</th>
                        <th>Ação</th>
                    </tr>
                </tfoot>                            
            </table>
        </div>  
        </div> 
        <script>
            function displayMsnAprov() {
            document.getElementById("msnAprov").style.display = "none";
            }
        </script>';
        break;

    case 5:
        echo '
            <div class="text-center">
                <h2 class="h3 mb-5 text-gray-800" > Gestores Diretos</h2>
            </div>';

        //msn informando conforme a resposta do banco
        switch ($_GET['msn']) {
            case 1:
                echo
                '<div class="p-3 mb-2 bg-success text-white" id="msnGer">Gestor direto adicionado com Sucesso!
                        <a href="javascipt:" onclick="displayMsnGer()">
                            <span>
                                <i class="far fa-window-close" style="margin-left: 71%; color: white;"></i>
                            </span>
                        </a>
                        </div>';
                break;
            case 2:
                echo
                '<div class="p-3 mb-2 bg-success text-white" id="msnGer">Gestor direto editado com Sucesso!
                        <a href="javascipt:" onclick="displayMsnGer()">
                            <span>  
                                <i class="far fa-window-close" style="margin-left: 74%; color: white;"></i>
                            </span>
                        </a>
                        </div>';
                break;
            case 3:
                echo
                '<div class="p-3 mb-2 bg-success text-white" id="msnGer">Gestor direto deletado com Sucesso!
                        <a href="javascipt:" onclick="displayMsnGer()">
                            <span>
                                <i class="far fa-window-close" style="margin-left: 73%; color: white;"></i>
                            </span>
                        </a>
                        </div>';
                break;
        }
        /*  Gestores Diretos  */

        $resultgest = ociparse($conn, $gesdir);
        ociexecute($resultgest);

        echo '
        <div class="card shadow mb-4"> 
                <div class="card-header py-3">
                    <a href="novaRegraGer.php?id_usuario=' . $_GET['id_usuario'] . '" class="float-right btn btn-success" style="margin-left: 1%" title="Nova Regra Aprovadores">
                        <i class="fas fa-plus"></i>
                    </a>
                    <a href="../bd/relatorioExcel.php?id_e=5" class="float-right btn btn-success" title="Exportar Excel" target="_blank">
                        <i class="fas fa-file-excel"></i>
                    </a>
                </div>
        <div class="row">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Id Regra</th>
                        <th>Empresa</th>
                        <th>Departamento</th>
                        <th>CPF Gestor</th>
                        <th>Login SmartShare</th>
                        <th>Situação</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>';
        while (($rowgest = oci_fetch_array($resultgest, OCI_BOTH)) != FAlSE) {
            $situacao = ($rowgest['SITUACAO'] == 'A') ? 'ATIVO' : 'DESATIVADO';

            echo '<tr>';
            echo '<td>' . $rowgest['ID_GESTOR_DIRETO'] . '</td>';
            echo '<td>' . $rowgest['NOME_EMPRESA'] . '</td>';
            echo '<td>' . $rowgest['NOME_DEPARTAMENTO'] . '</td>';
            echo '<td>' . $rowgest['CPF_GESTOR'] . '</td>';
            echo '<td>' . $rowgest['LOGIN_SMARTSHARE'] . '</td>';
            echo '<td>' . $situacao . '</td>';
            echo '<td>
                    <a href="editGer.php?id=' . $rowgest['ID_GESTOR_DIRETO'] . '&id_usuario=' . $_SESSION['id_usuario'] . '" class="text-success menu rigtIcones">
                        <i class="fas fa-pen" style="margin-left: 1px;"></i>
                    </a>
                    <a href="deletarGer.php?id=' . $rowgest['ID_GESTOR_DIRETO'] . '&id_usuario=' . $_SESSION['id_usuario'] . '" class="text-danger rigtIcones" title="Excluir">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
                </tr>';
        }
        echo '                    
                </tbody>
                <tfoot>
                    <tr>
                        <th>Id Regra</th>
                        <th>Empresa</th>
                        <th>Departamento</th>
                        <th>CPF Gestor</th>
                        <th>Login SmartShare</th>
                        <th>Situação</th>
                        <th>Ação</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <script>
            function displayMsnGer() {
            document.getElementById("msnGer").style.display = "none";
            }
        </script>';
        break;

    case 6:

        echo '
            <div class="text-center">
                <h2 class="h3 mb-5 text-gray-800"> Aprovador Filial</h2>
            </div>';

        //msn informando conforme a resposta do banco
        switch ($_GET['msn']) {
            case 1:
                echo
                '<div class="p-3 mb-2 bg-success text-white" id="msnAprovFilial">Aprovador filial adicionado com Sucesso! 
                            <a href="javascipt:" onclick="displayMsnAprovFilial()">
                                <span>
                                    <i class="far fa-window-close" style="margin-left: 70%; color: white;"></i>
                                </span>
                            </a>
                         </div>';
                break;
            case 2:
                echo
                '<div class="p-3 mb-2 bg-success text-white" id="msnAprovFilial">Aprovador filial editado com Sucesso! 
                            <a href="javascipt:" onclick="displayMsnAprovFilial()">
                                <span>  
                                    <i class="far fa-window-close" style="margin-left: 72%; color: white;"></i>
                                </span>
                            </a>
                         </div>';
                break;
            case 3:
                echo
                '<div class="p-3 mb-2 bg-success text-white" id="msnAprovFilial">Aprovador filial deletado com Sucesso!
                            <a href="javascipt:" onclick="displayMsnAprovFilial()">
                                <span>
                                    <i class="far fa-window-close" style="margin-left: 71%; color: white;"></i>
                                </span>
                            </a>
                         </div>';
                break;
            case 4:
                echo
                '<div class="p-3 mb-2 bg-danger text-white" id="msnAprovFilial">Já existe uma empresa cadastrado com esse aprovador!
                            <a href="javascipt:" onclick="displayMsnAprovFilial()">
                                <span>
                                    <i class="far fa-window-close" style="margin-left: 60%; color: white;"></i>
                                </span>
                            </a>
                         </div>';
                break;
        }
        $queryAprovFilial .= " WHERE tipo_registro = 'G'";

        //query resultado para tabela empresa
        $resultAprovFilial = ociparse($conn, $queryAprovFilial);
        ociexecute($resultAprovFilial);

        /* Tabela Aprovador Filial */
        echo '
            <div class="card shadow mb-4"> 
                <div class="card-header py-3">
                    <a href="novaRegraApFilial.php?id_usuario=' . $_GET['id_usuario'] . '" class="float-right btn btn-success" style="margin-left: 1%" title="Nova Regra Aprovador Filial">
                        <i class="fas fa-plus"></i>
                    </a>
                    <a href="../bd/relatorioExcel.php?id_e=6" class="float-right btn btn-success" title="Exportar Excel" target="_blank">
                        <i class="fas fa-file-excel"></i>
                    </a>
                </div>
                <div class="row">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id Regra</th>
                                <th>Nome Empresa</th>
                                <th>Aprovador Gestor</th>
                                <th>Situação</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>';
        while (($rowAprovFilial = oci_fetch_array($resultAprovFilial, OCI_BOTH)) != FAlSE) {

            if ($rowAprovFilial['SITUACAO'] == 'A') {
                $situacao = 'ATIVO';
            } else {
                $situacao = 'DESATIVADO';
            }
            echo '<tr>';
            echo '<td>' . $rowAprovFilial['ID_APROVADOR'] . '</td>';
            echo '<td>' . $rowAprovFilial['NOME_EMPRESA'] . '</td>';
            echo '<td>' . $rowAprovFilial['APROVADOR_GESTOR'] . '</td>';
            echo '<td>' . $situacao . '</td>';
            echo '<td>
                                        <a href="editApFilial.php?id=' . $rowAprovFilial['ID_APROVADOR'] . '&id_usuario=' . $_SESSION['id_usuario'] . '" class="text-success menu rigtIcones" title="Editar">
                                            <i class="fas fa-pen" style="margin-left: 1px;"></i>
                                        </a>
                                        <a href="deletarApFilial.php?id=' . $rowAprovFilial['ID_APROVADOR'] . '&id_usuario=' . $_SESSION['id_usuario'] . '" class="text-danger rigtIcones" title="Excluir">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                    </tr>';
        }
        echo '
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Id Regra</th>
                                <th>Nome Empresa</th>
                                <th>Aprovador_Gestor</th>
                                <th>Situação</th>
                                <th>Ação</th>
                            </tr>
                        </tfoot>                            
                    </table>
                </div> 
            </div>

            <script>
                function displayMsnAprovFilial() {
                document.getElementById("msnAprovFilial").style.display = "none";
                }
            </script>';
        break;

    case 7:

        echo '
                <div class="text-center">
                    <h2 class="h3 mb-5 text-gray-800">Usuários SmartShare</h2>
                </div>';

        //msn informando conforme a resposta do banco

        if ($_GET['msn'] != null) {
            echo
            '<div class="p-3 mb-2 bg-success text-white" id="msnAprovFilial">Usuário alterado com sucesso!
                            <a href="javascipt:" onclick="displayMsnAprovFilial()">
                            <span>
                                <i class="far fa-window-close" style="margin-left: 77%; color: white;"></i>
                            </span>
                            </a>
                        </div>';
        }

        //query resultado para tabela usuario selbetti 

        $queryUserApi .= "ORDER BY ds_usuario ASC";

        $resultUserApi = ociparse($conns, $queryUserApi);
        ociexecute($resultUserApi);

        /* Tabela Usuários SmartShare */
        echo '
                <div class="card shadow mb-4"> 
                    <div class="card-header py-3">';

        $styleBotomImportUser == ($_SESSION['admin'] != 1) ? 'none' : 'block';

        echo '
                        <a href="http://10.100.1.217/acoesAutomaticas/front/importarUsuarioVetorSelbetti.php" target="_blank" class="float-right btn btn-info" style="margin-left: 1%; display:' . $styleBotomImportUser . '" title="Importar Usuários">
                            <i class="fa-solid fa-file-import"></i>
                        </a>
                        <a href="../bd/relatorioExcel.php?id_e=7" class="float-right btn btn-success" title="Exportar Excel" target="_blank">
                            <i class="fas fa-file-excel"></i>
                        </a>
                    </div>
                    <div class="row">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id Regra</th>
                                    <th>Usuário</th>
                                    <th>E-mail</th>
                                    <th>Login</th>
                                    <th>Situação</th>
                                    <th>Ação</th>
                                    
                                </tr>
                            </thead>
                            <tbody>';
        while (($rowUserApi = oci_fetch_array($resultUserApi, OCI_BOTH)) != FAlSE) {

            echo '<tr>';
            echo '<td>' . $rowUserApi['CD_USUARIO'] . '</td>';
            echo '<td>' . $rowUserApi['DS_USUARIO'] . '</td>';
            echo '<td>' . $rowUserApi['DS_EMAIL'] . '</td>';
            echo '<td>' . $rowUserApi['DS_LOGIN'] . '</td>';
            if ($rowUserApi['ST_ATIVO'] == 1) {
                echo '<td>Ativo</td>';
            } else {
                echo '<td>Desativado</td>';
            };
            echo '<td>
                    <a href="editUserApi.php?id=' . $rowUserApi['CD_USUARIO'] . '&id_usuario=' . $_SESSION['id_usuario'] . '" class="text-success menu rigtIcones" title="Editar">
                        <i class="fas fa-pen" style="margin: center"></i>
                    </a>
                  </td>';
            echo '</tr>';
        }
        echo '
                            </tbody>
                                                        
                        </table>
                    </div> 
                </div>
    
                <script>
                    function displayMsnAprovFilial() {
                    document.getElementById("msnAprovFilial").style.display = "none";
                    }
                </script>';
        break;

    case 8:

        switch ($_GET['msn']) {
            case 1:
                echo
                '<br /><div class="p-2 mb-5 bg-danger text-white" id="msnEmp">Gestor atualizado com sucesso!
                    <a href="javascipt:" onclick="displayMsnEmp()">
                        <span>
                            <i class="far fa-window-close" style="margin-left: 58%; color: white;"></i>
                        </span>
                    </a>
                </div>';
                break;
        }


        if (empty($_SESSION['loginGestor'])) {

            $buscar = 'block';
            $atualizar = 'none';
            $alert = $_GET['buscar'] == 1 ? '' : '<p style="color: red;">Usuário nao localizado!</p>';
        } else {
            $buscar = 'none';
            $atualizar = 'block';
        }

        echo '        
<!-- INICIO DO CONTEUDO DA PÁGINA -->
    <div class="container">

    <div class="text-center">
        <h1 class="h3 mb-4 text-gray-800">GESTOR RH</h1>
    </div>
    
    <div class="col-lg-6" style="margin-left: 25%;">
        <div class="p-3 mb-6 row" style="display: ' . $buscar . '">
            <form id="localizarUsuario" method="POST" action="localizarUsuario.php?id_usuario=' . $_GET['id_usuario'] . '&id_drop=' . $_GET['id_drop'] . '">

                <!-- INICIO INPUT BUSCAR USUARIO -->    
                <div class="form-group">
                    <label>Localizar gestor:</label>
                    <input style="text-transform: uppercase;" type="text" class="form-control" name="nomeGestor" placeholder="Nome, usuário ou CPF" required>    
                    ' . $alert . '
                </div>
                <!-- FIM INPUT BUSCAR USUARIO -->

                <!-- BOTÃO SALVAR -->
                <button class="btn btn-success" type="submit">Buscar</button>
                <a class="btn btn-danger" href="smartshare.php?id_usuario=' . $_GET['id_usuario'] . '">Voltar</a>
                <!-- BOTÃO SALVAR -->   

            </form>
        </div>
        <div class="p-3 mb-6 row" style="display: ' . $atualizar . '">
            <form id="atualizarGestor" method="post" action="atualizandoGestor.php?id_drop=' . $_GET['id_drop'] . '&id_usuario=' . $_GET['id_usuario'] . '">

                <!-- INICIO INPUT BUSCAR USUARIO -->    
                <div class="form-group">
                    <label for="nomedpto">Gestor atual localizado:</label>
                    <input type="text" name="idGestor" value="' . $_SESSION['loginGestor'] . '" style="display: none">
                    <input type="text" class="form-control" name="gestorVelho" value="' . $_SESSION['loginGestor'] . ' / ' . $_SESSION['usuarioGestor'] . '" readonly>    
                </div>
                <!-- FIM INPUT BUSCAR USUARIO -->

                <!-- INICIO DROP APROVADOR GESTOR -->
                <div class="form-group">
                    <label for="logins">Alterar para novo gestor:
                        <span>
                            <a href="javascript:" title="Campo obrigatório" style="color:red;">
                                <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                            </a>
                        </span>
                    </label>
                    <select class="form-control" name="gestorNovo" required>';

        $resultuser = ociparse($conns, $query_user);
        ociexecute($resultuser);

        echo '<option value="">------------------</option>';
        while (($rowuser = oci_fetch_array($resultuser, OCI_BOTH)) != FAlSE) {
            echo '<option value="' . $rowuser['DS_LOGIN'] . ' / ' . $rowuser['DS_USUARIO'] . '">' . $rowuser['DS_USUARIO'] . ' / ' . $rowuser['DS_LOGIN'] . '</option>';
        }

        echo '
                    </select>
                </div>
                <!-- FIM DROP APROVADOR GESTOR  -->

                <!-- BOTÃO SALVAR -->
                <button class="btn btn-danger" type="submit">ALTERAR</button>
                <a class="btn btn-success" href="smartshare.php?id_usuario=' . $_GET['id_usuario'] . '">Voltar</a>
                <!-- BOTÃO SALVAR -->   

            </form>
        </div>
    </div>
    </body>';

        break;

    case 9:
        /* Tabela Aprovadores_NF */
        $resultaprov = ociparse($conn, $aprovNF);
        ociexecute($resultaprov);

        echo '
                <div class="text-center">
                    <h2 class="h3 mb-5 text-gray-800">Aprovadores NF</h2>
                </div>';

        //msn informando conforme a resposta do banco
        switch ($_GET['msn']) {
            case 1:
                echo
                '<div class="p-3 mb-2 bg-success text-white" id="msnAprov">Aprovador adicionado com Sucesso!
                                <a href="javascipt:" onclick="displayMsnAprov()">
                                    <span>
                                        <i class="far fa-window-close" style="margin-left: 73%; color: white;"></i>
                                    </span>
                                </a>
                             </div>';
                break;
            case 2:
                echo
                '<div class="p-3 mb-2 bg-success text-white" id="msnAprov">Aprovador editado com Sucesso!
                                <a href="javascipt:" onclick="displayMsnAprov()">
                                    <span>  
                                        <i class="far fa-window-close" style="margin-left: 75%; color: white;"></i>
                                    </span>
                                </a>
                             </div>';
                break;
            case 3:
                echo
                '<div class="p-3 mb-2 bg-success text-white" id="msnAprov">Aprovador deletado com Sucesso!
                                <a href="javascipt:" onclick="displayMsnAprov()">
                                    <span>
                                        <i class="far fa-window-close" style="margin-left: 74%; color: white;"></i>
                                    </span>
                                </a>
                             </div>';
                break;
            case 4:
                echo
                '<div class="p-3 mb-2 bg-danger text-white" id="msnAprov">Já exite uma empresa cadastrada com esse departamento!
                                <a href="javascipt:" onclick="displayMsnAprov()">
                                    <span>
                                        <i class="far fa-window-close" style="margin-left: 58%; color: white;"></i>
                                    </span>
                                </a>
                             </div>';
                break;
        }

        echo '
                <div class="card shadow mb-4"> 
                    <div class="card-header py-3">
                        <a href="novaRegraApNF.php?id_usuario=' . $_GET['id_usuario'] . '" class="float-right btn btn-success" style="margin-left: 1%" title="Nova Regra Aprovadores NF">
                            <i class="fas fa-plus"></i>
                        </a>     
                        <a href="../bd/relatorioExcel.php?id_e=9" class="float-right btn btn-success" title="Exportar Excel" target="_blank">
                            <i class="fas fa-file-excel"></i>
                        </a>
                    </div>
                    <div class="row">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id Regra</th>
                                <th>Empresa</th>                                         
                                <th>Departamento</th>                        
                                <th>Area</th>
                                <th>Filial</th>
                                <th>Marca</th>                        
                                <th>Gerente Geral</th>
                                <th>Superintendente</th>
                                <th>Situação</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                    <tbody>';
        while (($rowaprov = oci_fetch_array($resultaprov, OCI_BOTH)) != FAlSE) {
            if ($rowaprov['SITUACAO'] == 'A') {
                $situacao = 'ATIVO';
            } else {
                $situacao = 'DESATIVADO';
            }
            echo '<tr>';
            echo '<td>' . $rowaprov['ID_APROVADOR'] . '</td>';
            echo '<td>' . $rowaprov['NOME_EMPRESA'] . '</td>';
            echo '<td>' . $rowaprov['NOME_DEPARTAMENTO'] . '</td>';
            echo '<td>' . $rowaprov['APROVADOR_AREA'] . '</td>';
            echo '<td>' . $rowaprov['APROVADOR_FILIAL'] . '</td>';
            echo '<td>' . $rowaprov['APROVADOR_MARCA'] . '</td>';
            echo '<td>' . $rowaprov['APROVADOR_GERENTE'] . '</td>';
            echo '<td>' . $rowaprov['APROVADOR_SUPERINTENDENTE'] . '</td>';
            echo '<td>' . $situacao . '</td>';
            echo '<td>
                        <a href="editApNF.php?id_aprovador=' . $rowaprov['ID_APROVADOR'] . '&id_usuario=' . $_SESSION['id_usuario'] . '" class="text-success menu rigtIcones">
                            <i class="fas fa-pen" style="margin-left: 1px;"></i>
                        </a>
                        <a href="deletarNF.php?id=' . $rowaprov['ID_APROVADOR'] . '&id_usuario=' . $_SESSION['id_usuario'] . '" class="text-danger rigtIcones" title="Excluir">                                                                                            
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                    </tr>';
        }
        echo '
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Id Regra</th>
                            <th>Empresa</th>                                        
                            <th>Departamento</th>  
                            <th>Filial</th>                      
                            <th>Area</th>
                            <th>Marca</th>                        
                            <th>Gerente Geral</th>
                            <th>Superintendente</th>
                            <th>Situação</th>
                            <th>Ação</th>
                        </tr>
                    </tfoot>                            
                </table>
            </div>  
            </div> 
            <script>
                function displayMsnAprov() {
                document.getElementById("msnAprov").style.display = "none";
                }
            </script>';
        break;

    case 10:
        echo '
            <div class="text-center">
                <h2 class="h3 mb-5 text-gray-800"> Departamentos NF</h2>
            </div>';

        //msn informando conforme a resposta do banco
        switch ($_GET['msn']) {
            case 1:
                echo
                '<div class="p-3 mb-2 bg-success text-white" id="msnDpto">Departamento adicionado com Sucesso! 
                            <a href="javascipt:" onclick="displayMsnDpto()">
                                <span>
                                    <i class="far fa-window-close" style="margin-left: 70%; color: white;"></i>
                                </span>
                            </a>
                         </div>';
                break;
            case 2:
                echo
                '<div class="p-3 mb-2 bg-success text-white" id="msnDpto">Departamento editado com Sucesso! 
                            <a href="javascipt:" onclick="displayMsnDpto()">
                                <span>  
                                    <i class="far fa-window-close" style="margin-left: 73%; color: white;"></i>
                                </span>
                            </a>
                         </div>';
                break;
            case 3:
                echo
                '<div class="p-3 mb-2 bg-success text-white" id="msnDpto">Departamento deletado com Sucesso!
                            <a href="javascipt:" onclick="displayMsnDpto()">
                                <span>
                                    <i class="far fa-window-close" style="margin-left: 72%; color: white;"></i>
                                </span>
                            </a>
                         </div>';
                break;
            case 4:
                echo
                '<div class="p-3 mb-2 bg-danger text-white" id="msnDpto">Departamento já cadastrado!
                            <a href="javascipt:" onclick="displayMsnDpto()">
                                <span>
                                    <i class="far fa-window-close" style="margin-left: 78%; color: white;"></i>
                                </span>
                            </a>
                         </div>';
                break;
            case 5:
                echo
                '<div class="p-3 mb-2 bg-danger text-white" id="msnDpto">O departamento selecionado já possui relação em outras telas!
                            <a href="javascipt:" onclick="displayMsnDpto()">
                                <span>
                                    <i class="far fa-window-close" style="margin-left: 55%; color: white;"></i>
                                </span>
                            </a>
                         </div>';
                break;
        }

        //query resultado para tabela empresa
        $resultdeprh = ociparse($conn, $departNF);
        ociexecute($resultdeprh);

        /* Tabela Departamentos RH */
        echo '
        <div class="card shadow mb-4"> 
            <div class="card-header py-3">
                        <a href="novaRegraDepNF.php?id_usuario=' . $_GET['id_usuario'] . '" class="float-right btn btn-success" style="margin-left: 1%" title="Nova Regra Departamentos RH">
                            <i class="fas fa-plus"></i>
                        </a>
                        <a href="../bd/relatorioExcel.php?id_e=10" class="float-right btn btn-success" title="Exportar Excel" target="_blank">
                            <i class="fas fa-file-excel"></i>
                        </a>
                </div>
            <div class="row">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Id Regra</th>
                        <th>Nome Departamento</th>
                        <th>Situação</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>';
        while (($rowdeprh = oci_fetch_array($resultdeprh, OCI_BOTH)) != FAlSE) {

            if ($rowdeprh['SITUACAO'] == 'A') {
                $situacao = 'ATIVO';
            } else {
                $situacao = 'DESATIVADO';
            }
            echo '<tr>';
            echo '<td>' . $rowdeprh['ID_DEPARTAMENTO'] . '</td>';
            echo '<td>' . $rowdeprh['NOME_DEPARTAMENTO'] . '</td>';
            echo '<td>' . $situacao . '</td>';
            echo '<td>
                    <a href="editDepNF.php?id=' . $rowdeprh['ID_DEPARTAMENTO'] . '&id_usuario=' . $_SESSION['id_usuario'] . '" class="text-success menu rigtIcones">
                        <i class="fas fa-pen" style="margin-left: 1px;"></i>
                    </a>
                    <a href="deletarDepNF.php?id=' . $rowdeprh['ID_DEPARTAMENTO'] . '&id_usuario=' . $_SESSION['id_usuario'] . '" class="text-danger rigtIcones" title="Excluir">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
                </tr>';
        }
        echo '
                </tbody>
                <tfoot>
                    <tr>
                        <th>Id Regra</th>
                        <th>Nome Departamento</th>
                        <th>Situação</th>
                        <th>Ação</th>
                    </tr>
                </tfoot>                            
            </table>
        </div> 
        </div>

        <script>
            function displayMsnDpto() {
            document.getElementById("msnDpto").style.display = "none";
            }
        </script>';
        break;
    case 11:
        echo '
                <div class="text-center">
                    <h2 class="h3 mb-5 text-gray-800"> Empresa X Departamento NF</h2>
                </div>';

        //msn informando conforme a resposta do banco
        switch ($_GET['msn']) {
            case 1:
                echo
                '<div class="p-3 mb-2 bg-success text-white" id="msnEmpDpto">Regra adicionada com Sucesso! 
                                <a href="javascipt:" onclick="displayMsnEmpDpto()">
                                    <span>
                                        <i class="far fa-window-close" style="margin-left: 76%; color: white;"></i>
                                    </span>
                                </a>
                             </div>';
                break;
            case 2:
                echo
                '<div class="p-3 mb-2 bg-success text-white" id="msnEmpDpto">Regra editada com Sucesso!
                                <a href="javascipt:" onclick="displayMsnEmpDpto()">
                                    <span>  
                                        <i class="far fa-window-close" style="margin-left: 79%; color: white;"></i>
                                    </span>
                                </a>
                             </div>';
                break;
            case 3:
                echo
                '<div class="p-3 mb-2 bg-success text-white" id="msnEmpDpto">Regra deletada com Sucesso!
                                <a href="javascipt:" onclick="displayMsnEmpDpto()">
                                    <span>
                                        <i class="far fa-window-close" style="margin-left: 78%; color: white;"></i>
                                    </span>
                                </a>
                             </div>';
                break;
            case 4:
                echo
                '<div class="p-3 mb-2 bg-danger text-white" id="msnEmpDpto">Já existe uma regra adicionada com a empresa e o departamento informado!
                                <a href="javascipt:" onclick="displayMsnEmpDpto()">
                                    <span>
                                        <i class="far fa-window-close" style="margin-left: 46%; color: white;"></i>
                                    </span>
                                </a>
                             </div>';
                break;
        }

        /* Empresa X Departamento */
        $resultempdep = ociparse($conn, $empdepNF);
        ociexecute($resultempdep);
        echo '
            <div class="card shadow mb-4"> 
                    <div class="card-header py-3">
                        <a href="novaRegraEmpDepNF.php?id_usuario=' . $_GET['id_usuario'] . '" class="float-right btn btn-success" style="margin-left: 1%" title="Nova Regra Aprovadores">
                            <i class="fas fa-plus"></i>
                        </a>
                        <a href="../bd/relatorioExcel.php?id_e=11" class="float-right btn btn-success" title="Exportar Excel" target="_blank">
                            <i class="fas fa-file-excel"></i>
                        </a>
                    </div>
            <div class="row">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id Regra</th>
                            <th>Empresa</th>
                            <th>Departamento</th>                        
                            <th>Gerente Aprova</th>
                            <th>Superintendente Aprova</th>
                            <th>Situação</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>';
        while (($rowempdep = oci_fetch_array($resultempdep, OCI_BOTH)) != FAlSE) {

            $situacao = ($rowempdep['SITUACAO'] == 'A') ? 'ATIVO' : 'DESATIVADO';
            $gerAp = ($rowempdep['GERENTE_APROVA'] == 'S') ? 'SIM' : 'NÃO';
            $supAp = ($rowempdep['SUPERINTENDENTE_APROVA'] == 'S') ? 'SIM' : 'NÃO';
            echo '<tr>';
            echo '<td>' . $rowempdep['ID_EMPDEP'] . '</td>';
            echo '<td>' . $rowempdep['NOME_EMPRESA'] . '</td>';
            echo '<td>' . $rowempdep['NOME_DEPARTAMENTO'] . '</td>';
            echo '<td>' . $gerAp . '</td>';
            echo '<td>' . $supAp . '</td>';
            echo '<td>' . $situacao . '</td>';
            echo '<td>
                        <a href="editEmpDepNF.php?id_empdep=' . $rowempdep['ID_EMPDEP'] . '&id_usuario=' . $_SESSION['id_usuario'] . '" class="text-success menu rigtIcones">
                            <i class="fas fa-pen" style="margin-left: 1px;"></i>
                        </a>
                        <a href="deletarEmpDepNF.php?id=' . $rowempdep['ID_EMPDEP'] . '&id_usuario=' . $_SESSION['id_usuario'] . '" class="text-danger rigtIcones" title="Excluir">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                    </tr>';
        }
        echo '
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Id Regra</th>
                            <th>Empresa</th>
                            <th>Departamento</th>
                            <th>Gerente Aprova</th>
                            <th>Superintendente Aprova</th>
                            <th>Situação</th>
                            <th>Ação</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            </div> 
            <script>
                function displayMsnEmpDpto() {
                document.getElementById("msnEmpDpto").style.display = "none";
                }
            </script>';
        break;

    case 12:

        switch ($_GET['msn']) {
            case 1:
                echo
                '<br /><div class="p-2 mb-5 bg-danger text-white" id="msnEmp">Gestor atualizado com sucesso!
                        <a href="javascipt:" onclick="displayMsnEmp()">
                            <span>
                                <i class="far fa-window-close" style="margin-left: 58%; color: white;"></i>
                            </span>
                        </a>
                    </div>';
                break;
        }


        if (empty($_SESSION['loginGestor'])) {

            $buscar = 'block';
            $atualizar = 'none';
            $alert = $_GET['buscar'] == 1 ? '' : '<p style="color: red;">Usuário nao localizado!</p>';
        } else {
            $buscar = 'none';
            $atualizar = 'block';
        }

        echo '        
    <!-- INICIO DO CONTEUDO DA PÁGINA -->
        <div class="container">
    
        <div class="text-center">
            <h1 class="h3 mb-4 text-gray-800">GESTOR NF</h1>
        </div>
        
        <div class="col-lg-6" style="margin-left: 25%;">
            <div class="p-3 mb-6 row" style="display: ' . $buscar . '">
                <form id="localizarUsuario" method="POST" action="localizarUsuario.php?id_usuario=' . $_GET['id_usuario'] . '&id_drop=' . $_GET['id_drop'] . '">
    
                    <!-- INICIO INPUT BUSCAR USUARIO -->    
                    <div class="form-group">
                        <label>Localizar gestor:</label>
                        <input style="text-transform: uppercase;" type="text" class="form-control" name="nomeGestor" placeholder="Nome, usuário ou CPF" required>    
                        ' . $alert . '
                    </div>
                    <!-- FIM INPUT BUSCAR USUARIO -->
    
                    <!-- BOTÃO SALVAR -->
                    <button class="btn btn-success" type="submit">Buscar</button>
                    <a class="btn btn-danger" href="smartshare.php?id_usuario=' . $_GET['id_usuario'] . '">Voltar</a>
                    <!-- BOTÃO SALVAR -->   
    
                </form>
            </div>
            <div class="p-3 mb-6 row" style="display: ' . $atualizar . '">
                <form id="atualizarGestor" method="post" action="atualizandoGestorNF.php?id_drop=' . $_GET['id_drop'] . '&id_usuario=' . $_GET['id_usuario'] . '">
    
                    <!-- INICIO INPUT BUSCAR USUARIO -->    
                    <div class="form-group">
                        <label for="nomedpto">Gestor atual localizado:</label>
                        <input type="text" name="idGestor" value="' . $_SESSION['loginGestor'] . '" style="display: none">
                        <input type="text" class="form-control" name="gestorVelho" value="' . $_SESSION['loginGestor'] . ' / ' . $_SESSION['usuarioGestor'] . '" readonly>    
                    </div>
                    <!-- FIM INPUT BUSCAR USUARIO -->
    
                    <!-- INICIO DROP APROVADOR GESTOR -->
                    <div class="form-group">
                        <label for="logins">Alterar para novo gestor:
                            <span>
                                <a href="javascript:" title="Campo obrigatório" style="color:red;">
                                    <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                                </a>
                            </span>
                        </label>
                        <select class="form-control" name="gestorNovo" required>';

        $resultuser = ociparse($conns, $query_user);
        ociexecute($resultuser);

        echo '<option value="">------------------</option>';
        while (($rowuser = oci_fetch_array($resultuser, OCI_BOTH)) != FAlSE) {
            echo '<option value="' . $rowuser['DS_LOGIN'] . ' / ' . $rowuser['DS_USUARIO'] . '">' . $rowuser['DS_USUARIO'] . ' / ' . $rowuser['DS_LOGIN'] . '</option>';
        }

        echo '
                        </select>
                    </div>
                    <!-- FIM DROP APROVADOR GESTOR  -->
    
                    <!-- BOTÃO SALVAR -->
                    <button class="btn btn-danger" type="submit">ALTERAR</button>
                    <a class="btn btn-success" href="smartshare.php?id_usuario=' . $_GET['id_usuario'] . '">Voltar</a>
                    <!-- BOTÃO SALVAR -->   
    
                </form>
            </div>
        </div>
        </body>';

        break;
    case '13':

        $queryMFP = "SELECT * FROM MFP_WEB";
        $resultMFP = oci_parse($conn, $queryMFP);
        oci_execute($resultMFP); 
        echo '
        <div class="container">
    
        <div class="text-center">
            <h1 class="h3 mb-4 text-gray-800">MFP WEB</h1>';
            switch ($_GET['msn']) {
                case 1:
                    echo
                    '<div class="p-3 mb-2 bg-success text-white" id="msnEmpDpto">Link adicionado com Sucesso! 
                                    <a href="javascipt:" onclick="displayMsnEmpDpto()">
                                        <span>
                                            <i class="far fa-window-close" style="margin-left: 76%; color: white;"></i>
                                        </span>
                                    </a>
                                 </div>';
                    break;
                case 2:
                    echo
                    '<div class="p-3 mb-2 bg-success text-white" id="msnEmpDpto">link editada com Sucesso!
                                    <a href="javascipt:" onclick="displayMsnEmpDpto()">
                                        <span>  
                                            <i class="far fa-window-close" style="margin-left: 79%; color: white;"></i>
                                        </span>
                                    </a>
                                 </div>';
                    break;
                case 3:
                    echo
                    '<div class="p-3 mb-2 bg-success text-white" id="msnEmpDpto">link deletado com Sucesso!
                                    <a href="javascipt:" onclick="displayMsnEmpDpto()">
                                        <span>
                                            <i class="far fa-window-close" style="margin-left: 78%; color: white;"></i>
                                        </span>
                                    </a>
                                 </div>';
                    break;
            }
            echo '
        </div>
            <div class="card shadow mb-4"> 
                    <div class="card-header py-3">
                        <a href="novoLink.php?id_usuario=' . $_GET['id_usuario'] . '" class="float-right btn btn-success" style="margin-left: 1%" title="Novo Link">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
            <div class="row">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Link</th>
                            <th>ID Perfil</th>
                            <th>Perfil</th>
                            <th>Descrição</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>';
                    while(($mfpWEB = oci_fetch_array($resultMFP, OCI_BOTH)) != false){
                        echo '<tr>
                                <td>'.$mfpWEB['LINK'].'</td>
                                <td>'.$mfpWEB['CD_PERFIL'].'</td>
                                <td>'.$mfpWEB['DS_PERFIL'].'</td>
                                <td>'.$mfpWEB['DESCRICAO'].'</td>
                                <td>
                                    <a href="editLink.php?id_link='.$mfpWEB['ID_LINK'].'&id_usuario=' . $_GET['id_usuario'] . '" class="text-success menu rigtIcones">
                                        <i class="fas fa-pen" style="margin-left: 1px;"></i>
                                    </a>
                                    <a href="deletarLink.php?id_link='.$mfpWEB['ID_LINK'].'&id_usuario=' . $_GET['id_usuario'] . '" class="text-danger rigtIcones" title="Excluir">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>';
                    
                    }


        echo '
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Link</th>
                            <th>ID Perfil</th>
                            <th>Perfil</th>
                            <th>Descrição</th>
                            <th>Ação</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            </div> 
            <script>
                function displayMsnEmpDpto() {
                document.getElementById("msnEmpDpto").style.display = "none";
                }
            </script>';

        break;
}

unset($_SESSION['loginGestor']);
unset($_SESSION['usuarioGestor']);
