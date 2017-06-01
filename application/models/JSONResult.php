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
class JSONResult {
  
  public function __construct($users, $userTasks) {
    array_combine($users, $userTasks);
  }  
}
