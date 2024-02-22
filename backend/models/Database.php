<?php
class Database {
    private $connection;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $this->connection = mysqli_connect('localhost', 'root', '', 'db_task');

        if (mysqli_connect_errno()) {
            die("Failed to connect to the database: " . mysqli_connect_error());
        }
    }

    public function getConnection() {
        return $this->connection;
    }
}