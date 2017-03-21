<?php

//---------------------------------------
//---Класс-контроллер для сущности User--
//---------------------------------------

class UserTaskController extends DBConnect {

    public $table = 'user_task';
    public $activeUserView = 'activeUserView';
    private $_fc;
    private $_params = array();
    private $_model;

    public function __construct() {
        $this->_fc = FrontController::getInstance();
        /* Инициализация модели */
        $this->_model = new FileModel();
        parent::__construct();
    }

    /*     * ----------------------------------------
     * ---методы для работы с БД-----------------
     * ------------------------------------------
     * ---Выборка назначенных сотрудникам задач--
     * ------------------------------------------
     */

    public function selectUserTasks($userId) {
        $tableView = array();
        try {
            $query = "SELECT task_id FROM " . $this->table . " WHERE user_id=" . $userId;
            $dbh = parent::getDbh();
            $resultSelect = $dbh->query($query);
            if ($resultSelect === false) {
                throw new PDOException('Ошибка при селекте UserTasks');
            }
            while ($row = $resultSelect->fetch(PDO::FETCH_ASSOC)) {
                $tableView[] = $row['task_id'];
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $tableView;
    }

    public function selectTaskUsers($taskId) {
        try {
            $query = "SELECT user_id FROM " . $this->table . " WHERE task_id=" . $taskId;
            $dbh = parent::getDbh();
            $resultSelect = $dbh->query($query);
            if ($resultSelect === false) {
                throw new PDOException('Ошибка при селекте TaskUsers.');
            }
            while ($row = $resultSelect->fetch(PDO::FETCH_ASSOC)) {
                $tableView[] = $this->selectSingleUser($row['user_id']);
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        if (isset($tableView)) {
            return $tableView;
        }
        else {
            $null[]='';
            return $null;
        }
    }

    /**
     * Этот метод возвращает имя и фамилию сотрудника по его id
     */
    public function selectSingleUser($userId) {
        try {
            $query = "SELECT firstName, secondName FROM " . $this->activeUserView . " WHERE user_id=" . $userId;
            $dbh = parent::getDbh();
            $resultSelect = $dbh->query($query);
            if ($resultSelect === false) {
                throw new PDOException("Ошибка при селекте singleUser.<br>");
            }
            $row = $resultSelect->fetch(PDO::FETCH_ASSOC);
            $name = $row['secondName'] . " " . $row['firstName'] . "<br>";
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $name;
    }

    public function addUserTask($user, $task) {
        $insQuery = "INSERT INTO user_task (userId, taskId) 
			VALUES ('$user', '$task')";
        $insResult = mysql_query($insQuery) or dieSql();
        if ($insResult != NULL)
            return true;
        else
            return false;
    }

    public function updateData() {
        
    }

    //предполагается не удаление, а изменение видимости записей данных
    public function deleteData() {
        
    }

}

?>