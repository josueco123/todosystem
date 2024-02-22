<?php
require_once 'controllers/TaskController.php';
require_once 'controllers/TaskStateController.php';

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

$taskController = new TaskController();
$taskStateController = new TaskStateController();

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['id']))
    {
        try{
            $id = $_GET['id'];
            $task = $taskController->viewTask($id);
            http_response_code(200);
            echo json_encode(array('task' => $task)); 
        }catch(Exception $e){
            http_response_code(500);
            echo json_encode(array('message' => $e->getMessage())); 
        }
       
    } else if(isset($_GET['states'])){
        try{
            $states = $taskStateController->viewTaskStates();
            http_response_code(200);
            echo json_encode(array('states' => $states)); 
        }catch(Exception $e){
            http_response_code(500);
            echo json_encode(array('message' => $e->getMessage())); 
        }
    }else{
        try{
            $tasks = $taskController->viewTasks();
            http_response_code(200);
            echo json_encode(array('tasks' => $tasks)); 
        }catch(Exception $e){
            http_response_code(500);
            echo json_encode(array('message' => $e->getMessage())); 
        }
        
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT'){

    if (isset($_GET['save'])){
        try{
            $body = file_get_contents('php://input');
            $data = json_decode($body, true);
            $response = $taskController->addTask($data);
    
            echo json_encode($response);
    
        }catch(Exception $e){
            http_response_code(500);
            echo json_encode(array('message' => $e->getMessage())); 
        }
    }else{
        try{
            $body = file_get_contents('php://input');
            $data = json_decode($body, true);
            $response = $taskController->updateTask($data);
            echo json_encode($response);
            
    
        }catch(Exception $e){
            http_response_code(500);
            echo json_encode(array('message' => $e->getMessage())); 
        }
    }
    
    
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){
    if (isset($_GET['id'])){
        try{
            $id = $_GET['id'];
            $response = $taskController->deleteTask($id);
            
            if($response){
                http_response_code(200);
            }else {
                http_response_code(400);
            }
    
            echo json_encode(array('result' => $response));
    
        }catch(Exception $e){
            http_response_code(500);
            echo json_encode(array('message' => $e->getMessage())); 
        }
       
    }
   
    
}

?>