<?php

/**
 * Класс-контроллер для управления представлением Chart
 */
class ChartController extends DBConnect implements IController {

    private $_fc;
    private $_params = array();
    private $_model;
    private $_userEffModel;
    private $_ganttModel;
    private $_userTaskController;
    private $_dbh;
    private $_calendar;

    /**
     * Перегрузка методов для работы с БД
     *
     */
    public function __construct() {
        $this->_fc = FrontController::getInstance();
        /* Инициализация модели */
        $this->_model = new CalendarModel();
        $this->_userEffModel = new UserEffeciencyModel();
        $this->_ganttModel = new GanttModel();
        parent::__construct();
        $this->_userTaskController = new UserTaskController();
        $this->_dbh = parent::getDbh();
        $this->_calendar = array("loseBeginTask"=>null,"loseEndTask"=>null,"workingTask"=>null,"completeTask"=>null);
    }

    /**
     * @todo Выборка активных или завершенных задач за неделю (по умолчанию текущая неделя)
     * Метод возвращает результат в форме двумерного массива
     */
    public function showWeekAction() {
      $table = 'user_task';
        //var_dump($_SESSION);
        //var_dump($this->_calendar);
        $now = getdate();
        if ($now['wday'] == 1) {
            $day = $now['mday'];
        } else {
            $lastMon = getdate(strtotime ("last Monday"));
            $day = $lastMon['mday'];
        }
        $format = 'Y-m-d';
        /**
         * Select complete task for the each day of week (default current week)
         */
        for ($d = $day; $d < ($day+7); $d++) {
            $date = DateTime::createFromFormat($format, $now['year'].'-'.$now['mon'].'-'.$d);
            //var_dump($date->getTimeStamp());
            $query = "select * from task INNER JOIN " . $table . " ON task.id = " . $table . ".task_id where " . $table . ".user_id = ". $_SESSION['userId'] . " AND task.active=1 AND task.endDate LIKE '".$date->format('Y-m-d')."%'";//" AND task.active=0 AND task.progress=100 AND task.endDate LIKE '".$date->format('Y-m-d')."%'";
//            echo $query."<br>";
            $resultSelect = $this->_dbh->query($query);
            if ($resultSelect === false) {
                throw new PDOException('Ошибка при селекте UserTasks в классе ChartController');
            }
            $dayTasks = null;
            //TODO correct this while (don't need to repeat the previos day tasks
            while ($row = $resultSelect->fetch(PDO::FETCH_ASSOC)) {
                 $dayTasks[$row['task_id']] = $row;
//                echo "<pre>";
//                print_r($row);
//                echo "</pre>";
            }   
            $tableTask[$d] = $dayTasks;
        }
        
//        var_dump($tableTask);
        $this->_calendar['completeTask'] = $tableTask;
        $this->_model->calendar = $this->_calendar;
        $output = $this->_model->render(CHART_FILE);
        $this->_fc->setBody($output);
    }
    
    /**
     * @todo send the data about effectivity of current user's group
     * @throws PDOException
     */
    public function getUserEfficiencyChartAction() {
            
      $table = 'task';
      $queryUserDepartmentId = "Select department_id from " . $table . " where user_id = " . $_SESSION['userId'];
      $resultSelectUserDepartmentID = $this->_dbh->query($queryUserDepartmentId);
      if ($resultSelectUserDepartmentID === false) {
          throw new PDOException('Ошибка при селекте UserTasks в классе ChartController');
      }
      $rowUserDepartmentId = $resultSelectUserDepartmentID->fetch(PDO::FETCH_ASSOC);
      $queryWorkGroup = "Select user.id, firstName, secondName, " . $table . ".department_id as depart_id from user INNER JOIN " . $table . " ON " . $table . ".department_id = " . $rowUserDepartmentId['department_id'] . " AND user.id = " . $table . ".user_id";
      //echo $queryWorkGroup;
      $resultSelectWorkGroup = $this->_dbh->query($queryWorkGroup);
      if ($resultSelectWorkGroup === false) {
          throw new PDOException('Ошибка при селекте UserTasks в классе ChartController');
      }
      $i = 0;
      while ($rowWorkGroup = $resultSelectWorkGroup->fetch(PDO::FETCH_ASSOC)) {
          $rowWorkGroup['task'] = $this->_userTaskController->selectUserTasks($rowWorkGroup['id'], 100);
          $tableView[$rowWorkGroup['secondName']] = $rowWorkGroup;
          $i++;
      }
      foreach ($tableView as $user) {
        $users[] = $user['secondName'];
        $userTasks[] = count($user['task']);
      }
      //send the JSON object for the making pie chart
      $jsonResult = $this->_userEffModel->getUserEffeciency($users, $userTasks);
      echo json_encode($jsonResult);      
    }
    
    /**
     * @todo send the data about effectivity of current user's group
     * @throws PDOException
     */
    public function getProjectsDataAction() {
      
      //Task name
      //Task owner
      //Task data of begin
      //Task data of end
      $view = 'ganttView';
      $queryProjectTask = "Select * from " . $view;
      $resultSelectProjectTask = $this->_dbh->query($queryProjectTask);
      if ($resultSelectProjectTask === false) {
          throw new PDOException('Ошибка при селекте UserTasks в классе ChartController');
      }
      
      while ($rowSelectProjectTask = $resultSelectProjectTask->fetch(PDO::FETCH_ASSOC)) {
//          foreach ($rowSelectProjectTask as $task) {
//              $tasks[] =
//          }
          $tasks[] = $rowSelectProjectTask;
          var_dump($rowSelectProjectTask);
      }
//      foreach ($tableView as $user) {
//        $users[] = $user['secondName'];
//        $userTasks[] = count($user['task']);
//      }
      //send the JSON object for the making circle chart
      //$jsonResult = $tasks[];
      //echo json_encode($jsonResult);      
    }
    
    
    
}
?>