<?php

require_once('connectionDB.php');

class QueriesVendas {
    private $closed;
	private $conn;

	function __construct() {
		$this->openConnection();
	}

	function insert(array $dados) {
        if ($this->isConnectionClosed()) {
            $this->openConnection();
        }


		$command = 'INSERT INTO venda (nome, dataVenda, subtotal, desconto, totalVenda, produtos) VALUES 
							(\''. $dados['nome'] .'\',
							STR_TO_DATE(\''. str_replace('-', '/', $dados['dataVenda']) .'\', \'%Y/%m/%d\'),
							\''. $dados['subtotal'] .'\',
							\''. $dados['desconto'] .'\',
							\''. $dados['totalVenda'] .'\',
							\''. $dados['produtos'].'\')';

        
		$insert = $this->conn->prepare($command);
		$insert->execute();
		$id = $this->conn->lastInsertId();

		$this->closeConnection();

		return ['id' => $id];
	} 

	function getAll(): array {
        if ($this->isConnectionClosed()) {
            $this->openConnection();
        }

		$command = 'SELECT * FROM venda;';

		$fetched = $this->conn->query($command);
		$dados = $fetched->fetchAll();

		$this->closeConnection();

		return $dados;
	}
	
    function get($id): array {
		if ($this->isConnectionClosed()) {
            $this->openConnection();
        }

		$command = 'SELECT * FROM venda WHERE id='.$id;

		$fetched = $this->conn->query($command);
		$dados = $fetched->fetchAll();

		$this->closeConnection();

		return $dados;
	}

	function update(array $dados) {
		if ($this->isConnectionClosed()) {
    	    $this->openConnection();
    	}

		$command = 'UPDATE venda SET 
									nome=\''.$dados['nome'].'\', 
									dataVenda=\''.$dados['dataVenda'].'\', 
									subtotal='.$dados['subtotal'].',
									desconto='.$dados['desconto'].',
									totalVenda='.$dados['totalVenda'].',
									produtos=\''. $dados['produtos'].'\' 
							WHERE id='.$dados['id'].';';


		$insert = $this->conn->prepare($command);
		$insert->execute();

		$this->closeConnection();
	}

	function deleteAll() {
        if ($this->isConnectionClosed()) {
            $this->openConnection();
        }

		$command = 'DELETE FROM venda;';

		$insert = $this->conn->prepare($command);
		$insert->execute();
		
		$this->closeConnection();
	}

	function delete($id) {
        if ($this->isConnectionClosed()) {
            $this->openConnection();
		}

		$command = 'DELETE FROM venda WHERE id=' . $id;

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