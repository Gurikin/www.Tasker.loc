<?php
class UserTaskModel extends FileModel{
        /* Список задач назначенных пользователю*/
	public $userTasksList = array();
        /* Список пользователей ответственных за задание*/
	public $taskUsersList = array();
        /* Календарь с назначенными по датам задачами*/
}