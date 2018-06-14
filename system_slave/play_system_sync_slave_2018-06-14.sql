# ************************************************************
# Sequel Pro SQL dump
# Versão 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.1.32-MariaDB)
# Base de Dados: play_system_sync_slave
# Tempo de Geração: 2018-06-14 18:30:19 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump da tabela order_service
# ------------------------------------------------------------

DROP TABLE IF EXISTS `order_service`;

CREATE TABLE `order_service` (
  `order_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_cod` varchar(100) DEFAULT NULL,
  `order_client` varchar(100) DEFAULT NULL,
  `order_address` varchar(100) DEFAULT NULL,
  `order_problem` text,
  `order_date` timestamp NULL DEFAULT NULL,
  `order_status` int(11) DEFAULT NULL,
  `order_employee` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `order_service` WRITE;
/*!40000 ALTER TABLE `order_service` DISABLE KEYS */;

INSERT INTO `order_service` (`order_id`, `order_cod`, `order_client`, `order_address`, `order_problem`, `order_date`, `order_status`, `order_employee`)
VALUES
	(43,'2018061528922553.9437','Gustavo Web','Rua dos Bobos, 0','Teste','2018-06-22 15:00:00',2,100),
	(44,'2018061528923139.4369','Kaue','Rua teste','teste','2018-06-19 11:00:00',2,200);

/*!40000 ALTER TABLE `order_service` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela order_service_notes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `order_service_notes`;

CREATE TABLE `order_service_notes` (
  `order_service_notes_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `note_order_service` varchar(100) DEFAULT '',
  `note_order_text` text,
  `note_order_date` timestamp NULL DEFAULT NULL,
  `note_order_sync` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_service_notes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `order_service_notes` WRITE;
/*!40000 ALTER TABLE `order_service_notes` DISABLE KEYS */;

INSERT INTO `order_service_notes` (`order_service_notes_id`, `note_order_service`, `note_order_text`, `note_order_date`, `note_order_sync`)
VALUES
	(4,'2018061528922553.9437','Serviço realizado com sucesso!','2018-06-13 17:46:33',1),
	(5,'2018061528922553.9437','teste1','2018-06-13 17:47:41',1),
	(6,'2018061528922553.9437','teste2','2018-06-13 17:47:43',1),
	(7,'2018061528922553.9437','teste3','2018-06-13 17:47:46',1),
	(8,'2018061528923139.4369','teste','2018-06-13 17:54:48',1);

/*!40000 ALTER TABLE `order_service_notes` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
