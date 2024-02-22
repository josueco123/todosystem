<?php
require_once 'models/Task.php';

class TaskController {
    private $task;

    public function __construct() {
        $this->task = new Task();
    }

    public function addTask($data) {
    
        if(isset($data['title']) && isset($data['description']) && isset($data['due_date'])){
            $result = $this->task->addTask($data);
            return array('state' => $result, 'message' => "Guardado con exito" ); 
        }else {
            return  array('state' => false, 'message' => "No enviastes todas las variables" ); 
        }
        
    }

    public function viewTasks() {
        $result = $this->task->viewTasks();
        $tasks = $result->fetch_all(MYSQLI_ASSOC);
        return $tasks;
    }

    public function viewTask($id) {
        $result = $this->task->viewTask($id);
        $task = $result->fetch_object();
        return $task;
    }

    public function updateTask($data) {

        if(isset($data['estate_id']) && isset($data['id'] )){
            $result = $this->task->updateTask( $data);
            return array('state' => $result, 'message' => "Actualizado con exito" ); 
        }else {
            return  array('state' => false, 'message' => "No enviastes todas las variables" ); 
        }
       
    }

    public function deleteTask($id) {
        $result = $this->task->deleteTask($id);
        return $result; 
    }
}