<?php

switch ($_GET['id']) {
    case '1':
        $titulo = 'Nova Regra';
        $menu = 'nova regra';
        $favicon = '<i class="fas fa-user-plus"></i>';
        $tituloTabela = 'Nova Regra Aprovadores RH';
        break;
    
    case '2':
        $titulo = 'Nova Regra';
        $menu = 'nova regra';
        $favicon = '<i class="fas fa-sitemap"></i>';
        $tituloTabela = 'Nova Regra Departamento RH';
        break;
}

?>