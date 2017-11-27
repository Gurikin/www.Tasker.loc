<?php
/**
 * This is the authentification controller class
 * @author Igor Banchikov
 */
class AuthController extends DBConnect implements IController {
    
    /**
     * @var object $_fc instance of FrontController class
     * @var object $_model instance of FileModel class
     * @var object $_dbh instance of DBConnect class
     */
    private $_fc, $_model, $_dbh;
    private $_table = 'user';
    
    public function __construct() {
        $this->_fc = FrontController::getInstance();
        /* Инициализация модели */
        $this->_model = new UserModel();
        parent::__construct();
        $this->_dbh = parent::getDbh();
    }
    
    /**
     * signIn method (based on sessions & headers)
     * @throws PDOException
     */
    public function signInAction() {
      //Инициализируем переменные для хранения логина и пароля, которые введет пользователь
      // Еслп пользователь ввел какие-либо данные, сохраняем их в эти переменные
      $login = !empty($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : null;
      $pass = !empty($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : null;


      $query = "SELECT * FROM " . $this->_table . " WHERE `firstName`='". $login . "' AND `password`='".md5($pass) . "'";
      try {
          $resultSelect = $this->_dbh->query($query);
          if ($resultSelect === false) {
              throw new PDOException('Ошибка при выполнении запроса select task.<br>');
          }
          $row = $resultSelect->fetch(PDO::FETCH_ASSOC);
      } catch (PDOException $ex) {
          // TODO add the log of errors
          //echo $ex->getMessage();
      }
      // Проверяем введенные данные
      if($row['id'] == null){
          // Первый запрос страницы, либо пользователь ввел неверные данные
          // Отправляем соответствующие заголовки
          header('HTTP/1.0 401 Unauthorized');
          header('WWW-Authenticate: Basic realm="Мой секретный сайт"');
      } else {
          // сохраняем данные в сессию
          $this->_model->setUser($row['id'], $row['firstName'], $row['secondName'], $row['middleName'], $row['jobTitle'], $row['login'], $row['phone']);
          $_SESSION["userId"] = $row['id'];
          $_SESSION["firstName"] = $row['firstName'];
          $_SESSION["secondName"] = $row['secondName'];
          $_SESSION["middleName"] = $row['middleName'];
          $_SESSION["login"] = $row['login'];
      }               
      $output = $this->_model->render(USER_DEFAULT_FILE, true);
      //var_dump($_SESSION);
      //var_dump($this->_model);
      $this->_fc->setBody($output);
    }
}