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
  public function getGanttData($queryArray) {
    $this->ganttData = $queryArray;
//    $i = 0;
//    foreach (array_keys($queryArray) as $key) {
//        foreach (array_keys($queryArray[$key]) as $key2) {
//            foreach (array_values($queryArray[$key]) as $value) {
//                $this->ganttData[$key][$key2] = $value;
//            }            
//        }        
//    }
    return $this->ganttData;
  }
}
