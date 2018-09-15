#!/bin/bash

USER='uteg'
PASS='Utegadmin2016*'
CURRENT_DIR=`pwd`

echo -n Escriba el password del Usuario Root de Mysql: 
read -s ROOT_PASS
echo $ROOT_PASS

# CREACION DEL USUARIO MYSQL
mysql -uroot -p${ROOT_PASS} -e "CREATE USER ${USER}@localhost IDENTIFIED BY '${PASS}';"

# DATABASE ASGARD
echo "SUBIENDO db_asgard......"
mysql -u${USER} -p${PASS} < $CURRENT_DIR/base_nueva_prod/estructura/db_asgard.sql
mysql -u${USER} -p${PASS} < $CURRENT_DIR/base_nueva_prod/data/db_asgard_data_01.sql
mysql -u${USER} -p${PASS} < $CURRENT_DIR/base_nueva_prod/data/db_asgard_data_02.sql
mysql -u${USER} -p${PASS} < $CURRENT_DIR/base_nueva_prod/data/db_asgard_data_03.sql
mysql -u${USER} -p${PASS} < $CURRENT_DIR/base_nueva_prod/data/db_asgard_data_04.sql
mysql -u${USER} -p${PASS} < $CURRENT_DIR/base_nueva_prod/data/db_asgard_data_05.sql
mysql -u${USER} -p${PASS} < $CURRENT_DIR/base_nueva_prod/data/db_asgard_data_06.sql
mysql -u${USER} -p${PASS} < $CURRENT_DIR/base_nueva_prod/data/db_asgard_data_07.sql
mysql -uroot -p${ROOT_PASS} -e "GRANT ALL PRIVILEGES ON db_asgard.* TO '${USER}'@'localhost';"

# DATABASE GENERAL
echo "SUBIENDO db_general......"
mysql -u${USER} -p${PASS} < $CURRENT_DIR/base_nueva_prod/estructura/db_general.sql
mysql -u${USER} -p${PASS} < $CURRENT_DIR/base_nueva_prod/data/db_general_data.sql
mysql -uroot -p${ROOT_PASS} -e "GRANT ALL PRIVILEGES ON db_general.* TO '${USER}'@'localhost';"

# DATABASE CRM
echo "SUBIENDO db_crm......"
mysql -u${USER} -p${PASS} < $CURRENT_DIR/base_nueva_prod/estructura/db_crm.sql
mysql -u${USER} -p${PASS} < $CURRENT_DIR/base_nueva_prod/data/db_crm_data.sql
mysql -uroot -p${ROOT_PASS} -e "GRANT ALL PRIVILEGES ON db_crm.* TO '${USER}'@'localhost';"

# DATABASE CAPTACION
echo "SUBIENDO db_captacion......"
mysql -u${USER} -p${PASS} < $CURRENT_DIR/base_nueva_prod/estructura/db_captacion.sql
mysql -u${USER} -p${PASS} < $CURRENT_DIR/base_nueva_prod/data/db_captacion_data_01.sql
mysql -u${USER} -p${PASS} < $CURRENT_DIR/base_nueva_prod/data/db_captacion_data_02.sql
mysql -uroot -p${ROOT_PASS} -e "GRANT ALL PRIVILEGES ON db_captacion.* TO '${USER}'@'localhost';"

# DATABASE ACADEMICO
echo "SUBIENDO db_academico......"
mysql -u${USER} -p${PASS} < $CURRENT_DIR/base_nueva_prod/estructura/db_academico.sql
mysql -u${USER} -p${PASS} < $CURRENT_DIR/base_nueva_prod/data/db_academico_data_1.sql
#mysql -u${USER} -p${PASS} < $CURRENT_DIR/base_nueva_prod/data/db_academico_data_2.sql
mysql -uroot -p${ROOT_PASS} -e "GRANT ALL PRIVILEGES ON db_academico.* TO '${USER}'@'localhost';"

# DATABASE FACTURACION
echo "SUBIENDO db_facturacion......"
mysql -u${USER} -p${PASS} < $CURRENT_DIR/base_nueva_prod/estructura/db_facturacion.sql
mysql -u${USER} -p${PASS} < $CURRENT_DIR/base_nueva_prod/data/db_facturacion_data_01.sql
mysql -u${USER} -p${PASS} < $CURRENT_DIR/base_nueva_prod/data/db_facturacion_data_02.sql
mysql -uroot -p${ROOT_PASS} -e "GRANT ALL PRIVILEGES ON db_facturacion.* TO '${USER}'@'localhost';"

# FLUSH PRIVILEGES
echo "Aplicando Permisos......"
mysql -uroot -p${ROOT_PASS} -e "FLUSH PRIVILEGES;"

echo "Script Finalizado!!! ;)"