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
      } else {
          $arrData = array(
            "chart" => array(
                "dateformat" => "yyyy-mm-dd",
                "caption"=> "Main Project",
                "subCaption"=> "Project plan",
                "theme"=> "fint",
                "canvasBorderAlpha" => "30",
                "ganttPaneDuration" => "3",
                "ganttPaneDurationUnit" => "m"
                )
              );
      }
      
      // creating array for categories object

      $categoryArray=array();
      $datatable=array();/*array("chart"=> array (
                        "dateformat"=> "yyyy-mm-dd",
                        "caption"=> "Main Project",
                        "subcaption"=> "Project Plan",
                        "theme"=> "fint",
                        "canvasBorderAlpha"=> "30",
                        "ganttPaneDuration"=> "3",
                        "ganttPaneDurationUnit"=> "m")
          );       */     
      $categoryArray = array(array('start'=>"2018-01-01",'end'=>"2018-01-01",'label'=>"Янв '18"),
          array('start'=>"2018-02-01",'end'=>"2018-02-28",'label'=>"Фев '18"),
          array('start'=>"2018-03-01",'end'=>"2018-03-31",'label'=>"Мар '18"),
          array('start'=>"2018-04-01",'end'=>"2018-04-30",'label'=>"Апр '18"),
          array('start'=>"2018-05-01",'end'=>"2018-05-31",'label'=>"Май '18"),
          array('start'=>"2018-06-01",'end'=>"2018-06-30",'label'=>"Июн '18"),
          array('start'=>"2018-07-01",'end'=>"2018-07-31",'label'=>"Июл '18"),
          array('start'=>"2018-08-01",'end'=>"2018-08-31",'label'=>"Авг '18"),
          array('start'=>"2018-09-01",'end'=>"2018-09-30",'label'=>"Сен '18"),
          array('start'=>"2018-10-01",'end'=>"2018-10-31",'label'=>"Окт '18"),
          array('start'=>"2018-11-01",'end'=>"2018-11-30",'label'=>"Ноя '18"),
          array('start'=>"2018-12-01",'end'=>"2018-12-31",'label'=>"Дек '18"));
      
      while ($rowSelectProjectTask = $resultSelectProjectTask->fetch(PDO::FETCH_ASSOC)) {
          array_push($owners, array(
              "label" => $rowSelectProjectTask['secondName']));
          array_push($processes, array(
              "label" => $rowSelectProjectTask['taskTitle']));
          array_push($tasks['task'], array(
              "start" => $rowSelectProjectTask['orderDate']));
          array_push($tasks['task'], array(
              "end" => $rowSelectProjectTask['endDate']));//          
      }
      $arrData["categories"]=array(array("category"=>$categoryArray));
      // creating dataset object
      $arrData["dataSource"] = array(array("seriesName"=> "Actual Revenue", "data"=>$dataseries1), array("seriesName"=> "Projected Revenue",  "renderAs"=>"line", "data"=>$dataseries2),array("seriesName"=> "Profit",  "renderAs"=>"area", "data"=>$dataseries3));
//      foreach ($tableView as $user) {
//        $users[] = $user['secondName'];
//        $userTasks[] = count($user['task']);
//      }
      //send the JSON object for the making circle chart
      //$jsonResult = $this->_ganttModel->getGanttData($tasks);      
      echo json_encode($jsonResult);
      
//      echo "<pre>";
//      var_dump ($jsonResult);
//      echo "</pre>";      
    }
}
?>