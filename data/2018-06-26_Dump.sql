-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: localhost    Database: tasker
-- ------------------------------------------------------
-- Server version	5.6.22-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Temporary table structure for view `activeuserview`
--

DROP TABLE IF EXISTS `activeuserview`;
/*!50001 DROP VIEW IF EXISTS `activeuserview`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `activeuserview` (
  `user_id` tinyint NOT NULL,
  `firstName` tinyint NOT NULL,
  `secondName` tinyint NOT NULL,
  `middleName` tinyint NOT NULL,
  `jobTitle` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `department` (
  `id` int(3) unsigned NOT NULL,
  `title` varchar(90) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` VALUES (1,'Main Engeneer');
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `ganttview`
--

DROP TABLE IF EXISTS `ganttview`;
/*!50001 DROP VIEW IF EXISTS `ganttview`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `ganttview` (
  `firstName` tinyint NOT NULL,
  `secondName` tinyint NOT NULL,
  `middleName` tinyint NOT NULL,
  `user_id` tinyint NOT NULL,
  `task_id` tinyint NOT NULL,
  `taskTitle` tinyint NOT NULL,
  `orderDate` tinyint NOT NULL,
  `endDate` tinyint NOT NULL,
  `progress` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `rights`
--

DROP TABLE IF EXISTS `rights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rights` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `insideDepartment` tinyint(1) NOT NULL,
  `showTaskList` tinyint(1) NOT NULL,
  `showUserList` tinyint(1) NOT NULL,
  `showGeneralChart` tinyint(1) NOT NULL,
  `editTaskList` tinyint(1) NOT NULL,
  `editUserList` tinyint(1) NOT NULL,
  `editGeneralChart` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rights`
--

LOCK TABLES `rights` WRITE;
/*!40000 ALTER TABLE `rights` DISABLE KEYS */;
/*!40000 ALTER TABLE `rights` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_rights`
--

DROP TABLE IF EXISTS `role_rights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_rights`
--

LOCK TABLES `role_rights` WRITE;
/*!40000 ALTER TABLE `role_rights` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_rights` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `taskTitle` varchar(255) NOT NULL,
  `orderDate` datetime NOT NULL,
  `beginDate` datetime DEFAULT NULL,
  `endDate` datetime NOT NULL,
  `factEndDate` datetime DEFAULT NULL,
  `progress` int(3) NOT NULL,
  `description` mediumtext,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1182 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES (1,'First task','2018-05-19 00:00:00',NULL,'2018-06-19 00:00:00',NULL,0,NULL,1),(2,'Second task','2018-05-30 00:00:00',NULL,'2018-08-30 00:00:00',NULL,0,NULL,1),(3,'Third task','2018-04-01 00:00:00','2018-04-01 00:00:00','2018-05-01 00:00:00','2018-05-01 00:00:00',100,NULL,0),(4,'Fourth task','2018-04-01 00:00:00','2018-04-01 00:00:00','2018-05-01 00:00:00','2018-05-01 00:00:00',100,NULL,0),(5,'Fifth task','2018-04-01 00:00:00','2018-04-01 00:00:00','2018-05-01 00:00:00','2018-05-01 00:00:00',100,NULL,0),(6,'Sixth task','2018-04-01 00:00:00','2018-04-01 00:00:00','2018-05-01 00:00:00','2018-05-01 00:00:00',100,NULL,0),(7,'Seventh task','2018-04-01 00:00:00','2018-04-01 00:00:00','2018-05-01 00:00:00','2018-05-01 00:00:00',100,NULL,0),(8,'Eighth task','2018-04-01 00:00:00','2018-04-01 00:00:00','2018-05-01 00:00:00','2018-05-01 00:00:00',100,NULL,0),(1012,'Task # 0','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26',0,'Task description # 0',1),(1013,'Task # 1','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26',0,'Task description # 1',1),(1014,'Task # 2','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26',0,'Task description # 2',1),(1015,'Task # 3','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26',0,'Task description # 3',1),(1016,'Task # 4','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26',0,'Task description # 4',1),(1017,'Task # 5','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26',0,'Task description # 5',1),(1018,'Task # 6','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26',0,'Task description # 6',1),(1019,'Task # 7','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26',0,'Task description # 7',1),(1020,'Task # 8','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26',0,'Task description # 8',1),(1021,'Task # 9','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26',0,'Task description # 9',1),(1022,'Task # 10','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26',0,'Task description # 10',1),(1023,'Task # 11','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26',0,'Task description # 11',1),(1024,'Task # 12','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26',0,'Task description # 12',1),(1025,'Task # 13','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26',0,'Task description # 13',1),(1026,'Task # 14','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26',0,'Task description # 14',1),(1027,'Task # 15','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26',0,'Task description # 15',1),(1028,'Task # 16','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26',0,'Task description # 16',1),(1029,'Task # 17','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26','2018-06-19 23:51:26',0,'Task description # 17',1),(1030,'Task # 18','2018-06-19 23:51:27','2018-06-19 23:51:27','2018-06-19 23:51:27','2018-06-19 23:51:27',0,'Task description # 18',1),(1031,'Task # 19','2018-06-19 23:51:27','2018-06-19 23:51:27','2018-06-19 23:51:27','2018-06-19 23:51:27',0,'Task description # 19',1),(1032,'Task # 20','2018-06-19 23:51:27','2018-06-19 23:51:27','2018-06-19 23:51:27','2018-06-19 23:51:27',0,'Task description # 20',1),(1033,'Task # 21','2018-06-19 23:51:27','2018-06-19 23:51:27','2018-06-19 23:51:27','2018-06-19 23:51:27',0,'Task description # 21',1),(1034,'Task # 22','2018-06-19 23:51:27','2018-06-19 23:51:27','2018-06-19 23:51:27','2018-06-19 23:51:27',0,'Task description # 22',1),(1035,'Task # 23','2018-06-19 23:51:27','2018-06-19 23:51:27','2018-06-19 23:51:27','2018-06-19 23:51:27',0,'Task description # 23',1),(1036,'Task # 24','2018-06-19 23:51:27','2018-06-19 23:51:27','2018-06-19 23:51:27','2018-06-19 23:51:27',0,'Task description # 24',1),(1037,'Task # 25','2018-06-19 23:51:27','2018-06-19 23:51:27','2018-06-19 23:51:27','2018-06-19 23:51:27',0,'Task description # 25',1);
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_hierarchy`
--

DROP TABLE IF EXISTS `task_hierarchy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_hierarchy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_task` int(11) NOT NULL,
  `child_task` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_task_ierarhy_task1_idx` (`parent_task`),
  KEY `fk_task_ierarhy_task2_idx` (`child_task`),
  CONSTRAINT `fk_task_ierarhy_task1` FOREIGN KEY (`parent_task`) REFERENCES `task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_task_ierarhy_task2` FOREIGN KEY (`child_task`) REFERENCES `task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_hierarchy`
--

LOCK TABLES `task_hierarchy` WRITE;
/*!40000 ALTER TABLE `task_hierarchy` DISABLE KEYS */;
/*!40000 ALTER TABLE `task_hierarchy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) NOT NULL,
  `secondName` varchar(50) NOT NULL,
  `middleName` varchar(50) DEFAULT NULL,
  `jobTitle` varchar(255) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `phone` varchar(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_UNIQUE` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Harry','Potter','James','Civil Engeneer I category','Harry','1a1dc91c907325c69271ddf0c944bc72','0000'),(2,'Hermiona','Grainger','','Witch I category','Hermi','1a1dc91c907325c69271ddf0c944bc72','0001');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_department`
--

DROP TABLE IF EXISTS `user_department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(5) NOT NULL,
  `department_id` int(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_department_user1_idx` (`user_id`),
  KEY `fk_user_department_department1_idx` (`department_id`),
  CONSTRAINT `fk_user_department_department1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_department_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_department`
--

LOCK TABLES `user_department` WRITE;
/*!40000 ALTER TABLE `user_department` DISABLE KEYS */;
INSERT INTO `user_department` VALUES (1,1,1),(2,2,1);
/*!40000 ALTER TABLE `user_department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role`
--

LOCK TABLES `user_role` WRITE;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_task`
--

DROP TABLE IF EXISTS `user_task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(5) NOT NULL,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_task_user1_idx` (`user_id`),
  KEY `fk_user_task_task1_idx` (`task_id`),
  CONSTRAINT `fk_user_task_task1` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_task_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_task`
--

LOCK TABLES `user_task` WRITE;
/*!40000 ALTER TABLE `user_task` DISABLE KEYS */;
INSERT INTO `user_task` VALUES (1,1,1),(2,2,2),(3,1,2),(4,1,3),(5,1,4),(6,1,5),(7,2,6),(8,2,7),(9,1,8),(10,1,1012),(11,1,1013),(12,1,1014),(13,1,1015),(14,1,1016),(15,1,1017),(16,1,1018),(17,1,1019),(18,1,1020),(19,1,1021),(20,1,1022),(21,1,1023),(22,1,1024),(23,1,1025),(24,1,1026),(25,1,1027),(26,1,1028),(27,1,1029),(28,1,1030),(29,1,1031),(30,1,1032),(31,1,1033),(32,1,1034),(33,1,1035),(34,1,1036),(35,1,1037);
/*!40000 ALTER TABLE `user_task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `activeuserview`
--

/*!50001 DROP TABLE IF EXISTS `activeuserview`*/;
/*!50001 DROP VIEW IF EXISTS `activeuserview`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`Gurikin`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `activeuserview` AS select `user`.`id` AS `user_id`,`user`.`firstName` AS `firstName`,`user`.`secondName` AS `secondName`,`user`.`middleName` AS `middleName`,`user`.`jobTitle` AS `jobTitle` from `user` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `ganttview`
--

/*!50001 DROP TABLE IF EXISTS `ganttview`*/;
/*!50001 DROP VIEW IF EXISTS `ganttview`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `ganttview` AS select `user`.`firstName` AS `firstName`,`user`.`secondName` AS `secondName`,`user`.`middleName` AS `middleName`,`user_task`.`user_id` AS `user_id`,`user_task`.`task_id` AS `task_id`,`task`.`taskTitle` AS `taskTitle`,`task`.`orderDate` AS `orderDate`,`task`.`endDate` AS `endDate`,`task`.`progress` AS `progress` from (`user` join (`user_task` join `task` on((`task`.`id` = `user_task`.`task_id`)))) where (`user`.`id` = `user_task`.`user_id`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-26 23:45:11
