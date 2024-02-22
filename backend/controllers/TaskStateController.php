<?php
require_once 'models/TaskState.php';

class TaskStateController {
    private $taskState;

    public function __construct() {
        $this->taskState = new TaskState();
    }

    public function viewTaskStates() {
        $result = $this->taskState->viewStates();
        $tasks = $result->fetch_all(MYSQLI_ASSOC);
        return $tasks;
    }
}