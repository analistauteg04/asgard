#!/bin/bash

IP_UTEG_DES="181.39.139.67"
IP_UTEG_OFI="186.68.143.106"
RED_PRIVADA="130.107.1.0/24"
ETH0="em1"
ETH1="em2"
echo "Aplicando Reglas de Firewall..."

## FLUSH de reglas
iptables -F
iptables -X
iptables -Z
iptables -t nat -F

## Establecemos politica por defecto
iptables -P INPUT DROP
iptables -P OUTPUT DROP
iptables -P FORWARD DROP

## Se permite todo para localhost
iptables -A INPUT  -i lo -j ACCEPT
iptables -A OUTPUT -o lo -j ACCEPT

## A nuestras IP le dejamos todo
iptables -A INPUT  -s $IP_UTEG_DES -j ACCEPT
iptables -A OUTPUT -d $IP_UTEG_DES -j ACCEPT
iptables -A INPUT  -s $IP_UTEG_OFI -j ACCEPT
iptables -A OUTPUT -d $IP_UTEG_OFI -j ACCEPT

## Se permite acceso desde la red 
iptables -A INPUT -i $ETH1 -s $RED_PRIVADA -j ACCEPT
iptables -A OUTPUT -o $ETH1 -d $RED_PRIVADA -j ACCEPT

## El puerto 80 y 433 de www debe estar abierto, es un servidor web.
iptables -A INPUT  -p tcp --dport 80 -j ACCEPT
iptables -A OUTPUT -p tcp --sport 80 -j ACCEPT
iptables -A INPUT  -p tcp --dport 443 -j ACCEPT
iptables -A OUTPUT -p tcp --sport 443 -j ACCEPT

## Se agrega permisos para Salida puertos mail server
iptables -A INPUT  -p tcp --dport 587 -j ACCEPT
iptables -A OUTPUT -p tcp --sport 587 -j ACCEPT

## Cerramos otros puertos que estan abiertos
iptables -A INPUT -p udp --dport 5353 -j DROP

## Se guarda la configuracion de Iptables
iptables-save > /etc/sysconfig/iptables

echo "OK. Verifique que lo que se aplica con: iptables -L -n"

#proceso de bajar Firewalld e Instalar iptables
#sudo yum install iptables-services
#systemctl stop firewalld && sudo systemctl start iptables; sudo systemctl start ip6tables
#sudo systemctl disable firewalld
#sudo systemctl mask firewalld
#sudo systemctl enable iptables
#sudo systemctl enable ip6tables
