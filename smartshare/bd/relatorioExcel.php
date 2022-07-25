<?php

//chamando o banco
include '../config/conexaoSmart.php';
include '../config/sqlSmart.php';
include '../config/conexaoSmartSelbetti.php';

/* INICIO SWITCH RELATÓRIOS */
switch ($_GET['id_e']) {
    case 1:
        //aplicando a query

        $resultaprov = ociparse($conn, $aprov);
        ociexecute($resultaprov);

        $arquivo = 'aprovadores_rh.xls';

        // Criamos uma tabela HTML com o formato da planilha
        $html = "
        <html>
            <style>
                td{
                    border: solid 1px;
                }
            </style>
            <body>
                <table class='table table-sm' style='font-size:12px;'>
                <thead>
                    <tr>				
                        <th>Empresa</th>                                         
                        <th>Departamento</th>                        
                        <th>Area</th>
                        <th>Filial</th>
                        <th>Marca</th>                        
                        <th>Gerente</th>
                        <th>Superintendente</th>
                        <th>Situacao</th>
                    </tr>
                </thead>
                <tbody>";

        while (($row_relatorio = oci_fetch_array($resultaprov, OCI_BOTH)) != FAlSE) {
            $situacao = ($row_relatorio['SITUACAO'] == 'A') ? 'ATIVO' : 'DESATIVADO';
            $html .= "
                    <tr>";
            $html .=  empty($row_relatorio['NOME_EMPRESA']) ? '<td>----------</td>' : '<td>' . $row_relatorio['NOME_EMPRESA'] . '</td>';
            $html .=  empty($row_relatorio['NOME_DEPARTAMENTO']) ? '<td>----------</td>' : '<td>' . $row_relatorio['NOME_DEPARTAMENTO'] . '</td>';
            $html .=  empty($row_relatorio['APROVADOR_AREA']) ? '<td>----------</td>' : '<td>' . $row_relatorio['APROVADOR_AREA']  . '</td>';
            $html .=  empty($row_relatorio['APROVADOR_FILIAL']) ? '<td>----------</td>' : '<td>' . $row_relatorio['APROVADOR_FILIAL']  . '</td>';
            $html .=  empty($row_relatorio['APROVADOR_MARCA']) ? '<td>----------</td>' : '<td>' . $row_relatorio['APROVADOR_MARCA'] . '</td>';
            $html .=  empty($row_relatorio['APROVADOR_GERENTE']) ? '<td>----------</td>' : '<td>' . $row_relatorio['APROVADOR_GERENTE'] . '</td>';
            $html .=  empty($row_relatorio['APROVADOR_SUPERINTENDENTE']) ? '<td>----------</td>' : '<td>' . $row_relatorio['APROVADOR_SUPERINTENDENTE'] . '</td>';
            $html .=  empty($situacao) ? '<td>----------</td>' : '<td>' . $situacao . '</td>';
            $html .= "
                    </tr>";
        }
        $html .= "</tbody>
                </table>
            </body>
        </html>";

        // Configurações header para forçar o download
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: application/x-msexcel");
        header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
        header("Content-Description: PHP Generated Data");
        // Envia o conteúdo do arquivo
        echo $html;
        break;

    case 2:
        //aplicando a query

        $resultdptorh = ociparse($conn, $departrh);
        ociexecute($resultdptorh);

        $arquivo = 'departamentos_rh.xls';

        // Criamos uma tabela HTML com o formato da planilha
        $html = "
        <html>
            <style>
                td{
                    border: solid 1px;
                }
            </style>
            <body>
                <table class='table table-sm' style='font-size:12px;'>
                <thead>
                    <tr>				
                        <th>NOME DO DEPARTAMENTO</th>                                         
                        <th>SITUACAO DO DEPARTAMENTO</th>
                    </tr>
                </thead>
                <tbody>";

        while (($row_relatorio = oci_fetch_array($resultdptorh, OCI_BOTH)) != FAlSE) {
            if ($row_relatorio['SITUACAO'] == 'A') {
                $situacao = 'ATIVO';
            } else {
                $situacao = 'DESATIVADO';
            }
            $html .= "
                    <tr>";
            $html .=  empty($row_relatorio['NOME_DEPARTAMENTO']) ? '<td>----------</td>' : '<td>' . $row_relatorio['NOME_DEPARTAMENTO'] . '</td>';
            $html .=  empty($situacao) ? '<td>----------</td>' : '<td>' . $situacao . '</td>';

            $html .= "
                    </tr>";
        }
        $html .= "</tbody>
                </table>
            </body>
        </html>";

        // Configurações header para forçar o download
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: application/x-msexcel");
        header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
        header("Content-Description: PHP Generated Data");
        // Envia o conteúdo do arquivo
        echo $html;
        break;

    case 3:
        //aplicando a query

        $emp .= " ORDER BY NOME_EMPRESA ASC";

        $resultempexcel = ociparse($conn, $emp);
        ociexecute($resultempexcel);

        $arquivo = 'empresas.xls';

        // Criamos uma tabela HTML com o formato da planilha
        $html = "
        <html>
            <style>
                td{
                    border: solid 1px;
                }
            </style>
            <body>
                <table class='table table-sm' style='font-size:12px;'>
                <thead>
                    <tr>				
                        <th>Empresa</th>			
                        <th>UF</th>
                        <th>Sistema</th>
                        <th>Empresa Apollo</th>
                        <th>Revenda Apollo</th>
                        <th>Empresa NBS</th>
                        <th>Organograma Senior</th>
                        <th>Empresa Senior</th>
                        <th>Filial Senior</th>
                        <th>Consorcio</th>			
                        <th>Numero Caixa</th>			
                        <th>Aprovador Caixa</th>
                        <th>Situacao</th>
                    </tr>
                </thead>
                <tbody>";

        while (($row_relatorio = oci_fetch_array($resultempexcel, OCI_BOTH)) != FAlSE) {
            $situacao = ($row_relatorio['SITUACAO'] == 'A') ? 'ATIVO' : 'DESATIVADO';
            $consorcio = ($row_relatorio['CONSORCIO'] == 'S') ? 'SIM' : 'NAO';

            switch ($row_relatorio['SISTEMA']) {
                case 'A':
                    $sistema = 'APOLLO';
                    break;
                case 'N':
                    $sistema = 'BANCO NBS';
                    break;
                case 'H':
                    $sistema = 'BANCO HARLEY';
                    break;
                case ' ':
                    $sistema = 'NAO USA E.R.P';
                    break;
            }

            $html .= "
                    <tr>";
            $html .=  empty($row_relatorio['NOME_EMPRESA']) ? '<td>----------</td>' : '<td>' . $row_relatorio['NOME_EMPRESA'] . '</td>';
            $html .=  empty($row_relatorio['UF_GESTAO']) ? '<td>----------</td>' : '<td>' . $row_relatorio['UF_GESTAO'] . '</td>';
            $html .=  empty($sistema) ? '<td>----------</td>' : '<td>' . $sistema . '</td>';
            $html .=  empty($row_relatorio['EMPRESA_APOLLO']) ? '<td>----------</td>' : '<td>' . $row_relatorio['EMPRESA_APOLLO'] . '</td>';
            $html .=  empty($row_relatorio['REVENDA_APOLLO']) ? '<td>----------</td>' : '<td>' . $row_relatorio['REVENDA_APOLLO'] . '</td>';
            $html .=  empty($row_relatorio['EMPRESA_NBS']) ? '<td>----------</td>' : '<td>' . $row_relatorio['EMPRESA_NBS'] . '</td>';
            $html .=  empty($row_relatorio['ORGANOGRAMA_SENIOR']) ? '<td>----------</td>' : '<td>' . $row_relatorio['ORGANOGRAMA_SENIOR'] . '</td>';
            $html .=  empty($row_relatorio['EMPRESA_SENIOR']) ? '<td>----------</td>' : '<td>' . $row_relatorio['EMPRESA_SENIOR'] . '</td>';
            $html .=  empty($row_relatorio['FILIAL_SENIOR']) ? '<td>----------</td>' : '<td>' . $row_relatorio['FILIAL_SENIOR'] . '</td>';
            $html .=  empty($consorcio) ? '<td>----------</td>' : '<td>' . $consorcio . '</td>';
            $html .=  empty($row_relatorio['NUMERO_CAIXA']) ? '<td>----------</td>' : '<td>' . $row_relatorio['NUMERO_CAIXA'] . '</td>';
            $html .=  empty($row_relatorio['APROVADOR_CAIXA']) ? '<td>----------</td>' : '<td>' . $row_relatorio['APROVADOR_CAIXA'] . '</td>';
            $html .=  empty($situacao) ? '<td>----------</td>' : '<td>' . $situacao . '</td>';

            $html .= "
                    </tr>";
        }
        $html .= "</tbody>
                </table>
            </body>
        </html>";

        // Configurações header para forçar o download
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: application/x-msexcel");
        header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
        header("Content-Description: PHP Generated Data");
        // Envia o conteúdo do arquivo
        echo $html;
        break;

    case 4:
        //aplicando a query

        $resultempdep = ociparse($conn, $empdep);
        ociexecute($resultempdep);

        $arquivo = 'empresa_departamento.xls';

        // Criamos uma tabela HTML com o formato da planilha
        $html = "
        <html>
            <style>
                td{
                    border: solid 1px;
                }
            </style>
            <body>
                <table class='table table-sm' style='font-size:12px;'>
                <thead>
                    <tr>				
                        <th>Empresa</th>
                        <th>Departamento</th>
                        <th>Situacao</th>
                        <th>Gerente Aprova</th>
                        <th>Superintendente Aprova</th>                        
                    </tr>
                </thead>
                <tbody>";

        while (($row_relatorio = oci_fetch_array($resultempdep, OCI_BOTH)) != FAlSE) {
            if ($row_relatorio['SITUACAO'] == 'A') {
                $situacao = 'ATIVO';
            } else {
                $situacao = 'DESATIVADO';
            }

            if ($row_relatorio['GERENTE_APROVA'] == 'S') {
                $gerAp = 'SIM';
            } else {
                $gerAp = 'NAO';
            }

            if ($row_relatorio['SUPERINTENDENTE_APROVA'] == 'S') {
                $supAp = 'SIM';
            } else {
                $supAp = 'NAO';
            }

            $html .= "
                    <tr>";
            $html .=  empty($row_relatorio['NOME_EMPRESA']) ? '<td>----------</td>' : '<td>' . $row_relatorio['NOME_EMPRESA'] . '</td>';
            $html .=  empty($row_relatorio['NOME_DEPARTAMENTO']) ? '<td>----------</td>' : '<td>' . $row_relatorio['NOME_DEPARTAMENTO'] . '</td>';
            $html .=  empty($situacao) ? '<td>----------</td>' : '<td>' . $situacao . '</td>';
            $html .=  empty($gerAp) ? '<td>----------</td>' : '<td>' . $gerAp . '</td>';
            $html .=  empty($supAp) ? '<td>----------</td>' : '<td>' . $supAp . '</td>';

            $html .= "
                    </tr>";
        }
        $html .= "</tbody>
                </table>
            </body>
        </html>";

        // Configurações header para forçar o download
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: application/x-msexcel");
        header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
        header("Content-Description: PHP Generated Data");
        // Envia o conteúdo do arquivo
        echo $html;
        break;

    case 5:
        //aplicando a query
        $resultgesdir = ociparse($conn, $gesdir);
        ociexecute($resultgesdir);

        $arquivo = 'gestores_direto.xls';

        // Criamos uma tabela HTML com o formato da planilha
        $html = "
        <html>
            <style>
                td{
                    border: solid 1px;
                }
            </style>
            <body>
                <table class='table table-sm' style='font-size:12px;'>
                <thead>
                    <tr>				
                        <th>Empresa</th>
                        <th>Departamento</th>
                        <th>CPF Gestor</th>
                        <th>Login SmartShare</th>
                        <th>Situacao</th>
                    </tr>
                </thead>
                <tbody>";

        while (($row_relatorio = oci_fetch_array($resultgesdir, OCI_BOTH)) != FAlSE) {

            if ($row_relatorio['SITUACAO'] == 'A') {
                $situacao = 'ATIVO';
            } else {
                $situacao = 'DESATIVADO';
            }

            $html .= "
                    <tr>";
            $html .=  empty($row_relatorio['NOME_EMPRESA']) ? '<td>----------</td>' : '<td>' . $row_relatorio['NOME_EMPRESA'] . '</td>';
            $html .=  empty($row_relatorio['NOME_DEPARTAMENTO']) ? '<td>----------</td>' : '<td>' . $row_relatorio['NOME_DEPARTAMENTO'] . '</td>';
            $html .=  empty($row_relatorio['CPF_GESTOR']) ? '<td>----------</td>' : '<td>' . $row_relatorio['CPF_GESTOR'] . '</td>';
            $html .=  empty($row_relatorio['LOGIN_SMARTSHARE']) ? '<td>----------</td>' : '<td>' . $row_relatorio['LOGIN_SMARTSHARE'] . '</td>';
            $html .=  empty($situacao) ? '<td>----------</td>' : '<td>' . $situacao . '</td>';

            $html .= "
                    </tr>";
        }
        $html .= "</tbody>
                </table>
            </body>
        </html>";

        // Configurações header para forçar o download
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: application/x-msexcel");
        header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
        header("Content-Description: PHP Generated Data");
        // Envia o conteúdo do arquivo
        echo $html;
        break;

    case 6:
        //aplicando a query

        $queryAprovFilial .= " WHERE tipo_registro = 'G'";

        $resultQueryAprovFilial = ociparse($conn, $queryAprovFilial);
        ociexecute($resultQueryAprovFilial);

        $arquivo = 'aprovador_filial.xls';

        // Criamos uma tabela HTML com o formato da planilha
        $html = "
            <html>
                <style>
                    td{
                        border: solid 1px;
                    }
                </style>
                <body>
                    <table class='table table-sm' style='font-size:12px;'>
                    <thead>
                        <tr>				
                            <th>Nome Empresa</th>
                            <th>Aprovador Gestor</th>
                            <th>Situacao</th>
                        </tr>
                    </thead>
                    <tbody>";

        while (($row_relatorio = oci_fetch_array($resultQueryAprovFilial, OCI_BOTH)) != FAlSE) {

            if ($row_relatorio['SITUACAO'] == 'A') {
                $situacao = 'ATIVO';
            } else {
                $situacao = 'DESATIVADO';
            }

            $html .= "
                        <tr>";
            $html .=  empty($row_relatorio['NOME_EMPRESA']) ? '<td>----------</td>' : '<td>' . $row_relatorio['NOME_EMPRESA'] . '</td>';
            $html .=  empty($row_relatorio['APROVADOR_GESTOR']) ? '<td>----------</td>' : '<td>' . $row_relatorio['APROVADOR_GESTOR'] . '</td>';
            $html .=  empty($situacao) ? '<td>----------</td>' : '<td>' . $situacao . '</td>';

            $html .= "
                        </tr>";
        }
        $html .= "</tbody>
                    </table>
                </body>
            </html>";

        // Configurações header para forçar o download
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: application/x-msexcel");
        header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
        header("Content-Description: PHP Generated Data");
        // Envia o conteúdo do arquivo
        echo $html;
        break;

    case 7:
        //aplicando a query

        $resultUserApi = ociparse($conns, $queryUserApi);
        ociexecute($resultUserApi);

        $arquivo = 'usuario_smartshare.xls';

        // Criamos uma tabela HTML com o formato da planilha
        $html = "
        <html>
            <style>
                td{
                    border: solid 1px;
                }
            </style>
            <body>
                <table class='table table-sm' style='font-size:12px;'>
                    <thead>
                        <tr>				
                            <th>Id Regra</th>
                            <th>Usuário</th>
                            <th>E-mail</th>
                            <th>Login</th>
                            <th>Situação</th>
                        </tr>
                    </thead>
                    <tbody>";

        while (($row_relatorio = oci_fetch_array($resultUserApi, OCI_BOTH)) != FAlSE) {
            $html .= "
                                    <tr>";
            $html .=  empty($row_relatorio['CD_USUARIO']) ? '<td>----------</td>' : '<td>' . $row_relatorio['CD_USUARIO'] . '</td>';
            $html .=  empty($row_relatorio['DS_USUARIO']) ? '<td>----------</td>' : '<td>' . $row_relatorio['DS_USUARIO'] . '</td>';
            $html .=  empty($row_relatorio['DS_EMAIL']) ? '<td>----------</td>' : '<td>' . $row_relatorio['DS_EMAIL']  . '</td>';
            $html .=  empty($row_relatorio['DS_LOGIN']) ? '<td>----------</td>' : '<td>' . $row_relatorio['DS_LOGIN']  . '</td>';
            $html .=  ($row_relatorio['ST_ATIVO'] == 1) ? '<td>Ativo</td>' : '<td>Desativado</td>';
            $html .= "
                                    </tr>";
        }
        $html .= "
                    </tbody>
                </table>
            </body>
        </html>";

        // Configurações header para forçar o download
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: application/x-msexcel");
        header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
        header("Content-Description: PHP Generated Data");
        // Envia o conteúdo do arquivo
        echo $html;
        break;

    case 9:
        //aplicando a query

        $resultaprov = ociparse($conn, $aprovNF);
        ociexecute($resultaprov);

        $arquivo = 'aprovadores_nf.xls';

        // Criamos uma tabela HTML com o formato da planilha
        $html = "
            <html>
                <style>
                    td{
                        border: solid 1px;
                    }
                </style>
                <body>
                    <table class='table table-sm' style='font-size:12px;'>
                    <thead>
                        <tr>				
                            <th>Empresa</th>                                         
                            <th>Departamento</th>                        
                            <th>Area</th>
                            <th>Filial</th>
                            <th>Marca</th>                        
                            <th>Gerente</th>
                            <th>Superintendente</th>
                            <th>Situacao</th>
                        </tr>
                    </thead>
                    <tbody>";

        while (($row_relatorio = oci_fetch_array($resultaprov, OCI_BOTH)) != FAlSE) {
            $situacao = ($row_relatorio['SITUACAO'] == 'A') ? 'ATIVO' : 'DESATIVADO';
            $html .= "
                        <tr>";
            $html .=  empty($row_relatorio['NOME_EMPRESA']) ? '<td>----------</td>' : '<td>' . $row_relatorio['NOME_EMPRESA'] . '</td>';
            $html .=  empty($row_relatorio['NOME_DEPARTAMENTO']) ? '<td>----------</td>' : '<td>' . $row_relatorio['NOME_DEPARTAMENTO'] . '</td>';
            $html .=  empty($row_relatorio['APROVADOR_AREA']) ? '<td>----------</td>' : '<td>' . $row_relatorio['APROVADOR_AREA']  . '</td>';
            $html .=  empty($row_relatorio['APROVADOR_FILIAL']) ? '<td>----------</td>' : '<td>' . $row_relatorio['APROVADOR_FILIAL']  . '</td>';
            $html .=  empty($row_relatorio['APROVADOR_MARCA']) ? '<td>----------</td>' : '<td>' . $row_relatorio['APROVADOR_MARCA'] . '</td>';
            $html .=  empty($row_relatorio['APROVADOR_GERENTE']) ? '<td>----------</td>' : '<td>' . $row_relatorio['APROVADOR_GERENTE'] . '</td>';
            $html .=  empty($row_relatorio['APROVADOR_SUPERINTENDENTE']) ? '<td>----------</td>' : '<td>' . $row_relatorio['APROVADOR_SUPERINTENDENTE'] . '</td>';
            $html .=  empty($situacao) ? '<td>----------</td>' : '<td>' . $situacao . '</td>';
            $html .= "
                        </tr>";
        }
        $html .= "</tbody>
                    </table>
                </body>
            </html>";

        // Configurações header para forçar o download
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: application/x-msexcel");
        header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
        header("Content-Description: PHP Generated Data");
        // Envia o conteúdo do arquivo
        echo $html;
        break;

    case 10:
        //aplicando a query

        $resultdptorh = ociparse($conn, $departNF);
        ociexecute($resultdptorh);

        $arquivo = 'departamentos_nf.xls';

        // Criamos uma tabela HTML com o formato da planilha
        $html = "
            <html>
                <style>
                    td{
                        border: solid 1px;
                    }
                </style>
                <body>
                    <table class='table table-sm' style='font-size:12px;'>
                    <thead>
                        <tr>				
                            <th>NOME DO DEPARTAMENTO</th>                                         
                            <th>SITUACAO DO DEPARTAMENTO</th>
                        </tr>
                    </thead>
                    <tbody>";

        while (($row_relatorio = oci_fetch_array($resultdptorh, OCI_BOTH)) != FAlSE) {
            if ($row_relatorio['SITUACAO'] == 'A') {
                $situacao = 'ATIVO';
            } else {
                $situacao = 'DESATIVADO';
            }
            $html .= "
                        <tr>";
            $html .=  empty($row_relatorio['NOME_DEPARTAMENTO']) ? '<td>----------</td>' : '<td>' . $row_relatorio['NOME_DEPARTAMENTO'] . '</td>';
            $html .=  empty($situacao) ? '<td>----------</td>' : '<td>' . $situacao . '</td>';

            $html .= "
                        </tr>";
        }
        $html .= "</tbody>
                    </table>
                </body>
            </html>";

        // Configurações header para forçar o download
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: application/x-msexcel");
        header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
        header("Content-Description: PHP Generated Data");
        // Envia o conteúdo do arquivo
        echo $html;
        break;
    case 11:
        //aplicando a query

        $resultempdep = ociparse($conn, $empdepNF);
        ociexecute($resultempdep);

        $arquivo = 'empresa_departamento_nf.xls';

        // Criamos uma tabela HTML com o formato da planilha
        $html = "
            <html>
                <style>
                    td{
                        border: solid 1px;
                    }
                </style>
                <body>
                    <table class='table table-sm' style='font-size:12px;'>
                    <thead>
                        <tr>				
                            <th>Empresa</th>
                            <th>Departamento</th>
                            <th>Situacao</th>
                            <th>Gerente Aprova</th>
                            <th>Superintendente Aprova</th>                               
                            <th>Lancar Multas</th>                     
                        </tr>
                    </thead>
                    <tbody>";

        while (($row_relatorio = oci_fetch_array($resultempdep, OCI_BOTH)) != FAlSE) {
            if ($row_relatorio['SITUACAO'] == 'A') {
                $situacao = 'ATIVO';
            } else {
                $situacao = 'DESATIVADO';
            }

            if ($row_relatorio['GERENTE_APROVA'] == 'S') {
                $gerAp = 'SIM';
            } else {
                $gerAp = 'NAO';
            }

            if ($row_relatorio['SUPERINTENDENTE_APROVA'] == 'S') {
                $supAp = 'SIM';
            } else {
                $supAp = 'NAO';
            }

            $html .= "
                        <tr>";
            $html .=  empty($row_relatorio['NOME_EMPRESA']) ? '<td>----------</td>' : '<td>' . $row_relatorio['NOME_EMPRESA'] . '</td>';
            $html .=  empty($row_relatorio['NOME_DEPARTAMENTO']) ? '<td>----------</td>' : '<td>' . $row_relatorio['NOME_DEPARTAMENTO'] . '</td>';
            $html .=  empty($situacao) ? '<td>----------</td>' : '<td>' . $situacao . '</td>';
            $html .=  empty($gerAp) ? '<td>----------</td>' : '<td>' . $gerAp . '</td>';
            $html .=  empty($supAp) ? '<td>----------</td>' : '<td>' . $supAp . '</td>';
            $html .=  empty($row_relatorio['LANCA_MULTAS']) ? '<td>----------</td>' : '<td>' . $row_relatorio['LANCA_MULTAS'] . '</td>';

            $html .= "
                        </tr>";
        }
        $html .= "</tbody>
                    </table>
                </body>
            </html>";

        // Configurações header para forçar o download
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: application/x-msexcel");
        header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
        header("Content-Description: PHP Generated Data");
        // Envia o conteúdo do arquivo
        echo $html;
        break;
}
