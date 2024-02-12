<?php

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST' && isset($_POST['all'])) {
	function deleteVendaFromPost(): void {
		$deleteAll = filter_var($_POST['all'], FILTER_VALIDATE_BOOLEAN);
		$dados = json_decode(htmlspecialchars_decode($_POST['ids']));

		if (is_array($dados)) {
			$msg = deleteVendas($deleteAll, $dados);
		}

		echo json_encode([
			'mensagem' => 'Registros deletados com sucesso!'
		]);
		exit();
	}

	deleteVendaFromPost();
}

if ($method === 'GET' && (isset($_GET['buscar']) && $_GET['buscar'] == 'todos')) {

	function getVendasService(): void {
		$dados = getVendas();
		$totalRegistros = count($dados);

		echo json_encode([
			'totalRegistros' => $totalRegistros,
			'dados' => $dados
		]);
		exit();
	}


	getVendasService();
}