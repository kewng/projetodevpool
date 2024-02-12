<?php

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {

	function insertProduto(): void {
        if (!isset($_POST['nome'])) return;

		$nome = $_POST['nome'];
		$descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $unidadeMedida = $_POST['unidadeMedida'];
        $situacao = $_POST['situacao'];

		if (!empty($nome) && !empty($preco) && !empty($situacao)) {
            $result = null;
            $message = '';

            if (isset($_POST['id'])) {
                $result = updateProduto([ 'nome' => $nome, 
                                        'descricao' => $descricao, 
                                        'preco' => $preco,
                                        'unidadeMedida' => $unidadeMedida,
                                        'situacao' => $situacao,
                                        'id' => $_POST['id']]);
                
                $message = 'O registro n° '.$_POST['id'].' foi atualizado com sucesso.';
            } else {
                $result = registroProduto([ 'nome' => $nome, 
                                        'descricao' => $descricao, 
                                        'preco' => $preco,
                                        'unidadeMedida' => $unidadeMedida,
                                        'situacao' => $situacao]);

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

    insertProduto();
} else if ($method === 'GET' && isset($_GET['idLoad'])) {
	function getProduto(): void {
        $id = $_GET['idLoad'];
        $result = 'fail';

        $produto = getProdutoFromDb($id);

        if (count($produto) > 0) {
            $result = 'success';
        }

        echo json_encode([
            'tipo' => $result,
            'produto' => $produto
        ]);
        exit();
    }
    
    getProduto();
}