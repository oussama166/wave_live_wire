#!/bin/sh

sed -i "s,LISTEN_PORT,$LISTEN,g" /etc/nginx/nginx.conf

echo $LISTEN

/usr/bin/supervisord -c /etc/supervisord.conf
