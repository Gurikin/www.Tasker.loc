<?php

/**
 * @author Igor Banchikov
 * This is the UserTask controller class
 * @todo need for the get data about user wich connected with tasks & tasks wich assign to the user
 */
class UserTaskController extends DBConnect {

    /**
     * @var string table - using table in db
     * @var string activeUserView - using view in db
     * @var object $_fc instance of FrontController class
     * @var object $_model instance of FileModel class
     * @var object $_dbh instance of DBConnect class
     */
    public $table = 'user_task';
    public $activeUserView = 'activeUserView';
    private $_fc;
    private $_model;
    private $_dbh;
    
    public function __construct() {
        $this->_fc = FrontController::getInstance();
        /* Инициализация модели */
        $this->_model = new UserTaskModel();    
        parent::__construct();
        $this->_dbh = parent::getDbh();
    }

    /** 
     * @todo Выборка назначенных сотрудникам задач
     * @return array like as (id, taskTitle, orderDate, beginDate, endDate, factEndDate, progress, description, active, user_id, task_id)
     */
    public function selectUserTasks($userId, $progress=0) {
        $tableView = array();
        try {            
            $query = "select * from task INNER JOIN " . $this->table . " ON task.id = user_task.task_id where user_task.user_id = " . $userId . " and task.progress <= " . $progress;
            //echo $query;
            $resultSelect = $this->_dbh->query($query);
            //var_dump($resultSelect);
            if ($resultSelect === false) {
                throw new PDOException('Ошибка при селекте UserTasks');
            }
            while ($row = $resultSelect->fetch(PDO::FETCH_ASSOC)) {
                $tableView[/*$row['id']*/] = $row;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $tableView;
    }

    /** 
     * @todo Выборка сотрудников ответственных за задачу
     * @return array like as [0=>array1(id, firstName, secondName), 1=>array2(id, firstName, secondName), 2=>...]
     */
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
     * @todo Этот метод возвращает имя и фамилию сотрудника по его id
     * @return array(user_id, firstName, secondName)
     */
    public function selectSingleUser($userId) {
        try {
            $query = "SELECT user_id, firstName, secondName FROM " . $this->activeUserView . " WHERE user_id=" . $userId;
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
        return $row;//$name;
    }

    /**
     * @todo this method assign task to the user
     * @param int $user
     * @param int $task
     * @return boolean - true if OK, false if task was not add to user
     */
    public function addUserTask($user, $task) {
        $insQuery = "INSERT INTO user_task (userId, taskId) 
			VALUES ('$user', '$task')";
        $dbh = parent::getDbh();
        $insResult = $dbh->query($insQuery);
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