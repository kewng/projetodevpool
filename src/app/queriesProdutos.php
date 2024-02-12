<?php

require_once('connectionDB.php');

class QueriesProdutos {
    private $closed;
	private $conn;

	function __construct() {
		$this->openConnection();
	}

    //string $nome, dateTime $date , double $subtotal, int $desconto, double $total
	function insert(array $dados) {
        if ($this->isConnectionClosed()) {
            $this->openConnection();
        }

        $command = 'INSERT INTO produtos (nome, descricao, preco, unidadeMedida, situacao) VALUES 
											(\''.$dados['nome'].'\',
					 						\''.$dados['descricao'].'\',
					 						\''.$dados['preco'].'\',
					 						\''.$dados['unidadeMedida'].'\',
					 						\''.$dados['situacao'].'\')';

        
		$insert = $this->conn->prepare($command);

		$insert->execute();

		$id = $this->conn->lastInsertId();

		$this->closeConnection();

		return ['id' => $id];
	}
	
    function get($id): array {
		if ($this->isConnectionClosed()) {
            $this->openConnection();
        }

		$command = 'SELECT * FROM produtos WHERE id='.$id;

		$fetched = $this->conn->query($command);
		$dados = $fetched->fetchAll();

		$this->closeConnection();

		return $dados;
	}

    function getAll(): array {
        if ($this->isConnectionClosed()) {
            $this->openConnection();
        }

		$command = 'SELECT * FROM produtos';

		$fetched = $this->conn->query($command);
		$dados = $fetched->fetchAll();

		$this->closeConnection();

		return $dados;
	}

	function update(array $dados) {
		if ($this->isConnectionClosed()) {
    	    $this->openConnection();
    	}

		$command = 'UPDATE produtos SET 
									nome=\''.$dados['nome'].'\', 
									descricao=\''.$dados['descricao'].'\', 
									preco='.$dados['preco'].',
									unidadeMedida=\''.$dados['unidadeMedida'].'\',
									situacao=\''.$dados['situacao'].'\' 
					WHERE id='.$dados['id'].';';


		$insert = $this->conn->prepare($command);
		$insert->execute();

		$this->closeConnection();
	}

	
	function deleteAll() {
        if ($this->isConnectionClosed()) {
            $this->openConnection();
        }

		$command = 'DELETE FROM produtos;';

		$insert = $this->conn->prepare($command);
		$insert->execute();
		
		$this->closeConnection();
	}

	function delete($id) {
        if ($this->isConnectionClosed()) {
            $this->openConnection();
		}

		$command = 'DELETE FROM produtos WHERE id=' . $id;

		$insert = $this->conn->prepare($command);
		$insert->execute();
		
		$this->closeConnection();
	}

	function closeConnection(): void {
		$this->conn = null;
        $this->closed = true;
	}

    function openConnection(): void {
        $connectionDB = new ConnectionDB;
        $this->conn = $connectionDB->connect();
        $this->closed = false;
    }

    function isConnectionClosed() {
        return $this->closed;
    }
}

?>