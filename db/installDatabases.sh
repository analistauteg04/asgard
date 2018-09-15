#!/bin/bash

USER='uteg'
PASS='Utegadmin2016*'
CURRENT_DIR=`pwd`

# CREACION DEL USUARIO MYSQL
#mysql -uroot -p${rootpasswd} -e "CREATE DATABASE ${MAINDB} /*\!40100 DEFAULT CHARACTER SET utf8 */;"
#mysql -uroot -p${rootpasswd} -e "CREATE USER ${MAINDB}@localhost IDENTIFIED BY '${PASSWDDB}';"
#mysql -uroot -p${rootpasswd} -e "GRANT ALL PRIVILEGES ON ${MAINDB}.* TO '${MAINDB}'@'localhost';"
#mysql -uroot -p${rootpasswd} -e "FLUSH PRIVILEGES;"

# DATABASE ASGARD
mysql -u$USER -p$PASS < $CURRENT_DIR/base_nueva_prod/estructura/db_asgard.sql
mysql -U$USER -p$PASS < $CURRENT_DIR/base_nueva_prod/data/

# DATABASE GENERAL
mysql -u$USER -p$PASS < $CURRENT_DIR/base_nueva_prod/estructura/db_general.sql
mysql -U$USER -p$PASS < $CURRENT_DIR/base_nueva_prod/data/db_asgard_data_01.sql
mysql -U$USER -p$PASS < $CURRENT_DIR/base_nueva_prod/data/db_asgard_data_02.sql
mysql -U$USER -p$PASS < $CURRENT_DIR/base_nueva_prod/data/db_asgard_data_03.sql
mysql -U$USER -p$PASS < $CURRENT_DIR/base_nueva_prod/data/db_asgard_data_04.sql
mysql -U$USER -p$PASS < $CURRENT_DIR/base_nueva_prod/data/db_asgard_data_05.sql
mysql -U$USER -p$PASS < $CURRENT_DIR/base_nueva_prod/data/db_asgard_data_06.sql
mysql -U$USER -p$PASS < $CURRENT_DIR/base_nueva_prod/data/db_asgard_data_07.sql

# DATABASE CRM
mysql -u$USER -p$PASS < $CURRENT_DIR/base_nueva_prod/estructura/db_crm.sql
mysql -U$USER -p$PASS < $CURRENT_DIR/base_nueva_prod/data/db_crm_data.sql

# DATABASE CAPTACION
mysql -u$USER -p$PASS < $CURRENT_DIR/base_nueva_prod/estructura/db_captacion.sql
mysql -U$USER -p$PASS < $CURRENT_DIR/base_nueva_prod/data/db_captacion_data_01.sql
mysql -U$USER -p$PASS < $CURRENT_DIR/base_nueva_prod/data/db_captacion_data_02.sql

# DATABASE ACADEMICO
mysql -u$USER -p$PASS < $CURRENT_DIR/base_nueva_prod/estructura/db_academico.sql
mysql -U$USER -p$PASS < $CURRENT_DIR/base_nueva_prod/data/db_academico_data_1.sql
mysql -U$USER -p$PASS < $CURRENT_DIR/base_nueva_prod/data/db_academico_data_2.sql

# DATABASE FACTURACION
mysql -u$USER -p$PASS < $CURRENT_DIR/base_nueva_prod/estructura/db_facturacion.sql
mysql -U$USER -p$PASS < $CURRENT_DIR/base_nueva_prod/data/db_facturacion_data_01.sql
mysql -U$USER -p$PASS < $CURRENT_DIR/base_nueva_prod/data/db_facturacion_data_02.sql