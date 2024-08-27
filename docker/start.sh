#!/bin/sh

sed -i "s,LISTEN_PORT,$LISTEN,g" /etc/nginx/nginx.conf

/usr/bin/supervisord -c /etc/supervisord.conf
