
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

--
-- Table structure for table `CB0002`
--

DROP TABLE IF EXISTS `cuenta_bancarias`;
CREATE TABLE `cuenta_bancarias` (
  `cban_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cban_codigo` varchar(10) NOT NULL DEFAULT '',
  `cban_nombre` varchar(40) DEFAULT NULL,
  `cban_tipo_cuenta` varchar(1) DEFAULT NULL,
  `cban_numero_cuenta` varchar(20) NOT NULL DEFAULT '',
  `cban_numero_cheque` varchar(10) DEFAULT NULL,
  `cban_titular` varchar(30) DEFAULT NULL,
  `cban_contacto` varchar(30) DEFAULT NULL,
  `cban_tel_contacto` decimal(10,0) DEFAULT NULL,
  `cban_n_mov_b` decimal(5,0) default null,
  `v_dep_b` decimal(14,2) default null,
  `v_ret_b` decimal(14,2) default null,
  `v_sal_b` decimal(14,2) default null,
  `v_sal_i` decimal(14,2) default null,
  `f_u_act` date default null,
  `cmes_01` varchar(1) default null,
  `cmes_02` varchar(1) default null,
  `cmes_03` varchar(1) default null,
  `cmes_04` varchar(1) default null,
  `cmes_05` varchar(1) default null,
  `cmes_06` varchar(1) default null,
  `cmes_07` varchar(1) default null,
  `cmes_08` varchar(1) default null,
  `cmes_09` varchar(1) default null,
  `cmes_10` varchar(1) default null,
  `cmes_11` varchar(1) default null,
  `cmes_12` varchar(1) default null,
  `cta_con` varchar(12) default null,
  `che_ord` varchar(5) default null,
  `che_val` varchar(5) default null,
  `che_l01` varchar(5) default null,
  `che_l02` varchar(5) default null,
  `che_ciu` varchar(5) default null,
  `che_fec` varchar(5) default null,
  `cod_div` varchar(2) default null,
  `mos_sald` varchar(1) default null,
  `estado` varchar(1) DEFAULT NULL,
  `usuario_creacion` varchar(45) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` timestamp NULL DEFAULT NULL,
  `estado_logico` varchar(1) DEFAULT NULL,
  `equipo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`cban_id`,`cban_codigo`,`cban_numero_cuenta`),
  KEY `CB02_CTA_CON_FK` (`CTA_CON`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

