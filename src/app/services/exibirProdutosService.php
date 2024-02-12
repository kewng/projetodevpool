<?php

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST' && isset($_POST['all'])) {
	function deleteProductFromPost(): void {
		$deleteAll = filter_var($_POST['all'], FILTER_VALIDATE_BOOLEAN);
		$dados = json_decode(htmlspecialchars_decode($_POST['ids']));

		if (is_array($dados)) {
			$msg = deleteProdutos($deleteAll, $dados);
		}

		echo json_encode([
			'mensagem' => 'Registros deletados com sucesso!'
		]);
		exit();
	}

	deleteProductFromPost();
}

if ($method === 'GET' && (isset($_GET['buscar']) && $_GET['buscar'] == 'todos')) {

	function getProdutosService(): void {
		$dados = getProdutos();
		$totalRegistros = count($dados);

		echo json_encode([
			'totalRegistros' => $totalRegistros,
			'dados' => $dados
		]);
		exit();
	}

	getProdutosService();
}