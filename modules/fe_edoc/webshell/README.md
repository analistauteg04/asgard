INSTALACION DE PHP WINDOWS 10
============================

PREPARANDO EL SERVIDOR CENTOS 7

1.- DESCARGAR EN Ruta Raiz:/webshell de CENTOS 7 
2.- DESCARGAR EL FIRMADO DE JAVA.war QUE ESTA EN WEBSHELL /firmadorToncat/FIRMARSRI.war
3.- DESCARGAR LOS ARCHIVOS cron.sh DE fileCromtab Y GUARDARLOS EN LA RUTA DE  /home/
    - SeaFacturacionAut.cron.sh
    - SeaFacturacionRec.cron.sh
4.- CREAR UNA TAREA CON /crontab -e Y AGREGAR LO SIGUIENTE
    - (Cada 2 minutos de 8am a 7pm los dias Lun,Mar,Mie,Jue,Vir)
        */2 8-19 * * 1,2,3,4,5 /home/SeaFacturacionRec.cron.sh
        */3 8-19 * * 1,2,3,4,5 /home/SeaFacturacionAut.cron.sh

REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.6.0. o Superior

~~~

INSTALLATION
------------

### Install 