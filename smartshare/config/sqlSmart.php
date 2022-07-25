<?php

/* Select para a tela Aprovadores RH */
$aprov = 'SELECT
        a.aprovador_filial,
        a.aprovador_area,
        a.aprovador_marca,
        a.aprovador_superintendente,
        a.id_empresa,
        a.id_departamento,
        a.aprovador_gerente,
        e.nome_empresa,
        d.nome_departamento,
        a.situacao, 
        a.*
    FROM
        aprovadores_rh a
    INNER JOIN empresa e ON a.id_empresa = e.id_empresa
    INNER JOIN departamento_rh d ON a.id_departamento = d.id_departamento';


/* Select para a tela Aprovadores NF */
$aprovNF = 'SELECT
a.aprovador_filial,
a.aprovador_area,
a.aprovador_marca,
a.aprovador_superintendente,
a.id_empresa,
a.id_departamento,
a.aprovador_gerente,
e.nome_empresa,
d.nome_departamento,
a.situacao, 
a.*
FROM
aprovadores_nf a
INNER JOIN empresa e ON a.id_empresa = e.id_empresa
INNER JOIN departamento_nf d ON a.id_departamento = d.id_departamento';


/* Select para a tela de Departmento RH */
$departrh = 'SELECT
        d.nome_departamento,
        d.situacao,
        d.id_departamento
    FROM
        departamento_rh d';

  /* Select para a tela de Departmento RH */
$departNF = 'SELECT
        d.nome_departamento,
        d.situacao,
        d.id_departamento
    FROM
        departamento_nf d';      


/* Select para a tela de Empresa */
/* É necessário trocar os resultados dos campos sistema, situação, consórcio */
$emp = 'SELECT
        e.nome_empresa,
        e.uf_gestao,
        e.id_empresa,
        e.sistema,
        e.empresa_apollo,
        e.revenda_apollo,
        e.empresa_nbs,
        e.organograma_senior,
        e.empresa_senior,
        e.filial_senior,
        e.situacao,
        e.consorcio,
        e.numero_caixa,
        e.aprovador_caixa
    FROM
        empresa e';


$empNew = 'SELECT
            *
        FROM
            empresa
        ORDER BY
            nome_empresa ASC';         


/* Select para a tela de Empresa_Departamento */
$empdep = 'SELECT
        e.id_empdep,
        r.nome_empresa,
        e.id_departamento,
        e.situacao,
        e.gerente_aprova,
        e.superintendente_aprova,
        d.nome_departamento
    FROM
        empresa_departamento e
        INNER JOIN departamento_rh d ON d.id_departamento = e.id_departamento
        INNER JOIN empresa r ON r.id_empresa = e.id_empresa';

$empdepNF = 'SELECT
        e.id_empdep,
        r.nome_empresa,
        e.id_departamento,
        e.situacao,
        e.gerente_aprova,
        e.superintendente_aprova,
        d.nome_departamento
    FROM
        empresa_departamento_NF e
        INNER JOIN departamento_nf d ON d.id_departamento = e.id_departamento
        INNER JOIN empresa r ON r.id_empresa = e.id_empresa';

/* Select para a tela de Empresa_Departamento */
$empdepNF = 'SELECT
e.id_empdep,
e.lanca_multas,
r.nome_empresa,
e.id_departamento,
e.situacao,
e.gerente_aprova,
e.superintendente_aprova,
d.nome_departamento
FROM
empresa_departamento_nf e
INNER JOIN departamento_nf d ON d.id_departamento = e.id_departamento
INNER JOIN empresa r ON r.id_empresa = e.id_empresa';



$empdepedit = 'SELECT  
        DISTINCT
        d.nome_departamento,
        d.id_departamento
    FROM
        empresa_departamento e
        INNER JOIN departamento_rh d ON d.id_departamento = e.id_departamento
        INNER JOIN empresa r ON r.id_empresa = e.id_empresa
        AND d.id_departamento != (41) ORDER BY d.nome_departamento ASC';        


$empdepNew = 'SELECT 
        * 
    FROM 
        empresa_departamento e 
    INNER JOIN departamento_rh d ON d.id_departamento = e.id_departamento';

$empdepNewNF = 'SELECT 
* 
FROM 
empresa_departamento e 
INNER JOIN departamento_nf d ON d.id_departamento = e.id_departamento';


/* Select para a tela de Gestor Direto */
$gesdir = 'SELECT
        g.id_empresa,
        g.id_departamento,
        g.login_smartshare,
        g.cpf_gestor,
        g.id_gestor_direto,
        d.nome_departamento,
        e.nome_empresa,
        g.situacao
    FROM
        gestor_direto g
    INNER JOIN departamento_rh d ON d.id_departamento = g.id_departamento
    INNER JOIN empresa e ON e.id_empresa = g.id_empresa';


$query_user = 'SELECT
        ds_usuario,
        ds_login,
        cd_usuario
    FROM
        usuario
    WHERE
            st_ativo = 1
    AND cd_usuario NOT IN ( 1, 23, 24, 22, 16681,
                                18110, 18111, 18112, 18113, 18484,
                                18485, 18486, 18529, 18340, 16680,
                                18782 )
    ORDER BY  ds_usuario ASC';

$aprovsuper = 'SELECT
        aprovador_superintendente,
        id_aprovador
    FROM
        aprovadores_rh
    WHERE
        id_aprovador IN (99, 196)';


$queryAprovFilial = 'SELECT
        a.id_aprovador,
        a.id_empresa,
        a.aprovador_gestor,
        a.situacao,
        e.nome_empresa
    FROM
        aprovadores_rh a
    INNER JOIN empresa e ON e.id_empresa = a.id_empresa';



$queryUserApi = " SELECT
        ds_usuario,
        ds_login,
        cd_usuario,
        ds_email,
        st_ativo
    FROM
        usuario ";
