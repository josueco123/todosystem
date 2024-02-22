<?php
require_once 'Database.php';

class Task {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function addTask($data) {
        $title = $data['title'];
        $description = $data['description'];
        $due_date = date($data['due_date']);
        $query = "INSERT INTO tk_tasks (title, description, estate_id, due_date) VALUES ('$title', '$description', 1 , '$due_date')";
        $result = mysqli_query($this->db->getConnection(), $query);
        return $result;
    }

    public function viewTasks() {
        $query = "SELECT tk_tasks.id, tk_tasks.title, tk_tasks.description, tk_tasks.due_date, tk_tasks.created_at, tk_estatestask.name  AS estate FROM tk_tasks INNER JOIN tk_estatestask ON tk_tasks.estate_id = tk_estatestask.id WHERE deleted_at IS NULL";
        $result = mysqli_query($this->db->getConnection(), $query);
        return $result;
    }

    public function viewTask($id) {
        $query = "SELECT * FROM tk_tasks WHERE id = $id AND  deleted_at IS NULL";
        $result = mysqli_query($this->db->getConnection(), $query);
        return $result;
    }

    public function updateTask($data) {
        $id = $data['id'];
        $date =  date('Y-m-d H:i:s');
        $estate = $data['estate_id'];
        $query = "UPDATE tk_tasks SET estate_id = '$estate', updated_at = '$date' WHERE id = $id";
        $result = mysqli_query($this->db->getConnection(), $query);
        return $result;
    }

    public function deleteTask($id) {
        $date =  date('Y-m-d H:i:s');
        $query = "UPDATE tk_tasks SET  deleted_at = '$date' WHERE id = $id";
        $result = mysqli_query($this->db->getConnection(), $query);
        return $result;
    }
}