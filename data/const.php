<?php
/* Пути по-умолчанию для поиска файлов */
set_include_path(get_include_path()
        . PATH_SEPARATOR . 'application/controllers'
        . PATH_SEPARATOR . 'application/models'
        . PATH_SEPARATOR . 'application/views');

/* Имена файлов: views */
define('USER_DEFAULT_FILE', 'user_default.php');
define('USER_ROLE_FILE', 'user_role.php');
define('USER_LIST_FILE', 'user_list.php');
define('USER_ADD_FILE', 'user_add.php');
define('USER_CREATE_FILE', 'user_create.php');
define('TASK_LIST_FILE', 'task_list.php');
define('TASK_CREATE_FILE', 'task_create.php');
define('USER_CLASS', 'user_class.php');


/* Текстовая база данных пользователей */
define('USER_DB', $_SERVER["DOCUMENT_ROOT"] . '/data/users.txt');

/* Шаблон для страниц */
define('LAYOUT_FILE', $_SERVER["DOCUMENT_ROOT"] . '/data/layout.php');

/* Константы для работы с БД */
define('SERVER', 'localhost');
define('USER_NAME', 'Gurikin');
define('PASSWORD', 'PassWord!2#');
define('DB_NAME', 'tasker');