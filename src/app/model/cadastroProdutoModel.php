<?php

require_once(dirname(__DIR__).'/queriesProdutos.php');

function registroProduto(array $dados) { 
    $db = new QueriesProdutos();

    $id = $db->insert($dados);

    return $id;
}

function updateProduto(array $dados) { 
    $db = new QueriesProdutos();

    $id = $db->update($dados);

    return $id;
}

function getProdutoFromDb($id) {
    $db = new QueriesProdutos();

    $product = $db->get($id);

    return $product;
}