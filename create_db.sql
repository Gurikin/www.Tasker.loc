CREATE DATABASE `tasker` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE tasker;
CREATE TABLE `department` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(90) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
CREATE TABLE `rights` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `insideDepartment` tinyint(1) NOT NULL,
  `showTaskList` tinyint(1) NOT NULL,
  `showUserList` tinyint(1) NOT NULL,
  `showGeneralChart` tinyint(1) NOT NULL,
  `editTaskList` tinyint(1) NOT NULL,
  `editUserList` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `role` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `role_rights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(3) unsigned NOT NULL,
  `rights_id` int(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_role_rights_role1_idx` (`role_id`),
  KEY `fk_role_rights_rights1_idx` (`rights_id`),
  CONSTRAINT `fk_role_rights_rights1` FOREIGN KEY (`rights_id`) REFERENCES `rights` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_role_rights_role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `taskTitle` varchar(255) NOT NULL,
  `orderDate` datetime NOT NULL,
  `beginDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `factEndDate` datetime DEFAULT NULL,
  `progress` int(3) NOT NULL,
  `description` mediumtext NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
CREATE TABLE `task_ierarhy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_task` int(11) NOT NULL,
  `child_task` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_task_ierarhy_task1_idx` (`parent_task`),
  KEY `fk_task_ierarhy_task2_idx` (`child_task`),
  CONSTRAINT `fk_task_ierarhy_task1` FOREIGN KEY (`parent_task`) REFERENCES `task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_task_ierarhy_task2` FOREIGN KEY (`child_task`) REFERENCES `task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `user` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) NOT NULL,
  `secondName` varchar(50) NOT NULL,
  `middleName` varchar(50) NOT NULL,
  `jobTitle` varchar(255) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `phone` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
CREATE TABLE `user_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(5) NOT NULL,
  `department_id` int(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_department_user1_idx` (`user_id`),
  KEY `fk_user_department_department1_idx` (`department_id`),
  CONSTRAINT `fk_user_department_department1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_department_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
CREATE TABLE `user_role` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(5) NOT NULL,
  `role_id` int(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_role_user_idx` (`user_id`),
  KEY `fk_user_role_role1_idx` (`role_id`),
  CONSTRAINT `fk_user_role_role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_role_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `user_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(5) NOT NULL,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_task_user1_idx` (`user_id`),
  KEY `fk_user_task_task1_idx` (`task_id`),
  CONSTRAINT `fk_user_task_task1` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_task_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;





