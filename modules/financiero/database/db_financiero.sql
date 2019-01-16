
-- MySQL dump 10.13  Distrib 5.7.13, for linux-glibc2.5 (x86_64)
--
-- Host: localhost    Database: financiero
-- ------------------------------------------------------
-- Server version	5.6.40


--`cat_id` bigint(20) not null auto_increment primary key,
-- Table structure for table `CATALOGO`
--

DROP TABLE IF EXISTS `catalogo`;
CREATE TABLE `catalogo` (  
  `cat_cod_cta` varchar(12) not null primary key,
  `cat_cod_pad` varchar(12) default null,
  `cat_nom_cta` varchar(120) default null,
  `cat_tip_cta` varchar(2) default null,
  `cat_tip_ele` varchar(30) default null,
  `cat_tip_reg` varchar(30) default null,
  `cat_sdb` decimal(15,2) default null,
  `cat_shb` decimal(15,2) default null,
  `cat_d00` decimal(15,2) default null,
  `cat_h00` decimal(15,2) default null,
  `cat_d01` decimal(15,2) default null,
  `cat_h01` decimal(15,2) default null,
  `cat_d02` decimal(15,2) default null,
  `cat_h02` decimal(15,2) default null,
  `cat_d03` decimal(15,2) default null,
  `cat_h03` decimal(15,2) default null,
  `cat_d04` decimal(15,2) default null,
  `cat_h04` decimal(15,2) default null,
  `cat_d05` decimal(15,2) default null,
  `cat_h05` decimal(15,2) default null,
  `cat_d06` decimal(15,2) default null,
  `cat_h06` decimal(15,2) default null,
  `cat_d07` decimal(15,2) default null,
  `cat_h07` decimal(15,2) default null,
  `cat_d08` decimal(15,2) default null,
  `cat_h08` decimal(15,2) default null,
  `cat_d09` decimal(15,2) default null,
  `cat_h09` decimal(15,2) default null,
  `cat_d10` decimal(15,2) default null,
  `cat_h10` decimal(15,2) default null,
  `cat_d11` decimal(15,2) default null,
  `cat_h11` decimal(15,2) default null,
  `cat_d12` decimal(15,2) default null,
  `cat_h12` decimal(15,2) default null,
  `estado` varchar(1) DEFAULT NULL,
  `usuario_creacion` varchar(45) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` timestamp NULL DEFAULT NULL,
  `estado_logico` varchar(1) DEFAULT NULL,
  `equipo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--`cat_id` bigint(20) not null auto_increment primary key,
-- Table structure for table `CATALOGO`
--

DROP TABLE IF EXISTS `catalogo_2019`;
CREATE TABLE `catalogo_2019` (  
  `cat_cod_cta` varchar(12) not null primary key,
  `cat_cod_pad` varchar(12) default null,
  `cat_nom_cta` varchar(120) default null,
  `cat_tip_cta` varchar(2) default null,
  `cat_tip_ele` varchar(30) default null,
  `cat_tip_reg` varchar(30) default null,
  `cat_sdb` decimal(15,2) default null,
  `cat_shb` decimal(15,2) default null,
  `cat_d00` decimal(15,2) default null,
  `cat_h00` decimal(15,2) default null,
  `cat_d01` decimal(15,2) default null,
  `cat_h01` decimal(15,2) default null,
  `cat_d02` decimal(15,2) default null,
  `cat_h02` decimal(15,2) default null,
  `cat_d03` decimal(15,2) default null,
  `cat_h03` decimal(15,2) default null,
  `cat_d04` decimal(15,2) default null,
  `cat_h04` decimal(15,2) default null,
  `cat_d05` decimal(15,2) default null,
  `cat_h05` decimal(15,2) default null,
  `cat_d06` decimal(15,2) default null,
  `cat_h06` decimal(15,2) default null,
  `cat_d07` decimal(15,2) default null,
  `cat_h07` decimal(15,2) default null,
  `cat_d08` decimal(15,2) default null,
  `cat_h08` decimal(15,2) default null,
  `cat_d09` decimal(15,2) default null,
  `cat_h09` decimal(15,2) default null,
  `cat_d10` decimal(15,2) default null,
  `cat_h10` decimal(15,2) default null,
  `cat_d11` decimal(15,2) default null,
  `cat_h11` decimal(15,2) default null,
  `cat_d12` decimal(15,2) default null,
  `cat_h12` decimal(15,2) default null,
  `estado` varchar(1) DEFAULT NULL,
  `usuario_creacion` varchar(45) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` timestamp NULL DEFAULT NULL,
  `estado_logico` varchar(1) DEFAULT NULL,
  `equipo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `entidad_bancaria`
--

DROP TABLE IF EXISTS `entidad_bancaria`;--CB0001
CREATE TABLE `entidad_bancaria` (
  `eban_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `eban_nombre` varchar(50) DEFAULT NULL,
  `eban_nomenclatura` varchar(3) DEFAULT '',
  `estado` varchar(1) DEFAULT NULL,
  `usuario_creacion` varchar(45) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` timestamp NULL DEFAULT NULL,
  `estado_logico` varchar(1) DEFAULT NULL,
  `equipo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`eban_id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

--
-- Table structure for table `tarjeta_credito`
--

DROP TABLE IF EXISTS `tarjeta_credito`;--CB0001T
CREATE TABLE `tarjeta_credito` (
  `tcre_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tcre_nombre` varchar(50) DEFAULT NULL,
  `tcre_codigo` varchar(2) DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL,
  `usuario_creacion` varchar(45) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` timestamp NULL DEFAULT NULL,
  `estado_logico` varchar(1) DEFAULT NULL,
  `equipo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`tcre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;


-- TABLAS DE BOTON DE PAGO
DROP TABLE IF EXISTS `vpos_request`;
CREATE TABLE `vpos_request` (
  `reference` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `descripcion` varchar(200) DEFAULT NULL,
  `currency` varchar(5) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `tax` float DEFAULT NULL,
  `session` varchar(50) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `returnUrl` varchar(200) DEFAULT NULL,
  `expiration` timestamp NULL DEFAULT NULL,
  `document` varchar(50) DEFAULT NULL,
  `documentType` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `json_request` text DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` timestamp NULL DEFAULT NULL,
  `estado_logico` varchar(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `vpos_response`;
CREATE TABLE `vpos_response` (
  `reference` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `requestId` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `reason` varchar(10) DEFAULT NULL,
  `message` varchar(200) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `processUrl` varchar(200) DEFAULT NULL,
  `json_response` text DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` timestamp NULL DEFAULT NULL,
  `estado_logico` varchar(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `vpos_info_response`;
CREATE TABLE `vpos_info_response` (
  `reference` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `requestId` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `reason` varchar(10) DEFAULT NULL,
  `message` varchar(200) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `payment_status` varchar(20) DEFAULT NULL,
  `payment_reason` varchar(10) DEFAULT NULL,
  `payment_message` varchar(200) DEFAULT NULL,
  `payment_date` timestamp NULL DEFAULT NULL,
  `internalReference` varchar(50) DEFAULT NULL,
  `paymenMethod` varchar(100) DEFAULT NULL,
  `paymentMethodName` varchar(50) DEFAULT NULL,
  `issuerName` varchar(100) DEFAULT NULL,
  `autorization` varchar(100) DEFAULT NULL,
  `receipt` varchar(50) DEFAULT NULL,
  `json_info` text DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` timestamp NULL DEFAULT NULL,
  `estado_logico` varchar(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;