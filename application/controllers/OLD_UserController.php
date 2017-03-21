<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserController
 *
 * @author gurik_000
 */
class UserController implements IController {
    
    private $_fc;
    private $_params = array();
    private $_model;
    
    public function __construct() {
        $this->_fc = FrontController::getInstance();
        $this->_params = $this->_fc->getParams();
        /* Инициализация модели */
        $this->_model = new FileModel();
    }
    public function helloAction() {
        if (!empty($this->_params['name'])) {
            try {
                
                
                $this->_model->name = $this->_params['name'];

                $output = $this->_model->render(USER_DEFAULT_FILE);

                $this->_fc->setBody($output);
            } catch (Exception $ex) {
                echo $ex->getMessage();
            } 
        } else {
            throw new Exception();
        }
    }
    
    public function listAction() {
            try {
                $arrStr = file_get_contents(USER_DB);

                $arr = unserialize($arrStr);
                
                $this->_model->title = 'Рабочая группа';
                
                $this->_model->list = $arr;
                
                $output = $this->_model->render(USER_LIST_FILE);

                $this->_fc->setBody($output);
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
                throw new Exception();
            }
    }
    
    public function getAction() {
        if (!empty($this->_params['role'])) {
            try {
                $name = $this->_params['role'];
                
                $this->_model->getRole($name);
                
                $output = $this->_model->render(USER_ROLE_FILE);

                $this->_fc->setBody($output);
            } catch (Exception $ex) {
                echo $ex->getMessage();
            } 
        } else {
            throw new Exception();
        }
    }
    
    public function addAction() {
        if (!empty($this->_params['name']) and
            !empty($this->_params['role'])) {
            try {
                $name = $this->_params['name'];
                $role = $this->_params['role'];

                $arrStr = file_get_contents(USER_DB);

                //foreach ($lines as $line=>$text) {
                    $arr = unserialize($arrStr);
                //}

                $arr[$name] = $role;
                $str = serialize($arr);
                $f = fopen(USER_DB, 'r+b');
                fwrite($f, $str);
                fclose($f);

                $this->_model->list = $arr;
                $this->_model->user[$name] = $role;

                $output = $this->_model->render(USER_ADD_FILE);

                $this->_fc->setBody($output);
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }else {
            throw new Exception();
        }
    }
}
