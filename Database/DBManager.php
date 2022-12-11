<?php

require_once "DBCredentials.php";

class DBManager
{
    public $conn;

    public function __construct(DBCredentials $credentials){
        $this->conn = $this->getConnection($credentials);
    }

    private function getConnection(DBCredentials $credentials){
        $conn = null;
        if ($credentials->uses_socket)
            $dsn = "unix_socket=" . $credentials->socket;
        else
            $dsn = "host=" . $credentials->server;

        $conn = new PDO('mysql:' . $dsn . ';dbname=' . $credentials->db_name, $credentials->username, $credentials->password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $conn;
    }

    public function read($query, $parameters = []){
        $stmt = $this->conn->prepare($query);
        $stmt->execute($parameters);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create_update_delete($query, $parameters = []) {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($parameters);
    }

    public function get_last_inserted_id() {
        return $this->conn->lastInsertId();
    }

    public function read_with_custom_function($query, $parameters, $modifier){
        $stmt = $this->conn->prepare($query);
        $stmt->execute($parameters);

        $results = [];
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        while ($row != false) {
            $results[] = $modifier($row);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);;
        }
        return $results;
    }

}