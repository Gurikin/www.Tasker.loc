<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserController
 *
 * @author BIV
 */
class UserController extends DBConnect implements IController {

    public $table = 'user';
    public $activeUserView = 'activeUserView';
    public $firedUserView = 'firedUserView';
    private $_fc;
    private $_params = array();
    private $_model;
    private $_userTaskController;
    private $_dbh;
    //private $_user;

    public function __construct() {
        $this->_fc = FrontController::getInstance();
        /* Инициализация модели */
        $this->_model = new FileModel();
        $this->_userTaskController = new UserTaskController;
        //$this->_user = new User();
        parent::__construct();
        $this->_dbh = parent::getDbh();
    }
    
    public function registration($name, $pass){
        $n = $name;
        $p = $pass;
    }

    //---------------------------------------------
    //методы для работы с БД
    //---------------------------------------------
    //Выборка действующих либо уволившихся сотрудников
    public function selectUserAction($actUser = true) {
        try {
            if ($actUser) {
                $query = "SELECT * FROM " . $this->activeUserView . " LIMIT 0, 50";
            } else {
                $query = "SELECT * FROM " . $this->firedUserView . " LIMIT 0, 50";
            }
            $resultSelect = $this->_dbh->query($query);
            if ($resultSelect === false) {
                throw new PDOException;
            }
            $i = 0;
            while ($row = $resultSelect->fetch(PDO::FETCH_ASSOC)) {
                $row['task'] = $this->_userTaskController->selectUserTasks($row['user_id']);
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
     */
      public function selectUserConstAction($userId) {
      $query = "SELECT firstName, secondName, middleName, jobTitle, phone FROM " . $this->table . " WHERE id=$userId";// . $userId;
      $resultSelect = $this->_dbh->query($query);
      if ($resultSelect === false) {
        throw new PDOException;
      }
      $i = 0;
      $row = $resultSelect->fetch(PDO::FETCH_ASSOC);
      //while () {
        //$row['task'] = $this->_userTaskController->selectUserTasks($row['user_id']);
      //  $tableView = $row;
      //  $i++;
      //}
      
      
      //$name = $row["secondName"] . " " . $row["firstName"];
      $this->_model->userList = $row;
      $output = $this->_model->render(USER_SINGLE_INFO);
      $this->_fc->setBody($output);
      //return $name;
    }
      
    public function addAction() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {    
        $firstName = $_POST['firstName'];
        $secondName = $_POST['secondName'];
        $middleName = $_POST['middleName'];
        $jobTitle = $_POST['jobTitle'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];    
    }
        $insQuery = "INSERT INTO user ( firstName, 
					secondName, 
					middleName, 
					jobTitle,
                                        password,
                                        phone) 
					VALUES ('$firstName', 
                                                '$secondName', 
                                                '$middleName', 
                                                '$jobTitle',
                                                '$password',
                                                '$phone')";
        $insResult = $this->_dbh->query($insQuery);
        if ($insResult === false) {
            throw new PDOException;
        }
        else {
            
        }
                
        header ("Location: /user/selectUser");
        //$output = $this->_model->render(USER_ADD_FILE);
        //$this->_fc->setBody($output);
    }
    
    public function createAction() {
        $output = $this->_model->render(USER_CREATE_FILE);
        $this->_fc->setBody($output);
    }

    public function updateData() {
        
    }

    //предполагается не удаление, а изменение видимости записей данных
    public function deleteData() {
        
    }

}

?>