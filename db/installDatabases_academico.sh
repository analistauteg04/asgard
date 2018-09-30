#!/bin/bash

USER='uteg'
PASS='Utegadmin2016*'
CURRENT_DIR=`pwd`

echo -n "Escriba el password del Usuario Root de Mysql:"
read -s ROOT_PASS
echo ""



echo -n "Instalar en Produccion (1) o Desarrollo (2):"
read -s PROD
echo ""

# CREACION DEL USUARIO MYSQL
# mysql -uroot -p${ROOT_PASS} -e "DROP USER IF EXISTS '${USER}'@'localhost';"
mysql -uroot -p${ROOT_PASS} -e "CREATE USER '${USER}'@'localhost' IDENTIFIED BY '${PASS}';"

if [ $PROD -eq 1 ]; then
    echo "INSTALANDO en Produccion......"
else
    echo "INSTALANDO en Desarrollo......"
fi


# DATABASE ACADEMICO
echo "SUBIENDO db_academico......"
mysql -u${USER} -p${PASS} < $CURRENT_DIR/base_nueva_prod/estructura/db_academico.sql
mysql -u${USER} -p${PASS} < $CURRENT_DIR/base_nueva_prod/data/db_academico_data_1.sql
mysql -u${USER} -p${PASS} < $CURRENT_DIR/base_nueva_prod/data/db_academico_data_2.sql
mysql -uroot -p${ROOT_PASS} -e "GRANT ALL PRIVILEGES ON db_academico.* TO '${USER}'@'localhost';"

# FLUSH PRIVILEGES
echo "Aplicando Permisos......"
mysql -uroot -p${ROOT_PASS} -e "FLUSH PRIVILEGES;"


echo "Script Finalizado!!! ;)"
