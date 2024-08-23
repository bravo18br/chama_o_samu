#!/bin/sh
apk add --no-cache tzdata su-exec
cp /usr/share/zoneinfo/America/Sao_Paulo /etc/localtime
echo 'America/Sao_Paulo' > /etc/timezone
exec su-exec postgres initdb -D /var/lib/postgresql/data
exec su-exec postgres pg_ctl -D /var/lib/postgresql/data -l /var/lib/postgresql/data/logfile start
# exec su-exec postgres postgres

    #   sh -c "
    #   apk add --no-cache tzdata su-exec &&
    #   cp /usr/share/zoneinfo/America/Sao_Paulo /etc/localtime &&
    #   echo 'America/Sao_Paulo' > /etc/timezone &&
    #   if [ -f /var/lib/postgresql/data/postmaster.pid ]; then
    #     rm /var/lib/postgresql/data/postmaster.pid;
    #   fi &&
    #   if [ ! -s /var/lib/postgresql/data ]; then
    #     su-exec postgres initdb -D /var/lib/postgresql/data;
    #   fi &&
    #   su-exec postgres pg_ctl -D /var/lib/postgresql/data -l /var/lib/postgresql/data/logfile start"
