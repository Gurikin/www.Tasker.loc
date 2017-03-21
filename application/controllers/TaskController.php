<?php

/**
 * Класс-контроллер для сущности Task
 */
class TaskController extends DBConnect implements IController {

    public $table = 'task';
    private $_fc;
    private $_params = array();
    private $_model;
    private $_userTaskController;

    /**
     * Перегрузка методов для работы с БД
     *
     */
    public function __construct() {
        $this->_fc = FrontController::getInstance();
        /* Инициализация модели */
        $this->_model = new FileModel();
        parent::__construct();
        $this->_userTaskController = new UserTaskController();
    }

    /**
     * Выборка активных или завершенных задач
     * Метод возвращает результат в форме двумерного массива
     */
    public function selectTaskAction($actTask = true) {
        $query = "SELECT id, taskTitle, orderDate, beginDate, endDate, factEndDate, progress, description FROM " . $this->table . " WHERE progress<100";
        try {
            $dbh = parent::getDbh();
            $resultSelect = $dbh->query($query);
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
     * Метод для добавления новой задачи в БД
     * При успешном добавлении возвращает true
     * в противном случае - false
     */
    public function addAction() {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $taskTitle = $_POST['taskTitle'];
        $orderDate = date ("Y-m-d H:i:s");
        $beginDate = $_POST['beginDate'];
        $endDate = $_POST['endDate'];
        $progress = $_POST['progress'];
        $description = $_POST['description'];
    }
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
        
        $dbh = parent::getDbh();
        $insResult = $dbh->query($insQuery);
        if ($insResult === false) {
            throw new PDOException;
        }
        else {
            
        }
        header ("Location: /task/selectTask");
    }

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