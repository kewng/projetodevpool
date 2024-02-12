<?php

require_once(dirname(__DIR__).'/queriesProdutos.php');

function getProdutos() { 
    $db = new QueriesProdutos();

    $id = $db->getAll();

    return $id;
}

function deleteProdutos($all, $dados) {
    $db = new QueriesProdutos();

    if ($all) {
        $db->deleteAll();
    } else {
        foreach ($dados as &$id) {
            $db->delete($id);
        }
    }
}