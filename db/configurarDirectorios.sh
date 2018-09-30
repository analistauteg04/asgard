#!/bin/bash

BASE_URL='/var/www/html'
#SETEANDO LOS PERMISOS CORRECTOS AL PROYECTO (755 PARA DIRECTORIOS Y 644 PARA ARCHIVOS)
find $BASE_URL/asgard/ -type d -exec chmod 0755 {} \;
find $BASE_URL/asgard/ -type f -exec chmod 0644 {} \;

#CAMBIANDO PROPIETARIO DE CARPETAS QUE APACHE NECESITA ESCRIBIR (LAS DEMAS CARPETAS Y ARCHIVOS DEBEN ESTAR COMO root:root);
chown -R apache:apache $BASE_URL/runtime
chown -R apache:apache $BASE_URL/uploads
chown -R apache:apache $BASE_URL/web/assets