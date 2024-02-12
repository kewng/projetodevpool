<?php

require_once(dirname(__DIR__).'/queriesVendas.php');

function registroVenda(array $dados) { 
    $db = new QueriesVendas();

    $id = $db->insert($dados);

    return $id;
}

function updateVenda(array $dados) { 
    $db = new QueriesVendas();

    $id = $db->update($dados);

    return $id;
}

function getVendasFromDb($id) {
    $db = new QueriesVendas();

    $venda = $db->get($id);

    return $venda;
}