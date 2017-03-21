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

    public $table = 'user';
    public $activeUserView = 'activeUserView';
    public $firedUserView = 'firedUserView';
    private $_fc;
    private $_params = array();
    private $_model;
    private $_userTaskController;

    public function __construct() {
        $this->_fc = FrontController::getInstance();
        /* Инициализация модели */
        $this->_model = new FileModel();
        $this->_userTaskController = new UserTaskController;
        parent::__construct();
    }

    //---------------------------------------------
    //методы для работы с БД
    //---------------------------------------------
    //Выборка действующих либо уволившихся сотрудников
    public function selectUserAction($actUser = true) {
        try {
            if ($actUser) {
                $fn = '%%';
                $sn = '%ива%';
                $query = "CALL tasker.select_like('$sn', '$fn')";
            } else {
                $query = "CALL tasker.select_like('$sn', '$fn')";
            }
            $dbh = parent::getDbh();
            $resultSelect = $dbh->query($query);
            if ($resultSelect === false) {
                throw new PDOException;
            }
            $i = 0;
            while ($row = $resultSelect->fetch(PDO::FETCH_ASSOC)) {
                $row['tasks'] = $this->_userTaskController->selectUserTasks($row['user_id']);
                $tableView[$i] = $row;
                $i++;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        $this->_model->userList = $tableView;
        $output = $this->_model->render(USER_LIST_FILE);
        $this->_fc->setBody($output);
    }

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
    public function addAction($objUser, $administrator = 0, $activeJob = 1) {
        $firstName = $objUser->firstName;
        $secondName = $objUser->secondName;
        $middleName = $objUser->middleName;
        $jobTitle = $objUser->jobTitle;

        $insQuery = "INSERT INTO user ( firstName, 
					secondName, 
					middleName, 
					jobTitle, 
					login, 
					password, 
					administrator, 
					activeJob) 
					VALUES ('$firstName', 
                                                '$secondName', 
                                                '$middleName', 
                                                '$jobTitle',
                                                '',
                                                '',
                                                '$administrator', 
                                                '$activeJob')";
        $insResult = mysql_query($insQuery) or dieSql();
        return $insResult;
    }

    public function updateData() {
        
    }

    //предполагается не удаление, а изменение видимости записей данных
    public function deleteData() {
        
    }

}

?>