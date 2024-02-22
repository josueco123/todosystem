<?php
require_once 'Database.php';

class TaskState {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function viewStates() {
        $query = "SELECT id, name  FROM tk_estatestask";
        $result = mysqli_query($this->db->getConnection(), $query);
        return $result;
    }
}