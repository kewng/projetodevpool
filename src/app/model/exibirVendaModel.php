<?php

require_once(dirname(__DIR__).'/queriesVendas.php');

function getVendas() { 
    $db = new QueriesVendas();

    $id = $db->getAll();

    return $id;
}

function deleteVendas($all, $dados) {
    $db = new QueriesVendas();

    if ($all) {
        $db->deleteAll();
    } else {
        foreach ($dados as &$id) {
            $db->delete($id);
        }
    }
}