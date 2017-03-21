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
	/* Текущий пользователь: ассоциативный массив 
	*  c элементами role и name для существующего пользователя
	*  или только с элементом name для неизвестного пользователя
	*/
	public $user = array();
        public $msg = "";
	
	public function render($file) {
		/* $file - текущее представление */
		ob_start();
                $bodyStr = file_get_contents(LAYOUT_FILE);
                $bodyArr = explode('|||', $bodyStr);
                echo ($bodyArr[0]);
		include($file);
                echo ($bodyArr[1]);
		return ob_get_clean();
	}
}