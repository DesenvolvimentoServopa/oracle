<?php
session_start();

//chamando os bancos
include 'header.php';

include '../config/conexaoSmart.php';

include '../config/sqlSmart.php';

include '../config/conexaoSmartSelbetti.php';

echo'        
<!-- INICIO DO CONTEUDO DA PÁGINA -->
    <div class="container">

    <!-- Page Cabeçalho -->
    <title>Nova Regra Departamento RH</title>
    <h1 class="text-xs mb-6 text-gray-800 style="margin-left: 109px;"">
        <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
        <a href="smartshare.php?id_usuario='.$_GET['id_usuario'].'"><i class="fas fa-list"></i> SmartShare</a> /
        <i class="fas fa-user-plus"></i> Nova Regra Departamento RH
    </h1>

    <div class="text-center">
        <h1 class="h3 mb-4 text-gray-800">NOVA REGRA DEPARTAMENTO RH</h1>
    </div>

    
    <div class="col-lg-6" style="margin-left: 25%;">
        <form id="novaRegraDeptoRH" name="novaRegraDeptoRH" method="POST" action="../bd/novaRegraDep.php?id_usuario=' .$_GET['id_usuario']. '">
            <div>
                <input style="display:none" name="id" value="2"/>  
            </div>

            <!-- INICIO INPUT DEPARTAMENTOS RH -->    
            <div class="form-group">
                <label for="nomedpto">DEPARTAMENTO:
                    <span>
                        <a href="javascript:" title="Campo obrigatório" style="color:red;">
                            <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <input type="text" class="form-control" name="nomedpto" id="nomedpto" placeholder="INSIRA NOVO DEPARTAMENTO" required>    
            </div>
            <!-- FIM INPUT DEPARTAMENTOS RH -->

            <!-- INICIO DROP SITUAÇÃO -->
            <div class="form-group">
                <label for="situacao">SITUAÇÃO:
                    <span>
                        <a href="javascript:" title="Campo obrigatório" style="color:red;">
                            <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <select class="form-control" placeholder="Situação"  name="situacao" type="text" id="situacao" required>
                    <option value="">------------------</option>         
                    <option value="A">ATIVADO</option> 
                    <option value="D">DESATIVADO</option> 
                </select>
            </div>
            <!-- FIM DROP SITUAÇÃO -->

            <!-- BOTÃO SALVAR -->
            <button class="btn btn-success" name="salvar" type="submit">Salvar</button>
            <a class="btn btn-danger" href="smartshare_pag.php?id_drop=2&id_usuario='.$_GET['id_usuario'].'">Voltar</a>
            <!-- BOTÃO SALVAR -->   

        </form>
    </div>
    </body>       
';

include 'footer.php'

?>