<?php
class FileModel{
        /* Имя пользователя */
	public $name = '';
	/* Список пользователей */
	public $userList = array();
        /* Список задач*/
	public $taskList = array();
        /* Список задач назначенных пользователю*/
	public $userTasksList = array();
        /* Список пользователей ответственных за задание*/
	public $taskUsersList = array();
        /* Календарь с назначенными по датам задачами*/
	public $calendar = array();
	/* Текущий пользователь: ассоциативный массив 
	*  c элементами role и name для существующего пользователя
	*  или только с элементом name для неизвестного пользователя
	*/
	public $user;
        public $msg = "";
        
        public $circleChart;
	
        public function render($file, $getLayout = false) {
		/* $file - текущее представление */
          ob_start();
          if ($getLayout) {
            $bodyStr = file_get_contents(LAYOUT_FILE);
            $bodyArr = explode('|||', $bodyStr);
            echo ($bodyArr[0]);
            include($file);
            echo ($bodyArr[1]);            
          } else {
            include($file);
          }
          return ob_get_clean();
        }
        
        public function getUser() {
            return $this->user;
        }
        
        public function setUser($id, $firstName, $secondName, $middleName, $login) {
            $this->user = new User($id, $firstName, $secondName, $middleName, $login);
        }
}