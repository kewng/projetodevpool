<?php

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {

	function insertVendas(): void {
        if (!isset($_POST['nome'])) return;

		$nome = $_POST['nome'];
		$dataVenda = $_POST['dataVenda'];
        $subtotal = $_POST['subtotal'];
        $desconto = $_POST['desconto'];
        $totalVenda = $_POST['totalVenda'];
        $produtos = $_POST['produtos'];

		if (!empty($nome)) {
            $result = null;
            $message = '';


            if (isset($_POST['id'])) {
                $result = updateVenda([ 'nome' => $nome, 
                                        'dataVenda' => $dataVenda, 
                                        'subtotal' => $subtotal,
                                        'desconto' => $desconto,
                                        'totalVenda' => $totalVenda,
                                        'produtos' => $produtos,
                                        'id' => $_POST['id']]);
                
                $message = 'O registro n° '.$_POST['id'].' foi atualizado com sucesso.';
            } else {
                $result = registroVenda([ 'nome' => $nome, 
                                        'dataVenda' => $dataVenda, 
                                        'subtotal' => $subtotal,
                                        'desconto' => $desconto,
                                        'totalVenda' => $totalVenda,
                                        'produtos' => $produtos]);

                $message = 'Registro N° ' . $result['id'] . ' salvo com sucesso';
            }
        			
            
            
            echo json_encode([
                'tipo' => 'success',
                'mensagem' => $message
            ]);
		} else {
            echo json_encode([
                'tipo' => 'fail',
                'mensagem' => 'Há campos obrigatórios não preenchidos!'
            ]);
        }
		
		exit();
	}

    insertVendas();
    
} else if ($method === 'GET' && isset($_GET['idLoad'])) {
	function getVendas(): void {
        $id = $_GET['idLoad'];
        $result = 'fail';

        $vendas = getVendasFromDb($id);

        if (count($vendas) > 0) {
            $result = 'success';
        }

        echo json_encode([
            'tipo' => $result,
            'venda' => $vendas
        ]);
        exit();
    }
    
    getVendas();
}