<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserController
 *
 * @author gurik_000
 */
class TestController extends DBConnect implements IController {

    public $table = 'task';
    public $activeUserView = 'activeUserView';
    public $firedUserView = 'firedUserView';
    private $_fc;
    private $_params = array();
    private $_model;
    private $_userTaskController;
    private $_dbh;

    public function __construct() {
        $this->_fc = FrontController::getInstance();
        /* Инициализация модели */
        $this->_model = new TaskModel();
        parent::__construct();
        $this->_userTaskController = new UserTaskController();
        $this->_dbh = parent::getDbh();
    }

    //---------------------------------------------
    //методы для работы с БД
    //---------------------------------------------
    //Выборка действующих либо уволившихся сотрудников
//    public function selectUserAction($actUser = true) {
//        try {
//            if ($actUser) {
//                $fn = '%%';
//                $sn = '%ива%';
//                $query = "CALL tasker.select_like('$sn', '$fn')";
//            } else {
//                $query = "CALL tasker.select_like('$sn', '$fn')";
//            }
//            $dbh = parent::getDbh();
//            $resultSelect = $dbh->query($query);
//            if ($resultSelect === false) {
//                throw new PDOException;
//            }
//            $i = 0;
//            while ($row = $resultSelect->fetch(PDO::FETCH_ASSOC)) {
//                $row['tasks'] = $this->_userTaskController->selectUserTasks($row['user_id']);
//                $tableView[$i] = $row;
//                $i++;
//            }
//        } catch (PDOException $ex) {
//            echo $ex->getMessage();
//        }
//        $this->_model->userList = $tableView;
//        $output = $this->_model->render(USER_LIST_FILE);
//        $this->_fc->setBody($output);
//    }

    /**
     * Этот метод возвращает имя и фамилию сотрудника по его id

      public function selectUserConstAction($userId) {
      $query = "SELECT firstName, secondName FROM " . $this->table . " WHERE id=" . $userId;

      $resultSelect = mysql_query($query) or dieSql();
      if (!$resultSelect)
      return false;
      $row = mysql_fetch_assoc($resultSelect);

      $name = $row["secondName"] . " " . $row["firstName"];

      return $name;
      } */
    public function addAction() {
        for ($i=0; $i<100; $i++) {
            $taskTitle = "Task # ".$i;
            $orderDate = date ("Y-m-d H:i:s");
            $beginDate = $orderDate;
            $endDate = $orderDate;
            $progress = 0;
            $description = "Task description # ".$i;
            $active = 1;
            $insQuery = "INSERT INTO task ( taskTitle, 
					orderDate, 
                                        beginDate,
					endDate,
                                        factEndDate,
					progress, 
					description, 
					active) 
					VALUES ('$taskTitle', 
                                                '$orderDate',
                                                '$orderDate',
                                                '$orderDate',
                                                '$orderDate',
                                                '$progress',
                                                '$description',
                                                '$active')";
            try {
                echo $insQuery;
                $resultSelect = $this->_dbh->query($insQuery);
//                if ($resultSelect === false) {
//                    throw new PDOException('Ошибка при выполнении запроса insert task.');
//                }                
            } catch (PDOException $ex) {
                echo $ex->getMessage();
            }
        }
    }
    
    public function add2Action() {
        for ($i=1012; $i<=1111; $i++) {
            $userID = 1;
            $taskID = $i;
            
            $insQuery = "INSERT INTO user_task ( user_Id,task_Id) VALUES ('$userID', '$taskID')";
            try {
                echo $insQuery;
                $resultSelect = $this->_dbh->query($insQuery);
//                if ($resultSelect === false) {
//                    throw new PDOException('Ошибка при выполнении запроса insert task.');
//                }                
            } catch (PDOException $ex) {
                echo $ex->getMessage();
            }
        }
    }

    public function updateDataAction() {
        $this->_fc->setBody("<h1>Update</h1>");
    }

    //предполагается не удаление, а изменение видимости записей данных
    public function deleteData() {
        
    }

}

?>