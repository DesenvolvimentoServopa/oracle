<?php
session_start();

//chamando os bancos
include 'header.php';

include '../config/conexaoSmart.php';

include '../config/sqlSmart.php';

include '../config/conexaoSmartSelbetti.php';
?>

<!-- INICIO DO CONTEUDO DA PÁGINA -->
<div class="container">

    <!-- Page Cabeçalho -->
    <title>Nova Regra Empresa</title>
    <h1 class="text-xs mb-6 text-gray-800" style="margin-left: 109px;">
        <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
        <a href="smartshare.php?id_usuario=<?= $_GET['id_usuario'] ?>"><i class="fas fa-list"></i> BPMServopa</a> /
        <i class="fas fa-user-plus"></i> Nova Regra Empresa
    </h1>

    <div class="text-center">
        <h1 class="h3 mb-4 text-gray-800">NOVA REGRA EMPRESA</h1>
    </div>


    <div class="col-lg-6" style="margin-left: 25%;">
        <form id="novaRegraEmpresa" name="novaRegraEmpresa" method="POST" action="../bd/novaRegraEmp.php?situacao=a&id_usuario=<?= $_GET['id_usuario'] ?>">
            <div>
                <input style="display:none" name="id" value="3" />
            </div>

            <!-- INICIO DROP EMPRESA -->
            <div class="form-group">
                <label for="empresa">EMPRESA:
                    <span>
                        <a href="javascript:" title="Campo obrigatório" style="color:red;">
                            <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <input type="text" class="form-control" name="empresa" value="<?= $_SESSION['empresa']  ?>" id="empresa" placeholder=" INSIRA NOVA EMPRESA" required>
            </div>
            <!-- FIM DROP EMPRESA -->

            <!-- INICIO DROP SISTEMA -->
            <div class="form-group">
                <label for="sistema">SISTEMA:
                    <span>
                        <a href="javascript:" title="Campo obrigatório" style="color:red;">
                            <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <select class="form-control" onchange="dropSistema()" placeholder="Sistema" name="sistema" type="text" id="sistema" required>
                    <?php
                    if (!empty($_SESSION['sistema'])) {
                        switch ($_SESSION['sistema']) {
                            case 'A':
                                echo '<option value="A">APOLLO</option>';
                                break;
                            case 'N':
                                echo '<option value="N">BANCO NBS</option>';
                                break;
                            case 'H':
                                echo '<option value="H">BANCO HARLEY</option>';
                                break;
                            case '0':
                                echo '<option value="0">EMPRESA QUE NÃO USA SISTEMA ERP</option>';
                                break;
                        }
                        echo '<option value="">------------------</option>';
                    } else {
                        echo '<option value="">------------------</option>';
                    }
                    ?>
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
                        <a href="javascript:" title="Campo obrigatório" style="color:red;">
                            <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <input type="text" class="form-control" onkeypress="onlynumber()" maxlength="2" name="empApollo" value="<?= $_SESSION['empApollo'] ?>" id="empApollo" placeholder=" INSIRA EMPRESA APOLLO">
            </div>
            <!-- FIM INPUT EMPRESA APOLLO -->

            <!-- INICIO INPUT REVENDA APOLLO -->
            <div class="form-group" id="revendaApollo">
                <label for="revApollo">REVENDA APOLLO:
                    <span>
                        <a href="javascript:" title="Campo obrigatório" style="color:red;">
                            <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <input type="text" class="form-control" onkeypress="onlynumber()" maxlength="2" name="revApollo" value="<?= $_SESSION['revApollo'] ?>" id="revApollo" placeholder=" INSIRA REVENDA APOLLO">
            </div>
            <!-- FIM INPUT REVENDA APOLLO -->

            <!-- INICIO INPUT EMPRESA NBS -->
            <div class="form-group" id="empresaNbs">
                <label for="marca">EMPRESA NBS:
                    <span>
                        <a href="javascript:" title="Campo obrigatório" style="color:red;">
                            <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <input type="text" class="form-control" onkeypress="onlynumber()" maxlength="2" name="empnbs" value="<?= $_SESSION['empnbs'] ?>" id="empnbs" placeholder=" INSIRA EMPRESA NBS">
            </div>
            <!-- FIM INPUT EMPRESA NBS -->

            <!-- INICIO INPUT ORGANOGRAMA SENIOR -->
            <div class="form-group">
                <label for="marca">ORGANOGRAMA SENIOR:
                    <span>
                        <a href="javascript:" title="Verificar informação com a Celina!" style="color:red;">
                            <i class="fas fa-question-circle" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <input type="text" class="form-control" onkeypress="onlynumber()" maxlength="2" name="orgsenior" value="<?= $_SESSION['orgsenior'] ?>" id="orgsenior" placeholder=" INSIRA ORGANOGRAMA SENIOR" required>
            </div>
            <!-- FIM INPUT ORGANOGRAMA SENIOR -->

            <!-- INICIO INPUT EMPRESA SENIOR -->
            <div class="form-group">
                <label for="marca">EMPRESA SENIOR:
                    <span>
                        <a href="javascript:" title="Verificar informação com a Celina!" style="color:red;">
                            <i class="fas fa-question-circle" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <input type="text" class="form-control" onkeypress="onlynumber()" maxlength="2" name="empresasenior" value="<?= $_SESSION['empresasenior'] ?>" id="empresasenior" placeholder=" INSIRA EMPRESA SENIOR" required>
            </div>
            <!-- FIM INPUT EMPRESA SENIOR -->

            <!-- INICIO INPUT FILIAL SENIOR -->
            <div class="form-group">
                <label for="marca">FILIAL SENIOR:
                    <span>
                        <a href="javascript:" title="Verificar informação com a Celina!" style="color:red;">
                            <i class="fas fa-question-circle" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <input type="text" class="form-control" onkeypress="onlynumber()" maxlength="2" name="filialsenior" value="<?= $_SESSION['filialsenior'] ?>" id="filialsenior" placeholder=" INSIRA FILIAL SENIOR" required>
            </div>
            <!-- FIM INPUT FILIAL SENIOR -->

            <!-- INICIO DROP CONSORCIO -->
            <div class="form-group">
                <label for="marca">CONSÓRCIO:
                    <span>
                        <a href="javascript:" title="Campo obrigatório" style="color:red;">
                            <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <select class="form-control" placeholder="Consórcio" name="consorcio" type="text" id="consorcio" required>
                    <?php
                    if (!empty($_SESSION['consorcio'])) {
                        switch ($_SESSION['consorcio']) {
                            case 'S':
                                echo '<option value="S">SIM</option>';
                                break;
                            case 'N':
                                echo '<option value="N">NÃO</option>';
                                break;
                        }
                        echo '<option value="">------------------</option>';
                    } else {
                        echo '<option value="">------------------</option>';
                    }
                    ?>
                    <option value="S">SIM</option>
                    <option value="N">NÃO</option>
                </select>
            </div>
            <!-- FIM DROP CONSORCIO -->

            <!-- INICIO DROP SITUAÇÃO -->
            <div class="form-group">
                <label for="marca">SITUAÇÃO:
                    <span>
                        <a href="javascript:" title="Campo obrigatório" style="color:red;">
                            <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <select class="form-control" placeholder="Situação" name="situacao" type="text" id="situacao" required>
                    <?php
                    if (!empty($_SESSION['situacao'])) {
                        switch ($_SESSION['situacao']) {
                            case 'A':
                                echo '<option value="A">ATIVO</option>';
                                break;
                            case 'D':
                                echo '<option value="D">DESATIVADO</option>';
                                break;
                        }
                        echo '<option value="">------------------</option>';
                    } else {
                        echo '<option value="">------------------</option>';
                    }
                    ?>
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
                    <option value=''>------------</option>
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
                <input type="text" class="form-control" onblur="aprovador()" onkeypress="onlynumber()" maxlength="5" name="numero_caixa" value="<?= $_SESSION['numero_caixa'] ?>" id="numero_caixa" style="width: 20%">
            </div>
            <!-- FIM NUMERO CAIXA -->
            
            <!-- INICIO INPUT EMPRESA SENIOR -->
            <div class="form-group" style="display: <?= empty($_GET['ds_usuario']) ? 'none' : 'block' ?>;" id="liberarApro">
                <label for="marca">APROVADOR CAIXA:</label>
                <select class="form-control" placeholder="Situação" name="aproCaixa" type="text" id="aproCaixa">
                    <option>------------------</option>
                    <?php
                    $queryUserApi .= " ORDER BY ds_usuario ASC";
                    $resultadoUsuario = oci_parse($conns, $queryUserApi);
                    oci_execute($resultadoUsuario);

                    while (($usuario = oci_fetch_array($resultadoUsuario, OCI_BOTH)) != false) {
                        echo '<option value="' . $usuario['DS_LOGIN'] . '">' . $usuario['DS_USUARIO'] . ' / ' . $usuario['DS_LOGIN'] . '</option>';
                    }

                    ?>
                </select>
            </div>
            <!-- FIM INPUT EMPRESA SENIOR -->

            <!--LOCALIZANDO USUARIO-->
            <script>
                function aprovador() {
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

            <!-- BOTÃO SALVAR -->
            <div class="form-group">
                <button class="btn btn-success" name="salvar" type="submit">Salvar</button>
                <a class="btn btn-danger" href="smartshare_pag.php?id_drop=1&id_usuario=<?= $_GET['id_usuario'] ?>">Voltar</a>
            </div>
            <!-- BOTÃO SALVAR -->

        </form>
    </div>

    <!--FECHANDO SESSÔES-->
    <?php
    unset($_SESSION['empresa']);
    unset($_SESSION['empresa']);
    unset($_SESSION['sistema']);
    unset($_SESSION['empApollo']);
    unset($_SESSION['revApollo']);
    unset($_SESSION['empnbs']);
    unset($_SESSION['orgsenior']);
    unset($_SESSION['empresasenior']);
    unset($_SESSION['filialsenior']);
    unset($_SESSION['consorcio']);
    unset($_SESSION['situacao']);
    unset($_SESSION['numero_caixa']);

    include 'footer.php'
    ?>