<?php

/*
 * @author Igor Banchikov
 * @license GPL 
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @package model
 */

/**
 * Description of JSONResult
 *
 * @author Igor Banchikov
 */
class GanttModel extends FileModel {
  private $ganttData = array();
  public function __construct() {
    
  }
  public function getGanttData($ganttArr) {
    $this->$ganttData[key($ganttArr)] = array_v;
    $tasks=array_sum($userTasks);
    $efficiency = array();
    foreach ($userTasks as $eff=>$v) {
      $efficiency[] = round($v/$tasks*100);
    }
    $this->userEffeciency["efficiency"] = $efficiency;
    return $this->userEffeciency;
  }
}
