<?php
require_once __DIR__ . '/../Config/Database.php';

class Contato {
    private $conn;
    private $table = 'Contatos';

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function salvar($nome, $email, $telefone, $mensagem) {
        $sql = "INSERT INTO " . $this->table . " (nome, email, telefone, mensagem) 
                VALUES (:nome, :email, :telefone, :mensagem)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':mensagem', $mensagem);
        return $stmt->execute();
    }

    public function listarTodos() {
        $sql = "SELECT id, nome, email, telefone, mensagem FROM " . $this->table . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}