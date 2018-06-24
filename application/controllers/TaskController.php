<?php

/**
 * This controller manage the tasks
 *
 * @author Igor Banchikov
 */
class TaskController extends DBConnect implements IController {

    /**
     * @var string table - using table in db
     * @var object $_fc instance of FrontController class
     * @var object $_model instance of FileModel class
     * @var object $_dbh instance of DBConnect class
     * @var object $_userTaskContoller instance of UserTaskController class. Need for the data selecting
     */
    public $table = 'task';
    private $_fc;
    private $_model;
    private $_dbh;
    private $_userTaskController;

    /**
     * Перегрузка методов для работы с БД
     *
     */
    public function __construct() {
        $this->_fc = FrontController::getInstance();
        /* Инициализация модели */
        $this->_model = new TaskModel();
        parent::__construct();
        $this->_userTaskController = new UserTaskController();
        $this->_dbh = parent::getDbh();
    }

    /**
     * @todo Выборка активных или завершенных задач
     * @param boolean $actTask - select the active of complete tasks
     * @return Метод возвращает результат в форме двумерного массива
     * @throws PDOException
     * @return array like this array (size=5)
     * 1 => 
     * array (size=9)
     * 'id' => string '1' (length=1)
     * 'taskTitle' => string 'Первая задача' (length=25)
     * 'orderDate' => string '2016-04-03 00:00:00' (length=19)
     * 'beginDate' => string '2016-04-03 00:00:00' (length=19)
     * 'endDate' => string '2016-04-03 00:00:00' (length=19)
     * 'factEndDate' => null
     * 'progress' => string '0' (length=1)
     * 'description' => string 'Это первая задача' (length=32)
     * 'users' => 
     *   array (size=2)
     *     0 => 
     *       array (size=3)
     *         ...
     *     1 => 
     *       array (size=3)
     *         ...
     */
    public function selectTaskAction($progress = 0) {
        $query = "SELECT id, taskTitle, orderDate, beginDate, endDate, factEndDate, progress, description FROM " . $this->table . " WHERE progress<=" . $progress;
        try {
            $resultSelect = $this->_dbh->query($query);
            if ($resultSelect === false) {
                throw new PDOException('Ошибка при выполнении запроса select task.<br>');
            }
            $i = 1;
            while ($row = $resultSelect->fetch(PDO::FETCH_ASSOC)) {
                $row['users'] = $this->_userTaskController->selectTaskUsers($row['id']);
                $tableView[$i] = $row;
                $i++;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        $this->_model->taskList = $tableView;
        $output = $this->_model->render(TASK_LIST_FILE);
        $this->_fc->setBody($output);
    }
    
    /**
     * @todo this method select single task by the id
     * @param int $taskId
     * @return array of the task data (see selectTaskAction method)
     * @throws PDOException
     */
    public function singleTaskAction($taskId) {
        $query = "SELECT id, taskTitle, orderDate, beginDate, endDate, factEndDate, progress, description FROM " . $this->table . " WHERE id=" . $taskId;
        try {
            $resultSelect = $this->_dbh->query($query);
            if ($resultSelect === false) {
                throw new PDOException('Ошибка при выполнении запроса singleTask.<br>');
            }
            $row = $resultSelect->fetch(PDO::FETCH_ASSOC);
            $row['users'] = $this->_userTaskController->selectTaskUsers($row['id']);
            $tableView = $row;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        $this->_model->taskList = $tableView;
        $output = $this->_model->render(SINGLE_TASK_FILE);
        $this->_fc->setBody($output);
    }
    
    /**
     * @todo Метод для добавления новой задачи в БД
     * @return boolean - true if OK, false if task was not add to DB
     * @throws PDOException
     */
    public function addAction() {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST))
    {        
        $taskTitle = $_POST['taskTitle'];
        $orderDate = date ("Y-m-d H:i:s");
        $beginDate = $_POST['beginDate'];
        $endDate = $_POST['endDate'];
        $progress = $_POST['progress'];
        $description = $_POST['description'];
        
        $insQuery = "INSERT INTO task ( taskTitle,
					orderDate,
					beginDate,
					endDate,
					progress,
					description) 
                    VALUES ('$taskTitle',
                            '$orderDate',
                            '$beginDate',
                            '$endDate',
                            '$progress',
                            '$description')";
    }
        
        
        $insResult = $this->_dbh->query($insQuery);
        if ($insResult === false) {
            
            throw new PDOException;
        }
        else {
            echo "Задача добавлена успешно.";
            return;
        }
        
    }
    
    /**
     * @todo select the tasks assigned for current user
     */
    public function criticalTaskAction () {
        $tableView['userTasks'] = $this->_userTaskController->selectUserTasks($_SESSION["userId"]);
        $this->_model->taskList = $tableView['userTasks'];
        $output = $this->_model->render(CRITICAL_TASK_LIST_FILE);
        $this->_fc->setBody($output);
    }

    /**
     * @todo this method output the page for the add task to the DB
     */
    public function createAction() {
        $output = $this->_model->render(TASK_CREATE_FILE);
        $this->_fc->setBody($output);
    }
    
    public function updateData() {
        
    }

    /**
     * Метод не удаляет строки, а записывает в поле activeTask значение FALSE
     */
    public function deleteData() {
        
    }

}

?>