<?php
	/**
	* 
  * @author Banchikov Igor Vladimirovich
  * @todo The class describes the nature of the employee
  * @property integer $id (autoincrement)
  * @property string $firstName The first name of employee
  * @property string $secondName The second name of employee
  * @property string $middleName The middle name of employee
  * @property string $jobTitle The title of the employee post
  * @property boolean $administrator Is the employee have root rights
  * @property boolean $activeJob Active employee?
  * 
  */
	class User {
            public $id; //integer AutoIncrement
            public $firstName = '';
            public $secondName = '';
            public $middleName = '';
            public $jobTitle = '';
            public $login = '';
            private static $_instance;
	
            /**
            * @todo The method assigns the value of construct parameters to the class properties
            */
            function __construct ($id, $firstName, $secondName, $middleName, $login) {
                $this->id           = $id;
                $this->firstName    = $firstName;
                $this->secondName   = $secondName;
                $this->middleName   = $middleName;
                $this->login        = $login;
            }
	}
?>