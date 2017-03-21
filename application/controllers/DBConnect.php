<?php
//Класс DataBase - родительский класс для работы с БД
class DBConnect
{
    //protected $link;
    private $_dbh,
            $_conStr, 
            //$_server, 
            $_username, 
            $_password;
            //$_db;

    public function __construct($server = SERVER, $username = USER_NAME, $password = PASSWORD , $db = DB_NAME)
    {
        $this->_username = $username;
        $this->_password = $password;
        $this->_conStr = 'mysql:dbname=' . $db . ';host=' . $server;
        $this->connect();
    }

    private function connect()
    {
        try {
            $this->_dbh = new PDO($this->_conStr, $this->_username, $this->_password);
        } catch (PDOException $ex) {
            echo 'Подключение не состоялось: ' . $ex->getMessage();
        }
    }

    public function __sleep()
    {
        return array('server', 'username', 'password', 'db');
    }

    public function __wakeup()
    {
        $this->connect();
    }
    
    public function getDbh() {
        return $this->_dbh;
    }
}