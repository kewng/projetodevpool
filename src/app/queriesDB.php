<?php

require_once('connectionDB.php');

class QueriesDB {
	private $conn;

	function __construct() {
		$connectionDB = new ConnectionDB;
		$this->conn = $connectionDB->connect();
	}

	function insert(string $params): int {
		$insert = $this->conn->prepare($params);
		$insert->execute();
		$id = $this->conn->lastInsertId();

		$this->closeConnection();

		return $id;
	} 

	function getAll(string $params): array {
		$fetched = $this->conn->query($params);
		$dados = $fetched->fetchAll();

		$this->closeConnection();

		return $dados;
	}

	function update() {
		
	}

	function delete() {
		
	}

	function closeConnection(): void {
		$this->conn = null;
	}
}