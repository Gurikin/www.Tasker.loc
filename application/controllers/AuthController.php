<?php
class AuthController extends DBConnect implements IController {
    
    private $_fc, $_model, $_dbh;
    private $_table = 'user';
    
    public function __construct() {
        $this->_fc = FrontController::getInstance();
        /* Инициализация модели */
        $this->_model = new FileModel();
        parent::__construct();
        $this->_dbh = parent::getDbh();
        
        //$this->_userTaskController = new UserTaskController();
    }
    
    public function signInAction() {
	//Инициализируем переменные для хранения логина и пароля, которые введет пользователь
        // Еслп пользователь ввел какие-либо данные, сохраняем их в эти переменные
        $row = null;
        $login = '';
        $pass = '';
        if(isset($_SERVER['PHP_AUTH_USER'])) $login = $_SERVER['PHP_AUTH_USER'];
        if(isset($_SERVER['PHP_AUTH_PW'])) $pass = $_SERVER['PHP_AUTH_PW'];
        
        if(($login == null || $login == "") || ($pass == null || $pass == "")){
            // Первый запрос страницы, либо пользователь ввел неверные данные
            // Отправляем соответствующие заголовки
            header('HTTP/1.0 401 Unauthorized');
            header('WWW-Authenticate: Basic realm="Мой секретный сайт"');
        }
        
        $query = "SELECT id FROM " . $this->_table . " WHERE `firstName`='". $login . "' AND `password`='".md5($pass) . "'";
        try {
            //$dbh = parent::getDbh();
            $resultSelect = $this->_dbh->query($query);
            if ($resultSelect === false) {
                throw new PDOException('Ошибка при выполнении запроса select task.<br>');
            }
            $row = $resultSelect->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        // Проверяем введенные данные
        if($row == null){
            $model->name = "Guest";
        } else {
            $this->_model->name = $login;
        }               
        $output = $this->_model->render(USER_DEFAULT_FILE);
	$this->_fc->setBody($output);
    }
}

?>


