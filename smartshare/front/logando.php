<?php
session_start();

if($_GET['id_usuario'] != NULL){

    //recebendo as variaveis via GET e transformando em SESSION
    $_SESSION['id_usuario'] = $_GET['id_usuario'];
    $_SESSION['nome'] = $_GET['nome'];
    $_SESSION['admin'] = $_GET['admin'];
    
    header('Location: smartshare.php?id_usuario='.$_GET['id_usuario'].'');

}else{
    echo "Error[1]: Usuário nao localizado, por favor contate o administrador!";
}




?>